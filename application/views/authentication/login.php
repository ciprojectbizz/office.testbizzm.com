
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>LOGIN</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <link rel="stylesheet" href="<?= base_url();?>assets/authentication/css/login.css">
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
 
        </head>
        <body>
        <div class="container px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
<div class="card card0 border-0">
<div class="row d-flex">
<div class="col-lg-6">
<div class="card1 pb-5">
<div class="row"> <img src="<?= base_url();?>assets/authentication/images/logo.png" class="logo"> </div>
<div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="<?= base_url();?>assets/authentication/images/banner.png" class="image"> </div>
</div>
</div>
<div class="col-lg-6">

<div class="card2 card border-0 px-4 py-5">
<form id="login-form" method="POST" action="<?= base_url('authentication/post_login')?>">
        <div class="row px-3 mb-5">
        
        </div>
<div class="row px-3"> <label class="mb-10">
    <h6 class="mb-0 text-sm">Username</h6>
</label> <input class="mb-4" type="text" name="username" placeholder="Enter username"> </div>
<div class="row px-3"> <label class="mb-1">
    <h6 class="mb-0 text-sm">Password</h6>
</label> <input type="password" name="password" placeholder="Enter password"> </div>

<div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>
<div class="row mb-3 px-3"> <div id="" class="popup_error" style="font-size: 13px;color:#CC0000;"></div> </div>
<!--div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger ">Register</a></small> </div-->
</form>
</div>
</div>
</div>
<div class="bg-blue py-4">
<p class="text-center">Developed By BizzmanWeb</p>
</div>
</div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript">
        $(function ()
        {
         
            $('.popup_error').hide();
            $('form#login-form').submit(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o)
                {

                  if (o.result == 1)
                    {   
                       
                        window.location.assign('<?= base_url();?>dashboard');
                       
                    }
                  else if (o.result == 0)
                    { 
                   
                       $('.popup_error').show().html('All fields are Mandatory').delay(3000).fadeOut('slow');
                    } 
                  else if(o.result == 2)
                  {
                   
                    $('.popup_error').show().html('Invalid Username or Password').delay(3000).fadeOut('slow');
                  }
                  else
                  {
                    $('.popup_error').show().html('Internal Server Error').delay(3000).fadeOut('slow');
                  }  

                }, 'json');
            });
         

        });
    </script>
        
        
        </body>
    </html>