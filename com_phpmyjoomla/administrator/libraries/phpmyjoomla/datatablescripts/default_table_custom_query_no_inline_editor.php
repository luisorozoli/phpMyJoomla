<?php function default_table_custom_query_no_inline_editor ($objThis,$tblId) {
    return '
        $(document).ready(function() {
            $("#customtable").dataTable( {
                "language": {
                    "url": "' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_URL') . '"
                },
                ajax: {
                    url: "' . $objThis->generateCustomQueryAjaxURL($tblId) . '",
                    data: {queryString: "' . $objThis->customQueryString . '"},
                    dataType: "json"
                },
                "deferRender": true,
                "dom": "Bfrtip",
                "lengthMenu": [[10, 25, 50, -1], ["10 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "25 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "50 ' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R') . '", "' . JText::_('COM_PHPMYJOOMLA_IE_LANGUAGE_LENGMENU_R_ALL') . '"]],
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

                "columns": ' . json_encode($objThis->getCustomColumns($tblId, $objThis->customQueryString, "data")[1]) . '

            }).columnFilter(getFilterOject());
//            setInterval("reloadPage()", 180000 ); //reloadPage Every 3 minutes
        });
//        function reloadPage() {
//            var table = $("#customtable").DataTable();
//            table.ajax.reload();
//        }
    ';
}
?>