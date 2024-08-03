document.addEventListener("alpine:init", async () => {
  // const connection = await mysql.createConnection({
  //   host: 'auth-db1416.hstgr.io',
  //   user: '',
  //   database: 'u252033518_peep'
  // });

  // const [results, _] = await connection.query(`SELECT * FROM products`);
  Alpine.data("products", () => ({
    items: [
      { id: 1, name: "Custom Sepatu", img: "product1.jpg", price: 250000 },
      { id: 2, name: "Custom Tas", img: "product2.jpg", price: 280000 },
      { id: 3, name: "Custom Jaket", img: "product3.jpg", price: 300000 },
      { id: 4, name: "Custom Sepatu 2", img: "product4.jpg", price: 250000 },
      { id: 5, name: "Custom Sepatu 3", img: "product5.jpg", price: 250000 },
      { id: 6, name: "Custom Sepatu 4", img: "product6.jpg", price: 250000 },
      { id: 7, name: "Custom ToteBag", img: "product7.jpg", price: 250000 },
      { id: 8, name: "Custom Celana", img: "product8.jpg", price: 250000 },
      { id: 9, name: "Custom Sepatu 5", img: "product9.jpg", price: 250000 },
      { id: 10, name: "Custom Jaket 2", img: "product10.jpg", price: 300000 },
      { id: 11, name: "Custom Jaket 3", img: "product11.jpg", price: 300000 },
      { id: 12, name: "Custom Sepatu 6", img: "product12.jpg", price: 250000 },
      { id: 13, name: "Custom Tas 2", img: "product13.jpg", price: 280000 },
      { id: 14, name: "Custom Tas 3", img: "product14.jpg", price: 280000 },
      { id: 15, name: "Custom Sepatu 7", img: "product15.jpg", price: 250000 },
      { id: 16, name: "Custom Jaket 4", img: "product16.jpg", price: 300000 },
    ],
  }));

  // const response = await fetch("localhost/test/api/products.php", {
  //   headers: {
  //     Accept: "application/json",
  //   },
  // });
  // console.log(response.headers.get("Content-Type"));

  // Alpine.data("products", () => ({
  //   items: data,
  // }));

  // try {
  //   const response = await fetch("api/products.php");
  //   const data = await response.json();

  //   Alpine.data("products", () => ({
  //     items: data,
  //   }));
  // } catch (error) {
  //   console.error(error);
  // }

  // try {
  //   const connection = await mysql2.createConnection({
  //     host: "localhost",
  //     user: "root",
  //     database: "shop_db",
  //   });

  //   const [results, _] = await connection.query("SELECT * FROM products");

  //   Alpine.data("products", () => ({
  //     items: results,
  //   }));
  // } catch (error) {
  //   console.error(error);
  // }

  Alpine.store("cart", {
    items: [],
    total: 0,
    quantity: 0,
    add(newItem) {
      //cek apakah ada barang yang sasma di cart
      const cartItem = this.items.find((item) => item.id === newItem.id);

      //jika blm ada / cart masih kosong
      if (!cartItem) {
        this.items.push({ ...newItem, quantity: 1, total: newItem.price });
        this.quantity++;
        this.total += newItem.price;
      } else {
        //jika barang sudah ada, cek apakah barang beda atau sama dengan yang ada di cart
        this.items = this.items.map((item) => {
          //jika barang berbeda
          if (item.id !== newItem.id) {
            return item;
          } else {
            //jika barang sudah ada, tambah quantity dan totalnya
            item.quantity++;
            item.total = item.price * item.quantity;
            this.quantity++;
            this.total += item.price;
            return item;
          }
        });
      }
    },
    remove(id) {
      //ambil item yang mau di remove
      const cartItem = this.items.find((item) => item.id === id);

      //jika item lebih dari 1
      if (cartItem.quantity > 1) {
        //telusuri 1 1
        this.items = this.items.map((item) => {
          //jika bukan barang yang diklik
          if (item.id !== id) {
            return item;
          } else {
            item.quantity--;
            item.total = item.price * item.quantity;
            this.quantity--;
            this.total -= item.price;
            return item;
          }
        });
      } else if (cartItem.quantity === 1) {
        //jika barangnya sisa 1
        this.items = this.items.filter((item) => item.id !== id);
        this.quantity--;
        this.total -= cartItem.price;
      }
    },
  });
});

// Form validation
const checkoutButton = document.querySelector(".checkout-button");
checkoutButton.disabled = true;

const form = document.querySelector("#checkoutForm");

form.addEventListener("keyup", function () {
  for (let i = 0; i < form.elements.length; i++) {
    if (form.elements[i].value.length !== 0) {
      checkoutButton.classList.remove("disabled");
      checkoutButton.classList.add("disabled");
    } else {
      return false;
    }
  }
  checkoutButton.disabled = false;
  checkoutButton.classList.remove("disabled");
});

// Kirim data ketika tombol checkout di klik

checkoutButton.addEventListener("click", async function (e) {
  e.preventDefault();
  const formData = new FormData(form);
  const data = new URLSearchParams(formData);
  const objData = Object.fromEntries(data);
  // const message = formatMessage(objData);
  // console.log(objData);
  // window.open("http://wa.me/6285880325181?text=" + encodeURIComponent(message));

  // minta transaction token menggunakan ajax / fetch
  try {
    const respons = await fetch("order/placeOrder.php", {
      method: "POST",
      body: data,
    });
    const token = await respons.text();
    // console.log(token);
    window.snap.pay(token, {
      onSuccess: function (result) {
        /* You may add your own implementation here */
        alert("payment success!");
        console.log(result);
      },
      onPending: function (result) {
        /* You may add your own implementation here */
        alert("wating your payment!");
        console.log(result);
      },
      onError: function (result) {
        /* You may add your own implementation here */
        alert("payment failed!");
        console.log(result);
      },
      onClose: function () {
        /* You may add your own implementation here */
        alert("you closed the popup without finishing the payment");
      },
    });
  } catch (err) {
    console.log(err.message);
  }
});

// format wa
// const formatMessage = (obj) => {
//   return `Data Customer
//   Nama: ${obj.name}
//   Email: ${obj.email}
//   No HP: ${obj.phone}
// Data Pesanan
//   ${JSON.parse(obj.items).map(
//     (item) => `${item.name} (${item.quantity} x ${rupiah(item.total)}) \n`
//   )}
//   TOTAL: ${rupiah(obj.total)}
// Terima Kasih`;
// };

// konversi ke Rupiah

const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(number);
};
