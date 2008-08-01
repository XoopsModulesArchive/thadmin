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
 * XOOPS ThAdmin module theme class file
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 * @package     ThAdmin
 * @version     $Id$
 */
 
require_once XOOPS_ROOT_PATH . '/class/template.php';
require_once XOOPS_ROOT_PATH . '/class/theme.php';

class XoopsThAdminThemeFactory extends xos_opal_ThemeFactory
{
    function &createInstance( $options = array(), $initArgs = array() ) 
    {
        $options["plugins"] = array();
        $inst =& parent::createInstance( $options, $initArgs );
        $inst->path = XOOPS_ROOT_PATH . '/modules/thadmin/themes/' . $inst->folderName;
        $inst->url = XOOPS_URL . '/modules/thadmin/themes/' . $inst->folderName;
        $inst->template->assign( array(
            'theme_path'  => $inst->path,
            'theme_tpl'   => $inst->path.'/xotpl',
            'theme_url'   => $inst->url,
            'theme_img'   => $inst->url.'/img',
            'theme_icons' => $inst->url.'/icons',
            'theme_css'   => $inst->url.'/css',
            'theme_js'    => $inst->url.'/js',
            ) );

        return $inst;
    }
}
?>