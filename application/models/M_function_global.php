<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_function_global extends CI_Model {
  //(1)
  //buat fungsi untuk merubah susunan format tanggal ke database mysql
  //25-05-2015 --> 2015-05-25 ( dd-mm-yyyy --> yyyy-mm-dd
  public function  tgltosql($date){
        $exp = explode('/', $date);
      if (count($exp) == 3){
        $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
      }
      return $date;
    }

  //(2)
  //2015-05-25 -->  25-05-2015 ( yyyy-mm-dd --> dd-mm-yyyy
  public function sqltotgl($date){
    $exp = explode('-', $date);
  if (count($exp) == 3){
    $date = $exp[2].'/'.$exp[1].'/'.$exp[0];
  }
  return $date;
  }

  public function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
  }
  


/*  public function f_rupiah($amount, $decimalSeparator, $thousandsSeparator, $nDecimalDigits) {
    number_format($amount, $decimalSeparator, $nDecimalDigits, $thousandsSeparator);
  }
*/
}


 
  
  