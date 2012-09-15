<?php
//v1.09.15
?>
<table class="optiontable">

<?php if ($controlpanelOptions) foreach ($controlpanelOptions as $value) {

	$selected=false;
	
	if ($value['type'] == "text" || $value['type'] == "password") { ?>

	<tr align="left"">
		<th scope="row"><?php echo $value['name']; ?>:</th>
		<td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
			type="<?php echo $value['type']; ?>"
			value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } elseif (isset($value['std'])) { echo $value['std']; } ?>"
			size="40"
		/></td>

	</tr>
	<tr">
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>

	<?php } elseif ($value['type'] == "info") { ?>

	<tr align="left">
		<th scope="row"><?php echo $value['name']; ?>:</th>
		<td><?php echo $value['id']; ?>
		</td>
	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>

	<?php } elseif ($value['type'] == "checkbox") { ?>

	<tr align="left">
		<th scope="row"><?php echo $value['name']; ?>:</th>
		<td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
			type="checkbox"
			value="checked"
			<?php if ( get_option( $value['id'] ) != "") { echo " checked"; } ?>
		/></td>

	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>


	<?php } elseif ($value['type'] == "textarea") { ?>
	<tr align="left">
		<th scope="row"><?php echo $value['name']; ?>:</th>
		<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="50"
			rows="8"
		/>
		<?php if ( get_option( $value['id'] ) != "") { echo stripslashes (get_option( $value['id'] )); }
		elseif (isset($value['std'])) { echo $value['std'];
		} ?>
</textarea></td>

	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>

	<?php } elseif ($value['type'] == "select") { ?>

	<tr align="left">
		<th scope="top"><?php echo $value['name']; ?>:</th>
		<td><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $option) { ?>
			<option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
			<?php } ?>
		</select></td>

	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>

	<?php } elseif ($value['type'] == "selectwithkey") { ?>

	<tr align="left">
		<th scope="top"><?php echo $value['name']; ?>:</th>
		<td><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
			<option value="<?php echo $key;?>"
			<?php 
			if (!$selected && get_option($value['id']) && (get_option( $value['id'] ) == $key)) { echo ' selected="selected"'; $selected=true; }
			elseif (!$selected && !get_option($value['id']) && $value['std'] == $key) { echo ' selected="selected"'; $selected=true; }
			?>
			><?php echo $option; ?></option>
			<?php } ?>
		</select></td>

	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;"><?php echo $value['desc']; ?> </div>
		<hr />
	</tr>

	<?php } elseif ($value['type'] == "heading") { ?>

	<tr valign="top">
		<td colspan="2" style="text-align: left;">
		<h2 style="color: green;"><?php echo $value['name']; ?></h2>
		</td>
	</tr>
	<tr>
		<td colspan=2"><div style="width:800px;font-size:smaller;color:red;"><?php echo $value['desc']; ?> </div>
		<hr />
		</td>
	</tr>

	<?php } 
} //end foreach
?>
</table>