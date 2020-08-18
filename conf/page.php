<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
switch ($page) {
  case 'user':
    include 'pages/user.php';
    break;
  case 'departement':
    include 'pages/departement.php';
    break;
  case 'probability':
    include 'pages/probability.php';
    break;
  case 'dampak':
    include 'pages/dampak.php';
    break; 
  case 'btr':
    include 'pages/btr.php';
    break;
  case 'kategori':
    include 'pages/kategori.php';
    break;
  case 'strategi':
    include 'pages/strategi.php';
    break;
   case 'registrasi':
    include 'pages/registrasi.php';
    break;
  case 'identifikasi':
    include 'pages/identifikasi.php';
    break;
  case 'analisis':
    include 'pages/analisis.php';
    break;
  case 'mitigasi':
    include 'pages/mitigasi.php';
    break;
  case 'treatment':
    include 'pages/treatment.php';
    break;
  }
}else{
    include "pages/beranda.php";
  }
?>