<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     ThAdmin
 * @version     1.0
 */

// Include header
require_once 'header.php';
// Check users rights
if (!is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin($xoopsModule->mid())) exit(_NOPERM);
// Include tabs
require_once 'tabs.php';
// Display Admin header
xoops_cp_header();
// Display navigation tabs
$mainTabs->setCurrent('home', 'tabs');
$mainTabs->display();
// Start template class
$tpl = new XoopsTpl();
// Search if hacked file is uploaded
if (defined('_AD_TH_CPFUNCTION')) {
  $tpl->assign('hack_set', 1);
} else {
  $tpl->assign('hack_set', 0);
}

$theme_default = thadmin_Setting('theme_admin_set');
XoopsLoad::load('xoopslists');
$theme_list = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH.'/modules/thadmin/themes/');
foreach($theme_list as $theme) {
  if(file_exists(XOOPS_ROOT_PATH.'/modules/thadmin/themes/'.$theme.'/xo-info.php')) {
    include_once XOOPS_ROOT_PATH.'/modules/thadmin/themes/'.$theme.'/xo-info.php';
    $theme_array[$i] = $thmversion;
    $theme_array[$i]['path'] = XOOPS_ROOT_PATH.'/modules/thadmin/themes/'.$theme;
    $theme_array[$i]['url'] = XOOPS_URL.'/modules/thadmin/themes/'.$theme;
    $theme_array[$i]['default'] = ($theme_default == $theme) ? 1 : 0;
  }
}
$tpl->assign('themes', $theme_array);
/*
print(sprintf(_MD_CPANEL_VERSION, "XOOPS") . XOOPS_VERSION);
print(sprintf(_MD_CPANEL_VERSION, "PHP") . PHP_VERSION);
print(sprintf(_MD_CPANEL_VERSION, "MySQL") . mysql_get_server_info());
print(sprintf(_MD_CPANEL_VERSION, "Server") . php_sapi_name());
print('safe_mode' . ini_get( 'safe_mode' ) ? 'On' : 'Off');
print('register_globals' . ini_get( 'register_globals' ) ? 'On' : 'Off');
print('magic_quotes_gpc' . ini_get( 'magic_quotes_gpc' ) ? 'On' : 'Off');
print('allow_url_fopen' . ini_get( 'allow_url_fopen' ) ? 'On' : 'Off');
print('fsockopen' . function_exists( 'fsockopen' ) ? 'On' : 'Off');
print('allow_call_time_pass_reference' . ini_get( 'allow_call_time_pass_reference' ) ? 'On' : 'Off');
print('post_max_size' . ini_get( 'post_max_size' ));
print('max_input_time' . ini_get( 'max_input_time' ));
print('output_buffering' . ini_get( 'output_buffering' ));
print('max_execution_time' . ini_get( 'max_execution_time' ));
print('memory_limit' . ini_get( 'memory_limit' ));
print('file_uploads' . ini_get( 'file_uploads' ) ? 'On' : 'Off');
print('upload_max_filesize' . ini_get( 'upload_max_filesize' ));*/
// Call admin template
echo $tpl->fetch(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/admin/templates/admin_index.html');
// Display admin footer
xoops_cp_footer();
?>