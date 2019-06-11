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
                

                <div class="vg" id="vg">
                    <div class="ib-box">
                        <h1>CHECK A GUEST</h1>
                        <h6>Please enter first name of guest and submit.</h6>
                        <form method="post" action="">
                            <div class="ib-ip">
                                <input type="text" name="gname" class="divip" placeholder="Enter Firstname" required>
                            </div>                      
                            <div class="ib-ipb">
                                <input type="submit" name="check" class="divip" value="CHECK">
                            </div>
                        </form>
                        <br><br>

                        <span style="font-size:12px;"><a href="full.php">CHECK FULL LIST</a></span>
                    </div>                    
                    <br>                    
                    <div class="bottons">
                        <a href="invite.php">
                            <div class="left-b" id="rb">                                
                                ADD GUEST
                            </div>  
                        </a>
                        <a href="change.php">         
                            <div class="right-b" id="lb">
                                CHANGE TABLE
                            </div>
                        </a>
                    </div>                                      
                </div>
                <div class='vg-result'>                    
                            <?php
                               if (isset($_POST['check'])) {

                                    $gname = trim($_POST['gname']);                           


                                    $sql = "SELECT id, fname, lname, tnumber, invited, status FROM guess WHERE fname='$gname'";
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

                                            if ($row['status'] == 1 ) {
                                                echo "<tr style='background-color:rgba(255, 0, 0, .2);'>";
                                            } else if ($row['status'] == 1) {
                                                echo "<tr>";
                                            }

                                            //echo "<tr>";    
                                            echo "<td>" . $x . "</td>";
                                            echo "<td>" . $row['fname'] . "</td>";
                                            echo "<td>" . $row['lname'] . "</td>";
                                            echo "<td>" . $row['tnumber'] . "</td>";
                                            echo "<td>" . $row['invited'] . "</td>";
                                            echo "<td>";
                                            if ($row['status'] == 1) {
                                                echo "CHECKED";
                                            } else if ($row['status'] == 0) {
                                                echo "<div>";
                                                echo "<input type='hidden' value='".$row['id']."'"."name='id[]'>";
                                                echo "<input type='checkbox'"." value='yes'"."name='vcheck[]'>";
                                                echo "</div>";
                                            }                                            
                                            echo "</td>";
                                            echo "</tr>";                                           
                                            $x++;                                    
                                        }

                                        echo "<button class='mb'"." name='mb'>";
                                        echo "Update List";
                                        echo "</button>";
                                        echo "<br><br>";

                                    } else {
                                        echo "<tr>";                                   
                                            echo "No Record";                             
                                    }                    
                                    
                                }


                               

                               if (isset($_POST['mb'])) {

                                    //echo $_POST['vcheck'];                             
                                    
                                    if (isset($_POST['vcheck'])) {
                                        $checked = 1;                                                                             
                                    } 
                                    

                                    //echo $checked;                                    

                                    $count = count($_POST['id']);

                                    for ($i=0; $i < $count; $i++) {

                                        $sql = "UPDATE guess SET status = $checked WHERE id ='".$_POST['id'][$i]."'";
                                        // $result = $conn->query($sql);

                                        if ($conn->query($sql) === TRUE) { 
                                            header('Refresh: 1; url=check.php');
                                            echo "Updating list..."."&nbsp;";
                                        } else {
                                            // echo "Can't update table number for ". $gname;
                                            echo "Error updating record: ". $conn->error;                      
                                        }                                                           
                                    }   





                                    // $sql = "UPDATE guess SET status = $checked WHERE id ='$id'";
                                    // // $result = $conn->query($sql);

                                    // if ($conn->query($sql) === TRUE) { 
                                    //     header('Refresh: 1; url=check.php');
                                    //     echo "Updating list...";
                                    // } else {
                                    //     // echo "Can't update table number for ". $gname;
                                    //     echo "Error updating record: ". $conn->error;                      
                                    // }
                                    
                                   }

                                   $conn->close();                        
                                                  
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