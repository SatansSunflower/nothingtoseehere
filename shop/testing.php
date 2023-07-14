<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
<div class="grey-bg container-fluid">
    <?php
    $conn = new mysqli("localhost", "root", "", "mydb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM shop";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row["idshop"] % 2 != 0) {
                echo '<div class="row">';
            }
            echo '  
      
              <div class="col-xl-3 col-sm-6 col-12"> 
                <div class="card">
            <img class="card-img-top" src="'.$row["image"].'" alt="'.$row["name"].'">

                    <div class="card-body">
                      <div class="media d-flex">
                      <h5 class="card-title">'.$row["name"].'</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                      </div>
                  </div>
                </div>
              </div>
          
            
          
        ';
        if($row["idshop"] % 2 != 0) {
            echo '</div>';
        }
            // echo '<div class="row">
            // <div class="col-sm-6">
            //   <div class="card">
            // <img class="card-img-top" src="'.$row["image"].'" alt="'.$row["name"].'">
            //     <div class="card-body">
            //       <h5 class="card-title">'.$row["name"].'</h5>
            //       <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            //       <a href="#" class="btn btn-primary">Go somewhere</a>
            //     </div>
            //   </div>
            // </div>';
        //     echo '<div class="card w-50">
        //     <img class="card-img-top" src="'.$row["image"].'" alt="'.$row["name"].'">
        //     <div class="card-body">
        //       <h5 class="card-title">'.$row["name"].'</h5>
        //       <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        //       <a href="#" class="btn btn-primary">Button</a>
        //     </div>
        //   </div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();


    
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>