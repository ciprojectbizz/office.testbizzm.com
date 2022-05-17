<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
</head>
<body style="width: 600px;">
<style>
    
    body{
        margin: 0;
        padding: 0;
        /* background-image:url(https://city.bizzmanweb.com/images/company/company-logo.jpg);*/
        /*width: 400px;*/
        /*height: 200px;*/
        /*background-repeat: repeat;*/
    }
    .box1{
        width: 255px;
        height: 369px;
        display: inline-block;
    }
    .box1-text{
      display: inline-block;
        vertical-align: top;
        margin-top: 10rem;
        padding-left: 15px;
    }
     .box2{
        width: 288px;
        height: 432px;
        display: inline-block;
    }
     .box2-text{
      display: inline-block;
        vertical-align: top;
        margin-top: 10rem;
        padding-left: 15px;
    }
    .img-responsive{
        max-width: 100%;
        height: auto;
    }
    .site-logo{
       
        
    }
    </style>
    <div class="site-logo" style="float: right; text-align: right;">
        <img src="https://city.bizzmanweb.com/images/company/company-logo.jpg" width="120" height="75"  alt="" />
    </div>

    




    <?php
        foreach($images as $image):
        if($image['type']=="3R") {?>


    <div class="box1" style="margin-left: 10px; margin-top: -120px;" >
                    
        <table style="width:100%">
  <tr>
    <td><img style="display: inline-block; float:left;" src="<?= base_url('images/'.$image['image_name'])?>" height="336" width="480"  alt=""  /></td>
    <td><?= $image['tag']; ?></td>
    <td><?= $image['remarks']; ?></td>
  </tr>
</table>
    </div>

   

    
    <?php

    } elseif($image['type']=="4R") { 
    ?>

    <div class="box2" style="margin-left: -90px; margin-top: -120px;">
                    
        <table style="width:100%">
  <tr>
    <td><img style="display: inline-block; float:left;" src="<?= base_url('images/'.$image['image_name'])?>" height="384" width="576" alt="" /></td>
    <td><?= $image['tag']; ?></td>
    <td><?= $image['remarks']; ?></td>
  </tr>

</table>
    </div>

    <br>


    <?php 

    } elseif($image['type']=="5R") { 
    ?>

    <div class="box2" style="margin-left: -90px; margin-top: -120px;">
        <table style="width:100%">
  <tr>
    <td><img style="display: inline-block; float:left;" src="<?= base_url('images/'.$image['image_name'])?>" height="480" width="672" alt="" /></td>
    <td><?= $image['tag']; ?></td>
    <td><?= $image['remarks']; ?></td>
  </tr>

</table>
                    
    </div>

    <br>


    <?php }
        endforeach; 

    ?>

                    </body>
                </html>