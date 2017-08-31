<?php
class myTest {
  var $status;
  
  function __construct() {
    $this->status = "working";
  }
  function getStatus() {
    return $this->status;
  }
  function setStatus($new_status = "initialized") {
    $this->status = $new_status;
    return $this->status;
  }
  public static function check() {
    return "checked";
  }
}