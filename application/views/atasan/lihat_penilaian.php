<!DOCTYPE html>
<html>
<head>
  <title> Ubah SKI </title>
  <style type="text/css">
    th {
        text-align: center;
        font-size: 13px;
    }
    label {
      font-weight: bold;
    }
    tbody {
      font-size: 13px;
    }
  </style>
</head>
<body>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="row"  style="margin-bottom: -20px; margin-top: -20px;">
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
                <div class="form">
                  <?php echo $this->session->flashdata('msg') ?>
                  <div class="table-responsive">
                  <table class="table table-hover table-bordered" >
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
                    <tbody>
                    <form action="#" id="form"  method="post">
                   <?php foreach ($nama_karyawan as $nm) : ?>
                      <input type="hidden" value="<?= $nm->NIPEG ?>" name="NIPEG[]" >
                    <?php endforeach ?>

                    
                    <?php $no=0; foreach ($target_utama_nilai as $utama ) : $no++?>
                  <tr>
                    <td style="text-align: center; font-weight: bold;">UTAMA</td>
                    <td style="text-align: center;"><?= $no; ?></td>
                    <td><input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $utama->id_realisasi ?>" name="id_realisasi[]"><?= $utama->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $utama->satuan_indikator ?></td>
                    <td style="text-align: ;"><?= $utama->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?= $utama->target_pertahun ?></td>
                    <td style="text-align: center;"><?= $utama->bobot?>%</td>
                    <td style="text-align: center;"><?= $utama->nilai_penetapan ?></td>
                    <td style="text-align: center;"><?= $utama->realisasi ?></td>
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

                        $tot_nilai = $utama->nilai_ski;

                        ?>%</td>
                  </tr> 
                    <?php endforeach ?>
                  
                    
                    <?php  $no=0; foreach($target_sla_nilai as $sla ) : $no++ ?>
                  <tr>
                    <td style="text-align: center; font-weight: bold;">SLA</td>
                    <td style="text-align: center;"><?= $no; ?></td>
                    <td><input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $sla->id_realisasi ?>" name="id_realisasi[]"><?= $sla->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $sla->satuan_indikator ?></td>
                    <td style="text-align: center;"><?= $sla->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?= $sla->target_pertahun ?></td>
                    <td style="text-align: center;"><?= $sla->bobot?> %</td>
                    <td style="text-align: center;"><?= $sla->nilai_penetapan ?></td>
                    <td style="text-align: center;"><?= $sla->realisasi ?></td>
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

                        $tot_nilai = $sla->nilai_ski;

                        ?>
                    </td>
                    
                  </tr>
                     <?php endforeach ?>
                  <tr>
                    <td colspan="9" style="text-align: right; font-weight: bold; font-size: 15px; padding: 15px; vertical-align: middle;">
                    <?php if (!empty($target_utama_nilai) && empty($target_sla_nilai)): ?>
                      Total SKI Utama <?= $status ?>
                    <?php elseif (empty($target_utama_nilai) && !empty($target_sla_nilai)): ?>
                      Total SKI SLA <?= $status ?>
                    <?php else: ?>
                      Total SKI Utama + SLA <?= $status ?>
                    <?php endif ?>
                     </td>
                    <td style="text-align: center; font-weight: bold; font-size: 15px;">
                      <?php 

                        $tu = $ambil_nilai->total_realisasi; 
                        $posisi=strpos($tu,".");

                        if ($posisi != 0) {
                          $sub_kalimat = substr($tu,$posisi,3);
                          $sub_kalimat = substr($tu,$posisi,3);
                          $a = substr($tu,0,$posisi);
                          echo $a.$sub_kalimat;
                        } else {
                          echo $ambil_nilai->total_realisasi; 
                        }

                        ?>%
                    </td>
                  </tr> 
                  </tbody>
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
                    <tbody>

                    <?php  $no=0; foreach($data_target_penalty as $dtp ) : $no++ ?>

                    <tr>
                      <td style="text-align: center; font-weight: bold;">PENALTY</td>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td style="text-align:;"><?= $dtp->nama_indikator ?></td>
                      <td style="text-align: center;"><?= $dtp->satuan_indikator ?></td>
                      <td style="text-align: ;"><?= $dtp->cara_pengukuran ?></td>
                      <td style="text-align: center;"><?= -$dtp->TARGET_PERTAHUN ?></td>
                      <td style="text-align: center;"><?= $dtp->BOBOT ?>%</td>
                      <td style="text-align: center;"><?= -$dtp->NILAI_PENETAPAN ?></td>
                      <td style="text-align: center;"><?= $dtp->REALISASI ?></td>
                      <td style="text-align: center;">
                        <?php 

                        $tu = $dtp->NILAI_REALISASI ; 
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

                        $tu = $dtp->TOTAL_NILAI ; 
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
                    </tr>
                    <tr>
                      <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Nilai SKI</td>
                      <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                        <?php 

                        $tu = $tot_nilai; 
                        $posisi=strpos($tu,".");

                        if ($posisi != 0) {
                          $sub_kalimat = substr($tu,$posisi,3);
                          $sub_kalimat = substr($tu,$posisi,3);
                          $a = substr($tu,0,$posisi);
                          echo $a.$sub_kalimat;
                        } else {
                          echo $tot_nilai;
                        }

                        ?>%
                      </td>
                    </tr>

                </tbody>
                </table><br>  
                <table class="table">
                  <tr>

                    <td> <a href="<?php echo base_url('Atasan1/karyawan');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a> </td>
                    <input type="hidden" value="<?php echo $approve ?>">
                    <?php if ($ambil_nilai->$approve == 'BELUM'): ?>
                      <td style="text-align: right;">
                        <a href="<?= base_url() ?>Atasan1/ubah_nilai_real/<?= $data_karyawan['NIPEG'] ?>"><button type="button" id="ubah" class="btn btn-warning btn-lg" style="color: black;" data-toggle="tooltip" data-original-title="Tekan UPDATE bila data perlu diubah"><i class="fas fa-pencil-alt"></i><?php echo nbs(3) ?>U P D A T E</button></a> <?= nbs(5) ?>
                        <a href="#">  <button type="button" id="approve" class="btn btn-success btn-lg" onclick="submit_nilai('<?= $data_karyawan['NIPEG'] ?>')" data-toggle="tooltip" data-original-title="Tekan APPROVE bila data sudah sesuai dan benar"><i class="fas fa-check"></i><?php echo nbs(3) ?>A P P R O V E</button></a></td>

                    <?php endif ?>
                    
                  </tr>
                  </table>
                </form>
                </div>
              </div>
          </div>
      </div>
       
  </div>
</div>

</body>
</html>

