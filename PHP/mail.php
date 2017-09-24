<?php
  if(isset($_POST['submit'])){
    $name = $email = $content = "";
    $emailErr=$nameErr=$contentErr="";
    if(empty($_POST['name'])){
      $nameErr="Name is required";
    }else{
      $name = test_input($_POST['name']);
      if(!preg_match("/^[a-zA-Z ]*$/",$name)){
        $nameErr ="Only letters and white space allowed";
      }
    }
    if(empty($_POST['email'])){
      $emailErr="Email is required";
    }else{
      $email = test_input($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr="Invalid email format";
      }
    }
    if(empty($_POST['content'])){
      $contentErr="Message is required";
    }else{
      $content = test_input($_POST['content']);
    }

    if($nameErr == ''  and $emailErr=='' and $contentErr ==''){
      $to='aac088@shsu.edu';
      $subject='Form Submission';
      $message="Name :".$name."\n"."Wrote the following :"."\n\n".$content;
      $headers="From: ".$email;

      if(mail($to, $subject, $message, $headers)){
        echo "<h1> Sent Successfully!</h1>";
      }else{
        echo "Something went wrong!";
      }
    }
  }

  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>
