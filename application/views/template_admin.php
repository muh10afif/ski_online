<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">
    <title><?php echo $judul;?> | SKI Online</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/libs/select2/dist/css/select2.min.css">
    <link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">    
    <link href="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.css" rel="stylesheet">    

    <link href="<?php echo base_url()?>assets/libs/jquery/dist/jquery-ui.css" rel="stylesheet"> 

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>admin/index" aria-expanded="false"><i class="fas fa-home"></i><?php echo nbs(2) ?><span class="hide-menu">Dashboard</span></a></li>
                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>admin/status_ski_karyawan" aria-expanded="false"><i class="fas fa-chart-bar"></i><?php echo nbs(2) ?><span class="hide-menu">Status SKI Karyawan</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-database"></i><?php echo nbs(2) ?><span class="hide-menu">Data Master</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?= base_url()?>master/karyawan" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Karyawan </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/hak_akses" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Hak Akses </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/indikator" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Indikator </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/direktori" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Direktori </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/penalty" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Penalty </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/status_karyawan" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> Status Karyawan </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url()?>master/buat_ski_baru" class="sidebar-link"><i class=" fas fa-server"></i><?php echo nbs(2) ?><span class="hide-menu"> SKI Baru </span></a></li>
                            </ul>
                        </li>  
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>master/tampil_status" aria-expanded="false"><i class="fas fa-clock"></i><?php echo nbs(2) ?><span class="hide-menu">Status Pembukaan SKI</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-book"></i><?php echo nbs(2) ?><span class="hide-menu">Buat SKI Penalty</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo base_url()?>master/penetapan_penalty" class="sidebar-link"><i class="fas fa-th-large"></i><?php echo nbs(2) ?><span class="hide-menu">Penetapan Penalty </span></a></li>
                                <ul class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-database"></i><?php echo nbs(2) ?><span class="hide-menu"> Penilaian Penalty </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>master/penilaian_penalty/TW1" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 1 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>master/penilaian_penalty/TW2" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 2 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>master/penilaian_penalty/TW3" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 3 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>master/penilaian_penalty/TW4" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 4 </span></a></li>
                                    </ul>
                                </ul>  
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-book"></i><?php echo nbs(2) ?><span class="hide-menu">Buat SKI Karyawan</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo base_url()?>Master/penetapan_karyawan" class="sidebar-link"><i class="fas fa-th-large"></i><?php echo nbs(2) ?><span class="hide-menu">Penetapan SKI </span></a></li>
                                <ul class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-database"></i><?php echo nbs(2) ?><span class="hide-menu"> Penilaian SKI </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>Master/penilaian_karyawan/TW1" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 1 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>Master/penilaian_karyawan/TW2" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 2 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>Master/penilaian_karyawan/TW3" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 3 </span></a></li>
                                        <li class="sidebar-item"><a href="<?php echo base_url()?>Master/penilaian_karyawan/TW4" class="sidebar-link"><i class="fas fa-circle-notch"></i><?php echo nbs(2) ?><span class="hide-menu"> TRIWULAN 4 </span></a></li>
                                    </ul>
                                </ul>  
                            </ul>
                        </li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>master/buatkan_ski_karyawan" aria-expanded="false"><i class="fas fa-pencil-alt"></i><?php echo nbs(2) ?><span class="hide-menu">Buatkan SKI Karyawan</span></a></li> -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>admin/histori_karyawan" aria-expanded="false"><i class="fas fa-history"></i><?php echo nbs(2) ?><span class="hide-menu">History SKI Karyawan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>admin/rekap_data" aria-expanded="false"><i class="fas fa-history"></i><?php echo nbs(2) ?><span class="hide-menu">Rekap Data</span></a></li><hr>
                    <?php if($this->session->userdata('ses_role')=='Atasan'|| $this->session->userdata('ses_role1')=='Atasan'|| $this->session->userdata('ses_role2')=='Atasan'){;?>
                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>atasan1" aria-expanded="false"><i class="fas fa-user-plus"></i><?php echo nbs(2) ?><span class="hide-menu">Halaman Akses Atasan</span></a></li>
                    <?php } else{}?>  
                    <?php if($this->session->userdata('ses_role')=='Karyawan'|| $this->session->userdata('ses_role1')=='Karyawan'|| $this->session->userdata('ses_role2')=='Karyawan'){;?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url()?>karyawan" aria-expanded="false"><i class="fas fa-user"></i><?php echo nbs(2) ?><span class="hide-menu">Halaman Akses Karyawan</span></a></li>
                    <?php }?> 
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
                    <table border="0" align="center" style="margin-bottom: -10px; margin-top: -10px;" id="waktu">
                        <tr>
                            <td style="padding-top: 10px;"><h5 style="font-size: 20px; font-weight: bold;" >Batas akhir submit <?php echo $status; ?> tahun <?php echo $thn; echo nbs(2) ?>:<?php echo nbs() ?></h5></td>
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
    <!-- ============================================================== -->
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

    <script src="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.js"></script>

    <script src="<?php echo base_url()?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url()?>dist/js/pages/mask/mask.init.js"></script>

    <script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/select2/dist/js/select2.min.js"></script>  

    <script src="<?php echo base_url()?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
   
    
