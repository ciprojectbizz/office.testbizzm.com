<div class="container">
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
				<?php
      if(isset($arr)){
      	foreach($arr as $arrs){ ?>
 <li class="list-group-item">
 <a href="<?= base_url('dashboard/year_wise')?><?php echo $arrs->year; ?>"><?php echo $arrs->year; ?></a></li>
      <?php	}
      }
      ?>
 
</ul>
		</div>
		<div class="col-md-9">
			 <table id="example2" class="table table-bordered table-striped">
                  <thead style="background-color:#023047; color: #fff">
                  <tr>
                    <th>Company Id</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                  	 <?php
                  	if(isset($array)){
                    foreach($array as $arrays) { ?>
                      <tr style="background-color: #fff; color: #000">
                        <td><i class="fa fa-id-card"></i><?= $arrays['company_id']?></td>
                        <td><i class="fa fa-building"></i><?= $arrays['company_name']?></td>
                        <td><i class="fa fa-user"></i><?= $arrays['contact_person']?></td>
                        <td><i class="fa fa-envelope"></i><?= $arrays['email']?></td>
                        <td><i class="fa fa-envelope"></i><?= $arrays['created_at']?></td>
                     </tr>    
                      <?php } 
                  }?>
                 </tbody>
             </table>
		</div>
	</div>
</div>