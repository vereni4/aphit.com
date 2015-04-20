<?php

class CommentDelete extends MainController {

  public function getContent() {
    return;
  }

  public function processingPOST() {

    if (empty($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    if (isset($_GET['delete_id_comment'])) {

      $_result = $this -> model -> commentDelete($_GET['delete_id_comment']);

      if ($_result) {
        header('Location:?option=View&id_text=' . (int) $_GET['id_text']);
        exit();
      }
      else {
        echo SiteLang::getRending('ERROR_17') . ' ' . $_GET['delete_id_comment'];
      }
    }
    else {
      echo SiteLang::getRending('ERROR_18');
    }
  }
}

?>
