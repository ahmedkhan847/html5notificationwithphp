<?php include 'conn.php';?>
<!DOCTYPE html PUBLIC "-#W3C#DTD XHTML 1.0 Transitional#EN" "http:#www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>
            Using HTML5 Notifications With PHP
        </title>
    </head>
    <body>

                <div>


                            <label class="sr-only" for="todo">
                                To Do:
                            </label>
                            <textarea type="text" class="form-control" id="todo" row="3">
                            </textarea>

                        <button onclick='AddList()' class="btn btn-default">
                            Submit
                        </button>

                </div>

            <div id="tablelist">

                    <legend>
                        <h1>
                            To List
                        </h1>
                    </legend>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        List NO:
                                    </th>
                                    <th>
                                        Todo
                                    </th>
                                    <th>
                                      Options
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$con    = OpenConn();
$stmt   = "SELECT * FROM list";
$result = $con->
query($stmt);
if ($result->
    num_rows >
    0) {
    while ($row = $result->
        fetch_assoc()) {
        echo '
                                <tr>
                                    ';
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['what'] . "</td><td><button class='btn btn-success'  id='" . $row['id'] . "' onclick='DelList(id)'>-</button></td>";
        echo '
                                </tr>
                                ';
    }
    $con->close();
} else {
    echo '
                                <tr> <td>No List</td> </tr>
                                    ';
    $con->close();
}
?>
                                </tbody>
                          </table>
                            </div>


                    <!-- jQuery library -->
                    <script src="js/jquery.min.js">
                    </script>

                    <script src="js/custom.js">

                    </script>
                </body>
            </html>
