<?php
session_start();
require_once("configs/db_config.php");

// Ensure DB connection
if (!isset($db) || !$db instanceof mysqli) {
    $db = new mysqli("localhost", "root", "", "food_delivery");
}
if ($db->connect_error) {
    die("DB Connection error: " . $db->connect_error);
}

$error = "";
$success = "";

/* 🟢 LOGIN */
if (isset($_POST["btnSignIn"])) {
    $username = trim($_POST["txtUsername"]);
    $password = trim($_POST["txtPassword"]);
    $password_md5 = md5($password); // compare with MD5 in DB

    $stmt = $db->prepare("
        SELECT u.id, u.name, u.email, u.phone, u.password_hash, u.role_id, r.name AS role
        FROM users u
        JOIN roles r ON r.id = u.role_id
        WHERE u.name = ? OR u.email = ?
        LIMIT 1
    ");
    if (!$stmt) {
        $error = "Prepare failed: " . $db->error;
    } else {
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_object();

            // ✅ Compare with MD5 hash from DB
            if ($user->password_hash === $password_md5) {
                $_SESSION["uid"] = $user->id;
                $_SESSION["uname"] = $user->name;
                $_SESSION["email"] = $user->email;
                $_SESSION["phone"] = $user->phone;
                $_SESSION["role_id"] = $user->role_id;
                $_SESSION["urole"] = $user->role;

                switch ($user->role_id) {
                    case 1: header("Location: home"); break;
                    case 2: header("Location: restaurant/home.php"); break;
                    case 3: header("Location: rider/home.php"); break;
                    case 4: header("Location: customer/home.php"); break;
                    default: header("Location: home.php");
                }
                exit;
            } else {
                $error = "Incorrect username or password.";
            }
        } else {
            $error = "No user found with that username or email.";
        }
        $stmt->close();
    }
}

/* 🟠 SIGN UP */
if (isset($_POST["btnSignUp"])) {
    $name = trim($_POST["signupName"]);
    $email = trim($_POST["signupEmail"]);
    $phone = trim($_POST["signupPhone"]);
    $plain_password = trim($_POST["signupPassword"]);
    $role_id = intval($_POST["signupRole"]);

    if ($name === "" || $email === "" || $plain_password === "" || $role_id <= 0) {
        $error = "Please fill all required fields.";
    } else {
        $password_md5 = md5($plain_password); // save as MD5
        $check = $db->prepare("SELECT id FROM users WHERE email = ? OR name = ? LIMIT 1");
        if (!$check) {
            $error = "Prepare failed: " . $db->error;
        } else {
            $check->bind_param("ss", $email, $name);
            $check->execute();
            $cres = $check->get_result();
            if ($cres && $cres->num_rows > 0) {
                $error = "Username or Email already exists!";
            } else {
                $now = date("Y-m-d H:i:s");
                $insert = $db->prepare("
                    INSERT INTO users (email, phone, password_hash, role_id, name, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ");
                if (!$insert) {
                    $error = "Prepare failed: " . $db->error;
                } else {
                    $insert->bind_param("sssisss", $email, $phone, $password_md5, $role_id, $name, $now, $now);
                    if ($insert->execute()) {
                        $success = "Account created successfully! You can now sign in.";
                    } else {
                        $error = "Registration failed. Try again. (" . $insert->error . ")";
                    }
                    $insert->close();
                }
            }
            $check->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Zomo Portal — Login / Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: linear-gradient(135deg,#ff6f00 0%,#ff3d00 100%); min-height:100vh; display:flex; align-items:center; justify-content:center; font-family:Poppins, sans-serif; }
.card-wrap{background:#fff; border-radius:20px; box-shadow:0 6px 25px rgba(0,0,0,0.15); width:100%; max-width:460px; padding:2.5rem;}
h4{font-weight:700;color:#333;}
.btn-primary{background:linear-gradient(90deg,#ff6f00,#ff3d00); border:none; border-radius:12px; font-weight:600;}
.toggle-link{color:#ff6f00; cursor:pointer;}
.alert{border-radius:12px;}
</style>
</head>
<body>
<div class="card-wrap">
  <div class="text-center mb-3">
    <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" width="80" alt="Zomo">
    <h4 id="formTitle">Sign In</h4>
  </div>

  <?php if ($error): ?> <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div> <?php endif; ?>
  <?php if ($success): ?> <div class="alert alert-success py-2"><?php echo htmlspecialchars($success); ?></div> <?php endif; ?>

  <form id="loginForm" method="post" action="">
    <div class="mb-3">
      <label class="form-label">Username or Email</label>
      <input type="text" name="txtUsername" class="form-control" placeholder="Enter username or email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="txtPassword" class="form-control" placeholder="Enter password" required>
    </div>
    <button type="submit" name="btnSignIn" class="btn btn-primary w-100">Sign In</button>
    <p class="mt-3 text-center">Don't have an account? <a id="showSignUp" class="toggle-link">Create one</a></p>
  </form>

  <form id="signupForm" method="post" action="" style="display:none;">
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="signupName" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="signupEmail" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="signupPhone" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="signupPassword" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Register As</label>
      <select name="signupRole" class="form-select" required>
        <option value="">-- Select Role --</option>
        <option value="2">Restaurant</option>
        <option value="3">Rider</option>
        <option value="4">Customer</option>
      </select>
    </div>
    <button type="submit" name="btnSignUp" class="btn btn-primary w-100">Create Account</button>
    <p class="mt-3 text-center">Already have an account? <a id="showLogin" class="toggle-link">Sign in</a></p>
  </form>

  <footer class="text-center mt-3" style="font-size:.85rem;color:#777;">© 2025 Zomo Food Delivery</footer>
</div>

<script>
document.getElementById('showSignUp').onclick = function(){
  document.getElementById('loginForm').style.display='none';
  document.getElementById('signupForm').style.display='block';
  document.getElementById('formTitle').innerText='Create Account';
};
document.getElementById('showLogin').onclick = function(){
  document.getElementById('loginForm').style.display='block';
  document.getElementById('signupForm').style.display='none';
  document.getElementById('formTitle').innerText='Sign In';
};
</script>
</body>
</html>
