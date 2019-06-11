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
              
                <div class='vg-result'>
                <h2>FULL GUEST LIST</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>TABLE NUMBER</th>
                                <th>INVITED BY</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                    

                                    $sql = "SELECT id, fname, lname, tnumber, invited, status FROM guess ORDER BY fname ASC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        $x = 1;
                                        while($row = $result->fetch_assoc()) {
                                            //echo "<tr>"; 
                                            if ($row['status'] == 1 ) {
                                                echo "<tr style='background-color:rgba(255, 0, 0, .2);'>";
                                            } else if ($row['status'] == 1) {
                                                echo "<tr>";
                                            }    


                                            echo "<td>" . $x. "</td>";                            
                                            echo "<td>" . $row['fname'] . "</td>";
                                            echo "<td>" . $row['lname'] . "</td>";
                                            echo "<td>" . $row['tnumber'] . "</td>";
                                            echo "<td>" . $row['invited'] . "</td>";
                                            echo "<td>";
                                            // echo $row['status'];
                                            if ($row['status'] == 1) {
                                                echo "CHECKED";
                                            } else if ($row['status'] == 0) {
                                                echo "NOT CHECKED";
                                            }
                                            echo "</td>";
                                            echo "</tr>";

                                            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>"; 
                                            $x++;                                   
                                        }

                                    } else {
                                        echo "<tr>";                                   
                                        echo "<td>" . " " . "</td>";
                                        echo "<td>" . "Not Record" . "</td>";
                                        echo "<td>" . "Not Record" . "</td>";
                                        echo "<td>" . "Not Record" . "</td>";
                                        echo "<td>" . " " . "</td>";
                                        echo "<td>" . " " . "</td>";
                                        echo "</tr>";
                                    }
                                    $conn->close();
                                                        
                            ?>                             
                        </tbody>
                    </table>
                    <br>

                    <span style="font-size:12px;"><a href="check.php">BACK TO CHECK GUEST</a></span>



                         
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