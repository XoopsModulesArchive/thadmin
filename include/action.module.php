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
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id$
 * @package         ThAdmin
 */

if (!defined('XOOPS_ROOT_PATH')) { exit(); }

function xoops_module_pre_install_thadmin(&$module)
{
    if (substr(XOOPS_VERSION, 0, 9) != "XOOPS 2.3") {
        $module->setErrors( "The module only works for XOOPS 2.3+" );
        return false;
    }
    
    return true;
}
?>