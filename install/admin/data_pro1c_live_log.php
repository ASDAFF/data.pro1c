<?
if ( file_exists( $_SERVER["DOCUMENT_ROOT"]."/local/modules/data.pro1c/admin/data_pro1c_live_log.php" ) )
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/data.pro1c/admin/data_pro1c_live_log.php");
}
else
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/data.pro1c/admin/data_pro1c_live_log.php");	
}
?>