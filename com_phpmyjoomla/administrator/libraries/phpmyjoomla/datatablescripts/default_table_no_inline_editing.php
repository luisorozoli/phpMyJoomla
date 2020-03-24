<?php
/**
 * @version     3.0.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

function default_table_no_inline_editing ($objThis,$tblId) {
    return '
        $(document).ready(function() {
            $("#example").dataTable( {
                "language": {
                    "url": "'.JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_URL').'"
                },
                "ajax": "'.$objThis->generateAjaxURL($tblId).'",
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
//                "select": {
//                    "style":    "os",
//                    "selector": "td:first-child"
//                },
//                "keys": true,
                "colReorder": true,
                "scrollX": true,
                "pagingType": "full_numbers",

              columns: '.$objThis->generateDataTableColumns($objThis->arrReferenceTable[$tblId]).'

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