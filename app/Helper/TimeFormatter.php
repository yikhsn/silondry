<?php
namespace Helper;

use DateTime;

trait TimeFormatter {

  // metode untuk menampilkan waktu dalam format ampm
  public static function ampm($time){
    return date( "g:i A", strtotime($time) );
  }

  // metode untuk menampilkan waktu dalam format time elapsed
  public static function elapsed($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );

    foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
      } else {
          unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
  }
}