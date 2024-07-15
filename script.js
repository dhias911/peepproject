// toggle class active
// const navbarNav = document.querySelector(".navbar-nav");
// document.querySelector("#menu").onclick = () => {
//   navbarNav.classList.toggle("active");
// };

//toggle class active shopping cart

const shoppingCart = document.querySelector(".shopping-cart");
document.querySelector("#shopping-cart-button").onclick = (e) => {
  shoppingCart.classList.toggle("active");
  e.preventDefault();
};

// Klik diluar sidebar

const menu = document.querySelector("#menu");
const sc = document.querySelector("#shoppping-cart-button");

document.addEventListener("click", function (e) {
  // if (!menu.contains(e.target) && !navbarNav.contains(e.target)) {
  //   navbarNav.classList.remove("active");
  // }
  if (!sc.contains(e.target) && !shoppingCart.contains(e.target)) {
    shoppingCart.classList.remove("active");
  }
});

//Modal Box

const itemDetailModal = document.querySelector("#item-detail-modal");
const itemDetailButtons = document.querySelectorAll(".item-detail-button");

itemDetailButtons.forEach((btn) => {
  btn.onclick = (e) => {
    itemDetailModal.style.display = "flex";
    e.preventDefault();
  };
});

// tombol close modal

document.querySelector(".modal .close-icons").onclick = (e) => {
  itemDetailModal.style.display = "none";
  e.preventDefault();
};

// klik diluar modal

window.onclick = (e) => {
  if (e.target === itemDetailModal) {
    itemDetailModal.style.display = "none";
  }
};
