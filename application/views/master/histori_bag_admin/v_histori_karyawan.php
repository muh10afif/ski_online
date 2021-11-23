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
				<h3 class="page-title">History SKI karyawan PT. INTI</h3>
			</div> 
		</div>
        <br>
        <form method="post" action="#" enctype="multipart/form-data">
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

                        <button class="btn btn-primary"  style="float: left;" type="submit" name="tampilkan" id="tampilkan" value="tampilkan" ><i class="fas fa-filter" ></i> <?php echo nbs(2) ?>T A M P I L K A N</button>

                    </div>
                    <div class="col-md-2"></div>
            </div>          
        </form>            
        <br>
        <div class="table-responsive">
        
            <table id="histori" class="table table-hover table-bordered" align="center">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: bold;">NO</th>
                        <th style="font-weight: bold;">NIPEG</th>
                        <th style="font-weight: bold; width: 25%;">NAMA</th>
                        <th style="font-weight: bold;">DIREKTORAT</th>
                        <th style="font-weight: bold;">DIVISI</th>                      
                        <th style="font-weight: bold;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
				</tbody>            
            </table>

        </div>
    </div>  
</div>




