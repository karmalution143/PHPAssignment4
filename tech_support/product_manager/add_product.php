<?php
    session_start();
    // get the data from the database
    $productCode = filter_input(INPUT_POST, 'productCode');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $releaseDate = filter_input(INPUT_POST, 'releaseDate');

    switch (true) {
        case ($productCode == null || $name == null || $version == null || $releaseDate == null):
            $_SESSION["add_error"] = "Invalid product data. Check all fields and try again.";
            $url = "../errors/error.php";
            header("Location: " . $url);
            die();
            break;

        default:
            require_once('../model/database.php');

            $timestamp = strtotime($releaseDate);
        if ($timestamp === false) {
            $_SESSION["add_error"] = "Invalid date format. Please use a standard date format YYYY-MM-DD.";
            $url = "../errors/error.php";
            header("Location: " . $url);
            die();
        } else {
            $formattedReleaseDate = date('Y-m-d', $timestamp);
        }

            $query = 'INSERT INTO products
                (productCode, name, version, releaseDate)
                VALUES
                (:productCode, :name, :version, :releaseDate)';

            $statement = $db->prepare($query);
            $statement->bindValue(':productCode', $productCode);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':releaseDate', $formattedReleaseDate);

            $statement->execute();
            $statement->closeCursor();
        }

        $url = "index.php";
        header("Location: " . $url);
        die();
?>