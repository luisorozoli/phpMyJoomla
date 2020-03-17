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
?>
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