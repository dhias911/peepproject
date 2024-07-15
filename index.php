<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];


// $_SESSION['status'] = 1;//if logged in
// $_SESSION['status'] = 0;//if logged out
// if( isset($_SESSION['name']) && !empty($_SESSION['name']) )
// {
//     // User is logged in, show logout menu here
// }
// else
// {
//     // User is not logged in, show login menu here
// }
// if(!isset($user_id)){
//    header('location:login.php');
// };

// if(isset($_GET['logout'])){
//    unset($user_id);
//    session_destroy();
//    header('location:login.php');
// };


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>peepproject</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- App -->
    <script src="src/app.js" async></script>

    <!-- Midtrans -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-rNE46l80f5xbfX6c"></script>

  </head>
  <body>

  <?php
if(isset($messsage)){
   foreach($messsage as $mes){
      echo '<div class="message" onclick="this.remove();">'.$mes.'</div>';
   }
}
?>


    <!-- Navbar start -->

    <nav class="navbar" x-data>

    <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `register` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>


    <!-- <p> username : <span><?php echo $fetch_user['name']; ?></span> </p> -->

      <a href="#" class="navbar-logo">peep<span>project_</span></a>

      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#contact">Kontak</a>
        <a href="#products">Produk</a>
      </div>

      <div class="navbar-extra">

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
          <a href="logout.php?logout=1" id="logout" onclick="confirm('Apa anda ingin logout?')"><i><i data-feather="log-out"></i></i></a>
        <?php } else { ?>
          <a href="login.php" id="user"><i><i data-feather="user"></i></i></a>
        <?php } ?>
        <a href="#" id="shopping-cart-button"
          >
          <i><i data-feather="shopping-cart"></i></i
        >
      <span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
      </a>
        <!-- <a href="#" id="menu"
          ><i><i data-feather="menu"></i></i
        ></a> -->
        <!-- <a href="#" id="log-out"
          ><i><i data-feather="log-out"></i></i
        ></a> -->
      </div>

      <!-- Shopping Cart Start -->

<div class="shopping-cart">
  <template x-for="(item, index) in $store.cart.items" x-key="index">
<div class="cart-item">
  <img :src="`img/product/${item.img}`" :alt="item.name">
  <div class="item-detail">
    <h3 x-text="item.name"></h3>
    <div class="item-price">
      <span x-text="rupiah (item.price)"></span> &times;
      <button id="remove" @click="$store.cart.remove(item.id)">&minus;</button>
      <span x-text="item.quantity"></span>
      <button id="add" @click="$store.cart.add(item)">&plus;</button>&equals;
      <span x-text="rupiah (item.total)"></span>
    </div>
  </div>
</div>
</template>
<h4 x-show="!$store.cart.items.length" style="margin-top: 1rem;">Cart Is Empty</h4>
<h4 x-show="$store.cart.items.length">Total : <span x-text="rupiah($store.cart.total)"></span></h4>

<div class="form-container" x-show="$store.cart.items.length">
  <form action="" id="checkoutForm">
    <input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
    <input type="hidden" name="total" x-model="$store.cart.total">
    <h5>Customer Detail</h5>

    <label for="name">
      <span>Name</span>
      <input type="text" name="name" id="name">
    
      <label for="email">
      <span>Email</span>
      <input type="email" name="email" id="email" >

      <label for="alamat">
      <span>Alamat</span>
      <input type="text" name="alamat" id="alamat" >
    
      <label for="phone">
      <span>Phone</span>
      <input type="number" name="phone" id="phone" autocomplete="off" >
    </label>
    
    <button class="checkout-button disabled" type="submit"  id="checkout-button" value="checkout">Checkout</button>
  </form>
</div>
</div>


      <!-- Shopping Cart End -->
    </nav>

    <!-- Navbar end -->

    <!-- Hero Section start-->
    <section class="hero" id="home">
      <main class="content">
        <h1>CUSTOM PAINT & <span>WEARABLE ART</span></h1>
        <p>
        The beauty of a work of art will speak and be felt by itself through all human senses,
        without the need for words
        </p>
        <a href="#products" class="cta">Order now</a>
      </main>
    </section>

    <!-- Hero Section end-->

    <!-- About Section start -->
    <section id="about" class="about">
      <h2>Tentang <span>Kami</span></h2>

      <div class="row">
        <div class="about-img">
          <img src="img/vans.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa memilih custom gambar dikami?</h3>
          <p>
            Karena kami menggunakan cat yang berkualitas, proses cepat dan efisien.
            Dengan memilih layanan kami, Anda mendapatkan lebih dari sekedar gambar,
            Anda mendapatkan karya seni yang dipersonalisasi dan dirancang dengan cermat
            untuk memenuhi kebutuhan dan ekspetasi anda.
          </p>
        </div>
      </div>
      <div class="pemesanan">
      <h2>Cara <span>Pemesanan</span></h2>
      <p>
        1. Pilih produk yang ingin dipesan.<br>
        2. Tambah ke keranjang.<br>
        3. Isi data pemesanan.<br>
        4. Lalu lakukan checkout dan pembayaran.<br>
        5. Jika sudah selesai transaksi hubungi admin pada nomor WhatsApp yang terdapat di halaman kontak<br>
           untuk memberi tau barang yang ingin di custom dan mengirim barang ke admin.
      </p>
      </div>
    </section>

    <!-- About Section end -->
     
    <!-- Product Section start -->

