  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects</h1>
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
                <a href="<?=base_url('project/add_project')?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" title="Add Project"><i class="fa fa-plus"></i></button></a>
              </div>
              <!-- /.card-header -->
							
					<!-- Nav tabs -->
					<ul class="nav nav-tabs pt-3" role="tablist">
						<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home" style="color: #023047">All Project</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu1" style="color: #023047">Pending Project</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu2" style="color: #023047">Completed Project</a>
						</li>
					</ul>


					<!-- Tab panes -->
					<div class="tab-content">
						<div id="home" class="tab-pane active">
							<div class="card-body">
									<table id="example2" class="table table-bordered table-striped">
										<thead style="background-color:#023047; color: #fff">
										<tr>
											<th>Work ID</th>
											<th>Nature Of Job</th>
											<th>Client Name</th>
											<th>Assign To</th>
											<th>Completion Date</th>
											<th>Problems/Issues</th>
											<th>Short Out Issues</th>
											<th>Date Of Bill</th>
											<th>Expected Delivery</th>
											<th>Priority</th>
											<th>Status</th>
											<th>Created By</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<?php foreach($projects as $project): ?>
												<tr style="background-color: #fff; color: #000">
													<td><i class="fa fa-id-card"></i> <?= $project['work_id']?></td>
													<td><i class="fa fa-laptop-code"></i> <?= $project['project_name']?></td>
													<td><i class="fa fa-building"></i> <?= $project['company_name']?></td>
													<td><i class="fa fa-user"></i> <?= $project['project_manager_name']?></td>
													<td><i class="fa fa-calendar-day"></i> <?= $project['completion_date']?></td>
													<td><i class="fa fa-laptop-code"></i> <?= $project['problems_issues']?></td>
													<td><i class="fa fa-laptop-code"></i> <?= $project['short_out_issues']?></td>
													<td><i class="fa fa-calendar-day"></i> <?= $project['date_of_bill']?></td>
													<td><i class="fa fa-calendar-day"></i> <?= $project['expected_delivery']?></td>
													<td>
														<?php if($project['priority'] == 1){ ?>
														<span class = "btn btn-danger" style="box-shadow:none !important;">High</span>
														<?php }elseif($project['priority'] == 2){ ?>
														<span class="btn btn-success" style="box-shadow:none !important">Important</span>		
														<?php  }elseif($project['priority'] == 3){ ?>
															<span class="btn btn-info" style="box-shadow:none !important;">Normal</span>
														<?php }else{ ?>
															<span class="btn btn-secondary" style="box-shadow:none !important;">Low</span>
														<?php } ?>
													</td>
													<td>
													<?php if($project['status'] == 1){ ?>
													<span class = "btn btn-success" style="box-shadow:none !important; text-transform:uppercase;">Completed</span>
													<?php }elseif($project['status'] == 2){ ?>
													<span class="btn btn-info" style="box-shadow:none !important; text-transform:uppercase;">Pending</span>		<?php }else{ ?>
													<span></span>
													<?php } ?>
													</td>
													<td><?= $project['employee_name']?></td>
													<td>
													<!--a href="<?= base_url('project/tasks/'.$project['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Tasks"><i class="fa fa-eye"></i></a-->
													<button type="button" class="btn btn-default" style="background-color: #264653; color:#fff"
                                                onclick="open_upload_file(<?= $project['id'] ?>)" data-toggle="tooltip" title="File upload"><i
                                                    class="fa fa-upload"></i> </button> 
													<a href="<?= base_url('project/edit_tasks/'.$project['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Edit Tasks"><i class="fa fa-edit"></i></a>

													<a href="<?= base_url('project/delete_tasks/'.$project['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Delete Tasks"><i class="fa fa-trash"></i></a>

													<a data-project_id="<?=  $project['id']; ?>" href="javascript:void(0);" class="btn btn-default editProjuct_status" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Add Status"><i class="fas fa-tasks"></i></a>
													
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
						</div>


						<div id="menu1" class="tab-pane">
							<div class="card-body">
									<table id="pendingProject" class="table table-bordered table-striped">
										<thead style="background-color:#023047; color: #fff">
										<tr>
											<th>Work ID</th>
											<th>Nature Of Job</th>
											<th>Client Name</th>
											<th>Assign To</th>
											<th>Completion Date</th>
											<th>Problems/Issues</th>
											<th>Short Out Issues</th>
											<th>Date Of Bill</th>
											<th>Expected Delivery</th>
											<th>Priority</th>
											<th>Status</th>
											<th>Created By</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<?php foreach($PendingProjects as $PendingprojectRow): ?>
											<tr style="background-color: #fff; color: #000">
												<td><i class="fa fa-id-card"></i> <?= $PendingprojectRow['work_id']?></td>
												<td><i class="fa fa-laptop-code"></i> <?= $PendingprojectRow['project_name']?></td>
												<td><i class="fa fa-building"></i> <?= $PendingprojectRow['company_name']?></td>
												<td><i class="fa fa-user"></i> <?= $PendingprojectRow['project_manager_name']?></td>
												<td><i class="fa fa-calendar-day"></i> <?= $PendingprojectRow['completion_date']?></td>
												<td><i class="fa fa-laptop-code"></i> <?= $PendingprojectRow['problems_issues']?></td>
												<td><i class="fa fa-laptop-code"></i> <?= $PendingprojectRow['short_out_issues']?></td>
												<td><i class="fa fa-calendar-day"></i> <?= $PendingprojectRow['date_of_bill']?></td>
												<td><i class="fa fa-calendar-day"></i> <?= $PendingprojectRow['expected_delivery']?></td>
												<td>
													<?php if($PendingprojectRow['priority'] == 1){ ?>
													<span class = "btn btn-danger" style="box-shadow:none !important;">High</span>
													<?php }elseif($PendingprojectRow['priority'] == 2){ ?>
													<span class="btn btn-success" style="box-shadow:none !important;">Important</span>		
													<?php  }elseif($PendingprojectRow['priority'] == 3){ ?>
														<span class="btn btn-info" style="box-shadow:none !important;">Normal</span>
													<?php }else{ ?>
														<span class="btn btn-secondary" style="box-shadow:none !important;">Low</span>
													<?php } ?>
												</td>
												<td>
												<?php if($PendingprojectRow['status'] == 2){ ?>
												<span class="btn btn-info" style="box-shadow:none !important; text-transform:uppercase;">Pending</span>		
												<?php } ?>
												</td>
												<td><?= $PendingprojectRow['employee_name']?></td>
												<td><!--a href="<?= base_url('project/tasks/'.$PendingprojectRow['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Tasks"><i class="fa fa-eye"></i></a-->
												<button type="button" class="btn btn-default" style="background-color: #264653; color:#fff"
                                                onclick="open_upload_file(<?= $project['id'] ?>)" data-toggle="tooltip" title="File upload"><i
                                                class="fa fa-upload"></i> </button> 
												<a href="<?= base_url('project/edit_tasks/'.$project['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Edit Tasks"><i class="fa fa-edit"></i></a>
												<a data-project_id="<?=  $PendingprojectRow['id']; ?>" href="javascript:void(0);" class="btn btn-default editProjuct_status" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Add Status"><i class="fas fa-tasks"></i></a>
											</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
						</div>

						<div id="menu2" class="tab-pane">
						<div class="card-body">
								<table id="completeProject" class="table table-bordered table-striped">
									<thead style="background-color:#023047; color: #fff">
									<tr>
										<th>Work ID</th>
										<th>Nature Of Job</th>
										<th>Client Name</th>
										<th>Assign To</th>
										<th>Completion Date</th>
										<th>Problems/Issues</th>
										<th>Short Out Issues</th>
										<th>Date Of Bill</th>
										<th>Expected Delivery</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Created By</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($CompletedProjects as $CompletedProjectsrow): ?>
										<tr style="background-color: #fff; color: #000">
											<td><i class="fa fa-id-card"></i> <?= $CompletedProjectsrow['work_id']?></td>
											<td><i class="fa fa-laptop-code"></i> <?= $CompletedProjectsrow['project_name']?></td>
											<td><i class="fa fa-building"></i> <?= $CompletedProjectsrow['company_name']?></td>
											<td><i class="fa fa-user"></i> <?= $CompletedProjectsrow['project_manager_name']?></td>
											<td><i class="fa fa-calendar-day"></i> <?= $CompletedProjectsrow['completion_date']?></td>
											<td><i class="fa fa-laptop-code"></i> <?= $CompletedProjectsrow['problems_issues']?></td>
											<td><i class="fa fa-laptop-code"></i> <?= $CompletedProjectsrow['short_out_issues']?></td>
											<td><i class="fa fa-calendar-day"></i> <?= $CompletedProjectsrow['date_of_bill']?></td>
											<td><i class="fa fa-calendar-day"></i> <?= $CompletedProjectsrow['expected_delivery']?></td>
											<td>
												<?php if($CompletedProjectsrow['priority'] == 1){ ?>
												<span class = "btn btn-danger" style="box-shadow:none !important;">High</span>
												<?php }elseif($CompletedProjectsrow['priority'] == 2){ ?>
												<span class="btn btn-success" style="box-shadow:none !important;">Important</span>		
												<?php  }elseif($CompletedProjectsrow['priority'] == 3){ ?>
													<span class="btn btn-info" style="box-shadow:none !important;">Normal</span>
												<?php }else{ ?>
													<span class="btn btn-secondary" style="box-shadow:none !important;">Low</span>
												<?php } ?>
											</td>
											<td>
											<?php if($CompletedProjectsrow['status'] == 1){ ?>
											<span class = "btn btn-success" style="box-shadow:none !important; text-transform:uppercase;">Completed</span>
											<?php } ?>
											</td>
											<td><?= $CompletedProjectsrow['employee_name']?></td>
											<td><!--a href="<?= base_url('project/tasks/'.$CompletedProjectsrow['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="View Tasks"><i class="fa fa-eye"></i></a-->
											<button type="button" class="btn btn-default" style="background-color: #264653; color:#fff"
                                            onclick="open_upload_file(<?= $project['id'] ?>)" data-toggle="tooltip" title="File upload"><i class="fa fa-upload"></i> </button> 
											<a href="<?= base_url('project/edit_tasks/'.$project['id'])?>" class="btn btn-default" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Edit Tasks"><i class="fa fa-edit"></i></a>
											<a data-project_id="<?=  $CompletedProjectsrow['id']; ?>" href="javascript:void(0);" class="btn btn-default editProjuct_status" style="background-color: #264653; color:#fff" data-toggle="tooltip" title="Add Status"><i class="fas fa-tasks"></i></a>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>

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

