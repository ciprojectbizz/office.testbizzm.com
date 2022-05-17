
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Sub Task</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="row">
          <!-- left column -->
         
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-task" action="<?= base_url('task/post_add_sub_task')?>" method="POST">
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Sub Task</label>
                    <div class="table-responsive">  
                        <table class="table table-bordered" id="dynamic_field">  
                            <tr>  
                                <td style="border:none;"><input type="text" name="subtask[]" placeholder="Enter Sub Task Name" class="form-control name_list" required="" /></td>  
                                <td style="border:none;"><button type="button" name="add" id="add" class="btn btn-default" style="background-color: #264653; color:#fff">Add More</button></td>  
                            </tr>  
                        </table>  
                        <input type="hidden" name="task" value="<?= $taskId?>">
                    </div>
                  </div>
                </div>
                </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  
   
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td style="border:none;"><input type="text" name="subtask[]" placeholder="Enter Sub Task Name" class="form-control name_list" required /></td><td style="border:none"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Delete</button></td></tr>');  
      });
  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
  
    });  
</script>
