  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0; background-color: #00b0bb; color:#fff">
    <!-- Left navbar links -->
    <!--<img src="https://www.bizzmanweb.com/wp-content/themes/bizzman/img/bizzman-logo.png" alt="logo" class="brand-image  elevation-3" style="opacity: .8; box-shadow: none !important;">-->
		<img src="<?= base_url('uploads/bizzman-logo.png')?>" alt="logo" class="brand-image  elevation-3" style="opacity: .8; box-shadow: none !important;">
    <ul class="navbar-nav">
  
      <!--li class="nav-item">
        <a class="nav-link" data-widget="" href="#" role="button"> <img src="https://image.flaticon.com/icons/png/512/3135/3135771.png" alt="logo" class="brand-image  elevation-3" style="opacity: .8; width: 80px; height: 50px; object-fit: cover">office management </a>
      </li-->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('dashboard')?>" class="nav-link" style="color:#fff">
            
              <p>
                Dashboard
              </p>
            </a>
      </li>
       <li class="nav-item d-none d-sm-inline-block">
 <a href="<?php echo base_url('employer')?>" class="nav-link" style="color:#fff">
           
              <p>
                Company
              </p>
            </a>

       </li>
       <li class="nav-item d-none d-sm-inline-block">
  <a href="<?php echo base_url('employee')?>" class="nav-link" style="color:#fff">
             
                Employee
              </p>
            </a>


       </li>
       <?php if($this->session->userdata('user')=='1') {?>
       <li class="nav-item d-none d-sm-inline-block">

          <a href="<?= base_url('group')?>" class="nav-link" style="color:#fff">
         
              <p>
                Group
              </p>
            </a>
       </li>
       <!--li class="nav-item d-none d-sm-inline-block">
 <a href="<?= base_url('task')?>" class="nav-link" style="color:#fff">
             
              <p>
                Task
              </p>
            </a>

       </li-->
     
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('project')?>" class="nav-link" style="color:#fff">
             
              <p>
							Task
              </p>
            </a>

        </li>
				<?php } ?>
        <li class="nav-item d-none d-sm-inline-block">
<a href="<?= base_url('document/view_details')?>" class="nav-link" style="color:#fff">
               
              <p>
                Document Management
              </p>
            </a>
          
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


      <li class="nav-item">
        <a class="nav-link" onclick="return confirm('Are you sure you want to logout?')"  href="<?= base_url('authentication/logout')?>" role="button">
          <button class="btn btn-default">Logout</button>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
