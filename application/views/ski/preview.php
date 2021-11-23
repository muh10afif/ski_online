<!DOCTYPE html>
<html>
<head>
    <title> Ubah SKI </title>
    <style type="text/css">
        th {
            text-align: center;
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
                <div class="form">
               
                <table class="table table-responsive" >
                  <thead>
                    <tr>
                    <th  rowspan="2">Target</th>
                        <th rowspan="2">NO</th>
                    <th colspan="2" > Sasaran Kerja</th>                        
                        <th rowspan="2">Bobot (%)</th>
                    <th colspan="4">Target</th>
                    <th rowspan="2">Pengukuran Sasaran Kerja</th>
                    </tr>
                    <tr>
                        <th>Indikator</th>
                        <th>Satuan Indikator</th>
                        <th>TW I</th>
                        <th>TW II</th>
                        <th>TW III</th>
                        <th>TW IV</th>
                    </tr>
                    <tr>
                    <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                   <?php foreach ($nama_karyawan as $nm) : ?>
                      <input type="hidden" value="<?= $nm->NIPEG ?>" name="NIPEG[]" >
                    <?php endforeach ?>

                     
 
                  <?php  $no=0; 
                    foreach ($data_target_utama as $tu ) :
                      $no++
                  ?>
                   <td rowspan ="">UTAMA</td>
                    <td><?php echo $no;?></td>
                    <td><input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]"><?= $tu->nama_indikator ?></td>
                    <td style="text-align: center;">%</td>
                    <td><?= $tu->bobot ?>%</td>
                    <td><?= $tu->tw1 ?>%</td>
                    <td><?= $tu->tw2 ?>%</td>
                    <td><?= $tu->tw3 ?>%</td>
                    <td><?= $tu->tw4 ?>%</td>
                    <td><?= $tu->cara_pengukuran ?></td>
                    </tr>
                    <tr>
                  <?php endforeach  ?>
                    </tr>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
      
                  <?php $no=0; 
                    foreach ($data_target_sla as $ts ) : 
                      $no++ ?>
                    <tr>
                        <td>SLA</td>
                    <td><?= $no; ?></td>
                    <td><input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]"><?= $ts->nama_indikator ?></td>
                    <td style="text-align: center;">%</td>
                    
                    <td><?= $ts->bobot ?>%</td>
                    <td><?php echo $ts->tw1 ?>%</td>
                    <td><?php echo $ts->tw2 ?>%</td>
                    <td><?php echo $ts->tw3 ?>%</td>
                    <td><?php echo$ts->tw4 ?>%</td>
                    <td><?= $ts->cara_pengukuran ?></td>
                    </tr>     <?php endforeach ?>
                  
                  <tr>
                    <td colspan="10">
                       <?php if($nomor==null){ ?>
                             <a href="<?php echo base_url('karyawan/ubah_ski');?>">  <button type="button" class="btn btn-info"  >Kembali</button></td>
                       <?php } else{?>
                            <a href="<?php echo base_url('master/buat_ski_kadiv');?>">  <button type="button" class="btn btn-info"  >Kembali</button></td>
                       <?php }?>
                   
                    </td>
                  </tr>

                </table>
              </div>
            </div>
        </div>
       
    </div>
</div>


</body>
</html>

