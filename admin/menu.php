<?
/**
 * Copyright (c) 2/8/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("import.pro1c")!="D")
{
    CModule::IncludeModule('import.pro1c');
	$aMenu = array(
		"parent_menu" => "global_menu_store",
		"section" => "import.pro1c",
		"sort" => 50,
        "module_id" => "import.pro1c",
		"text" => GetMessage("IMPORT_PRO1C_MENU_MAIN"),
		"title" => GetMessage("IMPORT_PRO1C_MENU_MAIN_TITLE"),
		"url" => "import_pro1c_live_log.php?lang=".LANGUAGE_ID,
		"icon" => "import_pro1c_menu_icon",
		//"page_icon" => "import_pro1c_page_icon",
		"items_id" => "menu_import_pro1c",
		"items" => array(
			array(
				"text" => GetMessage("IMPORT_PRO1C_MENU_LIVE_LOG"),
				"url" => "import_pro1c_live_log.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"import_pro1c_event_admin.php",
					//"import_pro1c_event_edit.php",

				),
				"title" => GetMessage("IMPORT_PRO1C_MENU_LIVE_LOG_TITLE"),
			),
			array(
				"text" => GetMessage("IMPORT_PRO1C_LOG_VIEW_PAGE"),
				"url" => "import_pro1c_log_view.php?lang=" . LANGUAGE_ID,
				"more_url" => Array(),
				"title" => GetMessage("IMPORT_PRO1C_LOG_VIEW_PAGE_TITLE"),
			),
			array(
				"text" => GetMessage("IMPORT_PRO1C_MENU_LAST"),
				"url" => "import_pro1c_last.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"import_pro1c_event_admin.php",
					//"import_pro1c_event_edit.php",

				),
				"title" => GetMessage("IMPORT_PRO1C_MENU_LAST_TITLE"),
			),			
			array(
				"text" => GetMessage("IMPORT_PRO1C_MENU_CHECK"),
				"url" => "import_pro1c_check.php?lang=".LANGUAGE_ID,
				"more_url" => Array(
					//"import_pro1c_event_admin.php",
					//"import_pro1c_event_edit.php",

				),
				"title" => GetMessage("IMPORT_PRO1C_MENU_CHECK_TITLE"),
			),
			array(
				"text" => GetMessage("IMPORT_PRO1C_SETTINGS_PAGE"),
				"url" => "settings.php?mid=import.pro1c&lang=".LANGUAGE_ID."&mid_menu=2",
				"more_url" => Array(
				),
				"title" => GetMessage("IMPORT_PRO1C_SETTINGS_PAGE_TITLE"),
			),
		),
	);
	return $aMenu;
}
return false;
?>