<script type="text/javascript">
    
</script>
<script type="text/javascript">
   

    $('#tb_pen_kadiv_blm_').DataTable();
    $('#tb_pen_kadiv_ubah').DataTable();
    $('#tb_pen_kadiv_sdh').DataTable();

    table = $('#tb_pen_kadiv_blm').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('Master/get_pen_kadiv_blm')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
 
        });

    table = $('#table_status_karyawan').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('master/get_status_data_karyawan')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
 
        });

    //bagian untuk menampilkan rekap data
  
    $(document).ready(function () {
            var tab;

                 tab = $('#rekap_data').DataTable({ 
                
                        "processing": true, 
                        "serverSide": true, 
                        "order": [], 
                         
                            "ajax": {
                                "url": " <?php echo site_url('Admin/ajax_rekap_data')?> ",

                                "type": "POST",
                                "data":function(data) {
                                        data.tahun = $('#tahun').val();
                                        data.tw = $('#tw').val();
                                },
                            },
     
                 
                            "columnDefs": [
                            { 
                                "targets": [ 0 ], 
                                "orderable": false, 
                            },
                            ]
                
                     });

                      $('#tampilkan').on('click change', function (event) {
                                event.preventDefault();
                                tab.draw();
                      } );

                } ); 

    $(".select2").select2();
    
         /*----------------------------------------------------------
           M E N A M P I L K A N --- DATE TIME PICKER 
    -----------------------------------------------------------*/

        $(function () 
        {
            $('.datetimepicker').datetimepicker(
            {
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            });
        });


        $(function () 
        {
            $('.datetimepicker2').datetimepicker(
            {
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            });
        });

        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years"
        });

          ///------------------- bagian dashboard ---------------------------------------///


        $('#table_status').DataTable();

        var stat;
        //penutup variable indikator

        function Sudah_ski(){
            stat  = 'sudahski';
            $('#form')[0].reset();
            $('#modal_sudah_ski').modal('show');
            $('.modal-title').text(' Cek yang Sudah Ski'); 
        }

        function Belum_ski(){
            stat  = 'belumski';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Belum Ski'); 
        }
        
        function Sudah_penilaian(){
            stat  = 'sudahpenilaian';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Sudah Penilaian'); 
        }

        function Belum_penilaian(){
            stat  = 'belumpenilaian';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Belum Penilaian'); 
        }

 ///-------------------Penutup bagian dashboard ---------------------------------------///

    $('#tb_penalty_blm').DataTable();
    $('#tb_penalty_sdh').DataTable();
    $('#tb_penalty_kirim').DataTable();

    /*----------------------------------------------------------
          SELESAI M E N A M P I L K A N --- DATE TIME PICKER 
    -----------------------------------------------------------*/

      

        $('#tabel').DataTable();

    // Javascript reload data master karyawan
     function reload_data()
        {
            if(confirm('Apakah yakin akan reload data ?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('master/tambah_karyawan')?>",
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error reload data');
                    }
                });
         
            }
        }

    $('#tb_details_karyawan').DataTable();

        
      
    /*----------------------------------------------------------
            FUNGSI INI ADALAH UNTUK BAGIAN INDIKATOR
    -----------------------------------------------------------*/
        //variable indikator
        var save_method;
        var table;
        //penutup variable indikator
