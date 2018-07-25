<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

  <div id="body-silony-container">
  
  <h2>Daftar Disini</h2>
  <form action="" method="post">
    
    <label for="username">Nama Pegawai</label>
    <input type="text" name="username" id="username"><br>

    <label for="password">Password</label>
    <input type="text" name="password" id="password"><br>

    <label for="id_pegawai">ID Pegawai</label>
    <input type="text" name="id_pegawai" id="id_pegawai" value="<?= $this->id_pegawai?>"><br>

    <input type="submit" name="submit" value="Tambah">
    
    <? foreach ($this->errors as $error){ ?>
      <div id="errors">
        <li class="error"><? echo $error; ?></li>
      </div>
    <?}?>
  </form>

<?php require_once "templates/footer.php"; ?>