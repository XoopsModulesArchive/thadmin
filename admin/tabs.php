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
 * XOOPS ThAdmin module
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 * @package     ThAdmin
 * @version     $Id: theme.php 1416 2008-03-30 04:20:47Z phppp $
 */

if (!defined('XOOPS_URL')) { exit(); }

global $xoopsModule;
/* Get the module id and the module name */
$module_id = $xoopsModule->getVar('mid');
$module_name = $xoopsModule->getVar('name');
/* Construct the link for acces to preference and update page */
$top_navigation = 
    "<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=showmod&mod={$module_id}'>" . _AD_TH_PREFERENCES . "</a>" .
    "<a name='separator'> | </a>" .
    "<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=" . $xoopsModule->getVar('dirname', 'n') . "'>" . _AD_TH_UPDATE . "</a>";
/* Create the tab navigation */
$mainTabs = new XoopsThadminTabs();
$mainTabs->setModuleName($module_name);
$mainTabs->setTopNavigation($top_navigation);
$admin_menu = $xoopsModule->getAdminMenu();
$nb_menu = count($admin_menu);
/* Construct the tabs */
$i = 1;
foreach ($admin_menu as $menu) {
    $class = '';
    if ($nb_menu == $i) $class = 'end-tab';
    $link = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/' . $menu['link'];
    $mainTabs->addTab( $menu['name'], $link, $menu['title'], $i++, $class);
}
unset($admin_menu);
?>