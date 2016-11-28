    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #95a5a6">
                        <h3 class="panel-title"><strong>1337 Login</strong></h3>
                    </div>
                    <div class="panel-body" style="color: #ecf0f1;background-color: #34495e;min-height: 500px">
                        <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        <?php if(validation_errors() || $this->session->flashdata('message')): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Ops!</strong> <?php echo (validation_errors()) ? validation_errors() : $this->session->flashdata('message'); ?>
                        </div>
                        <?php endif ?>
                            <form action="" method="POST" role="form">
                                <legend style="color:#ecf0f1">Backd00r login</legend>
                                <div class="form-group">
                                <code>SELECT * FROM r00t WHERE u5eRn4m3 =</code>
                                    <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
                                </div>
                                <div class="form-group">
                                <code>AND p4ssw0rd =</code>
                                    <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-primary center-block">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
        <div class="panel-footer" style="background-color: #95a5a6">
          <p class="pull-right">&copy; <?php echo date('Y') ?> <strong><a href="http://github.com/katonsa">Katonsa</a></strong>.</p>
          <p>Halaman ini di render dalam waktu {elapsed_time} detik.</p>
        </div>
                </div>
            </div>
        </div>
    </div>