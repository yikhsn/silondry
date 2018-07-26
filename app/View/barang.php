<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

<div id="body-silony-container">

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
              <th class="text-header-table col-2" scope="col">Opsi</th>
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
                <a class="btn btn-sm btn-primary" 
                  href="<?= ROOT_URL ?>?p=barang&amp;a=take&amp;kode=<?=$item->kode?>">
                  Ambil
                </a>
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
                <a class="btn btn-sm btn-primary" 
                  href="<?= ROOT_URL ?>?p=barang&amp;a=delete&amp;kode=<?=$item->kode?>">
                  Hapus
                </a>
                <a class="btn btn-sm btn-warning" 
                  href="<?= ROOT_URL ?>?p=barang&amp;a=edit&amp;kode=<?=$item->kode?>">
                  Edit
                </a>
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

      <a href="?p=barang&amp;a=add" class="btn button-float my-button-float">
        <span> + </span>
      </a>
    </div>
  </div>
<? require_once "templates/footer.php"; ?>