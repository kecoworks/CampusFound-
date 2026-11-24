<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($page_title) ? e($page_title).' · ' : '' ?>Campus Found</title>
  <link rel="stylesheet" href="/campus_lost_found/assets/style.css?v=20261124">
  <script defer src="/campus_lost_found/assets/app.js?v=20261124"></script>
</head>
<body>
<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">C</span><span>campus<span class="brand-light">found</span></span></a>
    <nav class="main-nav">
      <a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])==='index.php'?'active':'' ?>">Browse items</a>
      <a href="report.php">Report an item</a>
      <?php if (logged_in()): ?>
        <a href="dashboard.php">My dashboard</a>
      <?php endif; ?>
    </nav>
    <div class="nav-actions">
      <?php if (logged_in()): ?>
        <span class="user-chip"><span class="avatar"><?= e(strtoupper(substr(current_user(),0,1))) ?></span><?= e(current_user()) ?></span>
        <a class="btn btn-outline btn-small" href="logout.php">Log out</a>
      <?php else: ?>
        <a class="nav-login" href="login.php">Log in</a>
        <a class="btn btn-dark btn-small" href="register.php">Create account</a>
      <?php endif; ?>
    </div>
    <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
  </div>
</header>
<main>
<?php show_flash(); ?>
