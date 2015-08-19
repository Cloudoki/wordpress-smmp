//(function( $ ) {
//	'use strict';

	//$( window ).load(function()
	

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

//})( jQuery );

jQuery(document).ready(function()
{
	//smmp_admin.init ();
});


/**
 *	The SMMP Admin class
 *	
 *	Connect to social accounts, perform async actions
 *	and 
 */
var smmp_admin = 
{
	init : function ()
	{		
		// load Facebook
		jQuery.ajaxSetup({ cache: true });
		jQuery.getScript('//connect.facebook.net/en_US/sdk.js', smmp_admin.init_facebook);
	},

	init_post_functions: function() 
	{
		// Connect and publish buttons
		jQuery('#connect-twitter').on('click', this.connect_twitter);
		jQuery('.misc-pub-smmp.pending .smmp-share-button').click(function(){smmp_admin.toggle_smmp_share(jQuery(this))});
	},
	
	init_facebook : function ()
	{

		FB.init({
			appId: '637599113043974',
			version: 'v2.4'
		});
		
		FB.getLoginStatus(function(response)
		{
			var connect = (response.status === 'connected');
			
			if(connect) smmp_admin.userid = response.authResponse.userID;
			
			smmp_admin.display_facebook_logged_out(!connect);
			smmp_admin.display_facebook_details(connect);
		});	
	},
	
	display_facebook_logged_out: function (show)
	{
		if(show)
			
			jQuery('#facebook-logged-out')
				.removeClass('display-hidden')
				
				.find('#connect-facebook')
					.removeAttr('disabled')
					.on('click', this.connect_facebook);
		else 
			
			jQuery('#facebook-logged-out').addClass('display-hidden');
	},
	
	display_facebook_details: function (show)
	{
		// display
		var details = jQuery('#facebook-details')[show? 'removeClass': 'addClass']('display-hidden');
		
		// compare data
		if (show) FB.api('/me/accounts', this.map_facebook_info.bind(this, details));	
		
	},
	
	map_facebook_info: function (details, res)
	{
		var pass = true;
		
		// Basic profile
		if(!details.data('fb-profile'))
			
			FB.api('/me', function(me)
			{
				details.find('#fb-profile').attr('name', 'facebook-profile').val (me.name);
				details.find('#fb-id').attr('name', 'facebook-id').val (me.id);
				jQuery('form').submit();
				
			}.bind(this));
			
		// Disconnect option
		jQuery('#fb-disconnect').append('disconnect');
		
		// Pages comparison
		details.find('ul input').each(function(n, entry)
		{
			pass = false;
			res.data.forEach(function(page)
			{
				var slug = 'fb-' + convertToSlug(page.name);
				
				if(slug == entry.id) page.displayed = pass = true;
				
			}.bind(this));
			
			if (!pass) jQuery(entry).attr('disabled','disabled').removeAttr('checked');
		});
		
		// template
		var li = jQuery('#fb-page-template').clone().removeClass('display-hidden');
		
		// Pages implementation
		res.data.forEach(function(page)
		{
			if(!page.displayed)
			{
				var slug = 'fb-' + convertToSlug(page.name);
				
				li.find('input').attr('name', slug).attr('id', slug).val(page.access_token);
				li.find('label').attr('for', slug).html(page.name);
				li.find('span').attr('data-target', slug);
				
				details.find('ul').append (li.clone());				
			}
		});
		
		// activate primaries
		details.find('.primary-label-button').on('click', this.toggle_facebook_primary);		
	},
	
	toggle_facebook_primary: function ()
	{
		var button = jQuery(this);
		var state = !button.hasClass('active');
		
		// deactivate other buttons
		button.parents('ul').find('.primary-label-button.active').removeClass('active');
		
		// switch defaults
		jQuery('#fb-default-primary')[state? 'addClass': 'removeClass']('display-hidden');
		jQuery('#fb-primary').attr('name', 'facebook-primary').val(state? button.data('target'): '');
		
		// Toggle on
		if(state) 
		
			button.addClass ('active').parent().find('input').attr('checked', 'checked');
	},
	
	connect_facebook: function ()
	{
		FB.login(function(response){ console.log(response) }, {scope: 'public_profile,publish_actions,manage_pages,publish_pages'});
	},
	
	connect_twitter: function ()
	{
		
	},	

	toggle_smmp_share: function(button)
	{
		button.toggleClass('active');
		button.find('input').prop("checked", button.hasClass('active')).val(button.hasClass('active'));
	}
}

function convertToSlug(Text)
{
	return Text
		.toLowerCase()
		.replace(/ /g,'-')
		.replace(/[^\w-]+/g,'');
}

