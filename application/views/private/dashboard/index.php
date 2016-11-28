<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <form action="" method="POST" role="form">
                            <legend>Vote Setting</legend>
                            <div class="form-group">
                                <label for="inputKelas">Kelas:</label>
                                <?php echo form_dropdown('kelas', $kelas, $temp->class_id, 'id="inputKelas" class="form-control"'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="panel-footer">
                    <p class="pull-right">&copy; 2016 <a href="mailto:katonsa@icloud.com?subject=OSIS 2016 Election" title="mail me">Katon SA</a>.</p>
                    <p>Halaman ini di render dalam waktu {elapsed_time} detik.</p>
                </div>
            </div>
        </div>
    </div>
</div>
