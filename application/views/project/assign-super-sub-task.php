

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Super Sub Task</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              <div class="card-header"  style="background-color:#023047; color: #fff">
                <h3 class="card-title">Assign Super Sub Task</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-project" action="<?= base_url('project/post_assign_super_sub_task/'.$assign_id.'/'.$sub_task_id.'/'.$project_id)?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Assign To</label>
                  <select class="form-control" name="project_manager">
                     <?php foreach($employees as $employee): ?>
                        <option value="<?= $employee['id']?>"><?= $employee['name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->





          </div>
           <div class="col-md-3"></div>
        

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</script>


