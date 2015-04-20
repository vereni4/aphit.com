<?php

class Main extends MainController {

  public function processingPOST() {
    return FALSE;
  }

  public function getContent() {

    $_content = array(
      'pagination' => '',
      'articles'   => array(),
    );

    $_pager_config = 10;
    $_page = isset($_GET['page'])? intval($_GET['page']) : 1;

    if ($_page) {

      $_limits = ($_page - 1) * $_pager_config;

      $_content['articles'] = $this -> model -> getArticles($_limits, $_pager_config);

      $_count = $this -> model -> getRowsCount('article_' . $this -> model -> language);
      if ($_count > $_pager_config) {
        $_pages = ceil($_count / $_pager_config);
        $_content['pagination'] = $this -> model -> pagination('?option=Main&amp;page=', '', $_pages, $_page);
      }
    }

    return $_content;
  }
}
?>
