<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>alert("Harap untuk masuk terlebih dahulu!")</script>';
        echo '<script>window.location="masuk.php"</script>';
    }
    $query = mysqli_query($hasil, "SELECT * FROM tbl_admin WHERE admin_id ='".$_SESSION['id']."' ");
    $d = mysqli_fetch_object ($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Profil | Traborn </title>
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
            <h3>Ubah Profil</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>"required>
                   <input type="text" name="telp" placeholder="Nomor Telepon" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                   <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                   <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                   <input type="text" name="user" placeholder="Nama Pengguna" class="input-control" value="<?php echo $d->Username ?>" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])) {
                        $nama    = ucwords($_POST['nama']);
                        $telp    = $_POST['telp'];
                        $email   = $_POST['email'];
                        $alamat  = ucwords($_POST['alamat']);
                        $user    = $_POST['user'];

                        $ubah    = mysqli_query($hasil, "UPDATE tbl_admin SET  
                                        admin_name       = '".$nama."',
                                        admin_telp       = '".$telp."',
                                        admin_email      = '".$email."',
                                        admin_address    = '".$alamat."',
                                        Username         = '".$user."'
                                        WHERE admin_id ='".$d->admin_id."' ");
                                    if($ubah) {
                                        echo '<script>alert("Selamat, pembaharuan data anda berhasil")</script>';
                                        echo '<script>window.location="profil.php"</script>';
                                    }else {
                                        echo 'Maaf, pembaharuan data anda gagal '.mysqli_error($hasil);
                                    }
                                }
               ?>
            </div>
            <h3>Ubah Password</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="Kata Sandi Baru" class="input-control" required>
                   <input type="password" name="pass2" placeholder="Konfirmasi Kata Sandi" class="input-control" required>
                   <input type="submit" name="ubah_pass" value="Ubah Kata Sandi" class="btn">
               </form>
               <?php
                    if(isset($_POST['ubah_pass'])) {
                        $pass1    = $_POST['pass1'];
                        $pass2    = $_POST['pass2'];

                        if($pass2 != $pass1) {
                            echo '<script>alert("Konfirmasi kata sandi tidak sesuai dengan kata sandi baru")</script>';
                        }else {
                            $u_pass    = mysqli_query($hasil, "UPDATE tbl_admin SET 
                                        Password     = '".MD5($pass1)."'
                                        WHERE admin_id ='".$d->admin_id."' ");
                                        if($u_pass) {
                                            echo '<script>alert("Selamat, pembaharuan kata sandi anda berhasil")</script>';
                                            echo '<script>window.location="profil.php"</script>';
                                        }else {
                                            echo 'Maaf, pembaharuan kata sandi anda gagal '.mysqli_error($hasil);
                                        }
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