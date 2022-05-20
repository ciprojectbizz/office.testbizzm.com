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

            <div class="card" style="border-radius: 15px">
              <div class="card-header">
							<a href="<?=base_url('task/subTasks')?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" title="Add Project">Add Task</button></a>
							<!--<a href="<?=base_url('task/subTasks')?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" title="Add Project">Add Task Types</button></a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Task</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tasks as $task): ?>
                      <tr  style="background-color: #fff; color: #000">
                        <td><i class="fa fa-tasks"></i> <?= $task['name']?></td>
                        <td><!--<a href="<?= base_url('project/sub_tasks/'.$task['id'].'/'.$project_id)?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Sub Task"><i class="fa fa-eye"></i></a>  <a href="<?= base_url('project/assign_tasks/'.$task['id'].'/'.$project_id)?>" class="btn btn-default" style="background-color:#3d405b; color: #fff" data-toggle="tooltip" title="Asign Task"><i class="fas fa-tasks"></i> </i></a>--></td>
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


