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
            
        <div class="table-responsive">
            <form method="post" enctype="multipart/form-data" action="action_status_karyawan" class="form-horizontal">
                <div class="row">
                <div class="col-md-6"><h3 class="page-title">Data Status Karyawan</h3></div>
                <div class="col-md-6">
                    
                <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px;font-weight: initial; "><i class="fas fa-pencil-alt"></i><?= nbs(3) ?>U B A H - S T A T U S</button>
                </div></div><br>
            <?php echo $this->session->flashdata('msg');?>
                <table id="table_status_karyawan" class="table table-bordered table-hover" align="center" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="font-weight: bold;">NIPEG</th>
                            <th style="font-weight: bold;">NAMA</th>
                            <th style="font-weight: bold;">DIVISI</th>
                            <th style="font-weight: bold;">JOBTITLE</th>
                            <th style="font-weight: bold;">BUAT STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
    				</tbody>            
                </table>

            </form>
        </div>
    </div>  
</div>
