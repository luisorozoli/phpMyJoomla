<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

// No direct access to this file

defined('_JEXEC') or die('Restricted access');
?>
<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/datatables.min.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/buttons.dataTables.min.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/dataTables.colReorder.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/keyTable.dataTables.min.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/select.dataTables.min.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/editor.dataTables.min.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/jquery.modal.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/phpmyjoomla_css_custom.css');
$doc->addStyleSheet(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/css/phpmyjoomla.css');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<?php
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/jquery-3.3.1.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/datatables.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/dataTables.buttons.min.js');

$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/buttons.flash.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/jszip.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/pdfmake.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/vfs_fonts.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/buttons.html5.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/export/buttons.print.min.js');

$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/buttons.colVis.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/dataTables.colReorder.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/jquery.dataTables.columnFilter.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/dataTables.select.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/dataTables.keyTable.min.js');

$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/editor/dataTables.editor.min.js');

$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/jquery.modal.min.js');
$doc->addScript(JURI::root() . 'administrator/components/com_phpmyjoomla/assets/js/phpmyjoomla_js_custom.js');

$doc->addScript(JURI::root() . 'media/jui/js/jquery.min.js');
$doc->addScript(JURI::root() . 'media/jui/js/jquery-noconflict.js');
$doc->addScript(JURI::root() . 'media/jui/js/jquery-migrate.min.js');
$doc->addScript(JURI::root() . 'media/system/js/core.js');
?>
<div id="ajax_shield" name="export_shield" class="clean_background"></div>
<div id="ajax_loading" class="loading-invisible">
    <p>
        <img src="<?php echo JURI::root() . 'administrator/components/com_phpmyjoomla/assets/images/loading.gif';?>" alt="Loading" />
    </p>
</div>
