<?php

class View extends MainController {

  public function processingPOST() {

    $_parameters = Array(
      'title'      => trim(strip_tags($_POST['comment-title'])),
      'text'       => trim(strip_tags($_POST['comment-text'])),
      'article_id' => trim(strip_tags($_POST['article_id'])),
      'author_id'  => $this -> currentUserID,
      'date'       => date('Y-m-d h:i:s A', time()),
    );

    if (empty($_parameters['title'])) {
      $_parameters['title'] = $this -> model -> textTrunc($_parameters['title'], 15);
    }

    if (empty($_parameters['text'])) {
      echo SiteLang::getRending('ERROR_8');
      return FALSE;
    }
    else {
      $_result = $this -> model -> commentInsert($_parameters);
      if ($_result > 0) {
        header('Location:?option=View&id_text=' . $_parameters['article_id']);
        exit();
      }
    }
  }

  public function getContent() {

    if (isset($_GET['id_text'])) {

      $_content = array(
        'pagination' => '',
        'article'    => array(),
        'comments'   => array(),
      );

      $_id_text = (int) $_GET['id_text'];
      $_content['article'] = $this -> model -> getArticle($_id_text);
      if (!empty($_content['article'])) {

        if (empty($this -> currentUser)) {
          return $_content;
        }

        $_pager_config = 10;
        $_page = isset($_GET['page'])? intval($_GET['page']) : 1;
        if ($_page) {

          $_limits = ($_page - 1) * $_pager_config;

          $_content['comments'] = $this -> model -> getCommentsByArticle($_id_text, $_limits, $_pager_config);

          $_count = $this -> model -> getRowsCount('comments_' . $this -> model -> language);
          if ($_count > $_pager_config) {
            $_pages = ceil($_count / $_pager_config);
            $_content['pagination'] = $this -> model -> pagination('?option=View&id_text=' . $_id_text . '&page=', '', $_pages, $_page);
          }
        }

        return $_content;
      }
      else {
        return Array('ERROR' => SiteLang::getRending('ERROR_6') . ' ' . $_id_text);
      }
    }
    else {
      return Array('ERROR' => SiteLang::getRending('ERROR_7'));
    }
  }
}

?>
