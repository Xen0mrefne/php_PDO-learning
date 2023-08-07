<?php

try {
    require(__DIR__."/../../db/connection.php");
    require(__DIR__."/../../utils/security.php");
    
    $stmt = $conn->prepare("SELECT * FROM Products WHERE id=:productId");
    $stmt->bindParam(":productId", $productId);
    $productId = sanitize($_GET["PEdit"]);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    $_SESSION["product-edit"] = $productId;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<div class="edit-form-wrapper">
    <form class="product-edit-form" action="./edit/action.php" method="post">
        <div class="form-input">
            <label for="productName">Product name:</label>
            <input class="input" id="productName" name="productName" type="text" value="<?php echo $product["productName"] ?>">
            <?php         
                if (isset($_SESSION["errors"]["productName"])) {
                    ?>
                        <p style="color: red; font-size: 12px">
                            <?php echo $_SESSION["errors"]["productName"] ?>
                        </p>
                    <?php
                }
            ?>
        </div>
        <div class="form-input">
            <label for="productDesc">Product description:</label>
            <input class="input" id="productDesc" name="productDesc" type="text" value="<?php echo $product["productDesc"] ?>">
            <?php         
                if (isset($_SESSION["errors"]["productDesc"])) {
                    ?>
                        <p style="color: red; font-size: 12px">
                            <?php echo $_SESSION["errors"]["productDesc"] ?>
                        </p>
                    <?php
                }
            ?>
        </div>
        <div class="form-input">
            <label for="productPrice">Price(ARS):</label>
            <input class="input" id="productPrice" name="productPrice" type="number" value="<?php echo $product["productPrice"] ?>">
            <?php         
                if (isset($_SESSION["errors"]["productPrice"])) {
                    ?>
                        <p style="color: red; font-size: 12px">
                            <?php echo $_SESSION["errors"]["productPrice"] ?>
                        </p>
                    <?php
                }
            ?>
        </div>
        <div class="form-input">
            <label for="productStock">Stock:</label>
            <input class="input" id="productStock" name="productStock" type="number">
            <?php         
                if (isset($_SESSION["errors"]["productStock"])) {
                    ?>
                        <p style="color: red; font-size: 12px">
                            <?php echo $_SESSION["errors"]["productStock"] ?>
                        </p>
                    <?php
                }
            ?>
        </div>
        <div class="options">
            <a href="http://localhost:80/products" class="btn btn-black btn-hover cancel">Cancel</a>
            <button class="btn btn-green btn-fill" type="submit">Edit</button>
        </div>
    </form>
</div>

<?php

$_SESSION["errors"] = null;

?>