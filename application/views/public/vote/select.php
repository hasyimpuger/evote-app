<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">Pilih Kandidat</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">Anda memilih:</p>
              <h3 class="text-center"><?php echo $candidate->name?></h3>
              <img src="<?php echo base_url('uploads/images/' . $candidate->photo) ?>" class="img-responsive thumbnail center-block" alt="<?php echo $candidate->name ?>">
<!--               <a class="btn btn-default center-block" href="#" role="button">Visi & Misi</a>
 -->              <form id="formSelect" action="" method="POST" role="form">
              <input type="hidden" name="uuid" id="inputUuid" class="form-control" value="<?php echo $candidate->uuid ?>">
                <div class="form-group">
                  <label for="inputSaran"></label>
                  <textarea name="saran" id="inputSaran" class="form-control" rows="3" placeholder="Silahkan berikan saran dan masukan Anda kepada kandidat Osis apabila terpilih ( Opsional )"></textarea>
                </div>
                <button id="pilihButton" type="submit" class="btn btn-success btn-block btn-lg ">Pilih</button>
              </form>
            </div>
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