<section class="products" id="products" x-data="products">
  <h2>Produk <span>Kami</span></h2>
    <div class="row">
    <template x-for="(item, index) in items" x-key="index"> 
      <div class="product-card">
        <div class="product-icons">
        <a href="#" @click.prevent="$store.cart.add(item)">
        <svg
  width="24"
  height="24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#shopping-cart" />
</svg>
        </i></a>
        <!-- <a href="#" class="item-detail-button">
        <svg
  width="24"
  height="24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#eye" /> -->
</svg>
        </a>
      </div>
      <div class="product-image">
        <img :src="`img/product/${item.img}`" :alt="item.name">
      </div>
      <div class="product-content">
        <h3 x-text="item.name"></h3>
        <div class="product-stars">
        <svg
  width="24"
  height="24"
  fill="currentColor"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#star" />
</svg>
<svg
  width="24"
  height="24"
  fill="currentColor"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#star" />
</svg>
<svg
  width="24"
  height="24"
  fill="currentColor"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#star" />
</svg>
<svg
  width="24"
  height="24"
  fill="currentColor"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#star" />
</svg>
<svg
  width="24"
  height="24"
  fill="currentColor"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <use href="img/feather-sprite.svg#star" />
</svg>
        </div>
          <div class="product-price" x-text="rupiah (item.price)"></div>
       </div>
      </div>
    </template>
  </div>
</section>



    <!-- Product Section end -->

    <!-- Contact Section start -->

    <section id="contact" class="contact">
      <h2>Kontak <span>Kami</span></h2>
      <p>
        WhatsApp : 085880325181
      </p>

      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31726.028348036594!2d106.83508165945952!3d-6.296084096342725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f278509ecdf9%3A0xf8c62955ddc9e44a!2sRindam%20Jaya%2C%20Jl.%20Raya%20Condet%20No.26%2C%20RT.1%2FRW.5%2C%20Gedong%2C%20Kec.%20Ps.%20Rebo%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013760!5e0!3m2!1sid!2sid!4v1700762359968!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map"
        ></iframe>

        <!-- <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="nama" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="email" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="no hp" />
          </div>
          <button type="submit" class="btn">kirim pesan</button>
        </form> -->
      </div>
    </section>

    <!-- Contact Section end -->

    <!-- Footer start -->

    <footer>
      <div class="socials">
        <a href="#"><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="twitter"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="creadit">
        <p>Created by <a href="">dhiasdarmawan</a>. | &copy; 2023.</p>
      </div>
    </footer>

    <!-- Footer end -->

<!-- Modal Box start -->

<div class="modal" id="item-detail-modal">
  <div class="modal-container">
    <a href="#" class="close-icons"><i data-feather="x"></i></a>
    <div class="modal-content">
      <img :src="`img/product/${item.img}`" :alt="item.name">
      <div class="produk-content">
        <h3>Product 1</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique libero incidunt vitae, amet recusandae sapiente consequuntur qui rerum optio quia?</p>
        <div class="product-stars">
      <i data-feather="star" class="star-full"></i>
      <i data-feather="star" class="star-full"></i>
      <i data-feather="star" class="star-full"></i>
      <i data-feather="star" class="star-full"></i>
      <i data-feather="star"></i>
    </div>
      <div class="product-price">IDR 200K</div>
      <a href="#"><i data-feather="shopping-cart"></i> <span>add to cart</span></a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Box end -->

    <!--komen-->

    <!--div class="comment-box">
      <h2>Komentar</h2>
      <form>
        <div class="form-group">
          <label for="name">Nama:</label>
          <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
          <label for="comment">Komentar:</label>
          <textarea id="comment" name="comment" rows="4" required></textarea>
        </div>
        <button type="submit">Kirim</button>
      </form>
    </div>

    <!-- Feather icons-->
    <script>
      feather.replace();
    </script>

    <!-- javascript -->
    <script src="script.js"></script>
  </body>
</html>
