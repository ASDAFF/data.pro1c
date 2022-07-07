<?
###################################################
# askaron.traits1c module                         #
# Copyright (c) 2011-2013 Askaron Systems ltd.    #
# http://askaron.ru                               #
# mailto:mail@askaron.ru                          #
###################################################

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");

$module_id = "askaron.traits1c";
$install_status = CModule::IncludeModuleEx($module_id);

$arOptions = array(
	"name_from_property" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY"),
		"TYPE" => "CHECKBOX",
	),
	"name_from_property_code" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY_CODE"),
		"TYPE" => "TEXT",
	),
	"name_from_preview_text" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_FULL_NAME"),
		"TYPE" => "CHECKBOX",
	),
	"name_from_name" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_NAME"),
		"TYPE" => "CHECKBOX",
	),
	"preview_text_from_property" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY"),
		"TYPE" => "CHECKBOX",
	),
	"preview_text_from_property_code" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY_CODE"),
		"TYPE" => "TEXT",
	),
	"preview_text_from_detail_text" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_DESCRIPTION"),
		"TYPE" => "CHECKBOX",
	),	
	"preview_text_from_preview_text" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_FULL_NAME2"),
		"TYPE" => "CHECKBOX",
	),
	"detail_text_from_property" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY"),
		"TYPE" => "CHECKBOX",
	),
	"detail_text_from_property_code" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_PROPERTY_CODE"),
		"TYPE" => "TEXT",
	),	
	"detail_text_from_detail_text" => array(
		"NAME" => GetMessage("ASKARON_TRAITS1C_WRITE_FROM_DESCRIPTION2"),
		"TYPE" => "CHECKBOX",
	),
);

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
			"MESSAGE" => GetMessage("askaron_traits1c_option_status_demo_expired"),
			"DETAILS"=> GetMessage("askaron_traits1c_option_buy_html"),
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
		$arErrors = array();
		$arSettings = array();		

		if (
			$REQUEST_METHOD=="POST"
			&& strlen($Update)>0
			&& $RIGHT_W
			&& check_bitrix_sessid()
		)
		{
			foreach ($_REQUEST as $key => $value)
			{
				if ( preg_match( '/^askaron_traits1c_settings_([0-9]+)_row$/', $key, $arMatches ) )
				{
					$arItem = array(
						"ACTIVE" => "N",
						"NAME" => "",
						"CODE" => "",
					);

					if ( isset( $value["NAME"] ) && strlen( $value["NAME"] ) > 0 )
					{
						$arItem["NAME"] = $value["NAME"];

						if ( isset( $value["ACTIVE"] ) && $value["ACTIVE"] == "Y" )
						{
							$arItem["ACTIVE"] = $value["ACTIVE"];
						}

						if ( isset( $value["CODE"] ) && strlen( $value["CODE"] ) > 0 )
						{
							$arItem["CODE"] = $value["CODE"];
						}					

						$arSettings[] = $arItem;

						$field_name_html = htmlspecialcharsbx($arItem["NAME"]);
						
						if ( strlen( $arItem["CODE"] ) == 0 )
						{
							$arErrors[] = GetMessage( "askaron_traits1c_error_empty", array( "#TRAIT#" => $field_name_html ) );
						}
						elseif (  preg_match( '/^([0-9]+).*?$/', $arItem["CODE"] ) )
						{
							$arErrors[] = GetMessage( "askaron_traits1c_error_first_symbol", array( "#TRAIT#" => $field_name_html ) );							
						}
						elseif ( !preg_match( '/^([a-zA-Z0-9_]+)$/', $arItem["CODE"] ) )
						{
							$arErrors[] = GetMessage( "askaron_traits1c_error_format", array( "#TRAIT#" => $field_name_html ) );							
						}
					}					
				}
			}

			if (count( $arErrors ) == 0 )
			{
				$bSaved = CAskaronTraits1C::SetSettings( $arSettings );
				if (!$bSaved)
				{
					$arErrors[] = GetMessage("askaron_traits1c_error_save");
				}
			}
			
				
			if (intval($_REQUEST[ "code_length" ])>0)
			{
				COption::SetOptionString($module_id, "code_length", min( intval($_REQUEST[ "code_length" ]), 100 ) ) ;
			}
			else
			{
				COption::SetOptionString($module_id, "code_length","0");		
			}

			if ( isset($_REQUEST[ "code_remove_symbols" ]) && $_REQUEST[ "code_remove_symbols" ] == "Y" )
			{
				COption::SetOptionString($module_id, "code_remove_symbols", "Y" );
			}
			else
			{
				COption::SetOptionString($module_id, "code_remove_symbols", "N" );				
			}
			
			
			// Update all options			
			foreach ( $arOptions as $key => $arOption )
			{
				if ( $arOption["TYPE"] == "CHECKBOX" )
				{
					if ( isset( $_REQUEST["arrOptions"][ $key ] ) && $_REQUEST["arrOptions"][ $key ] == "Y" )
					{
						COption::SetOptionString($module_id, $key, "Y" );
					}
					else
					{
						COption::SetOptionString($module_id, $key, "N" );
					}
				}
				
				if ( $arOption["TYPE"] == "TEXT" )
				{
					if ( isset( $_REQUEST["arrOptions"][ $key ] ) )
					{
						COption::SetOptionString( $module_id, $key, $_REQUEST["arrOptions"][ $key ] );
					}
				}				
			}
			
			
//			$askaron_traits1c_full_name_value = "PREVIEW_TEXT";
//			if ( 
//					isset($_REQUEST[ "askaron_traits1c_full_name" ]) 
//				&& 
//					( $_REQUEST[ "askaron_traits1c_full_name" ] == "NAME" || $_REQUEST[ "askaron_traits1c_full_name" ] == "NO_WRITE" )
//			)
//			{
//				$askaron_traits1c_full_name_value = $_REQUEST[ "askaron_traits1c_full_name" ];
//				
//			}
//			COption::SetOptionString($module_id, "full_name", $askaron_traits1c_full_name_value );
			
		}	


		if (
			$REQUEST_METHOD=="POST"
			&& $RIGHT_W
			&& strlen($RestoreDefaults)>0
			&& check_bitrix_sessid()
		)
		{
			COption::RemoveOption("askaron.traits1c");
			$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"), $get_users_amount = "N");
			while($zr = $z->Fetch())
			{
				$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
			}
		}

		if (count( $arErrors ) == 0 )
		{
			$arSettings = CAskaronTraits1C::GetSettings();
		}
		
		$CodeLength = intval( COption::GetOptionString($module_id, "code_length") );
		$CodeRemoveSymbols = COption::GetOptionString($module_id, "code_remove_symbols");
		
		//$full_name = COption::GetOptionString($module_id, "full_name"); // deprecated
		
