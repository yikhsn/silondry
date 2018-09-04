var beratDOM = document.getElementById('berat');
var hargaDOM = document.getElementById('harga');

if (beratDOM !== null ){
  beratDOM.addEventListener('keyup', function(){
    var berat = beratDOM.value;
    var harga = berat * 5000;  
    hargaDOM.value = harga;
  })  
}

if (window.location.href.indexOf('p=barang') > -1 ){
  var menuBarangDOM = document.getElementById('text-menu-barang');
  menuBarangDOM.classList.add('menu-link-panel-active');
  menuBarangDOM.classList.remove('menu-link-panel');
}

if (window.location.href.indexOf('p=home') > -1 ){
  var menuBarangDOM = document.getElementById('text-menu-dashboard');
  menuBarangDOM.classList.add('menu-link-panel-active');
  menuBarangDOM.classList.remove('menu-link-panel');
}

if (window.location.href.indexOf('p=customer') > -1 ){
  var menuBarangDOM = document.getElementById('text-menu-pelanggan');
  menuBarangDOM.classList.add('menu-link-panel-active');
  menuBarangDOM.classList.remove('menu-link-panel');
}