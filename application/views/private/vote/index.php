<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Votes</div>
                <div class="panel-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIS</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$votes):?>
                                            <tr>
                                                <td colspan="100%"><p class="text-center">No Record.</p></td>
                                            </tr>
                                            <?php
                                            else:
                                                foreach($votes as $vote): ?>
                                            <tr>
                                                <td><?php echo $vote->id ?></td>
                                                <td><?php echo $vote->user->nis ?></td>
                                                <td>voted +1 for <?php echo $vote->candidate->name ?></td>
                                            </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
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