//		$name = COption::GetOptionString($module_id, "name");
//		$preview_text = COption::GetOptionString($module_id, "preview_text");
//		$detail_text = COption::GetOptionString($module_id, "detail_text");

		// init all options:
		
		$arDisplayOptions = array();
		
		foreach ( $arOptions as $key=> $arOption )
		{
			$arOptionAdd = $arOption;
			
			$arOptionAdd["INPUT_ID"] = "option_".$key;
			$arOptionAdd["INPUT_NAME"] = "arrOptions[".$key."]";
			$arOptionAdd["~INPUT_VALUE"] = COption::GetOptionString( $module_id, $key );
			$arOptionAdd["INPUT_VALUE"] = htmlspecialcharsbx( COption::GetOptionString( $module_id, $key ) );	
			
			$arDisplayOptions[ $key ] = $arOptionAdd;
		}
		
		
		if ( count( $arErrors ) > 0 )
		{
			CAdminMessage::ShowMessage(
				Array(
					"TYPE"=>"ERROR",
					"MESSAGE" => GetMessage("askaron_traits1c_error_save_header"),
					"DETAILS"=> implode( "<br />", $arErrors ),
					"HTML"=>true
				)
			);
		}
		
		//demo (2)
		if ( $install_status == 2 )
		{
			CAdminMessage::ShowMessage(
				Array(
					"TYPE"=>"OK",
					"MESSAGE" => GetMessage("askaron_traits1c_option_status_demo"),
					"DETAILS"=> GetMessage("askaron_traits1c_option_buy_html"),
					"HTML"=>true
				)
			);
		}
		
		
		
		$aTabs = array(
			array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
			array("DIV" => "edit2", "TAB" => GetMessage("askaron_traits1c_additional_settings"), "ICON" => "", "TITLE" => GetMessage("askaron_traits1c_additional_settings") ),
			array("DIV" => "edit3", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
		);

		$tabControl = new CAdminTabControl("tabControl", $aTabs);
		$tabControl->Begin();

		$rowIndex = 0;

		?>

		<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANGUAGE_ID?>">
			<?=bitrix_sessid_post()?>
			<?$tabControl->BeginNextTab();?>

			<tr class="heading">
				<td valign="top" colspan="2" align="center"><?=GetMessage("askaron_traits1c_header_element_fields")?></td>
			</tr>			
			<tr>
				<td valign="top" width="30%" class="field-name"><label><?=GetMessage("askaron_traits1c_name")?></label></td>
				<td valign="top" width="70%">

					<?//d($arDisplayOptions);?>
					
					<?$arInput = $arDisplayOptions[ "name_from_property" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"						
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br /><br />

					<div style="margin-left: 20px;">
						<?$arInput = $arDisplayOptions[ "name_from_property_code" ];?>

						<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?>:
						<input
							type="text"
							value="<?=$arInput["INPUT_VALUE"]?>"
							id="<?=$arInput["INPUT_ID"]?>"
							name="<?=$arInput["INPUT_NAME"]?>"
							size="40"
						/>
						</label>
						<br /><br />						
						
					</div>

					<?$arInput = $arDisplayOptions[ "name_from_preview_text" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br /><br />

					
					<?$arInput = $arDisplayOptions[ "name_from_name" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br />
					

					<?=BeginNote();?>
						<strong><?=GetMessage("ASKARON_TRAITS1C_NAME_HELP_TITLE")?></strong><br /><br />
						<?=GetMessage("ASKARON_TRAITS1C_NAME_HELP")?><?=EndNote();?>	
				</td>				
			</tr>
			
			<tr>
				<td valign="top" width="30%" class="field-name"><label><?=GetMessage("askaron_traits1c_preview_text")?></label></td>
				<td valign="top" width="70%">

					<?$arInput = $arDisplayOptions[ "preview_text_from_property" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"						
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br /><br />

					<div style="margin-left: 20px;">
						<?$arInput = $arDisplayOptions[ "preview_text_from_property_code" ];?>

						<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?>:
						<input
							type="text"
							value="<?=$arInput["INPUT_VALUE"]?>"
							id="<?=$arInput["INPUT_ID"]?>"
							name="<?=$arInput["INPUT_NAME"]?>"
							size="40"
						/>
						</label>
						<br /><br />						
						
					</div>

					<?$arInput = $arDisplayOptions[ "preview_text_from_detail_text" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br /><br />					
					
					<?$arInput = $arDisplayOptions[ "preview_text_from_preview_text" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br />					

					<?=BeginNote();?>
						<strong><?=GetMessage("ASKARON_TRAITS1C_PREVIEW_TEXT_HELP")?></strong><br /><br />
						<?=GetMessage("ASKARON_TRAITS1C_PREVIEW_TEXT")?><?=EndNote();?>						
					
				</td>					
			</tr>


			<tr>
				<td valign="top" width="30%" class="field-name"><label><?=GetMessage("askaron_traits1c_detail_text")?></label></td>
				<td valign="top" width="70%">

					<?$arInput = $arDisplayOptions[ "detail_text_from_property" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"						
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br /><br />

					<div style="margin-left: 20px;">
						<?$arInput = $arDisplayOptions[ "detail_text_from_property_code" ];?>

						<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?>:
						<input
							type="text"
							value="<?=$arInput["INPUT_VALUE"]?>"
							id="<?=$arInput["INPUT_ID"]?>"
							name="<?=$arInput["INPUT_NAME"]?>"
							size="40"
						/>
						</label>
						<br /><br />												
					</div>					
					
					
					<?$arInput = $arDisplayOptions[ "detail_text_from_detail_text" ];?>

					<input
						type="checkbox"
						value="Y"
						id="<?=$arInput["INPUT_ID"]?>"
						<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
							checked="checked"
						<?endif?>
						name="<?=$arInput["INPUT_NAME"]?>"
					/>
					<label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label><br />	

					<?=BeginNote();?>
						<strong><?=GetMessage("ASKARON_TRAITS1C_DETAIL_TEXT_HELP")?></strong><br /><br />
						<?=GetMessage("ASKARON_TRAITS1C_DETAIL_TEXT")?><?=EndNote();?>						
					
				</td>					
			</tr>
			
			<?/*		
			<tr>
				<td valign="top" width="30%" class="field-name"><label><?=GetMessage("askaron_traits1c_full_name")?></label></td>
				<td valign="top" width="70%">
					<input
						type="radio"
						value="NAME"
						id="askaron_traits1c_full_name_as_name"
						<?if ($full_name == "NAME"):?>
							checked="checked"
						<?endif?>
						name="askaron_traits1c_full_name"
					/>
					<label for='askaron_traits1c_full_name_as_name'><?=GetMessage("askaron_traits1c_full_name_as_name")?></label><br />

					<input
						type="radio" 
						value="PREVIEW_TEXT"
						id="askaron_traits1c_full_name_as_preview_text"
						<?if ($full_name == "PREVIEW_TEXT"):?>
							checked="checked"
						<?endif?>						
						name="askaron_traits1c_full_name"
					/>										
					<label for='askaron_traits1c_full_name_as_preview_text'><?=GetMessage("askaron_traits1c_full_name_as_preview_text")?></label><br />					

					<input
						type="radio" 
						value="NO_WRITE"
						id="askaron_traits1c_full_name_as_no_write"
						<?if ($full_name == "NO_WRITE"):?>
							checked="checked"
						<?endif?>						
						name="askaron_traits1c_full_name"
					/>										
					<label for='askaron_traits1c_full_name_as_no_write'><?=GetMessage("askaron_traits1c_full_name_as_no_write")?></label><br />					
					
					


					<?//=BeginNote();?>
						<?//=GetMessage("askaron_traits1c_code_remove_symbols_help")?>
					<?//=EndNote();?>						
				</td>				
			</tr>	
			*/?>
			<tr class="heading">
				<td valign="top" colspan="2" align="center"><?=GetMessage("askaron_traits1c_header_settings")?></td>
			</tr>	
			
			<tr>
				<td width="100%" colspan="2">
					
					<table style="width: auto; margin: 0 auto;" >
						<tr>
							<td>
								<table class="internal" cellspacing="0" cellpadding="0" border="0">					
									<thead>
										<tr class="heading">
											<td><?=GetMessage("askaron_traits1c_field_active")?></td>
											<td><?=GetMessage("askaron_traits1c_field_name")?></td>											
											<td><?=GetMessage("askaron_traits1c_field_code")?></td>
										</tr>
									</thead>
									<tbody id="askaron_traits1c_settings_body">
										<?foreach ( $arSettings as $arItem ):?>
											<tr>
												<td style="text-align: center;"><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[ACTIVE]" value="Y" type="checkbox"<?if ($arItem["ACTIVE"] == "Y" ) echo ' checked="checked"'; ?> /></td>
												<td><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[NAME]" value="<?=htmlspecialcharsbx($arItem["NAME"])?>" type="text" size="40" /></td>
												<td><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[CODE]" value="<?=htmlspecialcharsbx($arItem["CODE"])?>" type="text" size="40" /></td>
											</tr>
											<?$rowIndex++;?>
										<?endforeach?>

										<?for ( $i = 0; $i < 2; $i++ ):?>
											<tr>
												<td style="text-align: center;"><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[ACTIVE]" value="Y" type="checkbox" checked="checked" /></td>
												<td><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[NAME]" value="" type="text" size="40" /></td>
												<td><input name="askaron_traits1c_settings_<?=$rowIndex?>_row[CODE]" value="" type="text" size="40" /></td>
											</tr>
											<?$rowIndex++;?>
										<?endfor?>								
									</tbody>							
								</table>
								<br  />
								<div style="width: 100%; text-align: center;">
									<input type="button" value="<?=GetMessage("askaron_traits1c_more")?>" onclick="askaron_traits1c_add_row();" />							
								</div>

							</td>
						<tr>
					</table>

					<div style="clear: both"> </div>
					<br  />	
					<div style="margin: 0 auto; max-width: 800px;">
						<?=BeginNote();?>
							<?=GetMessage("askaron_traits1c_help")?>
						<?=EndNote();?>	
					</div>
				</td>
			</tr>
			<?$tabControl->BeginNextTab();?>
			<tr class="heading">
				<td valign="top" colspan="2" align="center"><?=GetMessage("askaron_traits1c_additional_settings_code")?></td>
			</tr>			
			<tr>
				<td valign="top" width="50%" class="field-name"><label for='askaron_traits1c_code_remove_symbols'><?=GetMessage("askaron_traits1c_code_remove_symbols")?></label></td>
				<td valign="top" width="50%">
					<input
						type="checkbox" 
						value="Y"
						id="askaron_traits1c_code_remove_symbols"
						name="code_remove_symbols"
						<?if ( $CodeRemoveSymbols == "Y" ):?>
							checked="checked"
						<?endif?>
					/>
					<?=BeginNote();?>
						<?=GetMessage("askaron_traits1c_code_remove_symbols_help")?>
					<?=EndNote();?>						
				</td>				
			</tr>			
			<tr>
				<td valign="top" width="50%" class="field-name"><label for='askaron_traits1c_code_length'><?=GetMessage("askaron_traits1c_code_length")?></label></td>
				<td valign="top" width="50%">
					<input
						type="text" 
						value="<?=$CodeLength?>"
						id="askaron_traits1c_code_length"
						name="code_length"
					/>
					<?=BeginNote();?>
						<?=GetMessage("askaron_traits1c_code_length_help")?>
					<?=EndNote();?>						
				</td>				
			</tr>
			<?$tabControl->BeginNextTab();?>
			<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
			<?$tabControl->Buttons();?>		
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>">
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
			<?$tabControl->End();?>
		</form>

		<table style="display: none;">					
			<tbody id="askaron_traits1c_settings_body_from">
				<tr>
					<td style="text-align: center;"><input name="ACTIVE" value="Y" type="checkbox" checked="checked" /></td>
					<td><input name="NAME" value="" type="text" size="40" /></td>
					<td><input name="CODE" value="" type="text" size="40" /></td>					
				</tr>
			</tbody>							
		</table>
		<script type="text/javascript">
			var askaron_traits1c_add_row_index = <?=$rowIndex?>;

			var askaron_traits1c_add_row = function()
			{
				var from = document.getElementById("askaron_traits1c_settings_body_from");
				var to = document.getElementById("askaron_traits1c_settings_body");

				// clone the first children <tr>
				var node = from.getElementsByTagName("tr")[0].cloneNode(true);

				// inputs
				var children = node.getElementsByTagName("input");
				for(var i=0; i<children.length; i++) 
				{
					children[i].name = "askaron_traits1c_settings_" + askaron_traits1c_add_row_index + "_row[" + children[i].name + "]";
				}

				// selects
				var children = node.getElementsByTagName("select");
				for(var i=0; i<children.length; i++) 
				{
					children[i].name = "askaron_traits1c_settings_" + askaron_traits1c_add_row_index + "_row[" + children[i].name + "]";
				}

				to.appendChild( node );
				askaron_traits1c_add_row_index++;				
			};
		</script>
	<?
	}
}
?>