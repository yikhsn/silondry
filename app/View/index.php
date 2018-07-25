<?php
  require_once "vendor/autoload.php";
  require_once "templates/header.php";
?>
<div id="body-silony-container">

  <div class="row no-gutters">
    <div class="col-12">
      <div class="row no-gutters" id="ringkasan-container">
        <div class="ringkasan ringkasan-umum">
          <div class="ringkasan-umum-header">
            <div class="ringkasan-umum-title">
              Ringkasan 7 hari terakhir
            </div>
          </div>
          <div class="ringkasan-umum-body">
          <?
          foreach($this->thisWeekInsight as $data){
          ?>
            <div class="progress progress-bar-vertical">
              <div class="progress-bar" role="progressbar"
                aria-valuenow="<? echo $data['reach'] ?>" aria-valuemin="0"
                aria-valuemax="100" style="height: <? echo $data['reach'] ?>;">
              </div>
              <span class="tanggal-ringkasan">
                <?
                  echo $data['date']
                ?>
              </span>
            </div>
          <?
          }
          ?>
          </div>
        </div>
        <div class="ringkasan ringkasan-inti">
          <div class="ringkasan-inti-container">
            <div class="ringkasan-inti-header">
              <div class="ringkasan-inti-title">
                Hari ini
              </div>
            </div>
            <?
              $today = $this->todayInsight;
            ?>
            <div class="ringkasan-inti-body">
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
          <div class="barang-belum-diambil">
            <div class="jumlah-belum-diambil">
              <?= $this->notTaken; ?>
            </div>
            <div class="belum-diambil-text">
              Cucian belum diambil
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div id="latest-act">
        <div class="latest-act-header">
          Aktivitas Terakhir Laundry
        </div>
        <div class="row no-gutters">
          <div class="latest-act-detail latest-act-all">
            <div class="latest-act-title">
              <div class="latest-title-text">Semua Aktivitas</div>
              <div class="see-more-text">
                Selengkapnya
              </div>
            </div>
            <div class="latest-act-body">
            <?
               foreach($this->latestAll as $latest){
            ?>
             <li class="list-act">
                <span>
                  <img class="icon-in-out"src="assets/img/in-blue.png" alt="">
                  <?= $latest['aktivitas'] ?> - Cucian
                  <span class="barang-in-out">
                    <?= '"' . $latest['kode'] . '"'?>
                  </span> . <?= $latest['keterangan'] ?>
                </span>
              </li>
              <? } ?>
            </div>
          </div>
          <div class="latest-act-detail latest-act-all">
            <div class="latest-act-title">
              <div class="latest-title-text">Cucian Masuk</div>
              <div class="see-more-text">
                Selengkapnya
              </div>
            </div>
            <div class="latest-act-body">
              <?
                foreach($this->latestIn as $latest){
              ?>
              <li class="list-act">
                <span>
                  <img class="icon-in-out"src="assets/img/in-blue.png" alt="">
                  <?= $latest['aktivitas'] ?> - Cucian
                  <span class="barang-in-out">
                    <?= '"' . $latest['kode'] . '"'?>
                  </span> . <?= $latest['keterangan'] ?>
                </span>
              </li>
              <? } ?>
            </div>
          </div>
          <div class="latest-act-detail latest-act-out">
            <div class="latest-act-title">
              <div class="latest-title-text">Cucian Keluar</div>
              <div class="see-more-text">
                Selengkapnya
              </div>
            </div>
            <div class="latest-act-body">
              <?
                foreach($this->latestOut as $latest){
              ?>
              <li class="list-act">
                <span>
                  <img class="icon-in-out"src="assets/img/in-blue.png" alt="">
                  <?= $latest['aktivitas'] ?> - Cucian
                  <span class="barang-in-out">
                    <?= '"' . $latest['kode'] . '"'?>
                  </span> . <?= $latest['keterangan'] ?>
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