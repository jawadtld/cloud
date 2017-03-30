<?PHP

$uname = "";
$pword = "";
$errorMessage = "";
//==========================================
//  ESCAPE DANGEROUS SQL CHARACTERS
//==========================================
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $uname = $_POST['username'];
  $pword = $_POST['password'];

  $uname = htmlspecialchars($uname);
  $pword = htmlspecialchars($pword);

          //==========================================
          //  CONNECT TO THE LOCAL DATABASE
          //==========================================

  

        //====================================================
        //  CHECK TO SEE IF THE $result VARIABLE IS TRUE
        //====================================================

    if ($uname==user && $pword==pass) {
        session_start();
        $_SESSION['login'] = "1";
        header ("Location: admin.php");
      }
    else {
      $errorMessage = "Error logging on";
    }
  }


?>




<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css">

    <title>Login</title>
</head>


<body>

<?php include_once("analyticstracking.php") ?>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="http://www.jawadtld.tk">P.K Stores, Thalayad</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a class="page-scroll" href="http://www.jawadtld.tk">Back</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<div class="login-page">

  <div class="form">
    <form NAME ="form1" METHOD ="POST" ACTION ="login.php">
      <input type="text" placeholder="username" name="username" value="<?PHP print $uname;?>" />
      <input type="password" placeholder="password" name="password" value="<?PHP print $pword;?>" />
      <button type="submit" Name = "Submit1">login</button>
    </form>
  </div>
</div>




</body>