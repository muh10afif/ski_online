<style type="text/css">
	th {
		text-align: center;
		font-size: 13px;
        }
    tr {
        font-size: 13px;
    }
    tbody {
    	font-size: 13px;
    }
</style>
<div class="card">
	<div class="card-body">
		<h4 class="page-title">Buat penalty nilai <?php echo $tw ?> Divisi <?= $nama_divisi ?> </h4>
				<?php echo br() ?>
		<?php if (count($penalty_realisasi) != 0): ?>		
				<?php if ($realisasi['STATUS'] != 'KIRIM'): ?>
				
				<?php echo $this->session->flashdata('msg'); ?>
	            <table class="table table-bordered table-hover table-responsive">
                  <thead class="thead-light">
                  <tr>
                    <th colspan="10"><strong>TARGET PENALTY</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="3" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
                    <th style="vertical-align: middle;"><strong>Target</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Realisasi</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Nilai</strong></th> 
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Cara Pengukuran</strong></th>
                    <th style="vertical-align: middle;"><strong><?php echo $tw ?></strong></th>
                  </tr>
                  </thead>
                  <tbody>
                  	<?= form_open('Master/simpan_ubah_penalty_realisasi'); ?>

                  	<?php $no=0; foreach ($penalty_realisasi as $r) : $no++ ?>

	                  	<tr>
	                  		<td style="text-align: center;"><?= $no; ?></td>
	                  		<td>
	                  			<input type="hidden" name="nama_divisi[]" value="<?= $nama_divisi ?>">
	                  			<input type="hidden" name="id_penalty_r[]" value="<?php echo $r->ID_PENALTY_R ?>">
	                  			<?= $r->nama_indikator ?></td>
	                    	<td style="text-align: center;"><?= $r->satuan_indikator ?></td>
	                    	<td style="text-align: ;"><?= $r->cara_pengukuran ?></td>
	                    	<td style="text-align: center;"><?= -$r->TARGET_PERTAHUN ?></td>
	                    	<td style="text-align: center;">
	                    		<input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw ?>">
	                    		<?= -$r->NILAI_PENETAPAN ?></td>
	                    	<td style="text-align: center;">
	                    		<input type="hidden" class="bobot_1<?php echo $no;?>" id="bobot" onkeyup="hitung_nilai_1(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo $r->BOBOT?>">
	                    		<input type="hidden" size="7" name="total_bobot[]" style="text-align: center;" value="<?= $r->TOTAL_BOBOT ?>">
	                    		<?php echo $r->BOBOT?>%</td> 
	                     	<td style="text-align: center;">
	                     		<input type="number" value="<?php echo $r->REALISASI?>" name="realisasi[]" data-toggle="tooltip" data-placement="top" data-original-title="Rumus Nilai : BOBOT x REALISASI" class="realisasi_1<?php echo $no;?>" id="realisasi" onkeyup="hitung_nilai_1(<?php echo $no;?>);" style="text-align: center; width: 65px;"></td>
	                   	 	<td style="text-align: center;">
	                   	 		<input type="text" name="nilai_realisasi[]" value="<?php echo $r->NILAI_REALISASI?>" id="nilai_1" class="nilai_1<?php echo $no;?>" size="6" style="text-align: center;" readonly>
	                      		<input type="hidden" size="7" name="total_nilai[]" value="<?php echo $r->TOTAL_NILAI?>" id="total_nilai_1" style="text-align: center;"></td>
	               		</tr>


                  	<?php endforeach ?>

						<tr>
							<td colspan="8" style="vertical-align: middle; text-align: right; font-weight: bold; padding: 12px;">Total Nilai</td>
							<td style="text-align: center;"><input type="text" size="6" value="<?php echo $r->TOTAL_NILAI?>" name="total_1[]" id="total_1" style="text-align: center;" readonly></td>
						</tr>
						</tbody>
					</table><br>
						<table class="table">
						<tr>
							<td><a href="<?php echo base_url() ?>Master/penilaian_penalty/<?php echo $tw ?>"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
							<td colspan="4"></td>
							<td colspan="2" style="text-align: right;"><button type="submit" name="submit_simpan" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Data Akan Diubah"><i class="fas fa-edit"></i><?php echo nbs(3) ?>U P D A T E - D A T A</button><?php echo nbs(5); ?>
							<button type="submit" name="submit_data" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Jika data akan dikirim dan tidak akan diubah maka tekan submit"><i class="fas fa-check"></i><?php echo nbs(3) ?>S U B M I T</button></td>
						</tr>
						</table>
						<?= form_close(); ?>

                <?php else : ?>
                	<table class="table table-bordered table-hover table-responsive">
                  <thead class="thead-light">
                  <tr>
                    <th colspan="9"><strong>TARGET PENALTY</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="3" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
                    <th style="vertical-align: middle;"><strong>Target</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Realisasi</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Nilai</strong></th> 
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Cara Pengukuran</strong></th>
                    <th style="vertical-align: middle;"><strong><?php echo $tw ?></strong></th>
                  </tr>
                  </thead>
                  <tbody>
                  	<?= form_open('Master/simpan_penalty_realisasi'); ?>

                  	<?php $no=0; foreach ($penalty_realisasi as $r) : $no++ ?>

	                  	<tr>
	                  		<td style="text-align: center;"><?= $no; ?></td>
	                  		<td><input type="hidden" name="nama_divisi[]" value="<?= $nama_divisi ?>"><input type="hidden" value="<?= $r->ID_INDIKATOR ?>" name="id_indikator[]"><?= $r->nama_indikator ?></td>
	                    	<td style="text-align: center;"><?= $r->satuan_indikator ?></td>
	                    	<td style="text-align: ;"><?= $r->cara_pengukuran ?></td>
	                    	<td style="text-align: center;"><?php echo -$r->TARGET_PERTAHUN ?></td>
	                    	<td style="text-align: center;"><?= -$r->NILAI_PENETAPAN ?></td>
	                    	<td style="text-align: center;"><?php echo $r->BOBOT?>&nbsp;%</td> 
	                     	<td style="text-align: center;"><?php echo $r->REALISASI?></td>
	                   	 	<td style="text-align: center;"><?php echo $r->NILAI_REALISASI?>%</td>
	               		</tr>

                  	<?php endforeach ?>

						<tr>
							<td colspan="8" style="vertical-align: middle; text-align: right; font-weight: bold; font-size: 17px;">Total Nilai</td>
							<td style="text-align: center;font-weight: bold; font-size: 17px;"><?php echo $r->TOTAL_NILAI?>%</td>
						</tr>
						

						<?= form_close(); ?>
                  	</tbody>
                	</table><br>
            		<table class="table">
					<tr>
						<td colspan=""><a href="<?php echo base_url() ?>Master/penilaian_penalty/<?php echo $tw ?>"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
					</tr>
					</table>
            	<?php endif ?>

            <?php else : ?>
            	<?php if (count($penalty_penetapan) != 0): ?>
            	<table class="table table-responsive table-bordered table-hover">
                  <thead class="thead-light">
                  <tr>
                    <th colspan="9"><strong>TARGET PENALTY</strong></th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                    <th colspan="3" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
                    <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
                    <th style="vertical-align: middle;"><strong>Target</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Realisasi</strong></th>
                    <th rowspan="2" style="vertical-align: middle;"><strong>Nilai</strong></th> 
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                    <th style="vertical-align: middle;"><strong>Cara Pengukuran</strong></th>
                    <th style="vertical-align: middle;"><strong><?php echo $tw ?></strong></th>
                  </tr>
                  </thead>
                  <tbody>
                  	<?= form_open('Master/simpan_penalty_realisasi'); ?>

                  	<?php $no=0; foreach ($penalty_penetapan as $p) : $no++ ?>

	                  	<tr>
	                  		<td style="text-align: center;"><?= $no; ?></td>
	                  		<td style="text-align: justify-all;">
	                  			<input type="hidden" name="nama_divisi[]" value="<?= $nama_divisi ?>">
	                  			<input type="hidden" value="<?= $p->ID_INDIKATOR ?>" name="id_indikator[]">
	                  			<?= $p->nama_indikator ?></td>
	                    	<td style="text-align: center;"><?= $p->satuan_indikator ?></td>
	                    	<td style="text-align: ;"><?= $p->cara_pengukuran ?></td>
	                    	<td style="text-align: center;">
	                    		<input type="hidden" name="target_pertahun[]" value="<?php echo $p->TARGET_PERTAHUN ?>">
	                    		<?= -$p->TARGET_PERTAHUN ?></td>
	                    	<td style="text-align: center;">
	                      		<input type="hidden" name="nilai_penetapan[]" size="7" class="target<?php echo $no;?>" id="target" style="text-align: center;" value="<?= $p->TW1 ?>" readonly>
	                      		<input type="hidden" name="jenis_realisasi[]" value="<?php echo $tw ?>">
	                      		<?= -$p->TW1 ?></td>
	                    	<td style="text-align: center;">
	                    		<input type="hidden" class="bobot_1<?php echo $no;?>" id="bobot" onkeyup="hitung_nilai_1(<?php echo $no;?>);" name="bobot[]" size="7" style="text-align: center;" value="<?php echo -$p->BOBOT?>">
	                    		<input type="hidden" size="7" name="total_bobot[]" style="text-align: center;" value="<?= $p->TOTAL_BOBOT ?>">
	                    		<?php echo -$p->BOBOT?>&nbsp;%</td> 
	                     	<td style="text-align: center;">
	                     		<input type="number" name="realisasi[]" class="realisasi_1<?php echo $no;?>" id="realisasi" onkeyup="hitung_nilai_1(<?php echo $no;?>);" style="text-align: center; width: 65px;"></td>
	                   	 	<td style="text-align: center;">
	                   	 		<input type="text" name="nilai_realisasi[]" id="nilai_1" class="nilai_1<?php echo $no;?>" size="6" style="text-align: center;" readonly>
	                      		<input type="hidden" name="TMT[]" value="<?php echo $waktu['TMT'] ?>">
	                      		<input type="hidden" name="TST[]" value="<?php echo $waktu['TST'] ?>">
	                      		<input type="hidden" size="7" name="total_nilai[]" id="total_nilai_1" style="text-align: center;"></td>
	               		</tr>

                  	<?php endforeach ?>

						<tr>
							<td colspan="8" style="font-weight: bold; text-align: right;">Total Penalty</td>
							<td style="text-align: center;">
								<input type="text" size="6" name="total_1[]" id="total_1" style="text-align: center;"></td>
						</tr>
					</tbody>
						<table class="table">
						<tr>
							<td colspan=""><a href="<?php echo base_url() ?>Master/penilaian_penalty/<?php echo $tw ?>"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
							<td colspan="4"></td>
							<td colspan="2" style="text-align: right;">
								<button type="submit" name="submit_simpan" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Data Akan Disimpan dahulu. Bila akan submit data lain waktu"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button><?php echo nbs(5); ?><button type="submit" name="submit_data" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Jika data akan dikirim dan tidak akan diubah maka tekan submit"><i class="fas fa-check"></i><?php echo nbs(3) ?>S U B M I T</button></td>
						</tr>
						<tr>
							<td colspan="8"></td>
						</tr>
						</table>
						<?= form_close(); ?>
                  </tbody>
                </table>
                <?php else : ?>
					<div class="table-responsive">
	                <table class="table table-bordered table-hover" align="center">
	                  <thead class="thead-light">
	                  <tr>
	                    <th colspan="8"><strong>TARGET PENALTY</strong></th>
	                  </tr>
	                  <tr>
	                    <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
	                    <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
	                    <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
	                    <th style="vertical-align: middle;"><strong>Target</strong></th>
	                    <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
	                    <th rowspan="2" style="vertical-align: middle;"><strong>Realisasi</strong></th>
	                    <th rowspan="2" style="vertical-align: middle;"><strong>Nilai</strong></th> 
	                  </tr>
	                  <tr>
	                    <th style="vertical-align: middle;"><strong>Indikator</strong></th>
	                    <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
	                    <th style="vertical-align: middle;"><strong><?php echo $tw ?></strong></th>
	                  </tr>
	                  </thead>
	                  <tbody>
							<tr>
								<td colspan="10" style="text-align: center;"><h2><span class="badge badge-pill badge-danger">Belum melakukan SUBMIT Penalty Penetapan SKI, klik <a href="<?= base_url() ?>Master/penetapan_penalty" style="color: initial;">disini</a> untuk membuat</span></h2></td>
							</tr>
	                  </tbody>
	                </table><br>
	                <table class="table">
						<tr>
							<td colspan=""><a href="<?php echo base_url() ?>Master/penilaian_penalty/<?php echo $tw ?>"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
						</tr>
						</table>
	                </div>
            	<?php endif ?>
				
            <?php endif ?>
	         
	</div>
</div>