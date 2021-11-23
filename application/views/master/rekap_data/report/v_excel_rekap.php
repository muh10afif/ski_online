
<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename= rekap_data.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<!doctype html>

  </head>
  <body onload ="window.print()">

    
          <table border="2px"> 
              <thead> 
              <tr>
              	<th colspan="10" style="background: red; margin-top: 10px;"> <h3>Rekap Data Realisasi ( Tanggal Unduh : <?php echo date("Y-m-d");?>)</h3></th>
              </tr>
              <tr>
                    <th>No</th>
                    <th>NIPEG</th>
                     <th>NAMA</th>
                    <th>JOBTITLE</th>
                    <th>DIVISI</th>
                    <th>BAGIAN</th>
                    <th>URUSAN</th>
                    <th>TRIWULAN</th>
                    <th>NILAI SKI</th>
                    <th>Periode</th>
                    </tr> 
            </thead> 
            <tbody> 
          
              </thead> 
                  <?php $no=1; foreach ($rekap as $tampil): ?>
                 <tr>                        
                      <td><?php echo  $no++;?></td>
                       <td><?php echo $tampil->NIPEG;?></td>
                       <td><?php echo $tampil->NAMA;?></td>
                       <td><?php echo $tampil->JOBTITLE;?></td>
                       <td><?php echo $tampil->DIVISI;?></td>
                       <td><?php echo $tampil->BAGIAN;?></td>
                       <td><?php echo $tampil->URUSAN;?></td>
                       <td><?php echo $tampil->jenis_realisasi;?></td>
                       <td>
                         <?php 
                        
                            $tu = $tampil->nilai_ski; 
                            $posisi=strpos($tu,".");

                            if ($posisi != 0) {
                              $sub_kalimat = substr($tu,$posisi,3);
                              $sub_kalimat = substr($tu,$posisi,3);
                              $a = substr($tu,0,$posisi);
                              echo $a.$sub_kalimat;
                            } else {
                              echo $tampil->nilai_ski; 
                            }?>%
                       </td>
                       <td><?php echo $tampil->tahun;?></td>
                  </tr>   
              <?php endforeach ?>
                
              <tbody> 
             
            </tbody> 
            </table>  
  </body>
</html>