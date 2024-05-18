<?php session_start();
?>
<!DOCTYPE html>
<html>

<body>

  <?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    require_once 'includes/dbconnection.php';

    $sql = "SELECT upMail,1 AS role FROM student WHERE upMail = '" . $email . "' UNION SELECT upMail,2 AS role FROM signatory WHERE upMail = '" . $email . "'";
    try {
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $_SESSION['role'] = $row["role"];
        }
        $min = 100001;
        $max = 999999;
        $sixdigitnum = mt_rand($min,  $max);
        $verify = "INSERT INTO reset_password(upMail,num) VALUES ('$email','$sixdigitnum')";
        if (mysqli_query($conn, $verify)) {
          $headers = "From: " . FROM_EMAIL . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
          $bodyContent = "
          Hey There,
          <h1>We have got a Password Reset Request for your Account</h1><br/>
          Use the following code to Reset Password :<br/>$sixdigitnum<br/><br/>
          Thank You For Using Our WebSite!
          ";

          $subject = 'Password Reset Request';

          if (!mail($email, $subject, $bodyContent, $headers)) {
            echo 'Failed while sending mail.';
          } else {
            $_SESSION['email'] = $email;
  ?>
            <script type="text/javascript">
              alert("Please check your Email for Password Reset!");
              location.replace("backend/reset_pass.php")
            </script>
        <?php
          }
        }
      } else { ?>
        <script type="text/javascript">
          alert("Account Doesnt Exists Please Signup First");
          location.replace('signup.php');
        </script><?php
                }
              } catch (Exception $e) {
              }
            } else {
                  ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      Enter your Email ID :
      <input type="text" name="email">
      <br /><input type="submit" name="submit" value="Send Code">
    </form>
  <?php } ?>
</body>

</html>