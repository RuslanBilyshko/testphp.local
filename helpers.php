<?php


if (!function_exists('set_message')) {

  function set_message($key, $value) {
    $_SESSION[$key] = $value;
  }
}

if (!function_exists('get_message')) {

  function get_message($key) {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }
    else {
      return '';
    }

  }
}

if (!function_exists('set_old_value')) {

  function set_old_value($key, $value) {
    $_SESSION[$key] = $value;
  }
}

if (!function_exists('get_old_value')) {

  function get_old_value($key) {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }
    else {
      return '';
    }
  }
}

if (!function_exists('set_is_valid')) {

  function set_is_valid($flag = FALSE) {
    $_SESSION['is_valid'] = $flag;
  }
}

if (!function_exists('get_is_valid')) {

  function get_is_valid() {
    return $_SESSION['is_valid'];
  }
}

if (!function_exists('set_result')) {

  function set_result($value) {
    $_SESSION['result'] = $value;
  }
}

if (!function_exists('get_result')) {

  function get_result() {
    if (isset($_SESSION['result'])) {
      return $_SESSION['result'];
    }
    else {
      return '';
    }
  }
}


if (!function_exists('result_messages')) {

  function result_messages($value = NULL) {
    if ($value != NULL) {
      $_SESSION['result_messages'][] = $value;
      //return TRUE;
    }
    else {
      return $_SESSION['result_messages'];
    }

  }
}