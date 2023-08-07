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


// Cart functions

const actions = {
    add: "add",
    substract: "substract"
}


function add(productId, element) {
    fetch("http://localhost:80/api/cart", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            productId
        })
    })
    .then(res => res.json())
    .then(res => {
        if (!res.error) {
            
        }
    })
}

function editAmount(productId, element, action) {
    const buttons = element.querySelectorAll("button");
    const amount = element.querySelector(".amount > p");

    for (const button of buttons) {
        button.classList.add("btn-disabled")
    }

    fetch("http://localhost:80/api/cart", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            productId: productId,
            action: action
        })
    })
        .then(res => res.json())
        .then(res => {
            for (const button of buttons) {
                button.classList.remove("btn-disabled")
            }
            if (res.amount < 2) {
                buttons[0].classList.add("btn-disabled")
            }
            amount.innerHTML = res.amount
        })
}

function remove(productId, element) {
    fetch("http://localhost:80/api/cart/?product=" + productId, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
    })
    .then(res => res.json())
    .then(res => {
        if (!res.error) {
            element.remove();
            alert(res.message);
        }
    })
}

const cartItems = document.querySelectorAll(".cart-item");

for (const item of cartItems) {
    const productId = item.dataset.product;
    
    item.querySelector('button[data-action="substract"]').addEventListener("click", () => {
        editAmount(productId, item, actions.substract);
    })

    item.querySelector('button[data-action="add"]').addEventListener("click", () => {
        editAmount(productId, item, actions.add);
    })

    item.querySelector('button[data-action="remove"]').addEventListener("click", () => {
        remove(productId, item)
    })
}

const products = document.querySelectorAll(".product")

for (const product of products) {
    const productId = product.dataset.product;

    product.querySelector('button[data-action="addToCart"]').addEventListener("click", () => {
        add(productId, product)
    })
}