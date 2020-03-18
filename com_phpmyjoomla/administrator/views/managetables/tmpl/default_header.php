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
            <a href="http://www.phpmyjoomla.com" target="_blank">
                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/Logo_phpMyJoomla.png" alt="phpMyJoomla logo" style="max-width: 150px;" />
            </a>
        </div>
        <div class="span5">
            <h2><?php echo JText::_('COM_PHPMYJOOMLA_TEXT_PRINCIPALTITLE');?></h2>
            <a href="https://www.phpmyjoomla.com/member-login" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-users pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_MEMBERS');?></button></a>
            <a href="https://www.phpmyjoomla.com/support" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-question-circle pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_SUPPORT');?></button></a>
            <a href="https://www.phpmyjoomla.com" target="_blank"><button type="button" class="btn btn-info"><i class="fa fa-book pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TEXTBUTTON_DOCUMENTATION');?></button></a>

            <div class="overlay" id="overlay2" style="display:none;">
            </div>
            <div class="box" id="box2">
                <a class="boxclose" id="boxclose2"></a>
                <h1 style="text-align: center;"><?php echo JText::_('COM_PHPMYJOOMLA_TOOLS_TITLE');?></h1>
                <div class="span12">
                    <div class="span12" style="margin-top: 15px;">
                        <div class="span6">
                            <a href="https://component-creator.com/" target="_blank">
                                <svg style="margin: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="-183.9 385.9 144.5 18.8">
                                    <circle class="vector-brand-circle" cx="-174.1" cy="395.5" r="2.9"></circle>
                                    <path class="vector-brand-letters" d="M-168.8 400.2l-1.7-1.7c-0.9 1.1-2.2 1.8-3.7 1.8 -2.6 0-4.8-2.1-4.8-4.8 0-2.6 2.1-4.8 4.8-4.8 1.4 0 2.7 0.6 3.6 1.6l1.6-1.8c-0.5-0.6-1.1-1-1.8-1.4l0.2-1.8 -2-0.6 -0.8 1.5c-0.3 0-0.6-0.1-0.9-0.1 -0.2 0-0.5 0-0.7 0l-0.8-1.6 -2 0.6 0.2 1.8c-0.5 0.3-1 0.6-1.5 1l-1.5-0.8 -1.3 1.6 1.1 1.3c-0.3 0.6-0.5 1.3-0.7 1.9l-1.7 0.3v2.3l1.7 0.3c0.1 0.7 0.3 1.3 0.7 1.9l-1.2 1.3 1.3 1.6 1.5-0.8c0.4 0.4 0.9 0.7 1.5 1l0.1 1.7 2 0.6 0.8-1.5c0.2 0 0.5 0 0.7 0 0.3 0 0.6 0 0.9-0.1l0.7 1.5 2-0.6 -0.2-1.7C-170 401.3-169.4 400.8-168.8 400.2z"></path>
                                    <path class="vector-brand-letters" d="M-159.6 395.7L-159.6 395.7c0-2.4 1.8-4.4 4.4-4.4 1.6 0 2.5 0.5 3.3 1.3l-1.2 1.4c-0.6-0.6-1.3-0.9-2.1-0.9 -1.4 0-2.4 1.2-2.4 2.6l0 0c0 1.4 1 2.6 2.4 2.6 1 0 1.5-0.4 2.2-1l1.2 1.2c-0.9 0.9-1.8 1.5-3.4 1.5C-157.8 400.1-159.6 398.2-159.6 395.7z"></path>
                                    <path class="vector-brand-letters" d="M-151 396.7L-151 396.7c0-1.9 1.5-3.4 3.5-3.4s3.5 1.5 3.5 3.3l0 0c0 1.8-1.5 3.3-3.5 3.3C-149.6 400.1-151 398.6-151 396.7zM-145.9 396.7L-145.9 396.7c0-1-0.7-1.8-1.7-1.8s-1.7 0.8-1.7 1.8l0 0c0 0.9 0.7 1.8 1.7 1.8C-146.5 398.5-145.9 397.7-145.9 396.7z"></path>
                                    <path class="vector-brand-letters" d="M-142.8 393.5h1.8v0.9c0.4-0.5 1-1 1.9-1 0.8 0 1.5 0.4 1.8 1 0.6-0.7 1.2-1 2.1-1 1.4 0 2.2 0.8 2.2 2.4v4.2h-1.8v-3.6c0-0.9-0.4-1.3-1.1-1.3 -0.7 0-1.1 0.4-1.1 1.3v3.6h-1.8v-3.6c0-0.9-0.4-1.3-1.1-1.3 -0.7 0-1.1 0.4-1.1 1.3v3.6h-1.8V393.5z"></path>
                                    <path class="vector-brand-letters" d="M-131.2 393.5h1.8v0.9c0.4-0.6 1.1-1 2-1 1.5 0 2.9 1.2 2.9 3.3l0 0c0 2.1-1.4 3.3-2.9 3.3 -1 0-1.6-0.4-2-1v2.8h-1.8V393.5zM-126.3 396.7L-126.3 396.7c0-1.1-0.7-1.8-1.6-1.8s-1.6 0.7-1.6 1.8l0 0c0 1.1 0.7 1.8 1.6 1.8S-126.3 397.8-126.3 396.7z"></path>
                                    <path class="vector-brand-letters" d="M-123.6 396.7L-123.6 396.7c0-1.9 1.5-3.4 3.5-3.4s3.5 1.5 3.5 3.3l0 0c0 1.8-1.5 3.3-3.5 3.3C-122.1 400.1-123.6 398.6-123.6 396.7zM-118.5 396.7L-118.5 396.7c0-1-0.7-1.8-1.7-1.8s-1.7 0.8-1.7 1.8l0 0c0 0.9 0.7 1.8 1.7 1.8C-119.1 398.5-118.5 397.7-118.5 396.7z"></path>
                                    <path class="vector-brand-letters" d="M-115.6 393.5h1.8v0.9c0.4-0.5 1-1 1.9-1 1.4 0 2.2 0.9 2.2 2.4v4.2h-1.8v-3.6c0-0.9-0.4-1.3-1.1-1.3s-1.1 0.4-1.1 1.3v3.6h-1.8L-115.6 393.5 -115.6 393.5z"></path>
                                    <path class="vector-brand-letters" d="M-108.4 396.7L-108.4 396.7c0-1.9 1.3-3.4 3.2-3.4 2.1 0 3.1 1.7 3.1 3.5 0 0.1 0 0.3 0 0.5h-4.5c0.2 0.8 0.8 1.3 1.6 1.3 0.6 0 1.1-0.2 1.6-0.7l1 0.9c-0.6 0.7-1.5 1.2-2.6 1.2C-107 400.1-108.4 398.7-108.4 396.7zM-103.9 396.2c-0.1-0.8-0.6-1.4-1.4-1.4s-1.2 0.5-1.4 1.4H-103.9z"></path>
                                    <path class="vector-brand-letters" d="M-100.7 393.5h1.8v0.9c0.4-0.5 1-1 1.9-1 1.4 0 2.2 0.9 2.2 2.4v4.2h-1.8v-3.6c0-0.9-0.4-1.3-1.1-1.3s-1.1 0.4-1.1 1.3v3.6h-1.8L-100.7 393.5 -100.7 393.5z"></path>
                                    <path class="vector-brand-letters" d="M-93 398.1v-3h-0.8v-1.6h0.8v-1.6h1.8v1.6h1.5v1.6h-1.5v2.7c0 0.4 0.2 0.6 0.6 0.6 0.3 0 0.6-0.1 0.9-0.2v1.5c-0.4 0.2-0.8 0.4-1.4 0.4C-92.2 400-93 399.6-93 398.1z"></path>
                                    <path class="vector-brand-letters" d="M-84.9 395.7L-84.9 395.7c0-2.4 1.8-4.4 4.4-4.4 1.6 0 2.5 0.5 3.3 1.3l-1.2 1.4c-0.6-0.6-1.3-0.9-2.1-0.9 -1.4 0-2.4 1.2-2.4 2.6l0 0c0 1.4 1 2.6 2.4 2.6 1 0 1.5-0.4 2.2-1l1.2 1.2c-0.9 0.9-1.8 1.5-3.4 1.5C-83 400.1-84.9 398.2-84.9 395.7z"></path>
                                    <path class="vector-brand-letters" d="M-75.8 393.5h1.8v1.3c0.4-0.9 1-1.5 2.1-1.4v1.9H-72c-1.2 0-2 0.7-2 2.3v2.4h-1.8V393.5z"></path>
                                    <path class="vector-brand-letters" d="M-71.3 396.7L-71.3 396.7c0-1.9 1.3-3.4 3.2-3.4 2.1 0 3.1 1.7 3.1 3.5 0 0.1 0 0.3 0 0.5h-4.5c0.2 0.8 0.8 1.3 1.6 1.3 0.6 0 1.1-0.2 1.6-0.7l1 0.9c-0.6 0.7-1.5 1.2-2.6 1.2C-69.9 400.1-71.3 398.7-71.3 396.7zM-66.8 396.2c-0.1-0.8-0.6-1.4-1.4-1.4 -0.8 0-1.2 0.5-1.4 1.4H-66.8z"></path>
                                    <path class="vector-brand-letters" d="M-64 398.1L-64 398.1c0-1.4 1.1-2.1 2.6-2.1 0.6 0 1.1 0.1 1.6 0.3v-0.1c0-0.8-0.5-1.2-1.4-1.2 -0.7 0-1.2 0.1-1.8 0.3l-0.5-1.4c0.7-0.3 1.4-0.5 2.5-0.5 1 0 1.7 0.3 2.2 0.7 0.5 0.5 0.7 1.2 0.7 2.1v3.7h-1.8v-0.7c-0.4 0.5-1.1 0.8-1.9 0.8C-63 400-64 399.3-64 398.1zM-59.8 397.7v-0.3c-0.3-0.1-0.7-0.2-1.2-0.2 -0.8 0-1.3 0.3-1.3 0.9l0 0c0 0.5 0.4 0.8 1 0.8C-60.4 398.8-59.8 398.3-59.8 397.7z"></path>
                                    <path class="vector-brand-letters" d="M-56.3 398.1v-3h-0.8v-1.6h0.8v-1.6h1.8v1.6h1.5v1.6h-1.5v2.7c0 0.4 0.2 0.6 0.6 0.6 0.3 0 0.6-0.1 0.9-0.2v1.5c-0.4 0.2-0.8 0.4-1.4 0.4C-55.5 400-56.3 399.6-56.3 398.1z"></path>
                                    <path class="vector-brand-letters" d="M-52.1 396.7L-52.1 396.7c0-1.9 1.5-3.4 3.5-3.4s3.5 1.5 3.5 3.3l0 0c0 1.8-1.5 3.3-3.5 3.3C-50.6 400.1-52.1 398.6-52.1 396.7zM-46.9 396.7L-46.9 396.7c0-1-0.7-1.8-1.7-1.8s-1.7 0.8-1.7 1.8l0 0c0 0.9 0.7 1.8 1.7 1.8C-47.6 398.5-46.9 397.7-46.9 396.7z"></path>
                                    <path class="vector-brand-letters" d="M-43.8 393.5h1.8v1.3c0.4-0.9 1-1.5 2.1-1.4v1.9H-40c-1.2 0-2 0.7-2 2.3v2.4h-1.8V393.5z"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="span6">
                            <a href="https://datatables.net/" target="_blank">
                                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/tools/datatables_m.png" alt="datatables logo" style="max-width: 150px;display: block;margin: auto">
                            </a>
                        </div>
                    </div>
                    <div class="span12" style="margin-top: 15px;">
                        <div class="span6">
                            <a href="https://getbootstrap.com/" target="_blank">
                                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/tools/bootstrap_m.png" alt="bootstrap logo" style="max-width: 150px;display: block;margin: auto">
                            </a>
                        </div>
                        <div class="span6">
                            <a href="https://fontawesome.com/" target="_blank">
                                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/tools/fontawesome_m.png" alt="font awesome logo" style="max-width: 150px;display: block;margin: auto">
                            </a>
                        </div>
                    </div>
                    <div class="span12" style="margin-top: 15px;">
                        <div class="span6">
                            <a href="https://jquery.com/" target="_blank">
                                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/tools/jquery_m.png" alt="jquery logo" style="max-width: 150px;display: block;margin: auto">
                            </a>
                        </div>
                        <div class="span6">
                            <a href="https://en.wikipedia.org/wiki/Ajax_(programming)" target="_blank">
                                <img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/tools/ajax2_m.png" alt="ajax logo" style="max-width: 150px;display: block;margin: auto">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a id="list" style="" href="#"><button id="activator2" class="btn btn-info"><i class="fas fa-wrench pad-r10"></i><?php echo JText::_('COM_PHPMYJOOMLA_TOOLS_BUTTON_TITLE');?></button></a>
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