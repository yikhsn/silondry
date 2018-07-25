<?
require_once "vendor/autoload.php";
require_once "templates/header.php";
?>
  <h2>Daftar Disini</h2>
  <form action="" method="post">
    
    <label for="username">Nama Pegawai</label>
    <input type="text" name="username" id="username"><br>

    <label for="password">Password</label>
    <input type="text" name="password" id="password"><br>

    <input type="submit" name="submit" value="Login">
    
    <? foreach($this->errors as $error){ ?>
    <div id="errors">
      <li class="error"><? echo $error; ?></li>
    </div>
    <?}?>
  </form>

<? require_once "templates/footer.php"; ?>