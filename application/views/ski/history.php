
  <div class="col-12">
      <div class="card">
          <div class="card-body">

            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                      <div class="card-body">
                          <img  src="<?php echo $poto;?>" alt="user" class="img-thumbnail img-responsive" width="100%">
                      </div>
                    </div>
                </div>

                <div class="col-md-5">
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

                <div class="col-md-5">
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

            <div class="row">
              <div class="col-md-1"></div>

                <div class="col-md-10">
                   <div class="table-responsive">
                        <table id="table_history" class="table table-hover table-bordered" align="center" width="100%">
                          <thead class="thead-light" style="font-size: 15px; text-align: center;">
                            <tr >
                              <th style="font-weight: bold;" width="10px">NO</th>
                              <th style="font-weight: bold;">TAHUN</th>
                              <th style="font-weight: bold;">AKSI</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                   </div>
                </div>

              <div class="col-md-1"></div>
            

            </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="mediumModalLabel" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
        <div class="modal-header">
        
        <h3 class="modal-title">Data Histori Waktu</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#ski" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Penetapan SKI</span></a> </li>
          <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#tw" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Penilaian Triwulan</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="ski" role="tabpanel">
                <div class="p-20 table-responsive">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                            <table id="" class="table table-hover table-bordered" align="center" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-weight: bold; text-align: center; width: 50%;">TANGGAL SUBMIT</th>
                                        <th style="font-weight: bold; text-align: center; width: 50%;">TANGGAL APPROVE ATASAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <!-- <td style="text-align: center;"><?= tgl_indo_timestamp($waktu_ski->input_time) ?></td>
                                      <td style="text-align: center;"><?= tgl_indo_timestamp($waktu_ski->approve_atasan1_datetime) ?></td> -->
                                      <td style="text-align: center;" ><input type="text" name="input_time" class="form-control" readonly></td>
                                      <td style="text-align: center;"><input type="text" name="approve_atasan1_datetime" class="form-control" readonly></td>
                                    </tr>
                                    
                                </tbody>            
                            </table>

                        </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tw" role="tabpanel">
                <div class="p-20 table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="" class="table table-hover table-striped table-bordered" align="center" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                      <th style="font-weight: bold; text-align: center; width: 10%; vertical-align: middle;">JENIS REALISASI</th>
                                      <th style="font-weight: bold; text-align: center; width: 20%; vertical-align: middle;">TANGGAL SUBMIT</th>
                                      <th style="font-weight: bold; text-align: center; width: 20%; vertical-align: middle;">TANGGAL APPROVE ATASAN 1</th>
                                      <th style="font-weight: bold; text-align: center; width: 20%; vertical-align: middle;">TANGGAL APPROVE ATASAN 2</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                       <!--  <td style="font-weight: bold; text-align: center;"><?= $wt->jenis_realisasi ?></td>
                                       <td style="text-align: center;"><?= tgl_indo_timestamp($wt->input_time) ?></td>
                                       <td style="text-align: center;"><?= tgl_indo_timestamp($wt->approve_atasan1_datetime) ?></td>
                                       <td style="text-align: center;"><?= tgl_indo_timestamp($wt->approve_atasan2_datetime) ?></td> -->
                                        <td style="text-align: center;" ><input type="text" name="jenis_realisasi" class="form-control" readonly></td>
                                      <td style="text-align: center;"><input type="text" name="input_time_1" class="form-control" readonly></td>
                                      <td style="text-align: center;" ><input type="text" name="approve_atasan1_datetime_1" class="form-control" readonly></td>
                                      <td style="text-align: center;"><input type="text" name="approve_atasan2_datetime" class="form-control" readonly></td>
                                    </tr>
                                  
                                </tbody>            
                            </table>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C L O S E</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





