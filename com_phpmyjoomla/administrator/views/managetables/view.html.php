<?php
/**
 * @version     3.0.0
 * @package     phpMyJoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

use \Joomla\CMS\Language\Text;

/**
 * View class for a list of Phpmyjoomla.
 *
 * @since  1.6
 */
class PhpmyjoomlaViewManagetables extends \Joomla\CMS\MVC\View\HtmlView
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
        
        

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		PhpmyjoomlaHelper::addSubmenu('managetables');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = PhpmyjoomlaHelper::getActions();

		JToolBarHelper::title(Text::_('COM_PHPMYJOOMLA_TITLE_MANAGETABLES'), 'managetables.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/managetable';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('managetable.add', 'JTOOLBAR_NEW');

				if (isset($this->items[0]))
				{
					JToolbarHelper::custom('managetables.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
				}
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('managetable.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('managetables.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('managetables.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'managetables.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('managetables.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('managetables.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('', 'managetables.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::trash('managetables.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_phpmyjoomla');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_phpmyjoomla&view=managetables');
	}

	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`id`' => JText::_('JGRID_HEADING_ID'),
			'a.`state`' => JText::_('JSTATUS'),
			'a.`name`' => JText::_('COM_PHPMYJOOMLA_SERVERSS_NAME'),
			'a.`username`' => JText::_('COM_PHPMYJOOMLA_SERVERSS_USERNAME'),
			'a.`host`' => JText::_('COM_PHPMYJOOMLA_SERVERSS_HOST'),
			'a.`password`' => JText::_('COM_PHPMYJOOMLA_SERVERSS_PASSWORD'),
		);
	}

    /**
     * Check if state is set
     *
     * @param   mixed  $state  State
     *
     * @return bool
     */
    public function getState($state)
    {
        return isset($this->state->{$state}) ? $this->state->{$state} : false;
    }
}
