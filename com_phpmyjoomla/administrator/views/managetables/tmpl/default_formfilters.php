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
<div class="span12">
    <hr/>
</div>
<div class="span12 pmjfilters">
    <form id="frmselectserverdbtable" name="frmselectserverdbtable" method="POST">
        <div class="span4 serverfilters">
            <div><h3><?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_TITLE_SERVER');?></h3></div>
            <div id="serverlist">
                <?php  $arrServers = clsPhpMyJoomlaUtils::arrGetExternalServers(); ?>
                <i class="fa fa-server" style="font-size: 25px;margin-right: 10px;"></i>
                <select id="select_server" name="select_server">
                    <option <?php echo (($this->select_server == PMJ_SERVER_LOCALHOST)? 'selected' : ''); ?> value="<?php echo PMJ_SERVER_LOCALHOST; ?>"><?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_LOCALHOST');?></option>
                    <option <?php echo (($this->select_server == PMJ_SERVER_QUICK)? 'selected' : ''); ?> value="<?php echo PMJ_SERVER_QUICK; ?>"><?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_QUICKCONNECTION');?></option>
                    <?php foreach ($arrServers as $server_id => $server) { ?>
                        <?php $selected = ($this->select_server == $server_id)? 'selected' : '';?>
                        <option <?php echo $selected ?> value="<?php echo $server_id?>"><?php echo $server?></option>
                    <?php } ?>
                </select>
            </div>
            <div id="datatabaselist">
                <?php  $arrDatabases = clsPhpMyJoomlaUtils::arrGetDatabases($this->select_server); ?>
                <i class="fa fa-database" style="font-size: 25px;margin-right: 14px;"></i>
                <select id="select_db" name="select_db">
                    <?php if (empty($arrDatabases)) { ?>
                        <option selected value="<?php echo PMJ_DATABASES_NO_SELECT?>"><?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_NODATABASES');?></option>
                    <?php } else { ?>
                        <?php foreach ($arrDatabases as $db) { ?>
                            <?php $selected = ($this->select_db == $db)? 'selected' : '';?>
                            <option <?php echo $selected ?> value="<?php echo $db?>"><?php echo $db?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div id="tablelist">
                <?php $arrTableList = clsPhpMyJoomlaUtils::arrGetTables($this->select_db, $this->select_server); ?>
                <i class="fa fa-table" style="font-size: 25px;margin-right: 12px;"></i>
                <select id="select_table" name="select_table">
                    <?php if (empty($arrTableList)) { ?>
                        <option selected value="<?php echo PMJ_TABLES_NO_SELECT?>"><?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_NOTABLES');?></option>
                    <?php } else { ?>
                        <?php foreach ($arrTableList as $table) { ?>
                            <?php $selected = ($this->select_table == $table)? 'selected' : '';?>
                            <option <?php echo $selected ?> value="<?php echo $table?>"><?php echo $table?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <input id="load_table" name="load_table" type="button" class="buttons-phpmyjoomla-blue" value="<?php echo JText::_('COM_PHPMYJOOMLA_SERVER_TEXT_BUTTON_LOAD');?>">
            </div>
            <input type="hidden" id="loaded_server" name="loaded_server" value="<?php echo $this->loaded_server;?>"/>
            <input type="hidden" id="loaded_db" name="loaded_db" value="<?php echo $this->loaded_db;?>"/>
            <input type="hidden" id="loaded_table" name="loaded_table" value="<?php echo $this->loaded_table;?>"/>
            <input type="hidden" id="flag_serverchange" name="flag_serverchange" value="0"/>
        </div>
        <div class="span4 quickfilters">
            <div>
                <h3><?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_TITLE_QUICKCONNECTION');?></h3>
                <p><?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_WARNING');?></p>
                <div>
	                <span id="">
	                <i class="fa fa-cloud" style="font-size: 25px;margin-right: 12px;"></i><input type="text" placeholder="<?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_PLACEHOLDER_HOST');?>" id="quickconn_host" name="quickconn_host" value="<?php echo $this->quickconn_host;?>">
	                </span>
                    <span id="">
		                <i class="fa fa-user" style="font-size: 25px;margin-right: 18px;"></i><input type="text" placeholder="<?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_PLACEHOLDER_USER');?>" id="quickconn_username" name="quickconn_username" value="<?php echo $this->quickconn_username;?>">
	                </span>
                </div>
                <div>
	                <span id="">
	                    <i class="fa fa-eye" style="font-size: 25px;margin-right: 10px;"></i><input type="password" placeholder="<?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_PLACEHOLDER_PASSWORD');?>" id="quickconn_password" name="quickconn_password" value="<?php echo $this->quickconn_password;?>">
	                </span>
                    <span id="">
                    	<i class="fa fa-refresh" style="font-size: 25px;margin-right: 10px;"></i><input id="check_conn" name="check_conn" type="button" class="buttons-phpmyjoomla-blue" value="<?php echo JText::_('COM_PHPMYJOOMLA_QUICKCONNECTION_TEXT_BUTTON_TESTCONNECTION');?>">
                    </span>
                </div>
            </div>
        </div>
        <div class="span4 savedlistqueries">
        </div>
    </form>
</div>
<div class="span12">
    <hr/>
</div>