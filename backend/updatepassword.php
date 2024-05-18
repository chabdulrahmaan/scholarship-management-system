<!DOCTYPE html>
<html>

<body>
  <?php
  session_start();
  $pass = $_POST['pass'];
  $repass = $_POST['repass'];
  $email = $_SESSION['email'];
  if ($pass === $repass) {
    $phash = password_hash($pass, PASSWORD_DEFAULT);
    require_once '../includes/dbconnection.php';

    $role = $_SESSION['role'];
    $str = null;
    if ($role == 1) {
      $str =  "UPDATE student SET password = '" . $phash . "' WHERE upMail = '" . $email . "'";
    } else if ($role == 2) {
      $str = "UPDATE signatory SET password = '" . $phash . "' WHERE upMail = '" . $email . "'";
    }
    if (mysqli_query($conn, $str)) {
  ?>
      <script type="text/javascript">
        alert("Password Reset");
        location.replace("../index.php");
      </script>
  <?php
    }
  }

  ?>
</body>

</html>