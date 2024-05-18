<!DOCTYPE HTML>

<html>

<head>
</head>

<body>
	<?php
	try {
		require_once '../includes/dbconnection.php';

		/*If the accept button was clicked*/
		if ($_POST['accrej'] == 'Accept') {
			$schID = $_POST['schID'];
			$sql = "UPDATE `scholarship` SET `adminapproval` = 'Approved' WHERE `scholarship`.`scholarshipID` = $schID;";
			if ($conn->query($sql) === TRUE) {
	?>
				<script type="text/javascript">
					alert('Scholarship is Accepted!');
					location.replace("../admin/tempScholarship.php");
				</script>
			<?php

			} else {
			?>
				<script type="text/javascript">
					alert('Error updating record');
					location.replace("../admin/tempScholarship.php");
				</script>
			<?php
			}
		}

		/*If the reject button was clicked*/ else if ($_POST['accrej'] == 'Reject') {
			$schID = $_POST['schID'];
			$sql = "UPDATE `scholarship` SET `adminapproval` = 'Rejected' WHERE `scholarship`.`scholarshipID` = $schID;";
			if ($conn->query($sql) === TRUE) {
			?>
				<script type="text/javascript">
					alert('Scholarship is Rejected!');
					location.replace("../admin/tempScholarship.php");
				</script>
			<?php

			} else {
			?>
				<script type="text/javascript">
					alert('Error updating record');
					location.replace("../admin/tempScholarship.php");
				</script>
	<?php
			}
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	?>
</body>

</html>