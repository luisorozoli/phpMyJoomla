<?php
/**
 * @version     3.0.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
 
class clsPhpMyJoomlaQuery {
    
    public static function processUpdate($table, $data) {
        
        $tableName = $table['table_name'];
        $primaryKey = $table['primary'];
        $dataId = key($data);
        $dataField = key($data[$dataId]);
        $dataValue = $data[$dataId][$dataField];
        
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $fields = array(
            $db->quoteName($dataField) . ' = ' . $db->quote($dataValue)
        );
        $conditions = array(
            $db->quoteName($primaryKey) . ' = ' . $dataId . ''
        );
        $query->update($db->quoteName($tableName))->set($fields)->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
        
        $rowData = array();
        $retData = array();
        if ($result) {
            $row = self::getUpdatedRow($table, $dataId);
            $rowData['DT_RowId'] = $primaryKey;
            foreach($row as $key => $value) {
                $rowData[$key] = $value;
            }
            $retData['data'][] = $rowData;
        } else {
            $retData['error'] = 'A problem was encountered. Field is not updated.';
        }
        return $retData;
    }
    
    private static function getUpdatedRow($table, $dataId) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName($table['db_columns']));
        $query->from($db->quoteName($table['table_name']));
        $query->where($db->quoteName($table['primary']) . ' = '. $db->quote($dataId));
        $db->setQuery($query);
        $row = $db->loadAssoc();
        return $row;
    }
}
?>
