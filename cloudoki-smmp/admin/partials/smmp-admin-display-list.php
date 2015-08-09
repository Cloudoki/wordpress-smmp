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

	<h2>
		[Title should be dynamic]
		<!--<a href="#" class="add-new-h2">Add New</a>-->
	</h2>
	
	<ul class="subsubsub">
		<li class="all"><a href="#" class="current">All <span class="count">(n)</span></a> |</li>
		<li class="publish"><a href="#">Pending <span class="count">(n)</span></a> |</li>
		<li class="publish"><a href="#">Published <span class="count">(n)</span></a></li>
	</ul>
	<form id="posts-filter" method="get">
	
		<!--
		<p class="search-box">
			<label class="screen-reader-text" for="post-search-input">Search Social Posts:</label>
			<input type="search" id="post-search-input" name="s" value="">
			<input type="submit" id="search-submit" class="button" value="Search Social Posts">
		</p>
		-->
		
		<div class="tablenav top">
		
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
				<select name="action" id="bulk-action-selector-top">
					<option value="-1" selected="selected">Bulk Actions</option>
					<option disabled='disabled' value="edit" class="hide-if-no-js">Edit</option>
					<option disabled='disabled' value="trash">Delete</option>
				</select>
				<input disabled="disabled" type="submit" id="doaction" class="button action" value="Apply">
			</div>
			<div class="alignleft actions">
				<label for="filter-by-date" class="screen-reader-text">Filter by date</label>
				<select name="m" id="filter-by-date">
					<option selected="selected" value="0">All dates</option>
					<option value="201508">August 2015</option>
				</select>
				<input disabled="disabled" type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
			</div>
			
			<div class="tablenav-pages one-page">
				<span class="displaying-num">N items</span>
				<span class="pagination-links">
					<a class="first-page disabled" title="Go to the first page" href="http://damn.local/wp-admin/edit.php?post_type=product">«</a>
					<a class="prev-page disabled" title="Go to the previous page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">‹</a>
					<span class="paging-input">
						<label for="current-page-selector" class="screen-reader-text">Select Page</label>
						<input class="current-page" id="current-page-selector" title="Current page" type="text" name="paged" value="1" size="1"> of 
						<span class="total-pages">1</span>
					</span>
					<a class="next-page disabled" title="Go to the next page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">›</a>
					<a class="last-page disabled" title="Go to the last page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">»</a>
				</span>
			</div>
			<input type="hidden" name="mode" value="list">
			<br class="clear">
		</div>
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<th scope="col" id="cb" class="manage-column column-cb check-column" style="">
						<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
						<input id="cb-select-all-1" type="checkbox"></th><th scope="col" id="title" class="manage-column column-title sortable desc" style="">
						<a href="http://damn.local/wp-admin/edit.php?post_type=product&amp;orderby=title&amp;order=asc">
							<span>Title</span><span class="sorting-indicator"></span>
						</a>
					</th>
					<th scope="col" id="tags" class="manage-column column-tags" style="">Tags</th>
					<th scope="col" id="date" class="manage-column column-date sortable asc" style="">
						<a href="http://damn.local/wp-admin/edit.php?post_type=product&amp;orderby=date&amp;order=desc">
							<span>Date</span><span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</thead>
			<tbody id="the-list">
				<tr id="post-21" class="iedit author-self level-0 post-21 type-product status-publish has-post-thumbnail hentry">
					<th scope="row" class="check-column">
						<label class="screen-reader-text" for="cb-select-21">Select A test post</label>
						<input id="cb-select-21" type="checkbox" name="post[]" value="21">
						<div class="locked-indicator"></div>
					</th>
					<td class="post-title page-title column-title">
						<strong><a class="row-title" href="http://damn.local/wp-admin/post.php?post=21&amp;action=edit" title="Edit “A test product”">A test post
						</a></strong>
						<div class="locked-info">
							<span class="locked-avatar"></span> <span class="locked-text"></span>
						</div>
						<div class="row-actions">
							<span class="edit"><a href="http://damn.local/wp-admin/post.php?post=21&amp;action=edit" title="Edit this item">Edit</a> | </span>
							<span class="inline hide-if-no-js"><a href="#" class="editinline" title="Edit this item inline">Quick&nbsp;Edit</a> | </span>
							<span class="trash"><a class="submitdelete" title="Move this item to the Trash" href="http://damn.local/wp-admin/post.php?post=21&amp;action=trash&amp;_wpnonce=c9a9e7894f">Trash</a> | </span>
							<span class="view"><a href="http://damn.local/product/a-test-product/" title="View “A test product”" rel="permalink">View</a></span>
						</div>
						<div class="hidden" id="inline_21">
							<div class="post_title">A test product</div>
							<div class="post_name">a-test-product</div>
							<div class="post_author">1</div>
							<div class="comment_status">closed</div>
							<div class="ping_status">closed</div>
							<div class="_status">publish</div>
							<div class="jj">03</div>
							<div class="mm">08</div>
							<div class="aa">2015</div>
							<div class="hh">11</div>
							<div class="mn">28</div>
							<div class="ss">30</div>
							<div class="post_password"></div>
							<div class="tags_input" id="post_tag_21"></div>
							<div class="tags_input" id="magazine_21"></div>
							<div class="sticky"></div>
						</div>
					</td>
					<td class="tags column-tags">—</td>
					<td class="date column-date"><abbr title="2015/08/03 11:28:30 am">2015/08/03</abbr><br>Published</td>
				</tr>
			</tbody>
	
			<tfoot>
				<tr>
					<th scope="col" class="manage-column column-cb check-column" style="">
						<label class="screen-reader-text" for="cb-select-all-2">Select All</label>
						<input id="cb-select-all-2" type="checkbox">
					</th>
					<th scope="col" class="manage-column column-title sortable desc" style="">
						<a href="http://damn.local/wp-admin/edit.php?post_type=product&amp;orderby=title&amp;order=asc">
							<span>Title</span><span class="sorting-indicator"></span>
						</a>
					</th>
					<th scope="col" class="manage-column column-tags" style="">Tags</th>
					<th scope="col" class="manage-column column-date sortable asc" style="">
						<a href="http://damn.local/wp-admin/edit.php?post_type=product&amp;orderby=date&amp;order=desc">
							<span>Date</span><span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</tfoot>
	
		</table>
		<div class="tablenav bottom">
	
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label>
				<select name="action2" id="bulk-action-selector-bottom">
					<option value="-1" selected="selected">Bulk Actions</option>
					<option value="edit" class="hide-if-no-js">Edit</option>
					<option value="trash">Delete</option>
				</select>
				<input disabled="disabled" type="submit" id="doaction2" class="button action" value="Apply">
			</div>
	
			<div class="tablenav-pages one-page">
				<span class="displaying-num">N items</span>
				<span class="pagination-links">
					<a class="first-page disabled" title="Go to the first page" href="http://damn.local/wp-admin/edit.php?post_type=product">«</a>
					<a class="prev-page disabled" title="Go to the previous page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">‹</a>
					<span class="paging-input">1 of <span class="total-pages">1</span></span>
					<a class="next-page disabled" title="Go to the next page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">›</a>
					<a class="last-page disabled" title="Go to the last page" href="http://damn.local/wp-admin/edit.php?post_type=product&amp;paged=1">»</a>
				</span>
			</div>
			<br class="clear">
		</div>
	</form>

	<div id="ajax-response"></div>
	<br class="clear">
</div>