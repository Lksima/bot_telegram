
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       print_r($_POST);
       print("<br>");
       
      $email= $_REQUEST["email"];
       
      $var=preg_match('/^.*@gmail.com$/', $email);
        print("<br>");
      if($var==1) {
          print("$email");
      }
      else {
           print("email invalido");
          
      }
          
         
              
?>
    </body>
</html>