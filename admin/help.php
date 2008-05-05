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

// Include header
require_once 'header.php';
// Include tabs
require_once 'tabs.php';
// Display Admin header
xoops_cp_header();
// Display navigation tabs
$mainTabs->setCurrent('help', 'tabs');
$mainTabs->display();
// Start template class
$tpl =& new XoopsTpl();
// Assign smarty variables
$tpl->assign('stylesheet', '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/css/help.css">');
// Call template
if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/language/' . $xoopsConfig['language'] . '/help.html') ) {
    $tpl->display(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/language/' . $xoopsConfig['language'] . '/help.html');
} else {
    $tpl->display(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/language/english/help.html');
}
// Display admin footer
xoops_cp_footer();
?>