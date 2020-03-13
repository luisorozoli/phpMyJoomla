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

jimport('joomla.application.component.controllerform');

/**
 * Servers controller class.
 */
class PhpmyjoomlaControllerServers extends JControllerForm
{

    function __construct() {
        $this->view_list = 'serverss';
        parent::__construct();
    }

}