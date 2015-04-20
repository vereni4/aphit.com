<form id="form_user" enctype="multipart/form-data" action="" method="POST">
  <p>
    <lable for="login"><?php echo SiteLang::getRending('LOGIN_2') ?></lable>
    <input type="text" name="login" style="width:100px" required>
  </p>
  <p>
    <lable for="password"><?php echo SiteLang::getRending('PASS') ?></lable>
    <input type="password" name="password" style="width:100px" required>
  </p>
  <p>
    <input type="submit" name="button" value="<?php echo SiteLang::getRending('LOGIN_3') ?>">
  </p>
</form>
