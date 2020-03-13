<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/libraries/loader.php';

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_phpmyjoomla')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Phpmyjoomla');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
