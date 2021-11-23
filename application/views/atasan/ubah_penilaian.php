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
                  <table class="table table-responsive table-bordered table-hover" >
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
                    <th style="vertical-align: middle;"><strong> <?= $ambil_nilai->jenis_realisasi ?></strong></th>
                  </tr>
                  </thead>
                  <tbody>
                    <form action="#" id="form"  method="post">
                    <tr>

                    
                    <?php $no=0; foreach ($target_utama_nilai as $utama ) : $no++?>
                    <td style="text-align: center; font-weight: bold; font-size: 15px;">UTAMA</td>
                    <td style="text-align: center;"><?= $no; ?></td>
                    <td style="text-align: ;">
                      <input type="hidden" value="<?= $utama->id_indikator ?>" name="id_indikator[]">
                      <input type="hidden" value="<?= $utama->id_proker ?>" name="id_proker[]">
                      <input type="hidden" value="<?= $utama->id_realisasi ?>" name="id_realisasi[]">
                      <input type="hidden" value="<?= $utama->NIPEG ?>" name="NIPEG[]">
                      <?= $utama->nama_indikator ?>
                      
                  </td>
                    <td style="text-align: center;"><?= $utama->satuan_indikator ?></td>
                    <td style="text-align: ;"><?= $utama->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?php echo $utama->target_pertahun ?></td>
                    <td style="text-align: center;">
                      <input type="hidden" size="7" style="text-align: center;" name="bobot[]" class="bobot<?php echo $no;?>" value="<?= $utama->bobot?>" onkeyup="hitung(<?php echo $no;?>);" readonly>
                      <?= $utama->bobot?>%</td>
                    <td style="text-align: center;">
                      <input type="hidden" size="7" style="text-align: center;" name="nilai_penetapan[]" class="target<?php echo $no;?>" value="<?= $utama->nilai_penetapan ?>" onkeyup="hitung(<?php echo $no;?>);" readonly>
                      <?php echo $utama->nilai_penetapan ?></td>
                    <td>
                      <input type="number" style="text-align: center; width: 60px;" name="realisasi[]" class="realisasi<?php echo $no;?>" value="<?= $utama->realisasi ?>" onkeyup="hitung(<?php echo $no;?>);" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                    <td>
                      <input type="text" size="6" style="text-align: center;" name="nilai_realisasi[]" id="nilai_utama" class="nilai_utama<?php echo $no;?>" value="<?= $utama->nilai_realisasi ?>" readonly>
                    
                      <input type="hidden" size="7" style="text-align: center;" name="nilai_maksimal_utama" size="7" class="nilai_maksimal_utama<?php echo $no; ?>" value="<?= $utama->nilai_maksimal ?>" readonly>
                      <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?= $utama->nilai_ski ?>"readonly><?php $tot_nilai = $utama->nilai_ski ?></td>
                  </tr> 
                    <?php endforeach ?>
                  
                  <tr>

                    <?php  $no=0; foreach($target_sla_nilai as $sla ) : $no++ ?>
                    <td style="text-align: center;font-weight: bold; font-size: 15px;">SLA</td>
                    <td><?= $no; ?></td>
                    <td>
                      <input type="hidden" value="<?= $sla->id_indikator ?>" name="id_indikator[]"><input type="hidden" value="<?= $sla->id_proker ?>" name="id_proker[]"><input type="hidden" value="<?= $sla->id_realisasi ?>" name="id_realisasi[]">
                      <input type="hidden" value="<?= $utama->NIPEG ?>" name="NIPEG[]">
                      <?= $sla->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $sla->satuan_indikator ?></td>
                    <td style="text-align: ;"><?= $sla->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?php echo $sla->target_pertahun ?></td>
                    <td style="text-align: center;">
                      <input type="hidden" size="7"  style="text-align: center;" name="bobot[]" class="bobot_sla<?php echo $no;?>" onkeyup="hitung_sla(<?php echo $no;?>);" value="<?= $sla->bobot?>" readonly>
                      <?= $sla->bobot?>%</td>
                    <td style="text-align: center;">
                      <input type="hidden" size="7"  style="text-align: center;" name="nilai_penetapan[]" class="target_sla<?php echo $no;?>" onkeyup="hitung_sla(<?php echo $no;?>);" value="<?= $sla->nilai_penetapan ?>" readonly>
                      <?= $sla->nilai_penetapan ?></td>
                    <td>
                      <input type="number"  style="text-align: center; width: 60px;" name="realisasi[]" class="realisasi_sla<?php echo $no;?>" onkeyup="hitung_sla(<?php echo $no;?>);" value="<?= $sla->realisasi ?>" data-toggle="tooltip" title="Rumus Nilai: (Realisasi / Target) x Bobot"></td>
                    <td>
                      <input type="text" size="6"  style="text-align: center;" name="nilai_realisasi[]" id="nilai_sla" class="nilai_sla<?php echo $no;?>" value="<?= $sla->nilai_realisasi ?>" readonly>
                      <input type="hidden" size="7"  style="text-align: center;" class="nilai_maksimal_sla<?php echo $no; ?>" name="nilai_maksimal_sla" value="<?= $sla->nilai_maksimal ?>" readonly>
                      <input type="hidden" style="text-align: center;" name="total_nilai_ski[]" id="total_nilai_ski" size="6" value="<?= $sla->nilai_ski ?>" readonly><?php $tot_nilai = $sla->nilai_ski ?></td>
                    
                  </tr>
                     <?php endforeach ?>
                  <tr>
                    <td colspan="9" style="text-align: right; font-weight: bold; font-size: 15px;">
                      <?php if (!empty($target_utama_nilai) && empty($target_sla_nilai)): ?>
                      Total SKI Utama <?= $status ?>
                    <?php elseif (empty($target_utama_nilai) && !empty($target_sla_nilai)): ?>
                      Total SKI SLA <?= $status ?>
                    <?php else: ?>
                      Total SKI Utama + SLA <?= $status ?>
                    <?php endif ?>
                    </td>
                    <td><input type="text" size="6" style="text-align: center;" class="nilai" id="tot_nilai_tw" name="total_realisasi" value="<?= $ambil_nilai->total_realisasi ?>" readonly></td>
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
                      <td style="text-align: center; font-weight: bold;font-size: 15px;">PENALTY</td>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td style="text-align: ;"><?= $dtp->nama_indikator ?></td>
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
                        <input type="hidden" size="6" id="tot_penalty" value="<?php echo $dtp->TOTAL_NILAI ?>">
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

                        ?>%</td>
                    </tr>
                    <tr>
                      <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px; vertical-align: middle;">Total Nilai</td>
                      <td style="text-align: center;font-weight: bolder; font-size: 15px;">
                        <input type="text" style="text-align: center;" name="total_nilai_" id="total_nilai_ski" size="6" value="<?php echo $tot_nilai ?>" readonly>
                      </td>
                    </tr>
                    </tbody>
                </table><br>
                <table class="table">
                  <tr>
                    <td> <a href="<?php echo base_url();?>Atasan1/karyawan_penilaian/<?= $data_karyawan['NIPEG'] ?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a></td>
                    <input type="hidden" value="<?php echo $approve ?>">
                    <?php if ($ambil_nilai->$approve == 'BELUM'): ?>
                      <td style="text-align: right;">
                        <button type="button" id="ubah" class="btn btn-warning btn-lg" style="color: black;" onclick="tampil_ubah_penilaian()" data-toggle="tooltip" data-original-title="Tekan SAVE bila data ingin disimpan perubahannya"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button>
                      </td>
                    <?php endif ?>
                    
                  </tr>
                  </table>

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

                             <!--- SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1
