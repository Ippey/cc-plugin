<?php
/**
 * Plugin Name: Cc-plugin
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: cc-plugin
 * Domain Path: /languages
 * @package Cc-plugin
 */

include_once("AkiyoshiShopManager.php");
$manager = new AkiyoshiShopManager();
$manager->register();