<!DOCTYPE html>
<html>
<head>
  <title> Ubah SKI </title>
  <style type="text/css">
    th {
        text-align: center;
        font-weight: bold;
        font-size: 13px;
    }
    label {
      font-weight: bold;
    }
    td {
      font-size: 13px;
    }
  </style>
</head>
<body>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="row"  style="margin-bottom: -40px; margin-top: -20px;">
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

      <?php if ($buat_tw != "kadiv"): ?>

              <?php if (count($data_target_penalty) != 0) : ?>
          
          <?php if (count($status_nilai) != 0) : ?>

                <?php if ($status_nilai->status != 'SIMPAN') : ?>

                    
                    <div class="alert alert-success" role="alert">
                        <h3 style="text-align: center;"> Terimakasih telah mengisi penilaian SKI <?php echo $status ?> tahun <?php echo $thn ?> </h3>
                    </div>

                     <table class="table table-responsive table-hover table-bordered" >
                      <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                <form action="#" id="form"  method="POST">

                        <?php $no=0; foreach ($data_utama_nilai as $utama ) : $no++?>
                        <?php $nilai_maks = $utama->total_realisasi ?>
                        <tr>
                          <td style="text-align: center; font-weight: bold;">UTAMA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td style="text-align: ;"><?= $utama->nama_indikator ?> </td>
                          <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                          <td><?php echo $utama->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?php echo $utama->target_pertahun ?></td>
                          <td style="text-align: center;"><?php echo $utama->bobot?>%</td>
                          <td style="text-align: center;"><?php echo $utama->nilai_penetapan ?></td>
                          <td style="text-align: center;"><?php echo $utama->realisasi;  ?></td>
                          <td style="text-align: center;">
                            <?php 

                            $tu = $utama->nilai_realisasi; 
                            $posisi=strpos($tu,".");
                            if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $utama->nilai_realisasi; 
                              }
                              ?>%
                          </td>
                        </tr> 
                        <?php $nilai_ski = $utama->nilai_ski ?>

                        <?php endforeach ?>

                        <?php  $no=0; foreach($data_sla_nilai as $sla ) : $no++ ?>
                        <?php $nilai_maks = $sla->total_realisasi ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">SLA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td style="text-align: ;"><?= $sla->nama_indikator ?></td>
                          <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                          <td><?php echo $sla->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?php echo $sla->target_pertahun ?></td>
                          <td style="text-align: center;"><?php echo $sla->bobot ?>%</td>
                          <td style="text-align: center;"><?php echo $sla->nilai_penetapan ?></td>
                          <td style="text-align: center;"><?php echo $sla->realisasi ?></td>
                          <td style="text-align: center;">
                            <?php 
                            
                            $tu = $sla->nilai_realisasi; 
                            $posisi=strpos($tu,".");
                            if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $sla->nilai_realisasi; 
                              }
                              ?>%
                          </td>
                        </tr>
                         <?php $nilai_ski = $sla->nilai_ski ?>

                        <?php endforeach ?>

              </form>

                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                            <?php if (!empty($data_utama_nilai) && empty($data_sla_nilai)): ?>
                              Total SKI Utama <?= $status ?>                                                             
                            <?php elseif (empty($data_target_utama_tw1) && !empty($data_target_sla_tw1)): ?>
                              Total SKI SLA <?= $status ?>
                            <?php else: ?>
                              Total SKI Utama + SLA <?= $status ?>
                            <?php endif ?>
                          </td>
                          <td style="text-align: center; font-weight: bolder; font-size: 15px;">
                            <?php 
                            
                            $tu = $nilai_maks; 
                            $posisi=strpos($tu,".");
                            if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $nilai_maks; 
                              }
                              ?>%
                          </td>
                        </tr> 
                        <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                        <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">PENALTY</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                          <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                          <td><?php echo $dtp->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                          <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                          <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                          <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                          <td style="text-align: center;">
                            <?php 
                              $tu = $dtp->NILAI_REALISASI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->NILAI_REALISASI; 
                              }
                              ?>%
                          </td>
                        </tr> 

                        <?php endforeach ?>
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; vertical-align: middle;">Total Penalty <?= $status ?></td>
                          <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                          <?php 
                            
                            $tu = $dtp->TOTAL_NILAI; 
                            $posisi=strpos($tu,".");
                            if ($posisi != 0) {
                              $sub_kalimat = substr($tu,$posisi,3);
                              $sub_kalimat = substr($tu,$posisi,3);
                              $a = substr($tu,0,$posisi);
                              echo $a.$sub_kalimat;
                            } else {
                              echo $dtp->TOTAL_NILAI; 
                            }

                            ?>%</td>
                        </tr> 

                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                          <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                            <?php 
                            
                            $tu = $nilai_ski; 
                            $posisi=strpos($tu,".");
                            if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $nilai_ski; 
                              }
                              ?>%
                          </td>
                        </tr>
                    </table>

              <?php else : ?>
                    <div id="tutup">

                    <?php echo $this->session->flashdata('msg'); ?>

                      <table class="table table-responsive table-hover table-bordered" >
                      <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                  <form action="#" id="form"  method="POST">

                        <?php $no=0; foreach ($data_utama_nilai as $utama ) : $no++?>
                        <?php $nilai_maks = $utama->total_realisasi ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">UTAMA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td>
                            <input type="hidden" name="NIPEG[]" value="<?php echo $utama->NIPEG ?>">
                            <input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]">
                            <input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]">
                            <input type="hidden" value="<?= $utama->id_realisasi ?>" name="id_realisasi[]">
                            <input type="hidden" value="<?= $versi ?>" name="versi[]">
                            <?= $utama->nama_indikator ?> </td>
                          <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                          <td><?php echo $utama->cara_pengukuran ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" name="target_pertahun[]" value="<?php echo $utama->target_pertahun ?>">
                            <?php echo $utama->target_pertahun ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" class="bobot<?php echo $no;?>" id="bobot<?php echo $no;?>" onkeyup="hitung(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $utama->bobot?>" readonly>
                            <?php echo $utama->bobot?>%</td>
                          <td style="text-align: center;">
                            <input type="hidden" name="nilai_penetapan[]" class="target<?php echo $no;?>" size="7" id="target" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center;" value="<?php echo $utama->nilai_penetapan ?>" readonly>
                            <?php echo $utama->nilai_penetapan ?>
                            <input type="hidden" name="jenis_realisasi[]" value="<?php echo $status; ?>">
                          </td>
                           <td style="text-align: center;">
                            <input type="number" name="realisasi[]" value="<?php echo $utama->realisasi ?>" class="realisasi<?php echo $no;?>" id="realisasi" onkeyup="hitung(<?php echo $no;?>);"  style="text-align: center; width: 60px;" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>

                          <td style="text-align: center;"><input type="text" name="nilai_realisasi[]" value="<?php echo $utama->nilai_realisasi ?>" id="nilai_utama" class="nilai_utama<?php echo $no;?>" size="6" style="text-align: center;" readonly>
                            <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                            <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>">
                          </td>
                          <td style="text-align: center; font-size: 15px; font-weight: bold;">
                            <input type="hidden" name="nilai_maksimal_utama" size="7" class="nilai_maksimal_utama<?php echo $no; ?>" style="text-align: center;" value="<?php echo $utama->nilai_maksimal ?>" disabled>
                            <?php echo $utama->nilai_maksimal ?>
                            <input type="hidden" class="nilai" name="total_realisasi[]" value="<?php echo $utama->total_realisasi ?> size="7" style="text-align: center;">
                            <?php $tot_nilai = $utama->nilai_ski ?>
                            <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                        </tr> 

                        <?php endforeach ?>

                        <?php  $no=0; foreach($data_sla_nilai as $sla ) : $no++ ?>
                        <?php $nilai_maks = $sla->total_realisasi ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">SLA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td>
                            <input type="hidden" name="NIPEG[]" value="<?php echo $sla->NIPEG ?>">
                            <input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]">
                            <input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]">
                            <input type="hidden" value="<?= $sla->id_realisasi ?>" name="id_realisasi[]">
                            <input type="hidden" value="<?= $versi ?>" name="versi[]">
                            <?= $sla->nama_indikator ?></td>
                          <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                          <td><?php echo $sla->cara_pengukuran ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" name="target_pertahun[]" value="<?php echo $sla->target_pertahun ?>">
                            <?php echo $sla->target_pertahun ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" id="bobot" class="bobot_sla<?php echo $no;?>" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $sla->bobot ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                            <?php echo $sla->bobot ?>%</td>
                          <td style="text-align: center;">
                            <input type="hidden" name="nilai_penetapan[]" class="target_sla<?php echo $no;?>" size="7" id="target" style="text-align: center;" value="<?php echo $sla->nilai_penetapan ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                            <input type="hidden" name="jenis_realisasi[]" value="<?php echo $status; ?>">
                            <?php echo $sla->nilai_penetapan ?> </td>
                          <td style="text-align: center;">
                            <input type="number" name="realisasi[]" value="<?php echo $sla->realisasi ?>" class="realisasi_sla<?php echo $no;?>" id="realisasi" style="text-align: center;width: 60px;" onkeyup="hitung_sla(<?php echo $no;?>);" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                          <td style="text-align: center;">
                            <input type="text" name="nilai_realisasi[]" value="<?php echo $sla->nilai_realisasi ?>" class="nilai_sla<?php echo $no;?>" id="nilai_sla" size="6" style="text-align: center;" readonly>
                            <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                            <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>"> </td>
                          <td style="text-align: center; font-size: 15px; font-weight: bold;">
                            <input type="hidden" style="text-align: center;" class="nilai_maksimal_sla<?php echo $no; ?>" name="nilai_maksimal_sla" value="<?php echo $sla->nilai_maksimal ?>" size="7" disabled>
                            <?php echo $sla->nilai_maksimal ?>
                            <input type="hidden" class="nilai" name="total_realisasi[]" value="<?php echo $sla->total_realisasi ?> size="7" style="text-align: center;">
                            <?php $tot_nilai = $sla->nilai_ski ?>
                            <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                        </tr>

                        <?php endforeach ?>

              </form>
                         <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                          <td><input type="text" class="nilai" size="6" id="tot_nilai_tw"  style="text-align: center;" value="<?php echo $nilai_maks ?>"></td>
                          <td></td>
                        </tr> 
                        <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                        <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">PENALTY</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                          <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                          <td><?= $dtp->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                          <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                          <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                          <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                          <td style="text-align: center;">
                            <?php 
                              $tu = $dtp->NILAI_REALISASI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->NILAI_REALISASI; 
                              }
                              ?>%
                          </td>
                          <td style="text-align: center;"><?= $dtp->nilai_maksimal ?></td>
                        </tr> 

                        <?php endforeach ?>
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; padding: 5px; vertical-align: middle;">Total Nilai Penalty</td>
                          <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                            <input type="hidden" size="6" id="tot_penalty" value="<?php echo $dtp->TOTAL_NILAI ?>">
                          <?php 
                              $tu = $dtp->TOTAL_NILAI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->TOTAL_NILAI; 
                              }
                              ?>%</td>
                          <td></td>
                        </tr> 
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; padding: 5px; vertical-align: middle;">Total Nilai</td>
                          <td style="text-align: center;"><input type="text" style="text-align: center;" name="total_nilai_" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                          <td></td>
                        </tr> 
                    </table><br>
                    <table class="table">
                      <tr>
                        <td style="text-align: right;">
                          <button type="button" class="btn btn-primary btn-lg" id="simpan" onclick="simpan_ubah_nilai_tw()" data-toggle="tooltip" title="Data aka diubah maka tekan UPDATE"><i class="fas fa-pencil-alt"></i><?= nbs(3) ?>U P D A T E</button><?php echo nbs(5) ?>
                          <button type="button" class="btn btn-success btn-lg" id="submit" onclick="submit_ubah_nilai_tw()" data-toggle="tooltip" title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button> </td>
                      </tr>
                    </table>
                  </div>

              <?php endif ?>

                    

          <?php else : ?>
                    <div id="tutup">

                     <table class="table table-responsive table-hover table-bordered" >
                      <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                <form action="#" id="form"  method="POST">

                        <?php $no=0; foreach ($data_target_utama as $utama ) : $no++?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">UTAMA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td>
                            <input type="hidden" name="NIPEG[]" value="<?php echo $utama->NIPEG ?>">
                            <input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]">
                            <input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]">
                            <input type="hidden" value="<?= $utama->id_nilai ?>" name="id_nilai[]">
                            <input type="hidden" value="<?= $versi ?>" name="versi[]">
                            <?= $utama->nama_indikator ?> </td>
                          <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                          <td><?php echo $utama->cara_pengukuran ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" name="target_pertahun[]" value="<?php echo $utama->target_pertahun ?>">
                            <?php echo $utama->target_pertahun ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" class="bobot<?php echo $no;?>" id="bobot<?php echo $no;?>" onkeyup="hitung(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $utama->bobot?>" readonly>
                            <?php echo $utama->bobot?>%</td>
                          <td style="text-align: center;">
                            <input type="hidden" name="nilai_penetapan[]" class="target<?php echo $no;?>" size="7" id="target" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center;" value="<?php $n = strtolower($status)?> <?php echo $utama->$n ?>" readonly>
                            <?php $n = strtolower($status)?> <?php echo $utama->$n ?>
                            <input type="hidden" name="jenis_realisasi[]" value="<?php echo $status; ?>">
                          </td>
                           <td style="text-align: center;">
                            <input type="number" name="realisasi[]" class="realisasi<?php echo $no;?>" id="realisasi" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center; width: 60px;" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>

                          <td style="text-align: center;"><input type="text" name="nilai_realisasi[]" id="nilai_utama" class="nilai_utama<?php echo $no;?>" size="6" style="text-align: center;" readonly>
                            <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                            <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>">
                          </td>
                          <td style="text-align: center; font-size: 15px; font-weight: bold;">
                            <input type="hidden" name="nilai_maksimal_utama" size="7" class="nilai_maksimal_utama<?php echo $no; ?>" style="text-align: center;" value="<?php echo $utama->nilai_maksimal ?>" >
                            <?php echo $utama->nilai_maksimal ?>
                            <input type="hidden" class="nilai" name="total_realisasi[]"  size="7" style="text-align: center;">
                          <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" readonly></td>
                        </tr> 

                        <?php endforeach ?>

                        <?php  $no=0; foreach($data_target_sla as $sla ) : $no++ ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">SLA</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td>
                            <input type="hidden" name="NIPEG[]" value="<?php echo $sla->NIPEG ?>">
                            <input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]">
                            <input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]">
                            <input type="hidden" value="<?= $sla->id_nilai ?>" name="id_nilai[]">
                            <input type="hidden" value="<?= $versi ?>" name="versi[]">
                            <?= $sla->nama_indikator ?></td>
                          <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                          <td><?php echo $sla->cara_pengukuran ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" name="target_pertahun[]" value="<?php echo $sla->target_pertahun ?>">
                            <?php echo $sla->target_pertahun ?></td>
                          <td style="text-align: center;">
                            <input type="hidden" id="bobot" class="bobot_sla<?php echo $no;?>" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $sla->bobot ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                            <?php echo $sla->bobot ?>%</td>
                          <td style="text-align: center;">
                            <input type="hidden" name="nilai_penetapan[]" class="target_sla<?php echo $no;?>" size="7" id="target" style="text-align: center;" value="<?php $n = strtolower($status)?> <?php echo $sla->$n ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                            <input type="hidden" name="jenis_realisasi[]" value="<?php echo $status; ?>">
                            <?php $n = strtolower($status)?> <?php echo $sla->$n ?> </td>
                          <td style="text-align: center;">
                            <input type="number" name="realisasi[]" class="realisasi_sla<?php echo $no;?>" id="realisasi" size="7" style="text-align: center; width: 60px;" onkeyup="hitung_sla(<?php echo $no;?>);" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                          <td style="text-align: center;">
                            <input type="text" name="nilai_realisasi[]" class="nilai_sla<?php echo $no;?>" id="nilai_sla" size="6" style="text-align: center;" readonly>
                            <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                            <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>"> </td>
                          <td style="text-align: center; font-size: 15px; font-weight: bold;">
                            <input type="hidden" style="text-align: center;" class="nilai_maksimal_sla<?php echo $no; ?>" name="nilai_maksimal_sla" value="<?php echo $sla->nilai_maksimal ?>" size="7" disabled>
                            <?php echo $sla->nilai_maksimal ?>
                            <input type="hidden" class="nilai" name="total_realisasi[]"  size="7" style="text-align: center;">
                        <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" readonly></td>
                        </tr>
                        <?php endforeach ?>

              </form>
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                          <td><input type="text" class="nilai" size="6" id="tot_nilai_tw" style="text-align: center;" readonly></td>
                          <td></td>
                        </tr>
                        <thead class="thead-light">
                          <tr>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                            <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                            <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                            <th style="vertical-align: middle;"><strong> Target </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                            <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                          </tr>
                          <tr>
                            <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                            <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                            <th style="vertical-align: middle;"><strong> <?php echo $status ?> </strong></th>
                          </tr>
                        </thead>

                        <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                        <tr>
                          <td style="text-align: center; font-weight: bold;">PENALTY</td>
                          <td style="text-align: center;"><?= $no; ?></td>
                          <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                          <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                          <td><?= $dtp->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                          <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                          <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                          <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                          <td style="text-align: center;">
                            <?php 
                              $tu = $dtp->NILAI_REALISASI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->NILAI_REALISASI; 
                              }
                              ?>%
                          </td>
                          <td style="text-align: center;"><?= $dtp->nilai_maksimal ?> </td>
                        </tr> 

                        <?php endforeach ?>
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;vertical-align: middle;">Total Nilai Penalty</td>
                          <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                            <input type="hidden" size="6" id="tot_penalty" value="<?php echo $dtp->TOTAL_NILAI ?>">
                          <?php 
                              $tu = $dtp->TOTAL_NILAI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->TOTAL_NILAI; 
                              }
                              ?>%</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; vertical-align: middle;">Total Nilai</td>
                          <td style="text-align: center;"><input type="text" style="text-align: center;" name="total_nilai_" id="total_nilai_ski" size="6" readonly>
                            </td>
                          <td></td>
                        </tr> 
                    </table><br>
                    <table class="table">
                      <tr>
                        <td style="text-align: right;">
                          <button type="button" class="btn btn-primary btn-lg" id="simpan" onclick="simpan_nilai_tw()" data-toggle="tooltip" title="Bila akan submit lain waktu. Maka tekan SIMPAN data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button><?php echo nbs(5) ?>
                          <button type="button" class="btn btn-success btn-lg" id="submit" onclick="submit_nilai_tw()" data-toggle="tooltip" title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button> </td>
                      </tr>
                    </table>
                    </div>

          <?php endif ?>

          <?php else: ?>
                <div class="alert alert-success" role="alert">
                        <h3 style="text-align: center;"> Target Penalty Belum Ada Penilaian <?= $status ?> </h3>
                    </div>

          <?php endif ?>

      <?php else: ?>
      
        <?php if (count($data_target_penalty) != 0) : ?>
              
              <?php if (count($status_nilai) != 0) : ?>

                    <?php if ($status_nilai->status != 'SIMPAN') : ?>
                        
                        <div class="alert alert-success" role="alert">
                            <h3 style="text-align: center;"> Terimakasih telah mengisi penilaian SKI <?php echo $tw_param ?> tahun <?php echo $thn ?> </h3>
                        </div>
                        <?= $this->session->flashdata('msg'); ?>

                         <table class="table table-responsive table-hover table-bordered" >
                          <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                    <form action="#" id="form"  method="POST">

                            <?php $no=0; foreach ($data_utama_nilai as $utama ) : $no++?>
                            <?php $nilai_maks = $utama->total_realisasi ?>
                            <tr>
                              <td style="text-align: center; font-weight: bold;">UTAMA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td style="text-align: ;"><?= $utama->nama_indikator ?> </td>
                              <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                              <td><?php echo $utama->cara_pengukuran ?></td>
                              <td style="text-align: center;"><?php echo $utama->target_pertahun ?></td>
                              <td style="text-align: center;"><?php echo $utama->bobot?>%</td>
                              <td style="text-align: center;"><?php echo $utama->nilai_penetapan ?></td>
                              <td style="text-align: center;"><?php echo $utama->realisasi;  ?></td>
                              <td style="text-align: center;">
                                <?php 

                                $tu = $utama->nilai_realisasi; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $utama->nilai_realisasi; 
                                }

                                ?>%</td>
                            </tr> 
                            <?php $nilai_ski = $utama->nilai_ski ?>

                            <?php endforeach ?>

                            <?php  $no=0; foreach($data_sla_nilai as $sla ) : $no++ ?>
                            <?php $nilai_maks = $sla->total_realisasi ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">SLA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td style="text-align: ;"><?= $sla->nama_indikator ?></td>
                              <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                              <td><?php echo $sla->cara_pengukuran ?></td>
                              <td style="text-align: center;"><?php echo $sla->target_pertahun ?></td>
                              <td style="text-align: center;"><?php echo $sla->bobot ?>%</td>
                              <td style="text-align: center;"><?php echo $sla->nilai_penetapan ?></td>
                              <td style="text-align: center;"><?php echo $sla->realisasi ?></td>
                              <td style="text-align: center;">
                                <?php 
                                
                                $tu = $sla->nilai_realisasi; 
                                $posisi=strpos($tu,".");

                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $sla->nilai_realisasi; 
                                }

                                ?>%
                              </td>
                            </tr>
                             <?php $nilai_ski = $sla->nilai_ski ?>

                            <?php endforeach ?>

                  </form>

                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                                <?php if (!empty($data_utama_nilai) && empty($data_sla_nilai)): ?>
                                  Total SKI Utama <?= $tw_param ?>                                                             
                                <?php elseif (empty($data_target_utama_tw1) && !empty($data_target_sla_tw1)): ?>
                                  Total SKI SLA <?= $tw_param ?>
                                <?php else: ?>
                                  Total SKI Utama + SLA <?= $tw_param ?>
                                <?php endif ?></td>
                              <td style="text-align: center; font-weight: bolder; font-size: 15px;">
                                <?php 
                                
                                $tu = $nilai_maks; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $nilai_maks; 
                                }

                                ?>%
                              </td>
                            </tr> 
                            <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot </strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                            <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">PENALTY</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                              <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                              <td><?php echo $dtp->cara_pengukuran ?></td>
                              <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                              <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                              <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                              <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                              <td style="text-align: center;">
                            <?php 
                              $tu = $dtp->NILAI_REALISASI; 
                              $posisi=strpos($tu,".");
                              if ($posisi != 0) {
                                $sub_kalimat = substr($tu,$posisi,3);
                                $sub_kalimat = substr($tu,$posisi,3);
                                $a = substr($tu,0,$posisi);
                                echo $a.$sub_kalimat;
                              } else {
                                echo $dtp->NILAI_REALISASI; 
                              }
                              ?>%
                          </td>
                            </tr> 

                            <?php endforeach ?>
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; vertical-align: middle;">Total Penalty <?= $tw_param ?></td>
                              <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                              <?php 
                                
                                $tu = $dtp->TOTAL_NILAI; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $dtp->TOTAL_NILAI; 
                                }

                                ?>%</td>
                            </tr> 

                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                              <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                                <?php 
                                
                                $tu = $nilai_ski; 
                                $posisi=strpos($tu,".");

                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $nilai_ski; 
                                }

                                ?>%
                              </td>
                            </tr>
                        </table><br>
                        <td>
                            <a href="<?php echo base_url("Master/penilaian_karyawan/$tw_param");?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                            </td>

                  <?php else : ?>

                        <?php echo $this->session->flashdata('msg'); ?>

                          <table class="table table-responsive table-hover table-bordered" >
                          <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot </strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                      <form action="#" id="form"  method="POST">

                            <?php $no=0; foreach ($data_utama_nilai as $utama ) : $no++?>
                            <?php $nilai_maks = $utama->total_realisasi ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">UTAMA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td>
                                <input type="hidden" name="NIPEG[]" value="<?php echo $utama->NIPEG ?>">
                                <input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]">
                                <input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]">
                                <input type="hidden" value="<?= $utama->id_realisasi ?>" name="id_realisasi[]">
                                <input type="hidden" value="<?= $versi ?>" name="versi[]">
                                <?= $utama->nama_indikator ?> </td>
                              <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                              <td><?php echo $utama->cara_pengukuran ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" name="target_pertahun[]" value="<?php echo $utama->target_pertahun ?>">
                                <?php echo $utama->target_pertahun ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" class="bobot<?php echo $no;?>" id="bobot<?php echo $no;?>" onkeyup="hitung(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $utama->bobot?>" readonly>
                                <?php echo $utama->bobot?>%</td>
                              <td style="text-align: center;">
                                <input type="hidden" name="nilai_penetapan[]" class="target<?php echo $no;?>" size="7" id="target" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center;" value="<?php echo $utama->nilai_penetapan ?>" readonly>
                                <?php echo $utama->nilai_penetapan ?>
                                <input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw_param; ?>">
                              </td>
                               <td style="text-align: center;">
                                <input type="number" name="realisasi[]" value="<?php echo $utama->realisasi ?>" class="realisasi<?php echo $no;?>" id="realisasi" onkeyup="hitung(<?php echo $no;?>);"  style="text-align: center; width: 60px;" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>

                              <td style="text-align: center;"><input type="text" name="nilai_realisasi[]" value="<?php echo $utama->nilai_realisasi ?>" id="nilai_utama" class="nilai_utama<?php echo $no;?>" size="6" style="text-align: center;" readonly>
                                <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                                <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>">
                              </td>
                              <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                <input type="hidden" name="nilai_maksimal_utama" size="7" class="nilai_maksimal_utama<?php echo $no; ?>" style="text-align: center;" value="<?php echo $utama->nilai_maksimal ?>" disabled>
                                <?php echo $utama->nilai_maksimal ?>
                                <input type="hidden" class="nilai" name="total_realisasi[]" value="<?php echo $utama->total_realisasi ?> size="7" style="text-align: center;">
                                <?php $tot_nilai = $utama->nilai_ski ?>
                                <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                            </tr> 

                            <?php endforeach ?>

                            <?php  $no=0; foreach($data_sla_nilai as $sla ) : $no++ ?>
                            <?php $nilai_maks = $sla->total_realisasi ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">SLA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td>
                                <input type="hidden" name="NIPEG[]" value="<?php echo $sla->NIPEG ?>">
                                <input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]">
                                <input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]">
                                <input type="hidden" value="<?= $sla->id_realisasi ?>" name="id_realisasi[]">
                                <input type="hidden" value="<?= $versi ?>" name="versi[]">
                                <?= $sla->nama_indikator ?></td>
                              <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                              <td><?php echo $sla->cara_pengukuran ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" name="target_pertahun[]" value="<?php echo $sla->target_pertahun ?>">
                                <?php echo $sla->target_pertahun ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" id="bobot" class="bobot_sla<?php echo $no;?>" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $sla->bobot ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                                <?php echo $sla->bobot ?>%</td>
                              <td style="text-align: center;">
                                <input type="hidden" name="nilai_penetapan[]" class="target_sla<?php echo $no;?>" size="7" id="target" style="text-align: center;" value="<?php echo $sla->nilai_penetapan ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                                <input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw_param; ?>">
                                <?php echo $sla->nilai_penetapan ?> </td>
                              <td style="text-align: center;">
                                <input type="number" name="realisasi[]" value="<?php echo $sla->realisasi ?>" class="realisasi_sla<?php echo $no;?>" id="realisasi" style="text-align: center;width: 60px;" onkeyup="hitung_sla(<?php echo $no;?>);" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                              <td style="text-align: center;">
                                <input type="text" name="nilai_realisasi[]" value="<?php echo $sla->nilai_realisasi ?>" class="nilai_sla<?php echo $no;?>" id="nilai_sla" size="6" style="text-align: center;" readonly>
                                <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                                <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>"> </td>
                              <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                <input type="hidden" style="text-align: center;" class="nilai_maksimal_sla<?php echo $no; ?>" name="nilai_maksimal_sla" value="<?php echo $sla->nilai_maksimal ?>" size="7" disabled>
                                <?php echo $sla->nilai_maksimal ?>
                                <input type="hidden" class="nilai" name="total_realisasi[]" value="<?php echo $sla->total_realisasi ?> size="7" style="text-align: center;">
                                <?php $tot_nilai = $sla->nilai_ski ?>
                                <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                            </tr>

                            <?php endforeach ?>

                  </form>
                             <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                              <td><input type="text" class="nilai" size="6" id="tot_nilai_tw"  style="text-align: center;" value="<?php echo $nilai_maks ?>"></td>
                              <td></td>
                            </tr> 
                            <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot </strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                            <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">PENALTY</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                              <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                              <td><?= $dtp->cara_pengukuran ?></td>
                              <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                              <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                              <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                              <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                               <td style="text-align: center;">
                              <?php 
                                $tu = $dtp->NILAI_REALISASI; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $dtp->NILAI_REALISASI; 
                                }
                                ?>%
                            </td>
                              <td style="text-align: center;"><?= $dtp->nilai_maksimal ?></td>
                            </tr> 

                            <?php endforeach ?>
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; padding: 5px; vertical-align: middle;">Total Nilai Penalty</td>
                              <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                                <input type="hidden" size="6" id="tot_penalty" value="<?php echo $dtp->TOTAL_NILAI ?>">
                                 <?php 
                                $tu = $dtp->TOTAL_NILAI; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $dtp->TOTAL_NILAI; 
                                }
                                ?>%
                              </td>
                              <td></td>
                            </tr> 
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; padding: 5px; vertical-align: middle;">Total Nilai</td>
                              <td style="text-align: center;"><input type="text" style="text-align: center;" name="total_nilai_" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly></td>
                              <td></td>
                            </tr> 
                        </table><br>
                        <table class="table">
                          <tr>
                            <td>
                            <a href="<?php echo base_url("Master/penilaian_karyawan/$tw_param");?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                            </td>
                            <td style="text-align: right;">
                              <button type="button" class="btn btn-primary btn-lg" id="simpan" onclick="simpan_ubah_nilai_tw_2()" data-toggle="tooltip" title="Data aka diubah maka tekan UPDATE"><i class="fas fa-pencil-alt"></i><?= nbs(3) ?>U P D A T E</button><?php echo nbs(5) ?>
                              <button type="button" class="btn btn-success btn-lg" id="submit" onclick="submit_ubah_nilai_tw_2('<?= $tw_param ?>')" data-toggle="tooltip" title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button> </td>
                          </tr>
                        </table>

                  <?php endif ?>

                        

              <?php else : ?>

                         <table class="table table-responsive table-hover table-bordered" >
                          <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                    <form action="#" id="form"  method="POST">

                            <?php $no=0; foreach ($data_target_utama as $utama ) : $no++?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">UTAMA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td>
                                <input type="hidden" name="NIPEG[]" value="<?php echo $utama->NIPEG ?>">
                                <input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]">
                                <input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]">
                                <input type="hidden" value="<?= $utama->id_nilai ?>" name="id_nilai[]">
                                <input type="hidden" value="<?= $versi ?>" name="versi[]">
                                <?= $utama->nama_indikator ?> </td>
                              <td style="text-align: center;"><?php echo $utama->satuan_indikator ?></td>
                              <td><?php echo $utama->cara_pengukuran ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" name="target_pertahun[]" value="<?php echo $utama->target_pertahun ?>">
                                <?php echo $utama->target_pertahun ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" class="bobot<?php echo $no;?>" id="bobot<?php echo $no;?>" onkeyup="hitung(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $utama->bobot?>" readonly>
                                <?php echo $utama->bobot?>%</td>
                              <td style="text-align: center;">
                                <input type="hidden" name="nilai_penetapan[]" class="target<?php echo $no;?>" size="7" id="target" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center;" value="<?php $n = strtolower($tw_param)?> <?php echo $utama->$n ?>" readonly>
                                <?php $n = strtolower($tw_param)?> <?php echo $utama->$n ?>
                                <input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw_param; ?>">
                              </td>
                               <td style="text-align: center;">
                                <input type="number" name="realisasi[]" class="realisasi<?php echo $no;?>" id="realisasi" onkeyup="hitung(<?php echo $no;?>);" style="text-align: center; width: 60px;" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>

                              <td style="text-align: center;"><input type="text" name="nilai_realisasi[]" id="nilai_utama" class="nilai_utama<?php echo $no;?>" size="6" style="text-align: center;" readonly>
                                <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                                <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>">
                              </td>
                              <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                <input type="hidden" name="nilai_maksimal_utama" size="7" class="nilai_maksimal_utama<?php echo $no; ?>" style="text-align: center;" value="<?php echo $utama->nilai_maksimal ?>" >
                                <?php echo $utama->nilai_maksimal ?>
                                <input type="hidden" class="nilai" name="total_realisasi[]"  size="7" style="text-align: center;">
                              <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" readonly></td>
                            </tr> 

                            <?php endforeach ?>

                            <?php  $no=0; foreach($data_target_sla as $sla ) : $no++ ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">SLA</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td>
                                <input type="hidden" name="NIPEG[]" value="<?php echo $sla->NIPEG ?>">
                                <input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]">
                                <input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]">
                                <input type="hidden" value="<?= $sla->id_nilai ?>" name="id_nilai[]">
                                <input type="hidden" value="<?= $versi ?>" name="versi[]">
                                <?= $sla->nama_indikator ?></td>
                              <td style="text-align: center;"><?php echo $sla->satuan_indikator ?></td>
                              <td><?php echo $sla->cara_pengukuran ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" name="target_pertahun[]" value="<?php echo $sla->target_pertahun ?>">
                                <?php echo $sla->target_pertahun ?></td>
                              <td style="text-align: center;">
                                <input type="hidden" id="bobot" class="bobot_sla<?php echo $no;?>" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $sla->bobot ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                                <?php echo $sla->bobot ?>%</td>
                              <td style="text-align: center;">
                                <input type="hidden" name="nilai_penetapan[]" class="target_sla<?php echo $no;?>" size="7" id="target" style="text-align: center;" value="<?php $n = strtolower($tw_param)?> <?php echo $sla->$n ?>" onkeyup="hitung_sla(<?php echo $no;?>);" readonly>
                                <input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw_param; ?>">
                                <?php $n = strtolower($tw_param)?> <?php echo $sla->$n ?> </td>
                              <td style="text-align: center;">
                                <input type="number" name="realisasi[]" class="realisasi_sla<?php echo $no;?>" id="realisasi" size="7" style="text-align: center; width: 60px;" onkeyup="hitung_sla(<?php echo $no;?>);" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                              <td style="text-align: center;">
                                <input type="text" name="nilai_realisasi[]" class="nilai_sla<?php echo $no;?>" id="nilai_sla" size="6" style="text-align: center;" readonly>
                                <input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
                                <input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>"> </td>
                              <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                <input type="hidden" style="text-align: center;" class="nilai_maksimal_sla<?php echo $no; ?>" name="nilai_maksimal_sla" value="<?php echo $sla->nilai_maksimal ?>" size="7" disabled>
                                <?php echo $sla->nilai_maksimal ?>
                                <input type="hidden" class="nilai" name="total_realisasi[]"  size="7" style="text-align: center;">
                            <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" readonly></td>
                            </tr>
                            <?php endforeach ?>

                  </form>
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                              <td><input type="text" class="nilai" size="6" id="tot_nilai_tw" style="text-align: center;" ></td>
                              <td></td>
                            </tr>
                            <thead class="thead-light">
                              <tr>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> No </strong></th>
                                <th colspan="3" style="vertical-align: middle;"><strong> Sasaran Kerja </strong></th>  
                                <th rowspan="2" style="vertical-align: middle;"><strong> Target Pertahun </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%)</strong></th>
                                <th style="vertical-align: middle;"><strong> Target </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Realisasi </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai </strong></th>
                                <th rowspan="2" style="vertical-align: middle;"><strong> Nilai Maksimal </strong></th>
                              </tr>
                              <tr>
                                <th style="vertical-align: middle;"><strong> Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Satuan Indikator </strong></th>
                                <th style="vertical-align: middle;"><strong> Cara Pengukuran </strong></th>
                                <th style="vertical-align: middle;"><strong> <?php echo $tw_param ?> </strong></th>
                              </tr>
                            </thead>

                            <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                            <tr>
                              <td style="text-align: center; font-weight: bold;">PENALTY</td>
                              <td style="text-align: center;"><?= $no; ?></td>
                              <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
                              <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                              <td><?= $dtp->cara_pengukuran ?></td>
                              <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                              <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                              <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                              <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                              <td style="text-align: center;">
                                <?php 
                                  $tu = $dtp->NILAI_REALISASI; 
                                  $posisi=strpos($tu,".");
                                  if ($posisi != 0) {
                                    $sub_kalimat = substr($tu,$posisi,3);
                                    $sub_kalimat = substr($tu,$posisi,3);
                                    $a = substr($tu,0,$posisi);
                                    echo $a.$sub_kalimat;
                                  } else {
                                    echo $dtp->NILAI_REALISASI; 
                                  }
                                  ?>%
                              </td>
                              <td style="text-align: center;"><?= $dtp->nilai_maksimal ?> </td>
                            </tr> 

                            <?php endforeach ?>
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;vertical-align: middle;">Total Nilai Penalty</td>
                              <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                                <input type="hidden" size="6" id="tot_penalty" value="<?php echo $dtp->TOTAL_NILAI ?>">
                                <?php 
                                $tu = $dtp->TOTAL_NILAI; 
                                $posisi=strpos($tu,".");
                                if ($posisi != 0) {
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $sub_kalimat = substr($tu,$posisi,3);
                                  $a = substr($tu,0,$posisi);
                                  echo $a.$sub_kalimat;
                                } else {
                                  echo $dtp->TOTAL_NILAI; 
                                }
                                ?>%
                              </td>
                              <td></td>
                            </tr>
                            <tr>
                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; vertical-align: middle;">Total Nilai</td>
                              <td style="text-align: center;"><input type="text" style="text-align: center;" name="total_nilai_" id="total_nilai_ski" size="6" readonly>
                                </td>
                              <td></td>
                            </tr> 
                        </table><br>
                        <table class="table">
                          <tr>
                            <td>
                            <a href="<?php echo base_url("Master/penilaian_karyawan/$tw_param");?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                            </td>
                            <td style="text-align: right;">
                              <button type="button" class="btn btn-primary btn-lg" id="simpan" onclick="simpan_nilai_tw_2()" data-toggle="tooltip" title="Bila akan submit lain waktu. Maka tekan SIMPAN data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button><?php echo nbs(5) ?>
                              <button type="button" class="btn btn-success btn-lg" id="submit" onclick="submit_nilai_tw_2('<?= $tw_param ?>')" data-toggle="tooltip" title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button> </td>
                          </tr>
                        </table>

              <?php endif ?>

              <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <h3 style="text-align: center;"> Target Penalty Belum Ada Penilaian <?= $tw_param ?></h3>
                    </div>

                    <?= br(6) ?>
                    <table class="table" style="margin-bottom: -10px;">
                      <tr>
                        <td>
                            <a href="<?php echo base_url("Master/penilaian_karyawan/$tw_param");?>">  

                          <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                          </a>
                        </td> 
                      </tr>
                    </table>

              <?php endif ?>

      <?php endif ?>


      

      

                  

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

