<?php 
    function pg_connection_string_from_database_url(){
        extract(parse_url($_ENV["DATABASE_URL"]));
        return "user=$user password=$pass host=$host dbname=".substr($path,1);
    }
    $db = pg_connect(pg_connection_string_from_database_url());
    if(!$db){
        echo "Error";
    }else{
        echo "Opened database successfully \n";
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $pass = $_POST['password'];
        $sql = "insert into test values ('$name', '$pass')";
        $ref = pg_query($db,$sql);
        if($ref){
            echo "ADD COMPLETE";
            echo "<br>\n";
        }


    }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


    <form method="post" action="demo.php">
        name: <input type="text" name="name">
        pass: <input type="text" name="password"> 
        <br>
        <button type='submit'>Submit</button>
        <br>




    </form>
    <h2>LIST:</h2>
    <?php         
        $sql = "select * from test";        
        $ref = pg_query($db,$sql);
        if(!$ref){
            echo "ERROR SELECT ";
        }else{
          while($row= pg_fetch_assoc($ref)){
                print("<p>".$row['name']."---".$row['password']."</p>");
            }
        }
        pg_close($db);
    ?>


</body>
</html>