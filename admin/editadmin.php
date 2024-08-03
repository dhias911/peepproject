<?php
    include '../config.php';

    $productId = null;
    $product = null;

    if (isset($_GET['product-id'])) {
        $productId = mysqli_real_escape_string($conn, $_GET['product-id']);
        $rows = mysqli_query($conn, "SELECT * FROM products WHERE `id` = $productId LIMIT 1");
        $product = mysqli_fetch_assoc($rows);
    }

    if (isset($_POST['Simpan'])) {
        $filePath = null;

        if ($_FILES['foto']['name'] !== '') {
            $folderPath = '../img/product/';
            $filePath = $folderPath . basename($_FILES['foto']['name']);

            $uploaded = move_uploaded_file($_FILES['foto']['tmp_name'], $filePath);

            if (! $uploaded) {
                header('Location: editadmin.php?product-id=' . $productId);
                return;
            }

            if (file_exists($product['image'])) {
                unlink($product['image']);
            }
        }

        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $harga = mysqli_real_escape_string($conn, $_POST['harga']);

        $query = null;

        if ($filePath) {
            $query = "UPDATE products SET `name` = '$nama', `price` = $harga, `image` = '$filePath' WHERE `id` = $productId LIMIT 1";
        } else {
            $query = "UPDATE products SET `name` = '$nama', `price` = $harga WHERE `id` = $productId LIMIT 1";
        }

        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: indexadmin.php');
        }
    }

    if (isset($_POST['Hapus'])) {
        $result = mysqli_query($conn, "DELETE FROM products WHERE `id` = $productId LIMIT 1;");

        if ($result) {
            header('Location: indexadmin.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tambah Produk</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
</head>
<body>

<div class="sidebar">
    <h2>Admin</h2>
    <ul>
        <!-- <li><a href="#"><i class="fas fa-home"></i> Home</a></li> -->
        <li><a href="indexadmin.php"><i class="fas fa-box"></i> Produk</a></li>
        <!-- <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li> -->
        <li><a href="loginadmin.php"><i class="fas fa-sign-out-alt" ></i> Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <h1>Edit Produk</h1>
    </div>
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required value="<?php echo $product['name']; ?>">
            </div>
            <div>
                <!-- <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih satu</option> -->
                    <!-- Add options dynamically or statically here -->
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" required value="<?php echo $product['price'] ?>">
            </div>
            <div>
                <label for="foto">Foto Produk</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <!-- <label for="detail">Detail Produk</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea> -->
            </div>
            <div>
                <!-- <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option> -->
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                <button type="submit" class="btn btn-primary" name="Hapus">Hapus</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
