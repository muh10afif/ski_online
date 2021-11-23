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
                <p ><h4 align="center"> SKI ATASAN LANGSUNG</h4></p>
               
                <div class="row">
                     <div class="col-md-2">
                             <div class="card">
                                    <div class="card-body" style=" margin-left:auto; margin-right: auto; ">
                                       
                                            <img  src="<?php echo $poto_atasan;?>" alt="user" class="img-thumbnail img-responsive" width="100%"  >
                                    </div>
                            </div>
                     </div>

                     <div class="col-md-5">
                           <div class="card">
                                <div class="card-body" style="margin-top: 10px;">
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
                                                    <td><h5 ><?php $a = strtolower($data_karyawan['PANGKAT']); echo ucwords($a); ?> </h5></td>
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

                    <?php 
                        
                    if ($status_ski_atasan != 0) {?>
                      
                          <br>
                        <div class="form">
               
                        <table class="table table-responsive table-hover table-bordered" style="margin-top: -30px;">
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
         
                          <?php  $no=0; 
                            foreach ($data_target_utama as $tu ) :
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
                            <td style="text-align: center;">  <?php echo $tu->tw1 ?></td>
                            <td style="text-align: center;">  <?php echo $tu->tw2 ?></td>
                            <td style="text-align: center;">  <?php echo $tu->tw3 ?></td>
                            <td style="text-align: center;"> <?php echo $tu->tw4 ?> </td>
                          </tr>
                           
                          <?php endforeach  ?>
                            
                          
              
                          <?php $no=0; 
                            foreach ($data_target_sla as $ts ) : 
                              $no++ ?>
                            <tr>
                          <td style="text-align: center; font-weight: bold;">  SLA  </td>
                          <td style="text-align: center;">  <?php echo $no; ?>  </td>
                          <td style="text-align: ;"> <?php echo $ts->nama_indikator ?>   </td>
                          <td style="text-align: center;">  <?php echo $ts->satuan_indikator ?> </td>
                          <td style="text-align: ;"> <?php echo $ts->cara_pengukuran ?>  </td>
                          <td style="text-align: center;"> <?php echo $ts->target_pertahun ?>  </td>
                          <td style="text-align: center;">  <?php echo $ts->bobot ?>%</td>
                          <td style="text-align: center;">  <?php echo $ts->tw1 ?></td>
                          <td style="text-align: center;">  <?php echo $ts->tw2 ?>  </td>
                          <td style="text-align: center;">  <?php echo $ts->tw3 ?>  </td>
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
                      <th rowspan="2" style="vertical-align: middle;"><strong> Bobot (%) </strong></th>
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

                <!-- Menampilkan data Tabel Penalty -->
                
                  <?php $no=0; foreach ($data_target_penalty as $p) : $no++?>
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
                    <td style="text-align: center;font-weight: bold;font-size: 15px;"><?= -$p->TOTAL_BOBOT ?>%</td>
                    <td colspan="4"></td>
                  </tr>
                  </tbody>

                        </table>
                        </div>

                   <?php } else { ?>
                        
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px; text-align: center;">
                            <h3>Atasan Belum Membuat Penetapan SKI <?= $thn ?></h3>
                        </div>
              
                   <?php }?>

            </div>
        </div>
       
    </div>
</div>


</body>
</html>

