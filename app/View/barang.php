<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

<div id="body-silony-container"> <!-- Tag div penutupnya di file footer.php-->

  <div class="row no-gutters">
    <div id="body-silony">
      <div class="header-content row no-gutters">
        <div class="title-content col-6">
          Data Cucian
        </div>
        <?
         $data = $this->todayInsight;
        ?>
        <div class="target-perhari col-6">
          <div class="row no-gutters">
            <div class="progress progres-bar-target" style="height: 4px;">
              <div class="progress-bar" 
                  role="progressbar"style="width: <?  echo $data['reach'] ?>%;"
                  aria-valuenow="<? echo $data['reach'] ?>" 
                  aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>
            <div class="text-bar-target">
              <? echo $data['today']   ?>  dari target 
              <? echo $data['target']  ?> hari ini
            </div>
          </div>  
        </div>
      </div>
      <div class="body-content">
        <table class="table table-sm">
          <thead>
            <tr class="header-table">
              <th class="text-header-table col-2" scope="col">Kode Barang</th>
              <th class="text-header-table col-2" scope="col">Waktu</th>
              <th class="text-header-table col-1" scope="col">Berat</th>
              <th class="text-header-table col-2" scope="col">Jumlah</th>
              <th class="text-header-table col-2" scope="col">Harga</th>
              <th class="text-header-table col-3" scope="col">Opsi</th>            
            </tr>
          </thead>
          <tbody>
            <?
              foreach( $this->barang as $item ){
            ?>
            <tr class="row-table">
              <td class="text-row-table" scope="">
                <? echo $item->kode ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $item->masuk ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $item->berat ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $item->jumlah ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $item->harga ?>
              </td>
              <td class="text-row-table" scope="">
              <?
                if($item->diambil == 0){
              ?>
                <a class="btn btn-sm btn-primary" href="<?= ROOT_URL ?>?p=barang&amp;a=take&amp;kode=<?=$item->kode?>">Ambil</a>
              <?
              }
              else{
              ?>
                <div class="btn btn-sm btn-secondary">
                  Selesai
                </div>

              <?              
              }
              ?>
                <a class="btn btn-sm btn-primary" href="<?= ROOT_URL ?>?p=barang&amp;a=delete&amp;kode=<?=$item->kode?>">Hapus</a>
                <a class="btn btn-sm btn-warning" href="<?= ROOT_URL ?>?p=barang&amp;a=edit&amp;kode=<?=$item->kode?>">Edit</a>
              </td>     
            </tr>
            <?
              }
            ?>
          </tbody>
        </table>
        <div>
          <nav>
            <ul class="pagination pagination-sm">
              <li class="page-item">
                <a class="page-link" 
                    href="?p=barang&amp;page=<? echo $this->prevPage ?>">
                  <<
                </a>
              </li>

              <? for( $i=1; $i<=$this->pages; $i++){ ?>
              <li class="page-item <? /* echo $this->isActive($i); */ ?>">
                <a  class="page-link" href="?p=barang&amp;page=<? echo $i ?>">
                  <? echo $i ?>
                </a>
              </li>
              <? } ?>

             <li class="page-item">
                <a class="page-link" 
                    href="?p=barang&amp;page=<? echo $this->nextPage; ?>">
                    >>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <button type="button" class="btn button-float my-button-float" 
            data-toggle="modal" data-target="#tambahCucian">
        +
      </button>
    </div>
  </div>

  <div class="modal fade" id="tambahCucian" tabindex="-1" role="dialog"
        aria-labelledby"tambahPelangganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tambahPelangganLabel">
              Tambah Cucian Masuk
            </h5>
            <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
              <span aria-hidden="true">&times;</span>            
            </button>
        </div>
        <div class="modal-body">
        <form action="">
            <div class="form-group">
              <label for="kode" class="col-form-label">Kode</label>
              <input type="text" class="form-control" name="kode" id="kode">
            </div>
            <div class="form-group">
              <label for="jumlah" class="col-form-label">Jumlah</label>
              <input type="text" class="form-control" name="jumlah" id="jumlah">
            </div>
            <div class="form-group">
              <label for="berat" class="col-form-label">Berat</label>
              <input type="text" class="form-control" name="berat" id="berat">
            </div>
            <div class="form-group">
              <label for="harga" class="col-form-label">Harga</label>
              <input type="text" class="form-control" name="harga" id="harga">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">
            Close
          </button>
          <input type="submit" name="submit" class="btn btn-primary" value="Save">
          </form>
        </div>
      </div>
    </div>
  </div>

<? require_once "templates/footer.php"; ?>