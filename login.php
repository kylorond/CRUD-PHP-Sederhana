<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title> Masuk | Dayak Store </title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Masuk</h2>
        <form action="masuk.php" method="POST">
            <input type="text" name="user" placeholder="Nama Pengguna" class="input-control">
            <input type="password" name="pass" placeholder="Kata Sandi" class="input-control">
            <input type="submit" name="submit" value="MASUK" class="btn">
        </form>
        <?php
            if(isset($_POST['submit'])) {
                session_start ();
                include 'db.php';

                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $cek = mysqli_query($result, "SELECT * FROM tbl_admin WHERE Username = '".$user."' AND Password = '".MD5($pass)."'");
                if(mysqli_num_rows($cek) > 0){
                    $d = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['a_global'] = $d;
                    $_SESSION['id'] = $d->admin_id;
                    echo '<script>window.location="dashboard.php"</script>';
                } else {
                    echo '<script>alert("Nama Pengguna atau Kata Sandi yang anda masukan salah!")</script>';
                }
            }
        ?>
    </div>
</body>
</html>