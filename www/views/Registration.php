<?php if(empty($this -> currentUser)): ?>
  <form id="form_user" enctype="multipart/form-data" action="" method="POST">
    <p>
      <lable for="login"><?php echo SiteLang::getRending('LOGIN_2') ?></lable>
      <input type="text" name="login" required>
    </p>
    <p>
      <lable for="password"><?php echo SiteLang::getRending('PASS') ?></lable>
      <input type="password" name="password" required>
    </p>
    <p>
      <lable for="password_2"><?php echo SiteLang::getRending('PASS_2') ?></lable>
      <input type="password" name="password_2" required>
    </p>
    <p>
      <lable for="email"><?php echo SiteLang::getRending('EMAIL') ?></lable>
      <input type="email" name="email" required>
    </p>
    <p>
      <input type="submit" name="button" value="<?php echo SiteLang::getRending('LOGIN_3') ?>">
    </p>
  </form>
<?php else: ?>
  <p><?php SiteLang::getRending('ERROR_10') ?></p>
<?php endif; ?>
