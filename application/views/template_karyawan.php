<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?php echo $judul;?> | SKI Online</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10" style="margin-left:auto; margin-right:auto;">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url()?>assets/images/logo.png" alt="homepage" class="light-logo" style="width: 100px; height: 70px;"/>
                            
                        </b>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                               <img style="border-radius: 800px;" src="<?php echo $poto;?>" alt="user" width="35" ><?php echo nbs(4); echo $this->session->userdata('ses_nama');?><?php echo nbs(3);?> <i class="fas fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url()?>login/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                    
                       <li class="sidebar-item" style="padding-left: 10px;"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/" aria-expanded="false"><i class="fas fa-home"></i><?php echo nbs(2) ?><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item" style="padding-left: 10px;">



                            <?php  if ($status_pembuatan_ski == 0) {?>
                             <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/buat_ski" aria-expanded="false"><i class=" fas fa-list-alt"></i><?php echo nbs(2) ?><span class="hide-menu">Buat SKI <?php echo $thn ?></span></a>
                        
                            <?php } elseif ($status_pembuatan_ski != 0) {?>
                                <?php if($nm->buat_ski=='BARU'){ ?>
                                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/buat_ski"><i class="far fa-list-alt"></i><?php echo nbs(2) ?><span class="hide-menu"> Buat SKI Baru <?php echo $thn ?></a>
                                        <?php } else{ ?>
                            
                                <?php if (($status == 'TW1') OR ($status == 'TW2') OR ($status == 'TW3') OR ($status == 'TW4')): ?>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/penilaian_ski" aria-expanded="false">
                                    <?php if (count($data_status) != 0): ?>
                                        <?php if ($data_status->status != 'KIRIM'): ?>
                                        <i class="far fa-edit"></i><?php echo nbs(2) ?><span class="hide-menu"> Ubah Nilai SKI <?php echo $thn ?>
                                        <?php else : ?>
                                        <i class="fas fa-info"></i><?php echo nbs(2) ?><span class="hide-menu"> Preview Nilai SKI <?php echo $thn ?>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <i class="fas fa-list-alt"></i><?php echo nbs(2) ?><span class="hide-menu"> Buat Nilai SKI <?php echo $thn ?>
                                    <?php endif ?>
                                    </span></a>
                                <?php elseif ($status == 'SKI') :?>
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/ubah_ski" aria-expanded="false">
                                        <?php if ($nm->buat_ski != 'SUDAH'): ?>
                                            <i class="far fa-edit"></i><?php echo nbs(2) ?><span class="hide-menu"> Ubah SKI <?php echo $thn ?> 
                                        <?php else: ?> 
                                            <i class="fas fa-info"></i><?php echo nbs(2) ?><span class="hide-menu">Preview SKI <?php echo $thn ?>
                                            <?php endif ?></span></a>                                
                                <?php endif ?>
                                
                            <?php } } ?> 

                        </li>
                        <li class="sidebar-item" style="padding-left: 10px;"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/history_ski" aria-expanded="false"><i class="fas fa-history"></i><?php echo nbs(2) ?><span class="hide-menu">History SKI</span></a></li>
                        <?php if ($status == 'SKI'): ?>
                            <li class="sidebar-item" style="padding-left: 10px;"> 
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url() ?>karyawan/atasan_langsung" aria-expanded="false"><i class="fas fa-id-card-alt"></i><?php echo nbs(2) ?><span class="hide-menu">SKI Atasan</span></a></li>
                        <?php endif ?><hr>

                        <?php if($this->session->userdata('ses_role')=='Admin'|| $this->session->userdata('ses_role1')=='Admin'|| $this->session->userdata('ses_role2')=='Admin'){;?>
                        <li class="sidebar-item" style="padding-left: 10px;"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>admin" aria-expanded="false"><i class="fas fa-user-circle"></i><?php echo nbs(2) ?><span class="hide-menu">Halaman Akses Admin</span></a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('ses_role')=='Atasan'|| $this->session->userdata('ses_role1')=='Atasan'|| $this->session->userdata('ses_role2')=='Atasan') { ?>
                        <li class="sidebar-item" style="padding-left: 10px;"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>atasan1" aria-expanded="false"><i class="fas fa-user-plus"></i><?php echo nbs(2) ?><span class="hide-menu">Halaman Akses Atasan</span></a></li>
                    <?php } ?>
                         
                   </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="alert alert-danger" role="alert" style="text-align: center; margin-bottom: -10px; margin-top: -5px;" >
                    <table border="0" align="center" style="margin-bottom: -10px; margin-top: -10px;">
                        <tr id="waktu">
                            <td style="padding-top: 10px;"><h5 style="font-size: 20px; font-weight: bold;">Batas akhir submit <?php echo $status; ?> tahun <?php echo $thn; echo nbs(2) ?>:<?php echo nbs() ?></h5></td>
                            <td style="padding-top: 10px;"><h5 id="time" style="color:red;font-size: 20px; font-weight:bold ;"></h5></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php echo $contents; ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                <div class="card-body">
                <div class="col-md-12" style="margin-bottom: -30px;">
                Copyright <i class="fas fa-copyright"></i>  <?= date('Y') ?> PT. Industri Telekomunikasi Indonesia
                </div>
                </div>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
   <script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url()?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url()?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url()?>dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="<?php echo base_url()?>dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?php echo base_url()?>assets/libs/flot/excanvas.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?php echo base_url()?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url()?>dist/js/pages/chart/chart-page-init.js"></script>
    <script src="<?php echo base_url()?>assets/extra-libs/DataTables/datatables.min.js"></script>



     <script type="text/javascript">
        //  Target pertahun sama nilainya dengan TW4
        function simpan_nilai(id) {
          var r = $("#target_pertahun"+id).val();  
            
            $("#tw4"+id).val(r);
                
        }
        //  Target pertahun sama nilainya dengan TW4
        function simpan_nilai_sla(id) {
          var r = $("#target_pertahun_sla"+id).val();  
            
            $("#tw4_sla"+id).val(r);
                
        }
    </script>

    <!-- JAVASCRIPT PENILAIAN SKI -->

    <script type="text/javascript">

        function hitung(id) {
          var m = 0;

          var nilai_maksimal_utama = $(".nilai_maksimal_utama"+id).val();

            var r = $(".realisasi"+id).val();
            var t = $(".target"+id).val();
            var b = $(".bobot"+id).val();
            var n = (parseInt(r)/parseInt(t))*parseInt(b);
            var v = parseInt(r);

            if (!isNaN(n))  
            {

                if ( v <= nilai_maksimal_utama) {

                    $(".nilai_utama"+id).val(n); 

                }
                 else {
                
                 $(".nilai_utama"+id).val(n);
                  $('#modal_form').modal('show'); 
                  $('.modal-label').text('Nilai Maksimal '+nilai_maksimal_utama+'%'); 
                  $('.modal-title').text('Nilai Realisasi Lebih dari '+nilai_maksimal_utama+'%'); 
                  $('#simpan').hide();
                  $('#submit').hide();
                  $(".realisasi"+id).val(m);
                }

            } else {
                $(".nilai_utama"+id).val(m);
                $('#simpan').show();
                $('#submit').show();
            }
          


    }

    function hitung_sla(id) {
        var m = 0;

          var nilai_maksimal_sla = $(".nilai_maksimal_sla"+id).val();

          var r = $(".realisasi_sla"+id).val();
          var t = $(".target_sla"+id).val();         
          var b = $(".bobot_sla"+id).val();
          var n = (parseInt(r)/parseInt(t))*parseInt(b);
          var v = parseInt(r);

           if (!isNaN(n))  
            {
                if (v <= nilai_maksimal_sla) {
                    $(".nilai_sla"+id).val(n);
                } else {
                    $(".nilai_sla"+id).val(n);
                    $('#modal_form').modal('show'); 
                    $('.modal-label').text('Total Nilai Harus '+nilai_maksimal_sla+'%'); 
                    $('.modal-title').text('Total Nilai Kurang dari '+nilai_maksimal_sla+'%'); 
                    $('#simpan').hide();
                    $('#submit').hide();
                    $(".realisasi_sla"+id).val(m);
                }
            } else {
                $(".nilai_sla"+id).val(m);
                $('#simpan').show();
                $('#submit').show();
            } 
      }

    /*function tot_nilai()
    {
        var a = $("#tot_nilai_tw").val();
        var b = $("#tot_penalty").val();
        var n = (parseInt(a)+parseInt(b));

        $("#total_nilai_ski").val(n);
    }*/


      $(document).ready(function(e) {
   
        $("input").keyup( function() {
          var sub_tot_nilai_utama = 0;
          $("input[id=nilai_utama").each(function() {
            sub_tot_nilai_utama = sub_tot_nilai_utama + parseFloat($(this).val());
          })

          var sub_tot_nilai_sla = 0;
          $("input[id=nilai_sla").each(function() {
            sub_tot_nilai_sla = sub_tot_nilai_sla + parseFloat($(this).val());
          })

          var tot_nilai = 0;
          tot_nilai = sub_tot_nilai_utama + sub_tot_nilai_sla;

          if (!isNaN(tot_nilai)) 
                {
                    $("input[class=nilai]").val(tot_nilai);
                }
          
        });
      });

      $(document).ready(function(e) {
   
    $("input").keyup( function() {

      var tot_nilai = 0;
      var a = $("input[id=tot_nilai_tw]").val();
      var b = $("input[id=tot_penalty]").val();
      tot_nilai = parseFloat(a) + parseFloat(b);

      if (!isNaN(tot_nilai)) 
            {
                $("input[id=total_nilai_ski]").val(tot_nilai);
            }
      
    });
  });



    </script>

    <!-- JAVASCRIPT UBAH SKI -->

    <script type="text/javascript">
        $(document).ready(function(e) {
   
    $("input").keyup( function() {
      var sub_tot_utama = 0;
      $("input[id=bobot_utama").each(function() {
        sub_tot_utama = sub_tot_utama + parseInt($(this).val());
      })

      var sub_tot_sla = 0;
      $("input[id=bobot_sla]").each(function() {
        sub_tot_sla = sub_tot_sla + parseInt($(this).val());
      })

      var tol_bot = 0;
      tol_bot = sub_tot_utama + sub_tot_sla;

      if (!isNaN(tol_bot)) 
            {
                $("input[name=total_bobot]").val(tol_bot);
            }
      
    });
  });
    </script>

    <!-- JAVASCRIPT BUAT SKI -->

    <script type="text/javascript">

     function tampil(){
    var url;
 
    var a = $(".total_bobot").val();
    if (a < 100 ) {
        $('#modal_form').modal('show'); 
        $('.modal-label').text('Total Bobot Harus 100%'); 
        $('.modal-title').text('Total Bobot Kurang dari 100%'); 
      }else if(a > 100){
          $('#modal_form').modal('show');
          $('.modal-label').text(' Total Bobot Harus 100%'); 
          $('.modal-title').text('Total Bobot Lebih dari 100%'); 
      } else {
        $('#simpan').hide();
        $('#kirim').hide();

        url = "<?php echo site_url('karyawan/tambah_ski')?>";

      }
        

      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          url = "<?php echo site_url('karyawan/ubah_ski')?>";
          window.location.href=url;
        }
      });

  }

    // fungsi simpan_nilai_tw untuk menyimpan realisasi nilai triwulan
    function simpan_nilai_tw(){
        var url = "<?php echo site_url('karyawan/tambah_nilai_tw')?>";

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              url = "<?php echo site_url('karyawan/penilaian_ski')?>";
              window.location.href=url;
            }
          });

    }

    // fungsi simpan_nilai_tw untuk menyimpan realisasi nilai triwulan
    function simpan_ubah_nilai_tw(){
        var url = "<?php echo site_url('karyawan/tambah_ubah_nilai_tw')?>";

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              url = "<?php echo site_url('karyawan/penilaian_ski')?>";
              window.location.href=url;
            }
          });

    }

    // fungsi submit_nilai_tw untuk menyimpan realisasi nilai triwulan
    function submit_nilai_tw(){
         if(confirm('Apakah yakin akan mengirim Data Penilaian SKI ?'))
            {
            var url = "<?php echo site_url('karyawan/kirim_nilai_tw')?>";

              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  url = "<?php echo site_url('karyawan/penilaian_ski')?>";
                  window.location.href=url;
                }
              });
            }
    }

    // fungsi submit_nilai_tw untuk menyimpan realisasi nilai triwulan
    function submit_ubah_nilai_tw(){
         if(confirm('Apakah yakin akan mengirim Data Penilaian SKI ?'))
            {
            var url = "<?php echo site_url('karyawan/kirim_ubah_nilai_tw')?>";

              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  url = "<?php echo site_url('karyawan/penilaian_ski')?>";
                  window.location.href=url;
                }
              });
            }
    }

    function tampil_ubah(){
         var url;
 
          var a = $(".total_bobot").val();
          if (a < 100 ) {
              $('#modal_form').modal('show'); 
              $('.modal-label').text('Total Bobot Harus 100%'); 
              $('.modal-title').text('Total Bobot Kurang dari 100%'); 
            }else if(a > 100){
                $('#modal_form').modal('show');
                $('.modal-label').text(' Total Bobot Harus 100%'); 
                $('.modal-title').text('Total Bobot Lebih dari 100%'); 
            } else{
            $('#update').hide();
            $('#kirim').hide();

               url = "<?php echo site_url('karyawan/ubah_nilai')?>";
            }
        

         $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                 url = "<?php echo site_url('karyawan/ubah_ski')?>";

                 window.location.href=url;
                }
            });

        }

        function tampil_submit(id){
         if(confirm('Apakah yakin akan mengirim Data Penetapan SKI ?'))
            {
                var url;
 
              var a = $(".total_bobot").val();
              if (a < 100 ) {
                  $('#modal_form').modal('show'); 
                  $('.modal-label').text('Total Bobot Harus 100%'); 
                  $('.modal-title').text('Total Bobot Kurang dari 100%'); 
                }else if(a > 100){
                    $('#modal_form').modal('show');
                    $('.modal-label').text(' Total Bobot Harus 100%'); 
                    $('.modal-title').text('Total Bobot Lebih dari 100%'); 
                } else{
                    $('#update').hide();
                    $('#kirim').hide();

                   url = "<?php echo site_url('karyawan/submit_nilai')?>/"+id;
                }

                // ajax delete data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        
                       url = "<?php echo site_url('karyawan/ubah_ski')?>";

                        window.location.href=url;
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Tidak Berhasil Kirim Data');
                    }
                });
         
            }

        }

        function submit_langsung(){
         if(confirm('Apakah yakin akan mengirim Data Penetapan SKI ?'))
            {
                var url;
 
              var a = $(".total_bobot").val();
              if (a < 100 ) {
                  $('#modal_form').modal('show'); 
                  $('.modal-label').text('Total Bobot Harus 100%'); 
                  $('.modal-title').text('Total Bobot Kurang dari 100%'); 
                }else if(a > 100){
                    $('#modal_form').modal('show');
                    $('.modal-label').text(' Total Bobot Harus 100%'); 
                    $('.modal-title').text('Total Bobot Lebih dari 100%'); 
                } else{
                    $('#simpan').hide();
                    $('#kirim').hide();

                   url = "<?php echo site_url('karyawan/submit_nilai_langsung')?>";
                }

                // ajax delete data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        
                       url = "<?php echo site_url('karyawan/ubah_ski')?>";

                        window.location.href=url;
                    }
                });
         
            }

        }

        function submit_real(){
         var url;
 
               url = "<?php echo site_url('karyawan/submit_real_nilai')?>";

            

         $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                 url = "<?php echo site_url('karyawan/penilaian_ski')?>";

                 window.location.href=url;
                }
            });


        }
    



        /*************************************************************************************/  


        $(document).ready(function(e) {
           
            $("input").keyup( function() {
              var sub_tot_utama = 0;
              $("input[id=bobot_utama").each(function() {
                sub_tot_utama = sub_tot_utama + parseInt($(this).val());
              })

              var sub_tot_sla = 0;
              $("input[id=bobot_sla]").each(function() {
                sub_tot_sla = sub_tot_sla + parseInt($(this).val());
              })

              var tol_bot = 0;
              tol_bot = sub_tot_utama + sub_tot_sla;

              if (!isNaN(tol_bot)) 
                    {
                        $("input[name=total_bobot]").val(tol_bot);
                    }
              
            });
          });

       
