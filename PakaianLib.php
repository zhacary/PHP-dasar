<?php
class Pakaian{
  var $harga;
  var $merk;

//cara 2 langsung set data saat inisiasi
  function _construct($m, $h){
  $this->harga = $h;
  $this->merk = $m;
  }


// cara 1 dengan set ke masing masing variable
  function setHarga($h){
  $this->harga = $h;
  }

  function setMerk($m){
  $this->merk = $m;
  }

  function getHarga(){
  return $this->harga;
  }

  function getMerk(){
  return $this->merk;
  }


}
?>
