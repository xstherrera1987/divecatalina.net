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
				<?php 
				the_post();
				the_content(); ?>
			</div>

			<form id="form" action="<?php bloginfo('template_directory');?>/sendreservation.php" method="post">	
				<h3>Make a reservation today!</h3>
		
				<fieldset><legend>Reservation form</legend>
					<p>
						<label for="name">Name: <em>*</em></label>
						<input type="text" name="name" id="name" value="" class="required" role="input" aria-required="true" size="30" />
					</p>
					<p>
						<label for="email">Email: <em>*</em></label>
						<input type="text" name="email" id="email" value="" class="required email" role="input" aria-required="true" size="30" />
					</p>
					<p>
						<label for="phone">Phone: <em>*</em></label>
						<input type="text" name="phone" id="phone" value="" class="required" role="input" aria-required="true" size="30" />
					</p>		
					<p>
						<label for="message">Message: <em>*</em></label>
						<textarea name="message" id="message" class="required" roles="textbox" aria-required="true" cols="30" rows="10"></textarea>
					</p>					
					
					<p class="requiredNote"><em>*</em> Denotes a required field.</p>

					<p class="submit"><button type="submit">Send</button></p>				
				</fieldset>					
			</form>	
	    </div>
	    <div class="clear"></div>
	</div>
		
<?php get_sidebar(); ?>
	<?php /* load JS as late as possible */?>
	<?php /* reservation form validation code */?>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/reservation.js"></script>
<?php get_footer(); ?>

