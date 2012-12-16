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
			<p id="address"> Dive Catalina <br/>
				107 Pebbly Beach Rd. <br/>
				Avalon, Ca 90704 <br/>
				P: 310-510-3175<br/> 
				P: 562-472-4503 (Ron)<br/>
				P: 562-472-4583 (Connie)<br/>
				E: ron@divecatalina.net<br/>
				&copy; Ron Moore
			</p>
		</div>      
    </footer>
</div>

<?php wp_footer(); ?>
	<?php /* load JS as late as possible */?>
	<?php /* animated navigation */?>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/nav.js"></script>
</body>
</html>
