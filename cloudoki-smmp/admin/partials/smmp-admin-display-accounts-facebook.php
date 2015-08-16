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
 */ ?>

	<h3>Facebook</h3>
			
	<div id="facebook-logged-out">
	
		<p class='info'>
			Connect your Facebook account, so you can manage and publish your posts on your timeline. Select the pages you wish to manage from here as well.
		</p>
	
		<input type="button" id="connect-facebook" class="button button-primary button-hero" value="Connect to Facebook" disabled="disabled">
	
		<hr>
		
		<p>Don't feel like connecting right now? Add your Facebook Page link for sharing.</p>
		<input type="url" placeholder="Facebook Page url" name="smmp_url_facebook" value="<?=$options['smmp_url_facebook']?>" />
	</div>
		
	<div id="facebook-details" class="display-hidden" data-fb-profile="<?=$facebook->profile?>">
		
		<input type="hidden" id="fb-profile">
		<input type="hidden" id="fb-id">
		<input type="hidden" id="fb-primary" value="<?=$facebook->primary?>">
		
		<p>Select your Facebook Pages</p>
		
		<ul>
			<?php if(isset ($facebook->pages))
				
			foreach ($facebook->pages as $slug => $page) { ?>
			<li class='facebook-page'>
				<input type="checkbox" name="<?=$slug?>" id="<?=$slug?>" checked="checked">
				<span data-target="<?=$slug?>" class="primary-label-button right<?=$slug==$facebook->primary? ' active':null?>">primary</span>
				<label for="<?=$slug?>"><?=$page->name?></label>
			</li>
			<?php } ?>
		</ul>
		
		<!-- template -->
		<li id="fb-page-template" class="display-hidden facebook-page">
			<input type="checkbox">
			<span class="primary-label-button right">primary</span>
			<label></label>
		</li>
		
		<p id="fb-default-primary" class="info<?=$facebook->primary? ' display-hidden':null?>">
			Your Facebook profile is the primary selection.
		</p>
	</div>