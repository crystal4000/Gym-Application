<?php

function getTotalNum($table) {
    global $mysqli;

    $sql = "SELECT * FROM $table";
    $query = mysqli_query($mysqli, $sql);

    if ($query) {
        return mysqli_num_rows($query);
    } else {
        return false;
    }
}

function getPackages() {
    global $mysqli;

    $sql = "SELECT * FROM packages";
    $query = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($query) > 0) {
        return $query;
    } else {
        return false;
    }
}

function getRegisteredUsers($package) {
    global $mysqli;

    $sql = "SELECT * FROM members WHERE package = '$package'";
    $query = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($query) > 0) {
        return $query;
    } else {
        return false;
    }
}
