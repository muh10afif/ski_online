<style type="text/css">
    th,td {
        text-align: center;
        font-size: 15px;
    }
</style>
<div class="card">
    <div class="card-body"><?= br(2) ?>
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" align="center">
            <a class="btn btn-success btn-lg" href="#"  data-toggle="modal" data-target="#myModal2"><i class="fas fa-pencil-alt"></i><?= nbs(3) ?>Buat Status pembukaan SKI</a><?= nbs(5) ?>
            <a class="btn btn-danger btn-lg" href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-trash-alt"></i><?= nbs(3) ?>Reset Semua Data Status SKI</a>
        </div>
        <div class="col-md-1"></div>
    </div><?= br(2) ?>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?php echo $this->session->flashdata('msg'); ?>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <th style="font-weight: bold;">STATUS</th>
                        <th style="font-weight: bold;">TANGGAL MULAI</th>
                        <th style="font-weight: bold;">TANGGAL SELESAI</th>
                        <th style="font-weight: bold;">TAHUN PERIODE</th>
                    </thead>
                    
                    <?php foreach ($status1 as $st) : ?>
                    <tr>   
                        <td><?php echo $st->status_tw; ?></td>
                        <td><?php echo tgl_indo_timestamp($st->TMT) ?></td>
                        <td><?php echo tgl_indo_timestamp($st->TST) ?></td>
                        <td><?php echo $st->tahun; ?></td>
                    </tr>
                </table>
                <?= br(3) ?>
            </div>
            <div class="col-md-1"></div>
        </div>
                        
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Reset Data SKI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                 <form method="post" enctype="multipart/form-data" action="reset_ski" class="form-horizontal">
                    <div class="card">
                        <div class="input-group">
                            <label class="col-sm-2 cotrol-label col-form-label" style="margin-top: 8px; font-weight: bold;">N I P E G</label>
                                <label class="col-sm-10 control-label col-form-label">
                                    <div class="input-group">
                                        <input type="text" name="nipeg" class="form-control" placeholder="Masukkan NIPEG" onclick="konfirmasiDulu()">
                                    </div>
                                    <p style="color:red">*ket: reset data ski menyebabkan terhapusnya semua data status approvement<p>
                                </label>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C A N C E L</button><?php echo nbs(4) ?>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i><?= nbs(3) ?>R E S E T</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="waktu" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Status pembukaan SKI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                 <form method="post" enctype="multipart/form-data" action="pembukaan_ski" class="form-horizontal">
                    <div class="card">
                         <div class="input-group">
                                <label class="col-sm-4 control-label col-form-label">Status SKI</label>
                                <label class="col-sm-7 control-label col-form-label">
                                    <div class="input-group">
                                        <?php $a = $st->status_tw ?>
                                        <select name="status" class="form-control">
                                            <option value="SKI" <?php echo ($a == 'SKI') ? 'selected' : '' ?>>SKI</option>
                                            <option value="TW1" <?php echo ($a == 'TW1') ? 'selected' : '' ?>>TW1</option>
                                            <option value="TW2" <?php echo ($a == 'TW2') ? 'selected' : '' ?>>TW2</option>
                                            <option value="TW3" <?php echo ($a == 'TW3') ? 'selected' : '' ?>>TW3</option>
                                            <option value="TW4" <?php echo ($a == 'TW4') ? 'selected' : '' ?>>TW4</option>
                                        </select>
                                    </div>
                                </label>
                        </div>    
                         <div class="input-group">
                            <label class="col-sm-4 cotrol-label col-form-label">Tanggal Mulai</label>
                                <label class="col-sm-7 control-label col-form-label">
                                    <div class="input-group">
                                        <input type="text" name="tmt" class="form-control datetimepicker"  value="<?php echo nice_date($st->TMT, 'Y-m-d H:i:s') ?>" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                    </div>
                                </label>
                        </div>
                         <div class="input-group">
                                <label class="col-sm-4 control-label col-form-label">Tanggal Selesai</label>
                                <label class="col-sm-7 control-label col-form-label">
                                    <div class="input-group">
                                        <input type="text" name="tst" class="form-control datetimepicker2" value="<?php echo nice_date($st->TST, 'Y-m-d H:i:s') ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                    </div>
                                </label>
                        </div>
                        <div class="input-group">
                                <label class="col-sm-4 control-label col-form-label">Tahun SKI</label>
                                <label class="col-sm-7 control-label col-form-label">
                                    <div class="input-group">
                                         <input type="text" name="tahun" class="form-control"  id="datepicker-autoclose" value="<?php echo $st->tahun; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                    </div>
                                </label>
                        </div>    
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-dismiss="modal" class="btn btn-dark"><i class="fas fa-times"></i><?= nbs(3) ?>C A N C E L</button><?php echo nbs(4) ?>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i><?= nbs(3) ?>U P D A T E</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php endforeach; ?>
<script>
    function konfirmasiDulu(){
        var konfirmasi = confirm("Anda Yakin Ingin Mereset Data SKI?");
        var text = "";
        
        if(konfirmasi === true) {
        }else{
            window.location.href = "?action=canceled";
        }
        
        document.getElementById("hasil").innerHTML = text;
    }
     function maju(){
       $('#waktu').modal('show')
    }
</script>





                        