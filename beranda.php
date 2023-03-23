<?php
    include 'db.php';
    $kontak = mysqli_query($hasil, "SELECT admin_name, admin_telp, admin_email, admin_address FROM tbl_admin WHERE admin_id = 1");
    $a      = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title>Beranda | Traborn</title>
    <link rel="stylesheet" type="text/css" href="Tampilan.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="beranda.php">Traborn (Traditional Borneo) </a></h1>
        <ul>
            <li><a href="isiproduk.php">Produk</a></li>
        </ul>
        </div>   
    </header>
    <div class="search">
        <div class="container">
            <form action="isiproduk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari">
            </form>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($hasil, "SELECT * FROM tbl_kategori ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0) {
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                <a href="isiproduk.php?kat=<?php echo $k['category_id'] ?>">
                <div class="col-5">
                    <img src="img/icon-category.png" width="50px" style="margin-bottom:5px;">
                    <p><?php echo $k['category_name'] ?></p>
                </div>
                </a>
                <?php }}else { ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($hasil, "SELECT * FROM tbl_produk ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0) {
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                <div class="col-4">
                    <img src="gambarproduk/<?php echo $p['product_image'] ?>">
                    <p class="nama"><?php echo $p['product_name'] ?></p>
                    <p class="harga">Rp. <?php echo $p ['product_price'] ?></p>
                </div>
                </a>
                <?php }}else { ?>
                    <p>Produk tidak ada atau tidak tersedia</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <h4>Tentang :</h4>
            <p>Website sederhana</p>
            <p>Makanan dan kerajinan khas Kalimantan</p>
            <h4>Alamat :</h4>
            <p>Jl. G. Obos XII Jl. Siam No. 32 73711</p>
            <p>Indonesia</p>
            <h4>Kontak :</h4>
            <p>WA    : 08125811770</p>
            <p>Email : ronaldodwi.rd@gmail.com</p>
            <small>Copyright &copy; 2021 - Ronaldo Dwi Anaku Aminu</small>
        </div>
    </div>
</body>
</html>