<?
###################################################
# askaron.sections1c module
# Copyright (c) 2011-2016 Askaron Systems ltd.
# http://askaron.ru
# mailto:mail@askaron.ru
###################################################

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
require_once( "prolog.php" );

$module_id = "askaron.sections1c";
$install_status = CModule::IncludeModuleEx($module_id);

if( $install_status==0 )
{
	// module not found (0)
}
elseif( $install_status==3 )
{
	//demo expired (3)
	CAdminMessage::ShowMessage(
		Array(
			"TYPE"=>"ERROR",
			"MESSAGE" => GetMessage("askaron_sections1c_prolog_status_demo_expired"),
			"DETAILS"=> GetMessage("askaron_sections1c_prolog_buy_html"),
			"HTML"=>true
		)
	);	
}
else
{

	$RIGHT = $APPLICATION->GetGroupRight($module_id);
	$RIGHT_W = ($RIGHT>="W");
	$RIGHT_R = ($RIGHT>="R");

	if ($RIGHT_R)
	{
		CModule::IncludeModule('iblock');

		$arValues = array();

		$res = CIBlock::GetList(
			Array("ID" => "ASC"),
			Array(
			),
			false
		);

		while($ar_res = $res->Fetch())
		{
			$arValues[] = array(
				"VALUE" => $ar_res["ID"],
				"NAME" => '['.$ar_res["ID"].'] '.$ar_res["NAME"],
			);
		}

		//.' - '.$ar_res["IBLOCK_TYPE_ID"]

		$arGroups = array(
			"group0" => array(
				"NAME" => GetMessage("ASKARON_SECTIONS1C_GROUP_UPDATE_SECTION_NAME"),
			),
			"group1" => array(
				"NAME" => GetMessage("ASKARON_SECTIONS1C_GROUP_UPDATE"),
			),
			"group2" => array(
				"NAME" => GetMessage("ASKARON_SECTIONS1C_GROUP_CLOSED"),
			),
			"group3" => array(
				"NAME" => GetMessage("ASKARON_SECTIONS1C_GROUP_SKIPPED"),
			),

		);

		$arOptions = array(
//			0 => array(
//				"CODE" => "forbid_update_sections",
//				"SITE_ID" => "",
//				"NAME" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS"),
//				"TYPE" => "CHECKBOX",
//				"HELP" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_HELP"),
//				"GROUP" => "group1",
//			),
			1 => array(
				"CODE" => "forbid_update_sections_name",
				"SITE_ID" => "",
				"NAME" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_NAME"),
				"TYPE" => "CHECKBOX",
				"HELP" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_NAME_HELP"),
				"GROUP" => "group0",
				"VALUES" => $arValues,
			),
			2 => array(
				"CODE" => "forbid_update_sections_code",
				"SITE_ID" => "",
				"NAME" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_CODE"),
				"TYPE" => "CHECKBOX",
				"HELP" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_CODE_HELP"),
				"GROUP" => "group0",
				"VALUES" => $arValues,
			),
			3 => array(
				"CODE" => "forbid_update_sections_ib",
				"SITE_ID" => "",
				"NAME" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_IB"),
				"TYPE" => "MULTIPLE_LIST",
				"HELP" => GetMessage("ASKARON_SECTIONS1C_FORBID_UPDATE_SECTIONS_IB_HELP"),
				"GROUP" => "group1",
				"VALUES" => $arValues,
			),
			4 => array(
				"CODE" => "closed_sections_id",
				"SITE_ID" => "",
				"NAME" => GetMessage("ASKARON_SECTIONS1C_CLOSED_SECTIONS_ID"),
				"TYPE" => "TEXT",
				"HELP" => GetMessage("ASKARON_SECTIONS1C_CLOSED_SECTIONS_ID_HELP"),
				"GROUP" => "group2",
			),
			5 => array(
				"CODE" => "skipped_sections_id",
				"SITE_ID" => "",
				"NAME" => GetMessage("ASKARON_SECTIONS1C_SKIPPED_SECTIONS_ID"),
				"TYPE" => "TEXT",
				"HELP" => GetMessage("ASKARON_SECTIONS1C_SKIPPED_SECTIONS_ID_HELP"),
				"GROUP" => "group3",
			),

		);

		if (
			$REQUEST_METHOD=="POST"
			&& strlen($Update)>0
			&& $RIGHT_W
			&& check_bitrix_sessid()
		)
		{
			if ( isset($_REQUEST[ "closed_sections_id" ]) )
			{
				COption::SetOptionString($module_id, "closed_sections_id", $_REQUEST[ "closed_sections_id" ] );
			}			
		}


		if (
			$REQUEST_METHOD == "POST"
			&& strlen($Update.$UpdateAndApply) > 0
			&& $RIGHT_W
			&& check_bitrix_sessid()
		)
		{
			// Update all options
			foreach ($arOptions as $key => $arOption)
			{
				if ($arOption["TYPE"] == "CHECKBOX")
				{
					if (isset($_REQUEST["arrOptions"][$key]) && $_REQUEST["arrOptions"][$key] == "Y")
					{
						COption::SetOptionString($module_id, $arOption["CODE"], "Y", false, $arOption["SITE_ID"]);
					} else
					{
						COption::SetOptionString($module_id, $arOption["CODE"], "N", false, $arOption["SITE_ID"]);
					}
				}

				if ($arOption["TYPE"] == "TEXT")
				{
					if (isset($_REQUEST["arrOptions"][$key]))
					{
						COption::SetOptionString($module_id, $arOption["CODE"], $_REQUEST["arrOptions"][$key], false, $arOption["SITE_ID"]);
					}
				}

				if ($arOption["TYPE"] == "INTEGER")
				{
					if (isset($_REQUEST["arrOptions"][$key]))
					{
						if (strlen($_REQUEST["arrOptions"][$key]) > 0)
						{
							$val = intval($_REQUEST["arrOptions"][$key]);
							$min = $arOption["MIN"];

							if (strlen($min) > 0 && $val < $min)
							{
								$val = $min;
							}

							COption::SetOptionString($module_id, $arOption["CODE"], $val, false, $arOption["SITE_ID"]);
						}
					}
				}

				if ( $arOption["TYPE"] == "MULTIPLE_LIST" )
				{
					$val = "";

					if ( is_array( $_REQUEST["arrOptions"][$key] ) && count( $_REQUEST["arrOptions"][$key] ) > 0  )
					{
						$val = implode(",", $_REQUEST["arrOptions"][$key] );
					}

					COption::SetOptionString($module_id, $arOption["CODE"], $val, false, $arOption["SITE_ID"]);
				}
			}

			if ( strlen( $UpdateAndApply ) > 0 )
			{
				@set_time_limit(0);
				CAskaronSections1c::ApplySectionOptions();
			}
		}

		if (
			$REQUEST_METHOD=="POST"
			&& $RIGHT_W
			&& strlen($RestoreDefaults)>0
			&& check_bitrix_sessid()
		)
		{
			COption::RemoveOption("askaron.sections1c");
			$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"), $get_users_amount = "N");
			while($zr = $z->Fetch())
			{
				$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
			}
		}

		//demo (2)
		if ( $install_status == 2 )
		{
			CAdminMessage::ShowMessage(
				Array(
					"TYPE"=>"OK",
					"MESSAGE" => GetMessage("askaron_sections1c_prolog_status_demo"),
					"DETAILS"=> GetMessage("askaron_sections1c_prolog_buy_html"),
					"HTML"=>true
				)
			);
		}

		// init all options:
		$arDisplayOptions = array();

		foreach ($arOptions as $key => $arOption)
		{
			$arOptionAdd = $arOption;

			$option_value = COption::GetOptionString($module_id, $arOption["CODE"], "", $arOption["SITE_ID"]);

			$arOptionAdd["INPUT_ID"] = "option_" . $key;
			$arOptionAdd["INPUT_NAME"] = "arrOptions[" . $key . "]";
			$arOptionAdd["~INPUT_VALUE"] = $option_value;
			$arOptionAdd["INPUT_VALUE"] = htmlspecialcharsbx($option_value);

			$arDisplayOptions[$key] = $arOptionAdd;
		}

		foreach ($arGroups as $group_key => $arGroup)
		{
			$arGroups[$group_key]["~NAME"] = $arGroup["NAME"];
			$arGroups[$group_key]["NAME"] = htmlspecialcharsbx($arGroup["NAME"]);
		}


		
		$aTabs = array(
			array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),			
			array("DIV" => "edit2", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
		);

		$tabControl = new CAdminTabControl("tabControl", $aTabs);
		$tabControl->Begin();
		?>



		<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>&amp;mid=<?=htmlspecialchars($mid)?>&amp;mid_menu=<?=urlencode($_REQUEST["mid_menu"])?>">
			<?=bitrix_sessid_post()?>
			<?$tabControl->BeginNextTab();?>
			<tr >
				<td valign="top" colspan="2">
					<?=BeginNote();?>
					<?=GetMessage( "ASKARON_SECTIONS1C_OPTIONS_NOTE" );?>
					<?=EndNote();?>
				</td>
			</tr>


			<? foreach ($arGroups as $group_key => $arGroup):?>

				<tr class="heading">
					<td valign="top" colspan="2" align="center"><?= $arGroup["NAME"] ?></td>
				</tr>

				<? foreach ($arDisplayOptions as $key => $arInput):?>

					<? if ($group_key == $arInput["GROUP"]):?>
						<tr>
							<td valign="top" width="40%" class="field-name"><label
									for="<?= $arInput["INPUT_ID"] ?>"><?= $arInput["NAME"] ?></label></td>
							<td valign="top" width="50%">
								<? if ($arInput["TYPE"] == "CHECKBOX"):?>
									<input
										type="checkbox"
										value="Y"
										id="<?= $arInput["INPUT_ID"] ?>"
										<? if ($arInput["INPUT_VALUE"] == "Y"):?>
											checked="checked"
										<?endif ?>
										name="<?= $arInput["INPUT_NAME"] ?>"
										/>
								<?endif ?>

								<? if ($arInput["TYPE"] == "MULTIPLE_LIST"):?>

									<?
									$arValKeys = array();
									if ( strlen($arInput["~INPUT_VALUE"]) > 0 )
									{
										$arVals = explode( ",", $arInput["~INPUT_VALUE"] );
										$arValKeys = array_flip ($arVals);
									}
									?>

									<?foreach ( $arInput["VALUES"] as $key_variant => $arValue ):?>
										<input
											type="checkbox"
											value="<?=htmlspecialcharsbx($arValue["VALUE"])?>"
											id="<?= $arInput["INPUT_ID"] ?>_<?=$key_variant?>"
											<? if ( isset( $arValKeys[ $arValue["VALUE"] ] ) ):?>
												checked="checked"
											<?endif ?>
											name="<?= $arInput["INPUT_NAME"]?>[]"
											/>
										<label for="<?= $arInput["INPUT_ID"] ?>_<?=$key_variant?>"><?=htmlspecialcharsbx( $arValue["NAME"] )?></label><br>
									<?endforeach?>
								<?endif ?>



								<? if (($arInput["TYPE"] == "TEXT" && $arInput["ROWS"] <= 1) || $arInput["TYPE"] == "INTEGER"):?>
									<input
										type="text"
										value="<?= $arInput["INPUT_VALUE"] ?>"
										id="<?= $arInput["INPUT_ID"] ?>"
										name="<?= $arInput["INPUT_NAME"] ?>"
										size="40"
										/>
								<?endif ?>

								<? if ($arInput["TYPE"] == "TEXT" && $arInput["ROWS"] > 1):?>

									<textarea id="<?= $arInput["INPUT_ID"] ?>" name="<?= $arInput["INPUT_NAME"] ?>"
											  rows="<?= $arInput["ROWS"] ?>"
											  cols="<?= $arInput["COLS"] ?>"><?= $arInput["INPUT_VALUE"] ?></textarea>

								<?endif ?>

								<? if (strlen($arInput["HELP"]) > 0):?>
									<?= BeginNote(); ?>
										<?= $arInput["HELP"]; ?>
									<?= EndNote(); ?>
								<?endif ?>
							</td>
						</tr>
					<?endif ?>

				<?endforeach ?>

			<?endforeach ?>

			<?$tabControl->BeginNextTab();?>
			<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
			<?$tabControl->Buttons();?>
			<?/*
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>">
			*/?>
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="UpdateAndApply" value="<?=GetMessage("ASKARON_SECTION1C_SAVE_AND_APPLY")?>" title="<?=GetMessage("ASKARON_SECTION1C_SAVE_AND_APPLY_TITLE")?>">

			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
			<?$tabControl->End();?>
		</form>
	<?
	}
}
?>