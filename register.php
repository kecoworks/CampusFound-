<?php
require 'config.php'; $page_title='Create account'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $sid=trim($_POST['student_id']??''); $pw=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pw)<8){$error='Please enter valid details. Password must be at least 8 characters.';}
 else{
  try{$stmt=$pdo->prepare("INSERT INTO users(name,email,student_id,password) VALUES(?,?,?,?)");$stmt->execute([$name,$email,$sid,password_hash($pw,PASSWORD_DEFAULT)]);$_SESSION['user_id']=$pdo->lastInsertId();$_SESSION['user_name']=$name;flash('Welcome to Campus Found!');header('Location: dashboard.php');exit;}
  catch(PDOException $e){$error='This email is already registered.';}
 }
}
require 'header.php';
?>
<section class="auth-layout"><div class="auth-copy"><span class="eyebrow">JOIN YOUR CAMPUS</span><h1>Small acts.<br><span>Big reunions.</span></h1><p>Create an account to report items, connect with their owners and help your campus community.</p><div class="auth-quote">“The things we find matter. The people who help matter more.”</div></div><div class="auth-card"><div class="auth-heading"><h2>Create your account</h2><p>It takes less than a minute.</p></div><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><label>Full name<input name="name" required placeholder="Your name"></label><label>College email<input name="email" type="email" required placeholder="you@college.edu"></label><label>Student ID <span class="optional">Optional</span><input name="student_id" placeholder="e.g. 24CS108"></label><label>Password<input name="password" type="password" minlength="8" required placeholder="At least 8 characters"></label><button class="btn btn-dark btn-full" type="submit">Create account <span>→</span></button></form><p class="auth-switch">Already have an account? <a href="login.php">Log in</a></p></div></section>
<?php require 'footer.php'; ?>
