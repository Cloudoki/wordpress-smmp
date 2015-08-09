<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/admin/partials
 */
?>

<div class="wrap">
	<h2>SMMP Settings [should be dynamic]</h2>
	
	<div class="card">
		<h3>General Options</h3>
		<!--<form>
			<label for="smmp_short_url"></label>
			<input id="smmp_short_url" name="smmp_short_url" type="text" placeholder="" value="">
			<input type="submit" value="Update">
		</form>-->
	</div>
	
	<div class="card">
		<h3>View Options</h3>
		
		<hr>
		<h4>Social on website</h4>
		<ul>
			<li>
				<input name='view-sidebar' id='view-sidebar' type="checkbox" value='1'>
				<label for='view-sidebar'>Show social icons in sidebar</label>
			</li>
			<li>
				<input name='view-footer' id='view-footer' type="checkbox" value='1'>
				<label for='view-footer'>Show social icons in footer</label>
			</li>
		</ul>
		
		<hr>
		<h4>Admin panels</h4>
		<ul>
			<li>
				<input name='view-dashboard' id='view-dashboard' type="checkbox" value='1'>
				<label for='view-dashboard'>Show Dashboard List</label>
			</li>
			<li>
				<input name='view-submitbox' id='view-submitbox' type="checkbox" value='1'>
				<label for='view-submitbox'>Show submit box summary</label>
			</li>
		</ul>
	</div>
	
	
</div>