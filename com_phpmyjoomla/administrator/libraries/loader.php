<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
 
error_reporting(E_ALL);
define('DIR_LIB_PHPMYJOOMLA', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpmyjoomla');
require_once 'constants.php';
require_once 'general_functions.php';
require_once DIR_LIB_PHPMYJOOMLA . '/tablegen.php';
require_once DIR_LIB_PHPMYJOOMLA . '/utils.php';
require_once DIR_LIB_PHPMYJOOMLA . '/query.php';
require_once DIR_LIB_PHPMYJOOMLA . '/validation.php';

?>