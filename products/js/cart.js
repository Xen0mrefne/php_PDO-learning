function substractAmount(productId) {

}

function addAmount(productId) {

}

fetch("http://localhost:80/api/cart", {
    method: "GET",
    headers: {
        "Content-Type": "application/json"
    }
})
.then(res => res.json())
.then(res => console.log(res))

fetch("http://localhost:80/api/cart", {
    method: "PUT",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        productId: 1,
        change: "add"
    })
})
.then(res => res.json())
.then(res => console.log(res))