<?php
use Carbon\Carbon;

function simpleDateFormat($arg)
{
    $thai_months = [
        1 => 'ม.ค.',
        2 => 'ก.พ.',
        3 => 'มี.ค.',
        4 => 'เม.ย.',
        5 => 'พ.ค.',
        6 => 'มิ.ย.',
        7 => 'ก.ค.',
        8 => 'ส.ค.',
        9 => 'ก.ย.',
        10 => 'ต.ค.',
        11 => 'พ.ย.',
        12 => 'ธ.ค.',
    ];
    $date = Carbon::parse($arg);
    $day = $date->day;
    $month = $thai_months[$date->month];
    $year = $date->year + 543;
    return "$day $month $year";
}

function convertAmountToLetter($number)
{
  if (empty($number)) return "";
  $number = strval($number);
  $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
  $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
  $number = str_replace(",", "", $number);
  $number = str_replace(" ", "", $number);
  $number = str_replace("บาท", "", $number);
  $number = explode(".", $number);
  if (sizeof($number) > 2) {
    return '';
    exit;
  }
  $strlen = strlen($number[0]);
  $convert = '';
  for ($i = 0; $i < $strlen; $i++) {
    $n = substr($number[0], $i, 1);
    if ($n != 0) {
      if ($i == ($strlen-1) && $n == 1) {
        $convert .= 'เอ็ด';
      } elseif ($i == ($strlen - 2) && $n == 2) {
        $convert .= 'ยี่';
      } elseif ($i == ($strlen - 2) && $n == 1) {
        $convert .= '';
      } else {
        $convert .= $txtnum1[$n];
      }
      $convert .= $txtnum2[$strlen - $i - 1];
    }
  }
  $convert .= 'บาท';
  if (sizeof($number) == 1) {
    $convert .= 'ถ้วน';
  } else {
    if ($number[1] == '0' || $number[1] == '00' || $number[1] == '') {
      $convert .= 'ถ้วน';
    } else {
      $number[1] = substr($number[1], 0, 2);
      $strlen = strlen($number[1]);
        for ($i = 0; $i < $strlen; $i++) {
          $n = substr($number[1], $i, 1);
          if ($n != 0) {
            if ($i > 0 && $n == 1 ) {
              $convert.= 'เอ็ด';
            } elseif ($i == 0 && $n == 2) {
              $convert .= 'ยี่';
            } elseif ($i == 0 && $n == 1) {
              $convert .= '';
            } else {
              $convert .= $txtnum1[$n];
            }
            $convert .= $i==0 ? $txtnum2[1] : '';
          }
        }
      $convert .= 'สตางค์';
    }
  }
  return $convert.PHP_EOL;
}
