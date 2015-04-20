<?php

class Category extends MainController {

  public function processingPOST() {
    return FALSE;
  }

  public function getContent() {

    $_assoc = array(
      'pagination' => '',
      'articles'   => array(),
    );

    if (isset($_GET['id_category'])) {

      $_id_category = (int) $_GET['id_category'];

      $_pager_config = 10;
      $_page = isset($_GET['page'])? intval($_GET['page']) : 1;

      if ($_id_category && $_page) {

        $_limits = ($_page - 1) * $_pager_config;

        $_assoc['articles'] = $this -> model -> getArticles($_limits, $_pager_config, 'id_category = ' . $_id_category);


        $_count = $this -> model -> getRowsCount('article_' . $this -> model -> language, 'id_category = ' . $_id_category);
        if ($_count > $_pager_config) {
          $_pages = ceil($_count / $_pager_config);
          $_links = '?option=Category&amp;id_category=' . $_id_category . '&amp;page=';
          $_assoc['pagination'] = $this -> model -> pagination($_links, '', $_pages, $_page);
        }

        if ($_count == 0) {
          return Array('ERROR' => SiteLang::getRending('ERROR_3'));
        }
      }
      else {
        return Array('ERROR' => SiteLang::getRending('ERROR_4'));
      }
    }
    else {
      return Array('ERROR' => SiteLang::getRending('ERROR_4'));
    }

    return $_assoc;
  }
}

?>
