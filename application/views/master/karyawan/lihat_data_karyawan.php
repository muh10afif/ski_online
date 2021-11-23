 <style type="text/css">
        th {
            text-align: center;
            font-size: 15px;
        }
        tr {
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
        <h3 class="page-title">Data Karyawan</h3>
        <div class="ml-auto text-right">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px; font-weight: initial;" onclick="reload_data()"><i class="fas fa-sync-alt"></i><?= nbs(3) ?>R E L O A D - D A T A</button>
        </div>
        </div>
    </div>

        <br>
        <div class="table-responsive">
			<?php echo $this->session->flashdata('msg');?>
            <table id="table_karyawan" class="table table-bordered table-hover" align="center" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: bold; text-align: center;">NO</th>
                        <th style="font-weight: bold;">NIPEG</th>
                        <th style="font-weight: bold;" width="25%">NAMA</th>
                        <th style="font-weight: bold;">DIVISI</th>
                        <th style="font-weight: bold;">JOBTITLE</th>
                        <th style="font-weight: bold;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
				</tbody>            
            </table>
        </div>
    </div>  
</div>
