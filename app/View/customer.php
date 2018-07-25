<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

<div id="body-silony-container"><!-- Tag div penutupnya di file footer.php-->

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
                <a class="btn btn-sm btn-primary" href="<?= ROOT_URL ?>?p=customer&amp;a=delete&amp;id_pelanggan=<?=$person->id_pelanggan ?>">Hapus</a>
                <a class="btn btn-sm btn-warning" href="<?= ROOT_URL ?>?p=customer&amp;a=edit&amp;id_pelanggan=<?=$person->id_pelanggan ?>">Edit</a>
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

      <button type="button" class="btn button-float my-button-float" 
            data-toggle="modal" data-target="#tambahPelanggan">
        +
      </button>
    </div>
  </div>

  <div class="modal fade" id="tambahPelanggan" tabindex="-1" role="dialog"
        aria-labelledby"tambahPelangganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tambahPelangganLabel">Modal Title</h5>
            <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
              <span aria-hidden="true">&times;</span>            
            </button>
        </div>
        <div class="modal-body">
        <form action="">
            <div class="form-group">
              <label for="id" class="col-form-label">ID Pelangan</label>
              <input type="text" class="form-control" name="id" id="id">
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Nama</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="address" class="col-form-label">Alamat</label>
              <input type="text" class="form-control" name="address" id="address">
            </div>
            <div class="form-group">
              <label for="telepon" class="col-form-label">Telepon</label>
              <input type="text" class="form-control" name="telepon" id="telepon">
            </div>
            <div class="form-group" class="col-form-label">
              <label for="id_card">No Identitas</label>
              <input type="text" class="form-control" name="id_card" id="id_card">
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