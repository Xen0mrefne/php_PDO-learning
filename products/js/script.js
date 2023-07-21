const addBtn = document.getElementById("add-product-show");

addBtn.addEventListener("click", () => {
    const addMenu = document.querySelector(".add-menu");
    addMenu.classList.add("active")
})

const closeBtn = document.querySelector("form .cancel");

closeBtn.addEventListener("click", () => {
    const addMenu = document.querySelector(".add-menu");
    addMenu.classList.remove("active")
})