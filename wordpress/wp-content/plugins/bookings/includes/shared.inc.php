<?php
function bookings_create_api_key($namespace = '') {
	$key = '';
	$uid = uniqid(home_url(), false);
	$data = $namespace;
	$data=serialize($_SERVER);
	$hash = strtoupper(hash('ripemd128', $uid . $key . md5($data)));
	$key = substr($hash,  0,  8) .
            '-' .
	substr($hash,  8,  4) .
            '-' .
	substr($hash, 12,  4) .
            '-' .
	substr($hash, 16,  4) .
            '-' .
	substr($hash, 20, 12);
	return $key;
}

function bookings_create_secret($namespace = '') {
	$secret = '';
	$uid = uniqid(home_url(), false);
	$data = $namespace;
	$data=serialize($_SERVER);
	$secret = hash('crc32', $uid . $secret . md5($data));
	return $secret;
}
