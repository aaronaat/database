<html>
      <head>
           <title>Webslesson Tutorial</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <style>

   .box
   {
    width:750px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:100px;
   }
  </style>
      </head>
      <body>
        <div class="container">
          <h3 align="center">Import JSON File Data into Mysql Database in PHP</h3><br />
          <?php

          $filename = htmlspecialchars($_GET["file"]);

          $connect = mysqli_connect("localhost", "root", "root", "test"); //Connect PHP to MySQL Database
          $query = '';
          $data = file_get_contents($filename); //Read the JSON file in PHP
          $array = json_decode($data, true); //Convert JSON String into PHP Array
          foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {

           $t1 = str_replace("'","",$row["title"]);
           $t2 = str_replace('"','',$t1);
           $t3 = str_replace(";","",$t2);

           $d1 = str_replace("'","",$row["description"]);
           $d2 = str_replace('"','',$d1);
           $d3 = str_replace(";","",$d2);

           $platforms = $row["platforms"][0]["platform_name"] . ", " . $row["platforms"][1]["platform_name"] . ", " . $row["platforms"][2]["platform_name"] . ", " . $row["platforms"][3]["platform_name"] . ", " . $row["platforms"][4]["platform_name"] . ", " . $row["platforms"][5]["platform_name"] . ", " . $row["platforms"][6]["platform_name"] . ", " . $row["platforms"][7]["platform_name"] . ", " . $row["platforms"][8]["platform_name"]  . ", " . $row["platforms"][9]["platform_name"] . ", " . $row["platforms"][10]["platform_name"] . ", " . $row["platforms"][11]["platform_name"] . ", " . $row["platforms"][12]["platform_name"] . ", " . $row["platforms"][13]["platform_name"];

           $year = $row["platforms"][0]["first_release_date"];
           $rating =$row["moby_score"];
           $image =$row["sample_cover"]["image"];
           $thumb =$row["sample_cover"]["thumbnail_image"];

           $query .= "INSERT INTO games(title, description, genre, platforms, year_released, rating, image_large, thumbnail_image) VALUES ('".$t3."', '".$d3."', '".$row["genres"][0]["genre_name"]."', '".$platforms."', '".$year."', '".$rating."', '".$image."', '".$thumb."'); <br>";  // Make Multiple Insert Query

           $nq = str_replace(" ,", "", $query);
           $n = str_replace(", ')", "')", $nq);
          }


     echo $n;



          ?>
     <br />
         </div>
      </body>
 </html>
