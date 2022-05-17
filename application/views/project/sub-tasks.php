  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Tasks</h1>
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
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Sub Task</th>
                    <th>Assign To</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tasks as $task): ?>
                      <tr  style="background-color: #fff; color: #000">
                        <td><i class="fa fa-tasks"></i> <?= $task['sub_task_name']?></td>
                        <td><i class="fa fa-user"></i> <?= $task['assign_to_name']?></td>
                        <td><?= $task['created_by_name']?></td>
                        <td><a href="<?= base_url('project/super_sub_tasks/'.$task['sub_task'].'/'.$project_id)?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Super Subtask"><i class="fa fa-eye" ></i></a>  
                          <a href="<?= base_url('project/assign_sub_tasks/'.$task['id'].'/'.$task_id.'/'.$project_id)?>" class="btn btn-default" style="background-color:#3d405b; color: #fff" data-toggle="tooltip" title="Asign Sub task"><i class="fas fa-tasks"></i></a></td>
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


