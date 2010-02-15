<?php
/**
 * Module administration help file
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

// Include header
require_once 'header.php';
// Display Admin header
xoops_cp_header();
// Display navigation tabs
$menu_handler->render( 1 );
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