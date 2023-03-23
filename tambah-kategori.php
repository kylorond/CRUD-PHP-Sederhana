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
    <title> Tambah Data Kategori | Traborn </title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
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
            <h3>Tambah Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="kategori" placeholder="Nama Kategori" class="input-control" required>
                   <input type="submit" name="submit" value="Tambah Kategori" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $n_kategori = ucwords($_POST['kategori']);
                        $insert     = mysqli_query($hasil, "INSERT INTO tbl_kategori VALUES (null,'".$n_kategori."') ");
                        if($insert){
                            echo '<script>alert("Selamat, kategori berhasil ditambahkan")</script>';
                            echo '<script>window.location="kategori.php"</script>';
                        }else {
                            echo 'Maaf, kategori gagal ditambahkan'.mysqli_error($hasil);
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