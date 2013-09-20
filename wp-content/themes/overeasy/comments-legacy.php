<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">Ця публікація захищена паролем. Введіть пародь, щоб переглянути коментарі.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	<h3 id="comments-count"><?php comments_number('Немає відповідей', 'Одна відповідб', '% Відповідей' );?></h3>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>

       <li class="<?php echo $oddcomment; ?> <?php if(function_exists("author_highlight")) author_highlight(); ?>" id="comment-<?php comment_ID() ?>">

			<?php
            // Determine which gravatar to use for the user
            $email =  $comment->comment_author_email;
            $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&default=".urlencode($GLOBALS['defaultgravatar'])."&size=48";
            $usegravatar = get_option('woo_gravatar');
            ?>                

            <div class="col1 ar"> <?php  if ( $usegravatar ) { ?><span class="gravatar"><img src="<?php echo $grav_url; ?>" width="48" height="48" alt="" /></span><?php } ?>
                <div><?php comment_author_link() ?><br />
                     <?php comment_date('') ?><br />
                     <?php edit_comment_link('Редагувати','',''); ?></div>
            </div>
            <!--/col1 -->
            <div class="col2">
                <div class="box3">
                    <div class="top"></div>
                    <div class="spcr">

						<?php if ($comment->comment_approved == '0') : ?>
                        <em>Ваш коментар поставлено до черги на перегляд модератором.</em>
                        <?php endif; ?>
                        
                        <?php comment_text() ?>

                    </div>
                    <!--/spacer -->
                    <div class="bot"></div>
                </div>
                <!--/box3 -->
            </div>
            <!--/col2 -->
            <br class="fix" />
   		</li>

	<?php /* Changes every other comment to a different class */
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Коментарі закриті.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div class="fix"></div>
<div id="respond">

<h3>Залишити Відповідь</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p id="login-req">Ви повинні <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">увідти</a> до системи, щоб залишати коментарі.</p>

</div><!-- #respond -->

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<fieldset class="form1">

<?php if ( $user_ID ) : ?>

<p><?php _e('Ви увішли як '); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Вийти з системи'); ?>"><?php _e('Вийти'); ?> &raquo;</a></p>

<?php else : ?>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author">Ім'я <?php if ($req) echo "(обов'язково)"; ?></label></p>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email">Елетронна адреса (не буде показана на сайті) <?php if ($req) echo "(обов'язково)"; ?></label></p>

<p style="padding:5px 0px 10px 0px;"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url">Веб сайт</label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" cols="50" rows="15" tabindex="4" style="width:97%"></textarea></p>

<p><input name="submit" type="submit" class="btn" tabindex="5" value="<?php _e('Додати коментар'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

    </fieldset>

</form>

</div><!-- #respond -->

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
