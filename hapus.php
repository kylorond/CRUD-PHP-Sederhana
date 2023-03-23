<?php
    include 'db.php';
    if(isset($_GET['idk'])){
        $hapus = mysqli_query($hasil, "DELETE FROM tbl_kategori WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="kategori.php"</script>';
    }
    if(isset($_GET['idp'])) {
        $produk = mysqli_query($hasil, "SELECT product_image FROM tbl_produk WHERE product_id= '".$_GET['idp']."' ");
        $p      = mysqli_fetch_object($produk);
        unlink('./Produk/'.$p->product_image);
        $hapus  = mysqli_query($hasil, "DELETE FROM tbl_produk WHERE product_id = '".$_GET['idp']."' ");
        echo '<script>window.location="produk.php"</script>';
    }
?>