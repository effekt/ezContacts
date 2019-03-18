<!DOCTYPE html>
<html>
  <head>
    <title><?=$data['title'];?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?=BASE_PATH;?>/favicon.ico">
    <meta name="description" content="Personal contacts databse.">
    <meta name="author" content="Jesse Wheeler (101075970)">
    <meta name="keywords" content="COMP1230,PHP,CSS,JavaScript,CSS,GBC,George Brown">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_PATH;?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=BASE_PATH;?>/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-side pad">
      <ul class="nav nav-list">
        <li><a href="<?=BASE_PATH;?>">View Contacts</a></li>
        <li><a href="<?=BASE_PATH;?>/contacts/add">Add Contact</a></li>
        <li><hr></li>
        <li>
          <form action="<?=BASE_PATH;?>/contacts/search/" id="searchForm">
            <input type="text" name="search" placeholder="search" class="form-control" id="search">
            <button type="submit" class="btn btn-default" id="searchSubmit">Search</button>
          </form>
        </li>
        <li><hr></li>
        <li>
          <form method="post" action="<?=BASE_PATH;?>/source/vs">
          <?php foreach($data['pages'] as $page) { ?>
            <input type="hidden" value="<?=$page;?>" name="pages[]" />
          <?php } ?>
            <button type="submit" class="btn btn-link">View Source</button>
          </form>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row no-gutter">
        <div class="col-sm-12 col-lg-12 pad-all">