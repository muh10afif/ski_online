<link href="<?php echo base_url()?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<!-- Modal -->
<?php 
	if ($sekmen=='edit'){
?>
<?php  foreach ($content->result() as $isi){ ?>
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan <?php echo $isi->nama_karyawan ?></h5>
                 <a href="../../../master/karyawan">
					<button type="button" class="close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</a>
            </div>
				<form action="<?php echo base_url();?>master/proses_edit_karyawan/<?php echo $isi->nip_karyawan ?>/<?php echo $isi->nip_karyawan ?>.jpg" id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
				<input type="hidden" value="<?php echo $isi->nip_karyawan ?>" name="nip_karyawan"/>
            <div class="modal-body">
				
                <div class="form-group">
					<label class="control-label col-xs-3" >Foto</label>
					<br> <img src="../../../<?php base_url()?>assets/images/users/<?php echo $isi->foto ?>" width="120px;" class="img-circle">
					<div class="col-xs-8">
						<input name="foto" class="form-control" type="file" value="<?php echo $isi->nip_karyawan ?>" >
					</div>
                </div> 
				<div class="form-group">
					<label class="control-label col-xs-3" >NIP</label>
					<div class="col-xs-8">
						<input name="nip_karyawan" class="form-control" type="text" value="<?php echo $isi->nip_karyawan ?>" disabled>
					</div>
                </div>
				<div class="form-group">
					<label class="control-label col-xs-3" >Nama Karyawan</label>
					<div class="col-xs-8">
						<input name="nama_karyawan" class="form-control" type="text" value="<?php echo $isi->nama_karyawan ?>" required>
					</div>
                </div>
				<div class="form-group">
				 <label for="name">Pangkat</label>
					 <select class="form-control" name="nama_pangkat">
						 <option>-Pilih Pangkat-</option>
						 <option selected value="<?php echo $isi->id_pangkat;?>"><?php echo $isi->nama_pangkat;?></option>
						 <?php  foreach ($pangkat->result() as $pangkat){ ?>
						 <option value="<?php echo $pangkat->id_pangkat;?>"><?php echo $pangkat->nama_pangkat;?></option>
						 <?php } ?>
					 </select>
				 </div>
				<div class="form-group">
				 <label for="name">Jabatan</label>
					 <select class="form-control" name="nama_jabatan">
						 <option>-Pilih Jabatan-</option>
						 <option selected value="<?php echo $isi->id_jabatan;?>"><?php echo $isi->nama_jabatan;?></option>
						 <?php  foreach ($jabatan->result() as $jabatan){ ?>
						 <option value="<?php echo $jabatan->id_jabatan;?>"><?php echo $jabatan->nama_jabatan;?></option>
						 <?php } ?>
					 </select>
				 </div>
				<div class="form-group">
				 <label for="name">Urusan</label>
					 <select class="form-control" name="nama_urusan">
						 <option>-Pilih Urusan-</option>
						 <option selected value="<?php echo $isi->id_urusan;?>"><?php echo $isi->nama_urusan;?></option>
						<?php  foreach ($urusan->result() as $ur){ ?>
						 <option value="<?php echo $ur->id_urusan;?>"><?php echo $ur->nama_urusan;?></option>
						 <?php } ?>
					 </select>
				 </div>
				<div class="form-group">
				 <label for="name">Bagian</label>
					 <select class="form-control" name="nama_bagian">
						 <option>-Pilih Bagian-</option>
						 <option selected value="<?php echo $isi->id_bagian;?>"><?php echo $isi->nama_bagian;?></option>
						<?php  foreach ($bagian->result() as $bag){ ?>
						 <option value="<?php echo $bag->id_bagian;?>"><?php echo $bag->nama_bagian;?></option>
						 <?php } ?>
					 </select>
				 </div>
				<div class="form-group">
				 <label for="name">Hak Akses</label>
					 <select class="form-control" name="hak_akses">
						 <option selected value="<?php echo $isi->hak_akses ?>"><?php echo $isi->hak_akses ?></option>
						 <option value="Karyawan">Karyawan</option>
						 <option value="Admin">Admin</option>
						 <option value="Atasan1">Atasan1</option>
						 <option value="Atasan2">Atasan2</option>
					 </select>
				 </div>
            </div>
            <div class="modal-footer">
                <a href="../../../master/karyawan">
					<button type="button" class="btn btn-secondary">Close</button>
				</a>
                <button type="submit" class="btn btn-primary">Edit</button>
					</div>
			</form>
         </div>
    </div>
</div>
<?php } }
	  else if($sekmen=='view'){
foreach ($content->result() as $isi){
?>
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Data Karyawan</h5>
                <a href="../../../master/karyawan">
					<button type="button" class="close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</a>
            </div>
            <div class="modal-body">
                <div clas="foto" style="margin-left:28%;">
				<img src="<?php echo base_url() ?>/assets/images/users/<?php echo $isi->foto; ?>" class="img-circle" width="200px;">
				</div>
				<div class="container" style="text-align:center;">
				<h3><?php echo $isi->nama_karyawan; ?></h3>
				<h4><?php echo $isi->nip_karyawan; ?></h4>
				<h6><?php echo $isi->nama_jabatan; ?></h6><br>
					<div class="container" style="text-align:left">
						<table>
							<tr>
								<td><span>Pangkat </span></td><td>:<?php echo $isi->nama_pangkat; ?></td>
							</tr>
							<tr>
								<td><span>Urusan </span></td><td>:<?php echo $isi->nama_urusan; ?></td>
							</tr>
							<tr>
								<td><span>Bagian </span></td><td>:<?php echo $isi->nama_bagian; ?></td>
							</tr>
							<tr>
								<td><span>Hak Akses </span></td><td>:<?php echo $isi->hak_akses; ?></td>
							</tr>
						</table>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <a href="../../../master/karyawan">
					<button type="button" class="btn btn-secondary">Close</button>
				</a>
				
                <a href="../../../master/edit_karyawan/<?php echo $isi->nip_karyawan;?>/edit">
                <button type="button" class="btn btn-primary">Edit</button>
				</a>
			</div>
         </div>
    </div>
</div>
<?php } }?>
<!-- Modal -->


 <script src="<?php echo base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
 <script src="<?php echo base_url()?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/extra-libs/DataTables/datatables.min.js"></script>

<script type="text/javascript">
		$(window).on('load',function(){
		  $('#Modal2').modal('show');
		});
</script>
