<?php

class Source extends Controller {
  public function vs() {
    $header = array(
      'title' => 'ezContacts - Viewing Source',
      'pages' => array(
        'app/controllers/source.php',
        'app/views/header.php',
        'app/views/mutable/page_header.php',
        'app/views/source/vs.php',
        'app/views/footer.php'
      )
    );
    
    $page_header = array(
      'heading' => 'View Source',
      'subHeading' => 'Viewing source of project.'
    );
    
    $js = ['js/jquery-min.js', 'js/bootstrap.min.js', 'js/functions.js'];
    
    $pages = array(
      'index.php',
      'app/init.php',
      'app/core/App.php',
      'app/core/Controller.php',
    );
    
    array_merge($pages, $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['pages'] : []);
    
    $this->view('header', $header);
    $this->view('mutable/page_header', $page_header);
    $this->view('source/vs', $pages);
    $this->view('footer', $js);
  }
}