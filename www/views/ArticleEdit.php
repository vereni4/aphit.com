<?php if (!empty($this -> currentUser)): ?>
<form enctype="multipart/form-data" action="" method="POST">
  <p class="article-edit">
    <?php foreach ($this -> languages as $_key_lang => $_lang): ?>
      <span id="article-languages-<?php echo $_key_lang ?>"> <?php echo $_lang ?> </span>
    <?php endforeach; ?>
  </p>

  <?php foreach ($this -> languages as $_key_lang => $_lang): ?>
    <?php 
      $_article = $_content['article_' . $_key_lang];
      $_categories = $_content['categories_' . $_key_lang];
    ?>
    <div id="article-edit-<?php echo $_key_lang ?>">
      <p>
        <?php echo SiteLang::getRending('ARTICLE_TITLE') ?><br />
        <input type="text" name="title_<?php echo $_key_lang ?>" style="width:420px" value="<?php echo $_article['title'] ?>">
        <input type="hidden" name="id_text_<?php echo $_key_lang ?>" value="<?php echo $_article['id'] ?>">
      </p>
      <p>
        <?php echo SiteLang::getRending('IMAGE') ?><br />
        <input type="file" name="img_src_<?php echo $_key_lang ?>">
      </p>
      <p>
        <?php echo SiteLang::getRending('ARTICLE_TEXT') ?><br />
        <textarea name="text_<?php echo $_key_lang ?>" cols="50" rows="7"><?php echo $_article['text'] ?></textarea>
      </p>
      <select name="category_<?php echo $_key_lang ?>">
        <?php foreach ($_categories as $_category): ?>
          <?php if ($_category['id_category'] == $_article['id_category']): ?>
            <option selected value="<?php echo $_category['id_category'] ?>">
              <?php echo $_category['name_category'] ?>
            </option>
          <?php else: ?>
            <option value="<?php echo $_category['id_category'] ?>">
              <?php echo $_category['name_category'] ?>
            </option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
      <p>
        <input type="submit" name="button_<?php echo $_key_lang ?>" value="<?php echo SiteLang::getRending('SAVE') ?>">
      </p>
    </div>
  <?php endforeach; ?>
</form>
<?php endif; ?>
