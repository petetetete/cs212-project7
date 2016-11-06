<?php
	include "php/bounceCheck.php";

	// Array of form elements so inputs can easily be added later
	//  - label: Placeholder for the input
	//  - value: Value of the input, can be defaulted by initializing a value in the array
	//  - error: The error message for the input, can be defaulted by initializing a value in the array
	//  - type: The type of interaction field to be used
	//    - input: Default HTML input field
	//    - textarea: Default HTML textarea
	//    - select: Default HTML select
	//  - options: A key only required when the input type is 'select', expects an array
	//  - check: An array of errors to check for
	//    - blank: Checks if the input is blank
	//    - email: Checks if the input is a valid email
	$data = array(
		"email" => array(
			"label" => "Your email address",
			"value" => "",
			"error" => "",
			"type" => "input",
			"check" => array("blank", "email")
		),
		"subject" => array(
			"label" => "Subject",
			"value" => "",
			"error" => "",
			"type" => "input",
			"check" => array("blank")
		),
		"category" => array(
			"label" => "Enter your feedback reason",
			"value" => "",
			"error" => "",
			"type" => "select",
			"options" => array("Complaint", "Question", "Suggestion", "Praise", "Other"),
			"check" => array("blank")
		),
		"message" => array(
			"label" => "Enter your message",
			"value" => "",
			"error" => "",
			"type" => "textarea",
			"check" => array("blank")
		)
	);
	$toEmail = "ph289@nau.edu"; // The email to be sent to
	$anyError = "";

	// Check if the user has submitted the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Iterate through data
		$anyErrorFound = false;
		foreach($data as $field => $info) {

			// Iterate through the error check array in order to do validation
			$errorFound = false;
			foreach ($info["check"] as $check) {

				// Check for blank error
				if ($check == "blank" && empty($_POST[$field])) {
					$data[$field]["error"] = "Field is blank";
					$anyErrorFound = true;
					$errorFound = true;
					break;
				}

				// Check for invalid email address
				else if ($check == "email") {

					if ($_POST[$field] && filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
						$allowedDomains = array("com", "org", "edu", "gov");
						$emailDomain = array_pop(explode(".", $_POST[$field]));

						if (!in_array($emailDomain, $allowedDomains)) {
							$data[$field]["error"] = "Email is invalid";
							$anyErrorFound = true;
							$errorFound = true;
							break;
						}							
						
					}
					else {
						$data[$field]["error"] = "Email is invalid";
						$anyErrorFound = true;
						$errorFound = true;
						break;
					}
				}

				// Check if input is numeric
				else if ($check == "number" && !is_numeric($_POST[$field])) {
						$data[$field]["error"] = "Field is not a number";
						$anyErrorFound = true;
						$errorFound = true;
						break;
				}
			}

			// If no error was found, set the value of the current input to the value posted so it persists
			if (!$errorFound) $data[$field]["value"] = $_POST[$field];
		}

		if (!$anyErrorFound) {

			// Set timezone, and get current time
			date_default_timezone_set("MST");
			$currDate = date("n/j/Y g:i:s A");

			// Create email headers
			$headers =  "MIME-Version: 1.0" . "\r\n" .
						"Content-type: text/html; charset=iso-8859-1" . "\r\n" .
						"From: " . $data["email"]["value"] .  "\r\n" .
    					"Cc: " . $data["email"]["value"] . "\r\n" .
    					"X-Mailer: PHP/" . phpversion();

    		// Create email message
		    $message = "<html><body><h4>Feedback Type</h4><p>" . 
		    			$data["category"]["value"]."</p><h4>Message</h4><p>" .
		    			$data["message"]["value"]."</p><h4>Date/Time sent:</h4><p>" .
		    			$currDate."</p></body></html>";

		    // Send email and give user notification
			mail($toEmail, $data["subject"]["value"], $message, $headers);
			$anyError = "Your email has been sent!";
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<?php include "partials/head.html" ?>
		<title>Form - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>

			<div class="main-body">
				<div class="main-body-sidebar">
					I am an example form page!
				</div>
				<div class="main-body-content">
					<h2 class="partay-img">Form</h2>
					<div class="form-container">

						<!-- Itereate through the data array and render the form -->
						<?php 
							echo '<form method="POST" action="', htmlspecialchars($_SERVER["PHP_SELF"]), '">';

							foreach ($data as $field => $info) {

								// If type is input
								if ($info["type"] == "input") {
									echo '<input type="text" name="', $field, '" placeholder="', $info["label"], '" value="', htmlspecialchars($info["value"]), '" />';
								}

								// If type is textarea
								else if ($info["type"] == "textarea") {
									echo '<textarea name="', $field, '" placeholder="', $info["label"], '">', htmlspecialchars($info["value"]), '</textarea>';
								}

								// If type is select
								else if ($info["type"] == "select") {
									echo '<select name="', $field, '">';
									echo '<option value="" disabled selected>', $info["label"], '</option>';
									foreach ($info["options"] as $option) {
										echo '<option value="', $option, '" ', htmlspecialchars($info["value"]) == $option ? 'selected' : '', '>', $option, '</option>';
									}
									echo '</select>';
								}
								echo '<div class="error-message">', $info["error"], '</div>';
							}
							echo '<button type="submit">Submit</button>';
							echo '</form>';
							if ($anyError != "") echo '<div class="fixed-notification success material"> ', $anyError, '</div>';

						?>

					</div>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>
	</body>
</html>