<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  
  // fungsi simpan_nilai_tw untuk menyimpan realisasi nilai triwulan
  function simpan_nilai_tw_2(){
      var url = "<?php echo site_url('Master/tambah_nilai_tw')?>";

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data)
          {
            url = "<?php echo site_url("Master/penilaian_ski/$nipeg/$tw_param")?>";
            window.location.href=url;
          }
        });

  }

  // fungsi submit_nilai_tw untuk menyimpan realisasi nilai triwulan
    function submit_nilai_tw_2(tw){
         if(confirm('Apakah yakin akan mengirim Data Penilaian SKI ?'))
            {
            var url = "<?php echo site_url('Master/kirim_nilai_tw/')?>/"+tw;

              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  url = "<?php echo site_url("Master/penilaian_ski/$nipeg/$tw_param")?>";
                  window.location.href=url;
                }
              });
            }
    }

    // fungsi simpan_nilai_tw untuk menyimpan realisasi nilai triwulan
    function simpan_ubah_nilai_tw_2(){
        var url = "<?php echo site_url('karyawan/tambah_ubah_nilai_tw')?>";

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              url = "<?php echo site_url("Master/penilaian_ski/$nipeg/$tw_param")?>";
              window.location.href=url;
            }
          });

    }

    // fungsi submit_nilai_tw untuk menyimpan realisasi nilai triwulan
    function submit_ubah_nilai_tw_2(tw){
         if(confirm('Apakah yakin akan mengirim Data Penilaian SKI ?'))
            {
            var url = "<?php echo site_url('Master/kirim_ubah_nilai_tw')?>/"+tw;

              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  url = "<?php echo site_url("Master/penilaian_ski/$nipeg/$tw_param")?>";
                  window.location.href=url;
                }
              });
            }
    }

</script>

</html>

