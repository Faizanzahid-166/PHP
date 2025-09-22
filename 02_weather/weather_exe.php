<?php

// Initialize variables to avoid "undefined variable" warnings
$please = "";
$exists = "";
$appear_img = "";
$name = "";
$temp = "";
$humidity = "";
$wind = "";

if(isset($_GET["submit"])){
    if(empty($_GET["search"])){
        $please = "enter the city";
        error_reporting(0);
        $exists = false;
 

        
    }else{
        $city = $_GET["search"];

        $api_key  = "8a4e10d76502a982e21579227667b29a";
        //$apiUrl = "https://api.openweathermap.org/data/2.5/weather?&units=metric&q=";
        //$api_url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key&units=metric";
        //$"&units=metric"
        $exists = "";
        
        error_reporting(E_PARSE );
        //error_reporting(E_ERROR);
       //error_reporting(E_WARNING );
       //error_reporting(E_ALL & ~E_NOTICE);
       //error_reporting(E_ALL);
       //error_reporting(0);
       //ini_set("error_reporting", E_ALL);

        
        $file = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key&units=metric";
        $file_headers = @get_headers($file);
        

        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
             $exists = false . 'could not find ' ;
            $api_data = false;
           

             
        }else {
    
            
    
        
        $api_data = file_get_contents($file);//,($api_url);
       // print_r($api_data);

        $conver_call = json_decode( $api_data ,true);
        //print_r($conver_call);


       // weather_data_display_variable
        $alert = $conver_call["weather"][0]["description"];
        //echo $alert;
        $name = $conver_call["name"];
        $temp = $conver_call["main"]["temp"];
        $humidity = $conver_call["main"]["humidity"];
        $wind = $conver_call["wind"]["speed"];
        $got_it = $conver_call["weather"][0]["main"];

       // weather_img_display
        if ($got_it == "Clouds") {
         $appear_img = '<img class="m-auto mt-3" src="weather_img/cloudy.png" 
                        alt="weather" width="40%" id="weather_class">';
          }
          elseif($got_it == "Clear"){
          $appear_img = '<img class="m-auto mt-3" src="weather_img/clear.png" 
                        alt="weather" width="40%" id="weather_class">';
          }
          elseif($got_it == "Rain"){
          $appear_img = '<img class="m-auto mt-3" src="weather_img/rain.png" 
                        alt="weather" width="40%" id="weather_class">';
          }
          elseif($got_it == "Haze"){
          $appear_img = '<img class="m-auto mt-3" src="weather_img/haze.png" 
                        alt="weather" width="40%" id="weather_class">';
          }
          elseif($got_it == "Smoke"){
          $appear_img = '<img class="m-auto mt-3" src="weather_img/smoke.png" 
                        alt="weather" width="40%" id="weather_class">';
          }
          elseif($got_it == "Snow"){
          $appear_img = '<img class="m-auto mt-3" src="weather_img/snowflake.png" 
                        alt="weather" width="40%" id="weather_class">';
                    
          }
        }
    }
}else{
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>weather_exe</title>

</head>

<style>
    html { 
          background: url(bg/background.jpeg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              
          }
</style>
<script src="https://unpkg.com/@tailwindcss/browser@4"></script> 
<link href="/dist/styles.css" rel="stylesheet"> 


<body>
<div class=" m-auto mt-15 w-96 py-9 px-3 ">
    <h1 class="text-3xl text-center">
               What's The Weather?
    </h1>

    <p class="font-bold underline text-center">Enter the name of a city.</p>

    <div class="flex flex-col items-center justify-center mt-6 p-2 ">
       <div>
        <form >
         <input class="w-60  bg-gray-700 text-white border-0 rounded-md p-2 focus:bg-gray-600 focus:outline-none 
         transition ease-in-out duration-150 placeholder-gray-300 " type="text" name="search" placeholder="enter your city"
         id="input_city">

         <button  class="bg-blue-500 text-white p-1.5 rounded-md border-2 border-gray-700" name="submit" id="btn_city">
            search
        </button>
       </div> 
        </form>
        
       
    </div>
</div>

<div class="w-96 py-9 px-3  m-auto [border-4 border-double border-sky-500 bg-linear-to-r/srgb from-indigo-300 to-teal-100]">

    <div  id="error" >
        <p class="text-green-600 text-center mt-1 font-bold">
           <?php
           print_r($please);

            echo '<p class="text-red-500 text-center mt-1 font-bold">'.$exists .'</p>';
        ?>
        </p>
    </div>
        
    <div class="grid grid-cols-2 gap-3" id="toggle">
    
    <div class="col-span-2 ">
        <!-- <img class="m-auto" src="weather_img/haze.png" alt="weather" width="40%" id="weather_class"> -->
         <?php
         echo "$appear_img" ;
         ?>
    </div>

    <div class="col-span-1">
     <?php 
        echo "<h1 class='text-center ' id='city'>" . $name  .  "</h1>" ; 
     ?>
        
    </div>

    <div class="col-span-1"> 
    <?php 
        echo "<h2 class='text-center' id='temp'>" . 'Temp: ' . $temp . '°C' . '</h2>' ; 
     ?>
    </div>

    <div class="col-span-1">
        <h1 class="text-center" id="humidity">
        <?php 
          echo  'Humidity: ' . $humidity .'%'  ;
        ?>    
        </h1>
     </div>

    <div class="col-span-1"> 
        <h2 class="text-center" id="wind">
        <?php 
          echo  'Wind: ' . $wind .'km/h'  ;
        ?>     
        </h2>
    </div>

    </div>
</div>
</body>
</html> 