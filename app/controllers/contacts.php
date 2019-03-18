<?php

class Contacts extends Controller {
  public function index() {
    $file = $this->model('File');
    $contact = $this->model('Contact');
    $contacts = $contact->all($file->readCSV());
    unset($file);
    unset($contact);
    
    $header = array(
      'title' => 'ezContacts - View All Contacts',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/warning_dismissable.php',
        'app/views/contacts/index.php',
        'app/views/footer.php'
      )
    );
    
    $page_header = array(
      'heading' => 'View Contacts',
      'subHeading' => 'View your added contacts.'
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $this->view('header', $header);
    $this->view('mutable/page_header', $page_header);
    if (count($contacts) == 0)
      $this->view('mutable/warning_dismissable', ['You have not added any contacts yet.']);
    $this->view('contacts/index', $contacts);
    $this->view('footer', $js);
    unset($contacts);
  }
  
  public function add() {
    $contact = $this->model('Contact');
    $file = $this->model('File');
    $errorHandler = $this->model('ErrorHandler');
    $contactPic = (!empty($_FILES) && (file_exists($_FILES['picture']['tmp_name']) || is_uploaded_file($_FILES['picture']['tmp_name']))) ? 
      $_FILES['picture'] : false;
    
    $header = array(
      'title' => 'ezContacts - Add a Contact',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/success_dismissable.php',
        'app/views/mutable/error_dismissable.php',
        'app/views/contacts/add.php',
        'app/views/footer.php'
      )
    );
    
    $page_header = array(
      'heading' => 'Add Contact',
      'subHeading' => 'Add a new contact'
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    
    $this->view('header', $header);
    $this->view('mutable/page_header', $page_header);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $contact->errorHandler($errorHandler);
      $contact->validate(array_values($_POST), $contactPic);
      
      if (!$contact->valid())
        $this->view('mutable/error_dismissable', $errorHandler->errors);
      else {
        $contact->id = $file->getID();
        $file->appendCSV(array_merge([$contact->id], $_POST));
        if ($contactPic)
          $contact->assignPicture($contactPic);
        $successString = 'You have successfully added the contact ' . $contact->title . ' ' . $contact->firstName . ' ' . $contact->lastName . '.';
        $this->view('mutable/success_dismissable', [$successString]);
      }
    }
    
