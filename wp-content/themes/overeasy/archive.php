<?php get_header(); ?>

	<div id="columns">
		<div id="centercol">
			<div class="box">
				<div class="top"></div>
				<div class="spacer">

					<?php if(have_posts()) : ?>
					
					<?php while(have_posts()) : the_post() ?>
        
                    <div id="post-<?php the_ID(); ?>" class="post">
    
						<?php $category = get_the_category(); // To show only 1 Category ?>            
                        <div class="btn-cat"><span class="btn-general"><?php the_category(","); ?></span></div>
                        
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <div class="date"><?php the_time('j F Y'); ?> <?php comments_popup_link( 'Поки немає коментарів', '1 коментар', '% коментарів'); ?></div>
                        
						<?php if ( get_option('woo_the_content') == "true" ) { the_content('<div class="btn-continue">Продовжити перегляд</div>'); } else { the_excerpt(); ?>
                        <div class="btn-continue"><a href="<?php the_permalink() ?>">Продовжити перегляд</a></div>
                        <?php } ?>
                    	<div class="fix"></div>
                    </div>
                    <!--/post-->                            
        
                    <?php endwhile; ?>
        
					<div class="btn-arr fl"><?php next_posts_link('&laquo; Давніші повідомлення') ?></div>
					<div class="btn-arr fr"><?php previous_posts_link('Новіші повідомлення &raquo;') ?></div>
					<br class="fix" />
        
                    <?php endif; ?>
                
				</div>
				<!--/spacer -->
				<div class="bot"></div>
			</div>
			<!--/box -->
		</div>
		<!--/centercol -->

<?php get_sidebar(); ?>

		<br class="fix" />
	</div>
	<!--/columns -->

<?php get_footer(); ?>