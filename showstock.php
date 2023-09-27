<!-- User verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id'])){
      header("Location:patientlogin.php");
      exit();
      
  }
  $searching=false;
?>
<!DOCTYPE html>
<html>
<head>
<title>Stored Drugs</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php require '_nav.php'?>

<h1>Available Drugs</h1>
<hr>
<div class="col-md-6 container">


<!-- Search Bar -->
<form action="" method="post"><div class="input-group mb-3">
  <input type="text" class="form-control" aria-label="Text input with dropdown button" name="value">
  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filter By</button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><button class="btn btn-block btn-secondary" name="name" >Name</button></li>
    <li><button class="btn btn-block btn-secondary" name="id">ID</button></li>
    <li><button class="btn btn-block btn-secondary" name="man">Manufacturer</button></li>
  </ul>
</div></form>

  
</div>
<div class="col-md-9 container">
        <?php
            if(isset($_POST['name'])||isset($_POST['man'])||isset($_POST['id'])){
                    $searching=true;
            }
            if($searching){
                echo'<form action="" method="post"><button class="btn btn-danger" name="back">Go Back</button></form>';

                if(isset($_POST['back'])){
                    $searching=false;
            }
        }
        ?>
        <!-- table was here -->
       
                 <?php
                if($searching){
                    if(isset($_POST['name'])){
                        $name= $_POST["value"];
                        // Check availability based on drugName
                        $sql = "SELECT * FROM stock WHERE drugName LIKE '%$name%'";
                        $result = mysqli_query($conn, $sql);
                
                        echo '<table class="table">
                              <thead class="table-success">
                                <tr>
                                <th scope="col">Drug ID</th>
                                  <th scope="col">Drug Name</th>
                                  <th scope="col">Scientific Name</th>
                                  <th scope="col">Manufacturer</th>
                                  <th scope="col">Unit Price</th>
                                  <th scope="col">Quantity Available</th>
                                </tr>
                              </thead>
                              <tbody>';
                
                        while ($row = mysqli_fetch_assoc($result)) {
                          $drugid=$row['drugID'];
                            $drugName = $row['drugName'];
                            $scientificName = $row['scientificName'];
                            $manufacturer = $row['manufacturer'];
                            $unitPrice = $row['unitPrice'];
                            $totalQuantity = $row['totalQuantity'];
                
                            echo '<tr>
                            <td>' . $drugid . '</td>
                                  <td>' . $drugName . '</td>
                                  <td>' . $scientificName . '</td>
                                  <td>' . $manufacturer . '</td>
                                  <td>' . $unitPrice . '</td>
                                  <td>' . $totalQuantity . '</td>
                                </tr>';
                        }
                
                        echo '</tbody></table>';
                    }

                    elseif(isset($_POST['id'])){
                        $id=$_POST["value"];
                        $sql= "SELECT * FROM stock  WHERE drugID='$id'";
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $drugid= $row['drugID'];
                  $drugName = $row['drugName'];
                  $scientificName = $row['scientificName'];
                  $manufacturer = $row['manufacturer'];
                  $unitPrice =  $row['unitPrice'];	
                  $totalQuantity 	=  $row['totalQuantity'];	
                  echo ' <table class="table">
                  <thead class="table-success">
                    <tr>
                    
                      <th scope="col">Drug Name</th>
                      <th scope="col">Drug ID</th>
                      <th scope="col">Scientific Name</th>
                      <th scope="col">Manufacturer</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Quantity Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                  
                      <td>' .$drugName. '</td>
                      <td>' .$drugid. '</td>
                      <td>' .$scientificName. '</td>
                      <td>' .$manufacturer. '</td>
                      <td>' .$unitPrice. '</td>
                      <td>' .$totalQuantity. '</td>
                    </tr>
                  
                  </tbody>
                </table> ';
              }
                    }

                    elseif(isset($_POST['man'])){
                        $man= $_POST["value"];
                        // Check availability based on drugName
                        $sql = "SELECT * FROM stock WHERE  	manufacturer LIKE '%$man%'";
                        $result = mysqli_query($conn, $sql);
                
                        echo '<table class="table">
                              <thead class="table-success">
                                <tr>
                                <th scope="col">Drug ID</th>
                                  <th scope="col">Drug Name</th>
                                  <th scope="col">Scientific Name</th>
                                  <th scope="col">Manufacturer</th>
                                  <th scope="col">Unit Price</th>
                                  <th scope="col">Quantity Available</th>
                                </tr>
                              </thead>
                              <tbody>';
                
                        while ($row = mysqli_fetch_assoc($result)) {
                          $drugid=$row['drugID'];
                            $drugName = $row['drugName'];
                            $scientificName = $row['scientificName'];
                            $manufacturer = $row['manufacturer'];
                            $unitPrice = $row['unitPrice'];
                            $totalQuantity = $row['totalQuantity'];
                
                            echo '<tr>
                            <td>' . $drugid . '</td>
                                  <td>' . $drugName . '</td>
                                  <td>' . $scientificName . '</td>
                                  <td>' . $manufacturer . '</td>
                                  <td>' . $unitPrice . '</td>
                                  <td>' . $totalQuantity . '</td>
                                </tr>';
                        }
                
                        echo '</tbody></table>';
                    }
                }


                if(!$searching){
                    echo '  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Drug ID</th>
                            <th>Drug Name</th>
                            <th>Scientific Name</th>
                            <th>Category</th>
                            <th>Manufacturer</th>
                            <th>Unit Price</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody> ';
                    $query = "
                    SELECT * FROM stock;
                ";
                $result = mysqli_query($conn, $query);

                // Step 5: Fetch and display data
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['drugID']."</td>";
                        echo "<td>".$row['drugName']."</td>";
                        echo "<td>".$row['scientificName']."</td>";
                        echo "<td>".$row['drugCategory']."</td>";
                        echo "<td>".$row['manufacturer']."</td>";
                        echo "<td>".$row['unitPrice']."</td>";
                        echo "<td>".$row['totalQuantity']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='7'>No data found.</td>";
                    echo "</tr>";
                }

                // Step 7: Close the database connection
                mysqli_close($conn);
                }
                
                ?>
            </tbody>
        </table>
    </div>
              
</body>
</html>