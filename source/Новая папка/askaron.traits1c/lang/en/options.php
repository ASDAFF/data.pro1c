<?
$MESS["askaron_traits1c_more"] = "Еще";
$MESS["askaron_traits1c_header_settings"] = "Множественное свойство «Реквизиты»";
$MESS["askaron_traits1c_field_active"] = "Активность";
$MESS["askaron_traits1c_field_name"] = "Название реквизита";
$MESS["askaron_traits1c_field_code"] = "Копировать значение в свойство с кодом";
$MESS["askaron_traits1c_error_empty"] = "Реквизит #TRAIT#: код свойства не заполнен";
$MESS["askaron_traits1c_error_first_symbol"] = "Реквизит #TRAIT#: код свойства не может начинаться с цифры";
$MESS["askaron_traits1c_error_format"] = "Реквизит #TRAIT#: код свойства может состоять только из латинских символов, цифр и знака подчеркивания";
$MESS["askaron_traits1c_error_save"] = "Список настроек для реквизитов не был сохранен. Список настроек не поместился в 2000 символов.";
$MESS["askaron_traits1c_error_save_header"] = "Ошибка при сохранении данных";
$MESS["askaron_traits1c_help"] = "
<p>При стандартном обмене с 1С реквизиты выгружаются в одно множественное свойство товара «Реквизиты» (CML2_TRAITS).</p>	

<p>Модуль копирует значения реквизитов в указанные вами свойства инфоблока.</p>";
$MESS["askaron_traits1c_header_element_fields"] = "Поля элемента инфоблока при выгрузке товара из 1С";
$MESS["askaron_traits1c_name"] = "Название";
$MESS["askaron_traits1c_preview_text"] = "Краткое описание";
$MESS["askaron_traits1c_detail_text"] = "Детальное описание";
$MESS["askaron_traits1c_additional_settings"] = "Дополнительные настройки";
$MESS["askaron_traits1c_additional_settings_code"] = "Значение свойства из реквизита Код";
$MESS["askaron_traits1c_code_remove_symbols"] = "Удалять в начале все символы до первой значащей цифры";
$MESS["askaron_traits1c_code_remove_symbols_help"] = "Eсли опция включена, то код вида A00000000571 будет записан, как 571";
$MESS["askaron_traits1c_code_length"] = "Дописывать в начало нули, чтобы длина строки была не менее";
$MESS["askaron_traits1c_code_length_help"] = "Например, если указать 11, то в начало кода 571 будут дописаны нули 00000000571. Если значение опции 0, то строка изменяться не будет.";
$MESS["askaron_traits1c_option_status_demo"] = "Модуль «Реквизиты товара из 1С» работает в демо-режиме";
$MESS["askaron_traits1c_option_status_demo_expired"] = "Истёк срок работы модуля «Реквизиты товара из 1С» в демо-режиме";
$MESS["askaron_traits1c_option_buy_html"] = "<a href=\"http://marketplace.1c-bitrix.ru/solutions/askaron.traits1c/\">Купить лицензию</a> на сайте «1С-Битрикс Маркетплейс»";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_PROPERTY"] = "записывать из строкового свойства";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_PROPERTY_CODE"] = "код свойства";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_FULL_NAME"] = "записывать из Полного наименования в 1С, если выше пусто";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_NAME"] = "записывать из Наименования в 1С, если выше пусто (по умолчанию включено)";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_DESCRIPTION"] = "записывать из Описания товара в 1С, если выше пусто";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_FULL_NAME2"] = "записывать из Полного наименования в 1С, если выше пусто (по умолчанию включено)";
$MESS["ASKARON_TRAITS1C_WRITE_FROM_DESCRIPTION2"] = "записывать из Описания товара в 1С, если выше пусто (по умолчанию включено)";
$MESS["ASKARON_TRAITS1C_NAME_HELP_TITLE"] = "Замечание по записи названия:";
$MESS["ASKARON_TRAITS1C_NAME_HELP"] = "Если снять все флажки, то при повторной выгрузке товара название изменяться не будет. 
						А при выгрузке товара в первый раз будет подставлено Наименование из 1С.
						Потому что в Битриксе название элемента обязательно. Пустое значение невозможно.
						
					";
$MESS["ASKARON_TRAITS1C_PREVIEW_TEXT_HELP"] = "Замечание по записи краткого описания:";
$MESS["ASKARON_TRAITS1C_PREVIEW_TEXT"] = "Если снять все флажки, то краткое описание не будет записываться или изменяться при выгрузке из 1С. 
					";
$MESS["ASKARON_TRAITS1C_DETAIL_TEXT_HELP"] = "Замечание по записи детального описания:";
$MESS["ASKARON_TRAITS1C_DETAIL_TEXT"] = "Если снять все флажки, то детальное описание не будет записываться или изменяться при выгрузке из 1С.
					";
?>