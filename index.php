<?php 
   ob_start( ); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">    
    
    <title>Guess List</title>
   
    <!-- favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    

    <!-- fontawesome -->
    <link rel="stylesheet" href="font/css/font-awesome.min.css">

    <!-- style -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
  </head>

  <body class="bd-bg">
      <div class="guess-auth" id="ga">
        <div class="guess-top">
            <img src="images/80.jpg" alt="">
            
        </div>
        <div class="guess-btm">
            <div class="guess-authbdy">                
                <form method="post" action="">
                    <div class="col-md-12">
                        <div class="col-xs-8 col-sm-8 col-md-8" style="padding: 0;">
                            <div class="inpd">
                                <input type="password" name="pin" class="di" placeholder="Enter pass key">
                            </div> 
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4" style="padding: 0;">
                            <div class="inpb">
                                <button type="submit" name="submit" class="db">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password ="";
                    $dbname = "guesslist";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 


                                if (isset($_POST['submit'])) {  


                                    $pin =  trim($_POST['pin']);        

                                    $sql = "SELECT id, pin FROM password WHERE pin='$pin'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            
                                            // echo "<div style='color:white;'>";
                                            // echo $row["id"];
                                            // echo "</div>"; 

                                            if ($row["pin"] == 12345) {
                                                header('Refresh: 1; url=invite.php');
                                                echo "<div style='color:red;'>"."Moving you in..."."</div>";
                                            }                   
                                        }

                                    } else {
                                            echo "<div style='color:red;'>";
                                            echo "Wrong pin";
                                            echo "</div>";  
                                    }
                                    $conn->close();
                                }                    
                ?>
                </div>            
        </div>
    </div>  
                  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php
    ob_end_flush( );
?>