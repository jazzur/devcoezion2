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
			<?php else : ?> <h2>Oooopppsss...</h2> <p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p> <?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php endif; ?> 
	</section>

</main>
<div class="col-xs-12 col-sm-12 col-lg-1"></div>
<?php get_footer(); ?>

</body>
</html>