    $this->view('contacts/add', $contact);
    $this->view('footer', $js);
    unset($errorHandler);
    unset($contact);
    unset($file);
  }
  
  public function edit($id = '') {
    $contact = $this->model('Contact');
    $file = $this->model('File');
    $contacts = $contact->all($file->readCSV());
    
    $errorHandler = $this->model('ErrorHandler');
    $contactPic = (!empty($_FILES) && (file_exists($_FILES['picture']['tmp_name']) || is_uploaded_file($_FILES['picture']['tmp_name']))) ? 
      $_FILES['picture'] : false;
    
    $header = array(
      'title' => 'ezContacts - Edit a Contact',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/success_dismissable.php',
        'app/views/mutable/error_dismissable.php',
        'app/views/contacts/edit.php',
        'app/views/footer.php'
      )
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $this->view('header', $header);
    
    if ($contact = $contact->searchID($contacts, $id)) {
      $page_header = array(
        'heading' => 'Edit Contact',
        'subHeading' => 'Editing ' . $contact->title . ' ' . $contact->firstName . ' ' . $contact->lastName
      );
      
      $this->view('mutable/page_header', $page_header);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contact->errorHandler($errorHandler);
        $contact->validate(array_values($_POST), $contactPic);

        if (!$contact->valid())
          $this->view('mutable/error_dismissable', $errorHandler->errors);
        else {
          $contact->id = $id;
          $file->writeCSV($contact->edit($contacts));
          if ($contactPic)
            $contact->assignPicture($contactPic);
          $successString = 'You have successfully modified the contact ' . $contact->firstName . '.';
          $this->view('mutable/success_dismissable', [$successString]);
        }
      }
      $this->view('contacts/edit', $contact);
    } else {
      $page_header = array(
        'heading' => 'Edit Contact',
        'subHeading' => 'Contact not found.'
      );
      
      $this->view('mutable/page_header', $page_header);
      $this->view('mutable/error_dismissable', ['Contact provided does not exist, please try again.']);
    }
    $this->view('footer', $js);
    unset($file);
    unset($contacts);
    unset($contact);
  }
  
  public function details($id = '') {
    $contact = $this->model('Contact');
    $file = $this->model('File');
    $contacts = $contact->all($file->readCSV());
    
    $contact->id = $id;
    $contact = $contact->searchID($contacts, $id);
    unset($contacts);
    unset($file);
    
    $header = array(
      'title' => 'ezContacts - Viewing a Contact',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/error_dismissable.php',
        'app/views/contacts/details.php',
        'app/views/footer.php'
      )
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $this->view('header', $header);
    if ($contact) {
      $this->view('mutable/page_header', ['heading' => 'Viewing Contact', 'subHeading' => 'Viewing ' . $contact->title . ' ' . $contact->firstName . ' ' . $contact->lastName]);
      $this->view('contacts/details', $contact);
    } else {
      $this->view('mutable/page_header', ['heading' => 'Viewing Contact', 'subHeading' => 'Contact not found.']);
      $this->view('mutable/error_dismissable', ['Contact provided does not exist, please try again.']);
    }
    $this->view('footer', $js);
    unset($contact);
  }
  
  public function delete($id = '') {
    $contact = $this->model('Contact');
    $file = $this->model('File');
    $contacts = $contact->all($file->readCSV());
    
    $contact = $contact->searchID($contacts, $id);
    if ($contact) {
      $contacts = $contact->delete($contacts);
      $file->writeCSV($contacts);
    }
    unset($file);
    
    $header = array(
      'title' => 'ezContacts - View All Contacts',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/success_dismissable.php',
        'app/views/mutable/error_dismissable.php',
        'app/views/contacts/index.php',
        'app/views/footer.php'
      )
    );
    $page_header = array(
      'heading' => 'View Contacts',
      'subHeading' => 'View your added contacts.'
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $this->view('header', $header);
    $this->view('mutable/page_header', $page_header);
    if ($contact)
      $this->view('mutable/success_dismissable', ['Successfully deleted contact ' . $contact->title . ' ' . $contact->firstName . ' ' . $contact->lastName]);
    else
      $this->view('mutable/error_dismissable', ['The contact you are trying to delete does not exist.']);
    $this->view('contacts/index', $contacts);
    $this->view('footer', $js);
    unset($contacts);
    unset($contact);
  }
  
  public function search($search = '') {
    $contact = $this->model('Contact');
    $file = $this->model('File');
    $contacts = $contact->all($file->readCSV());
    unset($file);
    
    if ($search != '')
      $contacts = $contact->search($contacts, $search);
    
    $header = array(
      'title' => 'ezContacts - View All Contacts',
      'pages' => array(
        'app/controllers/contacts.php',
        'app/models/Contact.php',
        'app/models/File.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/mutable/success_dismissable.php',
        'app/views/mutable/warning_dismissable.php',
        'app/views/contacts/index.php',
        'app/views/footer.php'
      )
    );
    $page_header = array(
      'heading' => 'View Contacts',
      'subHeading' => 'View your added contacts.'
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $this->view('header', $header);
    $this->view('mutable/page_header', $page_header);
    
    if (count($contacts) == 0)
      $this->view('mutable/warning_dismissable', ['Search returned 0 results.']);
    elseif ($search == '')
      $this->view('mutable/warning_dismissable', ['You entered an empty search query, showing all contacts.']);
    else
      $this->view('mutable/success_dismissable', ['Your search returned ' . count($contacts) . ' results.']);
    
    $this->view('contacts/index', $contacts);
    $this->view('footer', $js);
    unset($contacts);
    unset($contact);
  }
}