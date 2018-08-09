<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>
<div id="body-silony-container">

  <div class="row no-gutters">
    <div class="col-12">
      <div id="ringkasan">
        <div class="ringkasan-teks">
          Aktivitas Terakhir Laundry
        </div>
        <div class="row no-gutters">
          <div class="ringkasan-utama">
            <div class="ringkasan-jumlah-masuk">
              <div class="ringkasan-header-box">
                <div class="ringkasan-judul">Hari ini</div>
                <div class="ringkasan-selengkapnya">
                  Selengkapnya
                </div>
              </div>
              <?
                $today = $this->todayInsight;
              ?>
              <div class="ringkasan-masuk-body">
                <div class="ringkasan-hari-ini">
                  <? echo $today['today']; ?>
                </div>
                <div class="banding-target-container">
                  <span class="banding-target">
                    -<? echo $today['minus'] ?>%
                  </span>
                  <span class="banding-target-text">
                    dari target harian
                  </span>
                  </div>
                </div>
              </div>
              <div class="ringkasan-belum-diambil">
                <div class="ringkasan-header-box">
                  <div class="ringkasan-judul">Belum Diambil</div>
                  <div class="ringkasan-selengkapnya">
                    Selengkapnya
                  </div>
                </div>
                <div class="ringkasan-belum-diambil-body">
                  <div class="jumlah-belum-diambil">
                    <?= $this->notTaken; ?>
                  </div>
                  <div class="belum-diambil-text">
                    Cucian belum diambil
                  </div>
                </div>                
            </div>
          </div>
          <div class="ringkasan-aktivitas">
            <div class="ringkasan-judul">
              <div class="ringkasan-judul">Cucian Masuk</div>
              <div class="ringkasan-selengkapnya">
                Selengkapnya
              </div>
            </div>
            <div class="ringkasan-aktivitas-body">
              <?
                foreach($this->latestIn as $latest){
              ?>
              <li class="daftar-aktivitas">
                <span>
                <img class="icon-in-out"src="static/img/<?=$latest['keterangan']?>.png">
                  <?= $latest['waktu'] ?> - Cucian
                  <span class="barang-in-out">
                    <?= '"' . $latest['kode'] . '"'?>
                  </span><?= $latest['keterangan'] ?>
                </span>
              </li>
              <? } ?>
            </div>
          </div>
          <div class="ringkasan-aktivitas">
            <div class="ringkasan-judul">
              <div class="ringkasan-judul">Cucian Keluar</div>
              <div class="ringkasan-selengkapnya">
                Selengkapnya
              </div>
            </div>
            <div class="ringkasan-aktivitas-body">
              <?
                foreach($this->latestOut as $latest){
              ?>
              <li class="daftar-aktivitas">
                <span>
                <img class="icon-in-out"src="static/img/<?=$latest['keterangan']?>.png">
                  <?= $latest['waktu'] ?> - Cucian
                  <span class="barang-in-out">
                    <?= '"' . $latest['kode'] . '"'?>
                  </span> <?= $latest['keterangan'] ?>
                </span>
              </li>
                <? } ?>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>  
  
<? require_once "templates/footer.php"; ?>