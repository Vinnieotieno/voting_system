<script>
   function showPass(){
    var password = document.getElementById("password")
    var Cpassword = document.getElementById("Cpassword")

    if(password.type === 'password' && Cpassword.type == 'password'){
        password.type = 'text' 
        Cpassword.type = 'text'
    }else{
        password.type = 'password' 
        Cpassword.type = 'password'
    }
   }
</script>
<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"> </script>
<footer class="text-center mt-5 p-5">
    IEBC Electrol Board, All Rights reserved <br>
    Copyright &copy; 2022 <br>
    rolltech5920@gmail.com <br>
    Group 3 <br>
    <i class="bi bi-facebook text-primary"></i>
    <i class="bi bi-whatsapp text-success"></i>
    <i class="bi bi-twitter text-info"></i>
    <i class="bi bi-instagram text-danger"></i>
</footer>
</body>
</html>