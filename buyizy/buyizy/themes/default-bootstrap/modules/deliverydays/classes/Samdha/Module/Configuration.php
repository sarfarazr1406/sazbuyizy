<?php
/**
 * Configuration management
 *
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

if (!class_exists('Samdha_Module_Configuration', false))
{
	class Samdha_Module_Configuration
	{
		private $prefix;
		private $module;
		private $datas = array();
		private $initialised = false;
		const COMA_REPLACE = '%C0MA%';

		public function __construct($module)
		{
			$this->module = $module;
			$this->prefix = $module->short_name;
		}

		public function __get($key)
		{
			if (!$this->initialised)
				$this->init();
			if (array_key_exists($key, $this->datas))
				return $this->datas[$key];
		}

		public function __set($key, $value)
		{
			if (!$this->initialised)
				$this->init();
			if (array_key_exists($key, $this->datas))
			{
				$this->datas[$key] = $value;
				$this->save();
			}
		}

		public function __isset($key)
		{
			if (!$this->initialised)
				$this->init();
			return (array_key_exists($key, $this->datas));
		}

		/**
		 * get configuration datas as array
		 * @return array
		 **/
		public function getAsArray()
		{
			if (!$this->initialised)
				$this->init();
			return $this->datas;
		}

		private function isGlobalConfig()
		{
			return
				$this->module->config_global
				&& version_compare(_PS_VERSION_, '1.5.0.0', '>=');
		}

		/**
		 * get module config
		 * and put it in $this->datas
		 **/
		public function init()
		{
			// get real config
			$this->datas = $this->module->getDefaultConfig();
			if (method_exists('Configuration', 'hasKey'))
			{
				$config_global = $this->isGlobalConfig();
				foreach (array_keys($this->datas) as $key)
				{
					$full_key = $this->prefix.$key;
					if (Configuration::hasKey($full_key))
					{
						if ($config_global)
							$this->datas[$key] = Configuration::getGlobalValue($full_key);
						else
							$this->datas[$key] = Configuration::get($full_key);
					}
				}
			}
			else
			{
				$keys = array();
				foreach (array_keys($this->datas) as $key)
					$keys[] = $this->prefix.$key;
				$datas = Configuration::getMultiple($keys);
				$prefix_length = Tools::strlen($this->prefix);
				foreach ($datas as $key => $value)
					$this->datas[Tools::substr($key, $prefix_length)] = $value;
			}

			// restore array values
			foreach ($this->module->config_arrays_keys as $key)
			{
				if (!isset($this->datas[$key])
					|| is_null($this->datas[$key])
					|| ($this->datas[$key] === ''))
					$this->datas[$key] = array();
				elseif (!is_array($this->datas[$key]))
				{
					$this->datas[$key] = explode(',', $this->datas[$key]);
					foreach ($this->datas[$key] as $id => $value)
						$this->datas[$key][$id] = str_replace(self::COMA_REPLACE, ',', $value);
				}
			}
			$this->initialised = true;
		}

		/**
		 * get configurations from an array
		 * @param array $datas
		 **/
		public function update($datas)
		{
			if (is_array($datas))
			{
				if (!$this->initialised)
					$this->init();
				foreach ($datas as $key => $value)
					if (array_key_exists($key, $this->datas))
						$this->datas[$key] = $value;
				$this->save();
			}
		}

		/**
		 * Save configuration to database
		 **/
		public function save()
		{
			$config_global = $this->isGlobalConfig();
			foreach ($this->datas as $key => $value)
			{
				if (in_array($key, $this->module->config_arrays_keys))
				{
					$value = str_replace(',', self::COMA_REPLACE, $value);
					$value = implode(',', $value);
				}
				$full_key = $this->prefix.$key;
				if ($config_global)
				{
					Configuration::updateGlobalValue($full_key, $value.'1', true);
					// there is a bug when adding (not update) html
					// configuration. So we update twice
					Configuration::updateGlobalValue($full_key, $value, true);
				}
				else
				{
					Configuration::updateValue($full_key, $value.'1', true);
					// there is a bug when adding (not update) html
					// configuration. So we update twice
					Configuration::updateValue($full_key, $value, true);
				}
			}
			$this->module->postsaveConfig();
		}

		/**
		 * remove module config from database
		 **/
		public function delete()
		{
			$this->init();
			foreach (array_keys($this->datas) as $key)
				Configuration::deleteByName($this->prefix.$key);
			$this->initialised = false;
			return true;
		}
	}
}
