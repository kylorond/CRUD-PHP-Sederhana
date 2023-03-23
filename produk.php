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
    <title> Data Produk | Traborn </title>
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
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">Tambah Produk</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Pilih</th>
                        </tr>
                    </thead>
                    <body>
                        <?php
                            $no = 1;
                            $produk = mysqli_query($hasil, "SELECT * FROM tbl_produk LEFT JOIN tbl_kategori USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0) {
                            while($row = mysqli_fetch_array($produk)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><a href="gambarproduk/<?php echo $row['product_image']?>"target="_blank"><img src="gambarproduk/<?php echo $row['product_image']?>"width="50px"></a></td>
                            <td><?php echo ($row['product_status'] == 0)? 'Tidak tersedia':'Tersedia'; ?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row ['product_id'] ?>">Edit</a> |
                                <a href="hapus.php?idp=<?php echo $row ['product_id'] ?>"onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else {?>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
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