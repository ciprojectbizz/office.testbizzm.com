<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title_for_layout; ?></title>

  <?php $this->load->view('layout/stylesheets'); ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url(); ?>assets/dist/img/Cube-1s-90px.gif" alt="bizzman-logo">
  </div>

  <?php $this->load->view('layout/navbar'); ?>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 d-none">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
       <img src="https://image.flaticon.com/icons/png/512/3135/3135771.png" alt="logo" class="brand-image  elevation-3" style="opacity: .8"> 
      <span class="brand-text font-weight-light">Office Management</span>
    </a>

    <?php $this->load->view('layout/sidebar'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <?php echo $content_for_layout ?>
  <!-- /.content-wrapper -->
  <?php $this->load->view('layout/footer'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('layout/scripts'); ?>
</body>
</html>
