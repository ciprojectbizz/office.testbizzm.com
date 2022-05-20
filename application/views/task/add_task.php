
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Task</li>
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
         
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-task" action="<?= base_url('task/post_add_task')?>" method="POST">
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Task</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="task" placeholder="Enter task Name">
                    <div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
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
        $(function ()
        {
         
            $('.popup_error').hide();
            $('form#add-task').submit(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o)
                {

                  if (o.result == 1)
                    {   
                       
                        window.location.assign('<?= base_url();?>task/view_task');
                       
                    }
                  else if (o.result == 0)
                    { 
                   
                       $('.popup_error').show().html('This field is required').delay(10000).fadeOut('slow');
                    } 
                  else
                  {
                    $('.popup_error').show().html('Internal Server Error').delay(3000).fadeOut('slow');
                  }  

                }, 'json');
            });
         

        });
    </script>
