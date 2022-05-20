<!-- Button trigger modal -->
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/js/dropzone/dropzone.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/dropzone/dropzone.min.js"></script>
  <div class="content-wrapper" style="margin-left: 0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Add File</h1> 
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

                        </div>

						<!-- /.card-header -->
						<div class="card-body">
						<!--<h4>File upload</h4>
							<form id = "" action="<?= base_url('document/post_add_image/'.$this->uri->segment(3)) ?>" method="post"
							enctype="multipart/form-data">
								<input type="file" class="" id="" name="files[]" multiple required="" style="margin-top: 10px;">
								<input class="btn btn-success" type="submit" name="fileSubmit" style="width: 15%" value="UPLOAD" />
							</form>-->
							<div class="row p-3">
								<div class="col-md-1">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rocModal" style="background-color: #023e8a; color:#fff">Add ROC</button>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFromNumberModal" style="background-color: #023e8a; color:#fff">Add Form Number</button>
								</div>
							</div>
							
							<div class="site-table" style="overflow: auto; height: 200px ">
								<table class="table table-bordered table-striped" style="overflow: auto; width: 100%; height: 250px; text-align: center;">
								<thead style="background-color:#023047; color: #fff;position: sticky;top: 0;">
								<tr>
									<th>Company Name </th>
									<th>Form Name</th>
									<th>Year/Period</th>
									<th>Date Of Filing</th>
									<th>Due Date</th>
									<th>SRN</th>
									<th>Type of Fee</th>
									<th>Amount</th>
									<th>Created By</th>
									<th>Challan</th>
									<th>ROC Form</th>
									<th>Additional file-1</th>
									<th>Additional file-2</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($registrars_companies as $registrars_companiesRow): ?>
									<tr style="background-color: #fff; color: #000">
										<td><?= $registrars_companiesRow['company_name']?></td>
										<td><?= $registrars_companiesRow['form_number']?></td>
										<td><?= $registrars_companiesRow['year_period']?></td>
										<td><?= $registrars_companiesRow['date_of_filing']?></td>
										<td><?= $registrars_companiesRow['statutory_due_date']?></td>
										<td><?= $registrars_companiesRow['srn']?></td>
										<td><?php if($registrars_companiesRow['type_ofFee'] == 1){ ?>
											Normal
										<?php }elseif($registrars_companiesRow['type_ofFee'] == 2){ ?>
											Additional
										<?php }elseif($registrars_companiesRow['type_ofFee'] == 3){ ?>
											Normal & Additional
										<?php }elseif($registrars_companiesRow['type_ofFee'] == 4){ ?>
											Total
										<?php }else{} ?></td>
										<td><?= $registrars_companiesRow['amount']?></td>
										<td><?= $registrars_companiesRow['user_name']?></td>
										<td>
											<?php if($registrars_companiesRow['challan_type']=='image/jpg' || $registrars_companiesRow['challan_type']=='image/png' || $registrars_companiesRow['challan_type']=='image/jpeg'){ ?>
								
											<a href="<?php echo base_url('uploads/roc_img/'.$registrars_companiesRow['roc_challan']) ?>" target="_blank" class=""><img src="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['roc_challan'])?>" width="60" height="60" style="object-fit:cover;"></a>
									
											<?php } elseif($registrars_companiesRow['challan_type'] =='application/pdf' || $registrars_companiesRow['challan_type'] =='application/docx') { ?>
												<a href="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['roc_challan'])?>" target="_blank"><i class="fa fa-file-pdf" style="font-size:40px;color:red;"></i></a>
											<?php }else{} ?>
										</td>
										<td>
										<?php if($registrars_companiesRow['form_type']=='image/jpg' || $registrars_companiesRow['form_type']=='image/png' || $registrars_companiesRow['form_type']=='image/jpeg'){ ?>

											<a href="<?php echo base_url('uploads/roc_img/'.$registrars_companiesRow['roc_form']); ?>" target="_blank" class=""><img src="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['roc_form'])?>" width="60" height="60" style="object-fit:cover;"></a>

										<?php } elseif($registrars_companiesRow['form_type'] =='application/pdf' || $registrars_companiesRow['form_type'] =='application/docx') { ?>
										<a href="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['roc_form'])?>" target="_blank"><i class="fa fa-file-pdf" style="font-size:40px;color:red;"></i></a>
					    				<?php } ?>
										</td>
										<td>
										<?php if($registrars_companiesRow['additional_file1_type']=='image/jpg' || $registrars_companiesRow['additional_file1_type']=='image/png' || $registrars_companiesRow['additional_file1_type']=='image/jpeg'){ ?>
								
											<a href="<?php echo base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_1']) ?>" target="_blank" class=""><img src="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_1'])?>" width="60" height="60" style="object-fit:cover;"></a>
									
											<?php } elseif($registrars_companiesRow['additional_file1_type'] =='application/pdf' || $registrars_companiesRow['additional_file1_type'] =='application/docx') { ?>
												<a href="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_1'])?>" target="_blank"><i class="fa fa-file-pdf" style="font-size:40px;color:red;"></i></a>
											<?php }else{} ?>
										</td>
										<td>
										<?php if($registrars_companiesRow['additional_file2_type']=='image/jpg' || $registrars_companiesRow['additional_file2_type']=='image/png' || $registrars_companiesRow['additional_file2_type']=='image/jpeg'){ ?>
								
										<a href="<?php echo base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_2']) ?>" target="_blank" class=""><img src="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_2'])?>" width="60" height="60" style="object-fit:cover;"></a>
								
										<?php } elseif($registrars_companiesRow['additional_file2_type'] =='application/pdf' || $registrars_companiesRow['additional_file2_type'] =='application/docx') { ?>
											<a href="<?= base_url('uploads/roc_img/'.$registrars_companiesRow['additional_file_2'])?>" target="_blank"><i class="fa fa-file-pdf" style="font-size:40px;color:red;"></i></a>
										<?php }else{} ?>
										</td>
										<td><?php if($registrars_companiesRow['status'] == 1){ ?>
											<span class = "btn btn-primary" style="box-shadow:none !important; text-transform:uppercase;">Completed</span>
										<?php }elseif($registrars_companiesRow['status'] == 3){ ?>
											<span class="btn btn-success" style="box-shadow:none !important; text-transform:uppercase;">Approved</span>	
										<?php }else{ ?>
											<span class="btn btn-info" style="box-shadow:none !important; text-transform:uppercase;">Pending</span>	
										<?php } ?>
										</td>
										<td>
										<a  href="javascript:void(0);" data-registrars_companies_Id="<?=  $registrars_companiesRow['id'];?>" data-folder_assign_id = "<?= $registrars_companiesRow['folder_assign_id'] ?>" class="btn btn-default Registrars_companiesStatus" title="Status"><button type="button" class="btn btn-default" style="background-color: #023e8a; color:#fff" data-toggle="tooltip"><i class="fas fa-tasks"></i></button></a>
										
										<a href="javascript:void(0);" data-registrars_companies_Id="<?=  $registrars_companiesRow['id'];?>" data-folder_assign_id = "<?= $registrars_companiesRow['folder_assign_id'] ?>" class="btn btn-default openRegistrars_companies" title="Capture"><button type="button" class="btn btn-default" onclick="on_camera()" style="background-color: #023e8a; color:#fff" data-toggle="tooltip"><i class="fa fa-camera"></i></button></a>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
								</table>
							</div>

						</div>						

						
                  <!-- <form action="<?= base_url('document/dragDropUpload/' . $project_id); ?>" class="dropzone" method="post"></form> -->
                <section>
					<div class="row p-3">
							
							<div class="form-group col-md-2">
								<select class="form-control searchOption" name = "daterangefilter" style = " border:1px solid #023047;">
									<option value = "">Select Search Option</option>
									<option value = "CompanyOption" >Company Wise</option>
									<!--option value = "YearOption">Year Wise</option>
									<option value = "FeesOption">Fees Wise</option>
									<option value = "PeriodOption">Period Based</option-->
									<option value = "GroupOption">Group Wise</option>
									<option value = "DateRangeOption">Date Range Wise</option>	
								</select>
							</div>

							<div class="companywise col-md-2" style="display:none;">								
								<div class="form-group has-search">
									<span class="fa fa-search form-control-feedback"></span>
									<input type="text" class="form-control companySearch" placeholder="Search By Company" name="companyName" value="">
								</div>

							</div>

							<div class="row daterange" style="display:none;">
								<div class="form-group col-md-6">
									<div class="row">
										<div class="col-md-5">
											<label for="dateText">From date:</label>
										</div>
										<div class="col-md-7">
											<input type="date" class="form-control dateTextField1" name="from_date" value=''>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<div class="row">
										<div class="col-md-5">
											<label for="dateText">To date:</label>
										</div>
						
										<div class="col-md-7">
											<input type="date" class="form-control dateTextField2" name="to_date" value=''>
										</div>
									</div>
								</div>
							</div>
							
							<div class="yearrange col-md-3" style="display:none;">
								<div class="form-group">
									<!--label for="from_date">Select Year:</label-->
									<select name = "getyear" class="form-control getyear">
										<option value = "">Select Year</option>
										<?php  $lasttenYear = (int)date("Y")- 35;
											$curyear = (int)date("Y");
											for($i=$lasttenYear; $i<= $curyear; $i++){ ?>
											<option value="<?php echo $i;?>" <?php if($i == $i) echo 'selected'; ?>><?php echo $i;?></option>  
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="groupwise col-md-2" style="display:none;">
								<div class="form-group">
									<select class="form-control group_name" name="group_name">
									<option value = "">Select Group Name</option>
									<?php foreach($company_verticals as $company_verticalsRow): ?>
										<option value="<?= $company_verticalsRow['id']?>"><?= $company_verticalsRow['name']?></option>
										<?php endforeach; ?> 
									</select>
								</div>
							</div>
						</div>

					<div class="displaySearch">
                 <?php if(!empty($file)){ foreach($file as $files):if($files['type']=='image/png') { ?>
                    <figure class="figure">
                        <img src="<?= base_url('uploads/'.$files['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($files['type']=='image/jpg') { ?>
                      <figure class="figure">
                        <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($files['type']=='image/jpeg') { ?>
                       <figure class="figure">
                        <img src="<?= base_url('uploads/'.$files['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                     <?php } elseif($files['type']=='image/gif') { ?>
                       <figure class="figure">
                        <img src="<?= base_url('uploads/'.$files['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                   <?php } elseif($files['type']=='application/pdf') { ?>

                    <figure class="figure">
                      <a href="<?= base_url('uploads/'.$files['image_name'])?>"><i class="fa fa-file-pdf" style="font-size:140px;color:red; margin: 35px"></i></a>
                        <!--img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"--><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($files['type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document') { ?>

                    <figure class="figure">
                      <a href="<?= base_url('uploads/'.$files['image_name'])?>"><i class="fa fa-file-word" style="font-size:140px;color:lightblue; margin: 35px"></i></a>
                        <!--img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"--><figcaption class="figcaption text-center"><?=$files['image_name']?>
                         <a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    
                    <?php } endforeach;} ?>
					</div>
                </section>
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

  <div class="modal" id="captureimage">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px; overflow: auto;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Capture</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="close_camera()">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form method="POST" action="<?= base_url('Document/capture_image') ?>">
						<div class="row">
							<div class="col-md-6">

							<input name="registrars_companiesId" type="hidden" class="registrars_companiesId" value=""/>

								<?php $folderid = $this->uri->segment(3); ?>
								<input type="hidden" name="folderid" value="<?php echo $folderid; ?>">

								<select class="form-control" id="projectsId" name="projectsId">
									<option value="">Select Project</option>
									<?php 
									$projects_query = $this->db->query("SELECT * FROM projects");
									foreach ($projects_query->result_array() as $projects_row) {  ?>
									<option value="<?php echo $projects_row['id'];  ?>"><?php echo $projects_row['project_name'];  ?></option>
									<?php } ?>
								</select>
                            </div>
						</div>
							
                        <div class="row">
                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br/>
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="webcam" id="webcamimage" class="image-tag">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div class="col-md-6">
                                <div id="results"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <br />
                                <input type="submit" class="btn btn-success" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="rocModal" tabindex="-1" role="dialog" aria-labelledby="rocModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rocModalLabel">Registrars Of Companies</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
			<form action="<?= base_url('document/post_add_registrars_companies')?>" method="post" enctype="multipart/form-data">
				<?php $folderid = $this->uri->segment(3); ?>
				<input type="hidden" class="form-control" name="folderid" value = "<?php echo $folderid; ?>">

                <div class="card-body">
						
						<div class="form-group">
							<label for="exampleInputPassword1">ASSIGN USER</label>
							<select class="form-control" name="created_by">
								<?php foreach($employees as $employee): ?>
								<option value="<?= $employee['id']?>"><?= $employee['name']?></option>
								<?php endforeach; ?> 
							</select>
						</div>
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">COMPANY NAME</label>
									<select class="form-control" name="company_name">
										<?php foreach($employers as $employer): ?>
										<option value="<?= $employer['id']?>"><?= $employer['company_name']?></option>
										<?php endforeach; ?> 
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<label for="exampleInputPassword1">FORM NAME</label>
								<select class="form-control" name="form_number">
									<option>Select Form Number</option>
									<?php foreach($form_number as $form_numberRow): ?>
									<option value="<?= $form_numberRow['id']?>"><?= $form_numberRow['form_number']?></option>
									<?php endforeach; ?> 
								</select>
							</div>
						</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">SRN(4 to 10 characters)</label>
								<input type="text" class="form-control srnCheck" name="srn" placeholder="Enter SRN" minlength="9" required size="9">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">STATUTORY DUE DATE</label>
								<input type="date" class="form-control" name="statutory_due_date">
							</div>
						</div>
					</div>     

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">YEAR /PERIOD</label>
								<input type="date" class="form-control" name="year_period">
							</div>
						</div>
						<div class="col-md-6">		
							<div class="form-group">
								<label for="exampleInputPassword1">DATE OF FILING</label>
								<input type="date" class="form-control" name="date_of_filing">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Type of Fee</label>
								<select class="form-control" name="type_ofFee">
								<option>Select Type of Fee</option>
								<option value="1">Normal</option>
								<option value="2">Additional</option>
								<option value="3">Normal & Additional</option>
								<option value="4">Total</option>
							</select>
							</div>
						</div>
						<div class="col-md-6">		
							<div class="form-group">
								<label for="exampleInputPassword1">AMOUNT</label>
								<input type="text" class="form-control" name="amount" placeholder="Enter amount">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlFile1">Challan</label>
								<input type="file" name="roc_challan" class="form-control-file">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlFile1">ROC FORM</label>
								<input type="file" name="roc_form" class="form-control-file">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlFile1">Additional File-1</label>
								<input type="file" name="additional_file_1" class="form-control-file">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleFormControlFile1">Additional File-2</label>
								<input type="file" name="additional_file_2" class="form-control-file">
							</div>
						</div>
					</div>
					
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

	<!-- Modal -->
	<div class="modal fade" id="addFromNumberModal" tabindex="-1" role="dialog" aria-labelledby="addFromNumberModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rocModalLabel">ROC Form Number</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
			<form action="<?= base_url('document/post_add_form_number')?>" method="post" enctype="multipart/form-data">
				<?php $folderid = $this->uri->segment(3); ?>
				<input type="hidden" class="form-control" name="folderid" value = "<?php echo $folderid; ?>">

                <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">FORM NUMBER</label>
								<input type="text" class="form-control" name="form_number" placeholder="Enter From Number">
							</div>
						</div>
					</div>     
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="popup_error" style="font-size: 13px;color:#CC0000;"></div>
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>

			  	<table class="table table-bordered table-striped" style="overflow: auto; width: 100%; height: 100px; text-align: center;">
					<thead style="background-color:#023047; color: #fff;position: sticky;top: 0;">
					<tr>
						<th>Form Number </th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($form_number as $allform_numberRow): ?>
						<tr style="background-color: #fff; color: #000">
							<td><?= $allform_numberRow['form_number']?>&nbsp;&nbsp;<a href="<?= base_url('document/delete_form_number/'.$allform_numberRow['id'].'/'.$folderid)?>"><i class="fa fa-trash" style="color: red;"></i></a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


	
	<div id="Registrars_companiesStatusModal" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Status</h5>
					<button type="button" class="close close_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url(); ?>Document/updateroc_status" method="post" enctype="multipart/form-data">
					
						<?php $folderid = $this->uri->segment(3); ?>
						<input type="hidden" class="form-control" name="folderid" value = "<?php echo $folderid; ?>">
						<input type="hidden" name="rocStatusId" class="rocStatusId form-control" value=""/>
						
						<div class = "form-group">
							<select class="form-control" name="status_name" data-placeholder="Select Status Name" >
								<option>Select Status</option>
								<option value="1">Completed</option>
								<option value="2">Pending</option>
								<option value="3">Approved</option>
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


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		.has-search .companySearch {
			padding-left: 2.375rem;
		}

		.has-search .form-control-feedback {
				position: absolute;
				z-index: 2;
				display: block;
				width: 2.375rem;
				height: 2.375rem;
				line-height: 2.375rem;
				text-align: center;
				pointer-events: none;
				color: #aaa;
		}
		.roc_challanForm{
			background-color: #023047;
			color: white;
			padding: 5px;
			text-align: left;
			border-radius: 5px;
			padding-left: 5px;
		}
	</style>  
  	<script>
	$(document).ready(function(){
		$(".searchOption").change(function(){
			if (this.value == 'CompanyOption') {
				$(".daterange").hide();
				$(".companywise").show();
				$(".groupwise").hide();
			}
			if(this.value == 'DateRangeOption'){
				$(".daterange").show();
				$(".companywise").hide();
				$(".groupwise").hide();
			}
			if(this.value == 'GroupOption'){
				$(".daterange").hide();
				$(".companywise").hide();
				$(".groupwise").show();
			}
		});

		$(".companySearch").keyup(function() {			
			var companyName = $('.companySearch').val();
			var folder_id = '<?php echo $this->uri->segment(3); ?>';

			//alert(folder_id);
			if (companyName == "") {
					$(".displaySearch").html("");
			}
			else {	
				$.ajax({	
						type: "POST",	
						url: "<?= base_url("/document/searchCompanyData")?>",
						data: { companyName: companyName, folder_id :folder_id, },
						success: function(html) {		
							$(".displaySearch").html(html);
						}
				});
			}
		});

		$(".group_name").change(function() {			
			var group_name = $('.group_name').val();
		
			//alert(group_name);
			var folder_id = '<?php echo $this->uri->segment(3); ?>';

			if (group_name == "") {
					$(".displaySearch").html("");
			}
			else {	
				$.ajax({	
						type: "POST",	
						url: "<?= base_url("/document/searchGroupNameData")?>",
						data: { group_name: group_name, folder_id :folder_id },
						success: function(html) {		
							$(".displaySearch").html(html);
						}
				});
			}
		});

		$(".dateTextField1, .dateTextField2").change(function() {			
			var from_date = $('.dateTextField1').val();
			var to_date = $('.dateTextField2').val();
			//alert(from_date+to_date);
			var folder_id = '<?php echo $this->uri->segment(3); ?>';

			//alert(folder_id);
			if (from_date == "") {
					$(".displaySearch").html("");
			}
			else {	
				$.ajax({	
						type: "POST",	
						url: "<?= base_url("/document/searchFromDateData")?>",
						data: { from_date: from_date, to_date: to_date, folder_id :folder_id },
						success: function(html) {		
							$(".displaySearch").html(html);
						}
				});
			}
		});

		$(".openRegistrars_companies").click(function(){
          $("#captureimage").modal('show');
					var registrars_companiesId = $(this).attr('data-registrars_companies_Id');
     			$("#captureimage .registrars_companiesId").val( registrars_companiesId );
					
        });
		$(".close_btn").click(function(){
		$("#captureimage").modal("hide"); 
					
        });

		$(".Registrars_companiesStatus").click(function(){
          	$("#Registrars_companiesStatusModal").modal('show');
				var rocStatusId = $(this).attr('data-registrars_companies_Id');
     			$("#Registrars_companiesStatusModal .rocStatusId").val( rocStatusId );
					
        });
			$(".close_btn").click(function(){
			$("#Registrars_companiesStatusModal").modal("hide"); 
						
        });


		$(".srnCheck").keyup(function(e){
		e.preventDefault();
			var srnCheck = $(this).val();

			$.ajax({
				url: "<?= base_url("/document/showSrnCheck")?>",
				type: 'GET',
				data: {srnCheck: srnCheck},
				success: function(response) {
					if(response > 0)
					{
						//alert("Enter Duplicate SRN");
						Swal.fire('This SRN number is in our record.You enter anther number');
					}
				}
			});

		});


	});


	function on_camera() {
		Webcam.set({
			width: 250,
			height: 150,
			image_format: 'jpeg',
			upload_name: 'webcam',
			jpeg_quality: 90
		});

		Webcam.attach('#my_camera');
	}

	function close_camera() {
		Webcam.reset();
	}

	function take_snapshot() {
		Webcam.snap(function(data_uri) {
			$('#webcamimage').val(data_uri);
			$(".image-tag").val(data_uri);
			document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
		});
		Webcam.upload(data_uri, '"<?php echo base_url(); ?>Enquiry_Management/Demosave"', function(code, text) {
			if (code === '200') {
				alert('ok');
			} else {
				alert('error');
			}
		});
	}
	
</script>

