	<hr/>
    <footer>
    	<ul class="bottomnav-ul">
			<?php
				wp_nav_menu(array(
				'items_wrap' => '%3$s', 
				'depth' => 2, 
				'theme_location' => 'mainnav-menu', 
				'container' => '',
				'link_before'  => '<p class="bottomnav">',
				'link_after'   => '</p>',
				'fallback_cb' => 'build_navmenu3'));
			?>
		</ul>
		
		<div id="footerContact">
			<p id="address"> Developer Drive <br/>
				123 Fake St. <br/>
				Long Beach, CA 94014 <br/>
				P: 562-999-9999<br/>
				F: 562-111-1111 <br/>
				&copy; Ron Moore
			</p>
		</div>      
    </footer>
</div>
</body>
</html>
