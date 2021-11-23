<style type="text/css">
    th {
        text-align: center;
        font-weight: bold;
        font-size: 15px;
    }
    tbody {
        font-size: 15px;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Data Indikator Kerja JOBTITLE</h3>
            </div> 
        </div><br>
        <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#belum" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-danger" style="font-size: 13px; font-weight: bold;"><?= $job_belum_h ?> Jobtitle</span>&nbsp;Belum Memiliki Indikator</span></a> </li>
                <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#sudah" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?= $job_sudah_h ?> Jobtitle</span>&nbsp;Sudah Memiliki Indikator</span></a> </li>
                <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#preview" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Preview Indikator Kerja Jobtitle</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="belum" role="tabpanel">
                <div class="p-20 table-responsive">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                            <table id="tb_direktori_belum" class="table table-hover table-bordered" align="center" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-weight: bold;">NO</th>
                                        <th style="font-weight: bold;">JOBTITLE</th>
                                        <th style="font-weight: bold;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($job_belum as $jb): 
                                    // Mengubah URL dengan ganti beberapa string karakter
                                    $ganti  = array("_","dan","koma");
                                    $asal   = array(" ","&",",");
                                    $hasil  = str_replace($asal, $ganti, $jb->JOBTITLE);
                                    // Akhir mengubah URL dengan ganti beberapa string karakter
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++ ?></td>
                                            <td><?= $jb->JOBTITLE ?></td>
                                            <td><a href="<?php echo base_url() ?>Master/lihat_direktori/<?php echo $hasil ?>" class="btn btn-success btn-sm">L I H A T</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>            
                            </table>

                        </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="sudah" role="tabpanel">
                <div class="p-20 table-responsive">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                            <table id="tb_direktori_sudah" class="table table-hover table-bordered" align="center" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-weight: bold;">NO</th>
                                        <th style="font-weight: bold;">JOBTITLE</th>
                                        <th style="font-weight: bold;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($job_sudah as $js): 
                                    // mengubah url
                                    $asal = array(" ","&",",");
                                    $ganti= array("_","dan",".");
                                    $hasil= str_replace($asal, $ganti, $js->JOBTITLE);
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++ ?></td>
                                            <td><?= $js->JOBTITLE ?></td>
                                            <td style="text-align: center;"><a class="btn btn-success" href="<?= base_url() ?>Master/lihat_direktori/<?= $hasil ?>">L I H A T</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>            
                            </table>

                        </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="preview" role="tabpanel">
                <div class="p-20 table-responsive">
                                       <div class="row" >
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <form method="post" action="#">


                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="jobtitle" id="jobtitle">
                          <option value="%" style="text-align: center;">--- Pilih JOBTITLE yang akan dicari ---</option>   
                           <?php foreach ($job_sudah as $j ) : ?>                                                    
                               <option value="<?php echo $j->JOBTITLE;?>"><?php echo $j->JOBTITLE;?></option> 
                           <?php endforeach ?>
                        </select>
                            
                    </div>
                    <div class="col-md-3">

                        <button class="btn btn-primary"  style="float: left;" type="submit" name="tampilkan" id="tampilkan" value="tampilkan" ><i class="fas fa-filter" ></i> <?php echo nbs(2) ?>T A M P I L K A N</button>
                    </div>
                    <div class="col-md-2"></div>
                        </div>          
                    </form>            
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="tb_direktori" class="table table-hover table-bordered" align="center" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-weight: bold; vertical-align: middle;">NO</th>
                                        <th style="font-weight: bold; vertical-align: middle;">PROKER</th>
                                        <th style="font-weight: bold; vertical-align: middle;">INDIKATOR</th>
                                        <th style="font-weight: bold; vertical-align: middle;">SATUAN INDIKATOR</th>
                                        <th style="font-weight: bold; vertical-align: middle;">CARA PENGUKURAN</th>
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
    </div>
</div>
