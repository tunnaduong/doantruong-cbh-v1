<?php

/**
 * widget class for Post grid layout style 1
 */
class wp_mint_magazine_post_grid_layout_style_1 extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'						 => 'post_grid_layout_style_1',
			'description'					 => __( 'Display latest posts or posts of specific category.', 'wp-mint-magazine' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( false, $name = __( 'Post grid layout style 1', 'wp-mint-magazine' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 5,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );
		?>
		<div class="post-grid-layout-wrap">
			<label class="widget-form-label"><?php esc_html_e( 'Layout will be as below:', 'wp-mint-magazine' ) ?></label>
			<div class="post-grid-layout-view">
				<img src="<?php echo wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/post_grid_layout_style_1.jpg' ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Description', 'wp-mint-magazine' ); ?></label>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label label-inline" for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to display:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $instance[ 'number' ] ); ?>" size="3" />
			</div>

			<div class="widget-form-group">
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php esc_html_e( 'Show latest Posts', 'wp-mint-magazine' ); ?>
				<br />
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php esc_html_e( 'Show posts from a category', 'wp-mint-magazine' ); ?>
				<br />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category:', 'wp-mint-magazine' ); ?></label>
				<?php
				wp_dropdown_categories( array(
					'show_option_none'	 => ' ',
					'name'				 => $this->get_field_name( 'category' ),
					'selected'			 => intval( $instance[ 'category' ] ),
				) );
				?>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Widget title image', 'wp-mint-magazine' ); ?></label>
				<div class="widget-grid-title-img-wrap">
					<div class="widget-grid-title-img-box">
						<img src="<?php echo esc_url( $instance[ 'image' ] ) ?>" class="upload_image_img" />
					</div>
					<input type="text" class="upload_image_input" value="<?php echo esc_url( $instance[ 'image' ] ) ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
					<button type="button" class="upload_image_button button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>"><?php esc_html_e( 'Select Image', 'wp-mint-magazine' ); ?></button>
					<button type="button" class="remove_image_button button button-secondary button-large"><?php esc_html_e( 'Remove Image', 'wp-mint-magazine' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'text' ] = sanitize_textarea_field( $new_instance[ 'text' ] );
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'type' ] = sanitize_text_field( $new_instance[ 'type' ] );
		$instance[ 'category' ] = intval( $new_instance[ 'category' ] );
		$instance[ 'image' ] = esc_url_raw( $new_instance[ 'image' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		
		global $post;
		
		extract( $args );
		extract( $instance );
		
		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 5,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}
		if ( $instance[ 'type' ] == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'		 => absint( $instance[ 'number' ] ),
				'post_type'				 => 'post',
				'ignore_sticky_posts'	 => true,
				'post_status'			 => $post_status,
					) );
		} else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => absint( $instance[ 'number' ] ),
				'post_type'		 => 'post',
				'category__in'	 => intval( $instance[ 'category' ] ),
					) );
		}
		echo $before_widget;
		?>
		<?php if ( !empty( $instance[ 'title' ] ) ) { ?>
			<div class="pd_mag_post_title_wrap media media-middle">
				<?php
				if ( !empty( $instance[ 'image' ] ) ) {
					echo '<div class="media-left"> <div class="pd_mag_post_title_img">';
					echo '<img src="' . esc_url( $instance[ 'image' ] ) . '">';
					echo '</div></div>';
				}
				?>
				<div class="media-body media-middle">
					<?php
					echo '<h3 class="widget-title pd_mag_post_title"><span>' . esc_attr( $instance[ 'title' ] ) . '</span></h3>';
					if ( !empty( $instance[ 'text' ] ) ) {
						echo '<p>' . esc_textarea( $instance[ 'text' ] ) . '</p>';
					}
					?> 
				</div>
			</div>
			<?php
		}
		$i = 1;
		$featured = 'wp_mint_magazine_image_255x208';
		?>
		<div class="pd_featured_post_wrop">
			<ul class="pd_featured_posts_list clearfix">
				<?php
				while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
					?>
					<li class="single-article pd_featured_items clearfix">
						<div class="pd_featured_items_wrap">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php
								$img = '';
								if ( has_post_thumbnail() ) {
									$thumbnail_id = get_post_thumbnail_id( $post->ID );
									$image_alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
									$title_attribute = get_the_title( $post->ID );
									if ( empty( $image_alt_text ) ) {
										$image_alt_text = $title_attribute;
									}
									$img = get_the_post_thumbnail( $post->ID, $featured, array(
										'title'	 => esc_attr( $title_attribute ),
										'alt'	 => esc_attr( $image_alt_text ),
											) );
								}
								if ( empty( $img ) ) {
									$img = '<img src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/600x600.png">';
								}
								?>
								<figure class="pd_featured_post_img">
									<?php echo $img; ?>
								</figure>
								<div class="article-content pd_featured_post_content">
									<h3 class="entry-title">
										<?php the_title(); ?>
									</h3>
								</div>
							</a>
						</div>
					</li>
					<?php
					$i ++;
				endwhile;
				?>
			</ul>
		</div>
		<?php
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}

}

