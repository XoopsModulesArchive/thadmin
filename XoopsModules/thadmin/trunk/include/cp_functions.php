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
 * Custom cp_functions from ThAdmin by Andricq Nicolas (AKA MusS)
 *
 * @copyright   The XOOPS Project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     ThAdmin
 * @since       2.3.0
 * @author      Andricq Nicolas (AKA MusS)
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @version     $Id: cp_functions.php 1459 2008-04-18 10:26:53Z phppp $
 */

define('XOOPS_THADMIN_CPFUNC_LOADED', 1);

include_once XOOPS_ROOT_PATH.'/class/template.php';

function xoops_thadmin_cp_header()
{
    global $xoopsOption, $xoopsConfig, $xoopsModule, $xoopsLogger, $xoopsUser;
    ob_start();
    if (!defined('_AD_TH_CPFUNCTION')) {
        define('_AD_TH_CPFUNCTION', 1);
    }

    // Include system admin language
    if(file_exists(XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin.php')){
        include_once XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin.php';
        include_once XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/cpanel.php';
    } else {
        include_once XOOPS_ROOT_PATH.'/modules/system/language/english/admin.php';
        include_once XOOPS_ROOT_PATH.'/modules/system/language/english/cpanel.php';
    }
    // Include module admin language
    if (file_exists(XOOPS_ROOT_PATH.'/modules/thadmin/language/'.$xoopsConfig['language'].'/admin.php')) {
        include_once XOOPS_ROOT_PATH.'/modules/thadmin/language/'.$xoopsConfig['language'].'/admin.php';
    } else {
        include_once XOOPS_ROOT_PATH.'/modules/thadmin/language/english/admin.php';
    }
    // Include module fonction
    include_once XOOPS_ROOT_PATH.'/modules/thadmin/include/functions.php';
    $theme_name = thadmin_Setting('theme_admin_set');
    if ($theme_name == '' || !is_dir(XOOPS_ROOT_PATH.'/modules/thadmin/themes/'.$theme_name)) {
        $theme_name = 'default';
    }
    
    if ( !isset( $xoopsLogger ) ) {
        $xoopsLogger =& $GLOBALS['xoopsLogger'];
    }
    $xoopsLogger->stopTime( 'Module init' );
    $xoopsLogger->startTime( 'XOOPS output init' );

    // include Smarty template engine and initialize it
    require_once XOOPS_ROOT_PATH.'/modules/thadmin/class/template.php';
    require_once XOOPS_ROOT_PATH.'/modules/thadmin/class/theme.php';
    
    if ( @$xoopsOption['template_main'] ) {
      if ( false === strpos( $xoopsOption['template_main'], ':' ) ) {
        $xoopsOption['template_main'] = 'db:' . $xoopsOption['template_main'];
      }
    }
    $adminThemeFactory =& new xoAdminThemeFactory();
    $adminThemeFactory->allowedThemes = $theme_name;
    $adminThemeFactory->defaultTheme = $theme_name;

    $xoTheme =& $adminThemeFactory->createInstance( array(
      'contentTemplate' => @$xoopsOption['template_main'],));
    $adminTpl =& $xoTheme->template;
    
    $xoTheme->path = XOOPS_ROOT_PATH.'/modules/thadmin/themes/'.$theme_name;
    $xoTheme->url  = XOOPS_URL.'/modules/thadmin/themes/'.$theme_name;
    $xoTheme->addScript( '/include/xoops.js', array( 'type' => 'text/javascript' ) );

    

    $xoopsLogger->stopTime( 'XOOPS output init' );
    $xoopsLogger->startTime( 'Module display' );
       
    // Initialize group permission handler
    $moduleperm_handler =& xoops_gethandler('groupperm');
    $admin_mids = $moduleperm_handler->getItemIds('module_admin', $xoopsUser->getGroups());
    // Initialize module handler
    $module_handler =& xoops_gethandler('module');
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('hasadmin', 1));
    $criteria->add(new Criteria('isactive', 1));
    $criteria->add(new Criteria('mid', "(".implode(',', $admin_mids).")", 'IN'));
    $criteria->setSort('name');
    $modules = $module_handler->getObjects($criteria, true);
    //load module items
    $admin_menu = array();
    include_once XOOPS_ROOT_PATH.'/modules/system/constants.php';
    $isPrefAdmin = $moduleperm_handler->checkRight('system_admin', XOOPS_SYSTEM_PREF, $xoopsUser->getGroups());
    //load system items
    $system_rights = $moduleperm_handler->getItemIds('system_admin', $xoopsUser->getGroups());
    if (count($system_rights) > 0 && is_object($modules[1])) {
        $menuitems = $modules[1]->getAdminMenu();
        if (count($menuitems) > 0) {
            foreach ($system_rights as $k) {
                if (isset($menuitems[$k])) {
                    $menuitems[$k]['link'] = trim($menuitems[$k]['link']);
                    $menuitems[$k]['target'] = isset($menuitems[$k]['target']) ? trim($menuitems[$k]['target']) : '';
                    if (isset($menuitems[$k]['absolute']) && $menuitems[$k]['absolute']) {
                        $menuitems[$k]['link'] = (empty($menuitems[$k]['link'])) ? "#" : $menuitems[$k]['link'];
                    } else {
                        $menuitems[$k]['link'] = (empty($menuitems[$k]['link'])) ? "#" : XOOPS_URL."/modules/".$modules[1]->getVar('dirname')."/".$menuitems[$k]['link'];
                    }
                }
            }
        }
        $systemmenu = array(
        'name'    => $modules[1]->getVar('name'),
        'dirname' => $modules[1]->getVar('dirname'),
        'version' => $modules[1]->getVar('version'),
        'links'   => $menuitems
        );
    }
    
    // Load modules preferences
    if (file_exists(XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin/preferences.php')) {
        include_once XOOPS_ROOT_PATH.'/modules/system/language/'.$xoopsConfig['language'].'/admin/preferences.php';
    } else {
        include_once XOOPS_ROOT_PATH.'/modules/system/language/english/admin/preferences.php';
    }
    // Initialyze configuration category handler
    $confcat_handler =& xoops_gethandler('configcategory');
    $confcats = $confcat_handler->getObjects();
    foreach (array_keys($modules) as $i) {
        $isAdmin = $moduleperm_handler->checkRight('module_admin', $modules[$i]->getVar('mid'), $xoopsUser->getGroups());
        if ($isAdmin) {
            $modnames[$modules[$i]->getVar('mid')] = $modules[$i]->getVar('name');
            if ($modules[$i]->getVar('mid')==1) {
                foreach (array_keys($confcats) as $i) {
                    $menulinks[1]['mid'] = 1;
                    $menulinks[1]['name'] = $modules[1]->getVar('name');
                    $menulinks[1]['cats'][] = array(
                        'link'  => XOOPS_URL.'/modules/system/admin.php?fct=preferences&amp;op=show&amp;confcat_id='.$confcats[$i]->getVar('confcat_id'),
                        'title' => constant($confcats[$i]->getVar('confcat_name'))
                    );
                }
            } else {
                $menulinks[$modules[$i]->getVar('mid')]['mid'] = $modules[$i]->getVar('mid');
                $menulinks[$modules[$i]->getVar('mid')]['name'] = $modules[$i]->getVar('name');
                $menulinks[$modules[$i]->getVar('mid')]['cats'][] = array(
                    'link' => XOOPS_URL.'/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod='.$modules[$i]->getVar('mid'),
                    'title' => _MD_AM_PREF
                    );
            }
        }
    }
    array_multisort($modnames, SORT_ASC, SORT_STRING, $menulinks, SORT_ASC, SORT_STRING);
    $systemmenu['links'][XOOPS_SYSTEM_PREF]['sublinks'] = $menulinks;
    // Load module menu
    foreach (array_keys($modules) as $i) {
        if ($i > 1) {
            if (in_array($modules[$i]->getVar('mid'), $admin_mids)) {
                $menuitems = $modules[$i]->getAdminMenu();
                if (count($menuitems) <= 0 && is_object($xoopsModule)) {
                    $menuitems = $xoopsModule->getAdminMenu();
                }
                if (count($menuitems) > 0) {
                    foreach (array_keys($menuitems) as $k) {
                        $menuitems[$k]['link'] = trim($menuitems[$k]['link']);
                        $menuitems[$k]['target'] = isset($menuitems[$k]['target']) ? trim($menuitems[$k]['target']) : '';
                        if (isset($menuitems[$k]['absolute']) && $menuitems[$k]['absolute']) {
                            $menuitems[$k]['link'] = (empty($menuitems[$k]['link'])) ? "#" : $menuitems[$k]['link'];
                        } else {
                            $menuitems[$k]['link'] = (empty($menuitems[$k]['link'])) ? "#" : XOOPS_URL.'/modules/'.$modules[$i]->getInfo('dirname')."/".$menuitems[$k]['link'];
                        }
                    }
                    $admin_menu[$modules[$i]->getVar('mid')] = array(
                        'mid'     => $modules[$i]->getVar('mid'),
                        'name'    => $modules[$i]->getVar('name'),
                        'index'   => $modules[$i]->getInfo('adminindex'),
                        'dirname' => $modules[$i]->getVar('dirname'),
                        'version' => $modules[$i]->getVar('version'),
                        'links'   => $menuitems
                        );
                }
            }
        }
    }
    $last = explode("/", $_SERVER['REQUEST_URI']);
    if ( $last[count($last)-1] == 'admin.php' && $last[count($last)-3] != 'modules' ) {
        $adminTpl->assign('cpanel_home', 1);
        $adminTpl->assign('view_warning', thadmin_Setting('cpanel_only'));
    } else {
        $adminTpl->assign('cpanel_home', 0);
    }
    // Assign to template
    $adminTpl->assign_by_ref('adminmenu', $admin_menu);
    $adminTpl->assign_by_ref('systemmenu', $systemmenu);
    $adminmenucount = (count($system_rights) > 0) ? count($admin_menu) + 1 : count($admin_menu);
    $adminTpl->assign('adminmenucount', $adminmenucount);
    // Call header
    //echo $admTpl->fetch(XOOPS_ROOT_PATH.'/modules/thadmin/templates/xoadmin_header.html');
}

function xoops_thadmin_cp_footer()
{
    global $xoopsConfig, $xoopsLogger, $xoopsTpl;
    
    if ( !defined('XOOPS_FOOTER_INCLUDED') ) {
        define('XOOPS_FOOTER_INCLUDED', 1);
        $xoopsLogger->stopTime( 'Module display' );
        
        if (!headers_sent()) {
            header('Content-Type:text/html; charset='._CHARSET);
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Cache-Control: private, no-cache');
            header('Pragma: no-cache');
        }
        //@internal: using global $xoTheme dereferences the variable in old versions, this does not
        if ( !isset( $xoTheme ) )  $xoTheme =& $GLOBALS['xoTheme'];

        if ( isset( $xoopsOption['template_main'] ) && $xoopsOption['template_main'] != $xoTheme->contentTemplate ) {
            trigger_error( "xoopsOption[template_main] should be defined before including header.php", E_USER_WARNING );
            if ( false === strpos( $xoopsOption['template_main'], ':' ) ) {
                $xoTheme->contentTemplate = 'db:' . $xoopsOption['template_main'];
            } else {
                $xoTheme->contentTemplate = $xoopsOption['template_main'];
            }
        }
        $xoTheme->render();
        $xoopsLogger->stopTime();
        ob_end_flush();
    }
}
?>