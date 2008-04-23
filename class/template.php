<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code 
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Template class for ThAdmin mdoule
 *
 * @copyright   The XOOPS Project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     ThAdmin
 * @since       2.3.0
 * @author      Kazumi Ono 	<onokazu@xoops.org>
 * @author      Andricq Nicolas (AKA MusS)
 * @version     $Id: cp_functions.php 1459 2008-04-18 10:26:53Z phppp $
 */

if (!defined('SMARTY_DIR')) exit();

/**
 * Base class: Smarty template engine
 */
require_once SMARTY_DIR.'Smarty.class.php';

class AdminTpl extends Smarty {

  	var $left_delimiter  = '<{';
  	var $right_delimiter = '}>';

  	var $template_dir = XOOPS_THEME_PATH;
  	var $cache_dir    = XOOPS_CACHE_PATH;
  	var $compile_dir  = XOOPS_COMPILE_PATH;

    function __construct()
    {
    		global $xoopsConfig;

    		$this->compile_check = ( $xoopsConfig['theme_fromfile'] == 1 );
    		$this->plugins_dir = array(
    			XOOPS_ROOT_PATH . '/class/smarty/xoops_plugins',
    			XOOPS_ROOT_PATH . '/class/smarty/plugins',
    		);
    		if ( $xoopsConfig['debug_mode'] ) {
            $this->debugging_ctrl = 'URL';
    		    if ( $xoopsConfig['debug_mode'] == 3 ) {
                $this->debugging = true;
    		    }
    		}
    		$this->Smarty();

    		$this->assign( array(
    			'xoops_url'        => XOOPS_URL,
    			'xoops_rootpath'   => XOOPS_ROOT_PATH,
    			'xoops_langcode'   => _LANGCODE,
    			'xoops_charset'    => _CHARSET,
    			'xoops_version'    => XOOPS_VERSION,
    			'xoops_upload_url' => XOOPS_UPLOAD_URL
    		));
    }
    
    function XoopsGuiThadmin()
    {
        $this->__construct();
    }

  	/**
  	 * Renders output from template data
  	 *
  	 * @param   string  $data		The template to render
  	 * @param	bool	$display	If rendered text should be output or returned
  	 * @return  string  Rendered output if $display was false
  	 **/
    function fetchFromData( $tplSource, $display = false, $vars = null )
    {
        if( !function_exists('smarty_function_eval') ) {
            require_once SMARTY_DIR . '/plugins/function.eval.php';
        }
      	if ( isset( $vars ) ) {
            $oldVars = $this->_tpl_vars;
            $this->assign( $vars );
  	        $out = smarty_function_eval( array('var' => $tplSource), $this );
          	$this->_tpl_vars = $oldVars;
          	return $out;
      	}
        return smarty_function_eval( array('var' => $tplSource), $this );
    }

    function touch( $resourceName ) 
    {
      	$isForced = $this->force_compile;
      	$this->force_compile = true;
      	$this->clear_cache( $resourceName );
      	$result = $this->_compile_resource( $resourceName, $this->_get_compile_path( $resourceName ) );
      	$this->force_compile = $isForced;
      	return $result;
    }

}
?>