/**
 * widget class for Post grid layout style 2
 */
class wp_mint_magazine_post_grid_layout_style_2 extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'						 => 'post_grid_layout_style_2',
			'description'					 => __( 'Display latest posts or posts of specific category.', 'wp-mint-magazine' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( false, $name = __( 'Post grid layout style 2', 'wp-mint-magazine' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 4,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );
		?>
		<div class="post-grid-layout-wrap">
			<label class="widget-form-label"><?php esc_html_e( 'Layout will be as below:', 'wp-mint-magazine' ) ?></label>
			<div class="post-grid-layout-view">
				<img src="<?php echo wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/post_grid_layout_style_2.jpg' ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Description', 'wp-mint-magazine' ); ?></label>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label label-inline" for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to display:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $instance[ 'number' ] ); ?>" size="3" />
			</div>

			<div class="widget-form-group">
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php esc_html_e( 'Show latest Posts', 'wp-mint-magazine' ); ?>
				<br />
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php esc_html_e( 'Show posts from a category', 'wp-mint-magazine' ); ?>
				<br />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category:', 'wp-mint-magazine' ); ?></label>
				<?php
				wp_dropdown_categories( array(
					'show_option_none'	 => ' ',
					'name'				 => $this->get_field_name( 'category' ),
					'selected'			 => intval( $instance[ 'category' ] ),
				) );
				?>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Widget title image', 'wp-mint-magazine' ) ?></label>
				<div class="widget-grid-title-img-wrap">
					<div class="widget-grid-title-img-box">
						<img src="<?php echo esc_url( $instance[ 'image' ] ) ?>" class="upload_image_img" />
					</div>
					<input type="text" class="upload_image_input" value="<?php echo esc_url( $instance[ 'image' ] ) ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
					<button type="button" class="upload_image_button button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>"><?php esc_html_e( 'Select Image', 'wp-mint-magazine' ); ?></button>
					<button type="button" class="remove_image_button button button-secondary button-large"><?php esc_html_e( 'Remove Image', 'wp-mint-magazine' ); ?></button>
				</div>
			</div>
		</div>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'text' ] = sanitize_textarea_field( $new_instance[ 'text' ] );
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'type' ] = sanitize_text_field( $new_instance[ 'type' ] );
		$instance[ 'category' ] = intval( $new_instance[ 'category' ] );
		$instance[ 'image' ] = esc_url_raw( $new_instance[ 'image' ] );

		return $instance;
	}

	function widget( $args, $instance ) {

		global $post;

		extract( $args );
		extract( $instance );

		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 4,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}
		$view_more = '';
		if ( $instance[ 'type' ] == 'latest' ) {
			$view_more = get_site_url() . '/latest';
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'		 => absint( $instance[ 'number' ] ),
				'post_type'				 => 'post',
				'ignore_sticky_posts'	 => true,
				'post_status'			 => $post_status,
					) );
		} else {
			$view_more = esc_url( get_category_link( intval( $instance[ 'category' ] ) ) );
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => absint( $instance[ 'number' ] ),
				'post_type'		 => 'post',
				'category__in'	 => intval( $instance[ 'category' ] ),
					) );
		}
		echo $before_widget;
		?>
		<section class="pd_latest_post_section pd_latest_post pd_mag_post">
			<div class="">
				<div class="row">
					<div class="col-md-12 pd_latest_post_title">
						<div class="pd_mag_post_title_wrap">
							<?php
							if ( !empty( $instance[ 'image' ] ) ) {
								echo '<img src="' . esc_url( $instance[ 'image' ] ) . '">';
							}
							if ( !empty( $instance[ 'title' ] ) ) {
								echo '<h3 class="widget-title pd_mag_post_title"><span>' . esc_attr( $instance[ 'title' ] ) . '</span></h3>';
							}
							if ( !empty( $instance[ 'text' ] ) ) {
								echo '<p>' . esc_textarea( $instance[ 'text' ] ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
					$i = 1;
					$featured = 'wp_mint_magazine_image_652x540';
					while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
						$img = '';
						if ( has_post_thumbnail() ) {
							$thumbnail_id = get_post_thumbnail_id( $post->ID );
							$image_alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
							$title_attribute = get_the_title( $post->ID );
							if ( empty( $image_alt_text ) ) {
								$image_alt_text = $title_attribute;
							}
							$img = get_the_post_thumbnail( $post->ID, $featured, array(
								'title'	 => esc_attr( $title_attribute ),
								'alt'	 => esc_attr( $image_alt_text ),
									) );
						}
						if ( empty( $img ) ) {
							$img = '<img src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/600x600.png">';
						}
						if ( $i == 1 ) {
							$featured = array( 150, 150 );
							?>
							<div class="first-post col-md-7">
								<div class="single-article clearfix">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<figure class="pd_latest_post_big_img_wrap">
											<?php echo $img; ?>
										</figure>
										<div class="article-content">
											<h3 class="entry-title pd_latest_post_big_title"><?php the_title(); ?></h3>
										</div>
									</a>
								</div>
							</div>
							<div class="col-md-5 following-post">
								<div class="pd_latest_post_following">
								<?php } else { ?>

									<div class="following_post_item">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<div class="media">
												<div class="media-left">
													<div class="following_post_img ">
														<?php echo $img; ?>
													</div>
												</div>
												<div class="media-body media-middle following_post_content">
													<h5 class="following_post_title">
														<?php the_title(); ?>
													</h5>
													<div class="following_post_info">
														<?php the_excerpt(); ?>
													</div>
												</div>
											</div>
										</a>
									</div>

									<?php
								}
								$i ++;
							endwhile;
							if ( $i > 1 ) {
								?>
							</div>
							<div class="pd_latest_post_more">
								<a href="<?php echo esc_url( $view_more ); ?>"><?php esc_html_e( 'View More Post', 'wp-mint-magazine' ) ?> <i class="fa fa-angle-double-right"></i></a>
							</div>  
						</div>
						<?php
					}
					?>     
				</div>
			</div>
		</section> 
		<?php
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}

}

