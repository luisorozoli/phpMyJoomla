<?php
/**
 * @version     3.0.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

function default_table_inline_editing ($objThis,$tblId) {
    return '
        var editor;
        $(document).ready(function() {
            // DISABLE/ENABLE EDITOR
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    url: "' . $objThis->generateEditAjaxURL($tblId) . '",
                    data: {table:' . json_encode($objThis->arrReferenceTable[$tblId]) . '},
                    dataType: "json",
                },
                table: "#example",
                idSrc:  "' . $objThis->arrReferenceTable[$tblId]['primary'] . '",
                fields: ' . $objThis->generateEditorFields($objThis->arrReferenceTable[$tblId]) . ',
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
                "ajax": "' . $objThis->generateAjaxURL($tblId) . '",
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

                "columns": ' . $objThis->generateDataTableColumns($objThis->arrReferenceTable[$tblId]) . '

                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    var fName = $("#filter_name" ).val();
                    var blnAllowFiltersave = $("#flag_allowfiltersave" ).val();
                    flag_allowfiltersave
                    if ((fName != \'\') && (blnAllowFiltersave == \'1\')) {
                        // Send an Ajax request to the server with the state object
                        $.ajax( {
                          "url": "'.$this->generateStateSaveAjaxURL($tblId).'&fName=" + fName,
                          "data": data,
                          "dataType": "json",
                          "method": "POST",
                          "success": function () {}
                        });
                    }
                },
                "stateLoadCallback": function (settings) {
                    var o;
                    // Send an Ajax request to the server to get the data. Note that
                    // this is a synchronous request since the data is expected back from the
                    // function
                    $.ajax( {
                      "url": "'.$this->generateStateLoadAjaxURL($tblId).'",
                      "async": false,
                      "dataType": "json",
                      "success": function (json) {
                        o = json;
                      }
                    });
                    return o;
                },

            }).columnFilter(getFilterOject());
//            setInterval("reloadPage()", 180000 ); //reloadPage Every 3 minutes
        });
        function statesave() {
            var table = $("#example").DataTable();
            table.state.save();
        }
//        function reloadPage() {
//            var table = $("#example").DataTable();
//            table.ajax.reload();
//        }
    ';
}
?>