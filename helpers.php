<?php
function category_icon($category) {
  $icons=['Electronics'=>'⌁','Accessories'=>'◇','Books & Notes'=>'▤','ID & Cards'=>'▣','Keys'=>'⚿','Clothing'=>'◌','Other'=>'✦'];
  return $icons[$category] ?? '✦';
}
?>
