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
 * XOOPS ThAdmin module
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 * @package     ThAdmin
 * @version     $Id$
 */

$i=0; 
$i++;
$adminmenu[$i]['title']  = _MI_TH_HOME;
$adminmenu[$i]['name']   = 'home';
$adminmenu[$i]['link']   = 'admin/index.php';
$i++;
$adminmenu[$i]['title']  = _MI_TH_HELP;
$adminmenu[$i]['name']   = 'help';
$adminmenu[$i]['link']   = 'admin/help.php';
?>