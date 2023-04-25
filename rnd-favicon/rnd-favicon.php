<?php

/**
 * RND Favicon
 *
 * @package           RNDCorePlugins
 * @author            Developer Dilantha
 * @copyright         2021-2023 RND Innovations
 * @license           GPL-2.0-or-later
 *
 * @rnd-plugin
 * Plugin Name:       RND Favicon
 * Plugin URI:        https://rnd.rodee.ca/core-plugins
 * Description:       This plugin will add a favicon and other important visual icons to the head.
 * Version:           1.2.0
 * Requires at least: 1.0.0
 * Requires PHP:      8.1
 * Author:            Dilantha
 * Author URI:        https://www.dilantha.org
 * Text Domain:       dilantha
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Generate Favicon from : https://www.favicon-generator.org/
// Learn More: https://evilmartians.com/chronicles/how-to-favicon-in-2021-six-files-that-fit-most-needs
// Learn More: https://sympli.io/blog/heres-everything-you-need-to-know-about-favicons-in-2020/


define( "RND_FAVICON_THEME_COLOR", "#D9221C" );
define( "RND_FAVICON_BACKG_COLOR", "#ffffff" );


function rnd_favicon_add_image($items) {

    $path   = APP_TMPL_URL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/logos';
    
    $str = '<link rel="icon" type="image/png" href="'.$path.'/favicon.ico" sizes="16x16">'; 
    
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-16x16.png" sizes="16x16">';    
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-32x32.png" sizes="32x32">'; 
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-96x96.png" sizes="96x96">';
    
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-57x57.png" sizes="57x57" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-60x60.png" sizes="60x60" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-72x72.png" sizes="72x72" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-76x76.png" sizes="76x76" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-114x114.png" sizes="114x114" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-120x120.png" sizes="120x120" >';    
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-144x144.png" sizes="144x144" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-152x152.png" sizes="152x152" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-180x180.png" sizes="180x180" >';
    
    // Manifest File for Android/Chrome
    $str .= '<link rel="manifest" href="'.APP_URL.'/manifest.json" >';
    
    $str .= '<meta name="msapplication-config" content="'.APP_URL.'/browserconfig.xml" />';
    
    $str .= '<meta name="theme-color" content="'.RND_FAVICON_THEME_COLOR.'"/>';
    
	return $items.$str;
}
add_filter('page_head', 'rnd_favicon_add_image');


    // Generate browserconfig.xml for IE/EDGE
    if( isset($amp[0]) && $amp[0] == "browserconfig.xml" ){
        header("Content-Type: text/xml");

        $xml_path  = __DIR__ . '/' . $amp[0];
        $xml       = get_file_contents_from_a_file( $xml_path );
        $path      = APP_TMPL_URL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/logos';
        
        $xml       = str_replace("{{ICON-PATH}}", $path , $xml);
        $xml       = str_replace("{{BACKG-COLOR}}", RND_FAVICON_BACKG_COLOR , $xml);        

        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo $xml; exit;
    }


    // Generate Web Manifest file
    if( isset($amp[0]) && $amp[0] == "manifest.json" ){
        header("Content-Type: application/manifest+json");

        $json_path  = __DIR__ . '/' . $amp[0];
        $json       = get_file_contents_from_a_file( $json_path );
        
        $json       = str_replace("{{SITE-NAME}}", SITE_NAME , $json);
        $json       = str_replace("{{SITE-SHORT}}", SITE_NAME , $json);
        $json       = str_replace("{{SITE-DESCRIPTION}}", SITE_TAG , $json);
        $json       = str_replace("{{SITE-URL}}", APP_URL , $json);
        $json       = str_replace("{{SITE-SCOPE}}", "/" , $json);
       
        $json       = str_replace("{{BACKG-COLOR}}", RND_FAVICON_BACKG_COLOR , $json);
        $json       = str_replace("{{THEME-COLOR}}", RND_FAVICON_THEME_COLOR , $json);
        
        $path       = APP_TMPL_URL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/logos';
        $json       = str_replace("{{ICON-PATH}}", $path , $json);
        
        echo $json; exit;
    }