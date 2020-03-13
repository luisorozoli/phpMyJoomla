<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Phpmyjoomla helper.
 */
class PhpmyjoomlaHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
    	JHtmlSidebar::addEntry(
        	JText::_('COM_PHPMYJOOMLA_TITLE_MANAGETABLES'),
      		'index.php?option=com_phpmyjoomla&view=managetables',
    		$vName == 'managetables'
        );	
        	
        JHtmlSidebar::addEntry(
			JText::_('COM_PHPMYJOOMLA_TITLE_SERVERSS'),
			'index.php?option=com_phpmyjoomla&view=serverss',
			$vName == 'serverss'
		);

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_phpmyjoomla';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
