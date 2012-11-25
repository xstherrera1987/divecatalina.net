<?php 
/**
 * Template Name:  Reservations Template
 * Description: A Page Template that displays the reservation form
 */
get_header();?>

	<div id="content">
		<div id="reservation-form">
			<div id="contact-info">
				<img src="<?php bloginfo('template_directory');?>/images/contactImage.jpg"/>
				<p>
					Developer Drive <br/> 
					123 Fake St. <br/>
					Long Beach, CA 94014 <br/>
					P: 562-999-9999 <br/>
					F: 562-111-1111 <br/>
					© Ron Moore <br/>
				</p>
			</div>

			<form id="form" action="/" method="post">	
				<h3>Make a reservation today!</h3>
		
				<fieldset><legend>Reservation form</legend>
					<p class="first">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" size="30" />
					</p>
					<p>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" size="30" />
					</p>
					<p>
						<label for="phone">Phone</label>
						<input type="text" name="web" id="web" size="30" />
					</p>																					
					<p>
						<label for="message">Message</label>
						<textarea name="message" id="message" cols="30" rows="10"></textarea>
					</p>					
					
					<p class="submit"><button type="submit">Send</button></p>				
				</fieldset>					
			</form>	
	    </div>
	    <div class="clear"></div>
	</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
