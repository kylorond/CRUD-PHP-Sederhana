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
    <title> Kategori | Traborn </title>
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
            <h3>Data Kategori</h3>
            <div class="box">
                <p><a href="tambah-kategori.php">Tambah Kategori</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Pilih</th>
                        </tr>
                    </thead>
                    <body>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($hasil, "SELECT * FROM tbl_kategori ORDER BY category_id DESC");
                            if(mysqli_num_rows($kategori) > 0) {
                            while($row = mysqli_fetch_array($kategori)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td>
                                <a href="edit-kategori.php?id=<?php echo $row ['category_id'] ?>">Edit</a> |
                                <a href="hapus.php?idk=<?php echo $row ['category_id'] ?>"onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }} else { ?>
                            <tr>
                                <td colspan="3">Tidak ada data</td>
                            </tr>
                            <?php } ?>
                    </body>
                </table>
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