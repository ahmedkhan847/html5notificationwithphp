//Asking for Permission on Page Load
Notification.requestPermission();

function AddList() {
    var to = $('#todo').val();
    $.ajax({
        url: "work.php",
        type: "post",
        async: true,
        cache: false,
        data: {
            'todo': to
        },
        success: function(data) {
            if (data == 'true') {
                  var optio = "added";
                  Shownotification(optio);
                }
            else {
                alert("Couldn't delete data ");
            }
        },
        error: function() {
            // alert('Error while request..');
        }
    });
    $('#todo').val('');
}

function DelList(ids) {
    var dataString = ids;
    $.ajax({
        url: "work.php",
        type: "post",
        async: true,
        cache: false,
        data: {
            'ids': dataString
        },
        success: function(data) {
            if (data == 'true') {
                  var optio = "delete";
                  Shownotification(optio);
                
            } else {
                alert("Couldn't delete data ");
            }
        },
        error: function() {
            // alert('Error while request..');
        }
    });
}

function Shownotification(option)
{
      var options = null;

      if(option === "delete")
      {
            options = {
                            body: "Deleted Successfully",
                            icon: "icon/del.png"
                        };
      }
      else
      {
            options = {
                            body: "Added Successfully",
                            icon: "icon/add.png"
                        };

      }

      // Let's check if the browser supports notifications
                if (!("Notification" in window)) {
                    alert("Deleted Success Fully");
                    $('#tablelist').load(document.URL + ' #tablelist');
                }
                // Let's check whether notification permissions have already been granted
                else if (Notification.permission === "granted") {
                    // var options = {
                    //         body: "Deleted Successfully",
                    //         icon: "icon/del.png"
                    //     }
                        // If it's okay let's create a notification
                    var notification = new Notification("Result", options);
                    $('#tablelist').load(document.URL + ' #tablelist');
                }
                // Otherwise, we need to ask the user for permission
                else if (Notification.permission !== 'denied') {
                    Notification.requestPermission(function(permission) {
                        // If the user accepts, let's create a notification
                        if (permission === "granted") {
                            // var options = {
                            //         body: "Deleted Successfully",
                            //         icon: "icon/del.png"
                            //     }
                                // If it's okay let's create a notification
                            var notification = new Notification("Result", options);
                            $('#tablelist').load(document.URL + ' #tablelist');
                        }
                    });
              }
}