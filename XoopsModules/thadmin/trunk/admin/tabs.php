<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     content
 */

global $xoopsModule;
require_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/class/tabs.php';
/* Get the module id and the module name */
$module_id = $xoopsModule->getVar('mid');
$module_name = $xoopsModule->getVar('name');
/* Construct the link for acces to preference and update page */
$top_navigation = "
<a href='".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=".$module_id."'>"._AD_TH_PREFERENCES."</a>
<a name='separator'> | </a>
<a href='".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=update&module=".$xoopsModule->dirname()."'>"._AD_TH_UPDATE."</a>";
/* Create the tab navigation */
$mainTabs = new XoopsTabs();
$mainTabs->setModuleName($module_name);
$mainTabs->setTopNavigation($top_navigation);
$i=1;
$admin_menu = $xoopsModule->getAdminMenu();
$nb_menu = count($admin_menu);
/* Construct the tabs */
foreach ($admin_menu as $menu){
  $class='';
  if($nb_menu==$i)$class='end-tab';
  $link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/'.$menu['link'];
  $mainTabs->addTab( $menu['name'], $link, $menu['title'], $i++, $class);
}
unset($admin_menu);
?>
