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
 * @version     $Id$
 */

// Include header
require_once 'header.php';
// Include tabs
require_once 'tabs.php';

// Display Admin header
xoops_cp_header();
// Display navigation tabs
$mainTabs->setCurrent('home', 'tabs');
$mainTabs->display();
// Start template class
$tpl =& new XoopsTpl();
// Search if hacked file is uploaded
if (defined('_AD_TH_CPFUNCTION')) {
  $tpl->assign('hack_set', 1);
} else {
  $tpl->assign('hack_set', 0);
}

$theme_default = thadmin_Setting('theme_admin_set');
XoopsLoad::load('xoopslists');
$theme_list = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH.'/modules/thadmin/themes/');
foreach ($theme_list as $theme) {
    if (file_exists(XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme . '/xo-info.php')) {
        include_once XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme . '/xo-info.php';
        $theme_array[$i] = $thmversion;
        $theme_array[$i]['path'] = XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme;
        $theme_array[$i]['url'] = XOOPS_URL.'/modules/thadmin/themes/' . $theme;
        $theme_array[$i]['default'] = ($theme_default == $theme) ? 1 : 0;
    }
}
$tpl->assign('themes', $theme_array);
// Call admin template
$tpl->display(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/admin/templates/admin_index.html');
// Display admin footer
xoops_cp_footer();
?>