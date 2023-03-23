<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Masuk | Traborn </title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Masuk</h2>
        <form action="masuk.php" method="POST">
            <input type="text" name="user" placeholder="Nama Pengguna" class="input-control">
            <input type="password" name="pass" placeholder="Kata Sandi" class="input-control">
            <input type="submit" name="submit" value="MASUK" class="btn"><br>
            <a href="daftar.php">Belum memiliki akun? klik di sini</a>
        </form>
        <?php
            if(isset($_POST['submit'])) {
                session_start ();
                include 'db.php';

                $user = mysqli_real_escape_string ($hasil, $_POST['user']);
                $pass = mysqli_real_escape_string ($hasil, $_POST['pass']);

                $cek = mysqli_query($hasil, "SELECT * FROM tbl_admin WHERE Username = '".$user."' AND Password = '".MD5($pass)."'");
                if(mysqli_num_rows($cek) > 0){
                    $d = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['a_global']     = $d;
                    $_SESSION['id']           = $d->admin_id;
                    echo '<script>window.location="laman.php"</script>';
                } else {
                    echo '<script>alert("Nama Pengguna atau Kata Sandi yang anda masukan salah!")</script>';
                }
            }
        ?>
    </div>
</body>
</html>