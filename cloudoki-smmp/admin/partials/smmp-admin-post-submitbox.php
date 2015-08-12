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

<div class="misc-pub-section misc-pub-smmp <?php echo $status_class ?>">
	<label>Publish:</label>
	<ul>
		<li>
			<a class="button smmp-share-button <?php if ($fb_active) echo 'active' ?>">
				<input type="checkbox" name="smmp-share-facebook" value="smmp-facebook" <?php if ($fb_active) echo 'checked' ?>>
				<span class="dashicons dashicons-facebook-alt"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
		<li>
			<a class="button smmp-share-button <?php if ($twt_active) echo 'active' ?>">
				<input type="checkbox" name="smmp-share-twitter" value="smmp-twitter" <?php if ($twt_active) echo 'checked' ?>>
				<span class="dashicons dashicons-twitter"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
	</ul>

</div>