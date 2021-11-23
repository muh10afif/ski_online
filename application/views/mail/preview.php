<!DOCTYPE html>
<html>
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
    <title> Preview SKI </title>
    <style type="text/css">
      th {
          text-align: center;
          font-weight: bold;
          font-size: 15px;
      }
      label {
        font-weight: bold;
      }
    </style>
  </head>
<body>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
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

                 <table class="table table-responsive table-hover table-bordered" >
                  <thead class="thead-light">
                      <tr>
                        <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                        <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                        <th colspan="2" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                        <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                        <th rowspan="2" style="vertical-align: middle;"><strong> Bobot </strong></th>
                        <th style="vertical-align: middle;"><strong> Target </strong></th>
                        <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                        <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                      </tr>
                      <tr>
                        <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                        <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                        <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                      </tr>
                    </thead>

            <form action="#" id="form"  method="POST">

                    <?php $no=0; foreach ($data_utama_nilai as $utama ) : $no++?>

                    <tr>
                      <td style="text-align: center; font-weight: bold;">UTAMA</td>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td style="text-align: justify;"><?= $utama->nama_indikator ?> </td>
                      <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                      <td style="text-align: center;"><?php echo $utama->target_pertahun ?></td>
                      <td style="text-align: center;"><?php echo $utama->bobot?> %</td>
                      <td style="text-align: center;"><?php echo $utama->nilai_penetapan ?></td>
                      <td style="text-align: center;"><?php echo $utama->realisasi ?></td>
                      <td style="text-align: center;"><?php echo $utama->nilai_realisasi ?></td>
                    </tr> 

                    <?php endforeach ?>

                    <?php  $no=0; foreach($data_sla_nilai as $sla ) : $no++ ?>

                    <tr>
                      <td style="text-align: center; font-weight: bold;">SLA</td>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td style="text-align: justify;"><?= $sla->nama_indikator ?></td>
                      <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                      <td style="text-align: center;"><?php echo $sla->target_pertahun ?></td>
                      <td style="text-align: center;"><?php echo $sla->bobot ?> %</td>
                      <td style="text-align: center;"><?php echo $sla->nilai_penetapan ?> </td>
                      <td style="text-align: center;"><?php echo $sla->realisasi ?></td>
                      <td style="text-align: center;"><?php echo $sla->nilai_realisasi ?></td>
                    </tr>

                    <?php endforeach ?>

          </form>

                    <tr>
                      <td colspan="5" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Bobot Target Utama dan SLA</td>
                      <td style="text-align: center; font-weight: bolder; font-size: 15px;">100 %</td>
                      <td colspan="2" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI <?php echo $status ?></td>
                      <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php echo $sla->total_realisasi ?></td>
                    </tr> 

                    <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                    <tr>
                      <td style="text-align: center; font-weight: bold;">PENALTY</td>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td style="text-align: justify-all;"><?= $dtp->nama_indikator ?></td>
                      <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                      <td style="text-align: center;"><?= $dtp->TARGET_PERTAHUN ?></td>
                      <td style="text-align: center;"><?= $dtp->BOBOT ?> %</td>
                      <td style="text-align: center;"><?= $dtp->NILAI_PENETAPAN ?></td>
                      <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                      <td style="text-align: center;"><?= $dtp->NILAI_REALISASI ?></td>
                    </tr> 

                    <?php endforeach ?>
                    <tr>
                      <td colspan="5" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Bobot Target Penalty</td>
                      <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php echo $dtp->TOTAL_BOBOT ?> %</td>
                      <td colspan="2" style="text-align: right; font-weight: bolder; font-size: 15px; padding: 5px; vertical-align: middle;">Total Nilai Penalty <?php echo $status; ?></td>
                      <td style="text-align: center;font-weight: bolder; font-size: 15px;"><?php echo $dtp->TOTAL_NILAI ?></td>
                    </tr> 
                    <tr>
                      <td colspan="9">
                        <a style="float:right" class="btn btn-primary" href="<?php echo base_url()?>ski_mail/print_tw/<?php echo encrypt_url($nipeg).'/'.encrypt_url($status_tw).'/'.encrypt_url($tahun)?>">
                           <i class="mdi mdi-printer"></i> Print</button>
                        </a>
                      </td>
                    </tr>
                </table>

        </div>
      </div>
    </div>  
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="background: transparent;">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  style="background-color:rgba(255,255,255,0.7); border-radius: 10px;">
        <div class="modal-header">
          <h6 class="modal-label"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body form" style=" background-color:rgba(255,255,255,0.4);">
          <h4 class="modal-title" align="center" style="color: red;"></h4>        
        </div>
        
        <div class="modal-footer">
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog --> 
</div>
<!-- Akhir modal -->

</body>
</html>

