<style type="text/css">
  th {
    text-align: center;
    font-size: 13px;
  }
  tbody {
    font-size: 13px;
  }
</style>

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
                <div class="form">
                <?php echo $this->session->flashdata('msg'); ?>
                <table class="table table-hover table-responsive table-bordered" >
                  <thead class="thead-light">
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
                  <?php  $no=0; foreach ($data_target_utama as $tu ) : $no++ ?>
                  <tr>
                    <td style="text-align: center; font-weight: bold;">  UTAMA </td>
                    <td style="text-align: center;">  <?php echo $no;?> </td>
                    <td style="text-align: ;">
                      <input type="hidden" value="<?= $tu->id_indikator ?>" name="id_indikator[]">
                      <input type="hidden" value="<?= $tu->id_proker ?>" name="id_proker[]">
                      <?= $tu->nama_indikator ?>   </td>
                    <td style="text-align: center;">  <?php echo $tu->satuan_indikator ?> </td>
                    <td style="text-align: ;"> <?php echo $tu->cara_pengukuran ?>  </td>
                    <td style="text-align: center;"> <?php echo $tu->target_pertahun ?>  </td>
                    <td style="text-align: center;">  <?php echo $tu->bobot ?>% </td>
                    <td style="text-align: center;">  <?php echo $tu->tw1 ?></td>
                    <td style="text-align: center;">  <?php echo $tu->tw2 ?></td>
                    <td style="text-align: center;">  <?php echo $tu->tw3 ?></td>
                    <td style="text-align: center;"> <?php echo $tu->tw4 ?> </td>
                  </tr>
                  <?php endforeach  ?>
      
                  <?php $no=0; foreach ($data_target_sla as $ts ) : $no++ ?>
                  <tr>
                    <td style="text-align: center; font-weight: bold;">  SLA  </td>
                    <td style="text-align: center;">  <?php echo $no; ?>  </td>
                    <td style="text-align: ;">
                      <input type="hidden" value="<?= $ts->id_indikator ?>" name="id_indikator[]">
                      <input type="hidden" value="<?= $ts->id_proker ?>" name="id_proker[]">
                      <?= $ts->nama_indikator ?></td>
                    <td style="text-align: center;">  <?php echo $ts->satuan_indikator ?> </td>
                    <td style="text-align: ;"> <?php echo $ts->cara_pengukuran ?>  </td>
                    <td style="text-align: center;"> <?php echo $ts->target_pertahun ?>  </td>
                    <td style="text-align: center;">  <?php echo $ts->bobot ?>%</td>
                    <td style="text-align: center;">  <?php echo $ts->tw1 ?> </td>
                    <td style="text-align: center;">  <?php echo $ts->tw2 ?> </td>
                    <td style="text-align: center;">  <?php echo $ts->tw3 ?> </td>
                    <td style="text-align: center;"> <?php echo $ts->tw4 ?>  </td>
                  </tr> 
                  <?php endforeach ?>
                  <tr>
                    <td colspan="6" style="text-align: right; font-weight: bold; font-size: 15px;">Total Bobot SKI</td>
                    <td style="font-weight: bold; font-size: 15px; text-align: center;">100%</td>
                    <td colspan="4"></td>
                  </tr> 
                  </tbody>   
                  <thead class="thead-light">
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
                <?php $no=0; foreach ($data_target_penalty as $p ) : $no++ ?>
                  <tr>
                    <td style="text-align: center; font-weight: bold;"> PENALTY </td>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: ;"><?= $p->nama_indikator ?></td>
                    <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
                    <td style="text-align: ;"><?= $p->cara_pengukuran ?></td>
                    <td style="text-align: center;"><?= -$p->TARGET_PERTAHUN ?></td>
                    <td style="text-align: center;"><?= -$p->BOBOT ?>%</td>
                    <td style="text-align: center;"><?= -$p->TW1 ?></td>
                    <td style="text-align: center;"><?= -$p->TW2 ?></td>
                    <td style="text-align: center;"><?= -$p->TW3 ?></td>
                    <td style="text-align: center;"><?= -$p->TW4 ?></td>
                    
                  </tr> 
                  <?php endforeach ?>
                  <tr>
                    <td colspan="6" style="text-align: right; font-weight: bold; font-size: 15px;">Total Bobot Penalty</td>
                    <td style="text-align: center;font-weight: bold;font-size: 15px; "><?= -$p->TOTAL_BOBOT ?>%</td>
                    <td colspan="4"></td>
                  </tr>
                </tbody>

                  
                </table><br>
                <table class="table">
                  <tr>

                    <td>
                      <a href="<?php echo base_url('Atasan1/karyawan');?>">  <button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-original-title="Kembali ke Halaman Sebelumnya"><i class=" fas fa-arrow-left"></i><?= nbs(3) ?>B A C K</button></a> </td>
                    <?php if ($status_approve->approve != 'SUDAH') : ?>
                      <td style="text-align: right;">
                        <a href="<?php echo base_url()?>Atasan1/ubah_penetapan/<?= $data_karyawan['NIPEG'] ?>">  <button type="button" id="ubah" class="btn btn-warning btn-lg" style="color: black;" data-toggle="tooltip" data-original-title="Tekan UPDATE bila data perlu diubah"><i class="fas fa-pencil-alt"></i><?php echo nbs(3) ?>U P D A T E</button></a><?php echo nbs(5) ?>
                        <a href="#">  <button type="button" id="approve" class="btn btn-success btn-lg"  onclick="tampil_submit('<?= $data_karyawan['NIPEG'] ?>')" data-toggle="tooltip" data-original-title="Tekan APPROVE bila data sudah sesuai dan benar"><i class="fas fa-check"></i><?php echo nbs(3) ?>A P P R O V E</button></a></td>
                    <?php endif ?>
                  </tr>
                </table>

              </div>
          </div>
      </div>
       
  </div>
</div>

<div class="modal fade" id="modal_form_1" role="dialog" style="background: transparent;">
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

        <h4 class="modal-title" align="center" style="color: red;"></h4>


                     
        </form>
           
          </div>
          <div class="modal-footer">
            
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




