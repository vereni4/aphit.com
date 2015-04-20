<?php

class ArticleDelete extends MainController {

  public function getContent() {
    return TRUE;
  }

  public function processingPOST() {

    if (empty($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    if (isset($_GET['delete_id_text'])) {

      $_id_text = (int) $_GET['delete_id_text'];

      if ($_id_text) {

        foreach ($this -> languages as $_key_lang => $_lang) {

          $_result = $this -> model -> articleDelete($_key_lang, $_id_text);
          if ($_result) {
            $_is_ok = 1;
          }
          else {
            $_is_ok = 0;
            echo SiteLang::getRending('ERROR_17') . ' ' . $_id_text;
          }
        }

        if ($_is_ok) {
            header('Location:?option=Main');
            exit();
        }
      }
      else {
        echo SiteLang::getRending('ERROR_18');
      }
    }
    else {
      echo SiteLang::getRending('ERROR_18');
    }
  }
}

?>
