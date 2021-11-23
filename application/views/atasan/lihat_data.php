<style>
	th {
		text-align: center;
		font-size: 15px;
	}
	td {
		font-size: 15px;
	}
</style>

<link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">


<div class="card">
	<div class="card-body">
		<div id="row">
		<h3 class="page-title">Data Karyawan Bawahan</h3>
		<?php echo br() ?>

		<div class="card" >
            <!-- Nav tabs -->
            <?php if ($status != 'SKI'): ?>

	            <ul class="nav nav-tabs" role="tablist">
	            	<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#belum_submit_nilai" role="tab">
	            		<span class="hidden-sm-up"></span> <span class="hidden-xs-down">
	            			<strong><span class="badge badge-pill badge-danger" style="font-size: 13px; font-weight: bold;"><?= $belum_submit_nilai_h ?> Karyawan</span>&nbsp;&nbsp;Belum Submit Penilaian <?= $status; ?></strong></span></a> 
	            	</li>
	            	<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#belum_penilaian" role="tab">
	            		<span class="hidden-sm-up"></span> <span class="hidden-xs-down">
	            			<strong><span class="badge badge-pill badge-primary" style="font-size: 13px; font-weight: bold;"><?= $belum_nilai_bawahan_hitung ?> Karyawan</span>&nbsp;&nbsp;Belum Approve Penilaian <?= $status; ?></strong></span></a> 
	            	</li>
	                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sudah_penilaian" role="tab">
	                	<span class="hidden-sm-up"></span> <span class="hidden-xs-down">
	                		<strong><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?= $sudah_nilai_bawahan_hitung ?> Karyawan</span>&nbsp;&nbsp;Sudah Approve Penilaian <?= $status; ?></strong></span></a>
	                </li>
	            </ul>

	            <div class="tab-content tabcontent-border">
					<!-- Tab Belum Penilaian -->
	                <div class="tab-pane active" id="belum_submit_nilai" role="tabpanel">
	                    <div class="p-20">
	                       <div class="table-responsive">
								<table id="tb_belum_submit" class="table table-hover table-bordered" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
									</thead>
									<tbody>

										<?php $no=0; foreach ($belum_submit_nilai as $c): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $c->NIPEG; ?></td>
											<td><?= $c->NAMA; ?></td>
											<td><?= $c->JOBTITLE; ?></td>
											<td><?= $c->BAGIAN; ?></td>
											<td><?= $c->DIVISI; ?></td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>

	                <!-- Tab Belum Penilaian -->
	                <div class="tab-pane" id="belum_penilaian" role="tabpanel" >
	                    <div class="p-20" id="tutup">
	                       <div class="table-responsive">
								<table id="tb_belum_nilai" class="table table-hover table-bordered" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
										<th><strong>AKSI</strong></th>
									</thead>
									<tbody>

										<?php $no=0; foreach ($belum_nilai_bawahan as $c): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $c->NIPEG; ?></td>
											<td><?= $c->NAMA; ?></td>
											<td><?= $c->JOBTITLE; ?></td>
											<td><?= $c->BAGIAN; ?></td>
											<td><?= $c->DIVISI; ?></td>
											<td>
												<a href="<?= base_url() ?>Atasan1/karyawan_penilaian/<?= $c->NIPEG; ?>"><button type="button" class="btn btn-info btn-sm">V I E W</button></a>
											</td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>
					
					<!-- Tab Sudah Penilaian -->
	                <div class="tab-pane" id="sudah_penilaian" role="tabpanel">
	                    <div class="p-20">
	                         <div class="table-responsive">
								<table id="tb_sudah_nilai" class="table table-hover table-bordered" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
										<th><strong>AKSI</strong></th>
									</thead>
									<tbody>
										<?php $no=0; foreach ($sudah_nilai_bawahan as $c): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $c->NIPEG; ?></td>
											<td><?= $c->NAMA; ?></td>
											<td><?= $c->JOBTITLE; ?></td>
											<td><?= $c->BAGIAN; ?></td>
											<td><?= $c->DIVISI; ?></td>
											<td>
												<a href="<?= base_url() ?>Atasan1/karyawan_penilaian/<?= $c->NIPEG; ?>"><button type="button" class="btn btn-info btn-sm">V I E W</button></a>
											</td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>
	            </div>
            	
            <?php else: ?>

	            <ul class="nav nav-tabs" role="tablist">
					<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#belum_ski" role="tab">
						<span class="hidden-sm-up"></span> <span class="hidden-xs-down">
							<strong><span class="badge badge-pill badge-danger" style="font-size: 13px; font-weight: bold;"><?php echo $bawahan_belum_ski_h ?> Karyawan</span>&nbsp;&nbsp;Belum Submit Penetapan SKI</strong></span></a>
					</li>
					<li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#belum_penetapan" role="tab">
						<span class="hidden-sm-up"></span> <span class="hidden-xs-down">
							<strong><span class="badge badge-pill badge-primary" style="font-size: 13px; font-weight: bold;"><?php echo $bawahan ?> Karyawan</span>&nbsp;&nbsp;Belum Approve Penetapan SKI</strong></span></a>
					</li>
	                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sudah_penetapan" role="tab">
	                	<span class="hidden-sm-up"></span> <span class="hidden-xs-down"><strong><span class="badge badge-pill badge-success" style="font-size: 13px; font-weight: bold;"><?php echo $bawahan_sudah_1 ?> Karyawan</span>&nbsp;&nbsp;Sudah Approve Penetapan SKI</strong></span></a>
	                </li>
				</ul>

				<div class="tab-content tabcontent-border">

					<!-- Tab Sudah Penetapan SKI -->
	                <div class="tab-pane active" id="belum_ski" role="tabpanel">
	                    <div class="p-20">
	                        <div class="table-responsive">
								<table id="tb_belum_ski" class="table table-bordered table-hover" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th width="20%"><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
									</thead>
									<tbody>
										<?php $no=0; foreach ($bawahan_belum_ski as $b): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $b->NIPEG; ?></td>
											<td><?= $b->NAMA; ?></td>
											<td><?= $b->JOBTITLE; ?></td>
											<td><?= $b->BAGIAN; ?></td>
											<td><?= $b->DIVISI; ?></td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>

	            	<!-- Tab Belum Penetapan SKI -->
	                <div class="tab-pane " id="belum_penetapan" role="tabpanel">
	                    <div class="p-20">
	                        <div class="table-responsive">
								<table id="tb_atasan" class="table table-hover table-bordered" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th width="25%"><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
										<th><strong>AKSI</strong></th>
									</thead>
									<tbody>
										<?php $no=0; foreach ($bawahan_1 as $b): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $b->NIPEG; ?></td>
											<td><?= $b->NAMA; ?></td>
											<td><?= $b->JOBTITLE; ?></td>
											<td><?= $b->BAGIAN; ?></td>
											<td><?= $b->DIVISI; ?></td>
											<td>
												<a href="<?= base_url() ?>Atasan1/karyawan_penetapan/<?= $b->NIPEG; ?>"><button type="button" class="btn btn-info btn-sm">V I E W</button></a>
											</td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>
					
					<!-- Tab Sudah Penetapan SKI -->
	                <div class="tab-pane" id="sudah_penetapan" role="tabpanel">
	                    <div class="p-20">
	                        <div class="table-responsive">
								<table id="tb_belum" class="table table-hover table-bordered" align="center">
									<thead class="thead-light">
										<th><strong>NO</strong></th>
										<th><strong>NIPEG</strong></th>
										<th><strong>NAMA</strong></th>
										<th><strong>JOBTITLE</strong></th>
										<th><strong>BAGIAN</strong></th>
										<th><strong>DIVISI</strong></th>
										<th><strong>AKSI</strong></th>
									</thead>
									<tbody>
										<?php $no=0; foreach ($bawahan_sudah as $b): $no++?>
											
										<tr>
											<td style="text-align: center;"><?= $no; ?></td>
											<td><?= $b->NIPEG; ?></td>
											<td><?= $b->NAMA; ?></td>
											<td><?= $b->JOBTITLE; ?></td>
											<td><?= $b->BAGIAN; ?></td>
											<td><?= $b->DIVISI; ?></td>
											<td>
												<a href="<?= base_url() ?>Atasan1/karyawan_penetapan/<?= $b->NIPEG; ?>"><button type="button" class="btn btn-info btn-sm">V I E W</button></a>
											</td>
										</tr>

										<?php endforeach ?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>
	            </div>
				
	        <?php endif ?>
	        <!-- Tab panes -->

       	</div>
   		</div>
	</div>
</div>


<script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
	/* DATATABLES TB_ATASAN */
    $('#tb_atasan').DataTable();
    
    $('#tb_belum').DataTable(); 
    $('#tb_belum_ski').DataTable();

    $('#tb_belum_nilai').DataTable();
    $('#tb_belum_submit').DataTable();
    $('#tb_sudah_nilai').DataTable();
</script>
