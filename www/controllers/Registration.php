<?php

class Registration extends MainController {

  public function processingPOST() {
    
    $_parameters = Array(
      'login'             => trim(strip_tags($_POST['login'])),
      'pass'              => md5(trim(strip_tags($_POST['password']))),
      'email'             => trim(strip_tags($_POST['email'])),
      'registration_date' => date('Y-m-d h:i:s A', time()),
      'date_of_visit'     => date('Y-m-d h:i:s A', time()),
    );

    $_password_2  = md5(trim(strip_tags($_POST['password_2'])));

    if (empty($_parameters['login'])
        || empty($_parameters['pass'])
        || empty($_parameters['email'])
        || empty($_password_2)) {

      echo SiteLang::getRending('ERROR_8');
      return FALSE;
    }
    elseif ($_parameters['pass'] <> $_password_2) {
      echo SiteLang::getRending('ERROR_19');
      return FALSE;
    }

    $_user = $this -> model -> getUser($_parameters['login'], $_parameters['pass']);
    if (!empty($_user)) {
      echo SiteLang::getRending('ERROR_20');
      return FALSE;
    }

    $_user_id = $this -> model -> userInsert($_parameters);
    if (!empty($_user_id)) {
      $_SESSION['current_user'] = $_parameters['login'];
      $_SESSION['current_user_id'] = $_user_id;
      header('Location:?option=UserProfile&user_id=' . $_user_id);
      exit();
    }
  }

  public function getContent() {
    return TRUE;
  }
}

?>
