<?php if(!empty($_content['ERROR'])): ?>
  <p class="heading2"><?php echo $_content['ERROR'] ?></p>
<?php else: ?>
  <p class="heading2"><?php echo $_content['login'] ?></p>
  <form id="form_user" enctype="multipart/form-data" action="" method="POST">
    <p>
      <input type="file" name="avatar">
    </p>
    <p>
      <lable for="login"><?php echo SiteLang::getRending('LOGIN_2') ?></lable>
      <input type="text" name="login" value="<?php echo $_content['login'] ?>" style="width:100px" required>
      <input type="hidden" name="user_id" value="<?php echo $_content['id'] ?>">
    </p>
    <p>
      <lable for="email"><?php echo SiteLang::getRending('EMAIL') ?></lable>
      <input type="email" name="email" value="<?php echo $_content['email'] ?>" style="width:100px" required>
    </p>
    <p>
      <lable for="user_name"><?php echo SiteLang::getRending('NAME') ?>:</lable>
      <input type="text" name="user_name" value="<?php echo $_content['name'] ?>" style="width:100px">
    </p>
    <p>
      <lable for="user_surname"><?php echo SiteLang::getRending('SURNAME') ?>:</lable>
      <input type="text" name="user_surname" value="<?php echo $_content['surname'] ?>" style="width:100px">
    </p>
    <p>
      <lable for="password"><?php echo SiteLang::getRending('PASS') ?></lable>
      <input type="password" name="password" style="width:100px">
    </p>
    <p>
      <lable for="password_2"><?php echo SiteLang::getRending('PASS_2') ?></lable>
      <input type="password" name="password_2" style="width:100px">
    </p>
    <p>
      <input type="submit" name="button" value="<?php echo SiteLang::getRending('SAVE') ?>">
    </p>
  </form>
  <a href="?option=ProfileDelete&amp;delete_id_user=<?php echo $_content['id'] ?>">
    <?php echo SiteLang::getRending('DELETE') ?>
  </a>
<?php endif; ?>
