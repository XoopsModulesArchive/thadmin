<?php
/**
 * XOOPS THAdmin upload manager
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas <nicolas.andricq@gmail.com>
 * @version     $Id$
 * @since       2.3.0
 */
require 'header.php';
 
// Check security token
if (!$GLOBALS['xoopsSecurity']->check()) {
  redirect_header('index.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
  exit();
}
xoops_load('uploader');
// Upload the new module file
$uploader = new XoopsMediaUploader(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/themes', array('application/zip', 'application/x-zip', 'application/x-zip-compressed'), 8388608);
if($xoopsUser->isAdmin()){
    $uploader->nosizecheck = true;
}
$err = array();
if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
    if (!$uploader->upload()) {
        $err[] = $uploader->getErrors();
        echo 'rr';
    } else {
        /*include_once XOOPS_ROOT_PATH.'/class/dUnzip.php';
        $zip = new dUnzip2(XOOPS_MODULE_PATH.'/'.$uploader->getSavedFileName());
        // Activate debug
        $zip->debug = false;
        // Unzip all the contents of the zipped file to a new folder          
        $zip->unzipAll(XOOPS_MODULE_PATH);
        $zip->delete();*/
        if($_POST['module_install'] && is_dir(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->getVar('dirname', 'n') . '/themes/'.$_POST['module_name'])) {
            // To install...
            redirect_header('index.php', 3, _THADMIN_UPLOAD_INSTALLATION);
        } else {
            redirect_header('index.php', 3, _THADMIN_UPLOAD_UPLOADED);
        }
    }
} else {
    $err[] = sprintf(_FAILFETCHIMG, $_FILES['module_file']['name']);
    $err = array_merge($err, $uploader->getErrors(false));
}
if (count($err) > 0) {
    xoops_cp_header();
    xoops_error($err);
    xoops_cp_footer();
    exit();
}
redirect_header('index.php', 3, _THADMIN_UPLOAD_ERROR);

?>