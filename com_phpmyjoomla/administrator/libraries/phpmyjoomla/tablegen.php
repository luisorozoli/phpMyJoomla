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
    protected $arrReferenceTable = array();
    protected $filterColumnPrefix = 'c';
    protected $filterColumnCountPerRow = 5;
    protected $customQueryString = '';

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

    private function generateAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=generatetablejson';
        $url .= '&loaded_db='.$this->arrReferenceTable[$tblId]['db_name'];
        $url .= '&loaded_table='.$this->arrReferenceTable[$tblId]['table_name'];
        $url .= '&loaded_server='.$this->arrReferenceTable[$tblId]['server_id'];
        $url .= '&quickconn_host='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_host'];
        $url .= '&quickconn_database='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_database'];
        $url .= '&quickconn_username='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_username'];
        $url .= '&quickconn_password='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_password'];
        return $url;
    }

    private function generateCustomQueryAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=runcustomquery';
        $url .= '&loaded_db='.$this->arrReferenceTable[$tblId]['db_name'];
        $url .= '&loaded_table='.$this->arrReferenceTable[$tblId]['table_name'];
        $url .= '&loaded_server='.$this->arrReferenceTable[$tblId]['server_id'];
        $url .= '&quickconn_host='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_host'];
        $url .= '&quickconn_database='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_database'];
        $url .= '&quickconn_username='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_username'];
        $url .= '&quickconn_password='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_password'];
        return $url;
    }

    private function generateEditAjaxURL($tblId) {
        $url = '';
        $url .= './index.php?option=com_phpmyjoomla&view=managetables';
        $url .= '&ajax=1';
        $url .= '&ajaxaction=editrecord';
        $url .= '&loaded_db='.$this->arrReferenceTable[$tblId]['db_name'];
        $url .= '&loaded_table='.$this->arrReferenceTable[$tblId]['table_name'];
        $url .= '&loaded_server='.$this->arrReferenceTable[$tblId]['server_id'];
        $url .= '&quickconn_host='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_host'];
        $url .= '&quickconn_database='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_database'];
        $url .= '&quickconn_username='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_username'];
        $url .= '&quickconn_password='.$this->arrReferenceTable[$tblId]['additional_params']['quickconn_password'];
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
                $html .= '
                    var editor;
                    $(document).ready(function() {
                        // DISABLE/ENABLE EDITOR
                        editor = new $.fn.dataTable.Editor( {
                            ajax: {
                                url: "' . $this->generateEditAjaxURL($tblId) . '",
                                data: {table:' . json_encode($this->arrReferenceTable[$tblId]) . '},
                                dataType: "json",
                            },
                            table: "#example",
                            idSrc:  "' . $this->arrReferenceTable[$tblId]['primary'] . '",
                            fields: ' . $this->generateEditorFields($this->arrReferenceTable[$tblId]) . ',
                            i18n: {
                                create: {
                                    button: "'.JText::_('COM_PHPMYJOOMLA_IE_CREATE_BUTTON').'",
                                    title:  "'.JText::_('COM_PHPMYJOOMLA_IE_CREATE_TITLE').'",
                                    submit: "'.JText::_('COM_PHPMYJOOMLA_IE_CREATE_SUBMIT').'"
                                },
                                edit: {
                                    button: "'.JText::_('COM_PHPMYJOOMLA_IE_EDIT_BUTTON').'",
                                    title:  "'.JText::_('COM_PHPMYJOOMLA_IE_EDIT_TITLE').'",
                                    submit: "'.JText::_('COM_PHPMYJOOMLA_IE_EDIT_SUBMIT').'"
                                },
                                remove: {
                                    button: "'.JText::_('COM_PHPMYJOOMLA_IE_REMOVE_BUTTON').'",
                                    title:  "'.JText::_('COM_PHPMYJOOMLA_IE_REMOVE_TITLE').'",
                                    submit: "'.JText::_('COM_PHPMYJOOMLA_IE_REMOVE_SUBMIT').'",
                                    confirm: {
                                        _: "'.JText::_('COM_PHPMYJOOMLA_IE_REMOVE_COMFIRM_MORE').'",
                                        1: "'.JText::_('COM_PHPMYJOOMLA_IE_REMOVE_COMFIRM_ONE').'"
                                    }
                                },
                                error: {
                                    "system": "'.JText::_('COM_PHPMYJOOMLA_IE_ERROR_SYSTEM').'"
                                },
                                "multi": {
                                    "title": "'.JText::_('COM_PHPMYJOOMLA_IE_MULTI_TITLE').'",
                                    "info": "'.JText::_('COM_PHPMYJOOMLA_IE_MULTI_INFO').'",
                                    "restore": "'.JText::_('COM_PHPMYJOOMLA_IE_MULTI_RESTORE').'",
                                    "noMulti": "'.JText::_('COM_PHPMYJOOMLA_IE_MULTI_NOMULTI').'"
                                },
                                datetime: {
                                    "previous": "'.JText::_('COM_PHPMYJOOMLA_IE_DATETIME_PREVIOUS').'",
                                    "next":     "'.JText::_('COM_PHPMYJOOMLA_IE_DATETIME_NEXT').'",
                                    "months":   "'.JText::_('COM_PHPMYJOOMLA_IE_DATETIME_MONTHS').'",
                                    "weekdays": "'.JText::_('COM_PHPMYJOOMLA_IE_DATETIME_WEEKDAYS').'",
                                    "amPm":     [ "am", "pm" ],
                                    "unknown":  "-"
                                }
                            }
                        });
                        // END DISABLE/ENABLE EDITOR
                        // DISABLE/ENABLE EDITOR
                        editor.on( "postSubmit", function ( e, json, data, action ) {
                            var jsonArray = [];
                            var jsonObject;
                            $.each(json, function(index, element) {
                                var content = {};
                                content[index] = element;
                                jsonArray.push(content);
                            });
                            jsonObject = jsonArray[0];
                            if ("error" in jsonObject) {
                                alert(jsonObject.error);
                            } else {
                                $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#alert-success").slideUp(500);
                                });
                            }
                        });
                        // END DISABLE/ENABLE EDITOR
                        // DISABLE/ENABLE EDITOR
                        // Activate an inline edit on click of a table cell
                        $("#example").on( "click", "tbody td:not(:first-child)", function (e) {
                            editor.inline( this, {
                                "onBlur": "submit"
                            });
                        });
                        // END DISABLE/ENABLE EDITOR

                        $("#example").dataTable( {
                            "language": {
                                "url": "'.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_URL').'"
                            },
                            "ajax": "' . $this->generateAjaxURL($tblId) . '",
                            "deferRender": true,
                            "dom": "Bfrtip",
                            "lengthMenu": [[10, 25, 50, -1], ["10 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "25 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "50 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "'.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R_ALL').'"]],
                            "select": true,
                            "buttons": [
                                // DISABLE/ENABLE EDITOR
                                { extend: "create", editor: editor, className: "green" },
                                { extend: "edit",   editor: editor, className: "orange" },
                                { extend: "remove", editor: editor, className: "red" },
                                // END DISABLE/ENABLE EDITOR
                                "copy",
                                "csv",
                                "excel",
                                "pdf",
                                "print",
                                "pageLength",
                                {
                                    "extend": "colvis",
                                    "postfixButtons": [ "colvisRestore" ]
                                }
                            ],
                            "colReorder": true,
                            "scrollX": true,
                            "pagingType": "full_numbers",

                            "columns": ' . $this->generateDataTableColumns($this->arrReferenceTable[$tblId]) . '

                        }).columnFilter(getFilterOject());
//                        setInterval("reloadPage()", 180000 ); //reloadPage Every 3 minutes
                    });
