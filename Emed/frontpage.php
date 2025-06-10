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

	<!-- Photo -->

	<div class="photo">
		<img src="Photos/A.JPG" width= "100%">
	</div>

	<!-- Hospitals -->

    <div class="product-box">
		<h1 class="hname">Our Hospitals</h1>
        <div class="card">
            <img src="Photos/Norvic International Hospital.JPEG" alt="logo" width="100%">
            <h3><br>Norvic Intl Hospital</h3><br>
            <h5 class="address">Thapathali, Kathmandu</h5><br>
        </div>
        <div class="card">
            <img src="Photos/Nepal Mediciti.JPEG" alt="logo" width="100%">
            <h3><br>Nepal Mediciti</h3><br>
            <h5 class="address">Bhaisepati, Lalitpur</h5><br>
        </div>
        <div class="card">
            <img src="Photos/Grande International Hospital.JPEG" alt="logo" width="100%">
            <h3><br>Grande Intl Hospital</h3><br>
            <h5 class="address">Dhapasi, Kathmandu</h5><br>
        </div>
        <div class="card">
            <img src="Photos/B & B Hospital.JPEG" alt="logo" width="100%">
            <h3><br>B & B Hospital</h3><br>
            <h5 class="address">Gwarko, Lalitpur</h5><br>
        </div>
        <div class="card">
            <img src="Photos/Nobel Hospital.JPEG" alt="logo" width="100%">
            <h3><br>Nobel Hospital</h3><br>
            <h5 class="address">Sinamangal, Kathmandu</h5><br>
        </div>
    </div>

	<!-- Medicines -->

	<div class="container">
		<h1 class="heading">Daily Use Medicines</h1>
		<div class="box-container">
			<div class="box">
			<img src="Photos/Sinex.jpg" alt="logo" width="100%">
				<h3>Sinex</h3>
				<h5>NPR 30</h5>
				<a href="./CategoryC.php" class="btn">Category</a>
			</div>
			<div class="box">
				<img src="Photos/Plum.jpg" alt="logo" width="100%">
				<h3>Plum</h3>
				<h5>NPR 960</h5>
				<a href="./CategoryC.php" class="btn">Category</a>
			</div>
			<div class="box">
				<img src="Photos/Lax.png" alt="logo" width="100%">
				<h3>Lax</h3>
				<h5>NPR 295</h5>
				<a href="./CategoryD.php" class="btn">Category</a>
			</div>
			<div class="box">
				<img src="Photos/Moov Spray.jpeg" alt="logo" width="100%">
				<h3>Moov Spray</h3>
				<h5>NPR 350</h5>
				<a href="./CategoryD.php" class="btn">Category</a>
			</div>
			<div class="box">
				<img src="Photos/Goli.jpeg" alt="logo" width="100%">
				<h3>Goli</h3>
				<h5>NPR 2600</h5>
				<a href="./CategoryE.php" class="btn">Category</a>
			</div>
			<div class="box">
				<img src="Photos/Horlicks.jpeg" alt="logo" width="100%">
				<h3>Horlicks</h3>
				<h5>NPR 400</h5>
				<a href="./CategoryE.php" class="btn">Category</a>
			</div>
		</div>
	</div>

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

</body>
</html>
