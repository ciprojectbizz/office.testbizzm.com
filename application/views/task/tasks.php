  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tasks</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-default" style="border-radius: 15px">
              <div class="card-header">
                <a href="<?= base_url('task/add_task')?>"><button class="btn btn-primary" data-toggle="tooltip" title="Add Task"><i class="fa fa-plus"></i></button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-default">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Task Name</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tasks as $task):?>
                      <tr style="background-color: #fff; color: #000">
                        <td><i class="fa fa-laptop-code"></i> <?= $task['name']?></td>
                        <td><i class="fa fa-user"></i> <?= $task['employee_name']?></td>
                        <td><a href="<?= base_url('task/subTasks/'.$task['id'])?>" class="btn btn-default" style="background-color: #264653;  color:#fff;" data-toggle="tooltip" title="Edit"><i class="fa fa-eye"></i></a> <a href="<?= base_url('task/editTask/'.$task['id'])?>" class="btn btn-default" style="background-color:#3d405b; color: #fff;" data-toggle="tooltip" title="Edit Task"><i class="fa fa-edit"></i></a></td>
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


