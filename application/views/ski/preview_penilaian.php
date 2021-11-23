<!DOCTYPE html>
<html>
<head>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">
    <title>SKI ONLINE</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">    
    <link href="<?php echo base_url()?>assets/libs/bootstrap-timepicker/bootstrap-datetimepicker.css" rel="stylesheet">    

    <link href="<?php echo base_url()?>assets/libs/jquery/dist/jquery-ui.css" rel="stylesheet"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
</head>
<body>

<div class="row">
  <div class="col-md-12" style="padding-left:100px;">
      <div class="form-group row">
        <label class="col-sm-2 control-label col-form-label">Nama </label>
        <label class="col-sm-4 control-label col-form-label">:&nbsp;&nbsp;&nbsp;&nbsp;<?= $data_karyawan['NAMA'] ?></label>
        <label class="col-sm-2 control-label col-form-label">Jabatan</label>
        <label class="col-sm-4 control-label col-form-label">:&nbsp;&nbsp;&nbsp;&nbsp;<?= $data_karyawan['JOBTITLE'] ?></label>
        <label class="col-sm-2 control-label col-form-label">NIP</label>
        <label class="col-sm-4 control-label col-form-label">:&nbsp;&nbsp;&nbsp;&nbsp;<?= $data_karyawan['NIPEG'] ?></label>
        <label class="col-sm-2 control-label col-form-label">Divisi</label>
        <label class="col-sm-4 control-label col-form-label">:&nbsp;&nbsp;&nbsp;&nbsp;<?= $data_karyawan['DIVISI'] ?></label>
        <label class="col-sm-2 control-label col-form-label">Pangkat</label>
        <label class="col-sm-4 control-label col-form-label">:&nbsp;&nbsp;&nbsp;&nbsp;<?= $data_karyawan['PANGKAT'] ?></label>
      </div>
          <br>
      <div class="container">
        <table class="table table-responsive" >
          <thead>
            <tr>
              <th rowspan="2">Target</th>
              <th rowspan="2">NO</th>
              <th colspan="2">Sasaran Kerja</th>  
              <th rowspan="2">Bobot (%)</th>
              <th>Target</th>
              <th rowspan="2">Realisasi</th>
              <th rowspan="2">Nilai</th>
              <th rowspan="2">Nilai Maksimal</th>
            </tr>
            <tr>
              <th>Indikator</th>
              <th>Satuan Indikator</th>
              <th><?php echo $status ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php foreach ($nama_karyawan as $nm) : ?>
                <input type="hidden" value="<?= $nm->NIPEG ?>" name="NIPEG[]" >
              <?php endforeach ?>

              <?php $no=0; foreach ($data_target_utama as $utama ) : $no++?>
            
              <td>UTAMA</td>
              <td><?= $no; ?></td>
              <td><?= $utama->nama_indikator ?> </td>
              <td style="text-align: center;">%</td>
              <td style="text-align: center;"><?php echo $utama->bobot; ?></td>
              
              <td><?php echo $utama->nilai_penetapan ?></td>
              <td><?php echo $utama->realisasi ?></td>
              <td style="text-align: center;"><?php echo $utama->nilai_realisasi ?></td>
              <td><?php echo $utama->nilai_maksimal ?></td>
            </tr> <?php endforeach ?>
            <tr>
              <td colspan="9"></td>
            </tr>
            <tr>
              <?php  $no=0; foreach($data_target_sla as $sla ) : $no++ ?>
              <td>SLA</td>
              <td><?= $no; ?></td>
              <td><?= $utama->nama_indikator ?> </td>
              <td style="text-align: center;">%</td>
              <td style="text-align: center;"><?php echo $utama->bobot; ?></td>
              
              <td><?php echo $utama->nilai_penetapan ?></td>
              <td><?php echo $utama->realisasi ?></td>
              <td style="text-align: center;"><?php echo $utama->nilai_realisasi ?></td>
              <td><?php echo $utama->nilai_maksimal ?></td>                     
            </tr> 
            <tr>
              <td colspan="7" style="text-align: right;">Total Nilai <?php echo $status ?></td>
              <td style="text-align: center;"><?php echo $utama->total_realisasi ?></td>
            </tr> 
          <?php endforeach ?>
            <tr>
              <td colspan="9" style="text-align: right;"><a href="<?php echo base_url('ski_mail/print/'.$nipeg.'/'.$tw.'/'.$year)?>"><button class="btn btn-default"><i class="mdi mdi-printer"></i> Print</button></a></td>
            </tr> 
          </tbody>               
        </table> 
      </div>
  </div>
</div>

<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>

</body>
</html>

