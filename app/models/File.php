<?php

class File {
  protected $fName;
  
  public function __construct($file = 'assets/contacts.csv') {
    $this->fName = $file;
  }
  
  public function readCSV() {
    if (file_exists($this->fName)) {
      $handle = fopen($this->fName, "r");
      while (($fContents[] = fgetcsv($handle)) !== FALSE);
      $handle = fclose($handle);
      
      if (empty(end($fContents)))
        array_pop($fContents);
      
      return $fContents;
    }
  }
  
  public function writeCSV($data) {
    if (file_exists($this->fName)) {
      $handle = fopen($this->fName, "w");
      foreach($data as $contact) {
        fputcsv($handle, json_decode(json_encode($contact), true));
      }
      fclose($handle);
    }
  }
  
  public function appendCSV($data) {
    if (file_exists($this->fName)) {
      $handle = fopen($this->fName, "a");
      fputcsv($handle, $data);
      fclose($handle);
    }
  }
  
  function getID() {
    $file_name = 'assets/ids';
    if (!file_exists($file_name)) {
      touch($file_name);
      $handle = fopen($file_name, 'r+');
      $id = 0;
      fwrite($handle, 0);
    } else {
      $handle = fopen($file_name, 'r+');
      $id = fread($handle, filesize($file_name));
      settype($id, "integer");
    }
    rewind($handle);
    fwrite($handle, ++$id);
    fclose($handle);
    return $id;
  }
}