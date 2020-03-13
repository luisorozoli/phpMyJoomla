<?php

/**
 * @version     1.0.0
 * @package     plg_quickicon_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
// No direct access
defined('_JEXEC') or die;

class plgQuickiconphpMyJoomla extends JPlugin
{
    public function onGetIcons()
    {
        return array(
            array(
                'link'   => 'index.php?option=com_phpmyjoomla&view=managetables',
                'image'  => (version_compare(JVERSION, '3', '>=') ? 'database' : JUri::root() . 'plugins/quickicon/phpmyjoomla/s_icon_phpMyJoomla.png'),
                'text'   => JText::_('phpMyJoomla'),
                'id'     => 'plg_quickicon_phpmyjoomla',
                'access' => array(
                    'core.manage',
                    'com_config',
                    'core.admin',
                    'com_config'
                ),
                'group'  => 'MOD_QUICKICON_MAINTENANCE'
            )
        );
    }
}