<!DOCTYPE html>
<html>
<head>
  <title> Ubah SKI </title>
  <style type="text/css">
   th {
    text-align: center;
    font-size: 13px;
  }
  tbody {
    font-size: 13px;
  }
  </style>
</head>
<body>

<div class="row">
  <div class="col-12">
      <div class="card" >
          <div class="card-body"  id="row">
            <div class="row" style="margin-bottom: -40px; margin-top: -20px;">
                <div class="col-md-6">
                   <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" >
                              <table border="0" >
                                  <tr >
                                      <td style="width:100px"> <h5 >NAMA</h5></td>
                                      <td style="width:20px"><h5 >:</h5></td>
                                      <td><h5 ><?= $data_karyawan['NAMA'] ?></h5></td>
                                  </tr>
                                  <tr>
                                      <td><h5 >NIPEG</h5></td>
                                      <td><h5 >:</h5></td>
                                      <td><h5 ><?= $data_karyawan['NIPEG'] ?></h5></td>
                                  </tr>
                                  <tr>
                                      <td><h5 >PANGKAT</h5></td>
                                      <td><h5 >:</h5></td>
                                      <td><h5 ><?php $a = strtolower($data_karyawan['PANGKAT']); echo ucwords($a); ?></h5></td>
                                  </tr>
                              </table>
                            </div>
                        </div>
                     </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                           <div class="table-responsive" >
                              <table border="0" >
                                  <tr>
                                      <td style="width:100px"> <h5 >JABATAN</h5></td>
                                      <td style="width:20px"><h5 >:</h5></td>
                                      <td><h5 ><?php $a = strtolower($data_karyawan['JOBTITLE']); echo ucwords($a); ?></h5></td>
                                  </tr>
                                  <tr>
                                      <td><h5 >DIVISI</h5></td>
                                      <td><h5 >:</h5></td>
                                      <td><h5 ><?php $a = strtolower($data_karyawan['DIVISI']); echo ucwords($a); ?></h5></td>
                                  </tr>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>    
            </div>
                <br>
                <div class="form">

                <?php echo $this->session->flashdata('msg'); ?>

                <?php if ((count($data_target_utama) != 0) AND (count($data_target_sla) != 0)) { ?>
                  
                  <table class="table table-responsive table-hover table-bordered" >
                  <thead class="thead-light">
                  <tr>
                    <th colspan="10"><strong> TARGET UTAMA</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target Pertahun</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>TW I</strong></th>
                    <th style="vertical-align: middle;"><strong>TW II</strong></th>
                    <th style="vertical-align: middle;"><strong>TW III</strong></th>
                    <th style="vertical-align: middle;"><strong>TW IV</strong></th>
                  </tr>
                </thead>
                  
                    <form action="" id="form" class="form-horizontal" enctype="multipart/form-data">

                  <?php  $no=0; 
                    foreach ($data_target_utama as $tu ) :
                      $no++
                  ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td style="text-align: justify;">
                      <input type="hidden" name="NIPEG[]" value="<?= $tu->NIPEG ?>">
                      <input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $tu->id_nilai ?>" name="id_nilai[]"><?= $tu->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                    <td style="text-align: justify;"><?= $tu->cara_pengukuran ?></td>
                    <td style="text-align: center;"><input type="number" name="target_pertahun[]" value="<?php echo $tu->target_pertahun ?>" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                    <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->bobot ?>"></td>
                    <td><input type="number" name="tw1[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw1 ?>"></td>
                    <td><input type="number" name="tw2[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw2 ?>"></td>
                    <td><input type="number" name="tw3[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw3 ?>"></td>
                    <td style="text-align: center;"><input type="number"name="tw4[]" value="<?php echo $tu->tw4 ?>" id="tw4<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
                  </tr> <?php endforeach  ?>
                
                  <thead class="thead-light">
                  <tr>
                    <th colspan="10"><strong> TARGET SLA</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target Pertahun</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>TW I</strong></th>
                    <th style="vertical-align: middle;"><strong>TW II</strong></th>
                    <th style="vertical-align: middle;"><strong>TW III</strong></th>
                    <th style="vertical-align: middle;"><strong>TW IV</strong></th>
                  </tr>
                  </thead>

                  <?php 
                    $no=0; 
                    foreach ($data_target_sla as $ts ) : 
                      $no++ ?>
                  <tr>
                    
                    <td><?= $no; ?></td>
                    <td style="text-align: justify;">
                      <input type="hidden" name="NIPEG[]" value="<?= $ts->NIPEG ?>">
                      <input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $ts->id_nilai ?>" name="id_nilai[]"><?= $ts->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $ts->target_pertahun ?></td>
                    <td style="text-align: justify;"><?= $ts->cara_pengukuran ?></td>
                    <td style="text-align: center;"><input type="number" name="target_pertahun[]" value="<?php echo $ts->target_pertahun ?>" id="target_pertahun_sla<?php echo $no; ?>" style="text-align: center;width: 60px;" onkeyup="simpan_nilai_sla(<?= $no ?>)"></td>
                    <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->bobot ?>"></td>
                    <td><input type="number" name="tw1[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw1 ?>"></td>
                    <td><input type="number" name="tw2[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw2 ?>"></td>
                    <td><input type="number" name="tw3[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw3 ?>"></td>
                    <td style="text-align: center;"><input type="number" name="tw4[]" value="<?php echo $ts->tw4 ?>" id="tw4_sla<?php echo $no; ?>" style="text-align: center; width: 60px;"></td>
                  </tr>
                  <?php endforeach ?> </form>
                  <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
                    <td><input type="" id="total_bobot" class="total_bobot" name="total_bobot"  size="6" style="text-align: center;" value="100" readonly></td>
                    <td colspan="5"></td>
                  </tr>
                  <thead class="thead-light">
                   <tr>
                    <th colspan="10"><strong> TARGET PENALTY </strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target Pertahun</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>TW I</strong></th>
                    <th style="vertical-align: middle;"><strong>TW II</strong></th>
                    <th style="vertical-align: middle;"><strong>TW III</strong></th>
                    <th style="vertical-align: middle;"><strong>TW IV</strong></th>
                  </tr>
                </thead>
                <?php $no=0; foreach ($data_target_penalty as $p ) : $no++ ?>
                  <tr>
                    <td style="text-align: center;"><?= $no; ?></td>
                    <td style="text-align: justify;"><?= $p->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
                    <td style="text-align: justify;"><?= $p->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?= -$p->TARGET_PERTAHUN ?></td>
                    <td style="text-align: center;"><?= -$p->BOBOT ?>%</td>
                    <td style="text-align: center;"><?= -$p->TW1 ?></td>
                    <td style="text-align: center; "><?= -$p->TW2 ?></td>
                    <td style="text-align: center;"><?= -$p->TW3 ?></td>
                    <td style="text-align: center;"><?= -$p->TW4 ?></td>
                  </tr> 
                  <?php endforeach ?>
                  <tr>
                    <td colspan="5" style="text-align: right; font-size: 17px; font-weight: bold;">Total Bobot Target Penalty</td>
                    <td style="text-align: center; font-size: 17px; font-weight: bold; padding: 10px; vertical-align: middle;"><?php echo -$p->TOTAL_BOBOT ?>%</td>
                    <td colspan="4"></td>
                  </tr>

                </table><br>
                <table class="table" >
                  <tr>
                    <td>
                        <a href="<?php echo base_url();?>Atasan1/karyawan_penetapan/<?= $nm->NIPEG ?>"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a></td>
                    <td><?php echo $this->session->flashdata('msg'); ?></td>
                    <td align="right">
                        <?php if ($nm->approve != 'SUDAH'): ?>
                              <button type="button" id="save" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_ubah_penetapan()" data-toggle="tooltip" data-original-title="Tekan SAVE bila data ingin disimpan"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button>
                        <?php endif ?></td>
                  </tr>
                </table>  

               <?php } elseif ((count($data_target_utama) != 0) AND (count($data_target_sla) == 0)) { ?>
                  <table class="table table-responsive table-hover table-bordered" >
                  <thead class="thead-light">
                  <tr>
                    <th colspan="10"><strong> TARGET UTAMA</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                    <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                    <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong> Target Sampai Dengan </strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                    <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                    <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                    <th style="vertical-align: middle;"><strong> TW I </strong></th>
                    <th style="vertical-align: middle;"><strong> TW II </strong></th>
                    <th style="vertical-align: middle;"><strong> TW III </strong></th>
                    <th style="vertical-align: middle;"><strong> TW IV </strong></th>
                  </tr>
                </thead>
                <tbody>
                    <form action="" id="form" class="form-horizontal" enctype="multipart/form-data">

                  <?php  $no=0; 
                    foreach ($data_target_utama as $tu ) :
                      $no++
                  ?>
                    <tr>
                    <td style="text-align: center;"><?php echo $no;?></td>
                    <td style="text-align: ;">
                      <input type="hidden" name="NIPEG[]" value="<?= $tu->NIPEG ?>">
                      <input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $tu->id_nilai ?>" name="id_nilai[]"><?= $tu->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                    <td style="text-align: ;"><?= $tu->cara_pengukuran ?></td>
                    <td style="text-align: center;"><input type="number" name="target_pertahun[]" value="<?php echo $tu->target_pertahun ?>" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                    <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->bobot ?>"></td>
                    <td><input type="number" name="tw1[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw1 ?>"></td>
                    <td><input type="number" name="tw2[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw2 ?>"></td>
                    <td><input type="number" name="tw3[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $tu->tw3 ?>"></td>
                    <td style="text-align: center;"><input type="number"name="tw4[]" value="<?php echo $tu->tw4 ?>" id="tw4<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
                  </tr> <?php endforeach  ?> </form>
                  <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
                    <td><input type="" id="total_bobot" class="total_bobot" name="total_bobot"  size="6" style="text-align: center;" value="100" readonly></td>
                    <td colspan="4" style="font-weight: bold; color: red; font-size: 17px">* Total Bobot harus 100 %</td>
                  </tr>
                </tbody>
                  <thead class="thead-light">
                   <tr>
                    <th colspan="10"><strong> TARGET PENALTY </strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                    <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                    <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong> Target Sampai Dengan </strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                    <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                    <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                    <th style="vertical-align: middle;"><strong> TW I </strong></th>
                    <th style="vertical-align: middle;"><strong> TW II </strong></th>
                    <th style="vertical-align: middle;"><strong> TW III </strong></th>
                    <th style="vertical-align: middle;"><strong> TW IV </strong></th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=0; foreach ($data_target_penalty as $p ) : $no++ ?>
                  <tr>
                    <td style="text-align: center;">  <?= $no ?></td>
                    <td style="text-align: ;"> <?= $p->nama_indikator ?></td>
                    <td style="text-align: center;">  <?= $p->satuan_indikator ?></td>
                    <td style="text-align: ;"> <?= $p->cara_pengukuran ?></td>
                    <td style="text-align: center;">  <?= -$p->TARGET_PERTAHUN ?></td>
                    <td style="text-align: center;">  <?= -$p->BOBOT ?>%</td>
                    <td style="text-align: center;">  <?= -$p->TW1 ?></td>
                    <td style="text-align: center;">  <?= -$p->TW2 ?></td>
                    <td style="text-align: center;">  <?= -$p->TW3 ?></td>
                    <td style="text-align: center;">  <?= -$p->TW4 ?></td>
                    
                  </tr> 
                  <?php endforeach ?>
                  <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot Penalty</td>
                    <td style="text-align: center;font-weight: bold;font-size: 17px;"><?= -$p->TOTAL_BOBOT ?>%</td>
                    <td colspan="4"></td>
                  </tr>
                </tbody>
                </table><br>
                <table class="table" >
                  <tr>
                    <td>
                        <a href="<?php echo base_url();?>Atasan1/karyawan_penetapan/<?= $nm->NIPEG ?>"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a></td>
                    <td><?php echo $this->session->flashdata('msg'); ?></td>
                    <td align="right">
                        <?php if ($nm->approve != 'SUDAH'): ?>
                              <button type="button" id="save" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_ubah_penetapan()" data-toggle="tooltip" data-original-title="Tekan SAVE bila data ingin disimpan"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button>
                        <?php endif ?></td>
                  </tr>
                </table>

                <?php } elseif ((count($data_target_utama) == 0) AND (count($data_target_sla) != 0)) { ?>

                <table class="table table-responsive table-hover table-bordered">
                  <thead class="thead-light">
                  <tr>
                    <th colspan="10"><strong> TARGET SLA</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target Pertahun</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>TW I</strong></th>
                    <th style="vertical-align: middle;"><strong>TW II</strong></th>
                    <th style="vertical-align: middle;"><strong>TW III</strong></th>
                    <th style="vertical-align: middle;"><strong>TW IV</strong></th>
                  </tr>
                  </thead>
                  <form action="" id="form" class="form-horizontal" enctype="multipart/form-data">

                  <?php 
                    $no=0; 
                    foreach ($data_target_sla as $ts ) : 
                      $no++ ?>
                  <tr>
                    
                    <td><?= $no; ?></td>
                    <td>
                      <input type="hidden" name="NIPEG[]" value="<?= $ts->NIPEG ?>">
                      <input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $ts->id_nilai ?>" name="id_nilai[]"><?= $ts->nama_indikator ?></td>
                    <td style="text-align: center;">%</td>
                    <td style="text-align: justify;"><?= $ts->cara_pengukuran ?></td>
                    <td style="text-align: center;"><input type="number" name="target_pertahun[]" value="<?php echo $ts->target_pertahun ?>" id="target_pertahun_sla<?php echo $no; ?>" style="text-align: center;width: 60px;" onkeyup="simpan_nilai_sla(<?= $no ?>)"></td>
                    <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->bobot ?>"></td>
                    <td><input type="number" name="tw1[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw1 ?>"></td>
                    <td><input type="number" name="tw2[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw2 ?>"></td>
                    <td><input type="number" name="tw3[]" size="5" style="text-align: center; width: 60px;" value="<?php echo $ts->tw3 ?>"></td>
                    <td style="text-align: center;"><input type="number" name="tw4[]" value="<?php echo $ts->tw4 ?>" id="tw4_sla<?php echo $no; ?>" style="text-align: center; width: 60px;"></td>
                  </tr>
                  <?php endforeach ?> </form>
                  <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
                    <td><input type="" id="total_bobot" class="total_bobot" name="total_bobot"  size="6" style="text-align: center;" value="100" readonly></td>
                    <td colspan="4"></td>
                  </tr>
                  <thead class="thead-light">
                   <tr>
                    <th colspan="10"><strong> TARGET PENALTY </strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target Pertahun</strong></th>                    
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>TW I</strong></th>
                    <th style="vertical-align: middle;"><strong>TW II</strong></th>
                    <th style="vertical-align: middle;"><strong>TW III</strong></th>
                    <th style="vertical-align: middle;"><strong>TW IV</strong></th>
                  </tr>
                </thead>
                <?php $no=0; foreach ($data_target_penalty as $p ) : $no++ ?>
                  <tr>
                    <td style="text-align: center;"><?= $no; ?></td>
                    <td style="text-align: justify;"><?= $p->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
                    <td style="text-align: justify;"><?= $p->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?= -$p->TARGET_PERTAHUN ?></td>
                    <td style="text-align: center;"><?= -$p->BOBOT ?>%</td>
                    <td style="text-align: center;"><?= -$p->TW1 ?></td>
                    <td style="text-align: center; "><?= -$p->TW2 ?></td>
                    <td style="text-align: center;"><?= -$p->TW3 ?></td>
                    <td style="text-align: center;"><?= -$p->TW4 ?></td>
                  </tr> 
                  <?php endforeach ?>
                  <tr>
                    <td colspan="5" style="text-align: right; font-size: 17px; font-weight: bold;">Total Bobot Target Penalty</td>
                    <td style="text-align: center; font-size: 17px; font-weight: bold; padding: 10px; vertical-align: middle;"><?php echo -$p->TOTAL_BOBOT ?>%</td>
                    <td colspan="4"></td>
                  </tr>
                </table><br>
                <table class="table" >
                  <tr>
                   <td>
                        <a href="<?php echo base_url();?>Atasan1/karyawan_penetapan/<?= $nm->NIPEG ?>"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a></td>
                    <td><?php echo $this->session->flashdata('msg'); ?></td>
                    <td align="right">
                        <?php if ($nm->approve != 'SUDAH'): ?>
                              <button type="button" id="save" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_ubah_penetapan()" data-toggle="tooltip" data-original-title="Tekan SAVE bila data ingin disimpan perubahannya"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button>
                        <?php endif ?></td>
                  </tr>
                </table>  

                <?php } ?>  
                
              </div>
          </div>
      </div>
       
  </div>
</div>



<div class="modal fade" id="modal_form" role="dialog" style="background: transparent;">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  style=" background-color:rgba(255,255,255,0.7);
  border-radius: 10px;">
      
        <div class="modal-header">
        

        <h6 class="modal-label"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form" style=" background-color:rgba(255,255,255,0.4);">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
         <input type="hidden" value="" name="id_indikator"/>

        <h4 class="modal-title" align="center" style="color: red;">Tambah Data Indikator</h4>

        </form>
           
          </div>
          <div class="modal-footer">
            
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>
</html>

