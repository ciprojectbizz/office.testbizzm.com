  <div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Details</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
              <div class="card-header">
                <!--a href="<?= base_url('project/add_image/'.$project_id)?>"><button class="btn btn-success">Add Images</button></a>
               <a href="<?= base_url('project/downloadWord/'.$project_id)?>"><button class="btn btn-primary">Download as Word Document</button></a>
                <a href="<?= base_url('project/downloadPdf/'.$project_id)?>"><button class="btn btn-danger">Download as PDF</button></a>
              </div-->
              <!-- /.card-header -->

      <section class="content">
      <div class="container-fluid">
        <div class="row" id="example2">
          <div class="col-md-12">

            <div class="card">
              <div class="card-body">
                  <div class="row">
                    <?php foreach($images as $image): ?>
                    <div class="col-md-6">
                      <div class="thumbnail">
                        <div class="jumbotron">
                           <a href="<?= base_url('project/open_images/'.$project_id)?>">
                           <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="150" height="100" style="object-fit:cover; float: right;"></a>
                           <?= $image['image_name'] ?><br>
                          <?=$image['project_name']?><br>
                          <?=$image['user_name']?><br>
                          <?= $image['created_at'] ?><br>
                         
                       </div><br><br>
                      </div>
                    </div>
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