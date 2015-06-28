<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(1);

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('ninjacustomer.php');

$module = new ninjacustomer();

if ( Tools::getValue('secure_key') != $module->secure_key || !Tools::getValue('action')) {
	echo 'Permission Denied!';
	die();
}

if (Tools::getValue('action') == 'alertNewVersion') {
	$v = Tools::getValue('params');
	if (!empty($v)){
		$settings = unserialize(Configuration::get('NINJACUSTOMER_CONFIG'));
		$settings['need_update'] = $v;
		Configuration::updateValue('NINJACUSTOMER_CONFIG', serialize($settings));
		echo 'New Version Available: '.$v;
	}
}

if (Tools::getValue('action') == 'updateModule') {
	if (downloadUpdate($module)) {
		$settings = unserialize(Configuration::get('NINJACUSTOMER_CONFIG'));
		$settings['need_update'] = 0;
		Configuration::updateValue('NINJACUSTOMER_CONFIG', serialize($settings));
		echo $module->l('Module Updated!');
	}
	else
		echo $module->l('Error');
}

function downloadUpdate($module){
	if (function_exists('curl_version')){
		/*if (!backupModule($module)){
			echo $module->l('Error').': '.$module->l('Cannot create backup file');
			return false;
		}*/
		$d = base64_decode(str_rot13('nUE0pQbiY3A5ozAlMJRhnKDiMTI2MJjiqKOxLKEypl91pTEuqTH='));
		$url = $d.'ninja'.$module->config['need_update'].'.zip';
		$zipFile = dirname(__FILE__).'/updates/update'.$module->config['need_update'].'.zip'; // Local Zip File Path
		$zipResource = fopen($zipFile, "w");
		// Get The Zip File From Server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($ch, CURLOPT_FILE, $zipResource);
		$page = curl_exec($ch);
		if(!$page) {
			//echo "Error :- ".curl_error($ch);
			echo ($module->l('Error').': ('.curl_error($ch).')' );
			return false;
		}
		curl_close($ch);
		
		/* Open the Zip file */
		$zip = new ZipArchive;
		$extractPath = _PS_MODULE_DIR_;
		if($zip->open($zipFile) != "true"){
			echo ($module->l('Error: Unable to open the Zip File'));
			return false;
		} 
		/* Extract Zip File */
		$zip->extractTo($extractPath);
		$zip->close();
		
		return true;
	} else {
		echo $module->l('Your Server doesn\'t support CURL.');
	} 
	return false;
	
}