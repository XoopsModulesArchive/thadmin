<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     ThAdmin
 */

// Main
$modversion['name']                   = _MI_TH_NAME;
$modversion['version']                = 1.0;
$modversion['description']            = _MI_TH_DESC;
$modversion['credits']                = 'Andricq Nicolas (AKA MusS)';
$modversion['author']                 = 'Andricq Nicolas (AKA MusS)';
$modversion['help']                   = '';
$modversion['license']                = 'http://www.gnu.org/licenses/gpl.txt';
$modversion['official']               = 0;
$modversion['image']                  = 'thadmin.png';
$modversion['dirname']                = 'thadmin';
// XoopsInfo
$modversion['developer_website_url'] 	= 'http://xoops.foreach.fr';
$modversion['developer_website_name']	= 'ForXoops';
$modversion['download_website']		    = 'http://xoops.foreach.fr/';
$modversion['status_fileinfo'] 		    = 'http://xoops.foreach.fr/thadmin.ini';
$modversion['demo_site_url']		      = 'http://xoops.foreach.fr';
$modversion['demo_site_name']		      = 'ForXoops';
$modversion['support_site_url']		    = 'http://www.frxoops.org';
$modversion['support_site_name']	    = 'Xoops France';
$modversion['submit_bug']		          = 'http://www.frxoops.org/modules/newbb/';
$modversion['submit_feature'] 		    = 'http://www.frxoops.org/modules/newbb/';
// Admin things
$modversion['hasAdmin']               = 1;
$modversion['adminindex']             = 'admin/index.php';
$modversion['adminmenu']              = 'admin/menu.php';
// Menu
$modversion['hasMain']                = 0;
// Settings
include_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
$theme_list = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH.'/modules/thadmin/themes/');
$i=1;
$modversion['config'][$i]['name']       = 'theme_admin_set';
$modversion['config'][$i]['title']      = '_MI_TH_ADMINTHEME';
$modversion['config'][$i]['description']= '_MI_TH_ADMINTHEME_DESC';
$modversion['config'][$i]['formtype']   = 'select';
$modversion['config'][$i]['valuetype']  = 'text';
$modversion['config'][$i]['options']    = $theme_list;
$modversion['config'][$i]['default']    = 'default';
$i++;
$modversion['config'][$i]['name']       = 'cpanel_only';
$modversion['config'][$i]['title']      = '_MI_TH_CPANELEONLY';
$modversion['config'][$i]['description']= '_MI_TH_CPANELEONLY_DESC';
$modversion['config'][$i]['formtype']   = 'yesno';
$modversion['config'][$i]['valuetype']  = 'int';
$modversion['config'][$i]['default']    = 1;
?>