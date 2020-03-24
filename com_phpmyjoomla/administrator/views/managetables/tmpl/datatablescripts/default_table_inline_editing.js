/**
 * Created by luisorozoli on 21/03/2020.
 */

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
