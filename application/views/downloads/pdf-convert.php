<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
</head>

 <?php foreach($images as $image): ?>
 <table style="width: 100%">
 	        <thead>
                <tr>
                  	<th>File Upload</th>
                    <th>project Name</th>
                    <th>Task Name</th>
                    <th>Sub Task Name</th>
                    <th>Super Sub Task Name</th>
                    <th>Uploaded by</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
   <tr>
	<td>
    <img src="<?= base_url('uploads/'.$image['image_name'])?>" height="150" width="150"  alt="" style="margin-left:-10px; text-align:right" > </td>
    <td ><?= $image['project_name']; ?></td>
    <td ><?= $image['task_name']; ?></td>
    <td><?= $image['sub_task_name']; ?></td>
    <td ><?= $image['super_sub_task_name']; ?></td>
    <td><?= $image['user_name']; ?></td>
    <td><?= $image['remarks']; ?></td>
  </tr>  
  </tbody>
  </table>
 <?php endforeach; ?>
                    </body>
                </html>