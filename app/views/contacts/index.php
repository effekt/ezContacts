      <div class="row" id="contacts">
          <?php
          foreach ($data as &$contact) {
            ?>
          <div class="col-lg-3 col-md-4 col-sm-6 min-size centered">
            <div class="rounded-border">
              
              <img src="<?=BASE_PATH;?>/pictures/<?=$contact->picture;?>" class="contactPic" alt="<?=$contact->title . ' ' . $contact->firstName . ' ' . $contact->lastName; ?>">
              
              <hr>
              <?=$contact->title . " " . $contact->firstName . " " . $contact->lastName;?>
              <br />
              <?=$contact->email != "" ? '<a href="mailto:' . $contact->email . '">' . $contact->email . '</a>' : '<br>';
            ?>
              <div class="btnContainer">
                <a href="<?=BASE_PATH;?>/contacts/details/<?=$contact->id;?>" class="btn btn-sm btn-info contactBtn" data-toggle="tooltip" title="View">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </a>
                <a href="<?=BASE_PATH;?>/contacts/edit/<?=$contact->id;?>" class="btn btn-sm btn-warning contactBtn" data-toggle="tooltip" title="Edit">
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
                <a href="<?=BASE_PATH;?>/contacts/delete/<?=$contact->id;?>" class="btn btn-sm btn-danger contactBtn" data-toggle="tooltip" title="Delete">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <?php
            }
          ?>
    </div>