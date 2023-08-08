<?php
/**
* 投稿者一覧表示用テンプレート
*
*loop-authors.php
*/

//表示したいユーザーのログイン名を設定
$authers = array(
	'samplea',
    'sampleb',
	'hublogadmin',
);



foreach ($authers as $auther){
$user_info = get_user_by('login', $auther );
$userphotoid = $user_info->ID;
/*
以下のURLを参考に、必要な値を表示させる
よく使う項目
・ $user_info->last_name	... 姓
・ $user_info->first_name	... 名
・ $user_info->display_name ... ブログ上の表示名
・ $user_info->user_url		... ウェブサイト
・ $user_info->description	... プロフィール
その他は以下のURLを参考にする
http://wpdocs.sourceforge.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/get_userdata
*/
?>
<div class="user_info clearfix profil">
  <div class="inbox">
    <figure class="photobox"><?php echo get_wp_user_avatar( $userphotoid, 'thumbnail' ); ?></figure>
    <div class="staff-meta pl-3 pl-sm-0 pb-sm-3">
      <div class="staff-post"><?php echo $user_info->post; ?></div>
      <div class="staff-division"><?php echo $user_info->division; ?></div>
      <div class="staff-name"><?php echo $user_info->last_name; ?>&nbsp;<?php echo $user_info->first_name; ?></div>
      <div class="staff-kana"><?php echo $user_info->kana; ?></div>
    </div>
    <label>
    <input type="checkbox" name="checkbox">
    <div class=" staffpopup">
      <div class="inbox row"> <span class="w100 col-3"><?php echo get_wp_user_avatar( $userphotoid, 'thumbnail' ); ?></span>
        <div class="userinfo_detail col-9">
          <div class="user_name">
            <div class="user_post_division">
              <?php 	if ( $user_info->post)  :?>
              <?php echo '<span class="post">',($user_info->post),'</span>' ; ?>
              <?php endif; ?>
              <?php if ($user_info->division) :?>
              <?php echo '<span class="division">',($user_info->division),'</span>'; ?>
              <?php endif; ?>
            </div>
            <em class="fullname cleartype"><?php echo $user_info->last_name; ?>&nbsp;<?php echo $user_info->first_name; ?></em> （<?php echo $user_info->kana; ?>） </div>
          <?php 	if ( $user_info->credential) :?>
          <div class="credential">資格： <?php echo ($user_info->credential); ?> </div>
          <?php endif; ?>
          <?php 	if ( $user_info->from) :?>
          <div class="from">出身地： <?php echo ($user_info->from); ?> </div>
          <?php endif; ?>
          <div class="user_description"> <?php echo wpautop($user_info->description); ?> </div>
        </div>
      </div>
    </div>
    </label>
  </div>
</div>
<?php
} //endforeach
