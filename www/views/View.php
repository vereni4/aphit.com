<?php if (!empty($_content['ERROR'])): ?>
  <p class='heading2' style='font-size:18px'>
    <?php echo $_content['ERROR'] ?>
  </p>
<?php else: ?>
  <?php $_article = $_content['article']; ?>
  <p class='heading2' style='font-size:18px'>
    <?php echo $_article['title'] ?>
  </p>
  <p class='author'>
    <?php echo $_article['author'] ?> | <?php echo $_article['date'] ?>
  </p>
  <p>
    <img style='margin-right:5px; width: 150px; float: left' src='<?php echo $_article['img_src'] ?>' alt=''>
    <?php echo $_article['text'] ?>
  </p>

  <p>
    <?php if (!empty($this -> currentUser)): ?>
      <a href='?option=ArticleEdit&amp;id_text=<?php echo $_article['id'] ?>'>
        <?php echo SiteLang::getRending('EDIT') ?>
      </a>
      <a href='?option=ArticleDelete&amp;delete_id_text=<?php echo $_article['id'] ?>'>
        <?php echo SiteLang::getRending('DELETE') ?>
      </a>

      <?php include 'views/Comments.php'; ?>

    <?php endif; ?>
  </p>
<?php endif; ?>
