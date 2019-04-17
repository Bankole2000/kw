<?php
session_start();
if (isset($_SESSION["admin_email"])) {
    header("location: index.php"); 
    exit();
};
 ?>

<?php
// Connect to Database
if(isset($_POST['submit'])){
   
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        
        $email = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["email"]); // filter everything but numbers and letters
        $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
        
$sql = "SELECT * FROM gw.admin WHERE email = '{$_POST['email']}' &&password = '{$_POST['password']}' LIMIT 1";
    
   include_once('../scripts/connect.php');
   $result = $db->query($sql);
    if($result->num_rows===1){
         while($admin_details = $result->fetch_array()){
        $_SESSION['admin_id'] = $admin_details['admin_id'];
        $_SESSION['admin_email']= $admin_details['email'];
        $_SESSION['admin_password']= $admin_details['password'];
                     
    }
        
        header("location: index.php");
         exit();} else {
        echo 'That information is incorrect, try again <a href="../index.html">Click Here</a>';
		exit();
        
    }
        
}};
?>



<!DOCTYPE html>
<html>

<head>

    <!--Import Font Awesome-->
    <link href="../_assets/fonts/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../_assets/css/main.css" />
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_assets/css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>KoboWize Login</title>

</head>

<body>

  <div class="row section">
    <form class="col s12 m12 l12 center" style="padding-top:25%; width:100%;" action="" method="POST">
      
      <div class="row">
      <div class="col s12 m12 l12"> <img src="../_assets/img/instagram.png" style="width:70%;" alt=""></div>       
      </div>
      
      <div class="row">
        <div class="input-field col s12">
          <input name="email" type="email" class="validate">
          <label for="email"><i class="fa fa-envelope fa-2x" data-fa-transform="down-1 right-2"></i>&nbsp; &nbsp; Email </label>
<!--          <span class="" style="display: none;">This Field cannot be empty</span>-->
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="password" type="password" class="validate">
          <label for="password" class="center">   <i class="fa fa-lock fa-2x" data-fa-transform=" right-2"></i>&nbsp; &nbsp;
Password</label>
        </div>
      </div>
      <div class="row">
      <div class="col l12 m12 s12 center">
     <button class="btn-large waves-effect waves-light green" type="submit" name="submit" style="border-radius:25px; ">Login &nbsp;
    <i class="fa fa-sign-in-alt fa-2x" data-fa-transform="down-3"></i>
          </button></div>
          
        </div>
    </form>
      
  </div>
             <!-- Preloader -->
  <div class="loader preloader-wrapper big active">
    <div class="spinner-layer spinner-blue">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div>
      <div class="gap-patch">
        <div class="circle"></div>
      </div>
      <div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
    <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
            <!-- ================ END OF FOOTER ========================= -->

            <!--Import jQuery before materialize.js-->
            <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
            <script type="text/javascript" src="../_assets/js/materialize.min.js"></script>
            <script type="text/javascript" src="../_assets/js/vue.js"></script>
            <script type="text/javascript" src="../_assets/fonts/svg-with-js/js/fontawesome-all.min.js"></script>

            <script>
    // Hide Sections
    $('.section').hide();
        

    setTimeout(function () {
      $(document).ready(function () {
        // Show sections
        $('.section').fadeIn(1000);
         
        // Hide preloader
        $('.loader').fadeOut();

       
       

        
        

      });
    },100);
  </script>
           
</body>

</html>