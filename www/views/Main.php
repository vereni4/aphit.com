<?php foreach ($_content['articles'] as $_row): ?>

  <div class="article">
    <p class="heading2"><?php echo $_row['title'] ?></p>
    <p class="author">
      <a href="?option=UserProfile&amp;user_id=<?php echo 8 ?>">
        <?php echo $_row['author']?>
      </a>
      <?php echo ' | ' . $_row['date'] . ' ' ?>
    </p>
    <p>
      <img src="<?php echo $_row['img_src'] ?>" alt="">
      <?php echo $_row['discription'] ?>
    </p>
    <p>
      <a href="?option=View&amp;id_text=<?php echo $_row['id'] ?>">
        <?php echo SiteLang::getRending('READ_MORE') ?>
      </a>
      <?php if (!empty($this -> currentUser)): ?>
        <a href="?option=ArticleEdit&amp;id_text=<?php echo $_row['id'] ?>">
          <?php echo SiteLang::getRending('EDIT') ?>
        </a>
        <a href="?option=ArticleDelete&amp;delete_id_text=<?php echo $_row['id'] ?>">
          <?php echo SiteLang::getRending('DELETE') ?>
        </a>
      <?php endif; ?>
    </p>
  </div>

<?php endforeach; ?>

<div class="pagination">
  <?php echo $_content['pagination'] ?>
</div>
