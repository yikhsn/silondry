<?
require_once "vendor/autoload.php";
require_once "templates/header.php";
?>

<div id="body-silony-container">
  <div id="body-silony">
    <div class="header-form-data">
      <div class="title-form">Tambah Data Langganan</div>
    </div>
    <div class="body-form-data">
      <form method="post" action="">
        <div class="form-group">
          <label class="col-form-label" for="id_pelanggan">ID Pelanggan</label>
          <input type="text" name="id_pelanggan" id="id_pelanggan"
            class="form-control" value="<?= $this->id_pelanggan?>" readonly>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="alamat">Alamat</label>
          <input type="text" name="alamat" id="alamat" class="form-control">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="nomor_telpon">Nomor Telpon</label>
          <input type="text" name="nomor_telpon" id="nomor_telpon"
            class="form-control">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="nomor_identitas">
            Nomor Identitas
          </label>
          <input type="text" name="nomor_identitas" id="nomor_identitas"
            class="form-control">
        </div>
        <a class="btn btn-light" href="?p=customer">Keluar</a>
        <input type="submit" name="submit" class="btn btn-primary"
          value="Simpan">
      </form>
    </div>  
  </div>

<? require_once "templates/footer.php"; ?>