<style type="text/css">
	th {
		  text-align: center;;
      }
</style>

<div class="card">
	<div class="card-body">
		<h4 class="page-title">Penetapan Penalty Divisi <?php echo $nama_divisi; ?> Tahun <?= $thn ?></h4>
		<br>
    <!-- JIKA DATA ADA PADA TABEL PENETAPAN-->
    <?php if (count($penalty_pen) != 0) : ?>
        <!-- JIKA DATA STATUS BERNILAI SIMPAN -->
        <?php if ($status_data->STATUS != 'KIRIM'): ?>
            
            <?php echo $this->session->flashdata('msg'); ?>
            <table class="table table-responsive table-hover table-bordered">
              <thead class="thead-light">
              <tr>
                <th colspan="10"><strong>TARGET PENALTY</strong></th>
              </tr>
              <tr>
                <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
                <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
                <th rowspan="2" style="vertical-align: middle; width: 50%;"><strong>Pengukuran Sasaran Kerja</strong></th>
                <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
                <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
                <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
              </tr>
              <tr>
                <th style="vertical-align: middle;"><strong>Indikator</strong></th>
                <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
                <th style="vertical-align: middle;"><strong>TW I</strong></th>
                <th style="vertical-align: middle;"><strong>TW II</strong></th>
                <th style="vertical-align: middle;"><strong>TW III</strong></th>
                <th style="vertical-align: middle;"><strong>TW IV</strong></th>
              </tr>
              </thead>
              <?= form_open('Master/simpan_ubah_penalty_penetapan'); ?>
              
              <?php $no=0; foreach ($penalty_pen as $p) : $no++?>
      
              <tr>
                <td  style="text-align: center;"><?= $no ?></td>
                <td style="text-align: justify-all;">
                  <input type="hidden" name="nama_divisi[]" value="<?= $nama_divisi ?>">
                  <input type="hidden" name="id_indikator[]" value="<?= $p->id_indikator ?>">
                  <input type="hidden" name="id_penalty_p[]" value="<?= $p->ID_PENALTY_P ?>">
                  <?= $p->nama_indikator ?></td>
                <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
                <td style="text-align: justify-all;"><?= $p->cara_pengukuran ?></td>
                <td><input type="number" style="text-align: center; width: 65px;" value="<?php echo $p->TARGET_PERTAHUN; ?>" name="target_pertahun[]" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)"></td>
                <td><input type="number" style="text-align: center; width: 65px;" id="bobot" name="bobot[]" value="<?php echo $p->BOBOT ?>" >
                  <input type="hidden" id="total_bobot" class="total_bobot" name="total_bobot[]" value="<?php echo $p->TOTAL_BOBOT ?>" size="4" style="text-align: center;"></td>
                <td><input type="number" style="text-align: center; width: 65px;" name="tw1[]" value="<?php echo $p->TW1 ?>"></td>
                <td><input type="number" style="text-align: center; width: 65px;" name="tw2[]" value="<?php echo $p->TW2 ?>"></td>
                <td><input type="number" style="text-align: center; width: 65px;" name="tw3[]" value="<?php echo $p->TW3 ?>"></td>
                <td><input type="number" style="text-align: center; width: 65px;" name="tw4[]" value="<?php echo $p->TW4 ?>" id="tw4<?php echo $no; ?>"></td>
              </tr> 

              <?php endforeach ?>
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
                <td><input type="text" id="total" class="total" name="total[]" value="<?php echo $p->TOTAL_BOBOT ?>" size="6" style="text-align: center; font-weight: bold; font-size: 17px;" readonly></td>
                <td colspan="4"></td>
              </tr>
            </table><br>
            <table class="table">
              <tr>
                <td colspan="7"><a href="<?php echo base_url() ?>Master/penetapan_penalty"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
                <td colspan="3" style="text-align: right;">
                  <button type="submit" name="submit_simpan" class="btn btn-primary btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Data Akan Disimpan dahulu. Bila akan submit data lain waktu"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button><?php echo nbs(8) ?>
                  <button type="submit" name="submit_data" class="btn btn-success btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Jika data akan dikirim dan tidak akan diubah maka tekan submit"><i class="fas fa-check"></i><?php echo nbs(3) ?>S U B M I T</button></td>
              </tr>
              <tr>
                <td colspan="10"></td>
              </tr>
               <?= form_close(); ?>
            </table>
        <!-- JIKA DATA STATUS BERNILAI KIRIM -->
        <?php else: ?>

          <table class="table table-responsive table-bordered table-hover table-condenses">
            <thead class="thead-light">
            <tr>
              <th colspan="10"><strong>TARGET PENALTY</strong></th>
            </tr>
            <tr>
              <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
              <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
              <th rowspan="2" style="vertical-align: middle;"><strong>Pengukuran Sasaran Kerja</strong></th>
              <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
              <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
              <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
            </tr>
            <tr>
              <th style="vertical-align: middle;"><strong>Indikator</strong></th>
              <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
              <th style="vertical-align: middle;"><strong>TW I</strong></th>
              <th style="vertical-align: middle;"><strong>TW II</strong></th>
              <th style="vertical-align: middle;"><strong>TW III</strong></th>
              <th style="vertical-align: middle;"><strong>TW IV</strong></th>
            </tr>
            </thead>
            <?= form_open('Master/simpan_penalty_penetapan'); ?>
            <?php $no=0; foreach ($penalty_pen as $p) : $no++?>
    
            <tr>
              <td style="text-align: center;"><?= $no ?></td>
              <td style="text-align: justify;"><?= $p->nama_indikator ?></td>
              <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
              <td style="text-align: justify;"><?= $p->cara_pengukuran ?></td>
              <td style="text-align: center;">-<?php echo $p->TARGET_PERTAHUN; ?></td>
              <td style="text-align: center;">-<?php echo $p->BOBOT ?></td>
              <td style="text-align: center;">-<?php echo $p->TW1 ?></td>
              <td style="text-align: center;">-<?php echo $p->TW2 ?></td>
              <td style="text-align: center;">-<?php echo $p->TW3 ?></td>
              <td style="text-align: center;">-<?php echo $p->TW4 ?></td>
              
            </tr> 
            <?php endforeach ?>
            <tr>
              <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
              <td style="text-align: center; font-weight: bold; font-size: 17px;">-<?php echo $p->TOTAL_BOBOT ?></td>
              <td colspan="4"></td>
            </tr>
            
            <?= form_close(); ?>
          
          </table><br>
          <table class="table">
          <tr>
              <td colspan="10">
                <a href="<?php echo base_url() ?>Master/penetapan_penalty"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
          </tr>
          </table>

        <?php endif ?>
    <!-- JIKA DATA TIDAK ADA PADA TABEL PENETAPAN -->
    <?php else : ?>

      <table class="table table-responsive table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th colspan="10"><strong>TARGET PENALTY</strong></th>
        </tr>
        <tr>
          <th rowspan="2" style="vertical-align: middle;"><strong>NO</strong></th>
          <th colspan="2" style="vertical-align: middle;"><strong>Sasaran Kerja</strong></th>  
          <th rowspan="2" style="vertical-align: middle; width: 50%;"><strong>Pengukuran Sasaran Kerja</strong></th>
          <th rowspan="2" style="vertical-align: middle;"><strong>Target<br>Pertahun</strong></th>
          <th rowspan="2" style="vertical-align: middle;"><strong>Bobot (%)</strong></th>
          <th colspan="4" style="vertical-align: middle;"><strong>Target Sampai Dengan</strong></th>
        </tr>
        <tr>
          <th style="vertical-align: middle; "><strong>Indikator</strong></th>
          <th style="vertical-align: middle;"><strong>Satuan Indikator</strong></th>
          <th style="vertical-align: middle;"><strong>TW I</strong></th>
          <th style="vertical-align: middle;"><strong>TW II</strong></th>
          <th style="vertical-align: middle;"><strong>TW III</strong></th>
          <th style="vertical-align: middle;"><strong>TW IV</strong></th>
        </tr>
      </thead>
      
      <?php if (!empty($nama_penalty)): ?>
        <?= form_open('Master/simpan_penalty_penetapan'); ?>
        <?php $no=0; foreach ($nama_penalty as $p) : $no++?>

        <tr>
          <td style="text-align: center;"><?= $no ?></td>
          <td><input type="hidden" name="nama_divisi[]" value="<?= $nama_divisi ?>"><input type="hidden" name="id_indikator[]" value="<?= $p->id_indikator ?>"><?= $p->nama_indikator ?></td>
          <td style="text-align: center;"><?= $p->satuan_indikator ?></td>
          <td><?= $p->cara_pengukuran ?></td>
          <td><input type="number" style="text-align: center; width: 65px;" name="target_pertahun[]" id="target_pertahun<?php echo $no; ?>" onkeyup="simpan_nilai(<?= $no ?>)"></td>
          <td><input type="number" id="bobot" name="bobot[]" style="text-align: center; width: 65px;">
            <input type="hidden" id="total_bobot" class="total_bobot" name="total_bobot[]" size="4" style="text-align: center;"></td>
          <td><input type="number" style="text-align: center; width: 65px;" name="tw1[]"></td>
          <td><input type="number" style="text-align: center; width: 65px;" name="tw2[]"></td>
          <td><input type="number" style="text-align: center; width: 65px;" name="tw3[]"></td>
          <td><input type="number" style="text-align: center; width: 65px;" name="tw4[]" id="tw4<?php echo $no; ?>"></td>
          
        </tr> 
        
        <?php endforeach ?>
        <tr>
          <td colspan="5" style="text-align: right; font-weight: bold; font-size: 17px;">Total Bobot</td>
          <td><input type="text" id="total" class="total" name="total[]" size="6" style="text-align: center;" readonly></td>
          <td colspan="4"></td>
        </tr>
      
      </table><br> 
      <table class="table">
        <tr>
          <td colspan="7"><a href="<?php echo base_url() ?>Master/penetapan_penalty"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
          <td colspan="3" style="text-align: right;">
            <button type="submit" name="submit_simpan" class="btn btn-primary btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Data Akan Disimpan dahulu. Bila akan submit data lain waktu"><i class="fas fa-save"></i><?php echo nbs(3) ?>S A V E</button><?php echo nbs(8) ?>
            <button type="submit" name="submit_data" class="btn btn-success btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Jika data akan dikirim dan tidak akan diubah maka tekan submit"><i class="fas fa-check"></i><?php echo nbs(3) ?>S U B M I T</button></td>
        </tr>
      </table>
        <?= form_close(); ?>
      <?php else: ?>
        <tbody>
        <tr>
          <td colspan="10" style="text-align: center;"><h2><span class="badge badge-pill badge-danger">Indikator Target Penalty Belum Ada, klik <a href="<?= base_url() ?>Master/penalty" style="color: initial;">disini</a> untuk membuat</span></h2></td>
        </tr>
      </tbody>
      </table><br>
      <table class="table">
          <tr>
            <td colspan="7"><a href="<?php echo base_url() ?>Master/penetapan_penalty"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a></td>
          </tr>
      </table>
      <?php endif ?>

    <?php endif ?>
		
	</div>
</div>