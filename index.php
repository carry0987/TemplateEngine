<?php
require dirname(__FILE__).'/vendor/autoload.php';

use carry0987\Template\Template;
use carry0987\Template\Controller\DBController;
use carry0987\Template\Controller\RedisController;

//Template setting
$options = array(
    'template_dir' => 'template',
    'css_dir' => 'static/css/', //Set css file's directory, false for no need for css
    'js_dir' => 'static/js/', //Set js file's directory, false for no need for js
    'static_dir' => 'static/', //Set static file's directory
    'cache_dir' => 'cache', //Set cache file's directory
    'auto_update' => true, //Set 'false' to turn off auto update template
    'cache_lifetime' => 0, //Set cache file's lifetime (minute), 0 for permanent
);

//Database setting
$config = array(
    'host' => 'mariadb',
    'port' => 3306,
    'database' => 'dev_tpl',
    'username' => 'test_user',
    'password' => 'test1234',
);
$redisCofig = array(
    'host' => 'redis',
    'port' => 6379,
    'password' => 'test1234',
    'database' => 5,
);
$database = new DBController($config);
$redis = new RedisController($redisCofig);
$template = new Template;
$template->setOptions($options);
$template->setDatabase($database);
// $template->setRedis($redis);

$meme = 'Sad-Meme';
$array = array('testa' => 'a', 'testb' => 'b');
//Include template file
include($template->loadTemplate('template.html'));
