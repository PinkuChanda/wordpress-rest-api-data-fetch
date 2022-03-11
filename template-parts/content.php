<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gingco
 */

?>

	<div class="col-xs-12 col-sm-6 col-md-4 blog-grid more-box" id="post-<?php the_ID(); ?>">

		<div class="item">
		
			<?php if (!empty(get_the_post_thumbnail_url($post_id))): ?>
				<img src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri(); ?>assets/images/img_bg_2.jpg" alt="<?php the_title(); ?>" class="img-responsive">
			<?php endif; ?>
		
		<div class="blog-details">
			<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
			
			<p class="post_intro hidden-xs">
                <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
            </p>

            <a class="read-more" href="<?php the_permalink(); ?>">More</a>

		</div>
		</div>

	</div>
