<?
if ( file_exists( $_SERVER["DOCUMENT_ROOT"]."/local/modules/data.pro1c/admin/data_pro1c_last.php" ) )
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/data.pro1c/admin/data_pro1c_last.php");
}
else
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/data.pro1c/admin/data_pro1c_last.php");	
}
?>