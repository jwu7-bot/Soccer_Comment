<?php 

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/22/2024
    Description: Home page

****************/

include('server.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
	<title>Home</title>
</head>
<body>
<div class="container-fluid">
	<div class="row d-flex justify-content-between">
		<!-- navigation -->
		<div class="col-md-3">
			<?php include('nav.php'); ?>
		</div>

		<div class="header col-md-9">
			<div class="content col-md-8" style="padding-top: 5%;">
				<main class="recent">
					<h1 class="mb-4">Comments</h1>
					<br>
				</main>

				<!-- sort by dropbox-->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
					<label for="sort_by">Sort by:</label>
					<select name="sort_by" id="sort_by">
						<option value="date_posted">Date Posted</option> 
						<option value="users">Username</option>
					</select>
					<button type="submit">Sort</button>
				</form>
				
				<?php
					// default sorting column
					$sort_by = "date_posted";

					// check if a sorting preference is submitted
					if (isset($_GET['sort_by'])) {
						$sort_by = $_GET['sort_by'];
					}
				
					// retrieve comments, players, and users
					$sql = "SELECT comments.*, players.*, users.*
							FROM comments 
							INNER JOIN players ON comments.player_id = players.player_id 
							INNER JOIN users ON comments.user_id = users.user_id";
				
					// sort by date posted
					if ($sort_by === "date_posted") {
						$sql .= " ORDER BY comments.date_posted DESC";
					}
					// sort by users
					elseif ($sort_by === "users") {
						$sql .= " ORDER BY users.username ASC";
					}

					$result = $db->query($sql);

					// check if there are comments
					if ($result->num_rows > 0) {
						// loop each comment
						while($row = $result->fetch_assoc()) {
							// print each comment
							$username = $row["username"];
							$player = $row['name'];
							?>
								<div class="card mb-4">
									<div class="card-body">
										<?php if (!empty($row['profile_pic'])): ?>
											<img src="<?php echo $row['profile_pic']; ?>" alt="Profile Picture" style="max-width: 80px;" class="mr-3">
										<?php endif; ?>
										<h5 class="card-title"><?php echo $username . " about " . $player; ?></h5> <!-- username and player name -->
										<p class="card-text"><?php echo $row["comment"]; ?></p> <!-- display comment -->
										<p class="text-muted">Posted on: <?php echo $row["date_posted"]; ?></p> <!-- display date -->
									</div>
								</div>
							<?php
						}
					// no comments 
					} else {
						echo "No comments found.";
					}
				?>
			</div>
			<!-- footer -->
			<?php include('footer.php'); ?>   
		</div>
	</div>
</div>
</body>
</html>