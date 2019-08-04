<?
/**
 * Copyright (c) 4/8/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if ( file_exists( $_SERVER["DOCUMENT_ROOT"]."/local/modules/import.pro1c/admin/import_pro1c_check.php" ) )
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/import.pro1c/admin/import_pro1c_check.php");
}
else
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/import.pro1c/admin/import_pro1c_check.php");
}
?>