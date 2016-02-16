<?php

function OpenConn()
{
    $conn = new mysqli("localhost", "root", "", "todo") or die($conn->connect_error);

    return $conn;
}
