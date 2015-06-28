<?php

if (isset($_GET['DEBUG']))
{
	error_reporting(E_ALL ^ E_NOTICE);
	@ini_set('display_errors', 'on');
}

if (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
{
	require(dirname(__FILE__)."/AdminStoreCommander_1_4.php");
}
else
{
	require(dirname(__FILE__)."/controllers/admin/AdminStoreCommander.php");
}

