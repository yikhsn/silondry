<?
  require_once "vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/login.css">
  <title>Halaman Login</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 offset-sm-4">
        <div class="form-auth-box card">
          <div class="card-body">
            <div class="col-12">
              <h3 class="card-title auth-title">Register</h3>
              <form action="" method="post">

                <div class="form-group">
                  <label class="label-form-auth" for="username">Username</label>
                  <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                </div>

                <div class="form-group">
                  <label class="label-form-auth" for="password">Password</label>
                  <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                </div>

                <div class="form-group">
                  <label class="label-form-auth" for="id_pegawai">ID Pegawai</label>
                  <input class="form-control" type="text" name="id_pegawai" id="id_pegawai" value="<?= $this->id_pegawai?>" readonly>
                </div>

                <div>
                  <? foreach($this->errors as $error){ ?>
                  <div id="errors-message">
                    <li class="error-detail"><? echo $error; ?></li>
                  </div>
                  <?}?>
                </div>

                <input type="submit" class="btn btn-block btn-primary" name="submit" value="Daftar">
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="static/bootstrap/js/jquery-3.2.1.min.js"></script>
  <script src="static/popper.js"></script>    
  <script src="static/bootstrap/js/bootstrap.min.js"></script>
  <script src="static/main.js"></script>
  </body>
</html>