/**
 * widget class for Post grid layout style 3
 */
class wp_mint_magazine_post_grid_layout_style_3 extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'						 => 'post_grid_layout_style_3',
			'description'					 => __( 'Display latest posts or posts of specific category.', 'wp-mint-magazine' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( false, $name = __( 'Post grid layout style 3', 'wp-mint-magazine' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 7,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );
		?>
		<div class="post-grid-layout-wrap">
			<label class="widget-form-label"><?php esc_html_e( 'Layout will be as below:', 'wp-mint-magazine' ) ?></label>
			<div class="post-grid-layout-view">
				<img src="<?php echo wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/post_grid_layout_style_3.jpg' ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Description', 'wp-mint-magazine' ); ?></label>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label label-inline" for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to display:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $instance[ 'number' ] ); ?>" size="3" />
			</div>

			<div class="widget-form-group">
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php esc_html_e( 'Show latest Posts', 'wp-mint-magazine' ); ?>
				<br />
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php esc_html_e( 'Show posts from a category', 'wp-mint-magazine' ); ?>
				<br />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'wp-mint-magazine' ); ?>
					:</label>
				<?php
				wp_dropdown_categories( array(
					'show_option_none'	 => ' ',
					'name'				 => $this->get_field_name( 'category' ),
					'selected'			 => intval( $instance[ 'category' ] ),
				) );
				?>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Widget title image', 'wp-mint-magazine' ) ?></label>
				<div class="widget-grid-title-img-wrap">
					<div class="widget-grid-title-img-box">
						<img src="<?php echo esc_url( $instance[ 'image' ] ) ?>" class="upload_image_img" />
					</div>
					<input type="text" class="upload_image_input" value="<?php echo esc_url( $instance[ 'image' ] ) ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
					<button type="button" class="upload_image_button button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>"><?php esc_html_e( 'Select Image', 'wp-mint-magazine' ); ?></button>
					<button type="button" class="remove_image_button button button-secondary button-large"><?php esc_html_e( 'Remove Image', 'wp-mint-magazine' ); ?></button>
				</div>
			</div>
		</div>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'text' ] = sanitize_textarea_field( $new_instance[ 'text' ] );
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'type' ] = sanitize_text_field( $new_instance[ 'type' ] );
		$instance[ 'category' ] = intval( $new_instance[ 'category' ] );
		$instance[ 'image' ] = esc_url_raw( $new_instance[ 'image' ] );

		return $instance;
	}

	function widget( $args, $instance ) {

		global $post;

		extract( $args );
		extract( $instance );

		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 7,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}
		if ( $instance[ 'type' ] == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'		 => absint( $instance[ 'number' ] ),
				'post_type'				 => 'post',
				'ignore_sticky_posts'	 => true,
				'post_status'			 => $post_status,
					) );
		} else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => absint( $instance[ 'number' ] ),
				'post_type'		 => 'post',
				'category__in'	 => intval( $instance[ 'category' ] ),
					) );
		}
		echo $before_widget;
		?>
		<section class="pd_grid_type_post_section ">
			<div class="row">
				<div class="col-md-12">
					<div class="pd_mag_post_title_wrap media">
						<?php
						if ( !empty( $instance[ 'image' ] ) ) {
							echo '<div class="media-left"> <div class="pd_mag_post_title_img">';
							echo '<img src="' . esc_url( $instance[ 'image' ] ) . '">';
							echo '</div></div>';
						}
						?>
						<div class="media-body media-middle">
							<?php
							if ( !empty( $instance[ 'title' ] ) ) {
								echo '<h3 class="widget-title pd_mag_post_title"><span>' . esc_attr( $instance[ 'title' ] ) . '</span></h3>';
							}
							if ( !empty( $instance[ 'text' ] ) ) {
								echo '<p>' . esc_textarea( $instance[ 'text' ] ) . '</p>';
							}
							?> 
						</div>
					</div>
					<div class="pd_grid_type_wrap clearfix">
						<?php
						$i = 1;
						$featured = 'wp_mint_magazine_image_682x505';

						while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
							?>
							<div class="single-article pd_grid_type_post clearfix <?php echo ($i == 1 ? 'pd_grid_big' : 'pd_grid_small') ?>">
								<div class="pd_grid_type_post_wrap">
									<div class="pd_grid_type_post_box">
										<?php
										$img = '';
										if ( has_post_thumbnail() ) {
											$thumbnail_id = get_post_thumbnail_id( $post->ID );
											$image_alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
											$title_attribute = get_the_title( $post->ID );
											if ( empty( $image_alt_text ) ) {
												$image_alt_text = $title_attribute;
											}
											$img = get_the_post_thumbnail( $post->ID, $featured, array(
												'title'	 => esc_attr( $title_attribute ),
												'alt'	 => esc_attr( $image_alt_text ),
													) );
										}
										if ( empty( $img ) ) {
											$img = '<img src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/600x600.png">';
										}
										?>
										<a href="<?php the_permalink() ?>" title="<?php the_title( '', '' ) ?>">
											<figure class="pd_grid_type_post_img">
												<?php echo $img; ?>
											</figure>
										</a>
										<div class="article-content pd_grid_type_post_content">
											<div class="pd_grid_post_cat_label">
												<?php
												if ( $type != 'category' ) {
													$categories = get_the_category();
												} else {
													$categories = array( get_term( $category, 'category' ) );
												}
												if ( !empty( $categories ) ) {
													foreach ( $categories as $category ) {
														echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"  rel="category tag">' . $category->name . '</a>';
														break;
													}
												}
												?>
											</div>
											<h3 class="entry-title pd_grid_type_post_title">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php the_title(); ?>
												</a>
											</h3>
											<div class="following_post_info pd_grid_type_post_info">
												<?php the_excerpt(); ?>
											</div>
										</div>
										<div class="pd_post_author pd_grid_type_post_author"><i class="fa fa-bars"></i> <?php esc_html_e( 'By', 'wp-mint-magazine' ) ?><span>
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
											</span></div>
									</div>
								</div>
							</div>
							<?php
							$featured = 'wp_mint_magazine_image_325x230';
							$i ++;
						endwhile;
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}

}

