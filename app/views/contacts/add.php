          <form method="post" enctype="multipart/form-data" action="<?=BASE_PATH;?>/contacts/add">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <h1><small><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Personal Information:</small></h1>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmTitle">Title</label>
                  <select name="title" id="frmTitle" class="form-control">
                    <option value="Mr."<?=$data->title == 'Mr.' ? ' selected' : '';?>>Mr.</option>
                    <option value="Mrs."<?=$data->title == 'Mrs.' ? ' selected' : '';?>>Mrs.</option>
                    <option value="Ms."<?=$data->title == 'Ms.' ? ' selected' : '';?>>Ms.</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmFirst">First Name</label>
                  <input type="text" name="first" id="frmFirst" class="form-control" placeholder="First Name" required value='<?=$data->firstName;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmLast">Last Name</label>
                  <input type="text" name="last" id="frmLast" class="form-control" placeholder="Last Name" required value='<?=$data->lastName;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmEmail">Email Address</label>
                  <input type="email" name="email" id="frmEmail" class="form-control" placeholder="Email" value='<?=$data->email;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmSite">Website</label>
                  <input type="url" name="site" id="frmSite" class="form-control" placeholder="www.example.com" value='<?=$data->website;?>'>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <h1><small><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Phone Numbers:</small></h1>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmCell">Cell Number</label>
                  <input type="tel" name="cell" id="frmCell" class="form-control" placeholder="(555) 555-5555" value='<?=$data->cellPhone;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmHome">Home Number</label>
                  <input type="tel" name="home" id="frmHome" class="form-control" placeholder="(555) 555-5555" value='<?=$data->homePhone;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmWork">Work Number</label>
                  <input type="tel" name="work" id="frmWork" class="form-control" placeholder="(555) 555-5555" value='<?=$data->workPhone?>'>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <h1><small><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Social Networks:</small></h1>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmTwitter">Twitter</label>
                  <input type="text" name="twitter" id="frmTwitter" class="form-control" placeholder="twitter.id" value='<?=$data->twitter;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmFacebook">Facebook</label>
                  <input type="text" name="facebook" id="frmFacebook" class="form-control" placeholder="facebook_url" value='<?=$data->facebook;?>'>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmInstagram">Instagram</label>
                  <input type="text" name="instagram" id="frmInstagram" class="form-control" placeholder="instagram.id" value='<?=$data->instagram;?>'>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <h1><small><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Other:</small></h1>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="frmPicture">Picture</label>
                  <input type="file" name="picture" id="frmPicture" class="form-control">
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="frmComments">Comments</label>
                  <textarea class="form-control" name="comments" id="frmComments" rows="3"><?=$data->comments;?></textarea>
                </div>
              </div>
            </div>
            
            <hr>
            
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Add Contact!</button>
                </div>
              </div>
            </div>
          </form>
<script src="<?=BASE_PATH;?>/js/jquery-min.js"></script>
<script src="<?=BASE_PATH;?>/js/bootstrap.min.js"></script>