//                   function reloadPage() {
//                       var table = $("#example").DataTable();
//                   table.ajax.reload();
//                   }
                ';
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
                $html .= '
                    $(document).ready(function() {
                        $("#example").dataTable( {
                            "language": {
                                "url": "'.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_URL').'"
                            },
                            "ajax": "'.$this->generateAjaxURL($tblId).'",
                            "deferRender": true,
                            "dom": "Bfrtip",
                            "lengthMenu": [[10, 25, 50, -1], ["10 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "25 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "50 '.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R').'", "'.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R_ALL').'"]],
                            "select": true,
                            buttons: [
                                "copy",
                                "csv",
                                "excel",
                                "pdf",
                                "print",
                                "pageLength",
                                {
                                    "extend": "colvis",
                                    "postfixButtons": [ "colvisRestore" ]
                                }
                            ],
                            "select": {
                                "style":    "os",
                                "selector": "td:first-child"
                            },
                            "keys": true,
                            "colReorder": true,
                            "scrollX": true,
                            "pagingType": "full_numbers",

                            columns: '.$this->generateDataTableColumns($this->arrReferenceTable[$tblId]).'

                        }).columnFilter(getFilterOject());
//                        setInterval("reloadPage()", 180000 ); //reloadPage Every 3 minutes
                    });
