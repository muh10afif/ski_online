<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>/assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
		<link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
		<link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">
				<title>Login SKI Online</title>
    </head>
    <body>
        <div class="container login-container">
            <div class="logo" style="width:200px; margin-left:auto; margin-right:auto; margin-top:2%;">
                <IMG SRC="<?php echo base_url();?>assets/images/logo.png" width="120px;">
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-6 login-form-1" style="padding-right:10%;">
                   <IMG  class="gambarpanah"SRC="<?php echo base_url();?>assets/images/sasaran.png" width="250px;" style="float:right;">                    
                </div>
                <div class="col-md-4 login-form-2" style="padding-top:5%;">
                    <b><span style="color:#1E90FF; text-align: center;"><h1>Sign In</h1></span></b><br>
                    <form action="<?php echo base_url().'login/auth'?>" method="post">
						<?php echo $this->session->flashdata('msg');?>
                        <div class="form-group">
                            <span style="color:#1E90FF">E-MAIL</span>
                                <input type="text" class="form-control" style="width:75%; float:right;" placeholder="Your e_mail *" name="e_mail" />
                        </div><br>
                        <div class="form-group">
                            <input type="submit" style="margin-left:50%;" class="btn btn-default" value="L O G I N" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
      <!-- jquery nya-->
        <script type="text/javascript" src="<?php echo base_url('assets/jqueri/jquery-3.2.1.min.js'); ?>"></script>   
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatabel/js/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatabel/js/dataTables.bootstrap.js'); ?>"></script>
      <!-- penghang -->
      <style type="text/css">
      @media (max-width: 768px) {
         .gambarpanah{
            display: none;
        }
      </style>
</html>