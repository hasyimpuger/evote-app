<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
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
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#CreateUserModal" role="button">Create new user</a>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#importExcelModal" role="button">Import from Excel</a>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="right-function-area">
                                <form action="<?php echo site_url('private/user')?>" method="GET" accept-charset="utf-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="username" placeholder="Search by username..." value="<?php echo (isset($query)) ? $query : '' ?>">
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
                                            <th><input type="checkbox" id="checkAllUser" name="checkAllUser"></th>
                                            <th>NIS</th>
                                            <th>Name</th>
                                            <th>Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$users):?>
                                            <tr>
                                                <td colspan="100%"><p class="text-center">No Record.</p></td>
                                            </tr>
                                            <?php
                                            else:
                                                foreach($users as $user): ?>
                                            <tr>
                                                <td><input type="checkbox" name="user[]" value="<?php echo $user->id?>"></td>
                                                <td><?php echo $user->nis ?></td>
                                                <td><?php echo $user->nama?></td>
                                                <td><?php echo $user->email ?></td>
                                                <td><div class="btn-group">
                                                    <a class="btn btn-sm btn-primary" href="<?php echo site_url('private/user/edit/'. $user->id) ?>" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                    <a class="btn btn-sm btn-danger" href="<?php echo site_url('private/user/delete/'. $user->id) ?>" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

<div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="importExcelModalLabel">Import from Excel</h4>
    </div>
    <div class="modal-body">
        <form id="importExcel" action="<?php echo site_url('private/user/upload_excel') ?>" method="POST" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Select excel file</label>
                <input type="file" name="file">
            </div>
            <p>Pastikan upload file excel sesuai format, contoh format bisa download <a href="<?php echo site_url('private/user/format_excel') ?>">di sini</a></p>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitImportExcel" form="importExcel">Upload</button>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="CreateUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="CreateUserModalLabel">Create new user</h4>
    </div>
    <div class="modal-body">
        <form id="createUser" action="<?php echo site_url('private/user/create') ?>" method="POST" role="form">
            <div class="alert alert-danger" id="error_container" style="display: none;">
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="1">Admin</option>
                    <option value="2">Siswa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>
            </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitCreateUser" form="createUser">Create</button>
    </div>
</div>
</div>
</div>