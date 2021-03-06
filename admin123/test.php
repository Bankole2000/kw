<?php 
 require_once('../scripts/connect.php');
$query = "SELECT * FROM gw.user_table ORDER BY user_id ASC";
        $result = $db->query($query);
        $output = '';
        while($row = $result->fetch_array())
        {
            $output .= '<tr>
                            <td>'.$row["user_id"].'</td>
                            <td>'.$row["first_name"].' '.$row["last_name"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                            <td>'.$row["gender"].'</td>
                            <td>'.$row["signup_date"].'</td>
                            <td><button type="button" name="update" id="'.$row["user_id"].'" class="update btn orange waves-effect waves-light">Update</button></td>
                            <td><button type="button" name="view" id="'.$row["user_id"].'" class="view btn orange waves-effect waves-light">View</button></td>
                            <td><button type="button" name="delete" id="'.$row["user_id"].'" class="delete btn red waves-effect waves-light">Delete</button></td>
                        </tr>
                            '; 
        };

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.css">
    
<!--    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-grid.min.css.map">-->
<!--    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="../_assets/css/bs/bootstrap.min.css.map">-->
<!--    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-reboot.min.css">-->
<!--    <link rel="stylesheet" href="../_assets/css/bs/bootstrap-reboot.min.css.map">-->
    <link rel="stylesheet" href="../_assets/css/bs/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../_assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../_assets/css/bs/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../_assets/fonts/css/fontawesome-all.min.css">
    <link href="../_assets/fonts/svg-with-js/css/fa-svg-with-js.css" rel="stylesheet">
    <link rel="stylesheet" href="../_assets/css/mainbs.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href="index.html" class="navbar-brand">Instagram</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target='#navbarCollapse'>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link">Home</a>
                    </li>
                <li class="nav-item">
                        <a href="" class="nav-link">link 2</a>
                    </li>
                <li class="nav-item">
                        <a href="" class="nav-link">Link 3</a>
                    </li>
                <li class="nav-item">
                        <a href="" class="nav-link">Link 4</a>
                    </li>
                <li class="nav-item">
                        <a href="" class="nav-link">Link 4</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!--   Home Section -->
   <header id="home-section">
       <div class="dark-overlay">
           <div class="home-inner">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-8 d-none d-lg-block">
                           <h1 class="display-4 text-white">Build <b>social Profiles</b> and gain revenue and <b>profits</b></h1>
                           <div class="d-flex flex-row text-white">
                               <div class="p-4 align-self-start">
                                   <i class="fa fa-check"></i>
                               </div>
                               <div class="p-4 align-self-end">
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi, pariatur. Accusamus facere quibusdam iusto, nam libero, vitae hic distinctio explicabo quisquam accusantium quasi harum deserunt asperiores dolorem, incidunt doloremque ducimus.
                               </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card br-primary text-center card-form">
                                <div class="card-body">
                                    <h3>Sign Up Today</h3>
                                    <p>Please fill out this form to register</p>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" class="form-control form control-lg" placeholder="username">
                                        </div>
                                           <div class="form-group">
                                            <input type="email" class="form-control form control-lg" placeholder="email">
                                        </div>
                                           <div class="form-group">
                                            <input type="password" class="form-control form control-lg" placeholder="password">
                                        </div>
                                           <div class="form-group">
                                            <input type="password" class="form-control form control-lg" placeholder="confirm password">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
       </div>
   </header>
   
<!--   explore section -->
   
   <section id="explore-head-section">
       <div class="container">
           <div class="row">
               <div class="col text-center">
                   <div class="p-5">
                       <h1 class="display-4">Explore</h1>
                       <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore, at!</p>
                       <a href="" class="btn btn-outline-secondary"> Find out more </a>
                   </div>
               </div>
           </div>
       </div>
   </section>
   
<!--   End of Explore Section -->
   
<section id="explore-section" class="bg-light text-muted py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="../_assets/img/bckgrnds/space6.jpg" alt="" class="img-fluid mb-3 rounded-circle">
            </div>
            <div class="col-md-6">
                <h3>Explore and Connect</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima asperiores quaerat, aspernatur veritatis architecto facilis eum iusto id, dolore eveniet!</p>
                <div class="d-flex flex-row"><div class="p-4 align-self-start"><i class="fa fa-check"></i></div></div>
            </div>
        </div>
    </div>
</section>
  <section>
      <div class="container">
         <div class="row">
             <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable">
                      <thead>
                          <tr>
                              <td>ID</td>
                              <td>Full Name</td>
                              <td>Email</td>
                              <td>Phone Number</td>
                              <td>Gender</td>
                              <td>Date Joined</td>
                              <td>View</td>
                              <td>Update</td>
                              <td>Delete</td>                       
                          </tr>
                      </thead>
                      <tbody id="users">
                          <?php 
                          
                          //echo $output;
                          
                          ?>
                      </tbody>
                  </table>
              </div>
         
         </div>
          
      </div>
              
  </section>
   
<footer id="main-footer" class="bg-dark">
    <div class="container">
        <div class="row">
        <div class="col text-center">
            <div class="py-4">
                <h1 class="h3">Instagram</h1><p>Copyright &copy; 2018</p>
                <button class="btn btn-primary" data-toggle ='modal' data-target="#contactmodal">Contact us</button>
            </div>
        </div>
        </div>
    </div>
</footer>
   
   <div class="modal fade text-dark" id="contactmodal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="contactmodaltitle">Contact Us</h5>
                   
               </div>
               <div class="modal-body">
                       <form action="">
                           <div class="form-group">
                               <label for="name">Name</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="email">email</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="Phone Number">Phone Number</label>
                               <input type="text" class="form-control">
                           </div>
                       <div class="form-group">
                               <label for="message">Message</label>
                           <textarea class="form-control"></textarea>
                           </div>
                       
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn btn-primary btn-block">submit</button>
                   </div>
           </div>
       </div>
   </div>
    
            <script type="text/javascript" src="../_assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/bootstrap.min.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="../_assets/js/bs/jquery.dataTables.js"></script>

<!--    <script type="text/javascript" src="../_assets/js/bs/bootstrap.bundle.min.js"></script>-->
<!--    <script type="text/javascript" src="../_assets/js/bs/popper.min.js.map"></script>-->
    
    
    <script>
    $(document).ready(function(){
        var action = "mini";
        $.ajax({
            url:"../ajax/users.php",
            method:"POST",
            data:{action:action},
            success:function(users)
            {
                $('#users').html(users);
                $('#datatable').DataTable({
                    "destroy":true,
                });
            }
            
        })
    }) </script>
</body>
</html>