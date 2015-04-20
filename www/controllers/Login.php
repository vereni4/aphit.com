<?php

class Login extends MainController {

  public function processingPOST() {
    $_login = trim(strip_tags($_POST['login']));
    $_password = trim(strip_tags($_POST['password']));
    if (empty($_login) || empty($_password)) {
      echo SiteLang::getRending('ERROR_8');
    }
    else {

      $_user = $this -> model -> getUser($_login, $_password);

      if (empty($_user)) {
        echo SiteLang::getRending('ERROR_9');
      }
      else {
        $this -> model -> setDateOfVisit($_user);

        $_SESSION['current_user'] = $_login;
        $_SESSION['current_user_id'] = $_user['id'];

        header('Location:?option=UserProfile&user_id=' . $_user['id']);
        exit();
      }
    }
  }

  public function getContent(){

    if (isset($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    return TRUE;
  }
}

?>
