<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>alert("Harap untuk masuk terlebih dahulu!")</script>';
        echo '<script>window.location="masuk.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Tambah Data Produk | Traborn </title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
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
            <h3>Tambah Produk</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                   <select class="input-control" name="kategori" required>
                       <option value="">Pilih Kategori</option>
                       <?php
                            $kategori = mysqli_query($hasil, "SELECT * FROM tbl_kategori ORDER BY category_id DESC");
                            while($r  = mysqli_fetch_array($kategori)) {
                       ?>
                       <option value="<?php echo $r['category_id']?>"><?php echo $r['category_name']?></option>
                       <?php } ?>
                   </select>
                   <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                   <input type="text" name="harga" class="input-control" placeholder="Harga Produk" required>
                   <input type="file" name="gambar" class="input-control" required>
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
                   <select class="input-control" name="status">
                       <option value="">Pilih Status</option>
                       <option value="0">Tidak Tersedia</option>
                       <option value="1">Tersedia</option>
                   </select>
                   <input type="submit" name="submit" value="Tambah Produk" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $kategori       = $_POST['kategori'];
                        $nama           = $_POST['nama'];
                        $harga          = $_POST['harga'];
                        $deskripsi      = $_POST['deskripsi'];
                        $status         = $_POST['status'];

                        $filename       = $_FILES['gambar']['name'];
                        $tmp_name       = $_FILES['gambar']['tmp_name'];
                        $type1          = explode ('.', $filename);
                        $type2          = $type1[1];
                        $newname        = 'Produk'.time().'.'.$type2;
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert("Format file tidak diizinkan")</script>';
                        }else {
                            move_uploaded_file($tmp_name, './gambarproduk/'.$newname);

                            $insert = mysqli_query ($hasil, "INSERT INTO tbl_produk VALUES (
                                    null, 
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$harga."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null
                                )");
                                if($insert) {
                                    echo '<script>alert("Tambah produk berhasil")</script>';
                                    echo '<script>window.location="produk.php"</script>';
                                }else {
                                    echo 'Produk gagal ditambahkan'.mysqli_error($hasil);
                                }
                    
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