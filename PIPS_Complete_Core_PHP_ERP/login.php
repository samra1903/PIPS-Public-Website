<?php
require_once __DIR__.'/includes/init.php';
if(logged_in()) go('dashboard.php');
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf(); $email=trim($_POST['email']??''); $pw=$_POST['password']??'';
 $q=$pdo->prepare('SELECT id,full_name,email,password_hash,role,is_active FROM users WHERE email=?');$q->execute([$email]);$u=$q->fetch();
 if($u && $u['is_active'] && password_verify($pw,$u['password_hash'])){
  session_regenerate_id(true);$_SESSION['user_id']=$u['id'];$_SESSION['name']=$u['full_name'];$_SESSION['role']=$u['role'];go('dashboard.php');
 } else $error='Invalid login details or inactive account.';
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>PIPS Login</title>
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div class="login">
        <div class="panel">
            <h1>PIPS School System</h1>
            <p class="muted">Staff and administration login</p><?php if($error):?><div class="notice error">
                <?=h($error)?></div><?php endif;?><form method="post"><input type="hidden" name="csrf"
                    value="<?=h(csrf())?>"><label>Email</label><input type="email" name="email"
                    required><label>Password</label><input type="password" name="password"
                    required><button>Login</button></form>
            <p class="muted">Create the first admin at setup_admin.php, then delete that setup file.</p>
        </div>
    </div>
</body>

</html>