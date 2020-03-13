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

class plgQuickiconphpMyJoomlaInstallerScript
{
	public function install ($parent)
	{
		$this->run ("update `#__extensions` set `enabled` = 1 where `name` = 'plg_quickicon_phpmyjoomla'");
	}

	private function run ($query)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$db->query();
	}
}
