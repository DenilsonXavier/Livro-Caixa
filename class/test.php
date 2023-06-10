<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de PDV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Sistema de Ponto de Venda</h1>

        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="product-name">Nome do Produto</label>
                        <input type="text" class="form-control" id="product-name" placeholder="Digite o nome do produto">
                    </div>
                    <div class="form-group">
                        <label for="product-price">Preço do Produto</label>
                        <input type="number" class="form-control" id="product-price" placeholder="Digite o preço do produto">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addProduct()">Adicionar Produto</button>
                </form>
            </div>
            <div class="col-md-6">
                <h4>Carrinho de Compras</h4>
                <ul id="product-list" class="list-group">
                </ul>
                <div id="total-price" class="mt-3">
                    <strong>Total: R$ 0</strong>
                </div>
                <button type="button" class="btn btn-success mt-3" onclick="checkout()">Finalizar Compra</button>
            </div>
        </div>
    </div>

    <script>
        let products = [];
        let totalPrice = 0;

        function addProduct() {
            const productName = document.getElementById("product-name").value;
            const productPrice = parseFloat(document.getElementById("product-price").value);

            if (productName && !isNaN(productPrice)) {
                const product = {
                    name: productName,
                    price: productPrice
                };

                products.push(product);
                totalPrice += productPrice;

                const productItem = document.createElement("li");
                productItem.className = "list-group-item";
                productItem.textContent = productName + " - R$ " + productPrice.toFixed(2);

                document.getElementById("product-list").appendChild(productItem);

                document.getElementById("product-name").value = "";
                document.getElementById("product-price").value = "";

                updateTotalPrice();
            }
        }

        function updateTotalPrice() {
            document.getElementById("total-price").innerHTML = "<strong>Total: R$ " + totalPrice.toFixed(2) + "</strong>";
        }

        function checkout() {
            if (products.length > 0) {
                // Lógica para finalizar a compra

                // Resetar carrinho de compras
                products = [];
                totalPrice = 0;
                document.getElementById("product-list").innerHTML = "";
                updateTotalPrice();

                alert("Compra finalizada!");
            } else {
                alert("Nenhum produto no carrinho.");
            }
        }
    </script>
</body>
</html>
