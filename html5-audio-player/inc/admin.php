<?php

if (!class_exists('H5APAdmin')) {
	class H5APAdmin
	{
		function __construct()
		{
			add_action('admin_enqueue_scripts', [$this, 'adminEnqueueScripts']);
			add_action('admin_menu', [$this, 'adminMenu']);
		}

		function adminEnqueueScripts($hook)
		{
			if (str_contains($hook, 'html5-audio-player')) {
				wp_enqueue_style('h5ap-admin-style', H5AP_PRO_PLUGIN_DIR . 'build/dashboard.css', [], H5AP_PRO_VERSION);

				wp_enqueue_script('h5ap-admin-script', H5AP_PRO_PLUGIN_DIR . 'build/dashboard.js', ['react', 'react-dom',  'wp-components', 'wp-i18n', 'wp-api', 'wp-util', 'lodash', 'wp-media-utils', 'wp-data', 'wp-core-data', 'wp-api-request'], H5AP_PRO_VERSION, true);
				wp_localize_script('h5ap-admin-script', 'h5apDashboard', [
					'dir' => H5AP_PRO_PLUGIN_DIR,
				]);
			}
		}

		function adminMenu()
		{

			add_menu_page(
				__('HTML5 Audio Player', 'h5ap'),
				__('HTML5 Audio Player', 'h5ap'),
				'manage_options',
				'html5-audio-player',
				[$this, 'dashboardPage'],
				H5AP_PRO_PLUGIN_DIR . '/assets/images/icn.png',
				14
			);

			add_submenu_page(
				'html5-audio-player',
				__('Dashboard', 'h5ap'),
				__('Dashboard', 'h5ap'),
				'manage_options',
				'html5-audio-player',
				[$this, 'dashboardPage'],
				0
			);
		}

		function dashboardPage()
		{ ?>
			<div id='h5apAdminDashboard' data-info=<?php echo esc_attr(wp_json_encode([
														'version' => H5AP_PRO_VERSION
													])); ?>></div>
		<?php }

		function upgradePage()
		{ ?>
			<div id='h5apAdminUpgrade'>Coming soon...</div>
<?php }
	}
	new H5APAdmin;
}
