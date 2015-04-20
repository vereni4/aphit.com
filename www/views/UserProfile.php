<p class="heading2">
  <?php echo $_content['login'] ?>
</p>
<img style="margin-right: 5px; width: 150px; height: 150px; float: left" src="<?php echo $_content['avatar'] ?>" alt="">

<?php if(!empty($this -> currentUser)): ?>
  <p><?php echo SiteLang::getRending('EMAIL') . ' ' . $_content['email'] ?></p>
<?php endif; ?>

<p>
  <?php echo SiteLang::getRending('NAME') . ' (' . SiteLang::getRending('SURNAME') . '): ' .
             $_content['name'] . ' ' . $_content['surname'] ?>
</p>
<p>
  <?php echo SiteLang::getRending('REG_DATE') . ': ' . $_content['registration_date'] ?>
</p>
<p>
  <?php echo SiteLang::getRending('DATE_OF_VISIT') . ': ' . $_content['date_of_visit'] ?>
</p>

<?php if ($_content['id'] == $this -> currentUserID && !empty($this -> currentUser)): ?>
  <a href="?option=ProfileEdit&amp;user_id=<?php echo $_content['id'] ?>">
    <?php echo SiteLang::getRending('EDIT') ?>
  </a>
  <a href="?option=ProfileDelete&amp;delete_id_user=<?php echo $_content['id'] ?>">
    <?php echo SiteLang::getRending('DELETE') ?>
  </a>
<?php endif; ?>

