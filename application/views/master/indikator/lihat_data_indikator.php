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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/favicon.png">
    <title>SKI ONLINE</title>
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
    <style type="text/css">
        th {
            text-align: center;
            font-size: 15px;
        }
        tr {
            font-size: 15px;
        }
    </style>
</head>
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
        <h2 class="page-title">Data Indikator</h2>
        <div class="ml-auto text-right">
        <button type="button" class="btn btn-primary" style="margin-right: 10px; font-weight: initial;" onclick="Tambah_indikator()" ><i class="fas fa-plus-circle"></i><?= nbs(3) ?>T A M B A H - D A T A</button>
        </div>
        </div>
    </div>

        <?php echo br() ?>
        <div class="table-responsive">
            <?php echo $this->session->flashdata('msg'); ?>
            <table id="table_indikator" class="table table-bordered table-hover" align="center" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th><strong> NO </strong></th>
                        <th><strong> INDIKATOR </strong></th>
                        <th><strong> PROKER </strong></th>
                        <th><strong> CARA PENGUKURAN </strong></th>
                        <th><strong> DELIVERABLE </strong></th>
                        <th><strong> AKSI </strong></th>
                    </tr>
                </thead>            
            </table>
        </div>
    </div>  
</div>




<div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="mediumModalLabel" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
        <div class="modal-header">
        
        <h3 class="modal-title">Tambah Data Indikator</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
         <input type="hidden" value="" name="id_indikator"/>

                             <!--- SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1
-->

                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;">Nama Indikator</label>
                                        <div class="col-sm-9">

                                            <textarea class="form-control" rows="3" placeholder="Nama Indikator" name="nama_indikator"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;">Satuan Indikator</label>
                                        <div class="col-sm-9">

                                            <input class="form-control" placeholder="Satuan Indikator" style="width: 30%;" name="satuan_indikator">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;"> Program Kerja</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="id_proker" style="width: 30%;" >
                                            
                                            <option>Pilih - Proker</option>
                                            
                                            <?php    foreach ($nama_proker as $nm): ?>
                                            <option  value="<?php echo $nm->id_proker; ?>"> <?php echo $nm->nama_proker; ?></option>                                             
                                            <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;">Cara Pengukuran</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="4" placeholder="Cara Pengukuran" name="cara_pengukuran"></textarea>
                                        </div>
                                    </div>
                                
                                 <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;">Deliverable</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" placeholder="Deliverable" name="deliverable"></textarea>
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-left control-label col-form-label" style="padding-left: 50px;">Nilai Maksimal</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nilai_maksimal" style="width: 30%;" class="form-control" value="0">
                                    </div>
                                </div>



                     
        </form>
           
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C L O S E</button><?php echo nbs(4) ?>
            <button type="button" id="btnSave" onclick="action_indikator()"class="btn btn-success"><i class="fas fa-check"></i><?= nbs(3) ?>S A V E</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

