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
<body>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
         

                <div class="row">
                     <div class="col-md-2">
                             <div class="card">
                                    <div class="card-body" style=" margin-left:auto; margin-right: auto; ">
                                       
                                            <img  src="<?php echo $poto_karyawan_histori;?>" alt="user" class="img-thumbnail img-responsive" width="100%"  >
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

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                
        
                 <div class="table-responsive">
                       <table id="table_histori_thn" class="table table-hover table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th style="font-weight: bold; width: 10%">NO</th>
                            <th style="font-weight: bold;">TAHUN</th>
                            <th colspan="2px" style="font-weight: bold;">AKSI</th>
                          </tr>
                        </thead>
                      <?php $no = 1; foreach ($list_thn as $key ): ?>
                        <tr>
                          
                        <td style="text-align: center;"><?php echo $no++;?></td>
                          <td style="font-size: 15px;">Penetapan dan Penilaian SKI tahun <strong><?php echo $key->tahun_insert; ?></strong></td>
                          <td style="text-align: center;"><a href="<?php echo base_url('admin/histori_penetapan_karyawan/'.$key->tahun_insert.'/'.$key->NIPEG); ?>" class="btn btn-success">L I H A T</a></td>
                        </tr>
                      <?php endforeach ?> 
                      </table>
               </div>

                </div>
                <div class="col-md-1"></div>
              </div><br><br>
              <table style="margin-left: 20px;">
              <tr>
                <td >
                
                 <a href="<?php echo base_url('admin/histori_karyawan/');?> ">   <button type="button" class="btn btn-info btn-lg"  data-toggle="tooltip" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?= nbs(2) ?>B A C K</button></a>
                </td>
              </tr>
             </table>

          </div>
      </div> 
  </div>
</div>