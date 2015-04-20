<?php

class ProfileDelete extends MainController {

  public function getContent() {
    return;
  }

  public function processingPOST() {

    if (empty($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    if (isset($_GET['delete_id_user'])) {

      $_result = $this -> model -> profileDelete($_GET['delete_id_user']);

      if ($_result) {
        header('Location:?option=UserExit&Exit=1');
        exit();
      }
      else {
        echo SiteLang::getRending('ERROR_17') . ' ' . $_GET['delete_id_user'];
      }
    }
    else {
      echo SiteLang::getRending('ERROR_18');
    }
  }
}

?>
