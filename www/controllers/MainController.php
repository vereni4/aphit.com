<?php

abstract class MainController {

  protected $model;
  protected $languages;
  protected $currentUser;
  protected $currentUserID;
  
  abstract function getContent();

  abstract function processingPOST();

  public function getBody($_main_template = '404') {

    if (!empty($_POST)
        || isset($_GET['Exit'])
        || isset($_GET['delete_id_text'])
        || isset($_GET['delete_id_user'])
        || isset($_GET['delete_id_comment'])) {

      $this -> processingPOST();
    }

    $_categories = $this -> model -> getCategories();
    $_menu_items = $this -> model -> getMenuItems();
    $_content    = $this -> getContent();

    include 'views/index.php';
 }

  public function __construct($_model) {

    $this -> model = $_model;
    $this -> languages = array('en' => 'English', 'ua' => 'Українська');

    if (!empty($_SESSION['current_user']) && !empty($_SESSION['current_user_id'])) {
      $this -> currentUser = trim(strip_tags($_SESSION['current_user']));
      $this -> currentUserID = (int) $_SESSION['current_user_id'];
    }
  }

}

?>
