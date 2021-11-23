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
		<h3 class="page-title">Penilaian Penalty <span class="badge badge-info" style="font-size: 20px; font-weight: bold;"><?php echo $tw ?></span> SKI Tahun <?php echo $thn ?></h3><br>
		<ul class="nav nav-tabs" role="tablist">

	            
	        <?php if (count($divisi_belum) != 0) : ?>

	            <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#buat" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-danger" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_belum_h ?> Divisi</span>&nbsp;Belum Buat Penilaian Penalty</span></a> </li>
	            <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#ubah" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-primary" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_ubah_h ?> Divisi</span>&nbsp;Ubah Data Penilaian Penalty</span></a> </li>
	            
	            <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#kirim" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_submit_h ?> Divisi</span>&nbsp;Sudah Submit Penilaian Penalty</span></a> </li>

            <?php elseif (count($divisi_ubah) != 0) : ?>

	            <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#ubah" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-primary" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_ubah_h ?> Divisi</span>&nbsp;Ubah Data Penilaian Penalty</span></a> </li>
	            
	            <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#kirim" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_submit_h ?> Divisi</span>&nbsp;Sudah Submit Penilaian Penalty</span></a> </li>

            <?php else : ?>
            
            	<li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#kirim" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?php echo $divisi_submit_h ?> Divisi</span>&nbsp;Sudah Submit Penilaian Penalty</span></a> </li>

            <?php endif ?>
            
        </ul>

        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
        	<?php if (count($divisi_belum) != 0) : ?>
            <div class="tab-pane active" id="buat" role="tabpanel">
                <div class="p-20 table-responsive">
                    <table id="tabel" class="table table-hover table-bordered" style="width: 90%;" align="center">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_belum as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-success">B U A T - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="ubah" role="tabpanel">
                <div class="p-20 table-responsive">
                    <table id="tb_tw" class="table table-hover table-bordered"  style="width: 90%;" align="center">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_ubah as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-warning">U B A H - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="kirim" role="tabpanel">
                <div class="p-20 table-responsive">
                   <table id="tb_tw_sdh" class="table table-hover table-bordered"  style="width: 90%;" align="center">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_submit as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-info">P R E V I E W - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <?php elseif (count($divisi_ubah) != 0) : ?>
            	<div class="tab-pane active" id="ubah" role="tabpanel">
                <div class="p-20 table-responsive">
                    <table id="tabel" class="table table-hover table-bordered"  style="width: 90%;">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_ubah as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-warning">U B A H - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="kirim" role="tabpanel">
                <div class="p-20 table-responsive">
                   <table id="tabel" class="table table-hover table-bordered"  style="width: 90%;">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_submit as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-info">P R E V I E W - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <?php else : ?>
            <div class="tab-pane active" id="kirim" role="tabpanel">
                <div class="p-20 table-responsive">
                   <table id="tabel" class="table table-hover table-bordered"  style="width: 90%;">
                    	<thead class="thead-light">
                    		<th style="font-weight: bold;">NO</th>
                    		<th style="font-weight: bold;">DIVISI</th>
                    		<th style="font-weight: bold;">AKSI</th>
                    	</thead>
                    	<tbody>
                    		<?php $no=1; foreach ($divisi_submit as $d) : ?>
                    		<?php
                    		// Mengubah URL dengan ganti beberapa string karakter
				        	$ganti 	= array("_","dan");
							$asal	= array(" ","&");
							$hasil 	= str_replace($asal, $ganti, $d->DIVISI);
							// Akhir mengubah URL dengan ganti beberapa string karakter ?>
                    		<tr>
                    			<td style="text-align: center;"><?php echo $no++ ?></td>
                    			<td><?php echo $d->DIVISI ?></td>
                    			<td style="text-align: center;">
                    				<a href="<?php echo base_url() ?>Master/buat_penalty_realisasi/<?php echo $hasil ?>/<?php echo $tw ?>"><button type="button" class="btn btn-info">P R E V I E W - S K I</button></a></td>
                    		</tr>
                    		<?php endforeach ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <?php endif ?>
        </div>
	</div>
</div>