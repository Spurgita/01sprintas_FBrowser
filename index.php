<html lang = "en">
   <head>
      <title>Login</title>
   </head>
   <body>
      <h2>Enter Username and Password</h2> 
      <div>
         <?php
            $msg = '';
            if (isset($_POST['login']) 
                && !empty($_POST['username']) 
                && !empty($_POST['password'])
            ) {	
               if ($_POST['username'] == 'CandyMan' && 
                  $_POST['password'] == 'sweet'
                ) {
                  $_SESSION['logged_in'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'CandyMan';
                  echo 'You have entered valid use name and password';
               } else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div>
      <div>
        <?php 
            if($_SESSION['logged_in'] == true){
               print('<h1>You can only see this if you are logged in!</h1>');
            }
        ?>
        <form action="./fbrowser.php" method="post">
            <h4><?php echo $msg; ?></h4>
            <input type="text" name="username" placeholder="username = CandyMan" required autofocus></br>
            <input type="password" name="password" placeholder="password = sweet" required>
            <!-- <input type="text" name="username" onfocus="this.placeholder=''" placeholder="username = CandyMan" required autofocus></br>
            <input type="password" name="password" placeholder="password = sweet" required> -->
            <button class = "btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
        Click here to <a href = "index.php?action=logout"> logout.
      </div> 
