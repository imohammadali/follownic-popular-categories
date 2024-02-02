<?php

/*
 * Plugin Name: Follownic Popular Categories
 * Plugin URI: https://bwawwp.com/my-plugin/
 * Description: Follownic popular Categories in Instagram social
 * Author: Mohammadali Ebrahimzadeh
 * Version: 1.0.1
 * Author URI: https://iammohammadali.ir
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: fn-popular-categories
 * Domain Path: /languages
 */

/**
 * FNPC => [f]ollow[N]ic [P]opular [C]ategories
 */

//prevent directory to access this file
defined('ABSPATH') || exit;

//Define version
define('FNPC_VER', '1.0.1');

//Define absolute path
define('FNPC_PATH', plugin_dir_path(__FILE__));

define('FNPC_CORE_PATH', FNPC_PATH . 'core/');


//Define url path
define('FNPC_Assets', plugin_dir_url(__FILE__) . 'assets/');
define('FNPC_CSS_PATH', FNPC_Assets . 'css/');
define('FNPC_IMAGES_PATH', FNPC_Assets . 'images/');
define('FNPC_JS_PATH', FNPC_Assets . 'js/');
/**
 * Include class file
 */
require(FNPC_CORE_PATH . 'FNPC_Core.php');
/**
 * Instantiate Plugin Core
 */
$FNPCCore = new FNPC_Core(FNPC_VER);
/**
 * Run Plugin Core
 */
$FNPCCore->run();
