<!DOCTYPE html>
<html>
<head>
  <title> Buat SKI </title>
  <style type="text/css">
    th {
        text-align: center;
        font-weight: bold;
        font-size: 13px;
    }
    label {
      font-weight: bolder;
    }
    tbody{
      font-size: 13px;
    }
  </style>
</head>
<body>
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
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
                <div class="form" id="tutup">
        <?php if (count($cari_indikator) != 0) : ?>

            <?php if (count($data_target_penalty) != 0): ?>

            <!-- Jika Data Target Utama dan SLA berisi Data -->
        <?php if ((count($data_target_utama) != 0) AND (count($data_target_sla) != 0)) { ?>

                <!-- Menampilkan tabel Target Utama -->
                <table class="table table-responsive table-hover table-bordered" >
                  <thead class="thead-light">
                    <tr>
                      <th colspan="10"><strong> TARGET UTAMA </strong></th>
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
                  <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                  <tbody>
                    <?php $no=0; foreach ($data_target_utama as $tu ) : $no++ ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $no;?></td>
                      <td style="text-align: ;">
                        <input type="hidden" name="NIPEG[]" value="<?= $data_karyawan['NIPEG'] ?>">
                        <input type="hidden" value="<?= $versi ?>" name="versi[]">
                        <input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]">
                        <input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]">
                        <input type="hidden" name="jobtitle[]" value="<?= $data_karyawan['JOBTITLE'] ?>">
                        <input type="hidden" name="divisi[]" value="<?= $data_karyawan['DIVISI'] ?>">
                        <input type="hidden" name="bagian[]" value="<?= $data_karyawan['BAGIAN'] ?>">
                        <input type="hidden" name="urusan[]" value="<?= $data_karyawan['URUSAN'] ?>">
                        <input type="hidden" name="pangkat[]" value="<?= $data_karyawan['PANGKAT'] ?>">
                        <?= $tu->nama_indikator ?></td>
                      <td style="text-align: center;"><?php echo $tu->satuan_indikator ?></td>
                      <td style="text-align: ;"><?= $tu->cara_pengukuran ?></td>
                      <td style="text-align: center;"><input type="number" name="target_pertahun[]" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                      <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" required></td>
                      <td><input type="number" name="tw1[]" style="text-align: center; width: 60px;" required></td>
                      <td><input type="number" name="tw2[]" style="text-align: center; width: 60px;" required></td>
                      <td><input type="number" name="tw3[]" style="text-align: center; width: 60px;" required></td>
                      <td style="text-align: center;"><input type="number"name="tw4[]" id="tw4<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
              
              <thead class="thead-light">
                <tr>
                  <th colspan="10"><strong> TARGET SLA </strong></th>
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
                <?php $no=0; foreach ($data_target_sla as $ts ) : $no++ ?>
                <tr>
                  <td style="text-align: center;"><?php echo $no; ?></td>
                  <td style="text-align: ;">
                    <input type="hidden" name="NIPEG[]" value="<?= $data_karyawan['NIPEG'] ?>">
                    <input type="hidden" value="<?= $versi ?>" name="versi[]">
                    <input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]">
                    <input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]">
                    <input type="hidden" name="jobtitle[]" value="<?= $data_karyawan['JOBTITLE'] ?>">
                    <input type="hidden" name="divisi[]" value="<?= $data_karyawan['DIVISI'] ?>">
                    <input type="hidden" name="bagian[]" value="<?= $data_karyawan['BAGIAN'] ?>">
                    <input type="hidden" name="urusan[]" value="<?= $data_karyawan['URUSAN'] ?>">
                    <input type="hidden" name="pangkat[]" value="<?= $data_karyawan['PANGKAT'] ?>">
                    <?= $ts->nama_indikator ?></td>
                  <td style="text-align: center;"><?= $ts->satuan_indikator ?></td>
                  <td style="text-align: ;"><?= $ts->cara_pengukuran ?></td>
                  <td style="text-align: center;"><input type="number" name="target_pertahun[]" id="target_pertahun_sla<?php echo $no; ?>" onkeyup="simpan_nilai_sla(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                  <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw1[]" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw2[]" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw3[]" style="text-align: center; width: 60px;" required></td>
                  <td style="text-align: center;"><input type="number"name="tw4[]" id="tw4_sla<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
                </tr> 
                  <?php endforeach ?>
              </form>
                <tr>
                  <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot SKI</td>
                  <td><input type="text" id="total_bobot" class="total_bobot" name="total_bobot"  size="5" style="text-align: center;" readonly></td>
                  <td colspan="4" style="font-weight: bold; color: red; font-size: 17px">* Total Bobot harus 100%</td>
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
              <?php $no=0; foreach ($data_target_penalty as $p) : $no++?>
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
            </table> <br>
              <table class="table" style="margin-bottom: -20px;">
              <tr>
                <?php if ($buat_ski != "kadiv"): ?>

                  <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-info btn-lg" onclick="tampil()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung()" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>

                <?php else: ?>
                  <td>
                    <a href="<?php echo base_url('master/penetapan_karyawan');?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                  </td>

                  <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_1()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung_1('<?= $data_karyawan['NIPEG'] ?>')" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>

                <?php endif ?>
                
              </tr>
            </table>
                
      <!-- Menampilkan data Target Utama bila Target SLA kosong -->
      <?php } elseif ((count($data_target_utama) != 0) AND (count($data_target_sla) == 0)) { ?>
                    
              <!-- Menampilkan data hanya tabel Target Utama-->
              <table class="table table-responsive table-hover table-bordered" >
              <thead class="thead-light">
                <tr>
                  <th colspan="10"><strong> TARGET UTAMA </strong></th>
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
                 <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
              <?php  $no=0; 
                foreach ($data_target_utama as $tu ) :
                  $no++
              ?>
              <tr>
                <td style="text-align: center;"><?php echo $no;?></td>
                <td style="text-align: ;">
                  <input type="hidden" name="NIPEG[]" value="<?= $data_karyawan['NIPEG'] ?>">
                  <input type="hidden" value="<?= $versi ?>" name="versi[]">
                  <input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]">
                  <input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]">
                  <input type="hidden" name="jobtitle[]" value="<?= $data_karyawan['JOBTITLE'] ?>">
                  <input type="hidden" name="divisi[]" value="<?= $data_karyawan['DIVISI'] ?>">
                  <input type="hidden" name="bagian[]" value="<?= $data_karyawan['BAGIAN'] ?>">
                  <input type="hidden" name="urusan[]" value="<?= $data_karyawan['URUSAN'] ?>">
                  <input type="hidden" name="pangkat[]" value="<?= $data_karyawan['PANGKAT'] ?>">
                  <?= $tu->nama_indikator ?></td>
                <td style="text-align: center;"><?php echo $tu->satuan_indikator ?></td>
                <td style="text-align: ;"><?= $tu->cara_pengukuran ?></td>
                <td style="text-align: center;"><input type="number" name="target_pertahun[]" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" required></td>
                <td><input type="number" name="tw1[]" style="text-align: center; width: 60px;" required></td>
                <td><input type="number" name="tw2[]" style="text-align: center; width: 60px;" required></td>
                <td><input type="number" name="tw3[]" style="text-align: center; width: 60px;" required></td>
                <td style="text-align: center;"><input type="number"name="tw4[]" id="tw4<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
              </tr>
              <?php endforeach  ?></form>
              <tr>
                <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot SKI</td>
                <td><input type="" id="total_bobot" class="total_bobot" name="total_bobot"  size="5" style="text-align: center;" readonly></td>
                <td colspan="4" style="font-weight: bold; color: red; font-size: 17px">* Total Bobot harus 100%</td>
              </tr>
              </tbody>

              <thead class="thead-light">
              <tr>
                <th colspan="10"><strong>TARGET PENALTY</strong></th>
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
              <?php $no=0; foreach ($data_target_penalty as $p) : $no++?>
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
              <table class="table" style="margin-bottom: -20px;">
              <tr>
                <?php if ($buat_ski != "kadiv"): ?>

                  <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-info btn-lg" onclick="tampil()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung()" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>

                <?php else: ?>
                  <td>
                    <a href="<?php echo base_url('master/penetapan_karyawan');?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                  </td>

                  <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_1()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung_1('<?= $data_karyawan['NIPEG'] ?>')" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>

                <?php endif ?>
                
              </tr>
            </table>

      <!-- Menampilkan hanya data tabel Target SLA -->
      <?php } elseif ((count($data_target_utama) == 0) AND (count($data_target_sla) != 0)) { ?>

              <table class="table table-responsive table-hover table-bordered" >
              <thead class="thead-light">
              <tr>
                <th colspan="10"><strong>TARGET SLA</strong></th>
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

              <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                 
                <?php $no=0; 
                foreach ($data_target_sla as $ts ) : 
                  $no++  ?>

              <tr>
                
                <td style="text-align: center;"><?php echo $no; ?></td>
                <td style="text-align: ;">
                  <input type="hidden" name="NIPEG[]" value="<?= $data_karyawan['NIPEG'] ?>">
                  <input type="hidden" value="<?= $versi ?>" name="versi[]">
                  <input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]">
                  <input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]">
                  <input type="hidden" name="jobtitle[]" value="<?= $data_karyawan['JOBTITLE'] ?>">
                  <input type="hidden" name="divisi[]" value="<?= $data_karyawan['DIVISI'] ?>">
                  <input type="hidden" name="bagian[]" value="<?= $data_karyawan['BAGIAN'] ?>">
                  <input type="hidden" name="urusan[]" value="<?= $data_karyawan['URUSAN'] ?>">
                  <input type="hidden" name="pangkat[]" value="<?= $data_karyawan['PANGKAT'] ?>">
                  <?= $ts->nama_indikator ?></td>
                <td style="text-align: center;"><?= $ts->satuan_indikator ?></td>
                <td style="text-align: ;"><?= $ts->cara_pengukuran ?></td>
                <td style="text-align: center;"><input type="number" name="target_pertahun[]" id="target_pertahun_sla<?php echo $no; ?>" onkeyup="simpan_nilai_sla(<?= $no ?>)" style="text-align: center;width: 60px;"></td>
                  <td><input type="number" id="bobot_utama" name="bobot[]" size="5" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw1[]" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw2[]" style="text-align: center; width: 60px;" required></td>
                  <td><input type="number" name="tw3[]" style="text-align: center; width: 60px;" required></td>
                  <td style="text-align: center;"><input type="number"name="tw4[]" id="tw4_sla<?php echo $no; ?>" style="text-align: center;width: 60px;"></td>
              </tr> 
                
                <?php endforeach ?></form> 
                <tr>
                <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
                <td><input type="" id="total_bobot" class="total_bobot" name="total_bobot"  size="6" style="text-align: center;" readonly></td>
                <td colspan="4" style="font-weight: bold; color: red; font-size: 17px">* Total Bobot harus 100%</td>
              </tr>
              </tbody>
              <thead class="thead-light">
              <tr>
                <th colspan="10"><strong>TARGET PENALTY</strong></th>
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
              <?php $no=0; foreach ($data_target_penalty as $p) : $no++?>
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
            <table class="table" style="margin-bottom: -20px;">
              <tr>
                <?php if ($buat_ski != "kadiv"): ?>

                 <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-info btn-lg" onclick="tampil()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung()" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>
                <?php else: ?>
                  <td>
                    <a href="<?php echo base_url('master/penetapan_karyawan');?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                  </td>

                  <td style="text-align: right;">
                    <button type="button" id="simpan" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_1()" data-toggle="tooltip" data-placement="top" data-original-title="Bila akan submit lain waktu. Maka tekan SIMPAN, data akan tersimpan"><i class="fas fa-save"></i><?= nbs(3) ?>S I M P A N</button> <?php echo nbs(5) ?>
                    <button type="button" id="kirim" class="btn btn-success btn-lg" onclick="submit_langsung_1('<?= $data_karyawan['NIPEG'] ?>')" data-toggle="tooltip" data-placement="top" data-original-title="Bila data telah yakin benar dan tidak akan diubah. Maka tekan SUBMIT"><i class="fas fa-check"></i><?= nbs(3) ?>S U B M I T</button>
                  </td>

                <?php endif ?>
                
              </tr>
            </table>

      <?php } ?>

            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                        <h3 style="text-align: center;"> Data Target Penalty Divisi <?= $data_karyawan['DIVISI'] ?> Belum Dibuat</h3>
                </div>
                <?php if ($buat_ski != "karyawan"): ?>
                <?= br(6) ?>
                <table class="table">
                  <td>
                    <a href="<?php echo base_url('master/penetapan_karyawan');?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                  </td>
                </table>
              <?php endif ?>
            <?php endif ?>

        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                    <h3 style="text-align: center;">Belum Memiliki Indikator Kerja</h3>
            </div>
            <?php if ($buat_ski != "karyawan"): ?>
            <?= br(6) ?>
            <table class="table">
              <td>
                <a href="<?php echo base_url('master/penetapan_karyawan');?>"> <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
              </td>
            </table>
            <?php endif ?>
            
        <?php endif ?>

        

        </div>
      </div>
    </div>      
  </div>
</div>


  <!-- Menampilkan MODAL -->
  <div class="modal fade" tabindex="-1" id="modal_form" role="dialog" style="background: transparent;">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style=" background-color:rgba(255,255,255,0.7); border-radius: 10px;">
        <div class="modal-header">
          <h6 class="modal-label"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body form" style=" background-color:rgba(255,255,255,0.4);">
          <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
            <h4 class="modal-title" align="center" style="color: red;"></h4>
          </form>
        </div>
            
        <div class="modal-footer"></div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal fade-->

<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">

    function tampil_1(){
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

        url = "<?php echo site_url('Master/tambah_ski')?>";

      }
        

      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          url = "<?php echo site_url('master/ubah_ski/'.$nip_kadiv)?>";
          window.location.href=url;
        }
      });

  }

  function submit_langsung_1(id){
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

                   url = "<?php echo site_url('Master/submit_nilai_langsung')?>/"+id;
                }

                // ajax delete data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        
                       url = "<?php echo site_url('master/ubah_ski/'.$nip_kadiv)?>";

                        window.location.href=url;
                    }
                });
         
            }

        }
</script>

