<?php


class HandlerClass {

  private $_input = [];
  private $_pattern = '/^(2[0-9]{3}|[0-9]{1,2})\/[0-9]{1,2}\/[0-9]{1,2}$/';

  public function validate($string) {
    if (empty($string)) {
      return EMPTY_INPUT;
    }
    elseif (!$this->isInputValidate($string)) {
      return INVALID_SYMBOLS;
    }
    else {
      $this->_input = explode('/', $string);
      return VALID_SUCCESS;
    }
  }

  private function isInputValidate($string) {
    return preg_match($this->_pattern, $string);
  }

  public function getResult() {
    $year = $this->transform($this->_input[0], 'year');
    $month = $this->transform($this->_input[1]);
    $day = $this->transform($this->_input[2]);

    return $this->render($year, $month, $day);
  }

  private function transform($data, $type = 'day') {
    $result = '';
    if ($type == 'year') {
      if (strlen($data) == 1) {
        $result = "200" . $data;
      }
      elseif (strlen($data) == 2) {
        $result = "20" . $data;
      }
      else {
        $result = $data + 0;
      }
    }
    elseif ($type == 'day' || $type == 'month') {
      if (strlen($data) == 2 && $data[0] == '0') {
        $result = $data[1];
      }
      elseif ($data == '0') {
        $result = 1;
      }
      else {
        $result = $data + 0;
      }
    }
    return $result;

  }

  private function render($year, $month, $day) {
    $render = '';

    if (!checkdate($month, $day, $year)) {
      if (!$this->checkMonth($month)) {
        $month = '<span class="error">' . $this->format($month) . '</span>';
      }
      elseif (!$this->checkDay($year, $month, $day)) {
        $day = '<span class="error">' . $this->format($day) . '</span>';
      }


      $month = $this->format($month);
      $day = $this->format($day);

      $render = $year . '-' . $month . '-' . $day . ' - <span class="error">Дата не корректна</span>';
    }
    else {
      $render = '<span class="success">' . $year . '-' . $this->format($month) . '-' . $this->format($day) . ' - Дата корректна</span>';
    }

    return $render;
  }

  private function checkMonth($month) {
    if ($month > 12) {
      result_messages('В году только 12 месяцев');
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  private function format($data) {
    return strlen($data) == 1 ? '0' . $data : $data;
  }

  private function checkDay($year, $month, $day) {
    $result = TRUE;
    $count_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    if ($day > $count_days) {
      result_messages('В ' . $month . ' месяце ' . $year . ' года только ' . $count_days . ' дней');
      $result = FALSE;
    }

    return $result;
  }

  private function isLeapYear($year) {
    if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}

class Request {

  public static function input($field_name) {
    if (isset($_POST[$field_name])) {
      set_old_value($field_name, $_POST[$field_name]);
      return $_POST[$field_name];
    }
  }

}