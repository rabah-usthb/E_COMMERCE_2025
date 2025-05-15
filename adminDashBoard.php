<?php
// adminDashBoard.php
// Determine which section to display (default to dashboard)
$page = $_GET['page'] ?? 'dashboard';
$allowed = ['dashboard', 'adminList', 'appendClient','client','categories','products','orders'];
if (!in_array($page, $allowed, true)) {
    $page = 'dashboard';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="admin.css">
	<title>Admin Dashboard</title>
</head>
<body>
	
	<!-- SIDEBAR -->
	<section id="sidebar">
		<div class="title-brand"><i class='bx bxs-store big-icon'></i><span>AdminHub<span></div> 
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-package icon'></i> Products <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="?page=products" class="<?= $page==='products'?'active':'' ?>"><i class='bx bx-list-ul bullet'></i> Product List</a></li>
					<li><a href="?page=categories" class="<?= $page==='categories'?'active':'' ?>"> <i class='bx bxs-category bullet'></i> Categories</a></li>
				</ul>
			</li>
			<li><a href="#"><i class='bx bxs-chart icon' ></i> Charts</a></li>
			<li>
				<a href="#"><i class='bx bxs-user icon'></i> Clients <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="?page=client" class="<?= $page==='client'?'active':'' ?>"> <i class='bx bxs-user-check bullet'></i> Verified</a></li>
					<a href="?page=appendClient" class="<?= $page==='appendClient'?'active':'' ?>"><i class='bx bxs-user-x bullet' ></i> Appending</a></li>
				</ul>
			</li>

            <li> <a href="#"> <i class='bx bxs-cart-download icon'></i> Orders <i class='bx bx-chevron-right icon-right' ></i></a> 
                <ul class="side-dropdown">
					<li><a href="?page=orders" class="<?= $page==='orders'?'active':'' ?>">  <i class='bx bx-list-ul bullet'></i> All Orders</a></li>
                    <li><a href="#"> <i class='bx bxs-paper-plane bullet'></i> Shipped</a></li>
					<li><a href="#">  <i class='bx bxs-hourglass bullet'></i> Awaiting</a></li>
					<li><a href="#"> <i class='bx bxs-x-square bullet'></i> Cancelled</a></li>
				</ul>
            </li>
           
            <li> <a href="?page=adminList" class="<?= $page==='adminList'?'active':'' ?>"> <i class='bx bx-shield-quarter icon'></i> Admins </a> </li>

			<li class="divider" data-text="Account">Account</li>
			<li><a href="#"> <i class='bx bxs-log-out-circle icon'></i> Log Out</a></li>
            <li><a href="#"> <i class='bx bxs-trash-alt icon' ></i> Delete</a></li>
		</ul>
	
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="profile">
				<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
				<ul class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main  id="main-content">

        <?php
            switch ($page) {
                case 'adminList':
                    include 'adminList.php';
                    break;

                case 'appendClient':
                    include 'appendClient.php';
                    break;

                case 'client' :
                    include 'client.php';
                    break;
                
                case 'categories' :
                    include 'categories.php';
                    break;

                case 'products' :
                    include 'productList.php';
                    break;
                
                case 'orders' :
                    include 'orders.php';
                    break;

                default:
                    // Default Dashboard content
            ?>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<h2>1500</h2>
							<p>Traffic</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="40%"></span>
					<span class="label">40%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>234</h2>
							<p>Sales</p>
						</div>
						<i class='bx bx-trending-down icon down' ></i>
					</div>
					<span class="progress" data-value="60%"></span>
					<span class="label">60%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>465</h2>
							<p>Pageviews</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="30%"></span>
					<span class="label">30%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>235</h2>
							<p>Visitors</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="80%"></span>
					<span class="label">80%</span>
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Sales Report</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chart">
						<div id="chart"></div>
					</div>
				</div>

		</main>
        <?php
            }
            ?>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="admin.js"></script>
</body>
</html>