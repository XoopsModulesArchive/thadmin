<?php
/**
 * Module administration header file
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @version     $Id$
 * @since       2.3.0
 */

// Include xoops admin header
include_once '../../../include/cp_header.php';
// Xoops class
include_once XOOPS_ROOT_PATH . '/class/template.php';
// Module functions
include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname", "n") . "/include/functions.php";
// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));
// Get menu tab handler
$menu_handler = &xoops_getmodulehandler( 'menu' );
// Define top navigation
$menu_handler->addMenuTop( XOOPS_URL . "/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid', 'e'), _THADMIN_PREFERENCES );
$menu_handler->addMenuTop( XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&amp;op=update&amp;module=" . $xoopsModule->getVar('dirname', 'e'), _THADMIN_UPDATE );
// Define main tab navigation
$menu_handler->addMenuTabs( 'index.php', _THADMIN_MENU_HOME );
$menu_handler->addMenuTabs( 'help.php', _THADMIN_MENU_HELP );
?>
