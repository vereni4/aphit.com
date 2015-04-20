<?php foreach ($_content['articles'] as $_row): ?>

  <div style="margin: 10px; border-bottom: 2px solid #c2c2c2; height: 180px">
    <p class="heading2" style="font-size:18px"><?php echo $_row['title'] ?></p>
    <p class="author"><?php echo $_row['author'] . ' | ' . $_row['date'] ?></p>
    <p>
      <img style="margin-right:5px; width:150px; float: left" src="<?php echo $_row['img_src'] ?>" alt="">
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
