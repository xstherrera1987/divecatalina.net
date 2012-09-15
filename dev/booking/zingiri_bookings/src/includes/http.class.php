<?php
//v2.03.10
//removed cc_whmcs_log call
//need wpabspath for mailz
//mailz returns full URL in case of redirection!!
//made redirect generic, detect if location string contains protocol and server or not
//added option to enable repost of $_POST variables
//fixed issue with redirection location string
//added support for content-type
//fixed issue with $this->$headers wrong, should be $this->headers
//fixed issue with handling of $repost
//added check on $headers['location'] existence
//added initialisation of $post and $apost
//fixed issue with checkConnection()
//added support for multiple cookies
//check if session exists before starting a new one
//changed return test value of checkConnection()
//replaced display of error and notice by triggering PHP error or notice
//added mime type info to uploaded files
//added option to disable following redirect links
//fixed issue with HTTP 417 errors on some web servers
//fixed redirect link parsing issue
//fixed issue with redirect urls duplicating url path
//added http return code
//improvide error management
//v2.01.11: improved debugging
//v2.02.19: increased depth of $_POST parsing by one level
//v2.03.10: increased depth of $_POST parsing by one more level

if (!class_exists('zHttpRequest')) {
	class zHttpRequest
	{
		var $_fp;        // HTTP socket
		var $_url;        // full URL
		var $_host;        // HTTP host
		var $_protocol;    // protocol (HTTP/HTTPS)
		var $_uri;        // request URI
		var $_port;        // port
		var $_path;
		var $params;
		var $error=false;
		var $errno=false;
		var $post=array();	//post variables, defaults to $_POST
		var $redirect=false;
		var $errors=array();
		var $countRedirects=0;
		var $sid;
		var $httpCode;
		var $repost=false;
		var $type; //content-type
		var $follow=true; //whether to follow redirect links or not
		var $noErrors=false; //whether to trigger an error in case of a curl error
		var $errorMessage;

		// constructor
		function __construct($url="",$sid='', $repost=false)
		{
			if (!$url) return;
			$this->sid=$sid;
			$this->_url = $url;
			$this->_scan_url();
			$this->post=$_POST;
			$this->repost=$repost;
		}


		private function processHeaders($headers) {
			// split headers, one per array element
			if ( is_string($headers) ) {
				// tolerate line terminator: CRLF = LF (RFC 2616 19.3)
				$headers = str_replace("\r\n", "\n", $headers);
				// unfold folded header fields. LWS = [CRLF] 1*( SP | HT ) <US-ASCII SP, space (32)>, <US-ASCII HT, horizontal-tab (9)> (RFC 2616 2.2)
				$headers = preg_replace('/\n[ \t]/', ' ', $headers);
				// create the headers array
				$headers = explode("\n", $headers);
			}

			$response = array('code' => 0, 'message' => '');

			// If a redirection has taken place, The headers for each page request may have been passed.
			// In this case, determine the final HTTP header and parse from there.
			for ( $i = count($headers)-1; $i >= 0; $i-- ) {
				if ( !empty($headers[$i]) && false === strpos($headers[$i], ':') ) {
					$headers = array_splice($headers, $i);
					break;
				}
			}

			$cookies = '';
			$newheaders = array();
			//echo '<br /><br />HEADERS<br />'.print_r($headers,true).'===<br /><br />';
			foreach ( $headers as $tempheader ) {
				if ( empty($tempheader) )
				continue;

				if ( false === strpos($tempheader, ':') ) {
					list( , $response['code'], $response['message']) = explode(' ', $tempheader, 3);
					continue;
				}

				list($key, $value) = explode(':', $tempheader, 2);

				if ( !empty( $value ) ) {
					$key = strtolower( $key );
					if ( isset( $newheaders[$key] ) ) {
						if ( !is_array($newheaders[$key]) )
						$newheaders[$key] = array($newheaders[$key]);
						$newheaders[$key][] = trim( $value );
					} else {
						$newheaders[$key] = trim( $value );
					}
					if ( 'set-cookie' == $key ) {
						if ($cookies) $cookies.=' ;';
						$cookies .= $value;
					}
				}
			}
			//echo '<br /><br />COOKIES:'.$cookies.'===<br /><br />';

			return array('response' => $response, 'headers' => $newheaders, 'cookies' => $cookies);
		}

		// scan url
		private function _scan_url()
		{
			$req = $this->_url;

			$pos = strpos($req, '://');
			$this->_protocol = strtolower(substr($req, 0, $pos));

			$req = substr($req, $pos+3);
			$pos = strpos($req, '/');
			if($pos === false)
			$pos = strlen($req);
			$host = substr($req, 0, $pos);

			if(strpos($host, ':') !== false)
			{
				list($this->_host, $this->_port) = explode(':', $host);
			}
			else
			{
				$this->_host = $host;
				$this->_port = ($this->_protocol == 'https') ? 443 : 80;
			}

			$this->_uri = substr($req, $pos);
			if($this->_uri == '') {
				$this->_uri = '/';
			} else {
				$this->_params=substr(strrchr($this->_uri,'/'),1);
				$this->_path=str_replace($this->_params,'',$this->_uri);
			}
		}

		//check if server is live
		function live() {
			if (ip2long($this->_host)) return true; //in case using an IP instead of a host name
			$url=$this->_host;
			if (gethostbyname($url) == $url) return false;
			else return true;
		}

		//get mime type of uploaded file
		function mimeType($file) {
			$mime='';
			if (function_exists('finfo_open')) {
				if ($finfo = finfo_open(FILEINFO_MIME_TYPE)) {
					$mime=finfo_file($finfo, $file);
					finfo_close($finfo);
				}
			}
			if ($mime) return ';type='.$mime;
			else return '';
		}

		//check if cURL installed
		function curlInstalled() {
			if (!function_exists('curl_init')) return false;
			else return true;
		}

		//check destination is reachable
		function checkConnection() {
			$this->post['checkconnection']=1;
			$output=$this->connect($this->_protocol.'://'.$this->_host.$this->_uri);
			if ($output=='zingiri' || $output=='connected') return true;
			else return false;
		}

		//error logging
		function error($msg) {
			$this->errorMsg=$msg;
			$this->error=true;
			if (!$this->noErrors) trigger_error($msg,E_USER_WARNING);
		}

		//notification logging
		function notify($msg) {
			$this->errorMsg=$msg;
			$this->error=true;
			if (!$this->noErrors) trigger_error($msg,E_USER_NOTICE);
		}

		// download URL to string
		function DownloadToString($withHeaders=true,$withCookies=false)
		{
			return $this->connect($this->_protocol.'://'.$this->_host.$this->_uri,$withHeaders,$withCookies);
		}

		function connect($url,$withHeaders=true,$withCookies=true)
		{
			$newfiles=array();

			if (!session_id()) @session_start();
			$ch = curl_init();    // initialize curl handle
			//echo '<br />call:'.$url;echo '<br />post='.print_r($this->post,true).'=<br />';
			curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			if ($withHeaders) curl_setopt($ch, CURLOPT_HEADER, 1);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); //avoid 417 errors
				
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60); // times out after 10s
			if ($this->_protocol == "https") {
				if (file_exists($cainfo)) {
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
					//curl_setopt($ch, CURLOPT_CAINFO, $cainfo);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
				} else {
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($ch, CURLOPT_CAINFO, NULL);
					curl_setopt($ch, CURLOPT_CAPATH, NULL);
				}
			}
			if ($withCookies && isset($_COOKIE)) {
				$cookies="";
				foreach ($_COOKIE as $i => $v) {
					if ($i=='WHMCSUID' || $i=="WHMCSPW") {
						if ($cookies) $cookies.=';';
						$cookies.=$i.'='.$v;
					}
				}
				curl_setopt($ch, CURLOPT_COOKIE, $cookies);
			}
			//echo '<br />cookie before='.print_r($_SESSION[$this->sid]['cookies'],true).'=';
			if (isset($_SESSION[$this->sid]['cookies'])) {
				curl_setopt($ch, CURLOPT_COOKIE, $_SESSION[$this->sid]['cookies']);
			}
			if (count($_FILES) > 0) {
				foreach ($_FILES as $name => $file) {
					if (is_array($file['tmp_name']) && count($file['tmp_name']) > 0) {
						$c=count($file['tmp_name']);
						for ($i=0;$i<$c;$i++) {
							if ($file['tmp_name'][$i]) {
								$newfile=BLOGUPLOADDIR.$file['name'][$i];
								$newfiles[]=$newfile;
								copy($file['tmp_name'][$i],$newfile);
								if ($file['tmp_name'][$i]) $this->post[$name][$i]='@'.$newfile.$this->mimeType($newfile);
							}
						}
					} elseif ($file['tmp_name']) {
						$newfile=BLOGUPLOADDIR.$file['name'];
						$newfiles[]=$newfile;
						copy($file['tmp_name'],$newfile);
						if ($file['tmp_name']) $this->post[$name]='@'.$newfile.$this->mimeType($newfile);
					}
				}
			}
			$post='';
			$apost=array();
			if (count($this->post) > 0) {
				curl_setopt($ch, CURLOPT_POST, 1); // set POST method
				$post="";
				$apost=array();
				foreach ($this->post as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if (is_array($v2)) {
								foreach ($v2 as $k3 => $v3) {
									if ($post) $post.='&';
									if (is_array($v3)) {
										foreach ($v3 as $k4 => $v4) {
											if (is_array($v4)) {
												foreach ($v4 as $k5 => $v5) {
													if (is_array($v5)) {
														foreach ($v5 as $k6 => $v6) {
															$apost[$k.'['.$k2.']'.'['.$k3.']'.'['.$k4.']'.'['.$k5.']'.'['.$k6.']']=stripslashes($v6);
														}
													} else $apost[$k.'['.$k2.']'.'['.$k3.']'.'['.$k4.']'.'['.$k5.']']=stripslashes($v5);
												}
											} else $apost[$k.'['.$k2.']'.'['.$k3.']'.'['.$k4.']']=stripslashes($v4);
										}
									} else {
										$post.=$k.'['.$k2.']'.'['.$k3.']'.'='.urlencode(stripslashes($v3));
										$apost[$k.'['.$k2.']'.'['.$k3.']']=stripslashes($v3);
									}
								}
							} else {
								if ($post) $post.='&';
								$post.=$k.'['.$k2.']'.'='.urlencode(stripslashes($v2));
								$key='['.$k.']['.$k2.']';
								$apost[$k.'['.$k2.']']=stripslashes($v2);
							}
						}

					} else {
						if ($post) $post.='&';
						$post.=$k.'='.urlencode(stripslashes($v));
						$apost[$k]=stripslashes($v);
					}
				}
			}

			if (count($apost) > 0) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $apost); // add POST fields
			}

			$data = curl_exec($ch); // run the whole process
			if (curl_errno($ch)) {
				$this->errno=curl_errno($ch);
				$this->error=curl_error($ch);
				$this->httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
				if (($this->errno==22) && ($this->httpCode=='404')) {
					$this->notify('HTTP Error:'.$this->errno.'/'.$this->error.' at '.$this->_url);
					return false;
				}
				else {
					$this->error('HTTP Error:'.$this->errno.'/'.$this->error.' at '.$this->_url);
					return false;
				}
			}
			$info=curl_getinfo($ch);
			if ( !empty($data) ) {
				$headerLength = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
				$head = trim( substr($data, 0, $headerLength) );
				if ( strlen($data) > $headerLength ) $body = substr( $data, $headerLength );
				else $body = '';
				if ( false !== strpos($head, "\r\n\r\n") ) {
					$headerParts = explode("\r\n\r\n", $head);
					$head = $headerParts[ count($headerParts) -1 ];
				}
				$head = $this->processHeaders($head);
				$headers=$head['headers'];
				$cookies=$head['cookies'];
			} else {
				$headers=array();
				$cookies='';
				$body = '';
				$this->error('An undefined error occured');
				return false;
			}

			if ($cookies) {
				if (!isset($_SESSION[$this->sid])) $_SESSION[$this->sid]=array();
				$_SESSION[$this->sid]['cookies']=$cookies;
			}
			//echo '<br />cookie after='.print_r($_SESSION[$this->sid]['cookies'],true).'=';

			curl_close($ch);

			//remove temporary upload files
			if (count($newfiles) > 0) {
				foreach ($newfiles as $file) {
					unlink($file);
				}
			}

			$this->headers=$headers;
			$this->data=$data;
			$this->cookies=$cookies;
			$this->body=$body;
			if ($headers['content-type']) {
				$this->type=$headers['content-type'];
			}
			if ($this->follow && isset ($headers['location']) && $headers['location']) {
				//echo '<br />redirect to:'.print_r($headers,true);
				//echo '<br />path='.$this->_path;
				$redir=$headers['location'];
				//echo '<br />redir1='.$redir;
				if (strstr($redir,$this->_protocol.'://'.$this->_host.$this->_path)) {
					//do nothing
				} elseif (strstr($this->_protocol.'://'.$this->_host.$redir,$this->_protocol.'://'.$this->_host.$this->_path)) {
					$redir=$this->_protocol.'://'.$this->_host.$redir;
				} elseif (!strstr($redir,$this->_host)) {
					$redir=$this->_protocol.'://'.$this->_host.$this->_path.$redir;
				}
				//echo '<br />redir2='.$redir;
				if (strstr($redir,'&')) $redir.='&';
				elseif (strstr($redir,'?')) $redir.='&';
				else $redir.='?';
				$redir.='wpabspath=0';
				if (!$this->repost) $this->post=array();
				$this->countRedirects++;
				if ($this->countRedirects < 10) {
					if ($redir != $url) {
						return $this->connect($redir,$withHeaders,$withCookies);
					}
				} else {
					$this->error('ERROR: Too many redirects '.$url.' > '.$headers['location'],E_USER_ERROR);
					return false;
				}
			}
			return $body;
		}
	}
}
?>