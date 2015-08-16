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

<div class="wrap smmp-admin-page">
	<h2><?=$title?></h2>
	
	<form action="">
		<input type="hidden" id="page-field" name="page" value="<?=$page?>">
		<input type="hidden" name="admin-update" value="1">
	
		<div class="card">
			
			<?php include $facebook_path; ?>
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
			<span id='fb-disconnect' class="disconnect"></span>
		</div>
		
		<div class="card">
			<h3>Twitter</h3>
			<p class='info'>
				Connect your Twitter account, so you can manage and publish your tweets on your timeline.
			</p>
			
			<input type="button" id="connect-facebook" class="button button-primary button-hero" value="Connect to Twitter">
			
			<hr>
			
			<p>Don't feel like connecting right now? Add your Twitter Account link for sharing.</p>
			<input type="url" placeholder="Twitter Account url" name="smmp_url_twitter" value="<?=$options['smmp_url_twitter']?>" />
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
		</div>
		
		<div class="card">
			<h3>Instagram</h3>
			
			<p>Add your Instagram Account link for sharing.</p>
			<input type="url" placeholder="Instagram Account url" name="smmp_url_instagram" value="<?=$options['smmp_url_instagram']?>" />
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
		</div>
		
		<div class="card">
			<h3>Pinterest</h3>
			
			<p>Add your Pinterest Collection link for sharing.</p>
			<input type="url" placeholder="Pinterest collection url" name="smmp_url_pinterest" value="<?=$options['smmp_url_pinterest']?>" />
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
		</div>
		
		<div class="card">
			<h3>Google+</h3>
				
			<p>Add your Google+ Page link for sharing.</p>
			<input type="url" placeholder="Google+ page url" name="smmp_url_googleplus" value="<?=$options['smmp_url_googleplus']?>" />
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
		</div>
		
		<div class="card">
			<h3>LinkedIn</h3>
			
			<p>Add your LinkedIn Profile link for sharing.</p>
			<input type="url" placeholder="LinkedIn profile url" name="smmp_url_linkedin" value="<?=$options['smmp_url_linkedin']?>" />
			
			<hr>
			<input type="submit" class="button action update_option" value="Update">
		</div>
	</form>
</div>