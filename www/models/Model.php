<?php

class Model {

  public $language;
  protected $dataBase;

  public function getCategories($_language = '') {

    if ($_language == '') {
      $_language = $this -> language;
    }

    $_query_string = 
      'SELECT
        id_category, name_category
      FROM
        category_' . $_language . '
      ORDER BY
        id_category';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> execute();
      return $_result -> fetchAll();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function getMenuItems() {

    $_query_string = 
      'SELECT
        id_menu, name_menu
      FROM
        menu_' . $this -> language . '
      ORDER BY
        id_menu';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> execute();
      return $_result -> fetchAll();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function getMenuContent($_id = -1) {

    $_query_string = 
      'SELECT
        id_menu, name_menu, text_menu
      FROM
        menu_' . $this -> language . '
      WHERE
        id_menu = :id_menu';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':id_menu', $_id);
      $_result -> execute();
      return $_result -> fetch();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function getArticle($_id = -1, $_language = '') {

    if ($_language == '') {
      $_language = $this -> language;
    }

    $_query_string = 
    'SELECT
      id, title, text, author, date, img_src, id_category
    FROM
      article_' . $_language . '
    WHERE
      id = ?';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> execute(array($_id));
      return $_result -> fetch();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function getCommentsByArticle($_article_id, $_offset = 1, $_count = 10) {

    $_query_string =
      'SELECT
        comments.id, comments.article_id, comments.author_id, 
        users.login, comments.title, comments.text, comments.date
      FROM
        comments_' . $this -> language . ' AS comments
      LEFT JOIN users ON comments.author_id=users.id
      WHERE
        article_id = :article_id
      ORDER BY
        date DESC
      LIMIT :offset, :count';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':article_id' , $_article_id, PDO::PARAM_INT);
      $_result -> bindParam(':offset'     , $_offset, PDO::PARAM_INT);
      $_result -> bindParam(':count'      , $_count, PDO::PARAM_INT);
      $_result -> execute();
      return $_result -> fetchAll();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function commentDelete($_id = -1, $_language = '') {

    if ($_language == '') {
      $_language = $this -> language;
    }

    $_query_string = 
      'DELETE FROM
        comments_' . $_language . '
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function getArticles($_offset = 1, $_count = 10, $_selection = '') {

    $_query_string = 
      "SELECT
        id, title, author, date, img_src, discription
      FROM
        article_" . $this -> language . 
      (($_selection == '') ? '' : ' WHERE ' . $_selection) . "
      ORDER BY
        date DESC
      LIMIT $_offset, $_count";

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> execute();
      return $_result -> fetchAll();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function articleInsert($_parameters, $_language = 'en') {

    $_param_text = $this -> getStringParameters($_parameters);

    $_query_string =
      'INSERT INTO
        article_' . $_language . '
      SET ' . $_param_text;

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $this -> setParameters($_result, $_parameters);
      $_result -> execute();
      return $this -> dataBase -> lastInsertId();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return 0;
  }

  public function articleUpdate($_parameters, $_language = 'en', $_id = -1) {

    $_param_text = $this -> getStringParameters($_parameters);

    $_query_string = 
      'UPDATE
        article_' . $_language . '
      SET
        ' . $_param_text . '
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $this -> setParameters($_result, $_parameters);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function articleDelete($_language = 'en', $_id = -1) {

    $_query_string = 
      'DELETE FROM
        article_' . $_language . '
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function setDateOfVisit($_user) {

    $_date_of_visit = date('Y-m-d h:i:s A', time());
    $_query_string =
      'UPDATE
        users
      SET
        date_of_visit = :date_of_visit
      WHERE
        id = :user_id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':date_of_visit', $_date_of_visit);
      $_result -> bindParam(':user_id', $_user['id']);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function getUser($_login, $_password) {

    $_password = md5($_password);

    $_query_string = 
      'SELECT
        id
      FROM
        users
      WHERE
        login = :login AND pass = :password';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':login', $_login);
      $_result -> bindParam(':password', $_password);
      $_result -> execute();
      return $_result -> fetch();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function getProfileContent($_id = -1) {

    $_query_string = 
      'SELECT
        id, login, email, name, surname, registration_date, date_of_visit, avatar
      FROM
        users
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return $_result -> fetch();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return Array();
  }

  public function userInsert($_parameters) {

    $_param_text = $this -> getStringParameters($_parameters);

    $_query_string =
      'INSERT INTO
        users
      SET ' . $_param_text;

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $this -> setParameters($_result, $_parameters);
      $_result -> execute();
      return $this -> dataBase -> lastInsertId();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return 0;
  }

  public function profileUpdate($_parameters, $_id = -1) {

    $_param_text = $this -> getStringParameters($_parameters);

    $_query_string = 
      'UPDATE
        users
      SET
        ' . $_param_text . '
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $this -> setParameters($_result, $_parameters);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function profileDelete($_id = -1) {

    $_query_string = 
      'DELETE FROM
        users
      WHERE
        id = :id';

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $_result -> bindParam(':id', $_id);
      $_result -> execute();
      return TRUE;
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return FALSE;
  }

  public function commentInsert($_parameters) {

    $_param_text = $this -> getStringParameters($_parameters);

    $_query_string =
      'INSERT INTO
        comments_' . $this -> language . '
      SET ' . $_param_text;

    try {
      $_result = $this -> dataBase -> prepare($_query_string);
      $this -> setParameters($_result, $_parameters);
      $_result -> execute();
      return $this -> dataBase -> lastInsertId();
    }
    catch (PDOException $e) {
      echo $e -> getMessage();
    }

    return 0;
  }

  public function setLanguage() {
    
    if (isset($_GET['language'])) {
      $_SESSION['language'] = trim(strip_tags($_GET['language']));
    }
    elseif (!isset($_GET['language']) && !isset($_SESSION['language'])) {
      $_SESSION['language'] = 'en';
    }

    if ($_SESSION['language'] <> 'en' && $_SESSION['language'] <> 'ua') {
      $_SESSION['language'] = 'en';
    }

    $this -> language = $_SESSION['language'];

    return $this -> language;
  }

  public function getRowsCount($_table_name = '', $_selection = '') {
    
    if (!empty($_table_name)) {
      
      $_query_string = 
        'SELECT
          count(*) as rowsCount
        FROM
          ' . $_table_name .
        (($_selection == '') ? '' : ' WHERE ' . $_selection);

      try {
        $_result = $this -> dataBase -> query($_query_string);
        return $_result -> fetch()['rowsCount'];
      }
      catch (PDOException $e) {
        echo $e -> getMessage();
      }
    }
    
    return 0;
  }

  public function textTrunc($_str, $_maxLen) {
    if (mb_strlen($_str) > $_maxLen) {
      preg_match('/^.{0,' . $_maxLen . '} .*?/ui', $_str, $_match);
      return $_match[0] . '...';
    }
    else {
      return $_str;
    }
  }

  public function pagination($_links, $_linked, $_sum_pages, $_page) {
    
    $_lang = array('page_back' => SiteLang::getRending('BACK'), 'page_next' => SiteLang::getRending('NEXT'));
    
    if ($_page > 1) {
      $_link = '<a href="' . $_links . ($_page - 1) . $_linked . '">' . $_lang['page_back'] . '</a> ';
    }
    else {
      $_link = $_lang['page_back'] . ' ';
    }
    for ($i = 1; $i <= $_sum_pages; $i++) {
     $_link .= ($i == $_page)? $i : ' <a href="' . $_links . $i . $_linked . '">' . $i . '</a> ';
    }

    if ($_page < $_sum_pages) {
      $_link .= ' <a href="' . $_links . ($_page + 1) . $_linked . '">' . $_lang['page_next'] . '</a>';
    }
    else {
      $_link .= ' ' . $_lang['page_next'];
    }
    
    return $_link;
  }

  public function moveFile($_f_name = '404', $_dir = '') {

    if (!empty($_FILES[$_f_name]['tmp_name'])) {
      if (!move_uploaded_file($_FILES[$_f_name]['tmp_name'],
          $_dir . $_FILES[$_f_name]['name'])) {
        echo SiteLang::getRending('ERROR_12');
        $_file_src = NULL;
      }
      else {
        $_file_src = $_dir . $_FILES[$_f_name]['name'];
      }
    }

    return $_file_src;
  }

  private function getStringParameters($_parameters) {

    $_param_text = '';
    foreach ($_parameters as $key => $value) {
      if (isset($value)) {
        $_param_text .= $key . '=:' . $key . ',';
      }
    }

    $_param_text = substr($_param_text, 0, strlen($_param_text)-1);

    return $_param_text;
  }

  private function setParameters($_sth, $_parameters) {
    foreach ($_parameters as $key => $value) {
      if (isset($value)) {
        $_sth -> bindValue(':' . $key, $value);
      }
    }
    return TRUE;
  }

  public function __construct() {

    $_options = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    try {
      $this -> dataBase = new PDO(
        "mysql:
        host=" . HOST . ";
        dbname=" . DATABASE . ";
        charset=" . CHARSET, USER, PASSWORD, $_options
      );
    }
    catch(PDOException $e) {
      exit($e -> getMessage());
    }
  }

}

?>
