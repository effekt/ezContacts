<?php

class Contact {
  public $id;
  public $title;
  public $firstName;
  public $lastName;
  public $email;
  public $website;
  public $cellPhone;
  public $homePhone;
  public $workPhone;
  public $twitter;
  public $facebook;
  public $instagram;
  public $comments;
  public $picture;
  
  private $errorHandler;
  
  public function __construct($contact = []) {
    if (!empty($contact)) {
      $this->id = $contact[0];
      $this->title = $contact[1];
      $this->firstName = $contact[2];
      $this->lastName = $contact[3];
      $this->email = $contact[4];
      $this->website = $contact[5];
      $this->cellPhone = $contact[6];
      $this->homePhone = $contact[7];
      $this->workPhone = $contact[8];
      $this->twitter = $contact[9];
      $this->facebook = $contact[10];
      $this->instagram = $contact[11];
      $this->comments = $contact[12];
      
      if(file_exists($_SERVER['DOCUMENT_ROOT'] . BASE_PATH . CONTACT_PIC_DIR . '/' . $this->id . '.jpg'))
        $this->picture = $this->id . '.jpg';
      else
        $this->picture = 'default.png';
    }
  }
  
  public function validate($contact, $picture = false) {
    $regex = ['lettersAndWS' => '/^[a-zA-Z ]*$/',
              'website' => '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
              'phone' => '/^\+\d(\d{3})(\d{3})(\d{4})$/'];
    $contact = array_map('trim', $contact);
    $this->__construct(array_merge([0], $contact));
    
    $lettersAndWSOnly = ['First Name' => $this->firstName,
                         'Last Name' => $this->lastName];
    
    $phoneNumbers = ['Home Phone' => $this->homePhone,
                     'Cell Phone' => $this->cellPhone,
                     'Work Phone' => $this->workPhone];
    
    foreach($lettersAndWSOnly as $key => $val) {
      if (!preg_match($regex['lettersAndWS'], $val)) {
        $this->errorHandler->add($key . ': Must only contain letters and spaces.');
      }
    }
    
    foreach($phoneNumbers as $key => $val) {
      if (!preg_match($regex['phone'], $val) && !empty($this->$val)) {
        $this->errorHandler->add($key . ': Invalid phone number provided.');
      }
    }
    
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) && !empty($this->email))
      $this->errorHandler->add('Email: Invalid email provided.');
    
    if (!preg_match($regex['website'], $this->website) && !empty($this->website))
      $this->errorHandler->add('Website: Invalid URL provided.');
    
    if ($picture) {
      $img = $picture['tmp_name'];
      $picInfo = getimagesize($img);
      if ($picInfo === false)
        $this->errorHandler->add('Picture: Uploaded file not an image. Supported: PNG/GIF/JPG');
      else {
        switch ($picInfo[2]) {
          case IMAGETYPE_GIF:
            break;
          case IMAGETYPE_JPEG:
            break;
          case IMAGETYPE_PNG:
            break;
          default:
            $this->errorHandler->add('Picture: Uploaded filetype not supported. Supported: PNG/GIF/JPG');
        }
      }
    }
  }
  
  public function assignPicture($picture) {
    $img = $picture['tmp_name'];
    $picInfo = getimagesize($img);
    switch ($picInfo[2]) {
      case IMAGETYPE_GIF:
        $src = imagecreatefromgif($img);
        break;
      case IMAGETYPE_JPEG:
        $src = imagecreatefromjpeg($img);
        break;
      case IMAGETYPE_PNG:
        $src = imagecreatefrompng($img);
        break;
    }
    
    list($width, $height) = getimagesize($picture['tmp_name']);
    $ratio = $width / $height;
    if ($width > $height) {
      $newheight = $ratio * 200;
      $newwidth = 200;
    } else {
      $newwidth = $ratio * 200;
      $newheight = 200;
    }
    
    $tmp = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . BASE_PATH . CONTACT_PIC_DIR . '/' . $this->id . '.jpg'))
      unlink($_SERVER['DOCUMENT_ROOT'] . BASE_PATH . CONTACT_PIC_DIR . '/' . $this->id . '.jpg');
    imagejpeg($tmp, $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . CONTACT_PIC_DIR . '/' . $this->id . '.jpg');
  }
  
  public function errorHandler(ErrorHandler $handle) {
    $this->errorHandler = $handle;
  }
  
  public function valid() {
    $valid = true;
    if ($this->errorHandler && count($this->errorHandler->errors) !== 0)
      $valid = false;
    return $valid;
  }
  
  public function searchID($contacts, $id) {
    foreach($contacts as $contact) {
      if ($contact->id === $id) {
        return $contact;
      }
    }
    return false;
  }
  
  public function all($fContents) {
    $contacts = [];
    
    foreach($fContents as $contact) {
      $contacts[] = new Contact($contact);
    }
    return $contacts;
  }
  
  public function edit($contacts) {
    foreach ($contacts as $contact) {
      if ($contact->id == $this->id) {
        $contact = $this;
      }
    }
    return $contacts;
  }
  
  public function delete($contacts) {
    $newContacts = [];
    foreach ($contacts as $contact) {
      if ($contact->id != $this->id)
        $newContacts[] = $contact;
    }
    return $newContacts;
  }
  
  public function search($contacts, $search) {
    $newContacts = [];
    $search = trim($search);
    
    foreach ($contacts as $contact) {
      foreach ($contact as $key => $val) {
        if (strpos(strtolower($val), strtolower($search)) !== false && $key != 'picture') {
          $newContacts[] = $contact;
          break;
        }
      }
    }
    return $newContacts;
  }
}