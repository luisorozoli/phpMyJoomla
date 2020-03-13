<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
 
class clsPhpMyJoomlaValidation {
    
    public static function validateDatabase($serverID, $select_db) {
        $validated_db = $select_db;
        $arrDatabases = clsPhpMyJoomlaUtils::arrGetDatabases($serverID);
        if (empty($arrDatabases)) {
                $validated_db = PMJ_DATABASES_NO_SELECT;
        }
        else if (!(in_array($select_db, $arrDatabases))) {
            $validated_db = reset($arrDatabases);
        }
        
        return $validated_db;
    }
    
    public static function validateTable($select_server, $select_db, $select_table) {
        $validated_table = $select_table;
        $arrTables = clsPhpMyJoomlaUtils::arrGetTables($select_db, $select_server);
        if (empty($arrTables)) {
                $validated_table = PMJ_TABLES_NO_SELECT;
        }
        else if (!(in_array($select_table, $arrTables))) {
            $validated_table = reset($arrTables);
        }
        return $validated_table;
    }
}
?>
