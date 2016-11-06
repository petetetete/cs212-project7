<?php include "php/bounceCheck.php" ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		<title>Home - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>
			
			<div class="main-body">
				<div class="main-body-sidebar">
					I am a sidebar and I can have lots of coolio content
				</div>
				<div class="main-body-content">
					<h2 class="partay-img">I am the most important lorem ipsum</h1>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore <b>magna aliqua</b>. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. <i>Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</i>
					</p>

					<h2 class="magenta-img">I am merely a peon lorem ipsum</h3>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. <small>Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur</small>. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>

					<ol>
						<li>First</li>
						<li>
							Additional
							<ul>
								<li>Nested unordered list</li>
								<li>Now with dots</li>
								<li>Has technology gone too far</li>
							</ul>
						</li>
						<li>Third</li>
						<li>Quatro</li>
					</ol>

					<a href="info.php">Click to go to a second page</a>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>
		<div class="fixed-notification material">
			Breaking news!
		</div>
	</body>
</html>