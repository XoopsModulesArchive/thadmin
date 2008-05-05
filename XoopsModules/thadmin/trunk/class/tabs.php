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
 * XOOPS ThAdmin module XoopsTab class file
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 * @package     ThAdmin
 * @version     $Id: theme.php 1416 2008-03-30 04:20:47Z phppp $
 */

class XoopsThadminTabs
{
    var $tabs=array();
    var $subs=array();
    var $current_tab;
    var $current_sub;
    var $_style;
    var $_return_style = true;
    var $_righttxt = '';
    var $_menuTop;

    function XoopsThadminTabs( $style = 'xtabs' )
    {
        $this->_style = $style;
        if ( $this->_style != 'xtabs' ) {
            $this->_return_style = false;
        }
    }
    
    function setModuleName($name)
    {
        $this->_righttxt = $name;
    }
    
    function setTopNavigation($menu)
    {
        $this->_menuTop = $menu;
    }
    
    function getTabs()
    {
        return $this->tabs;
    }
    
    function getSubs()
    {
        return $this->subs;
    }
    
    function getSet()
    {
        return $this->fetchTabSet();
    }
    
    function display()
    {
        echo $this->render();
    }
    
    function assign()
    {
        global $xoopsTpl;
        $xoopsTpl->assign( $this->_style, $this->render() );
    }
    
    function setCurrent( $name, $set = 'tabs' )
    {
        if ( $set == 'tabs' ) {
            $this->current_tab = $name;
        }
        if ( $set == 'subs' ) {
            $this->current_sub = $name;
        }
    }
    
    function addTab( $name, $link, $label, $weight = 10, $class = '' )
    {
        $this->addSet( 'tabs', $name, $link, $label, $weight , $class);
    }

    /**
     * Method to add multiple tabs from an array of data
     * @param    array    $tabs 
     */
    function addTabArray( $tabs )
    {
        foreach ( $tabs as $name => $tab ) {
            $this->addSet( 'tabs', $name, $tab['link'], $tab['label'], $tab['weight'] );
        }
    }

    /**
     * Method to add a single sub link for display below an active tab
     * @param    string    $name    a unique name for your link
     * @param    string    $link    the url for your link 
     * @param    string    $label    the text to display for link
     * @param    string    $weight    the display order ****   <--  doesn't do anything yet    
     * @param    string    $parent    the name of the tab which this sublink should display under
     */
    function addSub( $name, $link, $label, $weight, $parent )
    {
        $this->addSet( 'subs', $name, $link, $label, $weight, '', $parent );
    }

    /**
     * Method to add multiple sub links from an array of data
     * @param    array    $subs 
     */
    function addSubArray( $subs )
    {
        foreach ( $subs as $name => $sub ) {
            $this->addSet( 'subs', $name, $tab['link'], $tab['label'], $tab['weight'] );
        }
    }

    /**
     * Method is used by the addTab and addSub methods and should not be called directly
     */
    function addSet( $set, $name, $link, $label, $weight, $class = '', $parent = null )
    {
        if ( $set == 'tabs' ) {
            $this->tabs[$name]['link'] = $link;
            $this->tabs[$name]['label'] = $label;
            $this->tabs[$name]['weight'] = $weight;
            $this->tabs[$name]['name'] = $name;
            $this->tabs[$name]['class']= $class;
        } elseif ( $set == 'subs' ) {
            $this->subs[$parent][$name]['link'] = $link;
            $this->subs[$parent][$name]['label'] = $label;
            $this->subs[$parent][$name]['weight'] = $weight;
            $this->subs[$parent][$name]['name'] = $name;
        }
    }

    /**
     * Method is used to clear all assigned sub links
     * @param   void
     */
    function clearSubs()
    {
        $this->subs = null;
    }

    /**
     * Method is used to build a complete set of data which can then be easily used
     * to display tabs in a webpage. This method should not be called directly and 
     * can be accessed via the getSet() method.
     * @return  array   full tab data and sub links for active tab
     * 
     */
    function fetchTabSet()
    {
        $set['tabs'] = $this->tabs;    
        $subs = $this->subs;
        if (isset($subs[$this->current_tab])) {
            $set['sub'] = $subs[$this->current_tab];
        }
        
        if ( isset($this->current_tab) ) {
            if (isset($subs[$this->current_tab])) {
                $set['sub'] = $subs[$this->current_tab];
            }
            $set['tabs'][$this->current_tab]['current'] = 1;
        }
        if ( isset($this->current_sub) ) {
            $set['subs'][$this->current_sub]['current'] = 1;
        }
        
        $set['tabcount'] = count($set['tabs']);
        if ( isset($set['subs'])) {
            $set['subcount'] = count($set['subs']);
        } 
        
        return $set;    
    }

    function render()
    {
        global $xoopsModule;
        $module_id = $xoopsModule->getVar('mid');
        $html = '';
        if ( $this->_return_style ) $html .= $this->getStyle();
        $tabs = $this->getSet();
        $html .= "
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
         <tr>
         <td>
        <div id='".$this->_style."'>
           <table cellspacing='0' cellpadding='0' width='100%'>
              <tr>
               <td id='menutop'>
           ".$this->_menuTop."
           </td>
           <td id='rightside'>$this->_righttxt</td>
          </tr>
                <tr>
                 <td id='button'>
                <ul>";
            foreach ( $tabs['tabs'] as $k => $tab ) {
                $html .= "<li class='".$tab['class']."'";
                if (isset($tab['current'])) {
                    if ( $tab['current'] == 1 ) $html .= " id='current'";
                }
                $html .= "><a href='".$tab['link']."'>".$tab['label']."</a></li>";
            }
              $html .= "
                  </ul>
                 </td>
                </tr>
               </table>
             </div>
        </td>
         </tr>          
         <tr>
          <td height='30'>
           <div>&nbsp; &nbsp;";
         if (isset($tabs['subs'])) {
             $n = 0;
             foreach ( $tabs['subs'] as $k=>$sub ) {
                if ( $n > 0 ) $html .= "| &nbsp;"; 
                $html .= "<a href='".$sub['link']."'>".$sub['label']."</a> &nbsp;";
                $n++;
             }
         }
         $html .= "</div>\n
          </td>\n
         </tr>\n
        </table>";     
        return $html;
    } 
  
    function getStyle()
    {
        global $xoopsModule;
        return '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/css/tabs.css" />';
    }
}


?>
