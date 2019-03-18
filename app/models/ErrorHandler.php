<?php

class ErrorHandler {
  public $errors = [];
  
  public function add($error) {
    $this->errors[] = $error;
  }
}