<?php
    include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Pendaftaran Admin | Traborn </title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="">Traborn (Traditional Borneo) </a></h1>
        </div>   
    </header>
    <div class="section">
        <div class="container">
            <h3>Daftar</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                   <input type="text" name="nama" class="input-control" placeholder="Nama Lengkap" required>
                   <input type="text" name="telp" class="input-control" placeholder="Nomor Telepon" required>
                   <input type="text" name="email" class="input-control" placeholder="Alamat Email" required>
                   <input type="text" name="alamat" class="input-control" placeholder="Alamat" required>
                   <input type="text" name="user" class="input-control" placeholder="Nama Pengguna" required>
                   <input type="password" name="pass" class="input-control" placeholder="Kata Sandi" required>
                   <input type="submit" name="submit" value="Daftar" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $nama          = $_POST['nama'];
                        $telp          = $_POST['telp'];
                        $email         = $_POST['email'];
                        $alamat        = $_POST['alamat'];
                        $user          = $_POST['user'];
                        $pass          = $_POST['pass'];

                            $insert = mysqli_query($hasil, "INSERT INTO tbl_admin VALUES (
                                    null, 
                                    '".$nama."',
                                    '".$telp."',
                                    '".$email."',
                                    '".$alamat."',
                                    '".$user."',
                                    '".MD5($pass)."'
                                )");
                                if($insert) {
                                    echo '<script>alert("Pendaftaran anda berhasil, silahkan masuk!")</script>';
                                    echo '<script>window.location="masuk.php"</script>';
                                }else {
                                    echo 'Pendaftaran anda gagal'.mysqli_error($hasil);
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