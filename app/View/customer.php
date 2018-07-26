<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

<div id="body-silony-container">

  <div class="row no-gutters">
    <div id="body-silony">
      <div class="header-content row no-gutters">
        <div class="title-content col-6">
          Data Pelanggan
        </div>
        <div class="target-perhari col-6">
        </div>
      </div>

      <div class="body-content">
        <table class="table table-sm">
          <thead>
            <tr class="header-table">
              <th class="text-header-table" scope="col">No</th>
              <th class="text-header-table" scope="col">ID Pelanggan</th>
              <th class="text-header-table" scope="col">Nama</th>
              <th class="text-header-table" scope="col">Alamat</th>
              <th class="text-header-table" scope="col">No. Telepon</th>
              <th class="text-header-table" scope="col">No. Identitas</th>
              <th class="text-header-table" scope="col">Opsi</th>            
            </tr>
          </thead>
          <tbody>
            <?
              $i = 1;
              foreach($this->customer as $person){
            ?>
            <tr class="row-table">
              <td class="text-row-table" scope="">
                <? echo $i++  ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $person->id_pelanggan ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $person->nama ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $person->alamat ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $person->nomor_telpon ?>
              </td>
              <td class="text-row-table" scope="">
                <? echo $person->nomor_identitas ?>
              </td>
              <td class="text-row-table" scope="">
                <a class="btn btn-sm btn-primary" 
                  href="<?= ROOT_URL ?>?p=customer&amp;a=delete&amp;id_pelanggan=<?=$person->id_pelanggan ?>">
                  Hapus
                </a>
                <a class="btn btn-sm btn-warning" 
                  href="<?= ROOT_URL ?>?p=customer&amp;a=edit&amp;id_pelanggan=<?=$person->id_pelanggan ?>">
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
                    href="?p=customer&amp;page=<? echo $this->prevPage ?>">
                  <<
                </a>
              </li>

              <? for( $i=1; $i<=$this->pages; $i++){ ?>
              <li class="page-item <? /* echo $this->isActive($i); */ ?>">
                <a  class="page-link" href="?p=customer&amp;page=<? echo $i ?>">
                  <?  echo $i ?>
                </a>
              </li>
              <? } ?>

             <li class="page-item">
                <a class="page-link" 
                    href="?p=customer&amp;page=<? echo $this->nextPage ?>">
                    >>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <a href="?p=customer&amp;a=add" class="btn button-float my-button-float">
        <span> + </span>
      </a>
    </div>
  </div>

<? require_once "templates/footer.php"; ?>