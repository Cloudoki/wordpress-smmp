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

<p>The smmp metabox</p>

<form>
	<input type="hidden" name="page" value="<?=$page?>">
	<input type="hidden" name="post_id" value="<?=$the_post['ID']?>">
	<input type="hidden" name="type" value="facebook">
	
	<input type="submit" name="fb" value="Create Facebook Post">
</form>