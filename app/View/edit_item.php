<?
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

<div id="body-silony-container">
  <div id="body-silony">
    <form method="post" action="">
    <? foreach ( $this->data as $item) { ?>
      <div class="form-group">
        <label class="col-form-label" for="kode">
          Kode
        </label>
        <input type="text" name="kode" id="kode" class="form-control"
            value="<?= $item->kode ?>" readonly>
      </div>
      <div class="form-group">
        <label class="col-form-label" for="jumlah">
          Jumlah
        </label>
        <input type="text" name="jumlah" id="jumlah" class="form-control"
            value="<?= $item->jumlah ?>">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="berat">
          Berat
        </label>
        <input type="text" name="berat" id="berat" class="form-control" 
          value="<?= $item->berat ?>">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="harga">
          Harga
        </label>
        <input type="text" name="harga" id="harga" class="form-control"
            value="<?= $item->harga ?>">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="masuk">Waktu Masuk</label>
        <input type="text" name="masuk" id="masuk" class="form-control"
            value="<?= $item->masuk ?>" readonly>
      </div>
    <? } ?>
      <a class="btn btn-light" href="pelanggan.php">Keluar</a>
      <input type="submit" name="edit_submit" class="btn btn-primary" 
          value="Simpan">
    </form>
  </div>

<? require_once "templates/footer.php"; ?>