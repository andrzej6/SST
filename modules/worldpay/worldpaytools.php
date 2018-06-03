<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @version   Release: $Revision: 6844 $
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class WorldPayTools {

	const GET   = 'GET';
	const POST  = 'POST';
	const PUT   = 'PUT';
	const DELETE = 'DELETE';
	const HEAD  = 'HEAD';

	public static function isOldVersion()
	{
		$version_mask = explode('.', _PS_VERSION_, 2);
		$version_test = $version_mask[0] > 0 && $version_mask[1] < 5;

		return $version_test;
	}

	public static function executeFileQueries(Module $module, $sql_file, $suppress = false)
	{
		$sql_file = $module->getLocalPath()."sql/{$sql_file}";

		if (file_exists($sql_file))
		{
			$sql = Tools::file_get_contents($sql_file);
			$sql = str_replace('PREFIX_', _DB_PREFIX_, $sql);
			$sql = preg_split("/;\s*[\r\n]+/", $sql);

			$result = true;

			foreach ($sql as $query)
				if (trim($query))
				{
					try
					{
						$result &= Db::getInstance()->Execute(trim($query));
					}
					catch (Exception $e)
					{
						if (preg_match('/duplicate column/iu', $e->getMessage()))
							$result &= true;
					}
				}

			return $suppress ? $suppress : $result;
		}

		return true;
	}

	public static function registerHooks(Module $module, array $hooks)
	{
		$result = true;

		foreach ($hooks as $hook)
			if (!$module->isRegisteredInHook($hook))
				$result &= $module->registerHook($hook);

		return $result;
	}

	public static function installModuleTab(Module $module, $tab_class, $tab_name, $tab_parent_class, $active)
	{
		$tab = new Tab();
		$tab->name = $tab_name;
		$tab->class_name = $tab_class;
		$tab->module = $module->name;
		$tab->id_parent = Tab::getIdFromClassName($tab_parent_class);
		$tab->active = $active;

		if (!$tab->add())
			return false;

		return true;
	}

	public static function uninstallModuleTab(Module $module, $tab_class)
	{
		$tab_id = Tab::getIdFromClassName($tab_class);

		if ($module->name && $tab_id != 0)
		{
			$tab = new Tab($tab_id);
			$tab->delete();

			return true;
		}

		return false;
	}

	public static function installSettings(array $settings)
	{
		$result = true;

		foreach ($settings as $class)
		{
			$instance = call_user_func(array($class, 'getInstance'));

			if (is_object($instance))
				$result &= $instance->install();
		}

		return $result;
	}

	public static function uninstallSettings(array $settings)
	{
		$result = true;

		foreach ($settings as $class)
		{
			$instance = call_user_func(array($class, 'getInstance'));

			if (is_object($instance))
				$result &= $instance->uninstall();
		}

		return $result;
	}

	public static function ajaxResponse($errors = array(), $page = false)
	{
		$return = array();

		if ($errors !== false)
		{
			$return['hasError'] = !empty($errors);
			$return['errors'] = $errors;
		}

		if ($page !== false)
			$return['page'] = $page;

		$return['token'] = Tools::getToken(false);

		die(Tools::jsonEncode($return));
	}

	public static function debugArray(array $array)
	{
		return Tools::jsonEncode($array);
	}

	public static function isMethod($method)
	{
		return Tools::strtoupper($_SERVER['REQUEST_METHOD']) == Tools::strtoupper($method);
	}

	public static function postIsset($key)
	{
		if (!isset($key) || empty($key) || !is_string($key))
			return false;

		return array_key_exists($key, $_POST) ? true : false;
	}
}
