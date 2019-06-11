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
              
                <div class="ib">
                    <div class="close-edit">
                        <a href="change.php">close</a></div>

                    <div class="ib-box">                                          
                        
                        <?php
                            $line = $_GET['id']; 

                            $sql = "SELECT id, fname, lname, tnumber, invited, status FROM guess WHERE id='$line'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row


                                        
                                        while($row = $result->fetch_assoc()) {

                                            // echo $id;
                                            echo "<h3>"."EDIT GUESS INFO"."</h3>";
                                            echo "<br>";

                                            

                                            echo "<form method='post' action=''>";
                                            echo "<input type='hidden' name='id' value='".$row['id']."'>";

                                            echo "Firstname";
                                            echo "<div class='ib-ip'>";                                                                        
                                            echo "<input type='text' name='fname' value='".$row['fname']."'class='divip'>";
                                            echo "</div>";

                                            echo "Lastname";
                                            echo "<div class='ib-ip'>";                            
                                            echo "<input type='text' name='lname' value='".$row['lname']."'class='divip'>";
                                            echo "</div>";

                                            echo "Table Number";
                                            echo "<div class='ib-ip'>";                            
                                            echo "<input type='text' name='tnumber' value='".$row['tnumber']."'class='divip'>";
                                            echo "</div>";

                                            echo "Invited By";
                                            echo "<div class='ib-ip'>";                            
                                            echo "<input type='text' name='invited' value='".$row['invited']."'class='divip'>";
                                            echo "</div>";

                                            echo "Status";
                                            echo "<div class='ib-ip' STYLE='padding-top:10px;'>";                            
                                            // echo "<input type='text' name='status' value='".$row['']."'class='divip'>";
                                             if ($row['status'] == 1) {
                                                echo "CHECKED";
                                            } else if ($row['status'] == 0) {
                                                echo "NOT CHECKED YET";                                            
                                            }                                            
                                            echo "</div>";
                                            echo "<br><br>";                                    

                                            echo "<div class='bottons'>";
                                            echo "<button class='left-b' id='rb' name='edit' style='border:none;outline:none;height:40px;border-radius:60px;padding-top:5px;'>";
                                            echo "Update";
                                            echo "</button>";
                                            echo "<button class='right-b' id='lb' name='delete' style='border:none;outline:none;height:40px;border-radius:60px;padding-top:5px;'>";
                                            echo "Delete";
                                            echo "</button>";
                                            echo "</div>";                                      

                                            echo "</form>";
                                        }

                                    } else {
                                        // echo "Error displaying record";
                                        echo "Error: " .$sql. "<br>" . $conn->error;
                                    }
                                    // $conn->close();

                            ?>


                            <?php
                                if (isset($_POST['edit'])) { 

                                    $fname = $_POST['fname'];
                                    $lname = $_POST['lname'];
                                    $tnumber = $_POST['tnumber'];
                                    $invited = $_POST['invited'];
                                    $id = $_POST['id'];


                                    $sql = "UPDATE guess SET fname='$fname',lname='$lname',tnumber='$tnumber',invited='$invited' WHERE id=$id";

                                    

                                    if ($conn->query($sql) === TRUE) { 
                                        header('Refresh: 1; url=change.php');
                                        echo "Updating Table number for ". $fname;                           
                                    } else {
                                        echo "Can't update table number for ". $gname;
                                        // echo "Error updating record: ". $conn->error;                      
                                    }

                                    $conn->close();                                    
                                   }

                                   
                            ?>

                            <?php
                                if (isset($_POST['delete'])) { 

                                    $fname = $_POST['fname'];
                                    $lname = $_POST['lname'];
                                    $tnumber = $_POST['tnumber'];
                                    $invited = $_POST['invited'];
                                    $id = $_POST['id'];


                                    $sql = "DELETE FROM guess WHERE id=$id";

                                    

                                    if ($conn->query($sql) === TRUE) { 
                                        header('Refresh: 1; url=change.php');
                                        echo "Deleting ". $fname . " ".$lname. " from list."; 
                                    } else {
                                        echo "Record already removed from list";
                                        //echo "Error updating record: ". $conn->error;                      
                                    }

                                    $conn->close();                                    
                                   }

                                   
                            ?>
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