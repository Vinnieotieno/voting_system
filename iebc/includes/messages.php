
    <?php 
    if(!empty($success)){
        foreach($success as $value){
            echo "<div class='bg-success text-center text-light'>
            <p style='font-family:cursive;' class='lead p-2'>$value <br></p>
            </div>";
       }
    }


    if(!empty($errors)){
        foreach($errors as $value){
            echo "<div  class='bg-danger text-center text-light'>
            <p style='font-family:cursive;' class='lead p-2'>$value <br></p>
            </div>";
       }
    }
    ?>

