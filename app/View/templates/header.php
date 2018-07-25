<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/main.css">
  <title>Document</title>
</head>
<body>
  <div class="row no-gutters">
    <div class="col-2">
      <div class="panel-container">
        <div class="name-brand-silony">
          <a class="text-brand-name" href="">
            SILONDRY
          </a>
        </div>
        <ul class="menu-panel-container">
          <a href="?p=home">
            <li class="menu-item-panel">
              <span class="menu-link-panel">Dashboard</span>
            </li>
          </a>
          <a href="?p=barang">
            <li class="menu-item-panel">
              <span class="menu-link-panel">Barang</span>
            </li>
          </a>
          <a href="?p=customer">
            <li class="menu-item-panel">
              <span class="menu-link-panel">Pelanggan</span>
            </li>
          </a>  
        </ul>
      </div>
    </div>
  <div class="col-10">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark"
            id="navbar-silony">
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarText" aria-controls="navbarText" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-text">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="?p=admin&amp;a=login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=admin&amp;a=register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=admin&amp;a=logout">Logout</a>
            </li>
          </ul>
          <span class="navbar-text">Hei, Selamat Datang</span>
        </div>
      </nav>
    </header>
  