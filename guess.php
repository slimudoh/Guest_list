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

    
<!-- 
    <div class="guess-auth" id="ga">
        <div class="guess-authin"  onclick="closeModal()">
            <div class="heading">GUESS LIST</div>
            <div class="guess-authbdy">
                <h3>LOGIN</h3>
                <form>
                    <div class="inpd">
                        <input type="password" name="" class="di" placeholder="PIN">
                    </div>                
                    <div class="inpb">
                        <input type="submit" value="SUBMIT" name="" class="db">
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <div class="guess-container">
        <div class="bottons">
            <div class="left-b" id="rb" onclick="openModal(event)">CHECK GUEST</div>             
            <div class="right-b" id="lb" onclick="openModal(event)"> ADD GUEST</div>
        </div>

        
        <div class="container">
            <div class="row"> 
                <div class="ib" id="ib">
                    <div class="ib-box">
                        <h1></h1>
                        <h6>Please fill out the form below to invite a guest.</h6>
                        <form method="post" action="">
                            <div class="ib-ip">
                                <input type="text" name="gname" class="divip" placeholder="Fullname" required>
                            </div>
                            <div class="ib-ip">
                                <input type="text" name="table" class="divip" placeholder="Table Number" required>
                            </div>
                            <div class="ib-ip">
                                <input type="text" name="invited" class="divip" placeholder="Invited By" required>
                            </div>                       
                            <div class="ib-ipb">
                                <input type="submit" name="submit" class="divip" value="SUBMIT">
                            </div>                            
                        </form>                        
                    </div>

                     <?php                        

                        if (isset($_POST['submit'])) {
                            
                            $gname = $_POST['gname'];
                            $table_no = $_POST['table'];
                            $invited = $_POST['invited'];
                           

                            $sql = "INSERT INTO guess (gname, table_no, ivited) " . "
                                    VALUES ('$gname','$table_no','$invited')";

                            if ($conn->query($sql) === TRUE) {
                                header('Refresh: 3; url=guess.php');
                                // echo "New record created successfully";
                                echo "Adding Guess...";
                            } else {
                                echo "Error: " .$sql. "<br>"> $conn->error;
                            }

                            $conn->close();
                        }                        
                    ?>
                </div>

                <div class="vg" id="vg">
                    <div class="ib-box">
                        <h6>Please enter first and last name seperated by space and submit.</h6>
                        <form method="post" action="">
                            <div class="ib-ip">
                                <input type="text" name="gname" class="divip" placeholder="Enter fullname" required>
                            </div>                      
                            <div class="ib-ipb">
                                <input type="submit" name="check" class="divip" value="CHECK">
                            </div>
                        </form>
                    </div>                                     
                </div>

                <div class='vg-result'>
                        <?php
                           if (isset($_POST['check'])) {

                                $gname = trim($_POST['gname']);                           


                                $sql = "SELECT id, gname, table_no, ivited FROM guess WHERE gname='$gname'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {                                   
                                        echo "<div><span class='small-letter'>FULL NAME:</span><strong>";
                                        echo " " . $row['gname'] ."</strong></div>";
                                        echo "<div><span class='small-letter'>SEAT NO:</span><strong>";
                                        echo " " . $row['table_no'] . "</strong></div>";
                                        echo "<div><span class='small-letter'>INVITED BY:</span><strong>";
                                        echo " " . $row['ivited'] . "</strong></div>";

                                        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";                                    
                                    }
                                } else {
                                    echo "Not on the list";
                                }
                                $conn->close();
                               }                        
                        ?>  
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