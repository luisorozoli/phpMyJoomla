<?php
/**
 * @version     2.1.0
 * @package     com_phpmyjoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
 
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of phpMyJoomla.
 */
class phpMyJoomlaViewManagetables extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;
    
    protected $objTableGen;
    
    // Post server, db, table filter varibles
    protected $select_server;
    protected $select_db;
    protected $select_table;
    
    protected $quickconn_host;
    protected $quickconn_database;
    protected $quickconn_username;
    protected $quickconn_password;
    
    protected $loaded_server;
    protected $loaded_db;
    protected $loaded_table;
    protected $blnHasRenderableStructure;

    // Post variables Ajax Specific
    protected $ajax = false;
    protected $ajaxAction;

    /**
     * Display the view 
    */
    public function display($tpl = null)
    {
        $this->ajax= JRequest::getVar('ajax', false);
        $this->ajaxAction= JRequest::getVar('ajaxaction');
        $this->quickconn_host = JRequest::getVar('quickconn_host','');
        $this->quickconn_database = JRequest::getVar('quickconn_database','');
        $this->quickconn_username = JRequest::getVar('quickconn_username','');
        $this->quickconn_password = JRequest::getVar('quickconn_password','');
        clsPhpMyJoomlaUtils::setQuickConnCredentials($this->quickconn_host,$this->quickconn_database,$this->quickconn_username,$this->quickconn_password);
        $flag_serverchange= JRequest::getVar('flag_serverchange',0);
        
        /*** Get default DB and Table Selection ***/
        $this->select_server = JRequest::getVar('select_server',PMJ_SERVER_LOCALHOST); //defaults to Localhost Selection
        
        if ($flag_serverchange) { // Forget to get default tables and databases on change of server
            $this->select_db = null;
            $this->select_db = clsPhpMyJoomlaValidation::validateDatabase($this->select_server, $this->select_db);
            $this->select_table = null;
            $this->select_table = clsPhpMyJoomlaValidation::validateTable($this->select_server, $this->select_db,$this->select_table);
        } else {
            $this->select_db = JRequest::getVar('select_db',  clsPhpMyJoomlaUtils::getDefaultDatabase($this->select_server)); // Defaults to current joomla db selection
            $this->select_db = clsPhpMyJoomlaValidation::validateDatabase($this->select_server, $this->select_db);
            $this->select_table = JRequest::getVar('select_table',PMJ_TABLES_NO_SELECT); // defaults to No table selection
            $this->select_table = clsPhpMyJoomlaValidation::validateTable($this->select_server, $this->select_db,$this->select_table);
        }
        $this->loaded_server = JRequest::getVar('loaded_server',$this->select_server); //defaults to current select server
        $this->loaded_db = JRequest::getVar('loaded_db',$this->select_db); //defaults to current select db
        $this->loaded_table = JRequest::getVar('loaded_table',$this->select_table); //defaults to current select table
        $this->blnHasRenderableStructure = (($this->loaded_db == PMJ_DATABASES_NO_SELECT) || ($this->loaded_table == PMJ_TABLES_NO_SELECT))? false: true;
        
        $this->objTableGen = new clsPhpMyJoomlaTableGen();
        if ($this->blnHasRenderableStructure) {
            $additionalParams = array();
            $additionalParams['quickconn_host'] = $this->quickconn_host;
            $additionalParams['quickconn_database'] = $this->quickconn_database;
            $additionalParams['quickconn_username'] = $this->quickconn_username;
            $additionalParams['quickconn_password'] = $this->quickconn_password;
            $this->objTableGen->addTable('tbl1',$this->loaded_table, $this->loaded_db, $this->loaded_server,$additionalParams);
        }

        /*** FOR AJAX RESPONSES ***/
        if ($this->ajax) {
            switch (strtolower($this->ajaxAction)) {
                case 'generatetablejson':
                    die($this->objTableGen->generateTableJSON('tbl1'));
                    break;
                case 'getcustomquerycolumns':
                    $query = JRequest::getVar('queryString','');
                    die($this->objTableGen->getCustomQueryColumns('tbl1', $query));
                    break;
                case 'runcustomquery':
                    $query = JRequest::getVar('queryString','');
                    die($this->objTableGen->getCustomQueryResult('tbl1', $query));
                    break;
                case 'editrecord':
                    die($this->updateRecord());
                    break;
                case 'generateoptiononserverchange':
                    try {
                        $this->generateDatabaseOptions();
                    }
                    catch (Exception $ex) {
                        die($ex->getMessage());
                    }
                    die(json_encode(array('success'=>'1','html' => $this->generateDatabaseOptions())));
                    break;
                case 'generateoptionondatabasechange':
                    die(json_encode(array('success'=>'1','html' => $this->generateTableOptions())));
                    break;
                case 'testquickconnection':
                    die($this->testQuickConnection());
                    break;
                case 'testconnection':
                    die($this->testConnection());
                    break;
                default: 
                    die('Invalid Ajax Request'); 
                    break;
            }
        }
        /*** FOR NORMAL HTTP RESPONSES ***/
        else {
            $this->state = $this->get('State');
            // Check for errors.
            if (count($errors = $this->get('Errors'))) {
                    throw new Exception(implode("\n", $errors));
            }
            phpMyJoomlaHelper::addSubmenu('managetables');
            $this->addToolbar();
            $this->sidebar = JHtmlSidebar::render();
            parent::display($tpl);
        }
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar() {
        require_once JPATH_COMPONENT . '/helpers/phpmyjoomla.php';

        $state = $this->get('State');
        $canDo = phpMyJoomlaHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_PHPMYJOOMLA_TITLE_MANAGETABLES'), 'managetables.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/managetable';
        if (file_exists($formPath)) {

#### NEW AND EDIT BUTTON DISABLE ####

//            if ($canDo->get('core.create')) {
//                JToolBarHelper::addNew('managetable.add', 'JTOOLBAR_NEW');
//            }
//
//            if ($canDo->get('core.edit') && isset($this->items[0])) {
//                JToolBarHelper::editList('managetable.edit', 'JTOOLBAR_EDIT');
//            }

#### END NEW AND EDIT BUTTON DISABLE ####

        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('managetables.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('managetables.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'managetables.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('managetables.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('managetables.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'managetables.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('managetables.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_phpmyjoomla');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_phpmyjoomla&view=managetables');

        $this->extra_sidebar = '';
        //
    }

	protected function getSortFields()
	{
		return array(
		);
	}
	
        private function generateDatabaseOptions() {
            $html = '';
            $arrDatabases = clsPhpMyJoomlaUtils::arrGetDatabases($this->select_server);
            if (empty($arrDatabases)) {
                $html .= '<option selected value="'. PMJ_DATABASES_NO_SELECT. '">No available databases</option>';
            } else {
                foreach ($arrDatabases as $db) {
                    $selected = ($this->select_db == $db)? 'selected' : '';
                    $html .= '<option ' . $selected . ' value="'.$db.'">'.$db.'</option>';
                }
            }
            return $html;
        }
         
        private function generateTableOptions() {
            $html = '';
            $arrTableList = clsPhpMyJoomlaUtils::arrGetTables($this->select_db, $this->select_server);
            if (empty($arrTableList)) {
                $html .= '<option selected value="'. PMJ_TABLES_NO_SELECT. '">No available tables</option>';
            } else {
                foreach ($arrTableList as $table) {
                    $selected = ($this->select_table == $table)? 'selected' : '';
                    $html .= '<option ' . $selected . ' value="'.$table.'">'.$table.'</option>';
                }
            }
            return $html;
        }
        
        private function testQuickConnection() {
            $db = clsPhpMyJoomlaUtils::getDynamicDBO(PMJ_SERVER_QUICK);
            $blnOk = clsPhpMyJoomlaUtils::testDynamicDBO($db);
            die(($blnOk == true)? '1':'0');
        }
        
        private function testConnection() {
            $db = clsPhpMyJoomlaUtils::getDynamicDBO($this->select_server);
            $blnOk = clsPhpMyJoomlaUtils::testDynamicDBO($db);
            die(($blnOk == true)? '1':'0');
        }
        
        private function updateRecord() {
            $jinput = JFactory::getApplication()->input;
            $tableData = $jinput->get('table', array(), 'ARRAY');
            $updateData = $jinput->get('data', array(), 'ARRAY');
            $query = clsPhpMyJoomlaQuery::processUpdate($tableData, $updateData);
            die(json_encode($query));
        }
}