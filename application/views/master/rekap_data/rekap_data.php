<style type="text/css">
   th{
        text-align: center;
        font-weight: bold;
        font-size: 13px;
    }

    td{
        text-align: left;
      
        font-size: 13px;
    }
    tbody {
        font-size: 13px;
    }
  </style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Rekap Data SKI Karyawan</h3>
            </div> 
        </div>
        <br>
        <form method="post" action="<?php echo base_url()?>Admin/get_rekap_ski" enctype="multipart/form-data">
            <div class="row" >
            <div class="col-md-2" ></div>
                    <div class="col-md-2" >
                    <select class="form-control input-sm mb-md" name="tw" id="tw">
                          <option value="%" style="text-align: center;">--- Pilih TW ---</option>   
                                                                            
                                <option value="TW1">TW 1</option>
                                <option value="TW2">TW 2</option>
                                <option value="TW3">TW 3</option>
                                <option value="TW4">TW 4</option>
                        </select>
                    </div>
                    <div class="col-md-2" >

                        <select class="form-control input-sm mb-md" name="tahun" id ="tahun">
                          <option value="%" style="text-align: center;">--- Pilih Tahun ---</option>   
                            <?php foreach ($thn_real as $key): ?>                                              
                                <option value="<?php echo $key->tahun;?>"><?php echo $key->tahun;?></option> 
                            <?php endforeach ?>
                        </select>
                            
                    </div>
                    <div class="col-md-2">

                        <button class="btn btn-primary"  style="float: left;" type="submit" name="tampilkan" id="tampilkan" value="tampilkan" ><i class="fas fa-filter" ></i> <?php echo nbs(2) ?>T A M P I L K A N</button>

                    </div>
                    <div class="col-md-2"> <button class="btn btn-success"  style="float: left;" type="submit" name="tampilkan" id="tampilkan" value="tampilkan" ><i class="fas fa-file-excel" ></i> <?php echo nbs(2) ?>E X C E L</button></div>
            </div>          
        </form>            
        <br>
        <div class="row">
            <div class="col-md-12">
                
        <div class="table-responsive">
        
            <table id="rekap_data" class="table table-sm table-hover table-bordered" align="center" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: bold; vertical-align: middle;">NO</th>
                        <th style="font-weight: bold; vertical-align: middle;">NIPEG</th>
                        <th style="font-weight: bold; vertical-align: middle;">NAMA</th>
                        <th style="font-weight: bold; vertical-align: middle;">JABATAN</th>
                        <th style="font-weight: bold; vertical-align: middle;">DIVISI</th> 
                        <th style="font-weight: bold; vertical-align: middle;">BAGIAN</th> 
                        <th style="font-weight: bold; vertical-align: middle;">URUSAN</th>                   
                        <th style="font-weight: bold; vertical-align: middle;">TRIWULAN</th>
                        <th style="font-weight: bold; vertical-align: middle;">NILAI SKI</th>
                        <th style="font-weight: bold; vertical-align: middle;">PERIODE</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>            
            </table>

        </div>
            </div>
        </div>
    </div>  
</div>




