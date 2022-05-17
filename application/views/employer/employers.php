  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company</h1>
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
								<div class="row">
									<div class="col-md-1">
										<a href="<?= base_url('employer/add_employer')?>" data-toggle="tooltip" title="Add Company"><button class="btn btn-primary"><i class="fa fa-plus"></i></button></a>
									</div>
									
										<div class="col-md-6">
											<form action="<?php echo site_url("employer/import_csv"); ?>" method="post" enctype="multipart/form-data" id="import_form">
												<div class="row">
												<div class="col-md-4">
														<input type="file" name="file" class="form-control" style="display:inline-block;"/>
												</div>
												<div class="col-md-4">
														<input type="submit" class="btn btn-primary" name="importBtn" value="IMPORT">
												</div>
												</div>
											</form>
										</div>

									</div>
									

								</div>
                
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Company Id</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($employers as $employer): ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><i class="fa fa-id-card"></i> <?= $employer['company_id']?></td>
                        <td><i class="fa fa-building"></i> <?= $employer['company_name']?></td>
                        <td><i class="fa fa-user"></i> <?= $employer['contact_person']?></td>
                        <td><i class="fa fa-envelope"></i> <?= $employer['email']?></td>
                        <td><?php if($employer['status']==1){echo "Active"; } else{ echo "Inactive"; }?></td>
                        <td><?= $employer['employee_name']?></td>
                        <td>
													<a href="https://wa.me/<?= $employer['mobile_number']?>" target="_blank"><img src="<?= base_url('uploads/icon/WhatsApp.png')?>" width="40" height="40" alt=""></a>
													<a href="<?= base_url('employer/editEmployer/'.$employer['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Edit" style="background-color: #264653; color:#fff"><i class="fa fa-edit"></i></a> <a href="<?= base_url('employer/deleteEmployer/'.$employer['id'])?>" class="btn btn-default" data-toggle="tooltip" title="Delete" style="background-color:#264653; color: #fff"><i class="fa fa-trash"></i></a>
											
											</td>
                      </tr>
                    <?php endforeach;?>
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

