
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Data Penetapan SKI</h4>
                            <h5 class="card-subtitle">Penetapan Karyawan PT.INTI Tahun <b><?php echo $thn; ?></b></h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-12">
                          <canvas id="bar-chart-grouped"  width="400" height="400"></canvas>

                          
                        </div>
                      
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="<?php echo base_url()?>dist/chart/Chart.js"></script>    
    <script src="<?php echo base_url()?>dist/chart/Chart.bundle.js"></script>    
    <!-- <script src="<?php echo base_url()?>dist/js/jquery-3.3.1.js"></script>    
      <script src="<?php echo base_url()?>dist/js/ski_online.js"></script>   -->  
    <script type="text/javascript">



 var chart = new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    fontSize: 0,
    data: {
      labels: 
      [
        <?php 
          foreach ($chartpenetapan as $key) 
          {
            echo '"'.$key->DIVISI.'",';
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
                $b = $this->Model_dashboard_karyawan->jml_blm_ski_penilaian($thn,$div,$tw);
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
                $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian($thn,$div,$tw);
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
                $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian_approve1($div,$tw);
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
                $b = $this->Model_dashboard_karyawan->jml_sdh_ski_penilaian_approve2($div,$tw);
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
              fontSize: 10//,
              // display:false
            }
        }]
      }

    }


});


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