-->

        <h4 class="modal-title" align="center" style="color: red;">Tambah Data Indikator</h4>


                     
        </form>
           
          </div>
          <div class="modal-footer">
            
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

function hitung(id) {
          var m = 0;

          var nilai_maksimal_utama = $(".nilai_maksimal_utama"+id).val();

          var r = $(".realisasi"+id).val();
          var t = $(".target"+id).val();
          var b = $(".bobot"+id).val();
          n = (parseInt(r)/parseInt(t))*parseInt(b);

          
           if (!isNaN(n))  
            {
              if (n <= nilai_maksimal_utama) {
                  $(".nilai_utama"+id).val(n);
              } else {
                  $(".nilai_utama"+id).val(n);
                  $('#modal_form').modal('show'); 
                  $('.modal-label').text('Total maksimal nilai '+nilai_maksimal_utama+'%'); 
                  $('.modal-title').text('Total Nilai Kurang dari '+nilai_maksimal_utama+'%'); 
                  $('#ubah').hide();
                  $(".realisasi"+id).val(m);
              }
            } else {
                $(".nilai_utama"+id).val(m);
                $('#ubah').show();
            }
    }

    function hitung_sla(id) {
          var m = 0;

          var nilai_maksimal_sla = $(".nilai_maksimal_sla"+id).val();

          var r = $(".realisasi_sla"+id).val();
          var t = $(".target_sla"+id).val();         
          var b = $(".bobot_sla"+id).val();
           n = (parseInt(r)/parseInt(t))*parseInt(b);

           if (!isNaN(n))  
            {
              if (n <= nilai_maksimal_sla) {
                  $(".nilai_sla"+id).val(n);
              } else {
                  $(".nilai_sla"+id).val(n);
                  $('#modal_form').modal('show'); 
                  $('.modal-label').text('Total maksimal nilai '+nilai_maksimal_sla+'%'); 
                  $('.modal-title').text('Total Nilai Kurang dari '+nilai_maksimal_sla+'%'); 
                  $('#ubah').hide();
                  $(".realisasi_sla"+id).val();
              }
            } else {
                $(".nilai_sla"+id).val(m);
                $('#ubah').show();
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
  
</script>

<script type="text/javascript">
  $(document).ready(function(e) {
   
    $("input").keyup( function() {

      var tot_nilai_2 = 0;
      var a = $("input[id=tot_nilai_tw]").val();
      var b = $("input[id=tot_penalty]").val();
      tot_nilai_2 = parseFloat(a) + parseFloat(b);

      if (!isNaN(tot_nilai_2)) 
            {
                $("input[id=total_nilai_ski]").val(tot_nilai_2);
            }
      
    });
  });
</script>

</body>
</html>

