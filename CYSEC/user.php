<?php 

session_start();

// $logout=$_POST['logout'];
// if($logout === "logout"){
// 	session_destroy();
// 	clearstatcache();
// }
include('php/db.php');
$uid=$_SESSION['id'];
if(isset($uid)){
$query = "SELECT `id`, `email`, `date`, `address`, `case_type`, `description`, `image_path`, `uid` FROM `report_data` WHERE uid=$uid";
$result = $conn->query($query);
$query2 = "SELECT invas_data.aid,invas_data.id,invas_data.email,invas_data.date,invas_data.case_type,invas_data.uid ,usersign.name,invas_data.status FROM invas_data,usersign WHERE invas_data.uid=$uid AND usersign.id=$uid";
$result2 = $conn->query($query2);

$reported_cases_sql = "SELECT COUNT(*) as reported_cases FROM report_data";
$reported_cases_result = $conn->query($reported_cases_sql);
$reported_cases_row = $reported_cases_result->fetch_assoc();
$reported_cases = $reported_cases_row['reported_cases'];

// Count solved cases
$solved_cases_sql = "SELECT COUNT(*) as solved_cases FROM invas_data  WHERE status='Approve'";
$solved_cases_result = $conn->query($solved_cases_sql);
$solved_cases_row = $solved_cases_result->fetch_assoc();
$solved_cases = $solved_cases_row['solved_cases'];

// Calculate total cases
$total_cases = $reported_cases + $solved_cases;
$new_report=  $reported_cases-$solved_cases;

}else{
	header("Location: log.php");	
}
if (!isset($_SESSION["name"])) {
   
    header("Location: log.php");
    exit();
}


$username = $_SESSION["name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/user.css">

	<title>CYSEC. | user</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="user.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">CYSEC. <sub>User</sub></span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#dashboard">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#reports">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Reports</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			<li>
				<a href="php/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text" name="logout">Logout</span>
				</a>
			</li>
		</ul>
        
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<!-- <p class="nav-link">Categories</p> -->
			<div class="form-input">

			</div>
			<h1 style="padding-left:800px;float:right;"></h1>Welcome, <?php echo $username ?>!</h1>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div id="dashboard" class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#dashboard">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>

                <a href="application.php" class="btn-download">
					<span class="text">ADD Report</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $new_report ?></h3>
						<p>New Report</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $solved_cases ?></h3>
						<p>Solved Cases</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo $total_cases ?></h3>
						<p>Total Cases</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Approved Reports</h3>
						<!-- <i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i> -->
					</div>
					<table>
						<thead>
							<tr>
								<th>Client Name</th>
								<th>Email</th>
								<th>Report Date</th>
								<th>Case Type</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if ($result2->num_rows > 0) {
 							 $sn=1;
							while($data = $result2->fetch_assoc()) {
								
 							?>
							<tr>
							
								<td>
									
									<p><?php echo $data['name']; ?></p>
								</td>
								<td>
									
									<p><?php echo $data['email']; ?></p>
								</td>
								<td><?php echo $data['date']; ?></td>
								<td>
									
									<p><?php echo $data['case_type']; ?></p>
								</td>
								<?php if($data['status']==="Approve"){?>
								<td><span class="status completed">Completed</span></td>
								<?php }else{?>
									<td><span class="status pending">Canceled</span></td>
									<?php }?>
							</tr>
							<?php
 									 $sn++;}} else { ?>
								    <tr>
									     <td colspan="8">No data found</td>
 									   </tr>
 								<?php } ?>
						</tbody>
					</table>
				</div>
				
			</div>
			<section id="reports">
				<div id="dashboard" class="head-title">
					<div class="left">
						<h1>Reports</h1>
					</div>
				</div>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3>Reports</h3>
						</div>
						
						<table>
							<thead>
								<tr>
									<th>Email</th>
									<th>Report Date</th>
									<th>Case Type</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if ($result->num_rows > 0) {
 							 $sn=1;
							while($data = $result->fetch_assoc()) {
 							?>
								<tr >
									<td style="padding-right:40px">
			
										<p > <?php echo $data['email']; ?>  </p>
									</td>
									<td style="padding-right:40px"> <p> <?php echo $data['date']; ?></p>  </td>
									
									<td style="padding-right:40px">  <p><?php echo $data['case_type']; ?> </p> </td>
								
								</tr>
								<?php
 									 $sn++;}} else { ?>
								    <tr>
									     <td colspan="8">No data found</td>
 									   </tr>
 								<?php } ?>
							</tbody>
						</table>

					</div>
					
				</div>
			</section>
		</main>
	</section>


	
	

	<script src="js/admin.js"></script>
</body>
</html>