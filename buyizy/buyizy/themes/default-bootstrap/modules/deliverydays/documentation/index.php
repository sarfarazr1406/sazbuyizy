<?php
/**
 * Display module documentation
 *
 * @category  Prestashop
 * @category  Module
 * @author    Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license   commercial license see license.txt
 * @version   1.0.0
 */

	/* Get user language */
	$iso_lang = isset($_GET['setlang'])?$_GET['setlang']:null;
	if (!isset($iso_lang))
	{
		$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		$iso_lang = strtolower(substr(trim($languages[0]), 0, 2));
	}

	/* Display help file */
	if (file_exists($iso_lang.'.html'))
		include($iso_lang.'.html');
	elseif (file_exists('en.html'))
		include('en.html');
