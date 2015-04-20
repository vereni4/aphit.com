<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo SiteLang::getRending('TITLE') ?></title>
  <link href="styles/style.css" rel="stylesheet" type="text/css" />
  <script title="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
  <script title="text/javascript" src="/js/MainScript.js"></script>
</head>
<body>
  <div id="language">
    <p><?php echo SiteLang::getRending('LANG'); ?>: 
      <a href="?language=en">
        <img style="margin-right: 1px; width: 17px" src="./images/flag_en.jpg" alt="">English
      </a> | 
      <a href="?language=ua">
        <img style="margin-right: 1px; width: 17px" src="./images/flag_ua.jpg" alt="">Українська
      </a>
    </p>
  </div>
  <div id="reg-auth">
    <p>
      <?php if (empty($this -> currentUser)): ?>
        <a href="?option=Login"><?php echo SiteLang::getRending('LOGIN') ?></a>
        <a href="?option=Registration"><?php echo SiteLang::getRending('REGISTRATION') ?></a>
      <?php else: ?>
        <a href="?option=UserProfile&amp;user_id=<?php echo $this -> currentUserID ?>">
          <?php echo $this -> currentUser ?>
        </a>
        <a href="?option=UserExit&amp;Exit=1"><?php echo SiteLang::getRending('EXIT') ?></a>
      <?php endif; ?>
    </p>
  </div>
  <div id="border">
    <div id="header">
      <div id="left">
        <div id="logo">
          <div class="name"><?php echo SiteLang::getRending('TITLE') ?></div>
          <div class="tag"><p><?php echo SiteLang::getRending('LOGO') ?></p></div>
        </div>
      </div>
      <div id="car"></div>
    </div>

    <!-- LEFT BAR -->

    <div class="quick-bg">
      <div id="spacer">
        <div id="rc-bg"><?php echo SiteLang::getRending('MENU') ?></div>
      </div>
      <?php foreach ($_categories as $_category): ?>
        <div class="quick-links">» 
          <a href="?option=Category&amp;id_category=<?php echo $_category['id_category'] ?>">
            <?php echo $_category['name_category'] ?>
          </a>
        </div>
      <?php endforeach; ?>

      <?php if (!empty($this -> currentUser)): ?>
        <hr>
        <div class="quick-links">
          <a href="?option=ArticleEdit"><?php echo SiteLang::getRending('ARTICLE_INSERT') ?></a>
        </div>
      <?php endif; ?>
    </div>

    <!-- MENU -->

    <div id="mainarea">
      <div class="heading">
        <div class="toplinks" style="padding-left:30px;">
          <a href="?option=Main"><?php echo SiteLang::getRending('MAIN') ?></a>
        </div>

        <?php foreach ($_menu_items as $_row): ?>
          <div class="sap2">::</div>
          <div class="toplinks">
            <a href="?option=menu&amp;id_menu=<?php echo $_row['id_menu'] ?>">
              <?php echo $_row['name_menu'] ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

    <!-- MAIN CONTENT -->

    <div id="main">
      <?php include $_main_template . '.php'; ?>
    </div>

    <!-- FOOTER -->

    </div>
    <div id="bottom">
      <div class="toplinks" style="padding-left:127px;">
        <a href="?option=Main"><?php echo SiteLang::getRending('MAIN') ?></a>
      </div>
      <?php foreach ($_menu_items as $_row): ?>
        <div class="sap2">::</div>
        <div class="toplinks">
          <a href="?option=Menu&amp;id_menu=<?php echo $_row['id_menu'] ?>">
            <?php echo $_row['name_menu'] ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="copy">
      <span class="style1"><?php echo SiteLang::getRending('COPYRIGHT') ?></span>
    </div>
  </div>
</body>
</html>
