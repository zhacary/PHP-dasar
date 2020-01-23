<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
		img {
			border: 1px solid #ddd;
			max-width : 150px;
			padding : 5px;
		}
		
		
	</style>

</head>
<body>
<?php
include("db.php");
$action = (!isset($_REQUEST["action"]) ? null : ($_REQUEST["action"]));
if ($action == null){
?>
<div class="container">
<form class="col-6" method="post" enctype="multipart/form-data" style="border:2px solid  #bbb;border-radius:2px;padding:50px; border-color:black;">

<label>No</label>
<input type="text" class="form-control" name="kode_produk" ><br><br>
<label>Gambar</label>
<input type="file" class="form-control" name="gambar" ><br><br>
<label>Nama produk</label>
<input type="text" class="form-control" name="nama_produk" ><br><br>
<label><b>Kategori</b>	  </label>
	  <select class="form-control" name="kategori_id">
	  <option value="Makanan">K001</option>
	  <option value="Minuman">K002</option>
	  <option value="jajanan ringan">K003</option>
	  </select><br/>
<label>harga</label>
<input type="text" class="form-control" name="harga" ><br><br>

 <input type="submit"  name="action" value="simpan" class="btn btn-success"/>
      <input type="reset" name="reset" value="ulangi" class="btn btn-danger"/>
		</form>
</div>		
		
		<table class="table table-dark table-striped ">
		<thead>
		<th>No&nbsp;&nbsp;</th>
		<th>Gamabar&nbsp;&nbsp;</th>
		<th>Nama produk&nbsp;&nbsp;</th>
		<th>Kategori&nbsp;&nbsp;</th>
		<th>Harga&nbsp;&nbsp;</th>
		<th>Edit&nbsp;&nbsp;</th>
		</thead>
		<?php
			$d = new DB(); //mengaktifkan class
			$sql = "select * from formatif";
			$hasil = $d->getlist($sql); //ambil data dan tampung pada $hasil

			// loop untuk menampilkan
			for($i = 0; $i < count($hasil); $i++){
      ?>
	  
<tr>
<tbody>
	  <td><?= $hasil[$i]["kode_produk"] ?></td>
	  <td><img src='<?= $hasil[$i]["gambar"] ?>'></td>
        <td><?= $hasil[$i]["nama_produk"] ?></td>
		<td><?= $hasil[$i]["kategori_id"] ?></td>
     	 <td><?= $hasil[$i]["harga"] ?></td>
		 <td>
		<a href="formatiif.php?action=Ubah&id=<?= $hasil[$i]['kode_produk'] ?>" class="btn btn-primary">Ubah</a>
          <a href="formatiif.php?action=Hapus&id=<?= $hasil[$i]['kode_produk'] ?>" class="btn btn-danger">Hapus</a>
		  </td>
		 </tbody>
</tr>
<?php }?>
</table>
<?php
}elseif($action == "simpan"){
        $d = new DB(); //mengaktifkan class db
		
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];
		$upload = true;
		

		// cek apakah ada gambar yang di upload
		if ($error === 4){
			echo '<script>alert("pilih gambar terlebih dahulu")</script>';
			$upload = false;
		}
		
		// cek apakah jenis file yang di upload adalah [jpg, jpeg, png]
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
			echo '<script>alert("yang anda upload bukan jenis gambar")</script>';
			$upload = false;
		}
		
		// cek ukuran file
		if($ukuranFile > 5000000){
			echo '<script>alert("ukuran gambar terlalu besar")</script>';
			$upload = false;
		}
		
		$namaFileBaru = uniqid();
		$namaFileBaru .= $namaFile;
		
		move_uploaded_file($tmpName, 'files/'. $namaFileBaru);
		
		$namaGambar = 'files/'.$namaFileBaru;
		
		
        $sql = "INSERT INTO `formatif` (`kode_produk`, `nama_produk`, `kategori_id`, `harga`, `gambar`) VALUES ('".$_POST['kode_produk']."', '".$_POST['nama_produk']."', '".$_POST['kategori_id']."', '".$_POST['harga']."', '".$namaGambar."')";
        $d->query($sql);
	
		header("location: formatiif.php");
}elseif($action == "Hapus"){
		
			$d = new DB(); //mengaktifkan class db
			$sql = "delete from `formatif` where `kode_produk` = ".$_REQUEST["id"];
			$d->query($sql); //jalankan function query u/	
			header("location: formatiif.php");
			
		}elseif($action == "Update"){
  $d = new DB(); //mengaktifkan class db
  $sql = "update formatif set "
  ."nama_produk = '".$_REQUEST['nama_produk']."', "
  ."kategori_id = '".$_REQUEST['kategori_id']."', "
  ."harga= '".$_REQUEST['harga']."' "
  ."where kode_produk = ". $_REQUEST["id"];
  $d->query($sql); //jalankan function query u/
  header("location: formatiif.php"); 

}elseif($action == "Ubah"){
			$d = new DB(); //mengaktifkan class db
			$sql = "select * from formatif where kode_produk = ".$_REQUEST["id"];
			$result= $d->getlist($sql); //jalankan function query u/		
		?>
		
<div class="row" style="border:2px solid #bbb;border-radius:2px;padding:50px; border-color:black;">
    <form action="" method="POST" enctype="multipart/form-data">
    <label><b>Nama produk</b>&nbsp;&nbsp;</label>
	<input value = "<?= $result[0]["nama_produk"] ?>" type="text" class="form-control" name="nama_produk"/><br/>
    
    <label><b>Harga</b>&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input value = "<?= $result[0]["harga"] ?>" type="text" class="form-control" name="harga"/><br/>
	
	<label><b>Kategori</b></label>
	  <select value="<?= $result[0]["kategori_id"] ?>" class="form-control" name="kategori_id">
	  <option value="Makanan">K001</option>
	  <option value="Minuman">K002</option>
	  <option value="jajanan ringan">K003</option>
	  </select><br/>
	  <input value = "<?= $result[0]["kode_produk"] ?>" type="hidden" name="kode_produk"/>
	  <input type="submit" name="action" value="Update">
	  </form>
	  </div>
		<?php }?>
</body>
</html>