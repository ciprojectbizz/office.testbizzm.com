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
            
          <div class="col-md-12">

            <div class="card" style="border-radius: 15px">
              <div class="card-header">
                <?php /*<a href="<?= base_url('task/add_sub_task/'.$taskId)?>"><button class="btn btn-primary" data-toggle="tooltip" title="Add Sub Task"><i class="fa fa-plus"></i></button></a>*/ ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Sub Task Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($subtasks as $subtaskRow): ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><?= $subtaskRow['name']?></td>
                        <td><!--<a href="<?= base_url('task/superSubTasks/'.$subtaskRow['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Super Sub Task"><i class="fa fa-eye"></i></a> <a href="<?= base_url('task/subTaskEdit/'.$subtask['id'].'/'.$taskId)?>" class="btn btn-default" style="background-color:#3d405b; color: #fff" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>-->
											</td>
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


