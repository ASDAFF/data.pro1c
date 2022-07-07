<?
IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("data.pro1c")!="D")
{
    CModule::IncludeModule('data.pro1c');
	$aMenu = array(
		"parent_menu" => "global_menu_store",
		"section" => "data.pro1c",
		"sort" => 50,
        "module_id" => "data.pro1c",
		"text" => GetMessage("DATA_PRO1C_MENU_MAIN"),
		"title" => GetMessage("DATA_PRO1C_MENU_MAIN_TITLE"),
		"url" => "data_pro1c_live_log.php?lang=".LANGUAGE_ID,
		"icon" => "data_pro1c_menu_icon",
		//"page_icon" => "data_pro1c_page_icon",
		"items_id" => "menu_data_pro1c",
		"items" => array(
			array(
				"text" => GetMessage("DATA_PRO1C_MENU_LIVE_LOG"),
				"url" => "data_pro1c_live_log.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"data_pro1c_event_admin.php",
					//"data_pro1c_event_edit.php",

				),
				"title" => GetMessage("DATA_PRO1C_MENU_LIVE_LOG_TITLE"),
			),
			array(
				"text" => GetMessage("DATA_PRO1C_LOG_VIEW_PAGE"),
				"url" => "data_pro1c_log_view.php?lang=" . LANGUAGE_ID,
				"more_url" => Array(),
				"title" => GetMessage("DATA_PRO1C_LOG_VIEW_PAGE_TITLE"),
			),
			array(
				"text" => GetMessage("DATA_PRO1C_MENU_LAST"),
				"url" => "data_pro1c_last.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"data_pro1c_event_admin.php",
					//"data_pro1c_event_edit.php",

				),
				"title" => GetMessage("DATA_PRO1C_MENU_LAST_TITLE"),
			),			
			array(
				"text" => GetMessage("DATA_PRO1C_MENU_CHECK"),
				"url" => "data_pro1c_check.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"data_pro1c_event_admin.php",
					//"data_pro1c_event_edit.php",

				),
				"title" => GetMessage("DATA_PRO1C_MENU_CHECK_TITLE"),
			),
			array(
				"text" => GetMessage("DATA_PRO1C_SETTINGS_PAGE"),
				"url" => "settings.php?mid=data.pro1c&lang=".LANGUAGE_ID."&mid_menu=2",
				"more_url" => Array(
				),
				"title" => GetMessage("DATA_PRO1C_SETTINGS_PAGE_TITLE"),
			),
		),
	);
	return $aMenu;
}
return false;
?>
