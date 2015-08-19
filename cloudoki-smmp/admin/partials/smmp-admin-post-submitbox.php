<?php

/**
 * Provide buttons in the edit post publishbox
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/admin/partials
 */
?>

<div class="misc-pub-section misc-pub-smmp <?=$status_class?>">
	<label>Publish:</label>
	<ul>
		<li>
			<a class="button smmp-share-button <?=$facebook_active_class?>">
				<input name="smmp-facebook-id" value="<?=$facebook_id?>">
				<input type="checkbox" name="smmp-share-facebook" value="<?=$facebook_active?>" <?=$facebook_checked?>>
				<span class="dashicons dashicons-facebook-alt"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
		<li>
			<a class="button smmp-share-button <?=$twitter_active_class?>">
				<input name="smmp-twitter-id" value="<?=$twitter_id?>">
				<input type="checkbox" name="smmp-share-twitter" value="<?=$twitter_active?>" <?=$twitter_checked?>>
				<span class="dashicons dashicons-twitter"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
	</ul>

</div>

<script type="text/javascript">

	jQuery(document).ready(function()
	{
		smmp_admin.init_post_functions ();
	});
</script>