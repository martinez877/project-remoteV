/*
 * Copyright (c) Clara Martinez Rubio, Thomas Kaizer, Matthew Hood 2020. All rights reserved.
 * Last modified 5/10/20 10:34 AM
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 */


<?php
$conn = new mysqli("127.0.0.1","cmarti21", "dwnvs7Xp", "cmarti21_1");
if($conn-> connect_errno){
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
session_start();
?>
<?php
	
	$student_id = $_SESSION["student_id"];
        $declining = $_POST['requestedDeclining'];
        $item_id = $_POST['itemID'];
	$sql_check = "Select `StudentID` from `listings` where ItemID = $item_id";
        $result_check=$conn->query($sql_check);
        $row =  mysqli_fetch_assoc($result_check);
      if(implode(", ",$row) == (string)$_SESSION["student_id"]){
        $sql = "UPDATE listings SET RequestedDeclining=$declining WHERE ItemID=$item_id";
        $result = $conn->query($sql);

        if(mysqli_affected_rows($conn) > 0){
                echo '<p>User Added</p>';
                echo '<a href="addListing.php">Go back</a>';
                echo '<br>';
                echo '<a href="listings.php">Check the updated listing table</a>';
                echo '<br>';
                echo '<a href = "product.php">Check the updated product table</a>';
                header("Location: http://betaweb.csug.rochester.edu/~cmarti21/userListings.php");
        }
        else{
                echo '<p>Listing not added. There was a problem.</p>';
                echo mysqli_error($conn);
		//header("Location: http://betaweb.csug.rochester.edu/~cmarti21/userListings.php?failed=true");
        }
}
else{
	header("Location: http://betaweb.csug.rochester.edu/~cmarti21/updateListing.php?failed=true");
}
?>
