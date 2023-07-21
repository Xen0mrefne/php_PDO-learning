<form action="http://localhost:80/users/add/action.php" method="post">
    <div class="form-input">
        <label for="firstName">First Name:</label>
        <input class="input" id="firstName" name="firstName" type="text" placeholder="First name">
        <?php
            if (isset($_SESSION["errors"]["firstName"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["firstName"] ?></p>
                <?php
            }
        ?>
    </div>
    <div class="form-input">
        <label for="lastName">Last Name:</label>
        <input class="input" id="lastName" name="lastName" type="text" placeholder="Last name">
        <?php
            if (isset($_SESSION["errors"]["lastName"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["lastName"] ?></p>
                <?php
            }
        ?>
    </div>
    <div class="form-input">
        <label for="email">Email:</label>
        <input class="input" id="email" name="email" type="text" placeholder="Email">
        <?php
            if (isset($_SESSION["errors"]["email"])) {
                ?>
                    <p style="color: red; font-size: 12px"><?php echo $_SESSION["errors"]["email"] ?></p>
                <?php
            }
        ?>
    </div>
    <button class="btn btn-green btn-fill" type="submit">Add</button>
</form>