<?php
//модули при автозагрузке
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
//библиотеки
require_once 'core/dbconnect.php';
require_once 'core/session.php';
require_once 'core/hash.php';
require_once 'phar://yandex-php-library_master.phar/vendor/autoload.php';
require_once 'libs/yadiskconnect.php';
require_once 'libs/yandexlib.php';
//конфигурации
require 'config/database.php';


Route::start();
