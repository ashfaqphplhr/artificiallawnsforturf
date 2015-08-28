<?php
/*
Plugin Name: Profit Builder Lite
Plugin URI: http://www.imsuccesscenter.com/
Description: Profit Builder Lite is a cut down version of our popular drag and drop editor for Wordpress. With this system you can create incredible layouts on your site with ease with zero coding...
Author: Sean Donahoe
Version: 1.2
Author URI: http://www.imsuccesscenter.com/
*/
if (!function_exists('add_action')) {
	header('Status: 404 Forbidden');
	header('HTTP/1.1 404 Forbidden');
	exit;
}
define('IMSCPB_FILE', __FILE__);
if (version_compare(phpversion(), '5.3', '>=')) {
	global $pbuilder;
	if (!class_exists("ProfitBuilder")) {
		require_once dirname(__FILE__) . '/profit_builder_class.php';
	}
} else {
	if (is_admin()) {
		add_action('admin_notices', 'imscpb_DashboardAlert');
	}
}
function imscpb_DashboardAlert() {
	echo "
    <div class='updated fade'>
        <p style='font-size:18px;'>
            <img src='http://d1ug6aqcpxo8y6.cloudfront.net/ui/images/icons/22/warning.png' style='margin-bottom:-2px;'>&nbsp;&nbsp;
            <strong>WARNING</strong> - ProfitBuilder requires a minimum of PHP 5.3. We have detected your PHP version (" . phpversion() . ") is old and insecure. Please ask your host to upgrade your server to a minimum of 5.3.
        </p>
    </div>";
}
?>