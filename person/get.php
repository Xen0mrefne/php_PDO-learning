<?php

require "/xampp/htdocs/person/tableCheck.php";

try {
    require "/xampp/htdocs/db/connection.php";

    $stmt = $conn->prepare("SELECT * FROM Person");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $results = $stmt->fetchAll();

    if (!empty($results)){
        ?>
            <table class="person-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Register date</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($results as $person) {
                        ?>
                            <tr>
                                <td><?php echo $person["id"] ?></td>
                                <td><?php echo $person["firstName"] ?></td>
                                <td><?php echo $person["lastName"] ?></td>
                                <td><?php echo $person["email"] ?></td>
                                <td><?php echo $person["reg_date"] ?></td>
                                <td class="action-col"><a href="?PEdit=<?php echo $person["id"] ?>" class="btn btn-blue btn-hover">Edit</a></td>
                                <td class="action-col"><a href="?PDelete=<?php echo $person["id"] ?>" class="btn btn-red btn-hover">Delete</a></td>
                            </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        ?>
            <p style="text-align: center">No persons found. You can try to add some!</p>
        <?php
    }


} catch (PDOException $e) {
    echo $e->getMessage();
}

$conn = null;

?>