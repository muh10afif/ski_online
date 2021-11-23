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
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Data Penetapan Baru</h3>
            </div> 
        </div>
        <br>
        <div class="row">
        <form method="post" action="#" enctype="multipart/form-data">
            
            <table>
                <tr>
                    <td><select class="form-control input-sm mb-md" name="divisi" id="divisi">
                          <option value="%" style="text-align: center;">--- Pilih divisi yang akan dicari ---</option>   
                            <?php foreach ($divisi as $key ):?>                                                    
                                <option value="<?php echo $key->DIVISI;?>"><?php echo $key->DIVISI;?></option> 
                            <?php endforeach ?>
                        </select></td>
                        <td width="5%"></td>
                    <td><button class="btn btn-primary" type="submit" name="tampilkan" id="tampilkan" value="tampilkan" ><i class="fas fa-filter" ></i> <?php echo nbs(2) ?>T A M P I L K A N</button></td>
                </tr>
            </table>         
        </form> 
        </div>           
        <br>  
        <div class="row">
            
            <form action="proses_buat_ski" method="POST" id="form" class="form-horizontal" enctype="multipart/form-data">
            <table align="right" style="margin-top: -55px; margin-right: 10px;">
                <tr>
                    <td><button type="button" class="btn btn-success" onclick="cek()" style=" margin-right: ;"><i class="far fa-edit"></i><?= nbs(2) ?>UBAH - SEMUA</button> <?= nbs(4) ?>
                   <button type="submit" class="btn btn-info" style=" margin-right: ;"><i class="far fa-edit"></i><?= nbs(2) ?>U B A H</button></td>
                </tr>
            </table>     
                <?= br() ?>
                <?php echo $this->session->flashdata('msg');?>
                <table id="penetapan_baru" class="table table-hover table-bordered" align="center" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="font-weight: bold;">NO</th>
                            <th style="font-weight: bold;">NIPEG</th>
                            <th style="font-weight: bold; width: 20%;">NAMA</th>
                            <th style="font-weight: bold;">DIVISI</th>                      
                            <th style="font-weight: bold; width: ;">JABATAN</th>
                            <th style="font-weight: bold; width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>            
                </table>
            </form>
        </div>
       
    </div>  
</div>

<script type="text/javascript">
    function cek() {
        var msg = confirm("Apakah anda yakin ingin mengubah semua status SKI menjadi baru ?");
        if (msg == true) {
            window.location = "<?php echo base_url('Master/proses_buat_ski_semua') ?>";
        } else {
            window.location = "#";
        }
    }
</script>




