    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Home</strong></h3>
                    </div>
                    <div class="panel-body" style="min-height: 500px">
                        <div class="row">
                        <div class="col-md-6 col-md-offset-3" style="padding-top: 100px">
                        <?php if(validation_errors() || $this->session->flashdata('message')): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Ops!</strong> <?php echo (validation_errors()) ? validation_errors() : $this->session->flashdata('message'); ?>
                        </div>
                        <?php endif ?>
                            <form action="" method="POST" role="form">
                                <div class="form-group">
                                    <h3 class="text-center">Masukan NIS Anda:</h3>
                                    <input type="text"  id="inputNIS" class="form-control input-lg" placeholder="XXXX.XX" name="nis" autocomplete="off">
                                </div>
                                <p class="text-center">Kelas: <?php echo $nama_kelas->class_name?></p>
                                <button id="loginSubmit" type="submit" class="btn btn-primary btn-lg center-block">Submit</button>
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