<div id="showProjectStatus" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Status</h5>
				<button type="button" class="close close_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url(); ?>project/updateProject_status" method="post" enctype="multipart/form-data">
							<input name="projectId" type="hidden" class="modal_projectId form-control" value=""/>
							
							<div class = "form-group">
									<select class="form-control" name="status_name" data-placeholder="Select Status Name" >
											<option>Select Status</option>
											<option value="1">Completed</option>
											<option value="2">Pending</option>
									</select>
							</div>
							<input type="submit" class="btn btn-primary btn-custom" value="submit" style="width: 120px;">
					</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Cancel</button>
				
			</div>
		</div>
	</div>
</div>


<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="modal-form">
                    <form id="upload_file_form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="task_id" id="task_id">
						<div class="form-group ">
							<!---<label for="first_name" class="col-sm-6 control-label">First Name 
							</label>-->
							<div class="col-sm-12">
								<select class="form-select form-control" name = "folder_name" required>
									<option selected>Select Year</option>
									<?php foreach($file_assign as $file_assignRow) { ?>
									<option value="<?= $file_assignRow['id'] ?>"><?= $file_assignRow['folder_name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<!---<label for="first_name" class="col-sm-6 control-label">First Name 
							</label>-->
							<div class="col-sm-12">
								<input type="file" class="" name="files[]" style="margin-top: 10px;" multiple>
							</div>
						</div>
               
                		<div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div><br>
               			<button class="btn btn-success" type="button" id="upload_file_btn">UPLOAD</button>	
                	</form>
				 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/toast/toastr.min.css') ?>">
<script src="<?= base_url('assets/toast/toastr.min.js') ?>"></script>
<script>
	$(document).ready(function(){
			$(".editProjuct_status").click(function(){
				$("#showProjectStatus").modal('show');
				var project_id = $(this).attr('data-project_id');
				$("#showProjectStatus .modal_projectId").val( project_id );
			});
			$(".close_btn").click(function(){
				$("#showProjectStatus").modal("hide"); 
			});
	});


	function open_upload_file(task_id) {
    $('#upload_file_form')[0].reset();
    $('#myModal1').modal('show');
    $('#task_id').val(task_id)

	}

	$('#upload_file_btn').click(function(e) {
    e.preventDefault();
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };
    var form = $('#upload_file_form')[0];
    var data = new FormData(form);
    $.ajax({
        url: "<?= base_url('project/post_add_image') ?>",
        type: 'post',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $('#loder').show()
        },
        success: function(data) {
            console.log(data)
            if (data.status == 'success') {
                toastr.success('File Upload Successfully');
                setTimeout(() => {
                    window.location.href = "<?= base_url() ?>/" + data.url
                }, 1000)
            } else {
                if (data.error)
                    toastr.error(data.error)
                if (data.error_project_id)
                    toastr.error(data.error_project_id);
                if (data.error_file)
                    toastr.error(data.error_file);
            }
            $('#loder').hide()
        },
        error: function(error) {
            // console.log(error)
            $('#loder').hide()
        }
    })
})
</script>
