<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
 
class clsPhpMyJoomlaUtils {
    
    
    protected static $quickconn_host;
    protected static $quickconn_database;
    protected static $quickconn_username;
    protected static $quickconn_password;
    
    public static function setQuickConnCredentials($host, $database, $username, $password) {
        self::$quickconn_host = $host;
        self::$quickconn_database = $database;
        self::$quickconn_username = $username;
        self::$quickconn_password = $password;
    }
    
    public static function testDynamicDBO($db) {
        try {
            $db->connect();
        } catch (Exception $e) {
            return false;
        }
        if (!$db->connected()) {
            return false;
        }
        return true;
    }
    
    public static function getDynamicDBO($serverID) {
        switch ($serverID) {
            case PMJ_SERVER_LOCALHOST:
                $db = JFactory::getDBO();
                break;
            case PMJ_SERVER_QUICK:
                $serverconfig = self::arrGetExternalServerConfig($serverID);
                $option = array(); 
                $option['driver']   = 'mysql';            // Database driver name
                $option['host']     = self::$quickconn_host;
                $option['user']     = self::$quickconn_username;  // User for database authentication
                $option['password'] = self::$quickconn_password;  // Password for database authentication
                $option['database'] = self::$quickconn_database;  // Database name
                $option['prefix']   = ''; // Database prefix (may be empty)
                $db = JDatabase::getInstance($option);
                break;
            default:
                $serverconfig = self::arrGetExternalServerConfig($serverID);
                $option = array(); 
                $option['driver']   = 'mysql';            // Database driver name
                $option['host']     = $serverconfig->host;
                $option['user']     = $serverconfig->username;  // User for database authentication
                $option['password'] = $serverconfig->password;  // Password for database authentication
                $option['database'] = $serverconfig->database;;  // Database name
                $option['prefix']   = ''; // Database prefix (may be empty)
                $db = JDatabase::getInstance($option);
        }
        
        return $db;
    }
    
    public static function arrGetExternalServers($blnForceRefresh = false) {
        static $arrServers = NULL;
        if ((!isset($arrServers)) || ($blnForceRefresh == true)) {
            // Detect the table
            $db = JFactory::getDBO();
            $sql = "SELECT * FROM #__phpmyjoomla_ext_server_config WHERE state = 1";
            $db->setQuery($sql);
            $db->query();
            $rows = $db->loadObjectList();
            $arrServers = array();
            if ($rows) {
                foreach($rows as $row)  {
                        $arrServers[$row->id] = $row->name;
                }
            }
        }
        return $arrServers;
    }
    
     public static function arrGetExternalServerConfig($serverID, $blnForceRefresh = false) {
        static $arrConfigDetails = NULL;
         if ((!isset($arrConfigDetails)) || ($blnForceRefresh == true)) {
            $db = JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__phpmyjoomla_ext_server_config');
            $db->setQuery((string)$query);
            $rows = $db->loadObjectList();
            $arrConfigDetails = array();
            if ($rows) {
                foreach($rows as $row) {
                    $arrConfigDetails[$row->id] = $row;
                }
            }
        }

        return (isset($arrConfigDetails[$serverID]))? $arrConfigDetails[$serverID] : '';
    }
    
    public static function arrGetDatabases($serverID = PMJ_SERVER_LOCALHOST,$blnForceRefresh = false) {
        static $arrDatabases = NULL;
        if ((!isset($arrDatabases[$serverID])) || ($blnForceRefresh == true)) {
            $db = self::getDynamicDBO($serverID);
            // Detect the table
            $sql = "SHOW DATABASES";
            $db->setQuery($sql);
            $db->query();
            $rows = $db->loadObjectList();
            $arrDatabases[$serverID] = array();
            if ($rows) {
                foreach($rows as $row)  {
                        $arrDatabases[$serverID][] = $row->Database;
                }
            }
        }
        return $arrDatabases[$serverID];
    }

    public static function arrGetTables($dbName, $serverID, $blnForceRefresh = false) {
        static $arrTablesList = NULL;
        if ((!isset($arrTablesList[$serverID][$dbName])) || ($blnForceRefresh == true)) {
            $db = self::getDynamicDBO($serverID);
            $sql = "SHOW FULL TABLES FROM `$dbName` WHERE Table_type = 'BASE TABLE'";
            $db->setQuery($sql);
            $db->query();
            $rows = $db->loadRowList();
            $arrTablesList[$serverID][$dbName] = array();
            if ($rows) {
                foreach($rows as $row)  {
                    $arrTablesList[$serverID][$dbName][] = $row[0];
                }
            }
        }
	return $arrTablesList[$serverID][$dbName];
    }
    
    public static function getDefaultDatabase($serverID) {
        $db = '';
        switch ($serverID) {
            case PMJ_SERVER_LOCALHOST:
                $db = JFactory::getConfig()->get('db');
                break;
            case PMJ_SERVER_QUICK:
                $databases = self::arrGetDatabases($serverID);
                $db = reset($databases);
                break;
            default:
                $databases = self::arrGetDatabases($serverID);
                $db = reset($databases);
        }
        
        return $db;
    }
}
?>
