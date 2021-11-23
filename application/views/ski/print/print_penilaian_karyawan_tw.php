<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/logo.png">
    <title>SKI ONLINE</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
</head>   
    <style type="text/css">
              @media print 
          {
              @page {
                size: A4 landscape; /* DIN A4 standard, Europe */
                margin:0;
                
              }
              html, body {
                  width: 210mm;
                  /* height: 297mm; */
                  height: 282mm;
                  font-size: 11px;
                  background: #FFF;
                  overflow:visible;
              }
          }
          body {
              margin:0;
              padding:0;
          }

          td,th {
            padding-left: 5px;
            font-size: 8pt;
          }
          th{
            text-align: center;
          }
          img{
            padding-left: 25px;
          }
    </style>
<body onload ="window.print()">
  <div id="container" style="margin-top:75.591503515px; margin-left:100;">
       <table  width="880px" border="2px"> 
        <tr>
        <td colspan="5" align="center"  ><b style="font-size:20px;">Penilaian SKI Tahun <?php echo $tahun; ?> Triwulan <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?></b> <br>PT INTI (Industri Telekomunikasi Indonesia)</td>
        </tr>
       <tr><td rowspan="3" width="70px"> <img src="<?php echo base_url() ?>assets/images/logointi.png" height="70px"/></td>
          <td width="70px"><b>Nama</b></td>
          <td width="180px"><?= $data_karyawan['NAMA'];?></td>
          <td width="70px"><b>Jabatan</b></td>
          <td width="180px"><?= $job_histori['H_JOBTITLE'];?></td>
        </tr>
        <tr>
          <td><b>NIP</b></td>
          <td><?= $data_karyawan['NIPEG'];?></td>
          <td width="70px"><b>Divisi</b></td>
          <td><?= $job_histori['H_DIVISI'];?></td>
        </tr>
        <tr></td>
          <td><b>Pangkat</b></td>
          <td><?= $job_histori['H_PANGKAT'];?></td>
          <td width="70px"><b>Tahun</b></td>
          <td><?php echo $tahun; ?></td>
        </tr>
       </table>
    <table style="margin-top: 10px;"  width="880px" border="2px">
      <thead>
        <tr>
          <th rowspan="2">Target</th>
          <th rowspan="2">NO</th>
          <th colspan="2">Sasaran Kerja</th> 
          <th rowspan="2">Target Pertahun</th>  
          <th rowspan="2">Bobot (%)</th>
          <th>Target</th>
          <th rowspan="2">Realisasi</th>
          <th rowspan="2">Nilai</th>
           <th rowspan="2">Deliverable</th>           
           <th rowspan="2">Pengukuran Sasaran Kerja</th>
        </tr>
        <tr>
          <th>Indikator</th>
          <th>Satuan Indikator</th>
          <th>TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($nama_karyawan as $nm) : ?>
            <input type="hidden" value="<?= $nm->NIPEG ?>" name="NIPEG[]" >
          <?php endforeach ?>
          
          <!-- BAGINAN UNTUK UTAMA -->
          <?php $no=0; foreach ($data_target_utama as $utama ) : $no++?>
        
          <td  valign="top" width="10%"align="center"  >UTAMA</td>
          <td valign="top" width="5%" align="center"  ><?= $no; ?></td>
          <td valign="top" width="25%" ><?= $utama->nama_indikator ?> </td>
          <td valign="top" width="8%" align="center"><?= $utama->satuan_indikator ?></td>
          <td valign="top" width="10%" align="center"><?php echo $utama->target_pertahun; ?></td> 
          <td valign="top" width="8%" align="center"  ><?php echo $utama->bobot; ?>%</td>          
          <td  valign="top" width="%" align="center"   ><?php echo $utama->nilai_penetapan ?></td>
          <td valign="top" width="%"  align="center" ><?php echo $utama->realisasi ?></td>
          <td valign="top" width="8%" align="center" >
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

              ?>%
          </td>
          <td valign="top" width="5%" style="text-align: left;"    ><?php echo $utama->deliverable ?></td>
          <td valign="top" width="25%" style="text-align: left;"    ><?php echo $utama->cara_pengukuran ?></td>
          <?php $nilai_ski = $utama->nilai_ski ?>
          <?php $nilai_maks = $utama->total_realisasi ?>
        </tr> <?php endforeach ?>
       
        
        <!-- BAGINAN UNTUK SLA -->
        <tr>
          <?php  $no=0; foreach($data_target_sla as $sla ) : $no++ ?>
          <td  valign="top" width="10%" align="center" >SLA</td>
          <td valign="top" width="5%"  align="center" ><?= $no; ?></td>
          <td valign="top" width="25%"  ><?= $sla->nama_indikator ?> </td>
          <td valign="top" width="8%"   align="center" ><?= $sla->satuan_indikator ?></td>
          <td valign="top" width="10%"  align="center"  ><?php echo $sla->target_pertahun; ?></td> 
          <td valign="top" width="8%" align="center"   ><?php echo $sla->bobot; ?>%</td>
          <td  valign="top" width="%"   align="center"    ><?php echo $sla->nilai_penetapan ?></td>
          <td valign="top" width="%" align="center"  ><?php echo $sla->realisasi ?></td>
          <td valign="top" width="8%"    align="center"   >
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
          <td valign="top" width="5%"  style="text-align: left;"      ><?php echo $sla->deliverable ?></td> 
            <td valign="top" width="25%"  style="text-align: left;"      ><?php echo $sla->cara_pengukuran ?></td>  
            <?php $nilai_ski = $sla->nilai_ski ?>  
            <?php $nilai_maks = $sla->total_realisasi ?>       
        </tr> <?php endforeach ?>
         
         <tr>

            <td colspan="8" align="right" style="padding-right: 5px;"><b>

            <?php if (!empty($data_target_utama) && empty($data_target_sla)): ?>
              Total SKI Utama TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?>                                                              
            <?php elseif (empty($data_target_utama) && !empty($data_target_sla)): ?>
              Total SKI SLA TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?>
            <?php else: ?>
              Total SKI Utama + SLA TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?>
            <?php endif ?>:

            </b></td>
            <td align="center" ><b>
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
            </b></td>
            <td colspan="2"></td>
            </tr>
          </tr>

      </tbody>


  <!--   fungsi untuk penaltii -->

             <tr>
            <td colspan="11" style="text-align: center;"><b>PENALTY</b></td>
            </tr>

              
        <tr>
          <th rowspan="2">Target</th>
          <th rowspan="2">NO</th>
          <th colspan="2">Sasaran Kerja</th> 
          <th rowspan="2">Target Pertahun</th>  
          <th rowspan="2">Bobot (%)</th>
          <th>Target</th>
          <th rowspan="2">Realisasi</th>
          <th rowspan="2">Nilai</th>
           <th rowspan="2">Deliverable</th>        
           <th rowspan="2">Pengukuran Sasaran Kerja</th>
        </tr>
        <tr>
          <th>Indikator</th>
          <th>Satuan Indikator</th>
          <th>TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?> </th>
        </tr>
      </thead>

     

            <?php  $no = 1; foreach ($penalti_tw as $key ):?>
            <tr>
              <td valign="top" width="10%" align="center" >Penalty</td>  
              <td valign="top" width="5%" align="center" ><?php echo $no++;?></td>          
              <td valign="top" width="25%" ><?php echo $key->nama_indikator?></td>         
              <td valign="top" width="8%" align="center" ><?php echo $key->satuan_indikator?></td>
              <td valign="top" width="10%" align="center"  ><?php echo $key->TARGET_PERTAHUN?></td>
              <td valign="top" width="8%"  align="center"  ><?php echo $key->BOBOT?>%</td>
              <td valign="top" width="%" align="center"   ><?php echo $key->NILAI_PENETAPAN?> </td>
              <td valign="top" width="%" align="center"    ><?php echo $key->REALISASI?> </td>
              <td valign="top" width="8%" align="center"  >
                <?php 
                        
                $tu = $key->NILAI_REALISASI; 
                $posisi=strpos($tu,".");

                 if ($posisi != 0) {
                  $sub_kalimat = substr($tu,$posisi,3);
                  $sub_kalimat = substr($tu,$posisi,3);
                  $a = substr($tu,0,$posisi);
                  echo $a.$sub_kalimat;
                } else {
                  echo $key->NILAI_REALISASI; 
                }

                ?>%
              </td>
              <td valign="top" width="5%"  ><?php echo $key->deliverable?></td>
              <td valign="top" width="25%"  ><?php echo $key->cara_pengukuran?></td>
            </tr>

          <?php endforeach ?>
            <tr>


             <tr>
             
             
              <td colspan="8"  style="text-align: right;"style="padding-left: 10px;"><b>Total Penalty TW <?php if ($tw =='1') {
              echo "I";
            }elseif ($tw =='2') {
             echo "II";
            } elseif ($tw =='3') {
             echo "III";
            }else{
              echo "IV";
            }
              ?> : </b></td>
              <td align="center"><b>
                <?php 
                        
                $tu = $key->TOTAL_NILAI; 
                $posisi=strpos($tu,".");

                 if ($posisi != 0) {
                  $sub_kalimat = substr($tu,$posisi,3);
                  $sub_kalimat = substr($tu,$posisi,3);
                  $a = substr($tu,0,$posisi);
                  echo $a.$sub_kalimat;
                } else {
                  echo $key->TOTAL_NILAI; 
                }

                ?>%
              </b></td>
              <td colspan="2"></td>


            </tr>


             <tr>
              <td colspan="8"  style="text-align: right;" style="padding-left: 10px;"><b> Total Nilai SKI : </b></td>
              <td align="center"><b>
              <?php 
                        
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

                ?>%
              </b></td>
              <td colspan="2"></td>
            </tr>

            </tr>
           

          </table><br>
         <table   width="880px">
            <tr>
              <td colspan="12">
                      <?php
                        foreach ($ats2 as $key ) { ?>
                          <div class="col-md-12" style="margin-top:20px; color:black">
                            <div class="col-md-4" style="float:left; text-align:center;">
                            Diperiksa: <?php echo tgl_indo(substr($key->approve_atasan1_datetime, 0, 10))?><br>
                            Atasan Langsung,<br>
                            <b><?php echo $key->N_ATASAN_1;?></b><?= br(4) ?><hr style="margin-bottom: 5px">
                            <?php echo $key->ATASAN_1;?>
                          </div>
                          <div class="col-md-2" style="margin-left:5px; float:left">
                          </div>
                      <?php }
                        foreach ($ats2 as $key ) {
                       ?>
                          <div class="col-md-4" style="float:right; margin-left:5px; text-align:center; color:black">
                            Disetujui: <?php echo tgl_indo(substr($key->approve_atasan2_datetime, 0, 10))?><br>
                            Atasan Dari Atasan Langsung,<br>
                            <b><?php echo $key->N_ATASAN_2;?></b><?= br(4) ?><hr style="margin-bottom: 5px">
                            <?php echo $key->ATASAN_2;?>
                          </div>
                      <?php } ?>
                      </div>
                      <br>
                    </div> 
                  </div>
              </td>
            </tr>
            
          </table>




