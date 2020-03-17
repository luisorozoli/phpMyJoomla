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

//Component Options
$configuration_accordion= JComponentHelper::getParams('com_phpmyjoomla')->get('configuration_accordion','0');
?>

<?php echo $this->loadTemplate('head'); ?>
<body style="font-family: 'Arial';">

<?php if ($configuration_accordion) { ?>
    <!-- Accordion Item 1 -->
    <div class="card">
        <div class="card-header" role="tab" id="accordionHeadingOne">
            <div class="mb-0 row" style="margin-left: 0px;">
                <div class="col-12 no-padding accordion-head1">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyOne" aria-expanded="false" aria-controls="accordionBodyOne"
                       class="collapsed ">
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                        <h3 style="margin-left: 40px;line-height: 30px;"><?php echo JText::_('COM_PHPMYJOOMLA_ACCORDION_TITLE1');?></h3>
                    </a>
                </div>
            </div>
        </div>
        <div id="accordionBodyOne" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingOne" aria-expanded="false" data-parent="accordion">
            <div class="card-block col-12">
                <?php echo $this->loadTemplate('header');?>
            </div>
        </div>
    </div>

    <div class="span12">
        <hr/>
    </div>

    <!-- Accordion Item 2 -->
    <div class="card">
        <div class="card-header" role="tab" id="accordionHeadingTwo">
            <div class="mb-0 row" style="margin-left: 0px;">
                <div class="col-12 no-padding accordion-head2">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyTwo" aria-expanded="false" aria-controls="accordionBodyTwo"
                       class="collapsed ">
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                        <h3 style="margin-left: 40px;line-height: 30px;"><?php echo JText::_('COM_PHPMYJOOMLA_ACCORDION_TITLE2');?></h3>
                    </a>
                </div>
            </div>
        </div>
        <div id="accordionBodyTwo" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingTwo" aria-expanded="false" data-parent="accordion">
            <div class="card-block col-12">
                <?php echo $this->loadTemplate('formfilters');?>
            </div>
        </div>
    </div>

    <div class="span12">
        <hr>
    </div>

    <?php echo $this->loadTemplate('modal_version');?>

    <!-- Accordion Item 3 -->
    <div class="card">
        <div class="card-header" role="tab" id="accordionHeadingThree">
            <div class="mb-0 row" style="margin-left: 0px;">
                <div class="col-12 no-padding accordion-head3">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyThree" aria-expanded="false" aria-controls="accordionBodyThree"
                       class="collapsed ">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <h3 style="margin-left: 40px;line-height: 30px;"><?php echo JText::_('COM_PHPMYJOOMLA_ACCORDION_TITLE3');?></h3>
                    </a>
                </div>
            </div>
        </div>
        <div id="accordionBodyThree" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingThree" aria-expanded="false" data-parent="accordion">
            <div class="card-block col-12">
                <?php
                if ($this->select_table != PMJ_TABLES_NO_SELECT) {
                    echo $this->loadTemplate('formtable');
                }
                ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div id="container">
        <div class="span12">
            <div class="span4">
                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/logo_small.png" alt="phpMyJoomla logo" />
            </div>
            <div class="span5">
                <h2><?php echo JText::_('COM_PHPMYJOOMLA_TEXT_PRINCIPALTITLE');?></h2>
                <a href="https://www.phpmyjoomla.com/member-login" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-users pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_MEMBERS');?></button></a>
                <a href="https://www.phpmyjoomla.com/support" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-question-circle pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_SUPPORT');?></button></a>
                <a href="https://www.phpmyjoomla.com" target="_blank"><button type="button" class="btn btn-info"><i class="fa fa-book pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_DOCUMENTATION');?></button></a>
            </div>
            <div class="span3 esbutton fright">
                <!-- Link to open the modal -->
                <a class="fright" href="#ex3" rel="modal:open">
                    <div id="phpmyjoomla_version">
                        <?php echo JText::_('COM_PHPMYJOOMLA_VERSION');?>
                        <i class="fa fa-info-circle"></i>
                    </div>
                </a>
                <br />
                <img class="fright" src="components/com_phpmyjoomla/assets/images/phpmyjoomla/joomla_3x.png" alt="Joomla Compact 3.x logo" />
            </div>
            <br />
            <a href="index.php?option=com_phpmyjoomla&view=serverss"><button type="button" class="btn btn-primary fright"><i class="fa fa-cubes pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_EXTERNALSERVERS');?></button></a>
        </div>
    </div>
    <div class="span12">
        <hr>
    </div>
    <?php echo $this->loadTemplate('formfilters'); ?>
    <div class="span12">
        <hr>
    </div>
    <?php echo $this->loadTemplate('modal_version');
    if ($this->select_table != PMJ_TABLES_NO_SELECT) {
        echo $this->loadTemplate('formtable');
    }
    ?>
<?php }  ?>
</div>
<?php echo $this->loadTemplate('footer'); ?>
</body>
</html>
<script>
    var blnAjaxSubmission = true;
    $("#select_server" ).change(function() {
        $("#flag_serverchange").val(1);
        var blnIsConnectionOK = checkConnection();
        if (blnIsConnectionOK) {
            var blnAjaxSubmit = window.blnAjaxSubmission;
            if (blnAjaxSubmit) {
                showLoadingDiv();
                $.ajax({
                    url : './index.php?option=com_phpmyjoomla&view=managetables&ajax=1&ajaxaction=generateoptiononserverchange',
                    type: 'POST',
                    data: getServerFormDetails(),
                    async:false,
                    success: function(data) {
                        var jsonResult = jQuery.parseJSON(data);
                        $("#select_db").html(jsonResult.html);
                        $.ajax({
                            url : './index.php?option=com_phpmyjoomla&view=managetables&ajax=1&ajaxaction=generateoptionondatabasechange',
                            type: 'POST',
                            data: getServerFormDetails(),
                            async:false,
                            success: function(data) {
                                var jsonResult = jQuery.parseJSON(data);
                                $("#select_table").html(jsonResult.html);
                            }
                        });
                    }
                }).done(function() {
                    $("#flag_serverchange").val(0);
                    hideLoadingDiv();
                });
            }
            else {
                showLoadingDiv();
                $("#frmselectserverdbtable").submit();
            }
        }
        else {
            alert('Unable to establish connection to the selected server. Please make sure that your MySQL server allows remote connection using the credentials you provided.')
            // Get default current property pointing to selected server. If none, defaults to Localhost
            var currentDataAttrib = $.data(this, 'current');
            if (currentDataAttrib === undefined) {
                currentDataAttrib = '<?php echo PMJ_SERVER_LOCALHOST?>';
            }
            $(this).val(currentDataAttrib);
            return false;
        }

        $.data(this, 'current', $(this).val()); // Set default current property pointing to selected server
    });

    $("#select_db" ).change(function() {
        showLoadingDiv();
        var blnAjaxSubmit = window.blnAjaxSubmission;
        if (blnAjaxSubmit) {
            showLoadingDiv();
            $.ajax({
                url : './index.php?option=com_phpmyjoomla&view=managetables&ajax=1&ajaxaction=generateoptionondatabasechange',
                type: 'POST',
                data: getServerFormDetails(),
                async:false,
                success: function(data) {
                    var jsonResult = jQuery.parseJSON(data);
                    $("#select_table").html(jsonResult.html);
                }
            }).done(function() {
                hideLoadingDiv();
            });
        }
        else {
            showLoadingDiv();
            $("#frmselectserverdbtable").submit();
        }
    });

    $("#load_table" ).click(function() {
        $("#loaded_server").val($("#select_server").val());
        $("#loaded_db").val($("#select_db").val());
        $("#loaded_table").val($("#select_table").val());
        showLoadingDiv();
        $("#frmselectserverdbtable").submit();
    });

    $("#check_conn" ).click(function() {
        showLoadingDiv();
        var blnAjaxSubmit = window.blnAjaxSubmission;
        if (blnAjaxSubmit) {
            showLoadingDiv();
            $.ajax({
                url : './index.php?option=com_phpmyjoomla&view=managetables&ajax=1&ajaxaction=testquickconnection',
                type: 'POST',
                data: getServerFormDetails(),
                async:false,
                success: function(data) {
                    if (data == '1') {
                        alert('Connection successful!');
                    }
                    else {
                        alert('Connection failed...');
                    }
                }
            }).done(function() {
                hideLoadingDiv();
            });
        }
        else {
            showLoadingDiv();
            $("#frmselectserverdbtable").submit();
        }
    });

    function checkConnection() {
        var blnOK = false;
        $.ajax({
            url : './index.php?option=com_phpmyjoomla&view=managetables&ajax=1&ajaxaction=testconnection',
            type: 'POST',
            data: getServerFormDetails(),
            async:false,
            success: function(data) {
                if (data == '1') {
                    blnOK = true;
                }
                else {
                    blnOK = false;
                }
            }
        });

        return blnOK;
    }

    function getServerFormDetails() {
        var dataServerForm = {
            'flag_serverchange': $("#flag_serverchange").val(),
            'select_server': $("#select_server").val(),
            'select_db': $("#select_db").val(),
            'select_table': $("#select_table").val(),
            'loaded_server': $("#loaded_server").val(),
            'loaded_db': $("#loaded_db").val(),
            'loaded_table': $("#loaded_table").val(),
            'quickconn_host': $("#quickconn_host").val(),
            'quickconn_database': $("#quickconn_database").val(),
            'quickconn_username': $("#quickconn_username").val(),
            'quickconn_password': $("#quickconn_password").val()
        }
        return dataServerForm;
    }
</script>