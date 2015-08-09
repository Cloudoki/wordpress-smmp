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
	<h2>Social Accounts [should be dynamic]</h2>
	
	<div class="card">
		<h3>Facebook</h3>
		<p class='info'>
			Connect your Facebook account, so you can manage and publish your posts on your timeline. Select the pages you wish to manage from here as well.
		</p>
		
		<input type="button" class="button button-primary button-hero" value="Connect to Facebook">
		
		<hr>
		
		<p>Select your Facebook Pages</p>
		
		<form>
			<ul>
				<li>
					<input type="checkbox" name="fb-page-name">
					Page Name
				</li>
			</ul>
			
			<hr>
			
			<p>Don't feel like connecting right now? Add your Facebook Page link for sharing.</p>
			<input type="url" placeholder="Facebook Page url" />
			
			<hr>
			
			<input type="submit" class="button action" value="Update">
		</form>
		
	</div>
	
	<div class="card">
		<h3>Twitter</h3>
		<p class='info'>
			Connect your Twitter account, so you can manage and publish your tweets on your timeline.
		</p>
		
		<input type="button" class="button button-primary button-hero" value="Connect to Twitter">
		
		<hr>
		
		<form>
			<p>Don't feel like connecting right now? Add your Twitter Account link for sharing.</p>
			<input type="url" placeholder="Twitter Account url" />
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</form>
	</div>
	
	<div class="card">
		<h3>Instagram</h3>
		
		<form>
			<p>Add your Instagram Account link for sharing.</p>
			<input type="url" placeholder="Instagram Account url" />
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</form>
	</div>
	
	<div class="card">
		<h3>Pinterest</h3>
		
		<form>
			<p>Add your Pinterest Collection link for sharing.</p>
			<input type="url" placeholder="Pinterest collection url" />
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</form>
	</div>
	
	<div class="card">
		<h3>Google+</h3>
		
		<form>
			<p>Add your Google+ Page link for sharing.</p>
			<input type="url" placeholder="Google+ page url" />
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</form>
	</div>
	
	<div class="card">
		<h3>LinkedIn</h3>
		
		<form>
			<p>Add your LinkedIn Profile link for sharing.</p>
			<input type="url" placeholder="LinkedIn profile url" />
			
			<hr>
			<input type="submit" class="button action" value="Update">
		</form>
	</div>
</div>