<div class="container-fluid" style="background: white;">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body" style="margin-left:auto; margin-right: auto; ">
                    <?php    foreach ($data_karyawan as $key): ?>                     
                        <img  src="<?php echo $poto;?>" alt="user" class="img-thumbnail img-responsive" width="100%">   
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 ><?php echo $key->NAMA;?></h4>
                    <h6 ><?php echo $key->NIPEG;?></h6>
                    <p style="font-size: 12px;">
                        <?php if (!empty($key->JOBTITLE)): ?>
                            <?php echo $key->JOBTITLE;?>
                          <?php else: ?>
                            <?= "-" ?>
                          <?php endif ?></p>
                     
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" >
                        <table border="0" >
                            <tr >
                                <td style="width:100px"> <h5 >DIVISI</h5></td>
                                <td style="width:20px"><h5 >:</h5></td>
                                <td><h5 >
                                    <?php if (!empty($key->DIVISI)): ?>
                                        <?php $a = strtolower($key->DIVISI); echo ucwords($a); ?>
                                      <?php else: ?>
                                        <?= "-" ?>
                                      <?php endif ?>
                                </h5></td>
                            </tr>
                            <tr>
                                <td><h5 >BAGIAN</h5></td>
                                <td><h5 >:</h5></td>
                                <td><h5 >
                                    <?php if (!empty($key->BAGIAN)): ?>
                                        <?php $a = strtolower($key->BAGIAN); echo ucwords($a); ?>
                                      <?php else: ?>
                                        <?= "-" ?>
                                      <?php endif ?>
                                </h5></td>
                            </tr>
                            <tr>
                                <td><h5 >URUSAN</h5></td>
                                <td><h5 >:</h5></td>
                                <td><h5 >
                                    <?php if (!empty($key->URUSAN)): ?>
                                        <?php $urusan = strtolower($key->URUSAN); echo ucwords($urusan); ?>
                                      <?php else: ?>
                                        <?= "-" ?>
                                      <?php endif ?>
                                </h5></td>
                            </tr>
                        </table>
                        <?php endforeach ?> 
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="margin-top: -60px">
                        <p align="center">
                            <h5 align="center"></h5>
                        </p>
                        <canvas id="myChart" width="300" height="200"></canvas>
                                              
                    </div>  
                </div>
            </div>
            <div class="col-md-2"></div>
        </div> 

 </div>



    <script src="<?php echo base_url()?>dist/chart/Chart.js"></script>    
    <script src="<?php echo base_url()?>dist/chart/Chart.bundle"></script>    
    <script type="text/javascript">

    <?php if ($status != 'SKI') : ?>

        var chart = new Chart(document.getElementById("myChart"), {

        type: 'pie',
        fontSize: 0,
        data: {
         labels: [
          "BELUM SUBMIT <?php echo $status ?>",
          "BELUM APPROVE <?php echo $status ?>",
          "SUDAH APPROVE <?php echo $status ?>"
          ],
          datasets: [
              {
                  data: [<?php echo $belum_submit_nilai_h ?>, <?php echo $belum_nilai_bawahan_hitung ?>, <?php echo $sudah_nilai_bawahan_hitung ?>],
                  backgroundColor: [
                    "#f03232",
                    "#edeb48",
                    "#48ed50"
                  ]
              }]
          },
              
        options: {
          title: {
            display: true,
            text: 'APPROVE Penilaian <?php echo $status ?> SKI PT. INTI Tahun <?php echo $thn?>'

          },

        }

        });

    <?php else : ?>

        

        var chart = new Chart(document.getElementById("myChart"), {

        type: 'pie',
        fontSize: 0,
        data: {
        labels: [
        "BELUM SUBMIT PENETAPAN",
        "BELUM APPROVE PENETAPAN",
        "SUDAH APPROVE PENETAPAN"
        ],
        datasets: [
            {
                data: [<?php echo $bawahan_belum_ski_h ?>, <?php echo $bawahan ?>, <?php echo $bawahan_sudah_1 ?>],
                backgroundColor: [
                    "#f03232",
                    "#edeb48",
                    "#48ed50"
                ]
            }]
        },
        
        options: {
          title: {
            display: true,
            text: 'APPROVE Penetapan SKI PT. INTI Tahun <?php echo $thn?>'

          },

        }

        });

    <?php endif ?>

    

    </script>

</html>