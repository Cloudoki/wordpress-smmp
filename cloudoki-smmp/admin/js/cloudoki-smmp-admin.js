(function( $ ) {
	'use strict';

	$( window ).load(function()
	{
		smmp_admin.init ();
	});

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

})( jQuery );


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
		// Connect buttons
		jQuery('#connect-facebook').on('click', this.connect_facebook);
		jQuery('#connect-twitter').on('click', this.connect_twitter);
	},
	
	connect_facebook: function ()
	{
		
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '637599113043974',
				xfbml      : true,
				version    : 'v2.4'
			});
		};
		
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

	},
	
	connect_twitter: function ()
	{
		
	}	
}

