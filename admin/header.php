<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     thadmin
 */

include_once '../../../mainfile.php';
// Xoops class
include_once XOOPS_ROOT_PATH.'/class/template.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsmodule.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
// Xoops admin functions
include_once XOOPS_ROOT_PATH.'/include/cp_functions.php';

// Check user right
if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname('thadmin');
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) { 
		redirect_header(XOOPS_URL."/", 3, _NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/", 3, _NOPERM);
	exit();
}
// Include language file
if ( file_exists("../language/".$xoopsConfig['language']."/admin.php") ) {
	include_once("../language/".$xoopsConfig['language']."/admin.php");
} else {
	include_once("../language/english/admin.php");
}
// Include class & functions
include_once XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/class/tabs.php";

$myts = &MyTextSanitizer::getInstance();
?>
