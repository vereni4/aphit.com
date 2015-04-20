<?php

session_start();
header('Content-Type: text/html; charset= UTF-8');

require_once('config.php');
require_once('models/Model.php');

$_model = new Model();
$_model -> setLanguage();

$_lang_array_ = include './languages/' . $_model -> language . '.php';

function __autoload($_file_name) {
  if (file_exists('controllers/' . $_file_name . '.php')) {
    require_once('controllers/' . $_file_name . '.php');
  }
  elseif (file_exists('models/' . $_file_name . '.php')) {
    require_once('models/' . $_file_name . '.php');
  }
  else {
    exit(SiteLang::getRending('ERROR_2'));
  }
}

$_class_controller = 'Main';

if (isset($_GET['option'])) {
  $_class_controller = trim(strip_tags($_GET['option']));
}

if (class_exists($_class_controller)) {
 
  $_body_controller = new $_class_controller($_model);
  $_body_controller -> getBody($_class_controller);

}
else {
  exit(SiteLang::getRending('ERROR_1'));
}
?>
