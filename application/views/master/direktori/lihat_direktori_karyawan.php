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
                <h3 class="page-title">Indikator kerja <?php $job = strtolower($jobtitle); echo ucwords($job) ?></h3><br>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-5">

                  <form action="#" id="form">
                    <input type="hidden" name="jobtitle" value="<?= $jobtitle ?>">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="indikator" id="indikator">
                          <option value="" style="text-align: center;">--- Pilih Indikator ---</option>   
                           <?php foreach ($indikator as $i) : ?>
                              <option  value="<?php echo $i->id_indikator ?>"><?php echo $i->nama_indikator ?></option>
                            <?php endforeach ?>
                    </select> </div>
                  <div class="col-md-3"><button type="button" class="btn btn-info" onclick="tambah_direktori()"><i class="fas fa-plus"></i><?= nbs(2) ?>T A M B A H - D A T A</button></form></div>

                    <div class="col-md-2"></div>
                  
                    <div class="col-md-12"> <br>
                      
                     <div class="table-responsive">
                      
                      
                      <br>
                      <?= $this->session->flashdata('msg'); ?>

                           <table id="tb_direktori_jobtitle" class="table table-hover table-bordered">
                            <thead class="thead-light">
                              <tr>
                                <th style="font-weight: bold; vertical-align: middle;">NO</th>
                                <th style="font-weight: bold; vertical-align: middle;">PROKER</th>
                                <th style="font-weight: bold; vertical-align: middle;">INDIKATOR</th>
                                <th style="font-weight: bold; vertical-align: middle;">SATUAN INDIKATOR</th>
                                <th style="font-weight: bold; vertical-align: middle;">CARA PENGUKURAN</th>
                                <th style="font-weight: bold; vertical-align: middle;">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                          <?php $no = 1; foreach ($direktori as $d ): ?>
                            <tr>
                              <td style="text-align: center;"><?php echo $no++;?></td>
                              <td><?= $d->nama_proker ?></td>
                              <td><?= $d->nama_indikator ?></td>
                              <td style="text-align: center;"><?= $d->satuan_indikator ?></td>
                              <td><?= $d->cara_pengukuran ?></td>
                              <td style="text-align: center;">
                                <a href="#" class="far fa-edit" data-toggle="tooltip" data-original-title="UPDATE" onclick="edit_direktori('<?php echo $d->id_direktori  ?>')"></a><?= nbs(2) ?>
                                  <a href="#" class="far fa-trash-alt" data-toggle="tooltip" data-original-title="DELETE" onclick="delete_direktori('<?php echo $d->id_direktori ?>')"></a></td>
                            </tr>
                          <?php endforeach ?>
                          </tbody>
                          </table>
                   </div>

                  </div>
    </div>

              <?= br(2) ?><?= nbs() ?>
              <a href="<?php echo base_url() ?>Master/direktori"><button type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="top" data-original-title="Kembali ke halaman sebelumnya"><i class="fas fa-arrow-left"></i><?php echo nbs(3) ?>B A C K</button></a>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="" id="form1">
                            <div class="form-group row">
                              <input type="hidden" name="direktori" value="<?php echo $d->id_direktori ?>">
                                <label class="col-sm-3 text-right control-label col-form-label">Nama Indikator</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="indikator">
                                      <option  value="a">-Pilih Indikator-</option>
                                      <?php foreach ($indikator as $i) : ?>
                                        <option  value="<?php echo $i->id_indikator ?>"><?php echo $i->nama_indikator ?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C L O S E</button><?php echo nbs(4) ?>
                            <button type="button" class="btn btn-success" onclick="action_direktori()"><i class="fas fa-check"></i><?= nbs(3) ?>S A V E</button>
                        </div>
                   
                   </form>
                </div>
        </div>
    </div>
</div>
<!-- Modal -->



