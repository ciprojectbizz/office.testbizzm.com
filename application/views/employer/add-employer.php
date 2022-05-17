  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company Register</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Company</li>
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
        <div class="col-md-2"></div>
          <div class="col-md-8" >
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-employer" action="<?= base_url('employer/post_add_employer')?>" method="POST">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Group*</label>
                  <select class="form-control" name="group">
                     <?php foreach($groups as $group): ?>
                        <option value="<?= $group['id']?>"><?= $group['name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Name of the Company*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="company_name" placeholder="Enter company name">
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Contact Person*</label>
                    <input type="text" class="form-control" id="exampleInputname" name="contact_person" placeholder="Enter Your Name">
                  </div>
                </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Registered Office Address*</label>
                     <textarea class="form-control" rows="3" name="registered_office_address" placeholder="Enter full address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Corporate Office Address</label>
                     <textarea class="form-control" rows="3" name="corporate_office_address" placeholder="Enter full address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Admin Office Address</label>
                     <textarea class="form-control" rows="3" name="admin_office_address" placeholder="Enter full address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Factory Address</label>
                     <textarea class="form-control" rows="3" name="factory_address" placeholder="Enter full address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Branch Address</label>
                     <textarea class="form-control" rows="3" name="branch_address" placeholder="Enter full address"></textarea>
                  </div>
                    <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email*</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter your email">
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Website*</label>
                    <input type="text" class="form-control" name="website" id="exampleInputname" placeholder="Enter Your website">
                  </div>
                </div>
                </div>
                <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Office Number*</label>
                    <input type="text" class="form-control" name="office_number" id="exampleInputname" placeholder="Enter Your Phone">
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" id="exampleInputname" placeholder="Enter Your Phone">
                  </div>
                </div>
                </div>
                 <div class="form-group">
                    <label for="exampleInputFile">Works of Client</label>
                     <textarea class="form-control" rows="3" name="work_of_client" placeholder="Works of client"></textarea>
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
        <div class="col-md-2"></div>
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
            $('form#add-employer').submit(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o)
                {

                  if (o.result == 1)
                    {   
                       
                        window.location.assign('<?= base_url();?>employer');
                       
                    }
                  else if (o.result == 0)
                    { 
                   
                       $('.popup_error').show().html('* Marked fields are required').delay(10000).fadeOut('slow');
                    } 
                  else
                  {
                    $('.popup_error').show().html('Internal Server Error').delay(3000).fadeOut('slow');
                  }  

                }, 'json');
            });
         

        });
    </script>