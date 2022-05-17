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
		<figcaption class="figcaption text-center"><?=$files['image_name']?>
			<a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
	</figure>
	<?php } elseif($files['type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document') { ?>

	<figure class="figure">
		<a href="<?= base_url('uploads/'.$files['image_name'])?>"><i class="fa fa-file-word" style="font-size:140px;color:lightblue; margin: 35px"></i></a>
		<figcaption class="figcaption text-center"><?=$files['image_name']?>
			<a href="<?php echo base_url().'document/download/'.$files['id']; ?>" class=""><i class="fa fa-download" style="color: gray"></i></a></figcaption>
	</figure> 
<?php } endforeach;} ?>
