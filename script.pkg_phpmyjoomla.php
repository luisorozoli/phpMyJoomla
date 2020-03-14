<?php
/**
 * @version     2.1.0
 * @package     phpMyJoomla
 * @copyright   Copyright (c) 2014-2020. Luis Orozco Olivares / phpMyjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Luis Orozco Olivares <luisorozoli@gmail.com> - https://www.luisorozoli.com - https://www.phpmyjoomla.com
 */
// No direct access
defined('_JEXEC') or die;

class Pkg_phpMyJoomlaInstallerScript
{

	public function install ($parent)
	{
	}

	public function update ($parent)
	{
	}

	public function uninstall ($parent)
	{
	}

	public function postflight ($type, $parent)
	{
		$status = new stdClass;
		$this->installationResults($status);
	}

	private function installationResults ($status)
	{
		$language = JFactory::getLanguage();
		$language->load('com_phpmyjoomla');
		$rows = 0;
		?>
		<div>
			<a href="https://www.phpmyjoomla.com" target="_blank"><img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/logo_small.png" alt="phpMyJoomla logo" align="left" /></a>
			<a href="http://www.luisorozoli.com" target="_blank"><img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/logo_luisorozoli.png" alt="Luisorozoli logo" align="right" /></a>
		</div>
		<div align="center">
			<h1>phpMyJoomla Installation</h1>
			<h3><a href="index.php?option=com_phpmyjoomla">Go to the component phpMyJoomla</a></h3>
			<h3><a href="index.php?option=com_plugins&view=plugins&filter_search=phpmyjoomla">ENABLE the Pluging Quickicon phpMyJoomla</a></h3>
		</div>
		<br/>

		<div>
			<h3>TOOLS USED</h3>
			<p>
				For the development of this component have been used the following tools:<br /><br />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/joomla_3x.png" alt="Joomla! 3.6" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/joomla_35.png" alt="Joomla! 3.5" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/joomla_34.png" alt="Joomla! 3.4" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/joomla_33.png" alt="Joomla! 3.3" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/php-70x.png" alt="PHP 7.0" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/php-56x.png" alt="PHP 5.6" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/php-55x.jpeg" alt="PHP 5.5" align="left" style="padding-right: 5px;" />
				<img src="components/com_phpmyjoomla/assets/images/phpmyjoomla/php-54x.jpeg" alt="PHP 5.4" align="left" />
			</p>
		</div>
		<br/>

		<div>
			<p>
				- <a href="http://www.component-creator.com/" target="_blank">Component Creator</a><br />
				- <a href="http://www.datatables.net/" target="_blank">DataTables</a><br />
				- <a href="http://jquery.com/" target="_blank">JQuery & Ajax</a>
			</p>
		</div>
		<br/>

		<div class="">
			<h3>FORUM & SUPPORT</h3>
			<div>
				<p>
					Support in English and Spanish!
				</p>
				<p class="">
					<a href="https://www.phpmyjoomla.com/member-login" target="_blank"><button type="button" class="btn btn-success"><i class="icon-users" style="padding-right: 10px;"></i>MEMBERS</button></a>
					<a href="https://www.phpmyjoomla.com/support" target="_blank"><button type="button" class="btn btn-success"><i class="icon-question-sign" style="padding-right: 10px;"></i>SUPPORT</button></a>
					<a href="https://www.phpmyjoomla.com" target="_blank"><button type="button" class="btn btn-info"><i class="icon-book" style="padding-right: 10px;"></i>DOCUMENTATION</button></a>
				</p>
				<br/>
				<h3>Our Location</h3>
				<p>
					Luis Orozco Olivares | London (United Kingdom) | Spanish & English
				</p>
				<br/>
			</div>

			<h3>More information about the component in <a href='https://www.phpmyjoomla.com' target="_blank">www.phpmyjoomla.com</a>.</h3>

		<?php
	}

}
