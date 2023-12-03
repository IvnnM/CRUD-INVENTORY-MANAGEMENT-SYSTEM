<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    
    <link rel="stylesheet" href="./css/styleIndex.css">

</head>
<body>
    <?php
      session_start();

      if (isset($_SESSION['success_message'])) {
          echo '<div style="color: green;">' . $_SESSION['success_message'] . '</div>';
          unset($_SESSION['success_message']); // Clear the success message after displaying
      }

    ?>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center p-2">
            <div>
                <h1 style="display: inline-block;">INVENTORY MANAGEMENT SYSTEM</h1>
                <div> 
                    <?php
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
            </div>
            
        </div>
    </div>

    <div class="container-md" style="padding-top: 5vh;">
      <nav class="navbar navbar-expand-lg bg-body-tertiary"  data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><i class="fas fa-bars"></i></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="#add">ADD PRODUCT</a>
                    <a class="nav-link" href="#update">UPDATE PRODUCT</a>
                    <a class="nav-link" href="#delete">DELETE PRODUCT</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="report_page.php">REPORTS</a>
                    <a class="nav-link" href="./php/logout.php">LOGOUT</a>
                </div>
            </div>
        </div>
      </nav>


        <div class="row">
            <div class="col-md-5" >
              <div>
                <br id="add"><br>
              </div>
              <div class="container">
                <h3 class="mb-5">ADD PRODUCT</h3>
                <!-- Add Product Form -->
                <form class="row g-3" action="./php/process_product.php" method="post">
                  <div class="col-md-6">
                      <label for="productName" class="form-label">Product Name:</label>
                      <input type="text" class="form-control" id="productName" name="productName" required>
                  </div>
                  <div class="col-md-6">
                      <label for="quantity" class="form-label">Quantity:</label>
                      <input type="number" class="form-control" id="quantity" name="quantity" required>
                  </div>
                  <div class="col-md-6">
                      <label for="price" class="form-label">Price:</label>
                      <input type="number" class="form-control" id="price" name="price" required>
                  </div>
                  <div class="col-12">
                      <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                  </div>
                </form>
              </div>
              <div>
                <br id="update">
              </div>
              <div class="container">
                <h3 class="mb-5" >UPDATE PRODUCT</h3>
                <!-- Update Product Form -->
                <form class="row g-3" action="./php/process_product.php" method="post">
                  <div class="col-md-6">
                      <label for="productIdUpdate" class="form-label">Product ID:</label>
                      <select class="form-select" id="productIdUpdate" name="productId" required onchange="fetchProductDetails()">
                          <?php
                          include 'connect.php';
                          // Fetch product IDs from the database and populate the dropdown
                          $result = $conn->query("SELECT `Product_ID` FROM `product`");
                          while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['Product_ID'] . '">' . $row['Product_ID'] . '</option>';
                          }
                          ?>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <label for="productNameUpdate" class="form-label">New Product Name:</label>
                      <input type="text" class="form-control" id="productNameUpdate" name="productName" required>
                  </div>
                  <div class="col-md-6">
                      <label for="quantityUpdate" class="form-label">New Quantity:</label>
                      <input type="number" class="form-control" id="quantityUpdate" name="quantity" required>
                  </div>
                  <div class="col-md-6">
                      <label for="priceUpdate" class="form-label">New Price:</label>
                      <input type="number" class="form-control" id="priceUpdate" name="price" required>
                  </div>
                  <div class="col-12">
                      <button type="submit" class="btn btn-primary" name="updateProduct">Update Product</button>
                  </div>
                </form>
              </div>
              <div>
                <br id="delete">
              </div>
              <div class="container">
                <h3 class="mb-5" id="delete">DELETE PRODUCT</h3>
                <!-- Delete Product Form -->
                <form class="row g-3" action="./php/process_product.php" method="post">
                  <div class="col-md-6">
                      <label for="productIdDelete" class="form-label">Select Product ID:</label>
                      <select class="form-select" id="productIdDelete" name="productId" required>
                          <?php
                          include 'connect.php';
                          // Fetch product IDs from the database and populate the dropdown
                          $result = $conn->query("SELECT `Product_ID` FROM `product`");
                          while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['Product_ID'] . '">' . $row['Product_ID'] . '</option>';
                          }
                          ?>
                      </select>
                  </div>
                  <div class="col-12">
                      <button type="submit" class="btn btn-danger" name="deleteProduct">Delete Product</button>
                  </div>
                </form>
              </div>
            </div>
            
            
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-6">
                  <div>
                      <br id="addStock"><br>
                  </div>
                  <div class="container">
                      <h3 class="mb-5">ADD STOCK</h3>
                      <!-- Add Stock Form -->
                      <form class="row g-3" action="./php/process_product.php" method="post">
                          <div class="col-md-6">
                              <label for="productIdAddStock" class="form-label">Product ID:</label>
                              <select class="form-select" id="productIdAddStock" name="productId" required>
                                  <?php
                                  // Fetch product IDs from the database and populate the dropdown
                                  $result = $conn->query("SELECT `Product_ID` FROM `product`");
                                  while ($row = $result->fetch_assoc()) {
                                      echo '<option value="' . $row['Product_ID'] . '">' . $row['Product_ID'] . '</option>';
                                  }
                                  ?>
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label for="quantityAddStock" class="form-label">Additional Stock:</label>
                              <input type="number" class="form-control" id="quantityAddStock" name="quantity" required>
                          </div>
                          <div class="col-12">
                              <button type="submit" class="btn btn-success" name="addStock">Add Stock</button>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div>
                        <br id="checkout"><br>
                    </div>
                    <div class="container">
                        <h3 class="mb-5">CHECKOUT</h3>
                        <!-- Checkout Form -->
                        <form class="row g-3" action="./php/process_product.php" method="post">
                            <div class="col-md-6">
                                <label for="productIdCheckout" class="form-label">Product ID:</label>
                                <select class="form-select" id="productIdCheckout" name="productId" required>
                                    <?php
                                    // Fetch product IDs from the database and populate the dropdown
                                    $result = $conn->query("SELECT `Product_ID` FROM `product`");
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['Product_ID'] . '">' . $row['Product_ID'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="quantityCheckout" class="form-label">Quantity:</label>
                                <input type="number" class="form-control" id="quantityCheckout" name="quantity" required>
                            </div>
                            <div class="col-md-6">
                                <label for="customerName" class="form-label">Customer Name:</label>
                                <input type="text" class="form-control" id="customerName" name="customerName" required>
                            </div>
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary" name="subtractStock">Checkout</button>
                            </div>
                        </form>
                    </div>
                </div>

              </div>
              <div>
                <br id="inventory">
              </div>
              <div class="overflow-y-auto p-2" id="productList" style="background-color:#212529; border-radius:8px; min-height: 900px;  width:auto; margin-top: 5vh;">
                  <div style="border:solid;">
                    <form class="row g-3" id="searchForm" method="get" role="search">
                      <div class="col-md-8">
                        <input class="form-control" type="text" name="search" id="searchTerm" placeholder="Search product" aria-label="Search">
                      </div>
                      <div class="col-md-4">
                        <button id="searchBtn" class="btn btn-outline-success" type="submit">Search</button>
                      </div>
                    </form>
                  </div>
                  <!-- Product list will be displayed here -->
                  <?php
                  include 'connect.php';

                  $sql = "SELECT * FROM product";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      echo "<table class='table table-dark table-hover' id='productTable'>";
                      echo '
                          <thead>
                              <tr>
                                  <th scope="col">Product ID</th>
                                  <th scope="col">Product Name</th>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Price</th>
                              </tr>
                          </thead>';
                      echo '<tbody id="productTableBody">'; // Add this line
                      while ($row = $result->fetch_assoc()) {
                          echo '<tr>';
                          echo "<td>" . $row["Product_ID"] . "</td>";
                          echo "<td>" . $row["Product_Name"] . "</td>";
                          echo "<td>" . $row["Quantity"] . "</td>";
                          echo "<td>" . $row["Price"] . "</td>";
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
            </div>

        </div>

    </div>


<script>
    $(document).ready(function() {
        // Submit the form using AJAX
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            var searchTerm = $('#searchTerm').val();
            
            $.ajax({
                type: 'GET',
                url: './php/search_product.php',
                data: { search: searchTerm },
                success: function(data) {
                    // Replace the product table body with the updated data
                    $('#productTableBody').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

</body>
</html>
