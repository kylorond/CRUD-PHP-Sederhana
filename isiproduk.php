<?php
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($hasil, "SELECT admin_name, admin_telp, admin_email, admin_address FROM tbl_admin WHERE admin_id = 1");
    $a      = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-witdh, initial-scale=1">
    <title>Produk | Traborn</title>
    <link rel="stylesheet" type="text/css" href="tampilan.css">
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
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari" value="<?php echo $_GET['search'] ?> ">
            </form>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
            <h3>Produk</h3>
            <div class="box">
                <?php
                    if($_GET['search'] !='' || $_GET['kat'] != ''){
                        $dimana = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
                    }
                    $produk = mysqli_query($hasil, "SELECT * FROM tbl_produk WHERE product_status = 1 $dimana ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0) {
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                <div class="col-4">
                    <img src="gambarproduk/<?php echo $p['product_image'] ?>">
                    <p class="nama"><?php echo $p['product_name'] ?></p>
                    <p class="harga">Rp. <?php echo number_format($p ['product_price']) ?></p>
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