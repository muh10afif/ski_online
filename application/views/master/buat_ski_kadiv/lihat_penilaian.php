<style type="text/css">
	th {
		text-align: center;
	}
</style>
<div class="card">
	<div class="card-body">
		<h3 class="page-title">Penilaian <span class="badge badge-warning" style="font-size: 20px; font-weight: bold;"><?= $tw ?></span> SKI Karyawan </h3>
		<h6 style="color: grey;">Menampilkan Data Penilaian SKI Karyawan dibuat oleh Admin</h6>
		<br>
		<div id="tutup">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link active" data-toggle="tab" href="#buat" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-danger" style="font-size: 13px; font-weight: bold;"><?= $karyawan_blm_h ?> Karyawan</span>&nbsp;Belum Buat Penilaian <?= $tw ?></span></a> </li>
	        <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#ubah" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-primary" style="font-size: 13px; font-weight: bold;"><?= $karyawan_ubah_h ?> Karyawan</span>&nbsp;Ubah Data Penilaian <?= $tw ?></span></a> </li>
	        <li class="nav-item" style="font-weight: bold; font-size: 15px;"> <a class="nav-link" data-toggle="tab" href="#kirim" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?= $karyawan_sdh_h ?> Karyawan</span>&nbsp;Sudah Submit Penilaian <?= $tw ?></span></a> </li>
    	</ul>

		<div class="tab-content tabcontent-border">

	    	<div class="tab-pane active" id="buat" role="tabpanel">
	                <div class="p-20 table-responsive">
	                    <table id="tb_pen_kadiv_blm_" class="table table-hover table-bordered" style="width: 100%;" align="center">
	                    	<thead class="thead-light">
	                    		<th style="font-weight: bold;">NO</th>
	                    		<th style="font-weight: bold;">NIPEG</th>
	                    		<th style="font-weight: bold; width: 25%;">NAMA</th>
	                    		<th style="font-weight: bold;">JABATAN</th>
	                    		<th style="font-weight: bold;">AKSI</th>
	                    	</thead>
	                    	<tbody>
	                    		<?php $no=1; foreach ($karyawan_blm as $belum): ?>
	                    			<tr>
	                    				<td style="text-align: center;"><?= $no++ ?></td>
	                    				<td><?= $belum->NIPEG ?></td>
	                    				<td><?= $belum->NAMA ?></td>
	                    				<td><?= $belum->H_JOBTITLE ?></td>
	                    				<td style="text-align: center;"><a href="<?= base_url("Master/penilaian_ski/$belum->NIPEG/$tw") ?>"><button type="button" class="btn btn-danger">B U A T - T W</button></a></td>
	                    			</tr>
	                    		<?php endforeach ?>
	                    	</tbody>
	                    </table>
	                </div>
	            </div>
	            <div class="tab-pane" id="ubah" role="tabpanel">
	                <div class="p-20 table-responsive">
	                    <table id="tb_pen_kadiv_ubah" class="table table-hover table-bordered" align="center">
	                    	<thead class="thead-light">
	                    		<th style="font-weight: bold;">NO</th>
	                    		<th style="font-weight: bold;">NIPEG</th>
	                    		<th style="font-weight: bold; width: 25%;">NAMA</th>
	                    		<th style="font-weight: bold;">JABATAN</th>
	                    		<th style="font-weight: bold;">AKSI</th>
	                    	</thead>
	                    	<tbody>
	                    		<?php $no=1; foreach ($karyawan_ubah as $ubah): ?>
	                    			<tr>
	                    				<td style="text-align: center;"><?= $no++ ?></td>
	                    				<td><?= $ubah->NIPEG ?></td>
	                    				<td><?= $ubah->NAMA ?></td>
	                    				<td><?= $ubah->H_JOBTITLE ?></td>
	                    				<td style="text-align: center;"><a href="<?= base_url("Master/penilaian_ski/$ubah->NIPEG/$tw") ?>"><button type="button" class="btn btn-primary">U B A H - T W</button></a></td>
	                    			</tr>
	                    		<?php endforeach ?>
	                    	</tbody>
	                    </table>
	                </div>
	            </div>
	            <div class="tab-pane" id="kirim" role="tabpanel">
	                <div class="p-20 table-responsive">
	                   <table id="tb_pen_kadiv_sdh" class="table table-hover table-bordered" align="center">
	                    	<thead class="thead-light">
	                    		<th style="font-weight: bold;">NO</th>
	                    		<th style="font-weight: bold;">NIPEG</th>
	                    		<th style="font-weight: bold; width: 25%;">NAMA</th>
	                    		<th style="font-weight: bold;">JABATAN</th>
	                    		<th style="font-weight: bold;">AKSI</th>
	                    	</thead>
	                    	<tbody>
	                    		<?php $no=1; foreach ($karyawan_sdh as $sdh): ?>
	                    			<tr>
	                    				<td style="text-align: center;"><?= $no++ ?></td>
	                    				<td><?= $sdh->NIPEG ?></td>
	                    				<td><?= $sdh->NAMA ?></td>
	                    				<td><?= $sdh->H_JOBTITLE ?></td>
	                    				<td style="text-align: center;"><a href="<?= base_url("Master/penilaian_ski/$sdh->NIPEG/$tw") ?>"><button type="button" class="btn btn-success">P R E V I E W - T W</button></a></td>
	                    			</tr>
	                    		<?php endforeach ?>
	                    	</tbody>
	                    </table>
	                </div>
	            </div>
	        </div>

           	</div>

	</div>
</div>