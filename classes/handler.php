<?php
//start the session
session_start();
require_once "HandlerClass.php";
require_once "../helpers.php";

$handler = new HandlerClass();
$validate = $handler->validate(Request::input('input_string'));

switch ($validate) {
  case EMPTY_INPUT :
    set_message('mess', 'Это поле бязательно для заполнения');
    set_message('status', 'error');
    break;

  case INVALID_SYMBOLS :
    set_message('mess', 'Ошибка ввода данных.');
    set_message('status', 'error');
    break;

  case VALID_SUCCESS :
    set_result($handler->getResult());
    set_is_valid(TRUE);
    break;
}

echo '<script type="text/javascript">location="/"</script>';
exit();



