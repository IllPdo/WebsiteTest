<?php
include "db.php";

function checkUsername($connection, $user)
{
    $check = $connection->query(
        "SELECT * FROM users WHERE username = '$user'"
    );

    return $check->num_rows > 0;
}

function myQuery($connection, $query)
{
    return $connection->query($query);
}
