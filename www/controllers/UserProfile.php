<?php

class UserProfile extends MainController {

  public function processingPOST() {
    return FALSE;
  }

  public function getContent() {

    if (isset($_GET['user_id'])) {

      $_user_id = (int) $_GET['user_id'];

      $_user = $this -> model -> getProfileContent($_user_id);
      if (!empty($_user)) {

        $_avatar_src = $_user['avatar'];
        if (!file_exists($_avatar_src) || !is_file($_avatar_src)) {
          $_avatar_src = 'images/no-image.png';
        }
        $_user['avatar'] = $_avatar_src;

        return $_user;
      }
    }

    return Array('login' => SiteLang::getRending('ERROR_7'));
  }
}

?>
