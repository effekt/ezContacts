      <ol>
      <?php foreach($data as $page) { ?>
        <li><a href="#<?=$page;?>"><?=$page;?></a></li>
      <?php } ?>
      </ol>

    <?php foreach($data as $page) { ?>
      <div class="row src">
        <div class="md-col-12">
          <h2 id="<?=$page;?>"><?=$page;?></h2>
          <?php show_source('/home/f7075970/public_html/' . BASE_PATH . '/' . $page); ?>
        </div>
      </div>
    <?php } ?>