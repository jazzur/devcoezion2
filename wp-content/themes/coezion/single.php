<?php get_header(); ?>
	<section id="content"> 
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="post_content"> <?php the_content(); ?> </div>
			<p class="postmetadata">
				<?php the_time('j F Y') ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>
			</p>
		</div> 
		<?php endwhile; ?>
			<?php else : ?> <p>Désolé, aucun article ne correspond à vos critères.</p>
		<?php endif; ?> 
	</section>

</section>

<?php get_footer(); ?>

</body>
</html>