<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     thadmin
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
$mainTabs->setCurrent('help', 'tabs');
$mainTabs->display();
// Start template class
$tpl = new XoopsTpl();
// Assign smarty variables
$tpl->assign('stylesheet', '<link rel="stylesheet" type="text/css" media="all" href="'.XOOPS_URL.'/modules/'.$xoopsModule->getInfo('dirname').'/css/help.css">');
// Call template
if (file_exists(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/language/'.$xoopsConfig['language'].'/help.html') ) {
  echo $tpl->fetch(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/language/'.$xoopsConfig['language'].'/help.html');
}else{
  echo $tpl->fetch(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/language/english/help.html');
}
// Display admin footer
xoops_cp_footer();
?>