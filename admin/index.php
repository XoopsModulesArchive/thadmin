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
// Call admin template
echo $tpl->fetch(XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getInfo('dirname').'/admin/templates/admin_index.html');
// Display admin footer
xoops_cp_footer();
?>