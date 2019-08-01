<?
/**
 * Copyright (c) 2/8/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$MESS ['import_pro1c_forbidden_page'] =
	"Эта страница #THIS_PAGE# запрещена в настройках модуля \"Продвинутый обмен с 1С\".\n".
	"Страница настроек http://#SERVER_NAME#/bitrix/admin/settings.php?mid=import.pro1c&lang=#LANG#\n".
	"Информация о модуле http://marketplace.1c-bitrix.ru/solutions/import.pro1c/\n";

$MESS ['import_pro1c_skip_products'] =
	"Импорт описаний товаров пропущен.";

$MESS ['import_pro1c_skip_deactivate'] =
	"Деактивация товаров и разделов товаров пропущена.";

$MESS ['import_pro1c_skip_description'] = 	"Опция пропускать описания товаров указана в модуле \"Продвинутый обмен с 1С\" для страницы #THIS_PAGE#.\n".
	"Страница настроек http://#SERVER_NAME#/bitrix/admin/settings.php?mid=import.pro1c&lang=#LANG#\n".
	"Информация о модуле http://marketplace.1c-bitrix.ru/solutions/import.pro1c/\n";



$MESS ['import_pro1c_live_log_works'] = 'Живой лог работает';

$MESS ['import_pro1c_element_add_success'] = "Элемент с ID=#ID# успешно добавлен";
$MESS ['import_pro1c_element_add_error'] = "Ошибка добавления элемента инфоблока (#RESULT_MESSAGE#).";
$MESS ['import_pro1c_element_update_success'] = "Элемент с ID=#ID# успешно изменен";
$MESS ['import_pro1c_element_update_error'] = "Ошибка изменения элемента инфоблока ID=#ID# (#RESULT_MESSAGE#).";
$MESS ['import_pro1c_element_write_time'] = "Непосредственное время записи элемента в базу данных (без обработчиков событий) #TIME# сек.";
$MESS ['import_pro1c_empty_quantity'] = "Пустой остаток. Будет записан 0";
$MESS ['import_pro1c_step_time'] = "Время выполнения шага обмена (сек.)";
$MESS ['import_pro1c_step_result'] = "Ответ шага обмена";
$MESS ['import_pro1c_new_step'] = 'Начало нового этапа №#STEP#. Параметры в $_SESSION["BX_CML2_IMPORT"]["NS"]';

$MESS ['import_pro1c_element_total_time'] =
	"Общеее время записи элемента, включая работу всех обработчиков событий #TOTAL_TIME# сек.
Ориентировочное время событий OnBefore #BEFORE_EVENTS_TIME# сек.
Ориентировочное время событий OnAfter #AFTER_EVENTS_TIME# сек.
Время на подготовку к записи от OnStart до OnBefore #START_TIME# сек.";


?>