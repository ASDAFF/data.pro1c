<?
IncludeModuleLangFile(__FILE__);

if (defined("BX_UTF") && BX_UTF === true)
{
	$askaron_traits1c_serialized_settings = GetMessage("askaron_traits1c_default_settings_utf8_serialized");
}
else
{
	$askaron_traits1c_serialized_settings = GetMessage("askaron_traits1c_default_settings_windows1251_serialized");
}


$askaron_traits1c_default_option = array(
	"settings" => $askaron_traits1c_serialized_settings,
	"code_remove_symbols" => "N",
	"code_length" => 0,

	"name_from_property" => "N",
	"name_from_property_code" => "DLYA_SAYTA_NAZVANIE",
	"name_from_preview_text" => "N",
	"name_from_name" => "Y",


	"preview_text_from_property" => "N",
	"preview_text_from_property_code" => "DLYA_SAYTA_KRATKOE_OPISANIE",	
	"preview_text_from_detail_text" => "N",	
	"preview_text_from_preview_text" => "Y",
	

	"detail_text_from_property" => "N",
	"detail_text_from_property_code" => "DLYA_SAYTA_DETALNOE_OPISANIE",	
	"detail_text_from_detail_text" => "Y",
	
	//"full_name" => "PREVIEW_TEXT", // deprecated  NAME, PREVIEW_TEXT, NO_WRITE
	
);
?>