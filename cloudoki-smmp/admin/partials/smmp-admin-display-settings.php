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
	<h2><?=$title?></h2>
	
	<form action="">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="update" value=1>
	
		<div class="card">
			<h3>General Options</h3>
			<!--
			<label for="smmp_short_url"></label>
			<input id="smmp_short_url" name="smmp_short_url" type="text" placeholder="" value="">
			<hr>
			<input type="submit" class="button action" value="Update">
			-->
		</div>
		
		<div class="card">
			<h3>View Options</h3>
			
			<hr>
			<h4>Social on website</h4>
			<ul>
				<li>
					<input id='view-sidebar' name="smmp_view_sidebar" type="checkbox" <?=(int) $options['smmp_view_sidebar']? "checked='checked'": "" ?>>
					<label for='view-sidebar'>Show social icons in sidebar</label>
				</li>
				<li>
					<input id='view-footer' name="smmp_view_footer" type="checkbox" <?=(int) $options['smmp_view_footer']? "checked='checked'": "" ?>>
					<label for='view-footer'>Show social icons in footer</label>
				</li>
			</ul>
			
			<hr>
			<h4>Admin panels</h4>
			<ul>
				<li>
					<input id='view-dashboard' name="smmp_view_dashboard" type="checkbox" <?=(int) $options['smmp_view_dashboard']? "checked='checked'": "" ?>>
					<label for='view-dashboard'>Show Dashboard List</label>
				</li>
				<li>
					<input id='view-submitbox' name="smmp_view_submitbox" type="checkbox" <?=(int) $options['smmp_view_submitbox']? "checked='checked'": "" ?>>
					<label for='view-submitbox'>Show submit box summary</label>
				</li>
			</ul>
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</div>
	</form>
</div>