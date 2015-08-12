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

	if(isset ($facebook->pages)) { ?>
		
		<p>Select your Facebook Pages</p>
	
		<ul>
			<?php foreach ($facebook->pages as $page) { ?>
			<li>
				<input type="checkbox" name="fb-<?=$page->name?>" value="<?=$page->active?>">
				<?=$page->name?>
			</li>
		</ul>
	
	<?php }} ?>
