<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="./css/styleReport.css">
</head>
<body>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-2">
        <div>
            <h1 style="display: inline-block;">TRANSACTION REPORTS</h1>
            <div> 
                <?php
                session_start();
                // Check if the name is set in the session
                if(isset($_SESSION['name'])) {
                $name = $_SESSION['name'];
                echo "Welcome, $name!";
                } else {
                echo "User not logged in.";
                }
                ?>
            </div>
        </div>
        <div class="d-flex align-items-center" style=" border: solid; height:50px; width:300px; overflow: hidden; ">
            <img src="./img/loginBG.jpg" alt="Logo" class="container-image">

            <a href="index.php" class="btn btn-danger"><i class="fas fa-arrow-right"></i> Go to Inventory</a>


        </div>
        
    </div>
</div>
<div class="overflow-y-auto p-2" style="height: 560px;">

      <!-- Transaction list will be displayed here -->
      <?php
      include 'connect.php';

      $sql = "SELECT * FROM transacts";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          echo "<table class='table table-dark table-hover' id='transactionTable'>";
          echo '
              <thead>
                  <tr>
                      <th scope="col">Transaction ID</th>
                      <th scope="col">Product ID</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Timestamp</th>
                  </tr>
              </thead>';
          echo '<tbody id="transactionTableBody">'; // Add this line
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo "<td>" . $row["trans_ID"] . "</td>";
              echo "<td>" . $row["product_id"] . "</td>";
              echo "<td>" . $row["customer_name"] . "</td>";
              echo "<td>" . $row["quantity"] . "</td>";
              echo "<td>" . $row["timestamp"] . "</td>";
              echo '</tr>';
          }
          echo '</tbody>'; // Add this line
          echo "</table>";
      } else {
          echo "<p>No records found</p>"; // Add this line
      }

      $conn->close();
      ?>

</div>
</body>
</html>