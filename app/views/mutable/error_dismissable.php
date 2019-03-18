          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong>Error!</strong><br />
            Please correct the following:
            <ul>
              <?php
              foreach($data as &$error) {
              ?>
              <li><?=$error;?></li>
              <?php
              }
              ?>
            </ul>
          </div>