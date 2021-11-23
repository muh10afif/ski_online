<!-- Container fluid  -->
            <!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Data Jumlah Karyawan <span class="badge badge-info" style="font-size: 13px;">Penetapan SKI</span></h5>
          <div class="col-md-6 col-lg-3 col-xlg-3" style="float:left">
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

          <div class="col-md-6 col-lg-3 col-xlg-3" style="float:left">
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
          
          <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
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

          <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
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

          <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
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
      </div>
  <!-- penilaian -->
  <?php
    for($i = 1; $i < 5; $i++){
      $e  = array('jenis_realisasi'=>'TW'.$i, 'tahun'=>$thn); 
  ?>
    <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Data Jumlah SKI Karyawan <span class="badge badge-info" style="font-size: 13px;"> Triwulan <?php echo $i?> </span></h5>
            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+buat+penilaian+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>"> 
                   <div class="box  bg-success text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php echo $sudahskitw = $this->Model_dashboard_karyawan->hitung_sudah_penilaian_tw($e);?></h1>
                       <h6 class="text-white">Sudah Buat Penilaian TW<?php echo $i; ?></h6>

                    </div>
                    </a>
                </div>
            </div>
                  
            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+buat+penilaian+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>"> 
                   <div class="box bg-danger text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php $belum=$jml_karyawan-$sudahskitw; echo $belum;?></h1>
                       <h6 class="text-white">Belum Buat Penilaian TW<?php echo $i; ?></h6>

                    </div>
                    </a>
                </div>
            </div>
        
            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+approve+1+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>">
                   <div class="box  bg-success text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php echo $approve1= $this->Model_dashboard_karyawan->hitung_approve1('TW'.$i);  ;?></h1>
                       <h6 class="text-white">Sudah Approve 1 Penilaian TW<?php echo $i; ?></h6>

                    </div>
                    </a>
                </div>
            </div>
                  
            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+approve+1+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>">
                   <div class="box bg-danger text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php $app1=$jml_karyawan-$approve1; echo $app1;?></h1>
                       <h6 class="text-white">Belum Approve 1 Penilaian TW<?php echo $i; ?></h6>

                    </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+sudah+approve+2+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>">
                   <div class="box  bg-success text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php echo $approve2= $this->Model_dashboard_karyawan->hitung_approve2('TW'.$i);;?></h1>
                       <h6 class="text-white">Sudah Approve 2 Penilaian TW<?php echo $i; ?></h6>

                    </div>
                    </a>
                </div>
            </div>
                  
            <div class="col-md-6 col-lg-2 col-xlg-3" style="float:left">
                <div class="card card-hover">
                 <a href="<?php echo base_url();?>admin/action?page=Data+Karyawan+belum+approve+2+<?php echo 'TW'.$i;?>&tw=<?php echo 'TW'.$i;?>"> 
                   <div class="box bg-danger text-center">
                        <h6 class="text-white">Jumlah</h6>
                        <h2 class="font-light text-white"><?php $app2=$approve1-$approve2; echo $app2;?></h1>
                       <h6 class="text-white">Belum Approve 2 Penilaian TW<?php echo $i; ?></h6>
                    </div>
                    </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

</div></div></div>