//variable divisi
       var modal_div;
        var table_div;
        //penutup variable indikator

        function Tambah_indikator(){
            save_method = 'add';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Tambah Data Indikator'); 
        }



        function edit_indikator(id)
        {
                save_method = 'update';
                $('#form')[0].reset(); 
             
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('master/ambil_data_ajax_inidikator')?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {

                       //SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1

                        $('[name="id_indikator"]').val(data.id_indikator);
                        $('[name="nama_indikator"]').val(data.nama_indikator);
                        $('[name="satuan_indikator"]').val(data.satuan_indikator);
                        $('[name="id_proker"]').val(data.id_proker);
                        $('[name="cara_pengukuran"]').val(data.cara_pengukuran);
                        $('[name="deliverable"]').val(data.deliverable);
                        $('[name="nilai_maksimal"]').val(data.nilai_maksimal);


                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Data Indikator'); // Set title to Bootstrap modal title
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
         }


        ///------------------- delete indikator -------------------------///
        function delete_indikator(id)
        {
            if(confirm('Apakah yakin akan menghapus data ini ?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('master/delete_indikator')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
         
            }
        }

        ///------------------- penutup delete indikator -----------------------///
        

        ///------------------- Action indikator -------------------------------///

        
        function action_indikator(){
                var url;
 
                if(save_method == 'add') {
                    url = "<?php echo site_url('master/tambah_indikator')?>";

                } else {
                    url = "<?php echo site_url('master/ubah_data_ajax_inidikator')?>";
                
                }

         $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error: function(jqXHR,textStatus, errorThrown){
                    alert('error Tambah / update');
                }
            });


        }


        ///------------------- Penutup Action indikator -------------------------------///

        $(document).ready(function() { 
        $('#table_indikator').DataTable(

        { 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('master/ajax_data_indikator')?>",
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
    });

    ///------------------- Table Server Side Table Direktori -------------------------------///

    //bagian history di admin 
    $(document).ready(function () {
        var tab = $('#tb_direktori').DataTable({ 
                
                    "processing": true, 
                    "serverSide": true, 
                    "order": [], 
                     
                        "ajax": {
                            "url": " <?php echo site_url('Master/get_data_jobtitle')?> ",

                            "type": "POST",
                            "data":function(data) {
                                    data.jobtitle = $('#jobtitle').val();
                            },
                        },
     
                 
                        "columnDefs": [
                        { 
                            "targets": [ 0 ], 
                            "orderable": false, 
                        },
                        ]
                
                     });


                  $('#tampilkan').on('click change', function (event) {
                            event.preventDefault();
                            tab.draw();
                  } );

    } ); 


    $('#tb_direktori_sudah').DataTable();
     
    $('#tb_direktori_belum').DataTable();

    // server side master penalty per divisi
     $(document).ready(function () {
        var tab = $('#tb_penalty_div').DataTable({ 
                
                    "processing": true, 
                    "serverSide": true, 
                    "order": [], 
                     
                        "ajax": {
                            "url": " <?php echo site_url('Master/get_data_penalty_div')?> ",

                            "type": "POST",
                            "data":function(data) {
                                    data.divisi = $('#divisi').val();
                            },
                        },
     
                 
                        "columnDefs": [
                        { 
                            "targets": [ 0 ], 
                            "orderable": false, 
                        },
                        ]
                
                     });


                  $('#tampilkan').on('click change', function (event) {
                            event.preventDefault();
                            tab.draw();
                  } );

    } ); 

    /* //bagian DIREKTORI sudah di admin 
    $(document).ready(function () {
        var tab = $('#tb_direktori_sudah').DataTable({ 
                
                    "processing": true, 
                    "serverSide": true, 
                    "order": [], 
                     
                        "ajax": {
                            "url": " <?php echo site_url('Master/get_data_direktori_sudah')?> ",

                            "type": "POST",
                            "data":function(data) {
                                    data.divisi = $('#divisi').val();
                            },
                        },
     
                 
                        "columnDefs": [
                        { 
                            "targets": [ 0 ], 
                            "orderable": false, 
                        },
                        ]
                
                     });


                  $('#tampilkan_sudah').on('click change', function (event) {
                            event.preventDefault();
                            tab.draw();
                  } );

    } );  

    //bagian DIREKTORI belum di admin 
    $(document).ready(function () {
        var tab = $('#tb_direktori_belum').DataTable({ 
                
                    "processing": true, 
                    "serverSide": true, 
                    "order": [], 
                     
                        "ajax": {
                            "url": " <?php echo site_url('Master/get_data_direktori_belum')?> ",

                            "type": "POST",
                            "data":function(data) {
                                    data.divisi_blm = $('#divisi_blm').val();
                            },
                        },
     
                 
                        "columnDefs": [
                        { 
                            "targets": [ 0 ], 
                            "orderable": false, 
                        },
                        ]
                
                     });


                  $('#tampilkan_belum').on('click change', function (event) {
                            event.preventDefault();
                            tab.draw();
                  } );

    } ); */

    $('#tb_direktori_jobtitle').DataTable();
    $('#tb_tw').DataTable();
    $('#tb_tw_sdh').DataTable();

     function tambah_indikator_div()
        {
            var url = "<?php echo site_url('Master/tambah_indikator_div') ?>";

            $.ajax({
                url     : url,
                type    : "POST",
                data    : $('#form').serialize(), 
                dataType: "JSON",
                success : function(data)
                {
                    location.reload();
                },
                error   : function(jqXHR,textStatus, errorThrown){
                    alert('error !!!');
                }
            });
        }

        ///------------------- Penutup Table Server Side Table Direktori -------------------------------///


        /*----------------------------------------------------------
                        FUNGSI TAMBAH DIREKTORI
        -----------------------------------------------------------*/

        var save_method;

        function tambah_direktori()
        {
            var url = "<?php echo site_url('Master/tambah_direktori') ?>";

            $.ajax({
                url     : url,
                type    : "POST",
                data    : $('#form').serialize(), 
                dataType: "JSON",
                success : function(data)
                {
                    location.reload();
                },
                error   : function(jqXHR,textStatus, errorThrown){
                    alert('error !!!');
                }
            });
        }

        function action_direktori()
        {
            var url = "<?php echo site_url('Master/ubah_data_ajax_direktori') ?>";

            $.ajax({
                url     : url,
                type    : "POST",
                data    : $('#form1').serialize(), 
                dataType: "JSON",
                success : function(data)
                {
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error   : function(jqXHR,textStatus, errorThrown){
                    alert('error !!!');
                }
            });
        }



        function edit_direktori(id)
        {
                save_method = 'update';
             
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('Master/ambil_data_ajax_direktori')?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {

                        $('[name="direktori"]').val(data.id_direktori);
                        $('[name="indikator"]').val(data.id_indikator);


                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Data Direktori'); // Set title to Bootstrap modal title
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
         }


         ///------------------- delete direktori -------------------------///
        function delete_direktori(id)
        {
            if(confirm('Are you sure delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('Master/delete_direktori')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
         
            }
        }

        ///------------------- penutup delete direktori -----------------------///

    // tabel server-side Penalty
    table = $('#tb_penalty').DataTable({ 
     
                "processing": true, 
                "serverSide": true, 
                "order": [], 
                 
                "ajax": {
                    "url": "<?php echo site_url('Master/get_data_buat_penalty')?>",
                    "type": "POST"
                },
     
                 
                "columnDefs": [
                    { 
                        "targets": [ -1 ], 
                        "orderable": false, 
                    },
                ],
     
            });

    $('#tb_penalty_belum').DataTable();
    $('#tb_penalty_sudah').DataTable();

    function action_penalty_div()
        {
            var url = "<?php echo site_url('Master/ubah_data_ajax_pen_div') ?>";

            $.ajax({
                url     : url,
                type    : "POST",
                data    : $('#form1').serialize(), 
                dataType: "JSON",
                success : function(data)
                {
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error   : function(jqXHR,textStatus, errorThrown){
                    alert('error !!!');
                }
            });
        }

    function edit_penalty_div(id)
    {
            save_method = 'update';
         
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('Master/ambil_data_ajax_pen_div')?>/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id_indikator"]').val(data.id_indikator);
                    $('[name="nm_indikator"]').val(data.nama_indikator);


                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Data Indikator Penalty'); // Set title to Bootstrap modal title
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
     }

     ///------------------- delete indikator penalty -------------------------///
    function delete_penalty_div(id)
    {
        if(confirm('Apakah yakin akan menghapus data ini ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('Master/delete_pen_div')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
     
        }
    }

    ///------------------- penutup delete indikator penalty -----------------------///


    // fungsi untuk menduplikat form
    function copyForm(){
        $("#form-asli")
        .clone()
        .appendTo($("#form-dinamis"));
    }

    // hitung otomatis nilai penalty
    function hitung_nilai_1(id) {
          var r = $(".realisasi_1"+id).val();    
          var b = $(".bobot_1"+id).val();
           n = parseFloat(r)*parseFloat(b);

           var m = 0;
           if (!isNaN(n))  
            {
                 $(".nilai_1"+id).val(n);
            } else {
                $(".nilai_1"+id).val(m);
            } 
      }

    


    // hitung otomatis nilai total nilai Penalty
    $(document).ready(function(e) {
   
        $("input").keyup( function() {
          var penalty = 0;
          $("input[id=nilai_1").each(function() {
            penalty = penalty + parseFloat($(this).val());
          })


          if (!isNaN(penalty)) 
                {
                    $("input[id=total_nilai_1]").val(penalty);
                }
        });

    });

     //  Hitung otomatis nilai total bobot tidak di save pd tabel
    $(document).ready(function(e) {
   
        $("input").keyup( function() {
          var penalty = 0;
          $("input[id=nilai_1").each(function() {
            penalty = penalty + parseInt($(this).val());
          })


          if (!isNaN(penalty)) 
                {
                    $("input[id=total_1]").val(penalty);
                }
        });

    });



    //  Hitung otomatis nilai total bobot
    $(document).ready(function(e) {
   
        $("input").keyup( function() {
          var penalty = 0;
          $("input[id=bobot").each(function() {
            penalty = penalty + parseFloat($(this).val());
          })


          if (!isNaN(penalty)) 
                {
                    $("input[id=total_bobot]").val(penalty);
                }
        });

    }); 

    //  Hitung otomatis nilai total bobot tidak di save pd tabel
    $(document).ready(function(e) {
   
        $("input").keyup( function() {
          var penalty = 0;
          $("input[id=bobot").each(function() {
            penalty = penalty + parseInt($(this).val());
          })


          if (!isNaN(penalty)) 
                {
                    $("input[id=total]").val(penalty);
                }
        });

    });


    //  Target per tahun ke TW4
    // hitung otomatis nilai penalty
    function simpan_nilai(id) {
          var r = $("#target_pertahun"+id).val();  
            
            $("#tw4"+id).val(r);
            
      } 

    //  Target pertahun sama nilainya dengan TW4
        function simpan_nilai_sla(id) {
          var r = $("#target_pertahun_sla"+id).val();  
            
            $("#tw4_sla"+id).val(r);
                
        }       



    /*----------------------------------------------------------
          FUNGSI EDIT HAK AKSES
    -----------------------------------------------------------*/
	function edit_hak_akses(id)
        {
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('master/ambil_data_ajax_hak_akses')?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {

                       //SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1

                        $('[name="hak_akses"]').val(data.ROLE);
						$('[name="hak_akses1"]').val(data.ROLE1);
						$('[name="hak_akses2"]').val(data.ROLE2);
						$('[name="nipeg"]').val(data.NIPEG);


                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Data Hak Akses'); // Set title to Bootstrap modal title
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
         }
   
	 /*----------------------------------------------------------
            FUNGSI INI ADALAH UNTUK BAGIAN HAK AKSES
    -----------------------------------------------------------*/
	
	table = $('#hak').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('master/get_data_hak_akses')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
 
        });

    table = $('#ski_kadiv').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('master/get_data_buat_ski_kadiv')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
 
        });

table = $('#table_karyawan').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('master/get_data_karyawan')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
 
        });

        ///------------------- bagian dashboard ---------------------------------------///
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

      var tot_nilai_1 = 0;
      var a = $("input[id=tot_nilai_tw]").val();
      var b = $("input[id=tot_penalty]").val();
      tot_nilai_1 = parseFloat(a) + parseFloat(b);

      if (!isNaN(tot_nilai_1)) 
            {
                $("input[id=total_nilai_ski]").val(tot_nilai_1);
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
        sub_tot_utama = sub_tot_utama + parseFloat($(this).val());
      })

      var sub_tot_sla = 0;
      $("input[id=bobot_sla]").each(function() {
        sub_tot_sla = sub_tot_sla + parseFloat($(this).val());
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

        url = "<?php echo site_url('')?>";

      }
        

      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          url = "<?php echo site_url('master/ubah_ski/'.$no)?>";
          window.location.href=url;
        }
      });

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

               url = "<?php echo site_url('karyawan/ubah_nilai')?>";

            
            }
        

         $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                 url = "<?php echo site_url('master/ubah_ski/'.$no)?>";

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

                   url = "<?php echo site_url('karyawan/submit_nilai')?>/"+id;
                }

                // ajax delete data to database
                $.ajax({
                    url : url,
                    type: "POST",
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

                   url = "<?php echo site_url('master/submit_nilai_langsung')?>";
                }

                // ajax delete data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        
                       url = "<?php echo site_url('master/ubah_ski/'.$no)?>";

                        window.location.href=url;
                    }
                });
         
            }

        }


        /*************************************************************************************/  
   

