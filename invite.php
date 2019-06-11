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
  <body>

  <?php
    $servername = "localhost";
    $username = "root";
    $password ="";
    $dbname = "guesslist";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
  ?>


    <div class="guess-container">
        
        <div class="container">
            <div class="row"> 
                <div class="ib" id="ib">
                    <div class="ib-box">
                        <h1>INVITE A GUEST</h1>
                        <h6>Please fill out the form below to invite a guest.</h6>
                        <form method="post" action="">
                            <div class="ib-ip">
                                <input type="text" name="fname" class="divip" placeholder="Firstname" required>
                            </div>
                            <div class="ib-ip">
                                <input type="text" name="lname" class="divip" placeholder="Lastname" required>
                            </div>
                            <div class="ib-ip">
                                <input type="text" name="table" class="divip" placeholder="Table Number" required>
                            </div>
                            <div class="ib-ip">
                                <input type="text" name="invited" class="divip" placeholder="Invited By" required>
                            </div>                       
                            <div class="ib-ipb">
                                <button name="submit" class="divip">
                                    INVITE
                                </button>
                            </div>                            
                        </form>
                        <?php                  
                            if (isset($_POST['submit'])) {
                                
                                $fname = strtoupper(trim($_POST['fname']));
                                $lname = strtoupper(trim($_POST['lname']));
                                $table = ucfirst(trim($_POST['table']));
                                $invited = strtoupper(trim($_POST['invited']));
                                $status = 0;
                               

                                $sql = "INSERT INTO guess (fname, lname, tnumber, invited, status) " . "
                                        VALUES ('$fname','$lname','$table','$invited', $status)";

                                if ($conn->query($sql) === TRUE) {
                                    header('Refresh: 1; url=invite.php');
                                    // echo "New record created successfully";
                                    echo "Adding Guest...";
                                } else {
                                    echo "Error: " .$sql. "<br>"> $conn->error;
                                }

                                $conn->close();
                            }                        
                        ?>                       
                        <br>                    
                        <div class="bottons">
                            <a href="check.php">
                                <div class="left-b" id="rb">                                
                                    CHECK GUEST
                                </div>  
                            </a>
                            <a href="change.php">         
                                <div class="right-b" id="lb">
                                    CHANGE TABLE
                                </div>
                            </a>
                        </div>                        
                    </div>                  
                </div>                     
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