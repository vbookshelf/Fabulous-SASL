<?php



/*
---------------------------------------
4. SEARCH TABLE AND DISPLAY THE RESULT
---------------------------------------
Searches the table and displays a clickable
result. 
*/

//Collect the variable sent via Ajax
$searchWord = $_REQUEST["searchWordID"];



		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = strip_tags($data);
			$data = htmlentities($data);
			return $data;
		}
	
	//Create a database connection
	require 'createconnection.php';

	
	//Assign the search word to a variable
	$searchWord = test_input($searchWord);

	
	/*PROBLEMS WITH THE WORD: Don't
1. php sees the comma as part of the programming
syntax and gives an error. To solve the problem
we use the str_replace() method to replace ' with \'.
The \' tells php that the apostrophe is part of the string.

2. When the user enters the word dont (without apostrophe)
no search suggestions are given.
*/

	/* Note: str_replace() is case sensitive.
	str_ireplace() is not casesensitive.
	Mobile device keyboards automatically capitalise the
	first letter that the user types in.
	*/
	$searchWord = str_ireplace("dont","don't",$searchWord);
	$searchWord = str_ireplace("cant","can't",$searchWord);
	$searchWord = str_ireplace("ok","ok!",$searchWord);
	$searchWord = str_ireplace("im","i'm",$searchWord);
	$searchWord = str_ireplace("its","it's",$searchWord);
	$searchWord = str_ireplace("whats","what's",$searchWord);

	$searchWord = str_replace("'","\'",$searchWord);

	
	
	/*
	============
	EXACT MATCH - Appears on the very first row
	Note: mySQL queries are not case sensitive by default.
	============
	*/
	
		///$query1 = "SELECT * FROM VideoList WHERE word = '$searchWord' ";
	
	//run the query
	///$result1 = mysqli_query($conn, $query1);
	
//determine the number of rows in the result set
	///$numrows1 = mysqli_num_rows($result1);
	
	
	//If the user has no records, print an example row
	///if ($numrows1 == 0) {
		//print an example entry
		//echo "<h4>Word not found: " . $searchWord;
		//echo "</h4>";
		//echo " ";
	///} else {
	
		//loop through each row
		//we only want to print the first 3 results
		///for ($x1 = 0; $x1 < 2; $x1++) {
		
			//identify the row number (row 1, row 2, etc)
			///mysqli_data_seek($result1, $x1);
		
			//convert that row into an associative array
			///$row1 = mysqli_fetch_assoc($result1);
			

		
			//print each array element
			///echo "<a href='#frontpage' onclick='document.getElementById(\"video1\").src = \" ";
			///echo "Videos/" . $row1["file_name"];
			///echo " \" '>";
			
			
			///echo "<h4>" . $row1["word"] . "</h4>";
			
			///echo "</a> ";
			
			//echo $row["file_name"];
			
			///echo " ";
		///}
		
	///}
	
	
	/*
	================
	SIMILAR MATCHES
	================
	*/
	
	
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
	
	
	$query = "SELECT * FROM VideoList WHERE (`word` LIKE '".$searchWord."%') ";
	
	//run the query
	$result = mysqli_query($conn, $query);
	
//determine the number of rows in the result set
	$numrows = mysqli_num_rows($result);
	
	
	//If the user has no records, print an example row
	if ($numrows == 0) {
		//print an example entry
		//echo "<h4>Word not found: " . $searchWord;
		//echo "</h4>";
		echo " ";
	} else {
	
		//loop through each row
		//we only want to print the first 3 results
		for ($x = 0; $x < 6; $x++) {
		
			//identify the row number (row 1, row 2, etc)
			mysqli_data_seek($result, $x);
		
			//convert that row into an associative array
			$row = mysqli_fetch_assoc($result);
			

		
			//print each array element
			echo "<a href='#frontpage' onclick='document.getElementById(\"video1\").src = \" ";
			echo "Videos/" . $row["file_name"];
			echo " \" '>";
			
			
			echo "<h4>" . $row["word"] . "</h4>";
			
			echo "</a> ";
			
			//echo $row["file_name"];
			
			echo " ";
		}
		
	}
	
	
 }


?>