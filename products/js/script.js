const addProductBtn = document.getElementById("add-product-show");
const openCartBtn = document.getElementById("cart-show");

const closeAddBtn = document.querySelector("form .cancel");
const closeCartBtn = document.querySelector(".cart .close")


const addMenu = document.querySelector(".add-menu");
const cartMenu = document.querySelector(".cart")


addProductBtn.addEventListener("click", () => {
    addMenu.classList.add("active")
    cartMenu.classList.remove("active")
})

closeAddBtn.addEventListener("click", () => {
    addMenu.classList.remove("active")
})

openCartBtn.addEventListener("click", () => {
    cartMenu.classList.add("active")
    addMenu.classList.remove("active")
})

closeCartBtn.addEventListener("click", () => {
    cartMenu.classList.remove("active")
})