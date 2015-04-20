<?php

class ProfileEdit extends MainController {

  public function processingPOST() {
    
    if (empty($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    $_parameters = Array(
      'login'   => trim(strip_tags($_POST['login'])),
      'email'   => trim(strip_tags($_POST['email'])),
      'name'    => trim(strip_tags($_POST['user_name'])),
      'surname' => trim(strip_tags($_POST['user_surname'])),
      'pass'    => trim(strip_tags($_POST['password'])),
      'avatar'  => $this -> model -> moveFile('avatar', 'file/'),
    );

    $_user_id     = (int) $_POST['user_id'];
    $_password_2  = trim(strip_tags($_POST['password_2']));

    if (empty($_parameters['login']) || empty($_parameters['email'])) {
      echo SiteLang::getRending('ERROR_13');
      return FALSE;
    }

    if ((!empty($_parameters['pass']) || !empty($_password_2)) && $_parameters['pass'] <> $_password_2) {
      echo SiteLang::getRending('ERROR_19');
      return FALSE;
    }
    elseif (!empty($_parameters['pass']) && !empty($_password_2)) {
      $_parameters['pass'] = md5($_parameters['pass']);
    }
    else {
      $_parameters['pass'] = NULL;
    }

    $_result = $this -> model -> profileUpdate($_parameters, $_user_id);
    if (!$_result) {
      echo SiteLang::getRending('ERROR_14');
      return FALSE;
    }
    header('Location:?option=UserProfile&user_id=' . $_user_id);
  }

  public function getContent() {

    if (isset($_GET['user_id'])) {

      $_user_id = (int) $_GET['user_id'];

      $_user = $this -> model -> getProfileContent($_user_id);
      if (!empty($_user)) {

        if ($_user['id'] <> $this -> currentUserID || empty($this -> currentUser)) {
          return Array('ERROR' => SiteLang::getRending('ERROR_15'));
        }

        return $_user;
      }
      else {
        return Array('ERROR' => SiteLang::getRending('ERROR_6') . ' ' . $_user_id);
      }
    }
    else {
      return Array('ERROR' => SiteLang::getRending('ERROR_7'));
    }
  }
}

?>
