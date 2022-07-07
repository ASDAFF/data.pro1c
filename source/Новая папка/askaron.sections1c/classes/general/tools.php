<?
IncludeModuleLangFile(__FILE__);

class CAskaronSections1cTools
{
	public static function OnAdminListDisplayHandler(&$list)
	{
		global $APPLICATION;
		$strCurPage = $APPLICATION->GetCurPage();
		$bRightPage = (
			$strCurPage=='/bitrix/admin/iblock_section_admin.php'
			||
			$strCurPage=='/bitrix/admin/iblock_list_admin.php'
			||
			$strCurPage=='/bitrix/admin/cat_section_admin.php');

		if( $bRightPage && CModule::IncludeModule('iblock') )
		{
			//This is all parameters needed for proper navigation
			$sThisSectionUrl = '&type='.urlencode($_REQUEST['type']).'&lang='.urlencode(LANGUAGE_ID).'&IBLOCK_ID='.$_REQUEST['IBLOCK_ID'].'&find_section_section='.intval($_REQUEST['find_section_section']);

			$lAdmin = new CAdminList($list->table_id, $list->sort);

			foreach ( $list->aRows as $key=>$arRow )
			{
				if (
					( $strCurPage=='/bitrix/admin/iblock_section_admin.php' )
					||
					( $strCurPage=='/bitrix/admin/iblock_list_admin.php' && substr ( $arRow->id , 0, 1 ) == "S" )
					||
					$strCurPage=='/bitrix/admin/cat_section_admin.php'
				)
				{
					$html = $arRow->aFields["ID"]["view"]["value"];

					$id = str_replace( "S", "",$arRow->id  );

					$arClosed = CAskaronSections1c::GetSectionsClosedArray();
					if ( isset($arClosed[$id]) )
					{
						$html = '<strong><a href="settings.php?lang='.LANG.'&amp;mid=askaron.sections1c&amp;mid_menu=1">'.GetMessage("askaron_sections1c_tools_closed")."</a></strong><br>".$html;
					}

					$arSkipped = CAskaronSections1c::GetSectionsSkippedArray();
					if ( isset($arSkipped[$id]) )
					{
						$html = '<strong><a href="settings.php?lang='.LANG.'&amp;mid=askaron.sections1c&amp;mid_menu=1">'.GetMessage("askaron_sections1c_tools_skipped")."</a></strong><br>".$html;
					}

					$list->aRows[$key]->aFields["ID"]["view"]["value"] = $html;


					$list->aRows[$key]->aActions[] = array(
						"ICON" => false,
						"TEXT" => GetMessage("askaron_sections1c_tools_deactivate_including_nested"),
						"ACTION" => "if(confirm('".GetMessage('askaron_sections1c_tools_deactivate_including_nested_conf')."')) ".$lAdmin->ActionDoGroup(
								$arRow->id,
								'askaron_sections1c_deactivate',
								$sThisSectionUrl
							),
					);
				}
			}
		}
	}

	public static function OnBeforePrologHandler()
	{
		global $APPLICATION;

		$SECTION_ID = "";
		if ( isset( $_REQUEST["ID"] ) )
		{
			$SECTION_ID = $_REQUEST["ID"];
			$SECTION_ID	= intval( str_replace("S", "", $SECTION_ID) );
		}

		if(!empty($_REQUEST['action_button']))
		{
			$ACTION = trim( $_REQUEST['action_button'] );
		}
		else
		{
			$ACTION = trim( $_REQUEST['action'] );
		}

		$strCurPage = $APPLICATION->GetCurPage();

		if (
			$ACTION == "askaron_sections1c_deactivate" && $SECTION_ID > 0 && check_bitrix_sessid()
			&&
			(
				$strCurPage=='/bitrix/admin/iblock_section_admin.php'
				||
				$strCurPage=='/bitrix/admin/iblock_list_admin.php'
				||
				$strCurPage=='/bitrix/admin/cat_section_admin.php'
			)
		)
		{
			if ( CAskaronSections1c::GetPermissionSection($SECTION_ID) >= "W" )
			{
				@set_time_limit(0);
				CAskaronSections1c::Deactivate($SECTION_ID);
			}

			//unset($_REQUEST['action']);
		}
	}
}
?>
