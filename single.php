<?php get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<main class="post">
			<?php
				$coverImageID = get_post_meta($post->ID, 'cover_image');
				if (is_array($coverImageID) && count($coverImageID) > 0 && is_numeric($coverImageID[0])) {
					$coverImage = wp_get_attachment_image_src($coverImageID[0], 'full');
					if ($coverImage) {
						$coverImage = $coverImage[0];
					}
				}
				$coverTextColor = get_post_meta($post->ID, 'hue_of_image');
				if (isset($coverTextColor) && $coverTextColor[0]) {
					if ($coverTextColor[0] == 'shadow') {
						$coverTextColor = 'text-shadow: 0px 0px 5px white;';
					} else {
						$coverTextColor = 'color: ' . $coverTextColor[0] . ';';
					}
				} else {
					$coverTextColor = 'color: black;';
				}
			?>
			<?php if (isset($coverImage) && $coverImage) : ?>
				<style>
					@media (min-width: 480px) and (orientation: landscape) {
						.post__header {
							background-image: url(<?php echo $coverImage; ?>);
							<?php echo $coverTextColor; ?>
						}
					}
				</style>
			<?php endif; ?>
			<header class="post__header">
				<h1 class="post__title"><?php the_title(); ?></h1>
				<time datetime="<?php echo get_the_date('c'); ?>" pubdate class="post__date"><?php echo get_the_date(); ?></time>
			</header>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => 'false',
						'menu_id' => 'menu-top-menu'
					) );
				?>
			<article class="container">
				<div class="post-content twelve columns">
					<?php the_content(); ?>
				</div>
			
				<footer class="pageFooter">
						<?php
							$postCategories = get_the_category();
							$is_ux = false;
							foreach ($postCategories as & $cat) {
								$slug = $cat->slug;
								$is_ux = $slug == 'ux-en' || $slug == 'ux-ru' || $slug == 'ux-es';
							}
							unset( $cat );
						?>
						<?php if ($is_ux) : ?>
							<a href="https://telegram.me/uxblog" title="<?php pll_e('Subscribe to only UX related posts via our Telegram channel'); ?>">
								<img style="padding: 10px 20px;" src="<?php bloginfo("template_directory"); ?>/img/tg-en@2x.png">
							</a>
						<?php endif; ?>
					<div class="yashare-auto-init" data-yashareL10n="ru"
						 data-yashareType="small"
						 data-yashareQuickServices="vkontakte,facebook,twitter,gplus"
						 data-yashareTheme="counter"></div>
				</footer>

				<!-- Begin MailChimp Signup Form -->
				<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
				<style type="text/css">
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; padding: 0px 10px 0px 10px;}
					/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
					   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
				</style>
				<div id="mc_embed_signup">
				<form action="//ninja.us11.list-manage.com/subscribe/post?u=39e02a0b24cc24daa5ca5a8b8&amp;id=b5b5434a1b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
					<label for="mce-EMAIL"><?php pll_e('Получать посты на почту, около 2 раз в месяц:');?></label>
					<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
				    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				    <div style="position: absolute; left: -5000px;"><input type="text" name="b_39e02a0b24cc24daa5ca5a8b8_b5b5434a1b" tabindex="-1" value=""></div>
				    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
				    </div>
				</form>
				</div>

				<!--End mc_embed_signup-->

				<div id="disqus_thread"></div>
				<script type="text/javascript">
				    /* * * CONFIGURATION VARIABLES * * */
				    var disqus_shortname = 'philipp-ninja';
				    
				    /* * * DON'T EDIT BELOW THIS LINE * * */
				    (function() {
				        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				    })();
				</script>
			</article>
		</main>
	
	<?php endwhile; ?>
<?php get_footer(); ?>