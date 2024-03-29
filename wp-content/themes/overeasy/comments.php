<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">Ця публікація захищена паролем. Введіть пародь, щоб переглянути коментарі.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div id="comments_wrap">

<?php if ( have_comments() ) : ?>

	<h3><?php comments_number('Немає відповідей', 'Одна відповідб', '% Відповідей' );?> до &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments('avatar_size=48&callback=custom_comment'); ?>
	</ol>    

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="fix"></div>
	</div>
	<br />
	<?php if ( $comments_by_type['pings'] ) : ?>
    <h2 id="pings">Трекбеки/Пінгбеки</h3>
    <ol class="commentlist">
    <?php wp_list_comments('type=pings'); ?>
    </ol>
    <?php endif; ?>

    
 
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Коментарі закриті.</p>

	<?php endif; ?>

<?php endif; ?>

</div> <!-- end #comments_wrap -->

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( 'Залишити Відповідь', 'Залишити Відповідь %s' ); ?></h3>
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>Ви повинні <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">увійти</a> в систему, щоб залишати коментарі.</p>

<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<fieldset class="form1">

<?php if ( $user_ID ) : ?>

<p>Ви зайшли як <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="Вийти із системи">Вийти &raquo;</a></p>

<?php else : ?>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author">Ім'я <?php if ($req) echo "(обов'язково)"; ?></label></p>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email">Елетронна адреса (не буде показана на сайті) <?php if ($req) echo "(обов'язвоко)"; ?></label></p>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url">Веб сайт</label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="50" rows="15" tabindex="4" style="width:97%"></textarea></p>

<p><input name="submit" type="submit" class="btn" tabindex="5" value="<?php _e('Додати коментар'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p><?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
    </fieldset>

</form>

<?php endif; // If logged in ?>

<div class="fix"></div>
</div> <!-- end #respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
