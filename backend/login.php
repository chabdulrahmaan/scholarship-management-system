<!DOCTYPE html>
<html>

<body>
  <?php
  session_start();

  require_once '../includes/dbconnection.php';

  try {
    $flag = 1;
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $data = array('email' => $email);

    $stmt = $conn->prepare("SELECT * FROM (
        SELECT studentID AS ID, upMail, password, status, 1 AS roleID FROM student
        UNION
        SELECT adminID AS ID, upMail, password, status, 2 AS roleID FROM admin
        UNION
        SELECT sigID AS ID, upMail, password, status, 3 AS roleID FROM signatory
        ) t WHERE upMail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);

    if (isset($users[0]) && password_verify($_POST['password'], $users[0]['password'])) {
      if ($users[0]['status'] == 'active') {
        $_SESSION['email'] = $users[0]['upMail'];
        // User type -- 1 (student), 2(admin), 3(sig)
        $_SESSION['currentUserTYPE'] = $users[0]['roleID'];
        $_SESSION['currentUserID'] = $users[0]['ID'];
        $_SESSION['isLoggedIn'] = TRUE;

        $stmt = $conn->prepare("SELECT * FROM verify_signup WHERE upMail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_verify = $result->fetch_all(MYSQLI_ASSOC);

        if (isset($user_verify[0]) && ($user_verify[0]['action'] == 0)) {
          $flag = 0;
  ?>
          <script type="text/javascript">
            alert("YOU NEED TO VERIFY EMAIL ADDRESS TO ACTIVATE YOUR ACCOUNT!");
            location.replace("verify_signupcode.php");
          </script>
  <?php
        }
      } else {
        $flag = 0;
        $_SESSION['errMsg'] = "Your Account is currently in INACTIVE Mode!";
        header('Location: ../index.php');
      }
    }

    $conn->close();
    if ($flag != 0) {
      if ($_SESSION['currentUserTYPE'] == 1) header('Location: ../student/tempUserHome.php');
      elseif ($_SESSION['currentUserTYPE'] == 2) header('Location: ../admin/tempAdmin.php');
      elseif ($_SESSION['currentUserTYPE'] == 3) header('Location: ../signatory/tempSigHome.php');
      else {
        $_SESSION['errMsg'] = "UserName or Password Incorrect!";
        header('Location: ../index.php');
      }
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  ?>

</body>

</html>