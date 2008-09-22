<?php
/**
 * XOOPS ThAdmin module
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
$menu_handler->render( 0 );
// Start template class
$tpl =& new XoopsTpl();
// Get the folder list theme
$theme_default = thadmin_Setting('theme_admin_set');
// Load Xoops list class
XoopsLoad::load('xoopslists');
$theme_list = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/themes/');
$i=0;
foreach ($theme_list as $theme) {
    if (file_exists(XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme . '/xo-info.php')) {
        include_once XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme . '/xo-info.php';
        $theme_array[$i] = $thmversion;
        $theme_array[$i]['path']    = XOOPS_ROOT_PATH.'/modules/thadmin/themes/' . $theme;
        $theme_array[$i]['url']     = XOOPS_URL.'/modules/thadmin/themes/' . $theme;
        $theme_array[$i]['default'] = ($theme_default == $theme) ? 1 : 0;
        $i++;
    }
}
// Load xoops form
xoops_load('xoopsformloader');
// Display upload form
$form = new XoopsThemeForm(_THADMIN_UPLOAD, 'upload_form', 'upload.php', 'post', true);
$form->setExtra('enctype="multipart/form-data"');
$form->addElement(new XoopsFormFile(_THADMIN_UPLOAD_FILE, 'module_file', 0));
//$form->addElement(new XoopsFormRadioYN(_THADMIN_UPLOAD_INSTALL, 'module_install', 1, _YES, _NO));
//$form->addElement(new XoopsFormText(_THADMIN_UPLOAD_DIRNAME, 'module_name', 50, 255));
$form->addElement(new XoopsFormHidden('op', 'upload'));
$form->addElement(new XoopsFormButton('', 'mod_button', _SUBMIT, 'submit'));
// Assign smarty variables
//$tpl->assign('upload_form', $form->render());
$tpl->assign('themes', $theme_array);
// Call admin template
$tpl->display(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/admin/templates/admin_index.html');
// Display admin footer
xoops_cp_footer();
?>