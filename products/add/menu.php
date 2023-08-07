<div class="add-menu <?php if(!empty($_SESSION["errors"])) echo "active" ?>">
    <form action="./add/action.php" method="post">
        <div class="form-input">
            <label for="productName">Product name:</label>
            <input class="input" id="productName" name="productName" type="text">
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
            <input class="input" id="productDesc" name="productDesc" type="text">
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
            <input class="input" id="productPrice" name="productPrice" type="number">
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
            <button class="btn btn-black btn-hover cancel" type="button">Cancel</button>
            <button class="btn btn-green btn-fill" type="submit">Add</button>
        </div>
    </form>
</div>

<?php

$_SESSION["errors"] = null;

?>