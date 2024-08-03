<?php
    include '../config.php';

    $rows = mysqli_query($conn, "SELECT * FROM products");
    $currentRow = mysqli_fetch_assoc($rows);

    if (isset($_POST['simpan'])) {
        $folderPath = '../img/product/';
        $filePath = $folderPath . basename($_FILES['foto']['name']);
    
        $uploaded = move_uploaded_file($_FILES['foto']['tmp_name'], $filePath);
    
        if (! $uploaded) {
            header('Location: indexadmin.php');
            return;
        }
    
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    
        $result = mysqli_query($conn, "INSERT INTO products (`name`, `image`, `price`) VALUE ('$nama', '$filePath', '$harga')") or die('query failed');

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
        <li><a href="#"><i class="fas fa-box"></i> Produk</a></li>
        <!-- <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li> -->
        <li><a href="logoutadmin.php?logout=1"><i class="fas fa-sign-out-alt" ></i> Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <h1>Tambah Produk</h1>
    </div>
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <!-- <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih satu</option>
                </select> -->
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" required>
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
                    <option value="habis">Habis</option>
                </select> -->
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>
    </div>
    <div class="mt-3 mb-5">
             <h2>List Produk</h2>
             <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($currentRow) { ?>
                            <tr>
                                <td><?php echo $currentRow['id'] ?></td>
                                <td><?php echo $currentRow['name'] ?></td>
                                <td><?php echo $currentRow['price'] ?></td>
                                <td><a href=<?php echo 'editadmin.php?product-id=' . $currentRow['id'] ?>>Edit</a></td>
                            </tr>
                            <?php $currentRow = mysqli_fetch_assoc($rows) ?>
                        <?php } ?>
                    </tbody>
                </table>
             </div>
        </div>
</div>

</body>
</html>
