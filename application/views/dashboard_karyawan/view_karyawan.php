<style type="text/css">
        th {
            text-align: center;
            font-size: 15px;
        }
        tr {
            font-size: 15px;
        }
</style>

<div class="card">
   
    <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
        <h3 class="page-title"><?php echo $title; ?></h3>
        </div>
    </div>

        <br>
        <div class="table-responsive">
            <div class="col-md-12"  style="margin-bottom:5px;">
          <form action="" id="form" method="get" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="page" value="<?php echo $title; ?>">
                <input type="hidden" name="tw" value="<?php echo $tw; ?>">  

                <div class="row" >
                    <div class="col-md-3"></div>
                    <div class="col-md-4">

                        <select class="form-control input-sm mb-md" name="divisi" id="divisi">
                          <option value="%" style="text-align: center;">--- Pilih divisi yang akan dicari ---</option>   
                            <?php foreach ($divisi as $key ):?>                                                    
                                <option value="<?php echo $key->DIVISI;?>"><?php echo $key->DIVISI;?></option> 
                            <?php endforeach ?>
                        </select>
                            
                    </div>
                    <div class="col-md-3">

                        <button class="btn btn-primary"  style="float: left;" type="submit"><i class="fas fa-filter" ></i> <?php echo nbs(2) ?>T A M P I L K A N</button>

                    </div>
                    <div class="col-md-2"></div>
                </div> 
          </form> 
            </div> <br>
          <table id="table_status" class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: bold;">NO</th>
                        <th style="font-weight: bold;">NIPEG</th>
                        <th style="font-weight: bold;">NAMA</th>
                        <th style="font-weight: bold;">BAGIAN</th>
                        <th style="font-weight: bold;">JABATAN</th>
                        <th style="font-weight: bold;">DIVISI</th>
                    </tr>
                </thead>
                     <?php $no = 1; foreach ($div as $key):?>
                        <tr>
                           <td style="text-align: center;"><?php echo $no ?></td>
                           <td><?php echo $key->NIPEG; ?></td>
                           <td><?php echo  $key->NAMA; ?></td>
                           <td><?php  echo $key->BAGIAN; ?></td>
                           <td><?php  echo $key->JOBTITLE; ?></td>
                           <td><?php  echo $key->DIVISI; ?></td>
                        </tr>
                     <?php $no++; endforeach ?>
            </table>
        </div>
    </div>  
</div>