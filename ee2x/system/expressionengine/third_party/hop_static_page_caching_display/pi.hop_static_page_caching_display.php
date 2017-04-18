<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name'			=> 'Hop static page caching display',
  'pi_version'		=> '1.0',
  'pi_author' 		=> 'Louis Dekeister (Hop Studios)',
  'pi_author_url' 	=> 'http://www.hopstudios.com/software/',
  'pi_description' 	=> 'Display tag content only when page is viewed by the Static Page Caching module',
  'pi_usage' 		=> Hop_static_page_caching_display::usage()
);

/**
 * Hop_static_page_caching_display Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Louis Dekeister (Hop Studios)
 * @copyright		Copyright (c) 2017, Hopstudios
 * @link			http://www.hopstudios.com/software
 */

class Hop_static_page_caching_display
{

	public $return_data = "";
	
	// constructor
	function __construct() 
	{
		ee()->load->library('logger');

		if (
			array_key_exists('HTTP_USER_AGENT', $_SERVER) 
			&& substr($_SERVER['HTTP_USER_AGENT'], 0, 19) == 'Static Page Caching'
		)
		{
			// ee()->logger->developer('Hop_SPCD: Display content on '.$_SERVER['REQUEST_URI'].' ('.$_SERVER['HTTP_USER_AGENT'].')');
			$this->return_data = ee()->TMPL->tagdata;
		}
	}

	// ----------------------------------------
	//  Plugin Usage
	// ----------------------------------------

	// This function describes how the plugin is used.
	//  Make sure and use output buffering

	public static function usage()
	{
		ob_start(); 
		?>

This plugin will display the content only if the page is requested by the Static Page Caching add-on. The content will then be in the cached version of the page.

Usage:
======

{exp:hop_static_page_caching_display}

My content that's to be displayed on the cached version of the page only

{/exp:hop_static_page_caching_display}

		<?php
		$buffer = ob_get_contents();
			
		ob_end_clean(); 

		return $buffer;
	}
	// END

}

/* End of file edit_this.php */
