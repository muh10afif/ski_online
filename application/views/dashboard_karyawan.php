<div class="container-fluid" style="background: white;">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row" style="margin-top: ;">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body" style="margin-left:auto; margin-right: auto; ">
                    <?php    foreach ($data_karyawan as $key): ?>
                        <img  src="<?php echo $poto;?>" alt="user" class="img-thumbnail img-responsive" width="100%"  >
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

        <div class="col-md-6">
          


        <?php if ($status == "SKI"):?>
            
            <div class="card">
                <div class="card-body" style="margin-top: -70px; margin-left: 50px;">
                    <p><h5 align="center">Status <?php echo $status; ?> karyawan</p></h5><br>
                        <div class="img"></div>
                            <p align="center"> 
                                <img style="margin-top: -26px" class="rounded-circle img-responsive"  align="center"src="<?php echo base_url();?><?php echo $gambar;?>" width="50%">
                            </p>
                            <p align="center"><?php  echo $status_1 ?>  <?php echo $status.' '; ?> <?php echo $tgl; ?><br> <?php echo $menunggu_atasan ?></p>
                        </div>
                </div>
            </div>
        <?php else:?>
            
             <div class="card">
                <div class="card-body" style="margin-top: -70px; margin-left: 70px;">
                    <p><h5 align="center">Status <?php echo $status; ?> karyawan</p></h5><br>
                        <div class="img"></div>
                            <p align="center"> 
                                <img style="margin-top: -15px" class="rounded-circle img-responsive"  align="center"src="<?php echo base_url();?><?php echo $gambar;?>" width="50%">
                            </p>
                            <p align="center"><?php  echo $status_1 ?>  <?php echo $status.' '?><?php echo $tgl; ?><br>  <?php echo $menunggu_atasan ?></p>
                        </div>
                </div>
            </div>
            
        <?php endif ?>
            
            




            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="margin-top: -70px">
                        <p align="center">
                            <h5 align="center">Status karyawan pada Divisi <?php $divisi = strtolower("$key->DIVISI");?><?php echo ucwords($divisi); ?> Tahun <?php echo $thn; ?></h5>
                        </p>
                        <canvas id="myChart" ></canvas>
                                              
                    </div>  
                </div>
            </div>
        </div> 

 </div>



    <script src="<?php echo base_url()?>dist/chart/Chart.js"></script>    
    <script src="<?php echo base_url()?>dist/chart/Chart.min.js"></script>
    <script src="<?php echo base_url()?>dist/chart/Chart.bundle"></script>    
    <script src="<?php echo base_url()?>dist/chart/Chart.bundle.min.js"></script>
    <script type="text/javascript">

       <?php  if ($status == 'SKI'): ?>
                var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        
                                        datasets: [{
                                            label: '# of Votes',
                                            data: [<?php echo $sdah;?>, <?php echo $blum;?>],
                                            backgroundColor: [
                                                'rgba(54, 162, 235)',
                                                'rgba(184,0,0)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255,99,132,1)'
                                            ],
                                            borderWidth: 1
                                        }],
                                        labels: ["karyawan yang sudah membuat ski", "karyawan yang belum membuat ski"]

                                    }
                                });
                    
        <?php else: ?>
                   var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        
                                        datasets: [{
                                            label: '# of Votes',
                                            data: [<?php echo $Sudah_submit_tw;?>, <?php echo $Belum_submit_tw;?>],
                                            backgroundColor: [
                                                'rgba(54, 162, 235)',
                                                'rgba(184,0,0)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255,99,132,1)'
                                            ],
                                            borderWidth: 1
                                        }],
                                        labels: ["karyawan yang sudah submit <?php echo $status ?>", "karyawan yang belum submit <?php echo $status ?>"]

                                    }
                                });
        <?php endif ?>
          

    </script>

</html>