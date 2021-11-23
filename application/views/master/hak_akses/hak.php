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
				<h3 class="page-title">Data Hak Akses</h3>
			</div>
		</div>

        <br>
        <div class="table-responsive">
			<?php if($hak=='0'){?>
			<?php }else{;?>
				<div class="alert alert-danger">Anda memiliki Kelebihan <?php echo $hak;?> hak akses karyawan yang tidak ada pasanganya. klik <a href="#" data-toggle="modal" data-target="#myModal">Disini</a> untuk menghapusnya</div>
			<?php };?>
			<?php if($karyawan=='0'){?>
			<?php }else{;?>
				<div class="alert alert-warning">Anda memiliki <?php echo $karyawan;?> karyawan yang belum mempunyai hak akses di web ski online. klik <a href="#" data-toggle="modal" data-target="#myModal">Disini</a> untuk menambahkan hak aksesnya</div>
			<?php };?>
			<?php echo $this->session->flashdata('msg');?>
            <table id="hak" class="table table-bordered table-hover" align="center">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: bold; vertical-align: middle;">NO</th>
                        <th style="font-weight: bold; vertical-align: middle;">NIPEG</th>
                        <th style="font-weight: bold; vertical-align: middle;">NAMA</th>
						<th style="font-weight: bold; vertical-align: middle;">EMAIL</th>
						<th style="font-weight: bold; vertical-align: middle;">JOBTITLE</th>
                        <th style="font-weight: bold; vertical-align: middle;">HAK AKSES</th>
                        <th style="font-weight: bold; vertical-align: middle;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
				</tbody>            
            </table>
        </div>
    </div>  
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" style="margin-left:auto; margin-right:auto; font-size:12px; min-width:80%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Penanganan HAK AKSES(tidak ada/kelebihan)
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-6" style="float:left">
					<h4>Daftar Karyawan Tanpa Hak Akses</h4>
					<table id="table"  class="table table-striped" style='font-size:12px' >
						<thead>
						  <th>NIPEG</th>
						  <th>Nama</th>
						  <th>Hak Akses</th>
						</thead>
						<tbody>
						<form method="post" enctype="multipart/form-data" action="proses_tambah_hak_akses">
							<?php if($karyawan=='0'){?>
											<td colspan="4"><h5 style="text-align:center;">Tidak ada Data lebih</h5></td>
										<?php } else{?>
								<?php foreach ($datakaryawan as $k){?>
									<tr>
										<td><?php echo $k->NIPEG;?></td>
										<td><?php echo $k->NAMA;?> (<?php echo $k->JOBTITLE;?>)</td>
										<td>
											<input type="hidden" value="<?php echo $k->NIPEG;?>" name="nipeg[]">
											<input type="hidden" value="insert" name="sts[]">
											<select class="form-control border-input" name="hak[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 1-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
											<select class="form-control border-input" name="hak1[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 1-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
											<select class="form-control border-input" name="hak2[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 2-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
										</td>
									</tr>
								<?php };?>
								<?php foreach ($datakaryawanbelum as $l){?>
									<tr>
										<td><?php echo $l->NIPEG;?></td>
										<td><?php echo $l->NAMA;?> (<?php echo $l->JOBTITLE;?>)</td>
										<td>
											<input type="hidden" value="<?php echo $l->NIPEG;?>" name="nipeg[]">
											<input type="hidden" value="uptd" name="sts[]">
											<select class="form-control border-input" name="hak[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 1-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
											<select class="form-control border-input" name="hak1[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 1-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
											<select class="form-control border-input" name="hak2[]" style="width:165px;" required>
												<option selected  value="">-Pilih Hak Akses 2-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
										</td>
									</tr>
								<?php };?>
							<?php };?>	
							<button type="submit" class="btn btn-default">Tambah</button>
						</form>
						</tbody>
					</table>
				</div>
				<div class="col-md-6" style="float:left">
					<h4>Daftar Hak Akses Tanpa Karyawan</h4>
					<table id="table"  class="table table-striped" style='font-size:12px' >
						<thead>
						  <th>NIPEG</th>
						  <th>Hak Akses</th> 
						  <th>Action</th> 
						</thead>
						<tbody>
						<form method="post" enctype="multipart/form-data" action="proses_hapus_hak_akses">
							<?php if($hak=='0'){?>
											<td colspan="4"><h5 style="text-align:center;">Tidak ada Data lebih</h5></td>
										<?php } else{?>
								<?php foreach ($datahak as $k){?>
									<tr>
										<td>
											<?php echo $k->NIPEG;?>
										</td><td>
											<?php echo $k->ROLE;?>
										</td>
										<td><input type="checkbox" value="<?php echo $k->NIPEG;?>"name="nipeg[]"></td>
									</tr>
								<?php };?>
							<?php };?>	
							<button type="submit" class="btn btn-danger">Hapus</button>
						</form>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Hak Akses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                 <form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>master/update_hak_akses" class="form-horizontal">
                    <div class="card">
                                <input type="hidden" value="" name="nipeg"/>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="divisi" class="col-sm-3 text-right control-label col-form-label">Hak Akses</label>
                                        <div class="col-sm-9">
                                            <select class="form-control border-input" name="hak_akses" >
												<option selected  value="">-Pilih Hak Akses-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label for="divisi" class="col-sm-3 text-right control-label col-form-label">Hak Akses 1</label>
                                        <div class="col-sm-9">
                                            <select class="form-control border-input" name="hak_akses1" >
												<option selected  value="">-Pilih Hak Akses-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label for="divisi" class="col-sm-3 text-right control-label col-form-label">Hak Akses 2</label>
                                        <div class="col-sm-9">
                                            <select class="form-control border-input" name="hak_akses2" >
												<option selected  value="">-Pilih Hak Akses-</option>
												<option  value="Admin">Admin</option>
												<option  value="Karyawan">Karyawan</option>
												<option  value="Atasan">Atasan</option>
											</select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C A N C E L</button><?php echo nbs(4) ?>
                        	<button type="submit" class="btn btn-success"  onclick="action_jabatan()"><i class="fas fa-check"></i><?= nbs(3) ?>S A V E</button>
                        </div>
                   </form>
                </div>
        </div>
    </div>
</div>
<!-- Modal -->