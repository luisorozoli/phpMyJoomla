<?php
/**
 * @version     3.0.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

#Component Options
//$ed_inline_editing= JComponentHelper::getParams('com_phpmyjoomla')->get('ed_inline_editing','0');

class clsPhpMyJoomlaTableGen {
    public $arrReferenceTable = array();
    public $filterColumnPrefix = 'c';
    public $filterColumnCountPerRow = 5;
    public $customQueryString = '';

    public function addTable($tblId, $tablename, $dbname, $serverID, $additionalParams) {
        $this->arrReferenceTable[$tblId] = $this->detectTable($tablename, $dbname, $serverID, $additionalParams);
        $this->arrReferenceTable[$tblId]['primary'] = $this->getTablePrimaryKey($tablename, $dbname, $serverID);
    }

    public function renderTableFilter($tblId) {
        $html = '';
        if (isset($this->arrReferenceTable[$tblId])) {
            $html .= '<table cellspacing="5" class="cell-border" width="100%" border="0" class="display" id="tablefilter">';

            $noOfColumns = count($this->arrReferenceTable[$tblId]['db_columns']);
            $cnt = 1;
            $cntColumnPerRow = 0;
            for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                if ($cntColumnPerRow == 0) {
                    $html .= '<tr>';
                }
                $html .= '<td align="left"><span id="'.$this->filterColumnPrefix.strval($cnt).'"></span></td>';
                $cntColumnPerRow++;
                if ($cntColumnPerRow >= $this->filterColumnCountPerRow) {
                    $html .= '</tr>';
                    $cntColumnPerRow = 0;
                }
            }
            $html .= '</table>';
        }
        return $html;
    }

    public function renderCustomTableFilter($tblId, $queryStr) {
        $html = '';
        $columns = $this->getCustomColumns($tblId, $queryStr);
        if (($columns[0] == '1') && ($columns[1] != 'empty')) {
            $html .= '<table cellspacing="5" class="cell-border" width="100%" border="0" class="display" id="tablefilter">';

            $noOfColumns = count($columns[1]);
            $cnt = 1;
            $cntColumnPerRow = 0;
            for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                if ($cntColumnPerRow == 0) {
                    $html .= '<tr>';
                }
                $html .= '<td align="left"><span id="'.$this->filterColumnPrefix.strval($cnt).'"></span></td>';
                $cntColumnPerRow++;
                if ($cntColumnPerRow >= $this->filterColumnCountPerRow) {
                    $html .= '</tr>';
                    $cntColumnPerRow = 0;
                }
            }
            $html .= '</table>';
        }
        return $html;
    }

    public function initializeQueryString($queryString) {
        $this->customQueryString = $queryString;
    }

    public function renderCustomQuery() {
        $html = '
            <form id="formcustomquery" name="formcustomquery" method="POST">
            <textarea id="custom_query_field" name="custom_query_field" placeholder="'.JText::_('COM_PHPMYJOOMLA_SHOWHIDE_CUSTOMQUERY_PLACEHOLDER').'" class="custom_query_area">'.htmlspecialchars($this->customQueryString).'</textarea>
            </form>
            <div>
                <input id="process_custom_query" name="load_table" type="button" class="query_btn buttons-phpmyjoomla-blue" value="'.JText::_('COM_PHPMYJOOMLA_SHOWHIDE_CUSTOMQUERY_TEXT_BUTTON_LOAD').'" style="margin-left: inherit;margin-bottom: 15px;">
            </div>
            ';
        return $html;
    }

    public function renderTableData($tblId) {
        $html = '';
        if (isset($this->arrReferenceTable[$tblId])) {
            //$html .= "<table cellpadding='0' cellspacing='0' border='1' class='display' id='example'>";
            $html .= "<table cellspacing='0' width='100%' class='display' id='example'>";
            $html .= "<thead>";
            $html .= "<tr>";
            foreach ($this->arrReferenceTable[$tblId]['table_headers'] as $th){
                $html .= '<th>'.$th.'</th>';
            }
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "</tbody>";
            $html .= "</tbody> </table>";
        }
        return $html;

    }

    public function renderCustomQueryTable($tblId, $queryStr) {
        $html = '';
        $columns = $this->getCustomColumns($tblId, $queryStr);

        if ($columns[0] == '1') {
            if ($columns[1] != 'empty') {
                //$html .= "<table cellpadding='0' cellspacing='0' border='1' class='display' id='example'>";
                $html .= "<table cellspacing='0' width='100%' class='display' id='customtable'>";
                $html .= "<thead>";
                $html .= "<tr>";
                foreach ($columns[1] as $th){
                    $html .= '<th>'.$th.'</th>';
                }
                $html .= "</tr>";
                $html .= "</thead>";
                $html .= "</tbody>";
                $html .= "</tbody> </table>";
            } else {
                $html .= "<div>Query result is empty</div>";
            }
        } else {
            $html .= "<div>There was a problem with the query.</div>";
            $html .= "<div>".$columns[1]."</div>";
        }
        return $html;
    }

    public function appendGenericURLParam($tblId) {
        $appendurl = '';
        $appendurl .= '&loaded_db='.$this->arrReferenceTable[$tblId]['db_name'];
        $appendurl .= '&loaded_table='.$this->arrReferenceTable[$tblId]['table_name'];
        $appendurl .= '&loaded_server='.$this->arrReferenceTable[$tblId]['server_id'];
        $appendurl .= '&select_server='.$this->arrReferenceTable[$tblId]['additional_params']['select_server'];
        $appendurl .= '&select_db='.$this->arrReferenceTable[$tblId]['additional_params']['select_db'];
        $appendurl .= '&select_table='.$this->arrReferenceTable[$tblId]['additional_params']['select_table'];
        $appendurl .= '&quickconn_host='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_host'];
        $appendurl .= '&quickconn_database='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_database'];
        $appendurl .= '&quickconn_username='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_username'];
        $appendurl .= '&quickconn_password='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_password'];
        $appendurl .= '&select_filters='.$this->arrReferenceTable[$tblId]['additional_params']['select_filters'];
        return $appendurl;
    }

    public function generateAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=generatetablejson';
        $url .= $this->appendGenericURLParam($tblId);
        return $url;
    }

    public function generateCustomQueryAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=runcustomquery';
        $url .= $this->appendGenericURLParam($tblId);
        return $url;
    }

    public function generateEditAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=editrecord';
        $url .= $this->appendGenericURLParam($tblId);
        return $url;
    }

    public function generateStateSaveAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=savestate';
        $url .= $this->appendGenericURLParam($tblId);
        return $url;
    }

    public function generateStateLoadAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=loadstate';
        $url .= $this->appendGenericURLParam($tblId);
        return $url;
    }

    public function renderTableScripts($tblId) {
        //Component Options
        $ed_inline_editing= JComponentHelper::getParams('com_phpmyjoomla')->get('ed_inline_editing','0');

        //Languages options
        jimport('joomla.language.helper');
        @$lang =& JFactory::getLanguage();

        $lang_editing = ''; //default Local
        switch (strtolower($lang->getTag())) {
            case 'en-gb':
                $lang_editing = 'en';
                break;
            case 'es-es':
                $lang_editing = 'es';
                break;
        }

        if ($ed_inline_editing) { //If inline Editing
            $html = '';
            if (isset($this->arrReferenceTable[$tblId])) {
                include 'datatablescripts/default_table_inline_editing.php';
                $html =  default_table_inline_editing($this,$tblId);
                $html .= 'function getFilterOject() {';
                $html .= 'return ';
                $noOfColumns = count($this->arrReferenceTable[$tblId]['db_columns']);
                $html .= '{';
                $html .= '"sPlaceHolder": "head:before",';
                $html .= '"aoColumns":[';
                for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                    $html .= '{"sSelector": "#' . ($this->filterColumnPrefix . strval($cnt)) . '"},';
                }
                $html = mb_substr($html, 0, -1); //remove last comma
                $html .= ']};';
                $html .= '}';
            }
            return $html;
        } else { //If NOT Inline Editing
            $html = '';
            if (isset($this->arrReferenceTable[$tblId])) {
                include 'datatablescripts/default_table_no_inline_editing.php';
                $html =  default_table_no_inline_editing($this,$tblId);
                $html .= 'function getFilterOject() {';
                $html .= 'return ';
                $noOfColumns = count($this->arrReferenceTable[$tblId]['db_columns']);
                $html .= '{';
                $html .= '"sPlaceHolder": "head:before",';
                $html .= '"aoColumns":[';
                for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                    $html .= '{"sSelector": "#'.($this->filterColumnPrefix.strval($cnt)).'"},';
                }
                $html = mb_substr($html, 0, -1); //remove last comma
                $html .= ']};';
                $html .= '}';
            }
            return $html;
        }
    }

    public function renderCustomTableScripts($tblId) { //If custom query
        //Component Options
        $ed_custom_query= JComponentHelper::getParams('com_phpmyjoomla')->get('ed_custom_query','0');
        $ed_inline_editing= JComponentHelper::getParams('com_phpmyjoomla')->get('ed_inline_editing','0');

        if ($ed_custom_query) { //If custom query
            if ($ed_inline_editing) { //If inline Editing
                $html = '';
                include 'datatablescripts/default_table_custom_query_inline_editor.php';
                $html =  default_table_custom_query_inline_editor($this,$tblId);
                $html .= 'function getFilterOject() {';
                $html .= 'return ';
                $noOfColumns = count($this->getCustomColumns($tblId, $this->customQueryString)[1]);
                $html .= '{';
                $html .= '"sPlaceHolder": "head:before",';
                $html .= '"aoColumns":[';
                for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                    $html .= '{"sSelector": "#' . ($this->filterColumnPrefix . strval($cnt)) . '"},';
                }
                $html = mb_substr($html, 0, -1); //remove last comma
                $html .= ']};';
                $html .= '}';
                return $html;
            } else { //If NOT Inline Editing
                $html = '';
                include 'datatablescripts/default_table_custom_query_no_inline_editor.php';
                $html =  default_table_custom_query_no_inline_editor($this,$tblId);
                $html .= 'function getFilterOject() {';
                $html .= 'return ';
                $noOfColumns = count($this->getCustomColumns($tblId, $this->customQueryString)[1]);
                $html .= '{';
                $html .= '"sPlaceHolder": "head:before",';
                $html .= '"aoColumns":[';
                for ($cnt = 1; $cnt <= $noOfColumns; $cnt++) {
                    $html .= '{"sSelector": "#' . ($this->filterColumnPrefix . strval($cnt)) . '"},';
                }
                $html = mb_substr($html, 0, -1); //remove last comma
                $html .= ']};';
                $html .= '}';
                return $html;
            }
        }
    }

    public function generateTableJSON($tblId) {

        $db = clsPhpMyJoomlaUtils::getDynamicDBO($this->arrReferenceTable[$tblId]['server_id']);

        // Introduce the consult that you want.
        $query = "SELECT * FROM `" .$this->arrReferenceTable[$tblId]['db_name'].'`.`'. $this->arrReferenceTable[$tblId]['table_name'] . "`";
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        $jsonphpMyJoomla = array();
        $arrphpMyJoomla = array();
        foreach($rows as $row){
            $newRow = array();
            foreach($this->arrReferenceTable[$tblId]['db_columns'] as $col) {
                $newRow[$col] = $row->$col;
            }
            $arrphpMyJoomla[] = $newRow;
        }
        $jsonphpMyJoomla["data"] = $arrphpMyJoomla;
        $jsonphpMyJoomla = json_encode($jsonphpMyJoomla);

        return $jsonphpMyJoomla;
    }

    public function getCustomQueryColumns($tblId, $query, $keyText = false) {
        return json_encode($this->getCustomColumns($tblId, $query, $keyText));
    }

    public function getCustomColumns($tblId, $query, $keyText = false) {
        try {
            $db = clsPhpMyJoomlaUtils::getDynamicDBO($this->arrReferenceTable[$tblId]['server_id']);
            $db->setQuery($query);
            $rows = $db->loadAssocList();
            if ($rows) {
                $jsonphpMyJoomla = array();
                $arrphpMyJoomla = array();
                $columns = array();
                foreach($rows as $row) {
                    $newRow = array();
                    if (empty($columns)) {
                        foreach($row as $col => $val) {
                            if (!$keyText) {
                                $columns[] = $col;
                            } else {
                                $columns[] = array("$keyText" => $col);
                            }
                        }
                        return array('1', $columns);
                    }
                }
            } else {
                return array('1', 'empty');
            }
        } catch (Exception $e){
            return array('0', $e->getMessage());
        }
    }

    public function getCustomQueryResult($tblId, $query) {
        $db = clsPhpMyJoomlaUtils::getDynamicDBO($this->arrReferenceTable[$tblId]['server_id']);
        $db->setQuery($query);
        $rows = $db->loadAssocList();

        $jsonphpMyJoomla = array();
        $arrphpMyJoomla = array();
        foreach($rows as $row) {
            $newRow = array();
            foreach($row as $col => $val) {
                $newRow[$col] = $val;
            }
            $arrphpMyJoomla[] = $newRow;
        }
        $jsonphpMyJoomla["data"] = $arrphpMyJoomla;
        return json_encode($jsonphpMyJoomla);
    }

    public function detectTable($tablename, $dbname, $serverID,$additionalParams) {
        // Detect the table
        $db = clsPhpMyJoomlaUtils::getDynamicDBO($serverID);
        $sql =  "SHOW COLUMNS FROM  `". $tablename . "`";
        if (!empty($dbname)) {
            $sql .= " IN `". $dbname . "`";
        }
        $db->setQuery($sql);
        $db->query();
        $rows = $db->loadObjectList();
        $arrFields = array();
        if ($rows) {
            foreach($rows as $row)  {
                $arrFields[] = array('field' => $row->Field, 'type' => $row->Type, 'key' => $row->Key);
            }
        }

        $tblData = array();
        $tblData['server_id'] = $serverID;
        $tblData['table_name'] = $tablename;
        $tblData['db_name'] = $dbname;
        $tblData['additional_params'] = $additionalParams;
        $tblData['db_columns'] = array();
        $tblData['table_headers'] = array();
        foreach ($arrFields as $fieldname) {
            $tblData['db_columns'][] = $fieldname['field'];
            $tblData['db_types'][] = $fieldname['type'];
            $tblData['db_keys'][] = $fieldname['key'];
            $tblData['table_headers'][] = $fieldname['field'];
        }

        return $tblData;
    }

    public function getTablePrimaryKey($tablename, $dbname, $serverID) {
        $db = clsPhpMyJoomlaUtils::getDynamicDBO($serverID);
        $sql =  "SHOW INDEX FROM  `". $tablename . "` ";
        if (!empty($dbname)) {
            $sql .= " IN `". $dbname . "`";
        }
        $sql .= " WHERE Key_name = 'PRIMARY'";
        $db->setQuery($sql);
        $db->query();
        $result = $db->loadAssoc();
        return $result['Column_name'];
    }

    public function getFieldDataTypes($tablename, $dbname, $serverID) {
        $db = clsPhpMyJoomlaUtils::getDynamicDBO($serverID);
        $sql =  "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.columns";
        if (!empty($dbname)) {
            $sql .= " IN `". $dbname . "`";
        }
        $sql .= " WHERE table_name = ".$tablename."";
        $db->setQuery($sql);
        $db->query();
        $rows = $db->loadRowList();
        $arrTypes = array();
        if ($rows) {
            foreach($rows as $row)  {
                $arrTypes[] = $row;
            }
        }
        return $arrTypes;
    }

    public function generateDataTableColumns($table) {
        $columnArray = array();
        foreach($table['db_columns'] as $column) {
            $columnArray[] = array('data' => $column);
        }
//        $columnArrayplus = "{data: null, defaultContent: '', className: 'select-checkbox', orderable: false}";
//        array_push($columnArray, $columnArrayplus);

        return json_encode($columnArray);
    }

    public function generateEditorFields($table) {
        $columnArray = array();
        foreach($table['db_columns'] as $column) {
            //$columnArray[] = array('label' => $column, 'name' => $column, 'type' =>  "readonly"); => for with readonly fields, check field if it should be readonly
            $columnArray[] = array('label' => $column, 'name' => $column);
        }
        return json_encode($columnArray);
    }
}
?>
