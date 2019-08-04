<?
/**
 * Copyright (c) 4/8/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$MESS ['import_pro1c_live_log_title'] = "Живой лог";
$MESS ['import_pro1c_live_log_pull_not_installed'] = 'Модуль Push and Pull не установлен!';
$MESS ['import_pro1c_live_log_alert_message'] = 'Задержка получения ответа составляет 5 секунд. Пожалуйста, дождитесь ответа и не закрывайте эту страницу.';
$MESS ['import_pro1c_live_log_alert_message_nginx'] = 'Запрос отправлен на сервер nginx. Скоро должен быть ответ.';
$MESS ['import_pro1c_live_log_alert_message_nginx_error'] = 'Ответ от nginx не пришел в течение 5 секунд. Попробуйте обновить страницу и проверить еще раз. Если не работает, скорее всего на хостинге не настроен nginx. Ничего страшного, отключите опцию модуля Push and Pull «На сервере установлен "Cервер очередей" (nginx-push-stream-module)» и пользутесь модулем в режиме без nginx.';

$MESS ['import_pro1c_live_log_message'] = 'Живой лог позволяет в реальном времени наблюдать за выполненнием страниц.';

$MESS ['import_pro1c_live_log_warning'] = '
	<strong>Внимание:</strong> задержка получения ответа от  сервера составляет 5 секунд.<br /><br />Опция модуля Push and Pull «На сервере установлен "Cервер очередей" (nginx-push-stream-module)» выключена.
	<br /><br />Чтобы Живой лог работал без задержек, рекомендуется в <a href="settings.php?lang=#LANG#&amp;mid=pull&amp;mid_menu=1"> настойках модуля Push and Pull</a> включить опцию <em>«На сервере установлен "Сервер очередей" (nginx-push-stream-module)»</em>.
	<br /><br />Важно: настройка nginx-push-stream-module на вашем сервере в обязаннности разработчика модуля не входит. nginx-push-stream-module уже настроен на Виртуальной машине Битрикса 4.2 и выше.';

$MESS ['import_pro1c_live_log_warning_nginx'] = '
	Опция модуля Push and Pull <em>«На сервере установлен "Cервер очередей" (nginx-push-stream-module)»</em> <strong>включена</strong>.
	<br /><br />Если живой лог не работает, то скорее всего на вашем сервере не настроен nginx.
	<br /><br />Отключите опцию <em>«На сервере установлен "Cервер очередей" (nginx-push-stream-module)»</em> в <a href="settings.php?lang=#LANG#&amp;mid=pull&amp;mid_menu=1"> настойках модуля Push and Pull</a> и пользуйтесь модулем в режиме без nginx.
	<br /><br />Важно: настройка nginx-push-stream-module на вашем сервере в обязаннности разработчика модуля не входит. nginx-push-stream-module уже настроен на Виртуальной машине Битрикса 4.2 и выше.';


$MESS ['import_pro1c_live_log_test'] = 'Проверить работу Живого лога';
$MESS ['import_pro1c_live_log_off'] = 'Живой лог выключен';
$MESS ['import_pro1c_live_log_off_details'] = 'Включите Живой лог в <a href="settings.php?mid=import.pro1c&amp;lang=#LANG#&amp;mid_menu=2">настройках модуля</a> (раздел Отладка обмена).';
$MESS ['import_pro1c_live_log_clean'] = 'Очистить область';
$MESS ['import_pro1c_live_log_counter'] = 'Счетчик: ';
$MESS ['import_pro1c_live_log_pull_install'] = '<a href="module_admin.php?lang=#LANG#">Установить модуль</a> Push and Pull';

$MESS ['import_pro1c_live_log_settings'] = 'Настройки модуля «<a href="settings.php?mid=import.pro1c&amp;lang=#LANG#&amp;mid_menu=2">Продвинутый обмен с 1С</a>».';


$MESS ['import_pro1c_live_log_set_forbidden'] = "Запретить выполнение скрипта";
$MESS ['import_pro1c_live_log_set_forbidden_success'] = "Опция «Запретить выполнение скрипта» записана успешно";

$MESS ['import_pro1c_live_log_set_log'] = "Записывать все шаги в обычный лог-файл";
$MESS ['import_pro1c_live_log_set_log_success'] = "Опция «Записывать все шаги в обычный лог-файл» записана успешно";

$MESS ['import_pro1c_live_log_help_in_settings'] = "Подробное описание опции в настройках модуля";
?>
