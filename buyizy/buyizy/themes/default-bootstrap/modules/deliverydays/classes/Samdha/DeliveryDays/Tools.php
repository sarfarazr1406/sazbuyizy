<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please refer to http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
 * #Overridingdefaultbehaviors-Overridingamodule%27sbehavior for more information.
 *
 * @category  Prestashop
 * @category  Module
 * @author    Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license   commercial license see license.txt
 */

class Samdha_DeliveryDays_Tools
{
	private $module;

	public function __construct($module)
	{
		$this->module = $module;
	}

	/**
	 * convert POST data to valid settings
	 */
	public function cleanSettings()
	{
		// make sure that config is initialised
		$this->module->config->getAsArray();

		$setting = Tools::getValue('setting');
		if (is_array($setting))
			foreach ($this->module->config_arrays_keys as $key)
			{
				if (isset($setting[$key]) && $this->startsWith($key, 'exception'))
					$_POST['setting'][$key] = explode(',', trim($setting[$key]));
				if (isset($setting[$key]) && $this->startsWith($key, 'timeframe'))
					$_POST['setting'][$key] = explode("\n", trim($setting[$key]));
			}
	}

	/**
	 * Say if $haystack start with $needle
	 *
	 * @param string $haystack Where to search
	 * @param string $needle What to search
	 * @return boolean
	 */
	public function startsWith($haystack, $needle)
	{
		return (Tools::subStr($haystack, 0, Tools::strLen($needle)) === $needle);
	}

	/**
	 * check if patch has been applied
	 * if not try to apply it
	 * for Prestashop < 1.5.0.0
	 *
	 * @param string $patch_dir directory of patches
	 * @return boolean true if patch applied
	 */
	public function checkPatch($patch_dir)
	{
		if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
			return true;
		elseif (version_compare(_PS_VERSION_, '1.4.0.0', '<'))
			$module = $this->module->samdha_tools->fileGetContents(_PS_ROOT_DIR_.'/classes/PDF.php');
		else
		{
			// try to auto patch
			if (!file_exists(_PS_ROOT_DIR_.'/override/classes/PDF.php'))
			{
				if (file_exists($patch_dir._PS_VERSION_.'/'))
					$this->recurseCopy($patch_dir._PS_VERSION_.'/', _PS_ROOT_DIR_);
				else
					$this->recurseCopy($patch_dir.'1.4.x.x/', _PS_ROOT_DIR_);
			}
			if (file_exists(_PS_ROOT_DIR_.'/override/classes/PDF.php'))
				$module = $this->module->samdha_tools->fileGetContents(_PS_ROOT_DIR_.'/override/classes/PDF.php');
			else
				$module = '';
		}
		return strpos($module, $this->module->name);
	}

	/* http://www.php.net/manual/fr/function.copy.php#91010 */
	public function recurseCopy($src, $dst)
	{
		$dir = opendir($src);
		if ($dir)
		{
			if (!file_exists($dst))
				@mkdir($dst);

			while (false !== ($file = readdir($dir)))
			{
				if (($file != '.') && ($file != '..') && ($file != 'index.php'))
				{
					if (is_dir($src.DIRECTORY_SEPARATOR.$file))
						$this->recurseCopy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file);
					elseif (!file_exists($dst.DIRECTORY_SEPARATOR.$file))
						copy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file);
				}
			}
			closedir($dir);
		}
	}

	/**
	 * convert config from version < 2.0.0.0
	 */
	public function importOldConfig()
	{
		$convert = array(
			'_id_employee'  => 'id_employee',
			'_mailcustomer' => 'mailcustomer',
			'_required'     => 'required0',
			'_timeframe'    => 'timeframe0',
			'_duration'     => 'duration0',
			'_offset'       => 'offsets0',
			'_minute'       => 'minutes0',
			'_hour'         => 'hours0'
		);
		foreach ($convert as $from => $to)
		{
			if (Configuration::get($this->module->short_name.$from) !== false)
			{
				$this->module->config->$to = Configuration::get($this->module->short_name.$from);
				Configuration::deleteByName($this->module->short_name.$from);
			}
		}

		if (Configuration::get($this->module->short_name.'_exception') !== false)
		{
			$this->module->config->_exception = explode(',', Configuration::get($this->module->short_name.'_exception'));
			Configuration::deleteByName($this->module->short_name.'_exception');
		}
		if (Configuration::get($this->module->short_name.'_days') !== false)
		{
			$days = array_fill(0, 7, 0);
			$old_days = explode(',', Configuration::get($this->module->short_name.'_days'));
			foreach ($old_days as $day)
				$days[$day] = 1;
			$this->module->config->days0 = $days;
			Configuration::deleteByName($this->module->short_name.'_days');
		}
	}

	/**
	 * Return current group object
	 * same as Group::getCurrent with 1.5.0.0 < compatibility
	 *
	 * @return Group Group object
	 */
	public function getCurrentGroup()
	{
		if (method_exists('Group', 'getCurrent'))
			return Group::getCurrent();
		else
		{
			static $groups = array();

			$customer = $this->module->context->customer;
			$id_group = Validate::isLoadedObject($customer)?(int)$customer->id_default_group:1;

			if (!isset($groups[$id_group]))
				$groups[$id_group] = new Group($id_group);

			return $groups[$id_group];
		}
	}
}
