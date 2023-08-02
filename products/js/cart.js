const actions = {
    add: "add",
    substract: "substract"
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

const cartItems = document.querySelectorAll(".cart-item");

for (const item of cartItems) {
    const productId = item.dataset.product;
    
    item.querySelector('button[data-action="substract"]').addEventListener("click", () => {
        editAmount(productId, item, actions.substract);
    })

    item.querySelector('button[data-action="add"]').addEventListener("click", () => {
        editAmount(productId, item, actions.add);
    })
}