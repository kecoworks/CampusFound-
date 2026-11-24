<?php
require 'config.php'; require 'helpers.php';
$page_title='Find your item';
$term=trim($_GET['q']??''); $category=$_GET['category']??''; $type=$_GET['type']??'';
$sql="SELECT items.*, users.name AS reporter FROM items JOIN users ON users.id=items.user_id WHERE items.status='active'";
$params=[];
if($term!==''){ $sql.=" AND (items.title LIKE ? OR items.description LIKE ? OR items.location LIKE ?)"; $like="%$term%"; $params=[$like,$like,$like]; }
if($category!==''){ $sql.=" AND items.category=?"; $params[]=$category; }
if($type==='lost'||$type==='found'){ $sql.=" AND items.type=?"; $params[]=$type; }
$sql.=" ORDER BY items.created_at DESC";
$stmt=$pdo->prepare($sql); $stmt->execute($params); $items=$stmt->fetchAll();
require 'header.php';
?>
<section class="hero">
  <div class="hero-content">
    <span class="eyebrow"><span class="eyebrow-dot"></span> YOUR CAMPUS, CONNECTED</span>
    <h1>Lost something?<br><span>Let's bring it home.</span></h1>
    <p>A simple community space to reunite students with the things they care about. Browse what's been found or let others know what you're missing.</p>
    <div class="hero-actions"><a class="btn btn-dark" href="report.php">＋ Report an item</a><a class="btn btn-white" href="#items">Explore listings <span>↘</span></a></div>
    <div class="hero-stats"><div><strong><?= count($items) ?></strong><span>active listings</span></div><div class="stat-divider"></div><div><strong>Campus-wide</strong><span>community effort</span></div></div>
  </div>
  <div class="hero-art">
    <div class="art-card art-card-back"><span class="art-tag">FOUND</span><div class="art-circle"></div><div class="art-lines"><i></i><i></i></div></div>
    <div class="art-card art-card-front"><div class="art-icon">⌕</div><span class="art-caption">Good things find their way.</span><div class="art-bottom"><span>Campus Found</span><span>✦</span></div></div>
    <div class="floating-note"><span class="note-icon">✓</span><div><strong>Community-powered</strong><small>Every report makes a difference</small></div></div>
  </div>
</section>
<section class="content-section" id="items">
  <div class="section-heading"><div><span class="eyebrow">THE COMMUNITY BOARD</span><h2>Recent listings</h2><p>Take a look around. Your item might already be here.</p></div><a class="text-link" href="report.php">Post a listing <span>↗</span></a></div>
  <form class="filter-bar" method="get" action="index.php">
    <div class="search-field"><span>⌕</span><input type="search" name="q" value="<?= e($term) ?>" placeholder="Search items, places, descriptions..."></div>
    <select name="category"><option value="">All categories</option><?php foreach(['Electronics','Accessories','Books & Notes','ID & Cards','Keys','Clothing','Other'] as $c): ?><option <?= $category===$c?'selected':'' ?> value="<?= e($c) ?>"><?= e($c) ?></option><?php endforeach; ?></select>
    <select name="type"><option value="">Lost & Found</option><option value="lost" <?= $type==='lost'?'selected':'' ?>>Lost</option><option value="found" <?= $type==='found'?'selected':'' ?>>Found</option></select>
    <button class="btn btn-dark btn-small" type="submit">Filter</button>
  </form>
  <?php if(!$items): ?><div class="empty-state"><div class="empty-icon">⌕</div><h3>No listings found</h3><p>Try a different search, or be the first to report an item.</p><a class="btn btn-dark" href="report.php">Report an item</a></div>
  <?php else: ?>
  <div class="item-grid">
    <?php foreach($items as $item): ?>
    <a class="item-card" href="item.php?id=<?= (int)$item['id'] ?>">
      <div class="item-image">
        <?php if($item['image']): ?><img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>"><?php else: ?><div class="placeholder-image"><span><?= e(category_icon($item['category'])) ?></span></div><?php endif; ?>
        <span class="status-pill <?= e($item['type']) ?>"><?= e(ucfirst($item['type'])) ?></span>
      </div>
      <div class="item-info"><div class="item-category"><?= e($item['category']) ?></div><h3><?= e($item['title']) ?></h3><p class="item-location">⌖ <?= e($item['location']) ?></p><div class="item-meta"><span><?= date('M j, Y',strtotime($item['item_date'])) ?></span><span>View details ↗</span></div></div>
    </a>
    <?php endforeach; ?>
  </div><?php endif; ?>
</section>
<?php require 'footer.php'; ?>
