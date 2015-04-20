<?php

class Menu extends MainController {

  public function processingPOST() {
    return;
  }

  public function getContent(){

    if (isset($_GET['id_menu'])) {

      $_id_menu = (int) $_GET['id_menu'];

      $_result = $this -> model -> getMenuContent($_id_menu);
      if (!empty($_result)) {
        return $_result;
      }
    }

    return Array('name_menu' => SiteLang::getRending('ERROR_5'));
  }
}

?>
