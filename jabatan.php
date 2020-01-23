<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
    <title>
    Jabatan Pegawai
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
// variable "status" u/ deteksi aksi : simpan, update & hapus
// if menggunakan gaya satu baris karena hanya memiliki satu keputusan optional
include("db.php");
$action = (!isset($_REQUEST["action"]) ? null : ($_REQUEST["action"]));
if ($action == null){
?>
<div class="container">

<div class="row" style="border">
  <div class="col-12">
    <div class="form-group">
    <h3>Jabatan</h3>
    <form action="">

      <label  for="exampleinputText">Jabatan</label>
	  <input type="text" class="form-control" name="jabatan" placeholder="Tulis Jabatan"required>

      <label  for="exampleinputText">Honor</label>
	  <input type="text" class="form-control" name="honor" placeholder="Tulis Jumlah Honor" required>
    </div>
  </div>
  <div class="col-4">
      <input type="submit"  name="action" value="simpan" class="btn btn-success"/>
      <input type="reset" name="reset" value="ulangi" class="btn btn-danger"/>
  </div>
    </form>
</div>


<table class="table table-bordered">
  <thead>
  <th>Jabatan &nbsp; &nbsp;</th>
  <th>Honor &nbsp; &nbsp;</th>
  <th>Edit &nbsp; &nbsp;</th>
  </thead>
  
  
  <tbody>
 
    <?php
    $d = new DB(); //mengaktifkan class
    $sql = "select * from jabatan";
    $hasil = $d->getlist($sql); //ambil data dan tampung pada $hasil

    // loop untuk menampilkan
    for($i = 0; $i < count($hasil); $i++){
      ?>
	  
      <tr>
	  
        <td><?= $hasil[$i]["jabatan"] ?></td>
        <td><?= $hasil[$i]["honor"] ?></td>
		
        <td>
          <a href="jabatan.php?action=Ubah&id=<?= $hasil[$i]['id_jabatan'] ?>" class="btn btn-primary">Ubah</a>
          <a href="jabatan.php?action=Hapus&id=<?= $hasil[$i]['id_jabatan'] ?>" class="btn btn-danger">Hapus</a>
        </tr>
      </td>
<br><br>
      <?php } ?>
  </tbody>
 </table>
</div>
<?php
}elseif($action == "simpan"){
        $d = new DB(); //mengaktifkan class db
        $sql = "insert into jabatan (jabatan, honor) values ('".$_REQUEST['jabatan']."', ".$_REQUEST['honor'].")";
        $d->query($sql); //jalankan function query u/

        header("location: jabatan.php");
}elseif($action == "update"){
        $d = new DB(); //mengaktifkan class db
        $sql = "update jabatan set "
        ."jabatan = '".$_REQUEST['jabatan']."', "
        ."honor = '".$_REQUEST['honor']."' "
        ."where id_jabatan = ". $_REQUEST['id_jabatan'];
        $d->query($sql); //jalankan function query u/
		
	header("location: jabatan.php");
		
}elseif($action == "Hapus"){
       $d = new DB(); //mengaktifkan class db
        $sql = "delete from jabatan where id_jabatan = ".$_REQUEST['id'];
        $d->query($sql); //jalankan function query u/
        header("location: jabatan.php");
}elseif($action == "Ubah"){ 
  
  $d = new DB(); //mengaktifkan class db
  $sql = "select * from jabatan where id_jabatan = ".$_REQUEST['id'];
  $result= $d->getlist($sql); //jalankan function query u/

?>
<div class="container">
  <h3>Edit Data Jabatan </h3>
  <div class="row" style="bordered-dark">
    <form action="">
	
	
    <label><b>Jabatan</b>&nbsp;&nbsp;</label>
    <input value = "<?= $result[0]["jabatan"] ?>" type="text" name="jabatan"/><br>
    <label><b>Honor</b>&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input value = "<?= $result[0]["honor"] ?>" type="text" name="honor"/>
    <input value = "<?= $result[0] ["id_jabatan"]?>" type="hidden" name="id_jabatan"/>
    <br>
    <input type="submit" name="action" value="update" class="btn btn-primary"/>
    <input type="reset" name="reset" value="ulangi" value="kembali" onclick="window.history.back()" class="btn btn-danger"/>
    </form>
    </div>
  </div>
 <?php }?>
</body>
</html>
