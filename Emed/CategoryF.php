<?php
    // Database connection configuration
    $host = 'localhost';
    $db = 'esewa';
    $user = 'root';
    $password = ''; // Your database password

    // Establish database connection
    $conn = new mysqli($host, $user, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch products from the database
    $sql = "SELECT * FROM products5";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-MED</title>
	<link rel="icon" type="image/png" href="Photos/Favicon.PNG">

	<!-- Google (Static Icon Font) Link For Icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

	<link rel="stylesheet" type="text/css" href="Style.css">
	<script type="text/javascript" src="./Script.js" defer></script>
</head>
<body>

    <main>
        <h1>Category F</h1>
        <div class="medicine-list">
            <?php while ($product = mysqli_fetch_assoc($result)) { ?>
                <div class="medicine-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" style="width: 100%; height: auto;">
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p>Price: Rs. <?php echo htmlspecialchars($product['amount']); ?></p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <!-- Updated Add to Cart Form -->
                    <form method="post" action="add_to_cart5.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                        <input type="hidden" name="product_title" value="<?php echo htmlspecialchars($product['title']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['amount']); ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
                        <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            <?php } ?>
        </div>
    </main>

    <!-- Footer -->

	<footer>
		<div class="main-content">

			<!-- About us -->

			<div class="left box">
				<h2>About us</h2>
				<div class="content">
					<p>E-MED is an ecommerce websites through which patients can buy medicines recommended by doctors.</p>
				</div>
			</div>

			<!-- Address -->

			<div class="center box">
				<h2>Address</h2>
				<div class="content">
					<div class="place">
						<span class="text">Kathmandu, Nepal</span>
					</div>
					<div class="phone">
						<span class="text">+977-9767563910</span>
					</div>
					<div class="email">
						<span class="text">emednepal@gmail.com</span>
					</div>
				</div>
			</div>

			<!-- Contact us -->

			<div class="right box">
				<h2>Contact us</h2>
				<div class="content">
					<form action="SLCConnection.php" method="post">
					<div class="email">
						<div class="text">Email :</div>
						<input type="email" id="email" name="uemail" required>
					</div>
					<div class="msg">
						<div class="text">Message :</div>
						<textarea id="message" name="umessage" rows="2" cols="25" required></textarea>
					</div>
					<div class="btn">
						<button type="submit" name="cregister">Send</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="bottom">
			<center>
				<span class="credit">Created By <a href="./frontpage.php">E-MED</a> | </span>
				<span class="far fa-copyright"></span><span> 2025 All rights reserved.</span>
			</center>
		</div>
	</footer>

	<!-- Navigation Bar -->

	<header>
		<nav class="navbar">
			<a href="./frontpage.php" class="logo">
				<img src="Photos/Logo.PNG" alt="Logo">
				<h2>E-MED</h2>
			</a>
			<ul class="links">
				<li><a href="./frontpage.php">Home</a></li>
				<li>
					<div class="products-menu">
						<a href="#">Categories</a>
						<div class="dropdown-content">
							<a href="./CategoryB.php">Category B</a>
							<a href="./CategoryC.php">Category C</a>
							<a href="./CategoryD.php">Category D</a>
							<a href="./CategoryE.php">Category E</a>
							<a href="./CategoryF.php">Category F</a>
						</div>
					</div>
				</li>
			</ul>
			<div class="search-box">
				<form action="#">
					<input type="text" name="SEARCH" id="search" placeholder="Search Medicines..." oninput="searchMedicine()">
				</form>
			</div>
			<div class="upload-box">
				<button class="upload-btn" id="prescriptionButton">Upload Prescription
					<span class="material-symbols-outlined">upload</span>
				</button>
			</div>
			<div class="upload-box">
				<button class="upload-btn" id="ambulanceButton">Ambulance
					<span class="material-symbols-outlined">ambulance</span>
				</button>
			</div>
			<button class="blog-btn" id="blogsButton">Blog</button>
		</nav>
	</header>

    <script>
        function searchMedicine() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const medicineCards = document.querySelectorAll('.medicine-card');
            medicineCards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                if (title.includes(searchInput)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>

<?php
    // Close database connection
    $conn->close();
?>