//                    function reloadPage() {
//                        var table = $("#example").DataTable();
//                    table.ajax.reload();
//                    }
                ';
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

        if ($ed_custom_query) { //If inline Editing
            $html = '';
            $html .= '
            var editor;
                $(document).ready(function() {
                    // DISABLE/ENABLE EDITOR
                    editor = new $.fn.dataTable.Editor( {
                        ajax: {
                            url: "' . $this->generateEditAjaxURL($tblId) . '",
                            data: {table:' . json_encode($this->arrReferenceTable[$tblId]) . '},
                            dataType: "json",
                        },
                        table: "#customtable",
                        idSrc:  "' . $this->arrReferenceTable[$tblId]['primary'] . '",
                        fields: ' . $this->generateEditorFields($this->arrReferenceTable[$tblId]) . ',
                        i18n: {
                            create: {
                                button: "' . JText::_('COM_PHPMYJOOMLA_IE_CREATE_BUTTON') . '",
                                title:  "' . JText::_('COM_PHPMYJOOMLA_IE_CREATE_TITLE') . '",
                                submit: "' . JText::_('COM_PHPMYJOOMLA_IE_CREATE_SUBMIT') . '"
                            },
                            edit: {
                                button: "' . JText::_('COM_PHPMYJOOMLA_IE_EDIT_BUTTON') . '",
                                title:  "' . JText::_('COM_PHPMYJOOMLA_IE_EDIT_TITLE') . '",
                                submit: "' . JText::_('COM_PHPMYJOOMLA_IE_EDIT_SUBMIT') . '"
                            },
                            remove: {
                                button: "' . JText::_('COM_PHPMYJOOMLA_IE_REMOVE_BUTTON') . '",
                                title:  "' . JText::_('COM_PHPMYJOOMLA_IE_REMOVE_TITLE') . '",
                                submit: "' . JText::_('COM_PHPMYJOOMLA_IE_REMOVE_SUBMIT') . '",
                                confirm: {
                                    _: "' . JText::_('COM_PHPMYJOOMLA_IE_REMOVE_COMFIRM_MORE') . '",
                                    1: "' . JText::_('COM_PHPMYJOOMLA_IE_REMOVE_COMFIRM_ONE') . '"
                                }
                            },
                            error: {
                                "system": "' . JText::_('COM_PHPMYJOOMLA_IE_ERROR_SYSTEM') . '"
                            },
                            "multi": {
                                "title": "' . JText::_('COM_PHPMYJOOMLA_IE_MULTI_TITLE') . '",
                                "info": "' . JText::_('COM_PHPMYJOOMLA_IE_MULTI_INFO') . '",
                                "restore": "' . JText::_('COM_PHPMYJOOMLA_IE_MULTI_RESTORE') . '",
                                "noMulti": "' . JText::_('COM_PHPMYJOOMLA_IE_MULTI_NOMULTI') . '"
                            },
                            datetime: {
                                "previous": "' . JText::_('COM_PHPMYJOOMLA_IE_DATETIME_PREVIOUS') . '",
                                "next":     "' . JText::_('COM_PHPMYJOOMLA_IE_DATETIME_NEXT') . '",
                                "months":   "' . JText::_('COM_PHPMYJOOMLA_IE_DATETIME_MONTHS') . '",
                                "weekdays": "' . JText::_('COM_PHPMYJOOMLA_IE_DATETIME_WEEKDAYS') . '",
                                "amPm":     [ "am", "pm" ],
                                "unknown":  "-"
                            }
                        }
                    });
                    // END DISABLE/ENABLE EDITOR
                    // DISABLE/ENABLE EDITOR
                    editor.on( "postSubmit", function ( e, json, data, action ) {
                        var jsonArray = [];
                        var jsonObject;
                        $.each(json, function(index, element) {
                            var content = {};
                            content[index] = element;
                            jsonArray.push(content);
                        });
                        jsonObject = jsonArray[0];
                        if ("error" in jsonObject) {
                            alert(jsonObject.error);
                        } else {
                            $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                                $("#alert-success").slideUp(500);
                            });
                        }
                    });
                    // END DISABLE/ENABLE EDITOR
                    // DISABLE/ENABLE EDITOR
                    // Activate an inline edit on click of a table cell
                    $("#customtable").on( "click", "tbody td:not(:first-child)", function (e) {
                        editor.inline( this, {
                            "onBlur": "submit"
                        });
                    });
                    // END DISABLE/ENABLE EDITOR

                    $("#customtable").dataTable( {
                        "language": {
                            "url": "' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_URL') . '"
                        },
                        ajax: {
                            url: "' . $this->generateCustomQueryAjaxURL($tblId) . '",
                            data: {queryString: "' . $this->customQueryString . '"},
                            dataType: "json"
                        },
                        "deferRender": true,
                        "dom": "Bfrtip",
                        "lengthMenu": [[10, 25, 50, -1], ["10 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "25 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "50 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R_ALL') . '"]],
                        "select": true,
                        buttons: [
                            // DISABLE/ENABLE EDITOR
                            { extend: "create", editor: editor, className: "green" },
                            { extend: "edit",   editor: editor, className: "orange" },
                            { extend: "remove", editor: editor, className: "red" },
                            // END DISABLE/ENABLE EDITOR
                            "copy",
                            "csv",
                            "excel",
                            "pdf",
                            "print",
                            "pageLength",
                            {
                                "extend": "colvis",
                                "postfixButtons": [ "colvisRestore" ]
                            }
                        ],
                        "colReorder": true,
                        "scrollX": true,
                        "pagingType": "full_numbers",

                        "columns": ' . json_encode($this->getCustomColumns($tblId, $this->customQueryString, "data")[1]) . '

                    }).columnFilter(getFilterOject());
                });

//                setInterval("reloadPage()", 180000 ); //reloadPage Every 3 minutes
//                function reloadPage() {
//                    var table = $("#customtable").DataTable();
//                table.ajax.reload();
//            }
            ';
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

    private function detectTable($tablename, $dbname, $serverID,$additionalParams) {
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

    private function getTablePrimaryKey($tablename, $dbname, $serverID) {
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

    private function getFieldDataTypes($tablename, $dbname, $serverID) {
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

    private function generateDataTableColumns($table) {
        $columnArray = array();
        foreach($table['db_columns'] as $column) {
            $columnArray[] = array('data' => $column);
        }
//        $columnArrayplus = "{data: null, defaultContent: '', className: 'select-checkbox', orderable: false}";
//        array_push($columnArray, $columnArrayplus);

        return json_encode($columnArray);
    }

    private function generateEditorFields($table) {
        $columnArray = array();
        foreach($table['db_columns'] as $column) {
            //$columnArray[] = array('label' => $column, 'name' => $column, 'type' =>  "readonly"); => for with readonly fields, check field if it should be readonly
            $columnArray[] = array('label' => $column, 'name' => $column);
        }
        return json_encode($columnArray);
    }
}
?>
