<div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Documents</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <!--a href="<?= base_url('project/add_image/'.$project_id)?>"><button class="btn btn-success">Add Images</button></a>
               <a href="<?= base_url('project/downloadWord/'.$project_id)?>"><button class="btn btn-primary">Download as Word Document</button></a>
                <a href="<?= base_url('project/downloadPdf/'.$project_id)?>"><button class="btn btn-danger">Download as PDF</button></a> 
              </div>
              </card-header -->
              <div class="card-body">
                <div style="display:inline-block;">
                  <!-- Button trigger modal -->
                  
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_folder" style="box-shadow: none !important; border-radius: 7px !important;">Create Folder</button>
                  <br><br><br>

									<!-- Actual search box -->
									<div class="form-group has-search">
										<span class="fa fa-search form-control-feedback"></span>
										<input type="text" class="form-control search" value="" placeholder="Search By Year">
									</div>

									<div id="display">
									
									</div>
									
                 <?php foreach($folder as $folders): ?>
                     <figure class="figure">
                      <a href="<?= base_url('document/file_upload/'.$folders['id'])?>"><i class="fa fa-folder" style="font-size:50px;color:#f6bd60; margin-left: 20px"></i>
                        <figcaption class="figcaption text-center"><?=$folders['folder_name']?>
                        </figcaption>
											</a>
                      </figure>
                      
                    <?php endforeach; ?>
                </div>
                 
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
  </div>
  <div class="modal" id="create_folder">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Folder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="modal-form">
                  <form method="POST" action="<?= base_url('project/folder_create') ?>">
                    <p>Enter Folder Name</p>
                  
                        <input type="text" name="create_folder">
                        <input type="submit" class="btn btn-success" value="submit">
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
   
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
			.has-search .form-control {
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
		</style>
	<script>
		$(document).ready(function() {
			$(".search").keyup(function() {			
				var year = $('.search').val();
				//alert(name);
				if (year == "") {
						$("#display").html("");
				}
				else {	
					$.ajax({	
							type: "POST",	
							url: "<?= base_url("/document/fetchSearchYearData")?>",
							data: { year: year	},
							success: function(html) {		
								$("#display").html(html);
							}
					});
				}
			});
		});
	</script>
