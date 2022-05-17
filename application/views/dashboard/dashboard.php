  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Page</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-9">

      <div class="card" style="border-radius: 15px">
  
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-bordered table-striped">
      <thead style="background-color:#023047; color: #fff">
      <tr>
        <th>Company Name</th>
        <th>Task</th>
        <th>Sub Task</th>
        <th>Super Sub Task</th>
        <th>Client</th>
        <th>Deadline</th>
        <th>Time By Govt</th>
				<th width="20%">Status</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach($dashboard as $dashboards): ?>
          <tr style="background-color: #fff; color: #000">
            <td> <?= $dashboards['company_name']?></td>
            <td> <?= $dashboards['task']?></td>
            <td> <?= $dashboards['sub_task']?></td>
            <td><?= $dashboards['super_sub_task']?></td>
            <td> <?= $dashboards['project_manager_name']?></td>
            <td> <?= $dashboards['completion']?></td>
            <td><?= $dashboards['timeby']?></td>
						<td> <?php 
						$current = time();
						$due_date = strtotime($dashboards['timeby']);	
						$datediff = $due_date - $current;
						$difference = floor($datediff/(60*60*24));
							
							//Past Date
							if($difference > +1)
							{ ?>
									<span style="color:orange;">The last date for documents submission is approaching!</span>
						<?php	}
							//tomorrow
							elseif($difference >= 0)
							{ ?>
								<span style="color:Brown;">Tomorrow is the last date for documents submission!</span>	  
							<?php		}
							//1 day before 
							elseif($difference >= -1)
							{ ?>			
							<span style="color:blue;">Today is the last date for documents submission!</span>
						<?php	}
							//today
							else{ 
						?>
								<span style="color:red;">Your documents submission date has passed!</span>	
						<?php	} ?>
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
    
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              <div class="card-header" style="background-color:#023047; color: #fff; border-top-left-radius: 15px; border-top-right-radius: 15px;" >
                <h3 class="card-title">Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add-employee" action="<?= base_url('dashboard/dashboard_detail')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Company Name</label>
                  <select class="form-control" name="employer_name">
                  <?php foreach($employers as $employer): ?>
                        <option value="<?= $employer['id']?>"><?= $employer['company_name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Task Name</label>
										<input type="text" class="form-control" name="task_name" value = "">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Subtask Name</label>
										<input type="text" class="form-control" name="sub_task_name" value = "">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Super Sub Task</label>
										<input type="text" class="form-control" name="super_sub_task_name" value = "">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Client</label>
                  <select class="form-control" name="project_manager">
                  <?php foreach($employees as $employee): ?>
                        <option value="<?= $employee['id']?>"><?= $employee['name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="">Deadline</label>
                    <input type="date" class="form-control" id="" name="completion" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="">Time By Govt</label>
                    <input type="date" class="form-control" id=""name="timeby" placeholder="">
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
          </div> 
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript">
		
       /* $(function ()
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
                   
                       $('.popup_error').show().html('All fields are Mandatory').delay(3000).fadeOut('slow');
                    } 
                  else
                  {
                    $('.popup_error').show().html('Internal Server Error').delay(3000).fadeOut('slow');
                  }  

                }, 'json');
            });
         

        });*/
    </script>
