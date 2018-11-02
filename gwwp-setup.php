<?php
return [
	'theme_settings' => [ // Define here anything you want for this specific theme. Those are accessible from global variable $gwwp->options

	],
	'general_settings' => [
		'project_version' => "1.0", // Remember to update this always when creating Git release tag
		'hide_update_nags' => true, // Makes best effort to hide all update nags
		'disable_cookie_warning' => false, // Force disable Cookie Warning
		'clear_html_head' => true, // Clears stuff from html <head> that is not needed
		'hide_admin_bar' => false, // Hides admin bar from frontend
		'enqueue_scripts_in_footer' => true, // Enqueues app.js and scripts defined in this file to footer instead of head
		'hide_admin_menus' => [ // Modify here admin menu items you want to hide
			'cctm',
			'edit.php',
			'edit-comments.php',
			'tools.php', 
			'ot-settings', 
			'options-general.php', 
			'themes.php', 
			'plugins.php', 
			'wpseo_dashboard',
			'cptui_main_menu',
			'edit.php?post_type=acf-field-group'
		],
		'hide_dashboard_widgets' => [ // Modify here custom admin dashboard items you want to hide
			'dashboard_activity', 
			'dashboard_right_now',
			'dashboard_recent_comments', 
			'dashboard_incoming_links',
			'dashboard_plugins', 
			'dashboard_quick_press', 
			'dashboard_recent_drafts', 
			'dashboard_primary', 
			'dashboard_secondary', 
			'wpseo-dashboard-overview',
		],
	],
];
