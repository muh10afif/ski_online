<!-- Container fluid  -->
            <!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <?php if($status=="SKI"){ ?>
    <div class="col-md-6 col-lg-3 col-xlg-3" >
        <div class="card card-hover">
           <a href="<?php echo base_url();?>master/karyawan"> 
           <div class="box bg-cyan text-center">
                <h6 class="text-white">Jumlah</h6>
                <h2 class="count font-light text-white"><?php echo $jml_karyawan; ?></h1>
               <h6 class="text-white">Karyawan</h6>
            </div>
            </a>
        </div>
    </div>                    

    <div class="col-md-6 col-lg-3 col-xlg-3" >
        <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+Sudah+Membuat+SKI"> 
           <div class="box bg-success  text-center">
                <h6 class="text-white">Jumlah</h6>
                <h2 class="font-light text-white"><?php echo $jml_ski_penetapan; ?></h1>
               <h6 class="text-white">Sudah SKI</h6>

            </div>
            </a>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-2 col-xlg-3" >
        <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+Belum+Buat+SKI"> 
           <div class="box  bg-danger text-center">
                <h6 class="text-white">Jumlah</h6>
                <h2 class="font-light text-white"><?php echo $jml_blum_penetapan; ?></h1>
               <h6 class="text-white">Belum SKI</h6>

            </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-2 col-xlg-3" >
        <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+approve+SKI"> 
           <div class="box bg-success  text-center">
                <h6 class="text-white">Jumlah</h6>
                <h2 class="font-light text-white"><?php echo $sudah_approve_ski; ?></h1>
               <h6 class="text-white">Sudah Approve SKI</h6>

            </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-2 col-xlg-3" >
        <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+approve+SKI"> 
           <div class="box  bg-danger text-center">
                <h6 class="text-white">Jumlah</h6>
                <h2 class="font-light text-white"><?php $tot=$jml_karyawan-$sudah_approve_ski; echo $tot; ?></h1>
               <h6 class="text-white">Belum Approve SKI</h6>

            </div>
            </a>
        </div>
    </div>
  </div>
<?php } else { ?>
  <div class="row">
      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+buat+penilaian+<?php echo $status;?>&tw=<?php echo $status;?>"> 
             <div class="box  bg-success text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php echo $sudahskitw;?></h1>
                 <h6 class="text-white">Sudah Buat Penilaian <?php echo $status; ?></h6>

              </div>
              </a>
          </div>
      </div>
            
      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+buat+penilaian+<?php echo $status;?>&tw=<?php echo $status;?>"> 
             <div class="box bg-danger text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php $belum=$jml_karyawan-$sudahskitw; echo $belum;?></h1>
                 <h6 class="text-white">Belum Buat Penilaian <?php echo $status; ?></h6>

              </div>
              </a>
          </div>
      </div>
  
      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+approve+1+<?php echo $status;?>&tw=<?php echo $status;?>">
             <div class="box  bg-success text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php echo $approve1;?></h1>
                 <h6 class="text-white">Sudah Approve 1 Penilaian <?php echo $status; ?></h6>

              </div>
              </a>
          </div>
      </div>
            
      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+approve+1+<?php echo $status;?>&tw=<?php echo $status;?>">
             <div class="box bg-danger text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php $app1=$jml_karyawan-$approve1; echo $app1;?></h1>
                 <h6 class="text-white">Belum Approve 1 Penilaian <?php echo $status; ?></h6>

              </div>
              </a>
          </div>
      </div>

      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+approve+2+<?php echo $status;?>&tw=<?php echo $status;?>">
             <div class="box  bg-success text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php echo $approve2;?></h1>
                 <h6 class="text-white">Sudah Approve 2 Penilaian <?php echo $status; ?></h6>

              </div>
              </a>
          </div>
      </div>
            
      <div class="col-md-6 col-lg-2 col-xlg-3" >
          <div class="card card-hover">
           <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+approve+2+<?php echo $status;?>&tw=<?php echo $status;?>"> 
             <div class="box bg-danger text-center">
                  <h6 class="text-white">Jumlah</h6>
                  <h2 class="font-light text-white"><?php $app2=$approve1-$approve2; echo $app2;?></h1>
                 <h6 class="text-white">Belum Approve 2 Penilaian <?php echo $status; ?></h6>
              </div>
              </a>
          </div>
      </div>
  </div>
</div>
<?php } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Data SKI Karyawan</h4>
                            <h5 class="card-subtitle">Data SKI Karyawan PT.INTI Tahun <b><?php echo $thn; ?></b></h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-12">
                          <canvas id="bar-chart-grouped"  width="400" height="300"></canvas>

                          
                        </div>
                      
                        <!-- column -->
                    </div>
                    <div id="container" style="background-color:#28b779; color:white">
                      <marquee>
                      Keterangan:
                      <?php
                        $no=0;
                          foreach ($chartpenetapan as $key) 
                          { 
                          $no++;
                            echo '['.$no.'] Divisi: '.$key->DIVISI.' <img src="'.base_url().'assets/images/logo.png " style="height:25px"> ';
                          }
                        ?>
                      </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="<?php echo base_url()?>dist/chart/Chart.js"></script>    
    <script src="<?php echo base_url()?>dist/chart/Chart.bundle.js"></script>     
    <script type="text/javascript">
    <?php if($status=='SKI'){ ?>
       var chart = new Chart(document.getElementById("bar-chart-grouped"), {
          type: 'bar',
          fontSize: 0,
          data: {
            labels: 
            [
              <?php
              $no=0;
                foreach ($chartpenetapan as $key) 
                { 
                $no++;
                  echo '"'.$no.'",';
                }
              ?>
            ],
            datasets: [
              {
                label: "Sudah SKI",
                backgroundColor: "#3e95cd",
                data: 
                [
                  <?php 
                    foreach ($chartpenetapan as $key) 
                    {
                      $div =$key->DIVISI;
                      $b = $this->Model_dashboard_karyawan->jml_sdh_ski_dds($thn,$div);
                      echo $b.',';
                    }
                  ?>
                ]
              }, {
                label: "Belum SKI",
                backgroundColor: "#8e5ea2",
                data: 
                [
                  <?php 
                    foreach ($chartpenetapan as $key) 
                    {
                      $div =$key->DIVISI;
                      $b = $this->Model_dashboard_karyawan->jml_blm_ski_dds($thn,$div);
                      echo $b.',';
                    }
                  ?>
                ]
              }
            ]
          },
          
          options: {
            title: {
              display: true,
              text: 'Penetapan SKI PT. INTI Tahun <?php echo $thn?>'

            },
            scales: {
              xAxes: [{
                  ticks: {
                    autoSkip: false,
                    fontSize: 9//,
                    // display:false
                  }
              }]
            }

          }


      });
    <?php } else { ?>
      var chart = new Chart(document.getElementById("bar-chart-grouped"), {
        type: 'bar',
        fontSize: 0,
        data: {
          labels: 
          [
            <?php
              $no=0;
                foreach ($chartpenetapan as $key) 
                { 
                $no++;
                  echo '"'.$no.'",';
                }
              ?>
          ],
          datasets: [
            {
              label: "Belum SKI",
              backgroundColor: "#3CB371",
              data: 
              [
                <?php 
                  foreach ($chartpenetapan as $key) 
                  {
                    $div =$key->DIVISI;
                    $b = $this->Model_dashboard_karyawan->jml_blm_ski_penilaian($thn,$div,$status);
                    echo $b.',';
                  }
                ?>
          ]
        },{
              label: "Sudah SKI",
              backgroundColor: "#3e95cd",
              data: 
              [
                <?php 
                  foreach ($chartpenetapan as $key) 
                  {
                    $div =$key->DIVISI;
                    $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian($thn,$div,$status);
                    echo $b.',';
                  }
                ?>
              ]
            }, {
              label: "approve1",
              backgroundColor: "#00FF00",
              data: 
              [
                <?php 
                  foreach ($chartpenetapan as $key) 
                  {
                    $div =$key->DIVISI;
                    $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian_approve1($div,$status);
                    echo $b.',';
                  }
                ?>
          ]
        },{
              label: "approve2",
              backgroundColor: "#FFD700",
              data: 
              [
                <?php 
                  foreach ($chartpenetapan as $key) 
                  {
                    $div =$key->DIVISI;
                    $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian_approve2($div,$status);
                    echo $b.',';
                  }
                ?>
              ]
            }
          ]
        },
        
        options: {
          title: {
            display: true,
            text: 'Penetapan SKI PT. INTI Tahun <?php echo $thn?>'

          },
          scales: {
            xAxes: [{
                ticks: {
                  autoSkip: false,
                  fontSize: 9//,
                  // display:false
                }
            }]
          }

        }


    });
    <?php } ?>
///------------------- bagian dashboard ---------------------------------------///


        

        var stat;
        //penutup variable indikator

        function Sudah_ski(){
            stat  = 'sudahski';
            $('#form')[0].reset();
            $('#modal_sudah_ski').modal('show');
            $('.modal-title').text(' Cek yang Sudah Ski'); 
        }

        function Belum_ski(){
            stat  = 'belumski';
            $('#form')[0].reset();

            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Belum Ski'); 
        }
        
        function Sudah_penilaian(){
            stat  = 'sudahpenilaian';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Sudah Penilaian'); 
        }

        function Belum_penilaian(){
            stat  = 'belumpenilaian';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
            $('.modal-title').text(' Cek yang Belum Penilaian'); 
        }

        ///-------------------Penutup bagian dashboard ---------------------------------------///

    </script>