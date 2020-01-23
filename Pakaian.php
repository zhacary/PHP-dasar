<?php
include "PakaianLib.php";

$p = new Pakaian();

//set
 $p->setHarga(120000);
 $p-> setMerk("Emba");

 print $p->getHarga()."<br/>";
 print $p->getMerk()."<br/>";

//cara ke 2


//set
// $p = new Pakaian("Emba",120000);

//get
//print $p->getHarga()."<br/>";
//print $p->getMerk()."<br/>";




?>
