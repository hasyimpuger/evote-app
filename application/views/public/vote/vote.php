<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">Pilih Kandidat</div>
        <div class="panel-body" style="min-height: 500px">
          <div class="row" id="kandidat" style="margin: 0;padding-top: 20px">
          <?php foreach ($candidates as $candidate):?>
            <div class="col-md-4">
              <a href="<?php echo site_url('vote/' . $candidate->uuid) ?>" class="thumbnail" style="background-color: #c0392b">
                <p class="text-center" style="background: #c0392b; padding: 5px; margin:0"><?php echo $candidate->name ?></p>
                <img src="<?php echo base_url('uploads/images/' . $candidate->photo) ?>" alt="<?php echo $candidate->name ?>">
                <p class="text-center" style="background: #c0392b; padding: 5px; margin: 0">
                  <?php echo ($candidate->vision) ? $candidate->vision : '-'; ?>
                </p>
              </a>

            </div>
          <?php endforeach ?>
          </div>
        </div>
        <div class="panel-footer">
          <p class="pull-right">&copy; <?php echo date('Y') ?> <strong><a href="http://github.com/katonsa">Katonsa</a></strong>.</p>
          <p>Halaman ini di render dalam waktu {elapsed_time} detik.</p>
        </div>
      </div>
    </div>
  </div>
</div>
