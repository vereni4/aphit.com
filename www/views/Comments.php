<div class="comments-template">
  <ol class="commentlist">
    <h3 id="respond"><?php echo SiteLang::getRending('ADD_COMMENT') ?></h3>
    <form action="" method="post" id="commentform">
      <p>
        <input type="text" name="comment-title" id="comment-title" size="40" tabindex="1" />
        <label for="comment-title">
          <small><?php echo SiteLang::getRending('COMMENT_TITLE') ?></small>
        </label>
      </p>

      <p>
        <textarea name="comment-text" id="comment" cols="60" rows="10" tabindex="4" required></textarea>
      </p>

      <p>
        <input name="comment-submit" type="submit" id="submit" tabindex="5"
               value="<?php echo SiteLang::getRending('SEND') ?>" />
        <input type="hidden" name="article_id" value="<?php echo $_article['id'] ?>" />
      </p>
    </form>

    <?php foreach ($_content['comments'] as $_comment): ?>

      <li class="comment" id="comment-<?php echo $_comment['id'] ?>">
        <p class="author">
          <a href="?option=UserProfile&amp;user_id=<?php echo $_comment['author_id'] ?>">
            <?php echo $_comment['login']?>
          </a>
          <?php echo ' | ' . $_comment['date'] . ' ' ?>

          <?php if (!empty($this -> currentUser) && $this -> currentUserID == $_comment['author_id']): ?>
            <a style='font-size:10px'
               href='?option=CommentDelete&amp;delete_id_comment=<?php echo $_comment['id']?>&amp;id_text=<?php echo $_article['id'] ?>'>
              <?php echo SiteLang::getRending('DELETE') ?>
            </a>
          <?php endif; ?>
        </p>
        <p class="heading2">
          <?php echo $_comment['title'] ?>
        </p>
        <p><?php echo $_comment['text'] ?></p>
      </li>
    <?php endforeach; ?>
    <div class="pagination">
      <?php echo $_content['pagination'] ?>
    </div>
  </ol>
</div>
