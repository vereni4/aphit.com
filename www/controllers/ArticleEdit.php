<?php

class ArticleEdit extends MainController {

  public function processingPOST() {
    
    if (empty($this -> currentUser)) {
      header('Location:?option=Main');
      exit();
    }

    $_parameters = Array();
    $_article_id = Array();
    foreach ($this -> languages as $_key_lang => $_lang) {

      $_parameters[$_key_lang] = Array(
        'title'       => $_POST['title_' . $_key_lang],
        'text'        => $_POST['text_' . $_key_lang],
        'id_category' => $_POST['category_' . $_key_lang],
        'date'        => date('Y-m-d', time()),
        'author'      => $this -> currentUser,
        'img_src'     => $this -> model -> moveFile('img_src_' . $_key_lang, 'file/'),
        'discription' => $this -> model -> textTrunc($_POST['text_' . $_key_lang], 150),
      );

      $_article_id[$_key_lang] = $_POST['id_text_' . $_key_lang];

      if (empty($_parameters[$_key_lang]['title'])
          || empty($_parameters[$_key_lang]['text'])
          || empty($_parameters[$_key_lang]['id_category'])) {

        echo SiteLang::getRending('ERROR_13');
        return FALSE;
      }
    }

    foreach ($this -> languages as $_key_lang => $_lang) {
      if (empty($_article_id[$_key_lang])) {
        $_article_id[$_key_lang] = $this -> model -> articleInsert($_parameters[$_key_lang], $_key_lang);
        if ($_article_id[$_key_lang] == FALSE) {
          echo SiteLang::getRending('ERROR_14');
          return FALSE;
        }
      }
      else {
        $_result = $this -> model -> articleUpdate($_parameters[$_key_lang], $_key_lang, $_article_id[$_key_lang]);
        if (!$_result) {
          echo SiteLang::getRending('ERROR_14');
          return FALSE;
        }
      }
    }

    header('Location:?option=View&id_text=' . $_article_id['en']);
  }

  public function getContent() {

    if (empty($this -> currentUser)) {
      echo SiteLang::getRending('ERROR_15');
      return FALSE;
    }

    $_content = Array();
    foreach ($this -> languages as $_key_lang => $_lang) {
      $_content['categories_' . $_key_lang] = $this -> model -> getCategories($_key_lang);
      if (isset($_GET['id_text'])) {
        $_content['article_' . $_key_lang] = $this -> model -> getArticle($_GET['id_text'], $_key_lang);
      }
      else {
        $_content['article_' . $_key_lang] = array();
      }
    }

    return $_content;
  }
}

?>
