


<div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Details</h2>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card" style="border-radius: 15px">
            <!--div class="content-header">
              <a href="<?= base_url('project/downloadPdf/'.$project_id)?>"><i class="fa fa-file-pdf" style="font-size:30px;color:red;float: right; margin-right: 30px"></i></a>
              <a href="<?= base_url('project/downloadWord/'.$project_id)?>"><i class="fa fa-file-word" style="font-size:30px;color:blue; float: right;"></i></a>
            </div-->
            <div class="card-body">
                
               <!--  <table id="example2" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>project Name</th>
                    <th>Task Name</th>
                    <th>Sub Task Name</th>
                    <th>Super Sub Task Name</th>
                    <th>Uploaded by</th>
                    <th>file Upload</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($images as $image):if($image['id']=="1"){?>
                      <tr>
                        <td><?= $image['project_name'] ?></td>
                        <td><?= $image['task_name'] ?></td>
                        <td><?= $image['sub_task_name']?></td>
                        <td><?= $image['super_sub_task_name']?></td>
                        <td><?= $image['user_name']?></td>
                        <td><i class="fa fa-images" style="color: green"></i><br><?=$image['image_name']?></td>
                         <td><?= $image['remarks'] ?></td>
                        <td><a href="<?= base_url('project/addRemarks/'.$image['id'].'/'.$image['project'])?>"><button class="btn btn-success">Add Remarks</button></a> <a href="<?= base_url('project/deleteImage/'.$image['id'].'/'.$image['project'])?>" onclick="return confirm('Are you sure you want to delete this data?')"><button class="btn btn-danger">Delete</button></a></td>
                      </tr>
                   <?php } endforeach; ?>

                </tbody>
                </table> -->
                <!-- <section>
                 <?php foreach($detail as $details):?>
                <ul style="list-style: none;">
                 <li>project Name :<?= $details['project_name'] ?></li>
                 <li>Task Name :<?= $details['task_name'] ?></li>
                 <li>Sub Task Name :<?= $details['sub_task_name']?></li>
                 <li>Super Sub Task Name :<?= $details['super_sub_task_name']?></li>
                 <li>Uploaded by :<?= $details['user_name']?></li>
                 <li>Remarks :<?= $details['remarks'] ?></li>
                 <li>Action :<a href="<?= base_url('project/addRemarks/'.$details['id'].'/'.$details['project'])?>"><button class="btn btn-default">Add Remarks</button></a> <a href="<?= base_url('project/deleteImage/'.$details['id'].'/'.$details['project'])?>" onclick="return confirm('Are you sure you want to delete this data?')"><button class="btn btn-default">Delete</button></a></li>
                </ul><br><br>
                <?php  endforeach; ?>
                </section>  -->
                <section>
                 <?php if(!empty($images)){ foreach($images as $image):if($image['type']=='image/png') { ?>
                    <figure class="figure">
                        <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($image['type']=='image/jpg') { ?>
                      <figure class="figure">
                        <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($image['type']=='image/jpeg') { ?>
                       <figure class="figure">
                        <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                     <?php } elseif($image['type']=='image/gif') { ?>
                       <figure class="figure">
                        <img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                   <?php } elseif($image['type']=='application/pdf') { ?>

                    <figure class="figure">
                      <a href="<?= base_url('uploads/'.$image['image_name'])?>" target="_blank"><i class="fa fa-file-pdf" style="font-size:140px;color:red; margin: 35px"></i></a>
                        <!--img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"--><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } elseif($image['type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document') { ?>

                    <figure class="figure">
                      <a href="<?= base_url('uploads/'.$image['image_name'])?>" target="_blank"><i class="fa fa-file-word" style="font-size:140px;color:lightblue; margin: 35px"></i></a>
                        <!--img src="<?= base_url('uploads/'.$image['image_name'])?>" width="200" height="150" style="object-fit:cover;margin:35px"--><figcaption class="figcaption text-center"><?=$image['image_name']?>
                         <a href="<?php echo base_url().'project/download/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                     <?php } elseif($image['type']=='capture/image') { ?>
                      <figure class="figure">
                        <img src="<?= $image['image_name']?>" width="200" height="150" style="object-fit:cover;margin:35px"><figcaption class="figcaption text-center">image
                         <a href="<?php echo base_url().'project/downloadcam/'.$image['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
                    </figure>
                    <?php } endforeach;} ?>
                </section>
            </div>
          </div>
        </div>
     </div>
   </div>
</div>
