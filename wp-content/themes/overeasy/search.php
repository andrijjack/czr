<?php get_header(); ?>

	<div id="columns">
		<div id="centercol">
			<div class="box">
				<div class="top"></div>
				<div class="spacer">

                    <h3><em>Результати пошуку по "<?php printf(__('%s'), $s) ?>"</em></h3>
                        
					<?php if(have_posts()) : ?>
					
					<?php while(have_posts()) : the_post() ?>
        
                    <div id="post-<?php the_ID(); ?>" class="post">
    
						<?php $category = get_the_category(); // To show only 1 Category ?>            
                        <div class="btn-cat"><span class="btn-general"><?php the_category(","); ?></span></div>
                        
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Закладка на <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <div class="date"><?php the_time('F j, Y'); ?> <?php comments_popup_link( 'Поки немає коментарів', '1 коментар', '% коментарів'); ?></div>
                        
                        <?php the_excerpt(); ?>
                        <div class="btn-continue"><a href="<?php the_permalink() ?>">Продовжити перегляд</a></div>
                    
                    </div>
                    <!--/post-->                            
        
                    <?php endwhile; ?>

					<br class="fix" />
        
                    <?php else: ?>
                    
                    <p>Нічого не знайдено, спробуйте, будь-ласка, ще.</p>
                    
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