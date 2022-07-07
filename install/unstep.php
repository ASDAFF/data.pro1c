<?if(!check_bitrix_sessid()) return;?>
<?
global $data_pro1c_global_errors;
$data_pro1c_global_errors = is_array($data_pro1c_global_errors) ? $data_pro1c_global_errors : array();

if(is_array($data_pro1c_global_errors) && count($data_pro1c_global_errors)>0)
{
	foreach($data_pro1c_global_errors as $val)
	{
		$alErrors .= $val."<br>";
	}
	echo CAdminMessage::ShowMessage(Array("TYPE"=>"ERROR", "MESSAGE" => GetMessage("MOD_UNINST_ERR"), "DETAILS"=>$alErrors, "HTML"=>true));
}
else
{
	echo CAdminMessage::ShowNote(GetMessage("MOD_UNINST_OK"));
}
?>

<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">	
</form>
