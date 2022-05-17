  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Groups</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card" style="border-radius: 15px">
              <div class="card-header">
                <a href="<?= base_url('group/add_group')?>"><button class="btn btn-primary" data-toggle="tooltip" title="Add Group"><i class="fa fa-plus"></i></button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Group Name</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($groups as $group): ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><i class="fa fa-building"></i> <?= $group['name']?></td>
                        <td><i class="fa fa-user"></i> <?= $group['employee_name']?></td>
                        <td><a href="<?= base_url('group/editGroup/'.$group['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Edit" style="background-color: #264653; color:#fff"><i class="fa fa-edit"></i></a> <a href="<?= base_url('group/deleteGroup/'.$group['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Delete" style="background-color:#3d405b; color: #fff"><i class="fa fa-trash"></i></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


