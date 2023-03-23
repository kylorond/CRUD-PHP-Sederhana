<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>alert("Harap untuk masuk terlebih dahulu!")</script>';
        echo '<script>window.location="masuk.php"</script>';
    }
    $kategori = mysqli_query($hasil, "SELECT * FROM tbl_kategori WHERE category_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="kategori.php"</script>';
    }
    $e        = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Edit Data Kategori | Traborn </title>
    <link rel="stylesheet" type="text/css" href="Tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
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
            <h3>Edit Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="kategori" placeholder="Nama Kategori" class="input-control" value="<?php echo $e->category_name ?>" required>
                   <input type="submit" name="submit" value="Tambah Kategori" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $n_kategori = ucwords($_POST['kategori']);
                        $baru       = mysqli_query($hasil, "UPDATE tbl_kategori SET category_name = '".$n_kategori."' WHERE category_id = '".$e->category_id."' ");
                        if($baru){
                            echo '<script>alert("Kategori berhasil di ubah")</script>';
                            echo '<script>window.location="kategori.php"</script>';
                        }else {
                            echo 'Kategori gagal di ubah'.mysqli_error($hasil);
                        }
                    }
               ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <small>Copyright &copy 2021 - Ronaldo Dwi (C2057201032)</small>
        </div>
    </footer>
</body>
</html>