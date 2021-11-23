  <style type="text/css">
    th {
        text-align: center;
        font-weight: bold;
        font-size: 15px;
    }
    tbody {
        font-size: 15px;
    }
  </style>

   
  <div class="card">
    <div class="card-body">
      
 
                <div class="row"> 
                     <div class="col-md-3">
                          
                                    <div class="card-body" style=" margin-left:auto; margin-right: auto; text-align: center;">
                                       
                                            <img  src="<?php echo $poto_karyawan;?>" alt="user" class="img-thumbnail img-responsive" width="70%"  ><br>
                                            <p align="center"  class="m-b-0 font-medium p-0" style="font-size: 16px; margin-top: 10px;"><?= $data_karyawan['NAMA'] ?></p>
                                            <p align="center" class="text-muted"><?= $data_karyawan['NIPEG'] ?>
                                           
                                   
                                     </div>
                     </div>

                     <div class="col-md-5" >
                           <div class="card">
                                <div class="card-body" style="margin-top:  ;">
                                         <div class="table-responsive" >
                                            <table>
                                              
                                                <tr>
                                                    <td><h5 >JABATAN</h5></td>
                                                    <td><h5 >:</h5></td>
                                                    <td> <h6 style="font-size: 15px;">
                                                      <?php if (!empty($data_karyawan['JOBTITLE'])): ?>
                                                        <?php $jabatan =  strtolower($data_karyawan['JOBTITLE']); echo ucwords($jabatan); ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?>
                                                      </h6></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 >PANGKAT</h5></td>
                                                    <td><h5 >:</h5></td>
                                                    <td> <h6 style="font-size: 15px;">
                                                      <?php if (!empty($data_karyawan['PANGKAT'])): ?>
                                                        <?php $pangkat =  strtolower($data_karyawan['PANGKAT']); echo ucwords($pangkat); ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?>
                                                      </h6></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 >DIVISI</h5></td>
                                                    <td><h5 >:</h5></td>
                                                    <td><h6 style="font-size: 15px;">
                                                      <?php if (!empty($data_karyawan['DIVISI'])): ?>
                                                        <?php $div = strtolower($data_karyawan['DIVISI']); echo ucwords($div); ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?>
                                                      </h6></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 >BAGIAN</h5></td>
                                                    <td><h5 >:</h5></td>
                                                    <td><h6 style="font-size: 15px;">
                                                      <?php if (!empty($data_karyawan['BAGIAN'])): ?>
                                                        <?php $bag = strtolower($data_karyawan['BAGIAN']); echo ucwords($bag); ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?>
                                                       </h6></td>
                                                </tr>
                                                  <tr >
                                                    <td style="width:100px"> <h5 >URUSAN</h5></td>
                                                    <td style="width:20px"><h5 >:</h5></td>
                                                    <td><h6 style="font-size: 15px;">
                                                      <?php if (!empty($data_karyawan['URUSAN'])): ?>
                                                        <?php $urusan = strtolower($data_karyawan['URUSAN']); echo ucwords($urusan); ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?></h6></td>
                                                </tr>
                                               
                                               
                                            </table>
                                        </div>
                                    
                                </div>
                             </div>

                     </div>
                    <div class="col-md-4" >
                           <div class="card">
                                <div class="card-body" style="margin-top: ;">
                                         <div class="table-responsive" >
                                            <table>
                                                  <tr>
                                                    <td style="width:100px"><h5 >ATASAN 1</h5></td>
                                                    <td style="width:20px"><h5 >:</h5></td>
                                                    <td><h6 style="font-size: 15px;">
                                                      <?php if (!empty($atasan_1['NAMA'])): ?>
                                                        <?= $atasan_1['NAMA'] ?>
                                                      <?php else: ?>
                                                        <?= "-" ?>
                                                      <?php endif ?>
                                                      </h6></td>
                                                </tr>
                                               

                                                 <tr>
                                                    <td><h5 >ATASAN 2</h5></td>
                                                    <td><h5 >:</h5></td>
                                                    <td><h6 style="font-size: 15px;">
                                                      <?php if (!empty($atasan_2['NAMA'])): ?>
                                                        <?= $atasan_2['NAMA'] ?>
                                                      <?php else: ?>
                                                      <?= "-" ?>
                                                      <?php endif ?>
                                                      </h6></td>
                                                </tr>
                                                

                                            </table>
                                        </div>
                                    
                                </div>
                             </div>

                     </div>
                     
                </div>
             
 <div class="row" style="margin-top: -30px;">
                <div class="col-md-12" > <br>
                      
                     <div class="table-responsive">
                      
                      
                      <br>
                      <?= $this->session->flashdata('msg'); ?>

                           <table id="tb_details_karyawan" class="table table-hover table-bordered">
                            <thead class="thead-light">
                              <tr>
                                <th style="font-weight: bold; vertical-align: middle;">NO</th>
                                <th style="font-weight: bold; width: 15%; vertical-align: middle;">PROKER</th>
                                <th style="font-weight: bold; width: 30%; vertical-align: middle;">INDIKATOR</th>
                                <th style="font-weight: bold; vertical-align: middle;">SATUAN INDIKATOR</th>
                                <th style="font-weight: bold; vertical-align: middle;">CARA PENGUKURAN</th>
                              </tr>
                            </thead>
                            <tbody>
                          <?php $no = 1; foreach ($direktori as $d ): ?>
                            <tr>
                              <td style="text-align: center;"><?php echo $no++;?></td>
                              <td><?= $d->nama_proker ?></td>
                              <td><?= $d->nama_indikator ?></td>
                              <td style="text-align: center;"><?= $d->satuan_indikator ?></td>
                              <td><?= $d->cara_pengukuran ?></td>
                            </tr>
                          <?php endforeach ?>
                          </tbody>
                          </table>
                   </div>
                 </div>
               
       </div><br><br>
          <div class="row" style="margin-left: 5px;">
             <div class="col-md-2" >
                 <a href="<?php echo base_url() ?>Master/karyawan"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a>
            </div>
          </div>
   </div>
  </div>