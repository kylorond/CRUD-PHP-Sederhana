<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>alert("Harap untuk masuk terlebih dahulu!")</script>';
        echo '<script>window.location="masuk.php"</script>';
    }
    $produk = mysqli_query($hasil, "SELECT * FROM tbl_produk WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="produk.php"</script>';
    }
    $p      = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Edit Data Produk | Traborn </title>
    <link rel="stylesheet" type="text/css" href="Tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="">Traborn (Traditional Borneo) </a></h1>
        <ul>
            <li><a href="laman.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="kategori.php">Kategori</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="keluar.php">Keluar</a></li>
        </ul>
        </div>   
    </header>
    <div class="section">
        <div class="container">
            <h3>Edit Produk</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                   <select class="input-control" name="kategori" required>
                       <option value="">Pilih Kategori</option>
                       <?php
                            $kategori = mysqli_query($hasil, "SELECT * FROM tbl_kategori ORDER BY category_id DESC");
                            while($r  = mysqli_fetch_array($kategori)) {
                       ?>
                       <option value="<?php echo $r['category_id']?>"<?php echo($r['category_id'] == $p->category_id)? 'selected':''; ?>>
                       <?php echo $r['category_name']?></option>
                       <?php } ?>
                   </select>
                   <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                   <input type="text" name="harga" class="input-control" placeholder="Harga Produk" value="<?php echo $p->product_price ?>" required>
                   <img src="gambarproduk/<?php echo $p->product_image ?>" width="100px">
                   <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                   <input type="file" name="gambar" class="input-control">
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
                   <select class="input-control" name="status">
                       <option value="">Pilih Status</option>
                       <option value="0"<?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Tersedia</option>
                       <option value="1"<?php echo ($p->product_status == 1)? 'selected':''; ?>>Tersedia</option>
                   </select>
                   <input type="submit" name="submit" value="Edit Produk" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $kategori       = $_POST['kategori'];
                        $nama           = $_POST['nama'];
                        $harga          = $_POST['harga'];
                        $deskripsi      = $_POST['deskripsi'];
                        $status         = $_POST['status'];
                        $foto           = $_POST['foto'];

                        $filename       = $_FILES['gambar']['name'];
                        $tmp_name       = $_FILES['gambar']['tmp_name'];

                        if($filename != '') {
                            $type1          = explode ('.', $filename);
                            $type2          = $type1[1];
                            $newname        = 'Produk'.time().'.'.$type2;
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                            if(!in_array($type2, $tipe_diizinkan)){
                                echo '<script>alert("Format file tidak diizinkan")</script>';
                        }else {
                            unlink('./gambarproduk/'.$foto);
                            move_uploaded_file($tmp_name, './gambarproduk/'.$newname);
                            $namagambar = $newname;
                            }
                        }else {
                            $namagambar = $foto;
                        }
                        $baru = mysqli_query($hasil, "UPDATE tbl_produk SET
                                            category_id          = '".$kategori."',
                                            product_name         = '".$nama."',
                                            product_price        = '".$harga."',
                                            product_description  = '".$deskripsi."', 
                                            product_image        = '".$namagambar."',
                                            product_status       = '".$status."'
                                            WHERE product_id     = '".$p->product_id."' ");
                            if($baru) {
                                echo '<script>alert("Ubah produk berhasil")</script>';
                                echo '<script>window.location="produk.php"</script>';
                                }else {
                                    echo 'Produk gagal di ubah'.mysqli_error($hasil);
                                }
                    }
               ?>
            </div>
        </div>
    </div>
    <footer>
                <script>
                        CKEDITOR.replace( 'deskripsi' );
                </script>
        <div class="container">
            <small>Copyright &copy 2021 - Ronaldo Dwi (C2057201032)</small>
        </div>
    </footer>
</body>
</html>