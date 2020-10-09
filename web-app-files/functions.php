<?php

/*
---------------------------------
1. FUNCTION TO SANITIZE THE INPUT
---------------------------------
This function is just used to test that the form is working.
*/

function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
		}


/*
---------------------------------
1. TEST THAT THE FORM IS WORKING
---------------------------------
This function is just used to test that the form is working.
*/


//Note the use of & before the $conn variable.
//It must be removed in the function call.
function test_form($word, $fileName, $fileExtension, &$conn) {


	//this function will strip out unecessary characters, remove backslashes and
	//convert special characters to HTML entities (protects against attacks)
	/*function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
		}*/

	
	if ($_POST["updatebtn"]) { //references the name of the button 
	
		//capture word input
			$word = test_input($_POST["word"]);
		
		//capture fileName
			$fileName = test_input($_POST["fileName"]);
			
		//capture fileExtension
			$fileExtension = test_input($_POST["fileExtension"]);
			
		echo "Hello";
		echo $word;
		echo $fileName;
		echo $fileExtension;
	}
}


/*
--------------------------------
2. CREATE RECORD
--------------------------------
Creates the very first record in the table.
*/

//note the use of & before the $conn variable
function create_record($word, $fileName, $fileExtension, &$conn) {


	//this function will strip out unecessary characters, remove backslashes and
	//convert special characters to HTML entities (protects against attacks)
	/*function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
		}*/


	
	if ($_POST["updatebtn"]) { //references the name of the button 
	

		
		//capture word
			$word = test_input($_POST["word"]);
		
		//capture file name
			$fileName = test_input($_POST["fileName"]);

		//capture file extension
			$fileExtension = test_input($_POST["fileExtension"]);
		
			//prepare and bind
			$stmt = $conn->prepare("INSERT INTO VideoList (word, file_name, file_extension) 
			VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $word, $fileName, $fileExtension);

			//set parameters and execute
			$work = $work;
			$fileName = $fileName;
			$fileExtension = $fileExtension;

			$stmt->execute();

			echo "New record created successfully";
			$stmt->close();
			

			
			
		
	}
}





/*
---------------------------------------
4. SEARCH TABLE AND DISPLAY THE RESULT
---------------------------------------
Searches the table and displays a clickable
result. 
*/


function search_table($searchWord, &$conn) {

		/*function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = strip_tags($data);
			$data = htmlentities($data);
			return $data;
		}*/

$elementid = ' "video3" ';
	
	if ($_POST["searchbtn"]) {

	
	//Assign the search word to a variable
	$searchWord = test_input($_POST["searchWord"]);

	
	//Database Query Statement
	/* Note: The LIKE operator can deliver a lot of matching search results - 
	like if the use only enters the letter 'a'.
	Therefore, the code below needs to be adjusted to only deliver
	a specified number of matching rows e.g. 10.
	*/
	if ($searchWord != "") { 
	/* NOTE: If this test condition is missing the entire
	column will be returned if 'search' is clicked when
	the search box is empty. */
	
	
	$query = "SELECT * FROM VideoList WHERE (`word` LIKE '%".$searchWord."%') ";
	
	//run the query
	$result = mysqli_query($conn, $query);
	
//determine the number of rows in the result set
	$numrows = mysqli_num_rows($result);
	
	
	//If the user has no records, print an example row
	if ($numrows == 0) {
		//print an example entry
		echo "<h4>Word not found: " . $searchWord;
		echo "</h4>";
	} else {
	
		//loop through each row
		//we only want to print the first 3 results
		for ($x = 0; $x < 4; $x++) {
		
			//identify the row number (row 1, row 2, etc)
			mysqli_data_seek($result, $x);
		
			//convert that row into an associative array
			$row = mysqli_fetch_assoc($result);
			
			$a = $row["file_name"];
		
			//print each array element
			echo "<a href='#frontpage' onclick='document.getElementById(\"video1\").src = \" ";
			echo $row["file_name"];
			echo " \" '>";
			
			
			echo "<h4>" . $row["word"] . "</h4>";
			
			echo "</a> ";
			
			//echo $row["file_name"];
			
			echo " ";
		}
		}
	}
	
	
	}
}



?>