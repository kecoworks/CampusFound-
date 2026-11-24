<?php
require 'config.php'; $page_title='Log in'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=strtolower(trim($_POST['email']??'')); $pw=$_POST['password']??'';
 $stmt=$pdo->prepare('SELECT * FROM users WHERE email=?');$stmt->execute([$email]);$user=$stmt->fetch();
 if($user&&password_verify($pw,$user['password'])){session_regenerate_id(true);$_SESSION['user_id']=$user['id'];$_SESSION['user_name']=$user['name'];header('Location: dashboard.php');exit;}
 $error='Email or password is incorrect.';
}
require 'header.php';
?>
<section class="auth-layout"><div class="auth-copy"><span class="eyebrow">WELCOME BACK</span><h1>Good to see<br><span>you again.</span></h1><p>One login brings you closer to finding what you've lost—or helping someone find it.</p><div class="auth-quote">Campus is better when we look out for one another.</div></div><div class="auth-card"><div class="auth-heading"><h2>Log in</h2><p>Welcome back to Campus Found.</p></div><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><label>Email address<input name="email" type="email" required placeholder="you@college.edu"></label><label>Password<input name="password" type="password" required placeholder="Your password"></label><button class="btn btn-dark btn-full" type="submit">Log in <span>→</span></button></form><p class="auth-switch">New here? <a href="register.php">Create an account</a></p></div></section>
<?php require 'footer.php'; ?>
