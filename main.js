// Javascript file

// Post an ajax request to push a new job onto the redis server
function sendRequest()
{
    var mascot = document.getElementById("mascot").value;
    var location = document.getElementById("location").value;
    
    // Display the wait graphic
    document.getElementById("processing").style.display = "block";
    
    $.ajax({
        type: 'POST',
        url: "lib/send_request.php",
        data: {
            "mascot" : mascot,
            "location" : location
        },
        success: function( results ) {
            var error = results;
            
            if( error != "" ) {
                document.getElementById("error").innerHTML = error;
                document.getElementById("error").style.display = "block";
            }
            
            // Hide the wait graphic
            document.getElementById("processing").style.display = "none";
        }
    });
}
