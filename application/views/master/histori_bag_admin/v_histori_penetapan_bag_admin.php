<style type="text/css">
  th{
    text-align: center;
    font-size: 15px;
  }
</style>
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">

            <div class="row">

                 <div class="col-md-2">
                    <div class="card">
                        <div class="card-body" style=" margin-left:auto; margin-right: auto; ">
                            <img  src="<?php echo $poto_karyawan_histori;?>" alt="user" class="img-thumbnail img-responsive" width="100%">
                        </div>
                    </div>
                 </div>

                 <div class="col-md-5">
                       <div class="card">
                            <div class="card-body" style="margin-top: 10px;">
                               <div class="table-responsive" >
                                  <table border="0" >
                                      <tr >
                                          <td style="width:100px"> <h5 >Nama</h5></td>
                                          <td style="width:20px"><h5 >:</h5></td>
                                          <td><h5 ><?= $data_karyawan['NAMA'] ?></h5></td>
                                      </tr>
                                      <tr>
                                          <td><h5 >Nipeg</h5></td>
                                          <td><h5 >:</h5></td>
                                          <td><h5 ><?= $data_karyawan['NIPEG'] ?></h5></td>
                                      </tr>
                                      <tr>
                                          <td><h5 >Pangkat</h5></td>
                                          <td><h5 >:</h5></td>
                                          <td><h5 ><?= $data_karyawan['PANGKAT'] ?> </h5></td>
                                      </tr>
                                  </table>
                              </div>
                            </div>
                         </div>
                    </div>

                    <div class="col-md-5">
                       <div class="card">
                          <div class="card-body" style="margin-top: 10px;">
                              <div class="table-responsive" >
                                  <table border="0" >
                                      <tr >
                                          <td style="width:100px"> <h5 >Jabatan</h5></td>
                                          <td style="width:20px"><h5 >:</h5></td>
                                          <td><h5 ><?= $data_karyawan['JOBTITLE'] ?></h5></td>
                                      </tr>
                                      <tr>
                                          <td><h5 >Divisi</h5></td>
                                          <td><h5 >:</h5></td>
                                          <td><h5 ><?= $data_karyawan['DIVISI'] ?></h5></td>
                                      </tr>
                                     
                                  </table>
                              </div>
                          </div>
                        </div>
                    </div>
                     
              </div>

              <div class="col-md-12">
                  <label><strong><h3>History SKI Tahun <?php echo $param_tahun?></h3></strong></label><br>
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
                                    
                                   <?php $a = $penetapan['ATASAN_1']; 

                                    if ($a == null) { ?>
                                      <div class="col-md-12">
                                              <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($waktu_ski->input_time) ?></strong></div>
                                            </div>
                                        <div class="alert alert-secondary" role="alert">
                                            <h3 style="text-align: center;">Menunggu Approve Atasan Langsung</h3>
                                        </div><br><br>

                                        <table class="table" style="margin-bottom: -50px;">
                                            <tr>
                                              <td colspan="10" >
                                              
                                               <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                              
                                              </td>
                                            </tr>
                                           </table>

                                    <?php } else { ?>
                                      <div class="row">

                                      <div class="col-md-6">
                                              <div class="alert alert-warning" role="alert" style="font-size: 15px; text-align: center;">Tanggal Submit : <strong><?= tgl_indo_timestamp($waktu_ski->input_time) ?></strong></div>
                                              </div>
                                            <div class="col-md-6">
                                              <div class="alert alert-success" role="alert" style="font-size: 15px; text-align: center;">Tanggal Approve Atasan : <strong><?= tgl_indo_timestamp($waktu_ski->approve_atasan1_datetime) ?></strong></div>
                                              </div>
                                        </div>

                                       <table class="table table-responsive table-bordered table-hover" >
                                            <thead class="thead-light">

                                            <tr>
                                            <th colspan="11" style="text-align: center;"><b>PENETAPAN SKI</b></th>
                                            </tr>
                                            <tr>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">NO</th>
                                              <th colspan="2" style="font-weight: bold; vertical-align: middle;">Sasaran Kerja</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target Pertahun</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Bobot (%)</th>
                                              <th colspan="4" style="font-weight: bold; vertical-align: middle;">Target Sampai Dengan</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Pengukuran Sasaran Kerja</th>
                                            </tr>
                                            <tr>
                                              <th style="font-weight: bold; vertical-align: middle;">Indikator</th>
                                              <th style="font-weight: bold; vertical-align: middle;">Satuan Indikator</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW I</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW II</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW III</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW IV</th>
                                            </tr>
                                            </thead>

                                            <tr>

                                            <?php  $no=0; 
                                              foreach ($data_target_utama as $tu ) :
                                                $no++
                                            ?>
                                              <td  width="10%" style="text-align: center; font-weight: bold;">UTAMA</td>
                                              <td width="5%" style="text-align: center;"><?php echo $no;?></td>
                                              <td  width="10%" style="text-align: justify;"><?= $tu->nama_indikator ?></td>
                                              <td  width="8%" style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                                              <td  width="10%"><?= $tu->target_pertahun ?></td>
                                              <td  width="5%" ><?= $tu->bobot ?>%</td>
                                              <td  width="5%" ><?= $tu->tw1 ?><?= $tu->satuan_indikator ?></td>
                                              <td  width="5%" ><?= $tu->tw2 ?><?= $tu->satuan_indikator ?></td>
                                              <td  width="5%" ><?= $tu->tw3 ?><?= $tu->satuan_indikator ?></td>
                                              <td  width="5%" ><?= $tu->tw4 ?></td>
                                              <td  width="35%" style="text-align: justify;"><?= $tu->cara_pengukuran ?></td>
                                            </tr>
                                            <tr>
                                            <?php endforeach  ?>
                                            </tr>

                                            <?php $no=0; 
                                              foreach ($data_target_sla as $ts ) : 
                                                $no++ ?>
                                            <tr>
                                              <td style="text-align: center; font-weight: bold;">SLA</td>
                                              <td style="text-align: center;" ><?= $no; ?></td>
                                              <td style="text-align: justify;"><?= $ts->nama_indikator ?></td>
                                              <td style="text-align: center;"><?= $ts->satuan_indikator ?></td>
                                              <td style="text-align: center;"><?= $ts->target_pertahun ?></td>
                                              <td><?= $ts->bobot ?> %</td>
                                              <td><?php echo $ts->tw1 ?><?= $ts->satuan_indikator ?></td>
                                              <td><?php echo $ts->tw2 ?><?= $ts->satuan_indikator ?></td>
                                              <td><?php echo $ts->tw3 ?><?= $ts->satuan_indikator ?></td>
                                              <td><?php echo$ts->tw4 ?></td>
                                              <td style="text-align: justify;"><?= $ts->cara_pengukuran ?></td>
                                            </tr>     <?php endforeach ?>
                                            
                                            <tr>
                                              <td colspan="5" style="text-align: right; font-size: 15px;"><b>Total Bobot SKI : </b></td>
                                              <td style="font-size: 15px; font-weight: bold;">100 %</td>
                                              <td colspan="5"></td>
                                            </tr>
                                          

                                           <thead class="thead-light">
                                            <tr>
                                             <th colspan="11" style="text-align: center;"><b>PENALTY</b></th>
                                            </tr>
                                            <tr>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">NO</th>
                                              <th colspan="2" style="font-weight: bold; vertical-align: middle;">Sasaran Kerja</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target Pertahun</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Bobot (%)</th>
                                              <th colspan="4" style="font-weight: bold; vertical-align: middle;">Target Sampai Dengan</th>
                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Pengukuran Sasaran Kerja</th>
                                            </tr>
                                            <tr>
                                              <th style="font-weight: bold; vertical-align: middle;">Indikator</th>
                                              <th style="font-weight: bold; vertical-align: middle;">Satuan Indikator</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW I</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW II</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW III</th>
                                              <th style="font-weight: bold; vertical-align: middle;">TW IV</th>
                                            </tr>
                                            </thead>
                                           
                                            <?php $no = 1; foreach ($penalti_penetapan as $key):?>
                                           <tr>

                                              <td width="10%" style="text-align: center; font-weight: bold;">PENALTY</td>
                                              <td width="5%" style="text-align: center;"><?php echo $no++;?></td>
                                              <td width="10%" style="text-align: justify;"><?php echo $key->nama_indikator ?></td>
                                              <td width="8%"  style="text-align: center;"><?php echo $key->satuan_indikator ?></td>
                                             
                                              <td wwidth="10%"><?php echo $key->TARGET_PERTAHUN ?></td>
                                              <td width="5%"  ><?php echo $key->BOBOT ?>%</td>
                                              <td width="5%"  ><?php echo $key->TW1 ?><?php echo $key->satuan_indikator ?></td>
                                              <td width="5%"  ><?php echo $key->TW2 ?><?php echo $key->satuan_indikator ?></td>
                                              <td width="5%"  ><?php echo $key->TW3 ?><?php echo $key->satuan_indikator ?></td>
                                              <td width="5%"  ><?php echo $key->TW4 ?></td>                               
                                              <td width="35%" style="text-align: justify;"><?php echo $key->cara_pengukuran ?></td>
                                            
                                            </tr>
                                            <tr>
                                            <?php endforeach ?>

                                            <tr>
                                              <td colspan="5"  style="text-align: right; font-size: 15px;"><b>Total Bobot Penalty :</b></td>
                                              <td style="font-size: 15px; font-weight: bold; text-align: center;"> <?php echo $key->TOTAL_BOBOT ?> %</td>
                                              <td colspan="5"></td>
                                            </tr>

                                            </tr>
                                          </table><br>
                                          <table class="table" style="margin-bottom: -50px;">
                                            <tr>
                                              <td colspan="11" >
                                                 
                                                <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                
                                              <div style="float: right;" > 
                                                  <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>karyawan/print_penetapan">
                                                                                                        
                                                  <input type="hidden" value="<?= $data_karyawan['NIPEG'] ?>" name="nipeg"></input>
                                                  <input type="hidden" value="<?php echo $param_tahun?>" name="thn"></input>
                                                  
                                                   <button type="" class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                 
                                                  </form>
                                              </div>

                                              </td>  
                                            </tr>
                                          </table>
                                    <?php } ?>
                            </div>
                            </div>
                        </div>
                                          <div class="tab-pane" id="tw1" role="tabpanel">
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
                                                      <br><br>

                                                      <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td colspan="10" >
                                                            
                                                             <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                            
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                    <br><br>

                                                      <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td colspan="10" >
                                                            
                                                             <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                            
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

                                                           <table class="table table-responsive table-bordered table-hover">
                                                            <thead class="thead-light">
                                                             <tr>
                                                              <th colspan="10" style="text-align: center;"><b>TRIWULAN I</b></th>
                                                              </tr>
                                                            <tr>
                                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target</th>
                                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">NO</th>
                                                              <th colspan="2" style="font-weight: bold; vertical-align: middle;">Sasaran Kerja</th>
                                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target Pertahun</th>
                                                              <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Bobot (%)</th>
                                                              <th colspan="4" style="font-weight: bold; vertical-align: middle;">Target</th>
                                                            </tr>
                                                            <tr>
                                                              <th style="font-weight: bold; vertical-align: middle;">Indikator</th>
                                                              <th style="font-weight: bold; vertical-align: middle;">Satuan Indikator</th>
                                                              <th style="font-weight: bold; vertical-align: middle;">TW I</th>
                                                              <th style="font-weight: bold; vertical-align: middle;">Realisasi</th>
                                                              <th style="font-weight: bold; vertical-align: middle;">Nilai</th>
                                                              <th style="font-weight: bold; vertical-align: middle;">Deliverable</th>
                                                            </tr>

                                                            <tr>
                                                            <?php  $no=0; 
                                                              foreach ($data_target_utama_tw1 as $tu ) :
                                                                $no++
                                                            ?>
                                                              <td width="10%" style="font-weight: bold; text-align: center;">UTAMA</td>
                                                              <td width="5%"><?php echo $no;?></td>
                                                              <td width="25%" ><?= $tu->nama_indikator ?></td>
                                                              <td width="8%" style="text-align: center;"><?= $tu->satuan_indikator ?></td>

                                                              <td width="10%" ><?= $tu->target_pertahun ?></td>
                                                              <td width="10%"><?= $tu->bobot ?>%</td>
                                                              <td width="10%"><?= $tu->nilai_penetapan ?><?= $tu->satuan_indikator ?></td>
                                                              <td width="10%"><?= $tu->realisasi ?><?= $tu->satuan_indikator ?></td>
                                                              <td width="10%"><?= $tu->nilai_realisasi ?><?= $tu->satuan_indikator ?></td>                                                              
                                                              <td width="10%"><?= $tu->deliverable ?></td>
                                                            </tr>
                                                            <tr>
                                                            <?php endforeach  ?>
                                                            </tr>

                                                
                                                            <?php $no=0; 
                                                              foreach ($data_target_sla_tw1 as $ts ) : 
                                                                $no++ ?>
                                                            <tr>
                                                              <td  width="10%"  style="font-weight: bold; text-align: center;">SLA</td>
                                                              <td width="5%" ><?php echo $no;?></td>
                                                              <td  width="25%" ><?= $ts->nama_indikator ?></td>
                                                              <td  width="8%" style="text-align: center;"><?= $ts->satuan_indikator ?></td>

                                                              <td   width="10%"  ><?= $ts->target_pertahun ?></td>
                                                              <td width="10%" ><?= $ts->bobot ?>%</td>
                                                              <td width="10%" ><?= $ts->nilai_penetapan ?><?= $ts->satuan_indikator ?></td>
                                                              <td width="10%" ><?= $ts->realisasi ?><?= $ts->satuan_indikator ?></td>
                                                              <td width="10%" ><?= $ts->nilai_realisasi ?><?= $ts->satuan_indikator ?></td>
                                                              <td width="10%"><?= $ts->deliverable ?></td>
                                                           
                                                            </tr>     <?php endforeach ?>
                                                            <tr>
                                                                <td colspan="8"  style="text-align: right;"><b>Realiasai SKI :</b></td>
                                                                <td><?= $total_tw1['total_realisasi']?> %</td>
                                                                <td></td>
                                                              </tr>
                                                              <thead class="thead-light">
                                                               <tr>
                                                              <th colspan="10" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>
                                                                 <tr>
                                                                  <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target</th>
                                                                  <th rowspan="2" style="font-weight: bold; vertical-align: middle;">NO</th>
                                                                  <th colspan="2" style="font-weight: bold; vertical-align: middle;">Sasaran Kerja</th>
                                                                  <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Target Pertahun</th>
                                                                  <th rowspan="2" style="font-weight: bold; vertical-align: middle;">Bobot (%)</th>
                                                                  <th colspan="4" style="font-weight: bold; vertical-align: middle;">Target</th>
                                                                </tr>
                                                                <tr>
                                                                  <th style="font-weight: bold; vertical-align: middle;">Indikator</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;">Satuan Indikator</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;">TW I</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;">Realisasi</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;">Nilai</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;">Deliverable</th>
                                                                </tr>
                                                              </thead>
                                                       

                                                              <?php  $no = 1; foreach ($penalti_tw1 as $key ):?>
                                                              <tr>
                                                                <td  width="10%"  style="font-weight: bold; text-align: center;">PENALTY</td>  
                                                                <td width="5%" ><?php echo $no++;?></td>          
                                                                <td  width="25%" ><?php echo $key->nama_indikator?></td>         
                                                                <td  width="8%" style="text-align: center;" ><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->TARGET_PERTAHUN?></td>
                                                                <td width="10%"><?php echo $key->BOBOT?>%</td>
                                                                <td width="10%"><?php echo $key->NILAI_PENETAPAN?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%"><?php echo $key->REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%"><?php echo $key->NILAI_REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->deliverable?></td>
                                                              </tr>

                                                            <?php endforeach ?>
                                                              <tr>


                                                              <tr>
                                                               
                                                                
                                                                <td colspan="8"  style="text-align: right;"><b>Total Penalti :</b></td>
                                                                <td><?php echo $key->TOTAL_NILAI?> %</td>
                                                                <td></td>


                                                              </tr>

                                                               <tr>
                                                                <td colspan="8"  style="text-align: right;"><b>Total Nilai SKI</b></td>
                                                                <td><?php 
                                                                                      $penalti = $key->TOTAL_NILAI;
                                                                                      $tw = $total_tw1['total_realisasi'];
                                                                                      $c = $tw + $penalti;
                                                                                      echo $c;


                                                                ?> %</td>
                                                                <td></td>
                                                              </tr>

                                                              </tr>
                                                              

                                                            </table><br>

                                                            <table class="table" style="margin-bottom: -50px;">
                                                              <tr>
                                                                <td colspan="10" >
                                                                   
                                                                  <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
                                                                    <div style="float: right;" > 

                                                                    <a href="<?php $tw='1'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                    <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                   
                                                                    </div>                                                 
                                                                </td> 
                                                                                
                                                                </td>
                                                              </tr>
                                                            </table>
                                                 <?php } 
                                                   }?>

                                                    
                                                    


                                                      
                                                              
                                                    </div>



                                              </div>
                                          </div>
                                          <div class="tab-pane" id="tw2" role="tabpanel">
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                    <br><br>

                                                      <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td colspan="10" >
                                                            
                                                             <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                            
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
                                                        <th  style="font-weight: bold; vertical-align: middle;" colspan="10" style="text-align: center;"><b>TRIWULAN II</b></th>
                                                      </tr>

                                                      <tr>
                                                        <th   style="font-weight: bold; vertical-align: middle;" rowspan="2">Target</th>
                                                        <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">NO</th>
                                                        <th  style="font-weight: bold; vertical-align: middle;" colspan="2" > Sasaran Kerja</th>                    
                                                        <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Target Petahun</th>                   
                                                        <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Bobot (%)</th>
                                                        <th  style="font-weight: bold; vertical-align: middle;" colspan="4">Target</th>
                                                      </tr>
                                                      <tr>

                                                        <th style="font-weight: bold; vertical-align: middle;" >Indikator</th>
                                                        <th style="font-weight: bold; vertical-align: middle;" >Satuan Indikator</th>
                                                        <th style="font-weight: bold; vertical-align: middle;" >TW II</th>
                                                        <th style="font-weight: bold; vertical-align: middle;" >Realisasi</th>
                                                        <th style="font-weight: bold; vertical-align: middle;" >Nilai</th>
                                                        <th style="font-weight: bold; vertical-align: middle;" >Deliverable</th>
                                                      </tr>

                                                      <tr>
                                                      <?php  $no=0; 
                                                        foreach ($data_target_utama_tw2 as $tu ) :
                                                          $no++
                                                      ?>



                                                        <td width="10%" rowspan ="">UTAMA</td>
                                                        <td width="5%" ><?php echo $no;?></td>
                                                        <td width="25%" ><?= $tu->nama_indikator ?></td>
                                                        <td width="8%" style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $tu->target_pertahun ?></td>
                                                        <td width="10%" ><?= $tu->bobot ?>%</td>
                                                        <td width="10%" ><?= $tu->nilai_penetapan ?><?= $tu->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $tu->realisasi ?><?= $tu->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $tu->nilai_realisasi ?><?= $tu->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $tu->deliverable ?></td>
                                                      </tr>
                                                      <tr>
                                                      <?php endforeach  ?>
                                                      </tr>

                                          
                                                      <?php $no=0; 
                                                        foreach ($data_target_sla_tw2 as $ts ) : 
                                                          $no++ ?>
                                                      <tr>
                                                        <td width="10%" >SLA</td>
                                                        <td width="5%" ><?php echo $no;?></td>
                                                        <td width="25%" ><?= $ts->nama_indikator ?></td>
                                                        <td width="8%" style="text-align: center;"><?= $ts->satuan_indikator ?></td> 
                                                        <td width="10%" ><?= $ts->target_pertahun ?></td>
                                                        <td width="10%" ><?= $ts->bobot ?>%</td>
                                                        <td width="10%" ><?= $ts->nilai_penetapan ?><?= $ts->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $ts->realisasi ?><?= $ts->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $ts->nilai_realisasi ?><?= $ts->satuan_indikator ?></td>
                                                        <td width="10%" ><?= $ts->deliverable ?></td>
                                                      </tr>     <?php endforeach ?>
                                                      <tr>
                                                        <td colspan="8" align="right"><b>Realisasi SKI : </b></td>
                                                        <td colspan="2" ><?= $total_tw2['total_realisasi']; ?> %</td>
                                                      </tr>


                                                            <tr>
                                                             <th style="font-weight: bold; vertical-align: middle;" colspan="10" style="text-align: center;"><b>PENALTY</b></th>
                                                            </tr>

                                                                
                                                             <tr>
                                                               <th style="font-weight: bold; vertical-align: middle;" rowspan="2">Target</th>
                                                              <th style="font-weight: bold; vertical-align: middle;" rowspan="2">NO</th>
                                                              <th style="font-weight: bold; vertical-align: middle;" colspan="2" > Sasaran Kerja</th>  
                                                              <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">Target Pertahun</th>                  
                                                              <th style="font-weight: bold; vertical-align: middle;" rowspan="2">Bobot (%)</th>
                                                              <th style="font-weight: bold; vertical-align: middle;" colspan="4">Target</th>

                                                            </tr>
                                                            <tr>
                                                              <th>Indikator</th>
                                                              <th >Satuan Indikator</th>
                                                              <th>TW II</th>
                                                              <th>Realisasi</th>
                                                              <th>Nilai</th>
                                                              <th>Deliverable</th>
                                                            </tr>

                                                              <?php  $no = 1; foreach ($penalti_tw2 as $key ):?>
                                                              <tr>
                                                                <td width="10%" >Penalty</td>  
                                                                <td width="5%" ><?php echo $no++;?></td>          
                                                                <td width="25%" ><?php echo $key->nama_indikator?></td>         
                                                                <td width="8%" style="text-align: center;" ><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->TARGET_PERTAHUN?></td>
                                                                <td width="10%" ><?php echo $key->BOBOT?>%</td>
                                                                <td width="10%" ><?php echo $key->NILAI_PENETAPAN?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->NILAI_REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                 <td width="10%" ><?php echo $key->deliverable?></td>
                                                              </tr>

                                                            <?php endforeach ?>
                                                              <tr>


                                                               <tr>
                                                               
                                                               
                                                                <td colspan="8"  style="text-align: right;"><b>Total Penalti : </b></td>
                                                                <td colspan="2"  ><?php echo $key->TOTAL_NILAI?> %</td>


                                                              </tr>


                                                               <tr>
                                                                <td colspan="8"  style="text-align: right;"><b> Total Nilai SKI: </b></td>
                                                                <td colspan="2"  ><?php 
                                                                                      $penalti = $key->TOTAL_NILAI;
                                                                                      $tw = $total_tw2['total_realisasi'];
                                                                                      $c = $tw + $penalti;
                                                                                      echo $c;


                                                                ?> %</td>
                                                              </tr>

                                                              </tr>
                                                             

                                                            </table><br>

                                                              <table class="table" style="margin-bottom: -50px;">
                                                                <tr>
                                                                  <td colspan="10" >
                                                                    <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>                                                                
                                                                
                                                                     <div style="float: right;" > 

                                                                     <a href="<?php $tw='2'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                     <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button> 
                                                                  </a> 
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                               </table>

                                                  <?php } } ?>
                                                    


                                                                
                                                  </div>

                                              </div>
                                          </div>

                                          <div class="tab-pane" id="tw3" role="tabpanel">
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                    <br><br>

                                                      <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td colspan="10" >
                                                            
                                                             <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                            
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
                                                          <th style="font-weight: bold; vertical-align: middle;"  colspan="10" style="text-align: center;"><b>TRIWULAN III</b></th>
                                                        </tr>

                                                          <tr>
                                                            <th style="font-weight: bold; vertical-align: middle;"   rowspan="2">Target</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">NO</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  colspan="2" > Sasaran Kerja</th>                    
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">Target Petahun</th>                   
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">Bobot (%)</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  colspan="4">Target</th>
                                                          </tr>
                                                          <tr>

                                                            <th style="font-weight: bold; vertical-align: middle;" >Indikator</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Satuan Indikator</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >TW III</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Realisasi</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Nilai</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Deliverable</th>
                                                          </tr>
                                                    
                                                            
                                                              <tr>
                                                              <?php  $no=0; 
                                                                foreach ($data_target_utama_tw3 as $tu ) :
                                                                  $no++
                                                              ?>
                                                                <td  width="10%" rowspan ="">UTAMA</td>
                                                                <td  width="5%" ><?php echo $no;?></td>
                                                                <td  width="25%" ><?= $tu->nama_indikator ?></td>
                                                                <td  width="8%"  style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                                                                <td  width="10%" ><?= $tu->target_pertahun ?></td>
                                                                <td  width="10%" ><?= $tu->bobot ?>%</td>
                                                                <td  width="10%" ><?= $tu->nilai_penetapan ?><?= $tu->satuan_indikator ?></td>
                                                                <td  width="10%" ><?= $tu->realisasi ?><?= $tu->satuan_indikator ?></td>
                                                                <td  width="10%" ><?= $tu->nilai_realisasi ?><?= $tu->satuan_indikator ?></td>
                                                                <td  width="10%" ><?= $tu->deliverable ?></td>
                                                              </tr>
                                                              <tr>
                                                              <?php endforeach  ?>
                                                              </tr>

                                                  
                                                              <?php $no=0; 
                                                                foreach ($data_target_sla_tw3 as $ts ) : 
                                                                  $no++ ?>
                                                              <tr>
                                                                <td width="10%">SLA</td>
                                                                <td width="5%"><?php echo $no;?></td>
                                                                <td width="25%"><?= $ts->nama_indikator ?></td>
                                                                <td width="8%"style="text-align: center;"><?= $ts->satuan_indikator ?></td>
                                                                <td width="10%"><?= $ts->target_pertahun ?></td>
                                                                <td width="10%"><?= $ts->bobot ?>%</td>
                                                                <td width="10%"><?= $ts->nilai_penetapan ?><?= $ts->satuan_indikator ?></td>
                                                                <td width="10%"><?= $ts->realisasi ?><?= $ts->satuan_indikator ?></td>
                                                                <td width="10%"><?= $ts->nilai_realisasi ?><?= $ts->satuan_indikator ?></td>
                                                                <td width="10%"><?= $ts->deliverable ?></td>
                                                             
                                                              </tr>     <?php endforeach ?>
                                                              <tr>
                                                                <td colspan="8" align="right"><b> Realisasi SKI  : </b></td>
                                                                <td colspan="2" > <?= $total_tw3['total_realisasi']; ?> %</td>
                                                              </tr>


                                                          <tr>
                                                            <th style="font-weight: bold; vertical-align: middle;"  colspan="10" style="text-align: center;"><b>PENALTY</b></th>
                                                          </tr>

                                                              
                                                          <tr>
                                                            <th style="font-weight: bold; vertical-align: middle;"   rowspan="2">Target</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">NO</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  colspan="2" > Sasaran Kerja</th>                    
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">Target Petahun</th>                   
                                                            <th style="font-weight: bold; vertical-align: middle;"  rowspan="2">Bobot (%)</th>
                                                            <th style="font-weight: bold; vertical-align: middle;"  colspan="4">Target</th>
                                                          </tr>
                                                          <tr>

                                                            <th style="font-weight: bold; vertical-align: middle;" >Indikator</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Satuan Indikator</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >TW III</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Realisasi</th>
                                                            <th style="font-weight: bold; vertical-align: middle;" >Nilai</th>
                                                             <th style="font-weight: bold; vertical-align: middle;" >Deliverable</th>
                                                          </tr>
                                                    

                                                              <?php  $no = 1; foreach ($penalti_tw3 as $key ):?>
                                                              <tr>
                                                                <td width="10%" >Penalty</td>  
                                                                <td width="5%" ><?php echo $no++;?></td>          
                                                                <td width="25%" ><?php echo $key->nama_indikator?></td>         
                                                                <td width="8%"  style="text-align: center;" ><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%"  ><?php echo $key->TARGET_PERTAHUN?></td>
                                                                <td width="10%" ><?php echo $key->BOBOT?>%</td>
                                                                <td width="10%" ><?php echo $key->NILAI_PENETAPAN?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->NILAI_REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->deliverable?></td>
                                                              </tr>

                                                            <?php endforeach ?>
                                                              <tr>


                                                              <tr>
                                                                
                                                                <td colspan="8"  style="text-align: right;"><b>Total Penalti : </b></td>
                                                                <td colspan="2"  ><?php echo $key->TOTAL_NILAI?> %</td> 

                                                              </tr>

                                                               <tr>
                                                                    <td colspan="8" align="right"><b>Total Nilai SKI : </b></td>
                                                                <td colspan="2"  ><?php 
                                                                                      $penalti = $key->TOTAL_NILAI;
                                                                                      $tw = $total_tw3['total_realisasi'];
                                                                                      $c = $tw + $penalti;
                                                                                      echo $c; ?> %</td>
                                                              </tr>

                                                              </tr>
                                                            
                                                            </table> <br>

                                                              <table class="table" style="margin-bottom: -50px;">
                                                                <tr>
                                                                  <td colspan="10" >
                                                                      
                                                                  <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>

                                                                  <div style="float: right;" > 

                                                                      <a href="<?php $tw='3'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                   <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button>
                                                                  </a>   
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                               </table>
                                                         <?php } } ?>
                                                      


                                                              
                                                </div>

                                              

                                              </div>
                                          </div>
                                          <div class="tab-pane" id="tw4" role="tabpanel">
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                               
                                                              <a href="<?php echo base_url('karyawan/History_ski');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button>
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
                                                    <br><br>

                                                      <table class="table" style="margin-bottom: -50px;">
                                                          <tr>
                                                            <td colspan="10" >
                                                            
                                                             <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                            
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
                                                                        <th style="font-weight: bold; vertical-align: middle;"  colspan="10" style="text-align: center;"><b>TRIWULAN IV</b></th>
                                                                      </tr>

                                                                    <tr>
                                                                      <th  style="font-weight: bold; vertical-align: middle;"  rowspan="2">Target</th>
                                                                      <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">NO</th>
                                                                      <th  style="font-weight: bold; vertical-align: middle;" colspan="2" > Sasaran Kerja</th>                    
                                                                      <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Target Petahun</th>                   
                                                                      <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Bobot (%)</th>
                                                                      <th  style="font-weight: bold; vertical-align: middle;" colspan="4">Target</th>
                                                                    </tr>
                                                                    <tr>

                                                                      <th style="font-weight: bold; vertical-align: middle;" >Indikator</th>
                                                                      <th style="font-weight: bold; vertical-align: middle;" >Satuan Indikator</th>
                                                                      <th style="font-weight: bold; vertical-align: middle;" >TW IV</th>
                                                                      <th style="font-weight: bold; vertical-align: middle;" >Realisasi</th>
                                                                      <th style="font-weight: bold; vertical-align: middle;" >Nilai</th>
                                                                      <th style="font-weight: bold; vertical-align: middle;" >Deliverable</th>
                                                                    </tr>
                                                                      
                                                                        <tr>
                                                                        <?php  $no=0; 
                                                                          foreach ($data_target_utama_tw4 as $tu ) :
                                                                            $no++
                                                                        ?>
                                                                          <td  width="10%" rowspan ="">UTAMA</td>
                                                                          <td  width="5%" ><?php echo $no;?></td>
                                                                          <td  width="25%"><?= $tu->nama_indikator ?></td>
                                                                          <td  width="8%" style="text-align: center;"><?= $tu->satuan_indikator ?></td>
                                                                          <td  width="10%" ><?= $tu->target_pertahun ?></td>
                                                                          <td  width="10%" ><?= $tu->bobot ?>%</td>
                                                                          <td  width="10%" ><?= $tu->nilai_penetapan ?><?= $tu->satuan_indikator ?></td>
                                                                          <td  width="10%" ><?= $tu->realisasi ?><?= $tu->satuan_indikator ?></td>
                                                                          <td  width="10%" ><?= $tu->nilai_realisasi ?><?= $tu->satuan_indikator ?></td>
                                                                          <td  width="10%" ><?= $tu->deliverable ?></td>

                                                                        </tr>
                                                                        <tr>
                                                                        <?php endforeach  ?>
                                                                        </tr>

                                                            
                                                                        <?php $no=0; 
                                                                          foreach ($data_target_sla_tw4 as $ts ) : 
                                                                            $no++ ?>
                                                                        <tr>
                                                                          <td width="10%" >SLA</td>
                                                                          <td width="5%" ><?php echo $no;?></td>
                                                                          <td width="25%"><?= $ts->nama_indikator ?></td>
                                                                          <td width="8%" style="text-align: center;"><?= $ts->satuan_indikator ?></td>
                                                                          <td width="10%" ><?= $ts->target_pertahun ?></td>
                                                                          <td width="10%" ><?= $ts->bobot ?>%</td>
                                                                          <td width="10%" ><?= $ts->nilai_penetapan ?><?= $ts->satuan_indikator ?></td>
                                                                          <td width="10%" ><?= $ts->realisasi ?><?= $ts->satuan_indikator ?></td>
                                                                          <td width="10%" ><?= $ts->nilai_realisasi ?><?= $ts->satuan_indikator ?></td>
                                                                          <td width="10%" ><?= $ts->deliverable ?></td>
                                                                       
                                                                        </tr>     <?php endforeach ?>
                                                                        <tr>
                                                                          <td colspan="8" align="right"><b>Realisasi SKI:</b></td>
                                                                           <td colspan="2" ><?= $total_tw4['total_realisasi']; ?> %</td>
                                                                        </tr>

                                                                      

                                                               <tr>
                                                              <th  style="font-weight: bold; vertical-align: middle;" colspan="10" style="text-align: center;"><b>PENALTY</b></th>
                                                              </tr>

                                                                    
                                                                <tr>
                                                                  <th  style="font-weight: bold; vertical-align: middle;"  rowspan="2">Target</th>
                                                                  <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">NO</th>
                                                                  <th  style="font-weight: bold; vertical-align: middle;" colspan="2" > Sasaran Kerja</th>                    
                                                                  <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Target Petahun</th>                   
                                                                  <th  style="font-weight: bold; vertical-align: middle;" rowspan="2">Bobot (%)</th>
                                                                  <th  style="font-weight: bold; vertical-align: middle;" colspan="4">Target</th>
                                                                </tr>
                                                                <tr>

                                                                  <th style="font-weight: bold; vertical-align: middle;" >Indikator</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;" >Satuan Indikator</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;" >TW IV</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;" >Realisasi</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;" >Nilai</th>
                                                                  <th style="font-weight: bold; vertical-align: middle;" >Deliverable</th>
                                                                </tr>
                                                    

                                                              <?php  $no = 1; foreach ($penalti_tw4 as $key ):?>
                                                              <tr>
                                                                <td width="10%" >Penalty</td>  
                                                                <td width="5%" ><?php echo $no++;?></td>          
                                                                <td width="25%" ><?php echo $key->nama_indikator?></td>         
                                                                <td width="8%"  style="text-align: center;" ><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%"  ><?php echo $key->TARGET_PERTAHUN?></td>
                                                                <td width="10%" ><?php echo $key->BOBOT?>%</td>
                                                                <td width="10%" ><?php echo $key->NILAI_PENETAPAN?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->NILAI_REALISASI?><?php echo $key->satuan_indikator?></td>
                                                                <td width="10%" ><?php echo $key->deliverable?></td>
                                                              </tr>

                                                            <?php endforeach ?>
                                                              <tr>


                                                              <tr>
                                                               
                                                                <td colspan="8"  style="text-align: right;"><b>Total Penalti : </b></td>
                                                                <td colspan="2"  ><?php echo $key->TOTAL_NILAI?> %</td> 

                                                              </tr>

                                                               <tr>
                                                                    <td colspan="8" align="right"><b>Total Nilai SKI : </b></td>
                                                                     <td colspan="2"  ><?php 
                                                                                      $penalti = $key->TOTAL_NILAI;
                                                                                      $tw = $total_tw4['total_realisasi'];
                                                                                      $c = $tw + $penalti;
                                                                                      echo $c;?> %</td>
                                                              </tr>

                                                              </tr>
                                                              

                                                            </table> <br>

                                                              <table class="table" style="margin-bottom: -50px;">
                                                                <tr>
                                                                  <td colspan="10" >
                                                                  
                                                                   <a href="<?php echo base_url('Admin/list_histori/'); echo  $data_karyawan['NIPEG'];?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                                                                  

                                                              
                                                                
                                                                   <div style="float: right;" > 

                                                                           <a href="<?php $tw='4'; echo base_url('ski_mail/print_tw/'.encrypt_url($data_karyawan["NIPEG"]).'/'.encrypt_url($tw).'/'.encrypt_url($param_tahun))?>">
                                                                             <button class="btn btn-success btn-lg" data-toggle="tooltip" data-original-title="Cetak data"><i class="fas fa-print"></i><?= nbs(2) ?>P R I N T</button>
                                                                          </a> 
                                                                    </div>
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