/**
 * widget class for Post grid layout style 4
 */
class wp_mint_magazine_post_grid_layout_style_4 extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'						 => 'post_grid_layout_style_4',
			'description'					 => __( 'Display latest posts or posts of specific category.', 'wp-mint-magazine' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( false, $name = __( 'Post grid layout style 4', 'wp-mint-magazine' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 5,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );
		?>
		<div class="post-grid-layout-wrap">
			<label class="widget-form-label"><?php esc_html_e( 'Layout will be as below:', 'wp-mint-magazine' ) ?></label>
			<div class="post-grid-layout-view">
				<img src="<?php echo wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/post_grid_layout_style_4.jpg' ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Description', 'wp-mint-magazine' ); ?></label>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label label-inline" for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to display:', 'wp-mint-magazine' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $instance[ 'number' ] ); ?>" size="3" />
			</div>

			<div class="widget-form-group">
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php esc_html_e( 'Show latest Posts', 'wp-mint-magazine' ); ?>
				<br />
				<input type="radio" <?php checked( esc_attr( $instance[ 'type' ] ), 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php esc_html_e( 'Show posts from a category', 'wp-mint-magazine' ); ?>
				<br />
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label" for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category:', 'wp-mint-magazine' ); ?></label>
				<?php
				wp_dropdown_categories( array(
					'show_option_none'	 => ' ',
					'name'				 => $this->get_field_name( 'category' ),
					'selected'			 => intval( $instance[ 'category' ] ),
				) );
				?>
			</div>
			<div class="widget-form-group">
				<label class="widget-form-label"><?php esc_html_e( 'Widget title image', 'wp-mint-magazine' ) ?></label>
				<div class="widget-grid-title-img-wrap">
					<div class="widget-grid-title-img-box">
						<img src="<?php echo esc_url( $instance[ 'image' ] ) ?>" class="upload_image_img" />
					</div>
					<input type="text" class="upload_image_input" value="<?php echo esc_url( $instance[ 'image' ] ) ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
					<button type="button" class="upload_image_button button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>"><?php esc_html_e( 'Select Image', 'wp-mint-magazine' ); ?></button>
					<button type="button" class="remove_image_button button button-secondary button-large"><?php esc_html_e( 'Remove Image', 'wp-mint-magazine' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'text' ] = sanitize_textarea_field( $new_instance[ 'text' ] );
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'type' ] = sanitize_text_field( $new_instance[ 'type' ] );
		$instance[ 'category' ] = intval( $new_instance[ 'category' ] );
		$instance[ 'image' ] = esc_url_raw( $new_instance[ 'image' ] );

		return $instance;
	}

	function widget( $args, $instance ) {

		global $post;

		extract( $args );
		extract( $instance );

		$tg_defaults = array(
			'title'		 => '',
			'text'		 => '',
			'number'	 => 5,
			'type'		 => 'latest',
			'category'	 => '',
			'image'		 => '',
		);
		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}
		if ( $instance[ 'type' ] == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'		 => absint( $instance[ 'number' ] ),
				'post_type'				 => 'post',
				'ignore_sticky_posts'	 => true,
				'post_status'			 => $post_status,
					) );
		} else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => absint( $instance[ 'number' ] ),
				'post_type'		 => 'post',
				'category__in'	 => intval( $instance[ 'category' ] ),
					) );
		}
		echo $before_widget;
		?>

		<?php if ( !empty( $instance[ 'title' ] ) ) { ?>
			<div class="pd_mag_post_title_wrap media">
				<?php
				if ( !empty( $instance[ 'image' ] ) ) {
					echo '<div class="media-left"> <div class="pd_mag_post_title_img">';
					echo '<img src="' . esc_url( $instance[ 'image' ] ) . '">';
					echo '</div></div>';
				}
				?>
				<div class="media-body media-middle">
					<?php
					echo '<h3 class="widget-title pd_mag_post_title"><span>' . esc_attr( $instance[ 'title' ] ) . '</span></h3>';
					if ( !empty( $instance[ 'text' ] ) ) {
						echo '<p>' . esc_textarea( $instance[ 'text' ] ) . '</p>';
					}
					?> 
				</div>
			</div>
		<?php } ?>

		<?php
		$i = 1;
		$featured = 'wp_mint_magazine_image_680x415';
		?>
		<div class="pd_post_list_wrap">
			<?php
			while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
				?>
				<div class="post pd_post_list_article"> 
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<?php
							$img = '';
							if ( has_post_thumbnail() ) {
								$thumbnail_id = get_post_thumbnail_id( $post->ID );
								$image_alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
								$title_attribute = get_the_title( $post->ID );
								if ( empty( $image_alt_text ) ) {
									$image_alt_text = $title_attribute;
								}
								$img = get_the_post_thumbnail( $post->ID, $featured, array(
									'title'	 => esc_attr( $title_attribute ),
									'alt'	 => esc_attr( $image_alt_text ),
										) );
							}
							if ( empty( $img ) ) {
								$img = '<img src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/600x600.png">';
							}
							?>
							<figure class="pd_post_img">
								<a href="<?php the_permalink() ?>" title="<?php echo the_title( '', '', false ) ?>">
									<?php echo $img; ?>
								</a>
							</figure>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="article-content pd_post_content">
								<div class="pd_post_cat_label">
									<?php
									$categories = get_the_category();
									if ( !empty( $categories ) ) {
										foreach ( $categories as $category ) {
											echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"  rel="category tag">' . $category->cat_name . '</a>';
										}
									}
									?>
								</div>
								<h3 class="entry-title pd_post_content_title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
								<div class="pd_post_author"><i class="fa fa-bars"></i> <?php esc_html_e( 'By', 'wp-mint-magazine' ) ?><span class="pd_author_name">
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
									</span></div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$i ++;
			endwhile;
			?>
		</div>
		<?php
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}

}
