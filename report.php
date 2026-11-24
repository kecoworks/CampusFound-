<?php
require 'config.php'; require_login(); $page_title='Report an item'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $type=$_POST['type']??'';$title=trim($_POST['title']??'');$category=$_POST['category']??'';$description=trim($_POST['description']??'');$location=trim($_POST['location']??'');$date=$_POST['item_date']??'';
 $allowed=['Electronics','Accessories','Books & Notes','ID & Cards','Keys','Clothing','Other'];$image=null;
 if(isset($_FILES['image'])&&$_FILES['image']['error']===UPLOAD_ERR_OK){
  $tmp=$_FILES['image']['tmp_name'];$mime=mime_content_type($tmp);
  $ext=$error?null:(['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'][$mime]??null);
  if(!$error&&!$ext)$error='Please upload a JPG, PNG or WEBP image.';
  elseif(!$error){if(!is_dir('uploads'))mkdir('uploads',0755,true);$name='uploads/'.bin2hex(random_bytes(12)).'.'.$ext;if(move_uploaded_file($tmp,$name))$image=$name;else$error='Image upload failed.';}
 }
 if(!$error&&(!in_array($type,['lost','found'])||!$title||!in_array($category,$allowed)||!$description||!$location||!$date))$error='Please complete all required fields.';
 if(!$error){$stmt=$pdo->prepare("INSERT INTO items(user_id,type,title,category,description,location,item_date,image) VALUES(?,?,?,?,?,?,?,?)");$stmt->execute([$_SESSION['user_id'],$type,$title,$category,$description,$location,$date,$image]);flash('Your report has been posted. Thank you!');header('Location: item.php?id='.$pdo->lastInsertId());exit;}
}
require 'header.php';
?>
<section class="form-page"><div class="form-intro"><span class="eyebrow">MAKE A REPORT</span><h1>Every detail<br>helps it <span>find its way.</span></h1><p>Share what you lost or found. The campus community can help connect the dots.</p></div><div class="report-card"><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" enctype="multipart/form-data" class="form-stack"><div class="type-select"><label class="type-option"><input type="radio" name="type" value="lost" required><span><b>⌕</b><strong>I lost something</strong><small>Help me find my item</small></span></label><label class="type-option"><input type="radio" name="type" value="found" required><span><b>✓</b><strong>I found something</strong><small>Help it reach its owner</small></span></label></div><div class="form-row"><label>Item name<input name="title" required placeholder="e.g. Black wireless earbuds"></label><label>Category<select name="category" required><option value="">Select category</option><?php foreach(['Electronics','Accessories','Books & Notes','ID & Cards','Keys','Clothing','Other'] as $c): ?><option><?= e($c) ?></option><?php endforeach; ?></select></label></div><label>Where was it lost or found?<input name="location" required placeholder="e.g. Library, 2nd floor"></label><label>Date<input type="date" name="item_date" max="<?= date('Y-m-d') ?>" required></label><label>Description<textarea name="description" rows="4" required placeholder="Color, brand, identifying details, or anything that could help..."></textarea></label><label class="upload-box"><span class="upload-icon">＋</span><strong>Add a photo <span class="optional">(optional)</span></strong><small>JPG, PNG or WEBP · Max 5MB</small><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></label><button class="btn btn-dark btn-full" type="submit">Publish report <span>→</span></button><p class="form-footnote">Please avoid including sensitive information in public descriptions.</p></form></div></section>
<?php require 'footer.php'; ?>
