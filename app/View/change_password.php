<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>

  <div id="body-silony-container">
  
  <h2>Ubah Password</h2>
  <form action="" method="post">
    
    <label for="old_pass">Password Lama</label>
    <input type="password" name="old_pass" id="old_pass"><br>

    <label for="new_pass">Password Baru</label>
    <input type="password" name="new_pass" id="new_pass"><br>

    <label for="confirm_pass">Konfirmasi Password</label>
    <input type="password" name="confirm_pass" id="confirm_pass"><br>

    <input type="submit" name="submit" value="Tambah">
    
    <? foreach ($this->errors as $error){ ?>
      <div id="errors">
        <li class="error"><? echo $error; ?></li>
      </div>
    <?}?>
  </form>

<?php require_once "templates/footer.php"; ?>