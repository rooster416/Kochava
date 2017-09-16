<?php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Kochava Mini Project</title>
    
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<h1>Kochava Mini Project</h1>
    <div class="error"><span id="error"></span></div>
    <div class="form" style="width: 450px;">
        <div class="form-entity">
            <div class="form-label" style="width: 100px;"><font color="red">* </font>Mascot:</div>
            <input type="text" id="mascot" name="mascot" placeholder="Enter a mascot" value="Gopher" />
        </div>
        <div class="form-entity">
            <div class="form-label" style="width: 100px;"><font color="red">* </font>Location:</div>
            <input type="text" id="location" name="location" placeholder="Enter the location" style="width: 300px;" value="https://blog.golang.org/gopher/gopher.png" />
        </div>
        <hr />
        <div>
            <div class="left right-10">
                <input type="button" value="Send Request" onclick="sendRequest();" />
            </div>
            <div id="processing" class="pad-top-3 no-display">
                <img src="img/wait.gif" height="18">
            </div>
            <div class="clear"></div>
        </div>
	</div>
</body>
</html>