</script>

<script type="text/javascript">
     /***********************************************************
             M E N A M P I L K A N --- COUNT DOWN DATE 
    ***********************************************************/

    var tgl_selesai = new Date("<?php echo $tst; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() { 

        // Get todays date and time
        var tgl_mulai = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = tgl_selesai - tgl_mulai;

        // Time calculation for days, hours, minutes, and date
        var days    = Math.floor(distance / (1000*60*60*24));
        var hours   = Math.floor( (distance % (1000*60*60*24)) / (1000*60*60) );
        var minutes = Math.floor( (distance % (1000*60*60)) / (1000*60) ); 
        var seconds = Math.floor( (distance % (1000*60)) / 1000);

        // output the result in an element with id="time"
        document.getElementById("time").innerHTML = days +" Hari "+ hours +" Jam "+ minutes +" Menit "+ seconds +" Detik ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("waktu").innerHTML = "<h2 style='color: red; margin-top:5px;'><center>Batas Waktu Submit <?php echo $status; ?> Sudah Habis</center></h2>";
        }

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("tutup").innerHTML = "<div class='alert alert-warning' role='alert'><h3 style='text-align: center;'><?php echo $status; ?> TELAH DITUTUP!</h3></div>";
        } 


    }, 1000);

    /*function kelap_kelip() {

    $('#waktu').fadeOut();
    $('#waktu').fadeIn();

    }

    setInterval(kelap_kelip, 1000);*/

    /***********************************************************
           SELESAI M E N A M P I L K A N --- COUNT DOWN DATE 
    ***********************************************************/

 

     table = $('#table_history').DataTable({ 


 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('karyawan/get_data_history')?>",
                "type": "POST"
            },
     
            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            ],
 
        });

</script>


</body>

</html>