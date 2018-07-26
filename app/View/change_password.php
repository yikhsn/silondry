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
                  <label class="label-form-auth" for="old_pass">Password Sebelumnya</label>
                  <input class="form-control" type="password" name="old_pass" id="old_pass">
                </div>

                <div class="form-group">
                  <label class="label-form-auth" for="new_pass">Password Baru</label>
                  <input class="form-control" type="password" name="new_pass" id="new_pass">
                </div>

                <div class="form-group">
                  <label class="label-form-auth" for="confirm_pass">Confirm Password</label>
                  <input class="form-control" type="text" name="confirm_pass" id="confirm_pass">
                </div>

                <div>
                  <? foreach($this->errors as $error){ ?>
                  <div id="errors-message">
                    <li class="error-detail"><? echo $error; ?></li>
                  </div>
                  <?}?>
                </div>

                <input type="submit" class="btn btn-block btn-primary" name="submit" value="Ubah">
              
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