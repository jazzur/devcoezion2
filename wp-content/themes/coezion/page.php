<?php get_header(); ?>

		
	<section id="content"> 
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
		<section class="post" id="post-<?php the_ID(); ?>">
			<section class="post_content"> 
				<?php 
					the_content();
					get_sidebar();
				?> 
			</section>
		</section> 
		<?php endwhile; ?> 
		<?php endif; ?> 
		
		
	</section>

</section>

<?php get_footer(); ?>

</body>
</html>