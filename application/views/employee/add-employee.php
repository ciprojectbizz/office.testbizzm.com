  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Employee</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
              <div class="col-md-2"></div>
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              <div class="card-header" style="background-color:#023047; color: #fff">
                <h3 class="card-title" >Enter Employee Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-employee" action="<?= base_url('employee/post_add_employee')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Reporting Manager</label>
                  <select class="form-control" name="reporting_manager">
                     <?php foreach($employees as $employee): ?>
                        <option value="<?= $employee['id']?>"><?= $employee['name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>
                  <div class="row">
                      <div class="col-md-6"> <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="" name="name" placeholder="Enter Name">
                  </div></div>
                      <div class="col-md-6"><div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="" name="email" placeholder="Enter Email">
                  </div></div>
                 
                 
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" id="" name="username" placeholder="Enter Username">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" class="form-control" id=""name="password" placeholder="Enter Password">
                  </div>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
                  <button type="submit" class="btn btn-primary btn-block" >Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->





          </div>
        

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
            $('form#add-employee').submit(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o)
                {

                  if (o.result == 1)
                    {   
                       
                        window.location.assign('<?= base_url();?>employee');
                       
                    }
                  else if (o.result == 0)
                    { 
                   
                       $('.popup_error').show().html('All fields are Mandatory').delay(10000).fadeOut('slow');
                    } 
                  else
                  {
                    $('.popup_error').show().html('Internal Server Error').delay(3000).fadeOut('slow');
                  }  

                }, 'json');
            });
         

        });
    </script>
