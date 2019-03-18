      <div class="row">
        <div class="col-sm-3 min-size centered">
          <img src="<?=BASE_PATH;?>/pictures/<?=$data->picture;?>" alt="<?=$data->title . " " . $data->firstName . " " . $data->lastName;?>" class="contactPic">
        </div>
        
        <div class="col-sm-9 contactInfo">
          <div class="row">
            <div class="col-sm-3">Name:</div>
            <div class="col-sm-9"><?=$data->title . " " . $data->firstName . " " . $data->lastName;?></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Email:</div>
            <div class="col-sm-9"><a href="mailto:<?=$data->email;?>"><?=$data->email;?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Website:</div>
            <div class="col-sm-9"><a href="<?=$data->website;?>"><?=$data->website;?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Cell Phone:</div>
            <div class="col-sm-9"><?=$data->cellPhone;?></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Home Phone:</div>
            <div class="col-sm-9"><?=$data->homePhone;?></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Work Phone:</div>
            <div class="col-sm-9"><?=$data->workPhone?></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Twitter:</div>
            <div class="col-sm-9"><a href="http://www.twitter.com/<?=$data->twitter;?>"><?=$data->twitter;?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Facebook:</div>
            <div class="col-sm-9"><a href="http://www.facebook.com/<?=$data->facebook;?>"><?=$data->facebook;?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Instagram:</div>
            <div class="col-sm-9"><a href="http://www.instagram.com/<?=$data->instagram;?>"><?=$data->instagram;?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-3">Comments:</div>
            <div class="col-sm-9"><?=$data->comments;?></div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <a href="<?=BASE_PATH;?>/contacts/edit/<?=$data->id;?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              </a>
            
              <a href="<?=BASE_PATH;?>/contacts/delete/<?=$data->id;?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
      </div>


    <script src="<?=BASE_PATH;?>/js/jquery-min.js"></script>
    <script src="<?=BASE_PATH;?>/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
      
      $('a[title="Delete"]').click(function(event) {
        if (!confirm("Are you sure you'd like to delete this contact?"))
          event.preventDefault();
      });
    </script>
