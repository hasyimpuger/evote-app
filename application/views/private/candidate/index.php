<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Candidates</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Alert!</strong> All features are not implemented!
                        </div>
                            <?php if(isset($message)): ?>
                                <div class="alert alert-<?php echo $message->type?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $message->title?></strong> <?php echo $message->body?>
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 button-function-area">
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createCandidateModal" role="button">Create new candidate</a>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="right-function-area">
                                <form action="<?php echo site_url('private/candidate')?>" method="GET" accept-charset="utf-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Search by name..." value="<?php echo (isset($query)) ? $query : '' ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                        </span>                                    
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="CheckAllCandidate" name="CheckAllCandidate"></th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$candidates):?>
                                            <tr>
                                                <td colspan="100%"><p class="text-center">No Record.</p></td>
                                            </tr>
                                            <?php
                                            else:
                                                foreach($candidates as $candidate): ?>
                                            <tr>
                                                <td><input type="checkbox" name="candidate[]" value="<?php echo $candidate->id ?>"></td>
                                                <td><?php echo $candidate->name ?></td>
                                                <td><img src="<?php echo base_url('uploads/images/'. $candidate->photo) ?>" alt="<?php echo $candidate->name ?>"></td>
                                                    <td><div class="btn-group">
                                                        <a class="btn btn-sm btn-primary" href="<?php echo site_url('private/candidate/edit/'. $candidate->id) ?>" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                        <a class="btn btn-sm btn-danger" href="<?php echo site_url('private/candidate/delete/'. $candidate->id) ?>" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                    </div></td>
                                                </tr>
                                            <?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                        Bulk Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onClick="deleteBulkUser();">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <?php echo $this->pagination->create_links(); ?>
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
    <div class="modal fade" id="createCandidateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create new Candidate</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('private/candidate/create', 'id="createCandidateForm"');?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="vission">Vission</label>
                        <input type="text" class="form-control" id="vission" name="vission">
                    </div>
                    <div class="form-group">
                        <label for="mission">Mission</label>
                        <input type="text" class="form-control" id="mission" name="mission">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo">
                    </div>
                    <?php echo form_close() ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="createCandidateForm">Create</button>
                </div>
            </div>
        </div>
    </div>