<?php include 'conn.php' ?>
<!DOCTYPE html PUBLIC "-#W3C#DTD XHTML 1.0 Transitional#EN" "http:#www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>
            Using HTML5 Notifications With PHP
        </title>
        <link rel="stylesheet" href="./style/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-offset-md-4 col-md-8 form-inline">
                    
                        
                            <label class="sr-only" for="todo">
                                To Do
                            </label>
                            <textarea type="text" class="form-control" id="todo" row="3">
                            </textarea>
                     
                        <button onclick='AddList()' class="btn btn-default">
                            Submit
                        </button>
                   
                </div>
            </div>
            <div class="row" id="tablelist">
                <div class="col-offset-md-4 col-md-4" id="tablelist">
                    <legend>
                        <h1>
                            To List
                        </h1>
                    </legend>
                    <div class="table-responsive" >
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
                                $con = OpenConn();
                                $stmt = "SELECT * FROM list";
                                $result = $con->
                                query($stmt);
                                if ($result->
                                num_rows >
                                0) {
                                while($row = $result->
                                fetch_assoc())
                                {
                                echo '
                                <tr>
                                    ';
                                    echo "<td>".$row['id']."</td>";
                                    echo "<td>".$row['what']."</td><td><button class='btn btn-success'  id='".$row['id']."' onclick='DelList(id)'><span id='delete'class='glyphicon glyphicon-trash'></span></button></td>";
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
                        </div>
                    </div>
                    <!-- jQuery library -->
                    <script src="style/js/jquery.min.js">
                    </script>
                    <script src="style/js/bootstrap.min.js">
                    </script>
                    <script type="text/javascript">
                        Notification.requestPermission();
                        function AddList()
                        {
                          var to = $('#todo').val();
                        $.ajax({
                        url: "work.php",
                        type: "post",
                        async : true,
                        cache: false,
                        data: { 'todo' : to},
                        success: function(data) {
                        if(data == 'true')
                        {
                        // Let's check if the browser supports notifications
                        if (!("Notification" in window)) {
                        alert("Added Successfuly");
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        // Let's check whether notification permissions have already been granted
                        else if (Notification.permission === "granted") {
                        var options = {
                        body: "Added Successfuly",
                        icon: "icon/add.png"
                        }
                        // If it's okay let's create a notification
                        var notification = new Notification("Result",options);
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        // Otherwise, we need to ask the user for permission
                        else if (Notification.permission !== 'denied') {
                        Notification.requestPermission(function (permission) {
                        // If the user accepts, let's create a notification
                        if (permission === "granted") {
                        var options = {
                        body: "Added Successfuly",
                        icon: "icon/add.png"
                        }
                        // If it's okay let's create a notification
                        var notification = new Notification("Result",options);
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        });
                        }
                        }
                        else
                        {
                        alert("Couldn't delete data ");
                        }
                        },
                        error: function() {
                        // alert('Error while request..');
                        }
                        });
                          $('#todo').val('') ;
                        }

                        function DelList(ids)
                        {
                        var dataString = ids;
                        $.ajax({
                        url: "work.php",
                        type: "post",
                        async : true,
                        cache: false,
                        data: { 'ids' : dataString},
                        success: function(data) {
                        if(data == 'true')
                        {
                        // Let's check if the browser supports notifications
                        if (!("Notification" in window)) {
                        alert("Deleted Success Fully");
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        // Let's check whether notification permissions have already been granted
                        else if (Notification.permission === "granted") {
                        var options = {
                        body: "Deleted Successfuly",
                        icon: "icon/del.png"
                        }
                        // If it's okay let's create a notification
                        var notification = new Notification("Result",options);
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        // Otherwise, we need to ask the user for permission
                        else if (Notification.permission !== 'denied') {
                        Notification.requestPermission(function (permission) {
                        // If the user accepts, let's create a notification
                        if (permission === "granted") {
                        var options = {
                        body: "Deleted Successfuly",
                        icon: "icon/del.png"
                        }
                        // If it's okay let's create a notification
                        var notification = new Notification("Result",options);
                        $('#tablelist').load(document.URL +  ' #tablelist');
                        }
                        });
                        }
                        }
                        else
                        {
                        alert("Couldn't delete data ");
                        }
                        },
                        error: function() {
                        // alert('Error while request..');
                        }
                        });

                        
                        }
                    </script>
                </body>
            </html>
