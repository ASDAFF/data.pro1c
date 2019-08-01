<?if(!check_bitrix_sessid()) return;?>
<?
/**
 * Copyright (c) 2/8/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $import_pro1c_global_errors;
$import_pro1c_global_errors = is_array($import_pro1c_global_errors) ? $import_pro1c_global_errors : array();

if(is_array($import_pro1c_global_errors) && count($import_pro1c_global_errors)>0)
{
	foreach($import_pro1c_global_errors as $val)
	{
		$alErrors .= $val."<br>";
	}
	echo CAdminMessage::ShowMessage(Array("TYPE"=>"ERROR", "MESSAGE" => GetMessage("MOD_INST_ERR"), "DETAILS"=>$alErrors, "HTML"=>true));
}
else
{
	echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
	
	?>
	<p><a href="settings.php?lang=<?=LANG?>&amp;mid=import.pro1c&amp;mid_menu=2"><?=GetMessage("IMPORT_PRO1C_SETTINGS_PAGE" )?></a></p>
	<?	
}
?>

<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
</form>
