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
			<a class="button smmp-share-button <?=$fb_active_class?>">
				<input type="checkbox" name="smmp-share-facebook" value="<=$fb_active?>" <?=$fb_checked?>>
				<span class="dashicons dashicons-facebook-alt"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
		<li>
			<a class="button smmp-share-button <?=$twt_active_class?>">
				<input type="checkbox" name="smmp-share-twitter" value="<?=$twt_active?>" <?=$twt_checked?>>
				<span class="dashicons dashicons-twitter"></span>
				<div class="pub-status">
					<span class="dashicons dashicons-yes"></span>
				</div>
			</a>
		</li>
	</ul>

</div>