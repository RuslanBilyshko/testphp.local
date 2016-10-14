<?php
//start the session
session_start();


require_once "helpers.php";


?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8"/>
  <title>Тестовое задание</title>
  <script type="text/javascript"
          src="http://code.jquery.com/jquery-latest.min.js">
  </script>

  <link rel="stylesheet" href="css/style.css">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>
<div id="wrapper">
  <header>
    <H1>Тестовое задание</H1>
  </header>
  <section id="content">
    <article>
      <? // var_dump($_SESSION) ?>

      <?php
      //Ну тут просто, чтобы не городить шаблонизатор
      //На валидацию можно также навешать еще и js
      if (!get_is_valid()):
        ?>
        <form action="classes/handler.php" method="post">
          <label for="input_string">Входная строка</label>
          <input class="<?php echo get_message('status'); ?>" maxlength="10"
                 id="input_string" name="input_string" type="text"
                 placeholder="Год/Месяц/Число"
                 value="<?php echo get_old_value('input_string') ?>">

          <div
            class="<?php echo get_message('status'); ?>"><?php print get_message('mess'); ?></div>
          <p>Введите в следующем формате <b>Год/Месяц/Число</b> в диапазоне от
            2000-2999 года.<br> Год, может бытть сокращен до двух цифр, а также
            можно опустить ведущий <b>'0</b>, например
            <e>2001 -> 01</e>
            или
            <e>2001 -> 1</e>
            ,
          </p>
          <input type="submit" id="submit" name="submit" value="Форматировать">
        </form>
      <?php else: ?>
        <?php if (count(result_messages()) > 0): ?>
          <ul class="result_messages">
            <?php foreach (result_messages() as $message): ?>
              <li><?php echo $message ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <p class="result">
          <b>Входная
            строка:</b>&nbsp;<?php echo get_old_value('input_string') ?> <br>
          <b>Результат:</b>&nbsp;<?php echo get_result() ?> <br>
          <a href="/">Попробовать сново!</a>
        </p>
      <?php endif; ?>
    </article>
  </section>
</div>
</body>
</html>
<?php session_destroy() ?>





