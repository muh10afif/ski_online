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
          size: A4; /* DIN A4 standard, Europe */
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
      
    }
</style>
<body onload ="window.print()">
  <div class="container" style="margin-top:75.591503515px; margin-left:113.3872552725;" >
    <div id="col-md-12">
       <table width="880px" border="2px"> 
            <tr>
              <td colspan="5" align="center"  ><b style="font-size:20px;">Penetapan SKI Tahun <?php echo $tahun; ?></b> <br>PT INTI (Industri Telekomunikasi Indonesia)</td>
            </tr>
           <tr><td rowspan="3" width="70px"> <img align="center" src="<?php echo base_url() ?>assets/images/logointi.png" height="70px"/></td>
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

            <tr>

            </tr>
       </table>

       <table width="880px" style="margin-top: 10px;" border="2px">
            <tr>
                <tr>
                  <th  rowspan="2">Target</th>
                  <th rowspan="2">NO</th>
                  <th colspan="2" > Sasaran Kerja</th> 
                  <th rowspan="2">Target Pertahun</th>                   
                  <th rowspan="2">Bobot (%)</th>
                  <th colspan="4">Target</th>
                  <th rowspan="2">Deliverable</th>
                  <th rowspan="2">Pengukuran Sasaran Kerja</th>
                </tr>
                <tr>
                  <th>Indikator</th>
                  <th>Satuan Indikator</th>
                  <th>TW I</th>
                  <th>TW II</th>
                  <th>TW III</th>
                  <th>TW IV</th>
                </tr>
            <tr>

            <tr>                   
              <?php  $no=0; 
              foreach ($data_target_utama as $tu ) :
                $no++
            ?>
             <td  valign="top" rowspan ="">UTAMA</td>
              <td valign="top" ><?php echo $no;?></td>
              <td valign="top" ><?= $tu->nama_indikator ?></td>
              <td valign="top"  style="text-align: center;"><?= $tu->satuan_indikator ?></td>
              <td valign="top" ><?= $tu->target_pertahun ?></td>
              <td valign="top" ><?= $tu->bobot ?>%</td>
              <td valign="top" ><?= $tu->tw1 ?></td>
              <td valign="top" ><?= $tu->tw2 ?></td>
              <td valign="top" ><?= $tu->tw3 ?></td>
              <td valign="top" ><?= $tu->tw4 ?></td>
              <td valign="top"  width="10%"><?= $tu->deliverable ?></td>
              <td valign="top"  ><?= $tu->cara_pengukuran ?></td>
            </tr>
            <tr>
            <?php endforeach  ?>
            </tr>

              <?php $no=0; 
              foreach ($data_target_sla as $ts ) : 
                $no++ ?>
            <tr>
              <td valign="top" >SLA</td>
              <td valign="top" ><?= $no; ?></td>
              <td valign="top" ><?= $ts->nama_indikator ?></td>
              <td valign="top"  style="text-align: center;"><?= $ts->satuan_indikator ?></td>
              <td valign="top" ><?= $ts->target_pertahun ?></td>              
              <td valign="top" ><?= $ts->bobot ?>%</td>
              <td valign="top" ><?php echo $ts->tw1 ?></td>
              <td valign="top" ><?php echo $ts->tw2 ?></td>
              <td valign="top" ><?php echo $ts->tw3 ?></td>
              <td valign="top" ><?php echo$ts->tw4 ?></td>
              <td  valign="top"  width="10%"><?= $ts->deliverable ?></td>
              <td valign="top"><?= $ts->cara_pengukuran ?></td>
            </tr>   
          <?php endforeach ?>
            <tr>
              <td colspan="5" style="text-align: right;"><b> Total Bobot SKI : </b></td>
              <td style="text-align: center;"><b>100%</b></td>
              <td colspan="6"></td>
            </tr>
   
                     <tr>
                    <td colspan="12" style="text-align: center;"><b>PENALTY</b></td>
                    </tr>

                     <tr>
                      <th rowspan="2">Target</th>
                      <th rowspan="2">NO</th>
                      <th colspan="2" > Sasaran Kerja</th>                    
                      <th rowspan="2">Target Pertahun</th>
                      <th rowspan="2">Bobot (%)</th>
                      <th colspan="4">Target</th>
                      <th rowspan="2">Deliverable</th>
                      <th rowspan="2">Pengukuran Sasaran Kerja</th>
                    </tr>
                    <tr>
                      <th>Indikator</th>
                      <th>Satuan Indikator</th>
                      <th>TW I</th>
                      <th>TW II</th>
                      <th>TW III</th>
                      <th>TW IV</th>
                    </tr>
                   
                    <?php $no = 1; foreach ($penalti_penetapan as $key):?>
                   <tr>
                     <!--  SELECT `ID_PENALTY_P`, `ID_INDIKATOR`, `DIVISI`, `TARGET_PERTAHUN`, `BOBOT`, `TOTAL_BOBOT`, `TW1`, `TW2`, `TW3`, `TW4`, `STATUS`, `TAHUN_INSERT`, `INPUT_TIME` FROM `penalty_penetapan` WHERE 1 -->

                      <td  valign="top">Penalty</td>
                      <td  valign="top"><?php echo $no++;?></td>
                      <td  valign="top"><?php echo $key->nama_indikator ?></td>
                      <td  valign="top" style="text-align: center;"><?php echo $key->satuan_indikator ?></td>
                     
                      <td  valign="top"><?php echo $key->TARGET_PERTAHUN ?></td>
                      <td valign="top"><?php echo $key->BOBOT ?>%</td>
                      <td valign="top"><?php echo $key->TW1 ?></td>
                      <td valign="top"><?php echo $key->TW2 ?></td>
                      <td  valign="top"><?php echo $key->TW3 ?></td>
                      <td  valign="top"><?php echo $key->TW4 ?></td>                        
                      <td valign="top" width="10%" valign="top"><?php echo $key->deliverable ?></td>                             
                      <td valign="top" ><?php echo $key->cara_pengukuran ?>%</td>
                    
                    </tr>
                    <tr>
                    <?php endforeach ?>

                    <tr>
                      <td colspan="5"  style="text-align: right;"><b>Total Bobot Penalty :</b></td>
                      <td> <b><?php echo $key->TOTAL_BOBOT ?>%</b></td>
                      <td colspan="6"></td>
                    </tr>
                    
                    </tr>

                   


                  </table><br>

                  <table  width="880px">
                 <tr>
                    <td colspan="12"  style="">  
                          
                      <?php 
                        foreach ($ats1 as $key ) {
                       ?>
                          <div class="col-md-4" style="float:right; margin-left:5px; text-align:center; color:black">
                            Disetujui: <?php echo tgl_indo(substr($key->approve_atasan1_datetime, 0, 10))?><br>
                            Atasan Langsung,<br>
                            <b><?php echo $key->NAMA;?></b><?= br(4) ?><hr style="margin-bottom: 5px">
                            <?php echo $key->NIPEG;?>
                          </div>



                      <?php } ?>
                    </td>
                      
                    </tr>
                    
                  </table>



        <!-- PENUTUP BOBOT PENALTI -->





        
</body>