</script>
<script type="text/javascript">
   //bagian history di admin 
      $(document).ready(function () {
            var tab;

                 tab = $('#histori').DataTable({ 
                
                        "processing": true, 
                        "serverSide": true, 
                        "order": [], 
                         
                            "ajax": {
                                "url": " <?php echo site_url('Admin/get_data_history_bag_admin')?> ",

                                "type": "POST",
                                "data":function(data) {
                                        data.divisi = $('#divisi').val();
                                },
                            },
     
                 
                            "columnDefs": [
                            { 
                                "targets": [ 0 ], 
                                "orderable": false, 
                            },
                            ]
                
                     });


                      $('#tampilkan').on('click change', function (event) {
                                event.preventDefault();
                                tab.draw();
                      } );

                } ); 

             var table = $('#table_histori_thn').DataTable();

    $(document).ready(function () {
            var tab;

                 tab = $('#penetapan_baru').DataTable({ 
                
                        "processing": true, 
                        "serverSide": true, 
                        "order": [], 
                         
                            "ajax": {
                                "url": " <?php echo site_url('master/get_karyawan')?> ",

                                "type": "POST",
                                "data":function(data) {
                                        data.divisi = $('#divisi').val();
                                },
                            },
     
                 
                            "columnDefs": [
                            { 
                                "targets": [ 0 ], 
                                "orderable": false, 
                            },
                            ]
                
                     });


                      $('#tampilkan').on('click change', function (event) {
                                event.preventDefault();
                                tab.draw();
                      } );

                } ); 
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
        var days    = Math.floor( distance / (1000*60*60*24));
        var hours   = Math.floor( (distance % (1000*60*60*24)) / (1000*60*60) );
        var minutes = Math.floor( (distance % (1000*60*60)) / (1000*60) ); 
        var seconds = Math.floor( (distance % (1000*60)) / 1000);

        // output the result in an element with id="time"
        document.getElementById("time").innerHTML = days +" Hari "+ hours +" Jam "+ minutes +" Menit "+ seconds +" Detik ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            /*document.getElementById("time").innerHTML = "<h3>SUDAH HABIS</h3>";*/
            document.getElementById("waktu").innerHTML = "<h2 style='color: red; margin-top:5px;'><center>Waktu batas Submit <?php echo $status; ?> Sudah Habis</center></h2>";
        }

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("tutup").innerHTML = "<div class='alert alert-warning' style='margin-top:30px;' role='alert'><h3 style='text-align: center; '>SKI / TW TELAH DITUTUP!</h3></div>";
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

        function lihat_waktu()
        {
            $('#modal_form').modal('show'); 
        }

</script>
</body>



</html>