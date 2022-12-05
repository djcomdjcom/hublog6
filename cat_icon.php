
<?php
/**
 * cat_icon.php
 * カテゴリー名を表示するためのパーツ
 */


$catslug = get_the_category();
foreach($catslug as $cat):
endforeach;
foreach($catname as $cat):
endforeach;
?>

<span class="cat_icon <?php echo $cat->slug; ?>">
<?php echo $cat->cat_name; ?></span>
