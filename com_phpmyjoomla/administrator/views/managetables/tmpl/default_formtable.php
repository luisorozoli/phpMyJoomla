<?php
/**
 * @version     3.0.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */

// No direct access to this file

defined('_JEXEC') or die('Restricted access');
$jinput = JFactory::getApplication()->input;
$queryStr = $jinput->get('custom_query_field', '!wala', 'raw');
$custom = false;
if ($queryStr != '!wala') {
    $this->objTableGen->initializeQueryString($queryStr);
    $custom = true;
}
?>
    <div>
        <div class="overlay" id="overlay" style="display:none;">
        </div>
        <div class="box" id="box">
            <a class="boxclose" id="boxclose"></a>
            <h1 style="text-align: center;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_TITLE');?></h1>
            <p style="font-size: 15px; line-height: 25px;">
                <br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP1');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP1_LONG');?><br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP2');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP2_LONG');?><br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP3');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP3_LONG');?><br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP4');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP4_LONG');?><br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP5');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP5_LONG');?><br/>
                <span style="font-weight: bold;"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP6');?></span> <?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_STEP6_LONG');?>
            </p>
        </div>
        <a id="list" style="float: right;" href="#"><button id="activator" class="activator"><?php echo JText::_('COM_PHPMYJOOMLA_MANUAL_TEXT_BUTTON');?></button></a>
        <a id="list" style="margin-bottom: 70px;" href="#" class="customquery"><button onclick="setColorCustomQuery('customquery','#eee');" id="customquery" class="shcustom"><?php echo JText::_('COM_PHPMYJOOMLA_SHOWHIDE_CUSTOMQUERY_TEXT_BUTTON');?></button></a>
        <div class="customquery_toggle" style="overflow: visible; margin: 10px 0 0 0;">
            <?php echo $this->objTableGen->renderCustomQuery(); ?>
        </div>
        <a id="list" style="margin-bottom: 70px;" href="#" class="togglelink"><button onclick="setColorFilter('btnfilters','#eee');" id="btnfilters" class="shfilters"><?php echo JText::_('COM_PHPMYJOOMLA_SHOWHIDE_TEXT_BUTTON');?></button></a>
        <div class="toggle" style="display: block;">
            <?php if ($custom) { ?>
                <?php echo $this->objTableGen->renderCustomTableFilter('tbl1', $queryStr); ?>
            <?php } else { ?>
                <?php echo $this->objTableGen->renderTableFilter('tbl1'); ?>
            <?php } ?>
        </div>
        <form id="form" style="margin-top: 15px;">
            <?php if ($custom) { ?>
                <?php echo $this->objTableGen->renderCustomQueryTable('tbl1', $queryStr); ?>
            <?php } else { ?>
                <?php echo $this->objTableGen->renderTableData('tbl1'); ?>
            <?php } ?>
        </form>
    </div>

    <script>
        $("#process_custom_query" ).click(function() {
            $("#loaded_server").val($("#select_server").val());
            $("#loaded_db").val($("#select_db").val());
            $("#loaded_table").val($("#select_table").val());
            showLoadingDiv();
            $("#formcustomquery").submit();
        });
    </script>

<?php if ($custom) { ?>
    <script>
        $('#example').hide();
        $('#customtable').show();
        <?php
        echo $this->objTableGen->renderCustomTableScripts('tbl1');
        ?>
        $('.customquery_toggle').show();
    </script>
<?php } else { ?>
    <script>
        $('#customtable').hide();
        $('#example').show();
        <?php
        echo $this->objTableGen->renderTableScripts('tbl1');
        ?>
    </script>
<?php } ?>