  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees</h1>
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
                <a href="<?= base_url('employee/add_employee')?>" data-toggle="tooltip" title="Add Employees"><button class="btn btn-primary"><i class="fa fa-plus"></i></button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Created By</th>
                    <th>Reporting Manager</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($employees as $employee): ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><i class="fa fa-user"></i> <?= $employee['name']?></td>
                        <td><i class="fa fa-envelope"></i> <?= $employee['email']?></td>
                        <td><i class="fa fa-users"></i> <?= $employee['username']?></td>
                        <td><i class="fa fa-id-card"></i> <?= $employee['created_by_name']?></td>
                        <td><?= $employee['reporting_manager_name']?></td>
                          <td><a href="<?= base_url('employee/editEmployee/'.$employee['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Edit" style="background-color: #264653; color:#fff"><i class="fa fa-edit"></i></a> <a href="<?= base_url('employee/deleteEmployee/'.$employee['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Delete" style="background-color:#3d405b; color: #fff"><i class="fa fa-trash"></i></a></td>
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


