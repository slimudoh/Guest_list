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
                        <h1>EDIT GUEST INFO</h1>
                        <h6>Please enter full name of guest.</h6>
                        <form method="post" action="" id="form">
                            <div class="ib-ip">
                                <input type="text" name="fname" class="divip" required>
                            </div>                                                                           
                            <div class="ib-ipb">
                                <input type="submit" name="submit" class="divip" value="SUBMIT">
                            </div>                            
                        </form>
                        <br>
                        <br>                    
                        <div class="bottons">
                            <a href="invite.php">
                                <div class="left-b" id="rb">                                
                                    ADD GUEST
                                </div>  
                            </a>
                            <a href="check.php">         
                                <div class="right-b" id="lb">
                                    CHECK GUESS
                                </div>
                            </a>
                        </div>                                                                   
                    </div>                   
                </div>

                <div class='vg-result'>
                    
                             <?php
                               if (isset($_POST['submit'])) {

                                    $fname = trim($_POST['fname']);                           


                                    $sql = "SELECT id, fname, lname, tnumber, invited FROM guess WHERE fname='$fname'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row 
                                        echo "<table>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>"."S/N"."</th>";
                                        echo "<th>"."FIRSTNAME"."</th>";
                                        echo "<th>"."LASTNAME"."</th>";
                                        echo "<th>"."TABLE NUMBER"."</th>";
                                        echo "<th>"."INVITED BY"."</th>";
                                        echo "<th>"."STATUS"."</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        echo "<form method='post' action=''>";

                                        $x = 1;                                  

                                        while($row = $result->fetch_assoc()) { 
                                            echo "<tr>";    
                                            echo "<td>" . $x . "</td>";
                                            echo "<td>" . $row['fname'] . "</td>";
                                            echo "<td>" . $row['lname'] . "</td>";
                                            echo "<td>" . $row['tnumber'] . "</td>";
                                            echo "<td>" . $row['invited'] . "</td>";
                                            echo "<td>";
                                            echo "<a href='edit.php?id=".$row['id']."'><i class='fa fa-pencil'></i></a>";
                                            echo "</td>";                                        
                                            echo "</tr>";

                                            $x++;
                                        }
                                    } else {
                                        echo "No record";                      
                                    }
                                    $conn->close();
                                   }                        
                        ?>
                            </form>                            
                        </tbody>
                    </table>
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