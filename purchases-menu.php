<?php
require_once 'dbConnection.php';
session_start(); //start session for admin account
$adminUsername = $_SESSION['username'] ?? null; // get the login user's username to display in the profile

$resultTable = "
    SELECT 
        purchases.invoiceNo,
        purchases.datePurchased,
        suppliers.supplierName,
        products.productName,
        products.image,
        purchaseItems.quantity
    FROM purchases
    INNER JOIN suppliers ON purchases.supplierID = suppliers.supplierID
    INNER JOIN purchaseItems ON purchases.purchaseID = purchaseItems.purchaseID
    INNER JOIN products ON purchaseItems.productID = products.productID
    ORDER BY purchases.datePurchased DESC
";
$purchasesResult = $conn->query($resultTable);

$supplier = "SELECT * FROM suppliers"; //fetch the suppliers to display in the drop down in selecting a supplier for purchase
$supplier_results = $conn->query($supplier);

$products = "SELECT * FROM products";// fetch the products that will be purchase by the admin
$products = $conn->query($products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Purchases</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:100,200,300,400,500,600,700">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=IM+Fell+DW+Pica:ital@0;1&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="purchasesBody">
        <aside id="sidebar">
            <div class="fa-solid fa-bars toggle-btn" id="toggleSidebar" onclick="toggleSidebar()"></div>
            <img src="uploads/booker-logo.png" alt="Logo">
            <ul>
                <li><a href="dashboard-menu.php"><span>📟 Dashboard</span></a></li>
                <li><a href="products-menu.php"><span>📚 Products</span></a></li>
                <li><a href="suppliers-menu.php"><span>🚛 Suppliers</span></a></li>
                <li><a href="purchases-menu.php"><span>🛒 Purchases</span></a></li>
                <li><a href="sales-menu.php"><span>🏷️ Sales</span></a></li>
                <li><a href="returns-menu.php"><span>↺ Returns</span></a></li>
                <li><a href="users-menu.php"><span>👤 User Account</span></a></li>
                <li onclick="window.location.href='logout.php';"></li>
            </ul>
            <div class="profile-card">
                <img class="profile-card-img" src="uploads\profile.jpg" alt="Profile Picture">
                <h4 class="profile-card-username">Hi, <?php echo $adminUsername; ?></h4>
                <div class="logout">
                    <a onclick="window.location.href='logout.php';"><i
                            class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </div>
            </div>
        </aside>

        <main class="purch-maincontent">
            <div class="input-purchase-details">
                <div class="fa-solid fa-bars toggle-btn" onclick="toggleSidebar()"></div>
                <form action="add-purchase.php" method="POST">
                    <div id="supplier">
                        <h1>Purchases</h1>
                        <label for="supplier">
                            Supplier
                        </label>
                        <!-- Select a supplier you want to purchase with -->
                        <select id="supplier-list" name="supplierList" required>
                            <option value="">Select Supplier</option>
                            <?php while ($row = $supplier_results->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($row['supplierID']) ?>">
                                    <?= htmlspecialchars($row['supplierID']) ?> -
                                    <?= htmlspecialchars($row['supplierName']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- generated random number for invoiceNo and display it first -->
                    <label for="invoiceNumber">
                        Invoice Number
                        <?php
                        function generateRandomInvoiceNumber($conn) // function to generate a random invoice number
                        {
                            $count = "";
                            do {

                                $invoiceNo = rand(1000000, 9999999); // range
                                $stmt = $conn->prepare("SELECT COUNT(*) FROM purchases WHERE invoiceNo = ?");
                                $stmt->bind_param('i', $invoiceNo);  // bind the parameter
                                $stmt->execute();
                                $stmt->bind_result($count); // bind the result
                                $stmt->fetch(); // fetch the result
                            } while ($count > 0); // check if the invoice number already exists
                        
                            return $invoiceNo;
                        }

                        $generatedInvoiceNo = generateRandomInvoiceNumber($conn);
                        ?>
                    </label>
                    <!-- display the generated invoice number -->
                    <input type="text" name="invoiceNo" id="" value="<?php echo $generatedInvoiceNo; ?>" readonly
                        style="border:none;">
                        <!-- Product search for easy searching of product rather than scrolling -->
                    <div class="product-search" style="margin-bottom: 1.5rem; margin-top: 1rem;">
                        <input type="text" id="productSearch" placeholder="Search products..."
                            style="padding: 0.5rem 1rem; border-radius: 25px; border: 1px solid #ccc; width: 100%; max-width: 400px;">
                    </div>

                    <!-- Display the products -->
                    <div id="class">
                        <?php while ($row = $products->fetch_assoc()) {
                            $productId = $row['productID']; // get the product ID
                            ?>
                            <!--Product Card -->
                            <div style="margin: 10px ; border: 1px solid #ccc; padding: 10px; width: 180px;">

                                <input type="checkbox" name="selectedProducts[]" value="<?= $productId ?>">
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="product-image" width="65px"
                                    height="70px"><br>
                                <b><?= htmlspecialchars($row['productName']) ?></b><br>
                                Price: ₱<?= htmlspecialchars($row['productPrice']) ?><br>
                                Stock: <?= htmlspecialchars($row['productStock']) ?><br>
                                <!-- If product stock is greater than zero -->
                                <?php if ((int) $row['productStock'] > 0): ?>
                                    <label for="qty_<?= $productId ?>">Quantity:</label>
                                    <input type="number" name="quantity[<?= $productId ?>]" id="qty_<?= $productId ?>" min="1"
                                        max="<?= htmlspecialchars($row['productStock']) ?>" value="1" style="width: 60px;">
                                    <!-- otherwise out of stock and then disabled -->
                                <?php else: ?>
                                    <p style="color: red;">Out of Stock</p>
                                    <input type="number" disabled style="width: 60px;" value="0">
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- update the total amount automatically when a product is selected -->
                    <h3>Total Amount: ₱<span id="totalAmount">0.00</span></h3>
                    <input type="submit" value="Buy" class="buyPurchases">
                </form>

                <!-- Table for dispalying the products that are purchased -->
                <div class="listTable">
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date Purchased</th>
                                <th>supplier Name</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($purchasesResult && $purchasesResult->num_rows > 0): ?>
                                <?php while ($row = $purchasesResult->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['invoiceNo']) ?></td>
                                        <td><?= htmlspecialchars($row['datePurchased']) ?></td>
                                        <td><?= htmlspecialchars($row['supplierName']) ?></td>
                                        <td><?= htmlspecialchars($row['productName']) ?></td>
                                        <td>
                                            <?php if (!empty($row['image'])): ?>
                                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Image" width="50">
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No purchases found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    
        document.getElementById("productSearch").addEventListener("keyup", function () {
            let query = this.value.toLowerCase();
            let cards = document.querySelectorAll("#class > div"); // Select all product cards

            cards.forEach(function (card) { // Loop through each card
                let text = card.innerText.toLowerCase(); // Get the text content of the card
                card.style.display = text.includes(query) ? "block" : "none"; // Show card if it matches the search 
            });
        });

        function updateTotal() {
            let total = 0; //initialize total to zero
            // Get all checked checkboxes inside product cards
            const checkedProducts = document.querySelectorAll('#class input[type="checkbox"]:checked');

            // Loop through each checked checkbox
            checkedProducts.forEach(function (checkbox) {
                const card = checkbox.closest('div'); // Get the card element

                const priceText = card.querySelector('b + br').nextSibling.textContent; // Gets the price line text
                const price = parseFloat(priceText.replace('Price: ₱', '')) || 0; // Extract the price value

                const quantityInput = card.querySelector('input[type="number"]'); // Get the quantity input field
                const quantity = parseInt(quantityInput.value) || 1;// Get the quantity value, defaulting to 1 if not specified

                total += price * quantity; // Calculate total 
            });

            // Show total amount
            document.getElementById('totalAmount').innerText = total.toFixed(2);
        }

        // Add event listeners to each card for checkbox and quantity input
        document.querySelectorAll('#class > div').forEach(function (card) {
            card.addEventListener('click', function (e) { // checkbox when clicking on the card
                if (e.target.tagName !== 'INPUT') { // Check if the clicked element is not an input
                    let checkbox = card.querySelector('input[type="checkbox"]');// Get the checkbox inside the card
                    checkbox.checked = !checkbox.checked; 
                    updateTotal(); //call the function to update the total amount
                }
            });

            let checkbox = card.querySelector('input[type="checkbox"]'); 
            let quantityInput = card.querySelector('input[type="number"]'); 

            checkbox.addEventListener('change', updateTotal);
            quantityInput.addEventListener('input', updateTotal);
        });

        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;
            const fileName = currentPath.substring(currentPath.lastIndexOf('/') + 1);

            const sidebarLinks = document.querySelectorAll('aside ul li a');

            sidebarLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === fileName) {
                    link.classList.add('active');
                }
            });
        });

    </script>
</body>

</html>