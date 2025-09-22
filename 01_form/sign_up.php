<?php
$insert = false;
if(isset($_POST['name'])){

// Create connection
$servername = "localhost";
$username = "root";
$password = "";



$conn = mysqli_connect($servername, $username, $password,  "sm_project");

// Check connection
if (!$conn) {
  die("Connection failed:" . mysqli_connect_error());
}
echo "success to connect" ;

//create variable
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];


// $sql = "INSERT INTO `form_database`.`sm_project` (`name`, `last_name`, `email`, `password`) VALUES ('$name','$lastname', '$email', '$password');";
$sql = "INSERT INTO form_database (name, lastname, email, password) VALUES ('$name','$lastname', '$email', '$password');";
//echo $sql;

//insert data
if ($conn->query($sql) == true) {
	//echo "created successfully";
	$insert = true;
  } else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>sign_up</title>

	 <script src="https://unpkg.com/@tailwindcss/browser@4"></script> 
	<link href="/dist/styles.css" rel="stylesheet"> 


</head>


<body class="bg-gray-800">

	<div class=" border-4 border-indigo-600 rounded-md h-screen  ">

        <!-- <div class="w-2/5 bg-white  border-4 border-double border-indigo-600 rounded-md  m-auto mt-30 p-5"> -->
        	<div class="flex flex-col items-center justify-center mt-15 ">

        	<div class="w-full max-w-md bg-[#222] rounded-xl shadow-md py-2 px-8 ">
	
		<h1 class="text-blue-500 text-[28px] text-center mt-3 py-6" >Sign Up</h1>

         <?php
		 if($insert == true){
		           echo"<p class='text-green-500 text-center -mt-6 mb-2'>signup successfully</p>";
		 }
		?>
		<form action="sign_up.php" method="POST" class="grid gap-10 self-center">
			<input class="w-full bg-gray-700 text-white border-0 rounded-md p-2 focus:bg-gray-600 focus:outline-none 
			              transition ease-in-out duration-150 placeholder-gray-300 "
			              type="text" name="name" placeholder="first_name">

			<input  class="w-full bg-gray-700 text-white border-0 rounded-md p-2 focus:bg-gray-600 focus:outline-none 
			              transition ease-in-out duration-150 placeholder-gray-300 "
			               type="text" name="lastname" placeholder="last_name">

			<input  class="w-full bg-gray-700 text-white border-0 rounded-md p-2 focus:bg-gray-600 focus:outline-none 
			              transition ease-in-out duration-150 placeholder-gray-300 "
			               type="email" name="email" placeholder="email">

			<input  class="w-full bg-gray-700 text-white border-0 rounded-md p-2 focus:bg-gray-600 focus:outline-none 
			              transition ease-in-out duration-150 placeholder-gray-300 "
			              type="password" name="password" placeholder="password">

			              	<button class=" bg-cyan-500 w-1/2 text-white border-0 rounded-md p-2 focus:bg-red-600 focus:outline-none transition ease-in-out duration-150 ml-22 ">Submit</button>

			         
	

               </form>



         </div>
		</div>
	</div>

</body>
</html>