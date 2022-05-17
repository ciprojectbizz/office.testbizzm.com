

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Project</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default" style="border-radius: 15px">
              <div class="card-header" style="background-color:#023047; color: #fff">
                <h3 class="card-title">Enter Task Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			   <?php foreach($taskedit as $taskeditRow): ?>

              <form action="<?= base_url('project/post_edit_project')?>" method="post" enctype="multipart/form-data">
			 
				<input type="hidden" class="form-control" value = "<?= $taskeditRow['id']?>" name="taskid">

                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name of the Client</label>
                  <select class="form-control" name="employer_name">
                     <?php foreach($employers as $employer): ?>
                        <option value="<?= $employer['id']?>" <?php if($employer['id'] == $taskeditRow['company']){ echo "Selected";} ?>><?= $employer['company_name']?></option>
                      <?php endforeach; ?> 
                  </select>
                  </div>
				<div class="row">
					<div class="col-md-6">
							<div class="form-group">
								<label for="">Nature Of Job</label>
								<input type="text" class="form-control" value = "<?= $taskeditRow['project_name']?>" name="project_name" placeholder="Enter Project Name">
							</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label for="exampleInputPassword1">Assign To</label>
						<select class="form-control" name="project_manager">
							<?php foreach($employees as $employee): ?>
									<option value="<?= $employee['id']?>" <?php if($employee['id'] == $taskeditRow['project_manager']){ echo "Selected";} ?>><?= $employee['name']?></option>
								<?php endforeach; ?> 
						</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
							<div class="form-group">
								<label for="">Completion Date</label>
								<input type="date" class="form-control" name="completion_date" value = "<?= $taskeditRow['completion_date']?>">
							</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label for="exampleInputPassword1">Date Of Bill</label>
								<input type="date" class="form-control" name="date_of_bill" value = "<?= $taskeditRow['date_of_bill']?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
							<div class="form-group">
								<label for="">Issues arises during the processing the job</label>
								<textarea class="form-control" name = "problems_issues" rows="3"><?= $taskeditRow['problems_issues']?></textarea>
							</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label for="exampleInputPassword1">Short out the issues</label>
								<textarea class="form-control" name = "short_out_issues" rows="3"><?= $taskeditRow['short_out_issues']?></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="brand_name">Priority:</label>
							<select class="form-control" id="priority" name="priority">
									<option value="1" <?php if($taskeditRow['priority'] == 1){ echo "Selected";} ?>>High</option>
									<option value="2" <?php if($taskeditRow['priority'] == 2){ echo "Selected";} ?>>Important</option>
									<option value="3" <?php if($taskeditRow['priority'] == 3){ echo "Selected";} ?>>Normal</option>
									<option value="4" <?php if($taskeditRow['priority'] == 4){ echo "Selected";} ?>>Low</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label for="">Expected Delivery</label>
							<input type="date" class="form-control" id=""name="expected_delivery" value = "<?= $taskeditRow['expected_delivery']?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">		
						<div class="form-group">
							<label for="brand_name">Upload Receipts:</label>
							<input type="file" name="Receiptsfiles" style="margin-top: 10px;">
						</div>
					</div>
				</div>
            </div>
                <!-- /.card-body -->

			<div class="card-footer">
				<div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			</div>
			
			</form>
			<?php endforeach; ?> 
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
            $('form#add-project').submit(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o)
                {

                  if (o.result == 1)
                    {   
                       
                        window.location.assign('<?= base_url();?>project');
                       
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
         

        });
    </script>
    


<script type="text/javascript">
function getSubTask() {
        $(".class_subtask").remove();
        $(".class_super_subtask").remove();
        var str='';
        var val=document.getElementById('task');
        for (i=0;i< val.length;i++) { 
            if(val[i].selected){
                str += val[i].value + ','; 
            }
        }         
        var str=str.slice(0,str.length -1);
        
	$.ajax({          
        	type: "POST",
        	url: "<?= base_url('task/getSubTask')?>",
        	data:{task_id:str},
        	success: function(o){
               if (o.result == 1)
               {
                   var i = 0;
                   var output = '';
                   for (i = 0; i < o.all; i++)
                   {
                       output += '<option class= "class_subtask" value= ' + o.subtasks[i]['id'] + '>';
                       var value = o.subtasks[i]['name'];
                       output += value;
                       output += '</option>';
                   }

                   $('#sub-task').append(output);
               }
        	}
	});
}

</script>
<script type="text/javascript">
function getSuperSubTask() {
        $(".class_super_subtask").remove();
        var str='';
        var val=document.getElementById('sub-task');
        for (i=0;i< val.length;i++) { 
            if(val[i].selected){
                str += val[i].value + ','; 
            }
        }         
        var str=str.slice(0,str.length -1);
        
	$.ajax({          
        	type: "POST",
        	url: "<?= base_url('task/getSuperSubTask')?>",
        	data:{sub_task_id:str},
        	success: function(o){
               if (o.result == 1)
               {
                   var i = 0;
                   var output = '';
                   for (i = 0; i < o.all; i++)
                   {
                       output += '<option class= "class_super_subtask" value= ' + o.supersubtasks[i]['id'] + '>';
                       var value = o.supersubtasks[i]['name'];
                       output += value;
                       output += '</option>';
                   }

                   $('#super-sub-task').append(output);
               }
        	}
	});
}
</script>

</script>


