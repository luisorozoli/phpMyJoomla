<?php
/**
 * @version     2.0.1
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2019. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://luisoroz.co - https://www.phpmyjoomla.com
 */


function print_array($x) {
    echo '<pre>';
    echo print_r($x);
    echo '</pre>';
}

function log_event( $details = '') {

        $filename = "D:/Temp/general.log";

	$date = date("D M j G:i:s Y T");
	$host = (isset($_SERVER['REMOTE_ADDR']))? $_SERVER['REMOTE_ADDR']: 'CLI';
        $details = print_r($details,true);
	$logdetails = "[$date] [$host] $details\n";

    if (!$handle = fopen($filename, 'a')) {
    	return;
    }
    if (fwrite($handle, $logdetails) === FALSE) {
    	return;
    }
    fclose($handle);
}
?>