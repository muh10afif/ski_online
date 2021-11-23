<style type="text/css">
  th{
    text-align: center;
    font-size: 13px;
    font-weight: bolder;
  }
  tbody{
      font-size: 13px;
    }
</style>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">

        <div class="col-md-12">
                <label><strong><h3>History SKI Tahun <?php echo $param_tahun?></h3></strong></label><?= br(2) ?>
        <div class="card">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#penetapan" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><h5>Penetapan SKI</h5></span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tw1" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><h5>Triwulan I</h5></span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tw2" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><h5>Triwulan II</h5></span></a> </li>
             <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tw3" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><h5>Triwulan III</h5></span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tw4" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><h5>Triwulan IV</h5></span></a> </li>
        </ul>

         <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
          <div class="tab-pane active" id="penetapan" role="tabpanel">
            <div class="p-20">
              <div class="form">

                  <?php 

                    $utama    = "data_target_utama";
                    $sla      = "data_target_sla";
                    $penalti  = "penalti_penetapan";              
                    $waktu    = "waktu_ski";
                    $pnetapan = "penetapan";
                    $divisi   = "divisi";

                  for($i = 1; $i < $jml; $i++){

                      $d  =   $utama.$i;
                      $b  =   $sla.$i;
                      $c  =   $penalti.$i;
                      $e  =   $waktu.$i;
                      $f  =   $pnetapan.$i;
                      $g  =   $divisi.$i;

                  ?>
                                                          
                 <?php 
                 foreach ($$f as $atasan) {
                   $a = $atasan['ATASAN_1'];
                 }

                  if ($a == null) { ?>
                    <div class="col-md-12">
                      <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($$e->input_time) ?></strong></div>
                    </div>
                
                      <div class="alert alert-secondary" role="alert">
                          <h3 style="text-align: center;">Menunggu Approve Atasan Langsung</h3>
                      </div>
                      <?= br(6) ?>
                      <table class="table" style="margin-bottom: -50px;">
                        <tr>
                          <td>
                            <?php if ($histori != 'admin'): ?>
                              <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                            <?php else: ?>
                              <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                            <?php endif ?>
                             <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button> </a>
                          </td> 
                        </tr>
                      </table>

                  <?php  } else { ?>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($$e->input_time) ?></strong></div>
                        </div>
                      <div class="col-md-6">
                        <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve Atasan : <strong><?= tgl_indo_timestamp($$e->approve_atasan1_datetime) ?></strong></div>
                      </div>
                    </div>


                    <table class="table table-responsive table-bordered table-hover" >
                    <thead class="thead-light">

                    <tr>
                    <th colspan="11" style="text-align: center;"><b>PENETAPAN SKI <?php echo $i; echo' ('.$$g.')'  ?></b></th>
                    </tr>
                    <tr>
                      <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
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

                    <?php  $no=0; 
                      foreach ($$d as $tu ) :
                        $no++
                    ?>
                      <tr>
                        <td style="text-align: center; font-weight: bold;">  UTAMA </td>
                        <td style="text-align: center;">  <?php echo $no;?> </td>
                        <td style="text-align: ;"> <?php echo $tu->nama_indikator ?>   </td>
                        <td style="text-align: center;">  <?php echo $tu->satuan_indikator ?> </td>
                        <td style="text-align: ;"> <?php echo $tu->cara_pengukuran ?>  </td>
                        <td style="text-align: center;"> <?php echo $tu->target_pertahun ?>  </td>
                        <td style="text-align: center;">  <?php echo $tu->bobot ?>%  </td>
                        <td style="text-align: center;">  <?php echo $tu->tw1 ?>    </td>
                        <td style="text-align: center;">  <?php echo $tu->tw2 ?>    </td>
                        <td style="text-align: center;">  <?php echo $tu->tw3 ?>    </td>
                        <td style="text-align: center;"> <?php echo $tu->tw4 ?></td>
                      </tr>
                    <?php endforeach  ?>
                    
                    <?php $no=0; 
                      foreach ($$b as $ts ) : 
                        $no++ ?>
                      <tr>
                        <td style="text-align: center; font-weight: bold;">  SLA  </td>
                        <td style="text-align: center;">  <?php echo $no; ?>  </td>
                        <td style="text-align: ;"> <?php echo $ts->nama_indikator ?>   </td>
                        <td style="text-align: center;">  <?php echo $ts->satuan_indikator ?> </td>
                        <td style="text-align: ;"> <?php echo $ts->cara_pengukuran ?>  </td>
                        <td style="text-align: center;"> <?php echo $ts->target_pertahun ?></td>
                        <td style="text-align: center;">  <?php echo $ts->bobot ?>%</td>
                        <td style="text-align: center;">  <?php echo $ts->tw1 ?>  </td>
                        <td style="text-align: center;">  <?php echo $ts->tw2 ?>  </td>
                        <td style="text-align: center;">  <?php echo $ts->tw3 ?>  </td>
                        <td style="text-align: center;"> <?php echo $ts->tw4 ?></td>
                      </tr>      
                    <?php endforeach ?>
                                                      
                      <tr>
                        <td colspan="6" style="font-weight: bold; text-align: right; font-size: 15px;">Total Bobot SKI</td>
                        <td style="font-weight: bold; text-align: center; font-size: 15px;"> 100%</td>
                        <td colspan="5"></td>
                      </tr>

                    </tbody>

                    <thead class="thead-light">
                      <tr>
                        <th colspan="11" style="text-align: center;"><b>PENALTY</b></th>
                        </tr>
                       <tr>
                        <th rowspan="2" style="vertical-align: middle;"><strong> Target </strong></th>
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
                    <?php $no = 1; foreach ($$c as $key):?>
                       <tr>
                          <td style="text-align: center; font-weight: bold;"> PENALTY </td>
                          <td style="text-align: center;"><?= $no ?></td>
                          <td style="text-align: ;"><?= $key->nama_indikator ?></td>
                          <td style="text-align: center;"><?= $key->satuan_indikator ?></td>
                          <td style="text-align: ;"><?= $key->cara_pengukuran ?></td>
                          <td style="text-align: center;"><?= -$key->TARGET_PERTAHUN ?></td>
                          <td style="text-align: center;"><?= -$key->BOBOT ?>%</td>
                          <td style="text-align: center;"><?= -$key->TW1 ?></td>
                          <td style="text-align: center;"><?= -$key->TW2 ?></td>
                          <td style="text-align: center;"><?= -$key->TW3 ?></td>
                          <td style="text-align: center;"><?= -$key->TW4 ?></td>
                        </tr> 
                    <?php endforeach ?>

                      <tr>
                        <td colspan="6"  style="text-align: right; font-size: 15px;"><b>Total Bobot Penalty </b></td>
                        <td style="font-weight: bold; text-align: center; font-size: 15px;"> <?php echo -$key->TOTAL_BOBOT ?>%</td>
                        <td colspan="4"></td>
                      </tr>
                    </tbody>
                    </table><br>  
                    <table class="table" style="margin-bottom: ;">
                      <tr>
                        <td colspan="11" >
                          <?php if ($histori != 'admin'): ?>
                            <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                          <?php else: ?>
                            <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                          <?php endif ?>
                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>

                            </a>
                          
                          

                          <div style="float: right;" > 
                           <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>karyawan/print_penetapan">
                                                                                
                          <input type="hidden" value="<?= $data_karyawan['NIPEG'] ?>" name="nipeg"></input>
                          <input type="hidden" value="<?php echo $param_tahun?>" name="thn"></input>
                          <input type="hidden" value="<?php echo $i?>" name="versi"></input>
                          
                           <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak Data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T <?php echo $i?></button> 
                         
                          </div>
                          </form>
                        </td> 
                      </tr>
                    </table><hr>

                    <?php } } ?>
               </div>
          </div>
      </div>
                                <div class="tab-pane  " id="tw1" role="tabpanel">
                                    <div class="p-20">
                                      
                                          <div class="form">

                                              <?php foreach ($waktu_tw1 as $wt): 
                                                $tgl_submit = $wt->input_time;
                                                $tgl_approve_1 = $wt->approve_atasan1_datetime;
                                                $tgl_approve_2 = $wt->approve_atasan2_datetime; ?>
                                              <?php endforeach ?>

                                              <?php 
                                                $ATASAN_1 =  $total_tw1['ATASAN_1'];
                                                $ATASAN_2 =  $total_tw1['ATASAN_2'];
                                               
                                                $a = $count_tw1;
                                                if ($a == 0) {?>
                                                      <div class="alert alert-danger" role="alert" style="margin-top: 70px; text-align: center;">
                                                        <h3>Belum Membuat SKI TW I</h3>
                                                      </div>  
                                                     <?= br(7) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                               
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                <?php } else { ?>


                                                <?php 

                                                      if ($ATASAN_1 == null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div></div>
                                                        <div class="alert alert-info" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan Langsung</h3>
                                                      </div>
                                                        <?= br(6) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>

                                                      <?php } else if( $ATASAN_1 != null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                    </div>
                                                    <div class="alert alert-secondary" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan 2</h3>
                                                      </div>
                                                    <?= br(6) ?>
                                                    <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                       <?php }  else {?>
                                                      <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 2 : <strong><?= tgl_indo_timestamp($tgl_approve_2) ?></strong></div>
                                                      </div>
                                                    </div>

                                                <table class="table table-responsive table-bordered table-hover" >
                                                  <thead class="thead-light">
                                                             <tr>
                                                              <th colspan="10" style="text-align: center;"><b>TRIWULAN I</b></th>
                                                              </tr>
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
                                                              <th style="vertical-align: middle;"><strong> TW I </strong></th>
                                                            </tr>
                                                            <?php  $no=0; 
                                                              foreach ($data_target_utama_tw1 as $utama ) :
                                                                $no++
                                                            ?>
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
                                                            <tr>
                                                            <?php endforeach  ?>
                                                            </tr>

                                                
                                                            <?php $no=0; 
                                                              foreach ($data_target_sla_tw1 as $sla ) : 
                                                                $no++ ?>
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
                                                             <tr>
                                                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                                                              <?php if (!empty($data_target_utama_tw1) && empty($data_target_sla_tw1)): ?>
                                                                Total SKI Utama TW I                                                              <?php elseif (empty($data_target_utama_tw1) && !empty($data_target_sla_tw1)): ?>
                                                                Total SKI SLA TW I
                                                              <?php else: ?>
                                                                Total SKI Utama + SLA TW I
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
                                                                  }?>%
                                                              </td>
                                                             </tr>
                                                            
                                                              <tr>
                                                                <th colspan="10" style="font-weight: bold; vertical-align: middle;" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>

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
                                                                <th style="vertical-align: middle;"><strong> TW I </strong></th>
                                                              </tr>

                                                              <?php  $no = 1; foreach ($penalti_tw1 as $dtp ):?>
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


                                                              <tr>
                                                               
                                                                <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Penalty TW I</td>
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
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
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
                        
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

                                                                  ?>%</td>
                                                              </tr>
                                                             


                                                            </table>
                                                    
                                                            <br>  
                                                            <table class="table">
                                                              <tr>
                                                                <td colspan="11" >
                                                                  <?php if ($histori != 'admin'): ?>
                                                                    <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                                  <?php else: ?>
                                                                    <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                                  <?php endif ?>

                                                                  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                                  </a>

                                                                   <div style="float: right;" > 

                                                                   <a href="<?php $tw='1'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                     <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak Data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                   
                                                                    </div>
                                                                  </form>
                                                                            
                                                                           
                                                               
                                                                </td> 
                                                              </tr>
                                                            </table>
                                                 <?php } 
                                                   }?>

                                              
                                                   

                                                    
                                                  </div>



                                    </div>
                                </div>
                                <div class="tab-pane " id="tw2" role="tabpanel">
                                    <div class="p-20">
                                       




                                        <div class="form">
                                            <?php foreach ($waktu_tw2 as $wt): 
                                                $tgl_submit = $wt->input_time;
                                                $tgl_approve_1 = $wt->approve_atasan1_datetime;
                                                $tgl_approve_2 = $wt->approve_atasan2_datetime; ?>
                                              <?php endforeach ?>
                                                    
                                        
                                              <?php 
                                                $ATASAN_1 =  $total_tw2['ATASAN_1'];
                                                $ATASAN_2 =  $total_tw2['ATASAN_2'];
                                               
                                                $a = $count_tw2;
                                                if ($a == 0) {?>
                                                     <div class="alert alert-danger" role="alert" style="margin-top: 70px; text-align: center;">
                                                        <h3>Belum Membuat SKI TW II</h3>
                                                      </div>  
                                                     <?= br(7) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                <?php } else { ?>


                                                <?php 

                                                      if ($ATASAN_1 == null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div></div>
                                                        <div class="alert alert-info" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan Langsung</h3>
                                                      </div>
                                                        <?= br(6) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>

                                                      <?php } else if( $ATASAN_1 != null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                    </div>
                                                    <div class="alert alert-secondary" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan 2</h3>
                                                      </div>
                                                    <?= br(6) ?>
                                                    <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                       <?php }  else {?>
                                                      <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 2 : <strong><?= tgl_indo_timestamp($tgl_approve_2) ?></strong></div>
                                                      </div>
                                                    </div>

                                                 <table class="table table-responsive table-bordered table-hover" >
                                                  <thead class="thead-light">
                                                          <tr>
                                                              <th colspan="10" style="text-align: center;"><b>TRIWULAN II</b></th>
                                                              </tr>
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
                                                              <th style="vertical-align: middle;"><strong> TW II </strong></th>
                                                            </tr>
                                                            <?php  $no=0; 
                                                              foreach ($data_target_utama_tw2 as $utama ) :
                                                                $no++
                                                            ?>
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
                                                            <tr>
                                                            <?php endforeach  ?>
                                                            </tr>

                                                
                                                            <?php $no=0; 
                                                              foreach ($data_target_sla_tw2 as $sla ) : 
                                                                $no++ ?>
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
                                                             <tr>
                                                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                                                                <?php if (!empty($data_target_utama_tw2) && empty($data_target_sla_tw2)): ?>
                                                                  Total SKI Utama TW II                                                             <?php elseif (empty($data_target_utama_tw2) && !empty($data_target_sla_tw2)): ?>
                                                                  Total SKI SLA TW II
                                                                <?php else: ?>
                                                                  Total SKI Utama + SLA TW II
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
                                                            
                                                              <tr>
                                                                <th colspan="10" style="font-weight: bold; vertical-align: middle;" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>

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
                                                                <th style="vertical-align: middle;"><strong> TW II </strong></th>
                                                              </tr>

                                                              <?php  $no = 1; foreach ($penalti_tw2 as $dtp ):?>
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


                                                              <tr>
                                                               
                                                                <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Penalty TW II</td>
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
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
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
                        
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

                                                                  ?>%</td>
                                                              </tr>
                                                              

                                                            </table><br>

                                                             <table class="table">
                                                              <tr>
                                                                <td colspan="11" >
                                                                    <?php if ($histori != 'admin'): ?>
                                                                      <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                                    <?php else: ?>
                                                                      <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                                    <?php endif ?>

                                                                    <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                                    </a> 

                                                                   <div style="float: right;" > 

                                                                   <a href="<?php $tw='2'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                     <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak Data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                   
                                                                    </div>
                                                                  </form>
                                                                            
                                                                           
                                                               
                                                                </td> 
                                                              </tr>
                                                            </table>
                                                  <?php } } ?>
                                                  </div>

                                    </div>
                                </div>

                                <div class="tab-pane  " id="tw3" role="tabpanel">
                                    <div class="p-20">
                                      


                                      <div class="form">
                                               <?php foreach ($waktu_tw3 as $wt): 
                                                $tgl_submit = $wt->input_time;
                                                $tgl_approve_1 = $wt->approve_atasan1_datetime;
                                                $tgl_approve_2 = $wt->approve_atasan2_datetime; ?>
                                              <?php endforeach ?>
                                                
                                              <?php 
                                                $ATASAN_1 =  $total_tw3['ATASAN_1'];
                                                $ATASAN_2 =  $total_tw3['ATASAN_2'];
                                               
                                                $a = $count_tw3;
                                                if ($a == 0) {?>
                                                     <div class="alert alert-danger" role="alert" style="margin-top: 70px; text-align: center;">
                                                        <h3>Belum Membuat SKI TW III</h3>
                                                      </div>  
                                                     <?= br(7) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                <?php } else { ?>


                                                <?php 

                                                      if ($ATASAN_1 == null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div></div>
                                                        <div class="alert alert-info" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan Langsung</h3>
                                                      </div>
                                                        <?= br(6) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>

                                                      <?php } else if( $ATASAN_1 != null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                    </div>
                                                    <div class="alert alert-secondary" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan 2</h3>
                                                      </div>
                                                    <?= br(6) ?>
                                                    <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>

                                                     <?php }  else {?>
                                                      <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 2 : <strong><?= tgl_indo_timestamp($tgl_approve_2) ?></strong></div>
                                                      </div>
                                                    </div>

                                                <table class="table table-responsive table-bordered table-hover" >
                                                  <thead class="thead-light">
                                                        <tr>
                                                              <th colspan="10" style="text-align: center;"><b>TRIWULAN III</b></th>
                                                              </tr>
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
                                                              <th style="vertical-align: middle;"><strong> TW III </strong></th>
                                                            </tr>
                                                            <?php  $no=0; 
                                                              foreach ($data_target_utama_tw3 as $utama ) :
                                                                $no++
                                                            ?>
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
                                                            <tr>
                                                            <?php endforeach  ?>
                                                            </tr>

                                                
                                                            <?php $no=0; 
                                                              foreach ($data_target_sla_tw3 as $sla ) : 
                                                                $no++ ?>
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
                                                             <tr>
                                                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                                                                <?php if (!empty($data_target_utama_tw3) && empty($data_target_sla_tw3)): ?>
                                                                  Total SKI Utama TW III
                                                                  <?php elseif (empty($data_target_utama_tw3) && !empty($data_target_sla_tw3)): ?>
                                                                  Total SKI SLA TW III
                                                                <?php else: ?>
                                                                  Total SKI Utama + SLA TW III
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
                                                                  }?>%
                                                              </td>
                                                             </tr>
                                                            
                                                              <tr>
                                                                <th colspan="10" style="font-weight: bold; vertical-align: middle;" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>

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
                                                                <th style="vertical-align: middle;"><strong> TW III </strong></th>
                                                              </tr>

                                                              <?php  $no = 1; foreach ($penalti_tw3 as $dtp ):?>
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
                                                               
                                                                <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Penalty TW III</td>
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
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
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
                        
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

                                                                  ?>%</td>
                                                              </tr>

                                                            </table><br>
                                                             <table class="table">
                                                              <tr>
                                                                <td colspan="11" >
                                                                    <?php if ($histori != 'admin'): ?>
                                                                      <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                                    <?php else: ?>
                                                                      <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                                    <?php endif ?>

                                                                    <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                                    </a>

                                                                   <div style="float: right;" > 

                                                                   <a href="<?php $tw='3'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                     <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak Data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                   
                                                                    </div>
                                                                  </form>
                                                                            
                                                                           
                                                               
                                                                </td> 
                                                              </tr>
                                                            </table>
                                                         <?php } } ?>
                                                  </div>

                                    

                                    </div>
                                </div>
                                <div class="tab-pane " id="tw4" role="tabpanel">
                                    <div class="p-20">
                                       

                                        <div class="form">

                                              <?php foreach ($waktu_tw4 as $wt): 
                                                $tgl_submit = $wt->input_time;
                                                $tgl_approve_1 = $wt->approve_atasan1_datetime;
                                                $tgl_approve_2 = $wt->approve_atasan2_datetime; ?>
                                              <?php endforeach ?>
                                            

                                              <?php 
                                                $ATASAN_1 =  $total_tw4['ATASAN_1'];
                                                $ATASAN_2 =  $total_tw4['ATASAN_2'];
                                               
                                                $a = $count_tw4;
                                                if ($a == 0) {?>
                                                     <div class="alert alert-danger" role="alert" style="margin-top: 70px; text-align: center;">
                                                        <h3>Belum Membuat SKI TW IV</h3>
                                                      </div>  
                                                     <?= br(7) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                <?php } else { ?>


                                               <?php 

                                                      if ($ATASAN_1 == null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div></div>
                                                        <div class="alert alert-info" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan Langsung</h3>
                                                      </div>
                                                        <?= br(6) ?>
                                                        <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>

                                                      <?php } else if( $ATASAN_1 != null && $ATASAN_2 == null ) {?>
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                    </div>
                                                    <div class="alert alert-secondary" role="alert" style="margin-top: 12px; text-align: center;">
                                                        <h3>Menunggu Approve Atasan 2</h3>
                                                      </div>
                                                    <?= br(6) ?>
                                                    <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td>
                                                              <?php if ($histori != 'admin'): ?>
                                                                <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                              <?php else: ?>
                                                                <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                              <?php endif ?>

                                                              <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                              </a>
                                                            </td> 
                                                          </tr>
                                                        </table>
                                                       <?php }  else {?>
                                                      <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($tgl_submit) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-primary" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 1 : <strong><?= tgl_indo_timestamp($tgl_approve_1) ?></strong></div>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve 2 : <strong><?= tgl_indo_timestamp($tgl_approve_2) ?></strong></div>
                                                      </div>
                                                    </div>
                                          <table class="table table-responsive table-bordered table-hover" >
                                                  <thead class="thead-light">
                                                            <tr>
                                                              <th colspan="10" style="text-align: center;"><b>TRIWULAN IV</b></th>
                                                              </tr>
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
                                                              <th style="vertical-align: middle;"><strong> TW IV </strong></th>
                                                            </tr>
                                                          </thead>
                                                            <?php  $no=0; 
                                                              foreach ($data_target_utama_tw4 as $utama ) :
                                                                $no++
                                                            ?>
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
                                                            
                                                            <?php endforeach  ?>
                                                            

                                                
                                                            <?php $no=0; 
                                                              foreach ($data_target_sla_tw4 as $sla ) : 
                                                                $no++ ?>
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
                                                             <tr>
                                                              <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">
                                                                <?php if (!empty($data_target_utama_tw4) && empty($data_target_sla_tw4)): ?>
                                                                Total SKI Utama TW IV                                                              <?php elseif (empty($data_target_utama_tw4) && !empty($data_target_sla_tw4)): ?>
                                                                Total SKI SLA TW IV
                                                              <?php else: ?>
                                                                Total SKI Utama + SLA TW IV
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
                                                                  }?>%
                                                              </td>
                                                             </tr>
                                                            <thead class="thead-light">
                                                              <tr>
                                                                <th colspan="10" style="font-weight: bold; vertical-align: middle;" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>

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
                                                                <th style="vertical-align: middle;"><strong> TW IV </strong></th>
                                                              </tr>
                                                            </thead>

                                                              <?php  $no = 1; foreach ($penalti_tw4 as $dtp ):?>
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
                                                               
                                                                <td colspan="9" style="text-align: right; font-weight: bolder; font-size: 15px;">Total Penalty TW IV</td>
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
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
                                                                <td style="text-align: center; font-weight: bolder; font-size: 15px;"><?php 
                        
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

                                                                  ?>%</td>
                                                              </tr>
                                                           

                                                            </table><br>
                                                             <table class="table" style="margin-bottom: -50px;">
                                                              <tr>
                                                                <td colspan="11" >
                                                                  <?php if ($histori != 'admin'): ?>
                                                                    <a href="<?php echo base_url('Karyawan/History_ski');?>">  
                                                                  <?php else: ?>
                                                                    <a href="<?php echo base_url("Admin/list_histori/$nipeg_param");?>">  
                                                                  <?php endif ?>

                                                                  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                                  </a>

                                                                   <div style="float: right;" > 

                                                                   <a href="<?php $tw='4'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                     <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak Data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                   
                                                                    </div>
                                                                  </form>
                                                                            
                                                                           
                                                               
                                                                </td> 
                                                              </tr>
                                                            </table>
                                                        <?php } } ?>
                                        </div>




                                    </div>
                                </div>




                            </div>

        </div>

</div>

</div>
       
  </div>
</div>
