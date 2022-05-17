  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Super Sub Tasks</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card" style="border-radius: 15px">
              <div class="card-header">
                <a href="<?= base_url('task/add_super_sub_task/'.$subTaskId)?>"><button class="btn btn-primary" data-toggle="tooltip" title="Add Super Subtask"><i class="fa fa-plus"></i></button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Super Sub Task Name</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($superSubtasks as $superSubtask): ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><?= $superSubtask['name']?></td>
                        <td><?= $superSubtask['employee_name']?></td>
                        <td><a href="<?= base_url('task/superSubTaskEdit/'.$superSubtask['id'].'/'.$subTaskId)?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a></td>
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


