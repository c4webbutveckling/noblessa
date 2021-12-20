
<?php
/**
 * The Header for our theme.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */
?><!DOCTYPE html>
<?php
	if ($_GET && key_exists('mfn-rtl', $_GET)):
		echo '<html class="no-js" lang="ar" dir="rtl">';
	else:
?>
<html <?php language_attributes(); ?> class="no-js <?php echo esc_attr(mfn_html_classes()); ?>"<?php mfn_tag_schema(); ?> >
<?php endif; ?>

<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php do_action('mfn_hook_top'); ?>

	<?php get_template_part('includes/header', 'sliding-area'); ?>

	<?php
		if (mfn_header_style(true) == 'header-creative') {
			get_template_part('includes/header', 'creative');
		}
	?>

	<div id="Wrapper">

		<?php

			// featured image: parallax

			$class = '';
			$data_parallax = array();

			if (mfn_opts_get('img-subheader-attachment') == 'parallax') {
				$class = 'bg-parallax';

				if (mfn_opts_get('parallax') == 'stellar') {
					$data_parallax['key'] = 'data-stellar-background-ratio';
					$data_parallax['value'] = '0.5';
				} else {
					$data_parallax['key'] = 'data-enllax-ratio';
					$data_parallax['value'] = '0.3';
				}
			}
		?>

<?php

// verify that this is a product category page
if ( is_product_category() ){
    global $wp_query;

    // get the query object
    $cat = $wp_query->get_queried_object();
    $top_content = get_term_meta($cat->term_id, 'mfn_product_cat_top_content', true);

    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id ); 

    // print the IMG HTML
    echo "<div class='shop-custom-header'>"; 
		echo "<div class='hero-image' style='background-image: linear-gradient(to right, rgba(55, 31, 28, .3), rgba(55, 31, 28, .3)), url({$image})'>";
			echo "<div class='shop-header-text'>";
				echo "<h6>".$cat->name."</h6>";
				echo "<h1 class='second-word'>".$top_content."</h1>";
				echo "<hr>";
			echo "</div>";
		echo "</div>";
    echo "</div>";

    $bottom_content = get_term_meta($cat->term_id, 'mfn_product_cat_bottom_content', true);
    echo "<div class='shop-custom-text'>";
        echo "<div class='shop-custom-text-left'>";
            echo "<h6>".$cat->name."</h6>";
            echo "<h2>".$bottom_content."</h2>";
            echo "<hr>";
        echo "</div>";
        echo "<div class='shop-custom-text-center'>";
            echo "<p>".$cat->description."</p>";
        echo "</div>";
    echo "</div>";
}

if(is_product()) {
	global $wp_query;

    // get the query object
    $prod = $wp_query->get_queried_object();

	
	$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	echo "<div class='shop-custom-header'>";
		echo "<div class='hero-image' style='background-image: linear-gradient(to right, rgba(55, 31, 28, .8), rgba(55, 31, 28, .8)), url({$image})'>";
			echo "<div class='shop-header-text'>";
            	echo "<h6>".$prod->post_title."</h6>";
            	echo "<h1 class='second-word'>".get_field('product-h1')."</h1>";
            	echo "<hr>";
			echo "</div>";
        echo "</div>";
	echo "</div>";  
	
	echo "<div class='product-links'>";
        echo previous_post_link('%link','<i class="fa fa-angle-left"></i>');
        echo next_post_link('%link','<i class="fa fa-angle-right"></i>');
    echo "</div>";
}

?>

		<?php

			$shop_id = mfn_ID();

			// if (mfn_header_style(true) == 'header-below') {
			// 	if (is_shop() || (mfn_opts_get('shop-slider') == 'all')) {
			// 		echo mfn_slider($shop_id);
			// 	}
			// }
		?>

		<div id="Header_wrapper" class="<?php echo esc_attr($class); ?>" <?php if ($data_parallax) {
			printf('%s="%.1f"', $data_parallax['key'], $data_parallax['value']);
		} ?>>

			<?php
				if ('mhb' == mfn_header_style()) {

					// mfn_header action for header builder plugin
					do_action('mfn_header');
					// if (is_shop() || (mfn_opts_get('shop-slider') == 'all')) {
					// 	echo mfn_slider($shop_id);
					// }

				} else {

					echo '<header id="Header">';
						if ( 'header-creative' != mfn_header_style(true) ) {
							// NOT header creative
							if( 'header-shop' == mfn_header_style(true) ){
								// header style: shop
								get_template_part('includes/header', 'style-shop');
							} else {
								// default headers
								get_template_part('includes/header', 'top-area');
							}
						}
						// if ( 'header-below' != mfn_header_style(true) ) {
						// 	// header below
						// 	if ( is_shop() || ( 'all' == mfn_opts_get('shop-slider') ) ) {
						// 		echo mfn_slider($shop_id);
						// 	}
						// }
					echo '</header>';

				}
			?>

			<?php
				function mfn_woocommerce_show_page_title()
				{
					return false;
				}
				add_filter('woocommerce_show_page_title', 'mfn_woocommerce_show_page_title');

				$subheader_advanced = mfn_opts_get('subheader-advanced');

				if (! mfn_slider_isset($shop_id) || is_product() || (is_array($subheader_advanced) && isset($subheader_advanced['slider-show']))) {

					// subheader

					$subheader_options = mfn_opts_get('subheader');

					if (is_array($subheader_options) && isset($subheader_options['hide-subheader'])) {
						$subheader_show = false;
					} elseif (get_post_meta(mfn_ID(), 'mfn-post-hide-title', true)) {
						$subheader_show = false;
					} else {
						$subheader_show = true;
					}

					// title

					if (is_array($subheader_options) && isset($subheader_options[ 'hide-title' ])) {
						$title_show = false;
					} else {
						$title_show = true;
					}

					// breadcrumbs

					if (is_array($subheader_options) && isset($subheader_options['hide-breadcrumbs'])) {
						$breadcrumbs_show = false;
					} else {
						$breadcrumbs_show = true;
					}

					// output

					if ($subheader_show) {

						echo '<div id="Subheader">';
							echo '<div class="container">';
								echo '<div class="column one">';

									if ($title_show) {

										$title_tag = mfn_opts_get('subheader-title-tag', 'h1');

										// single product can not use H1
										if (is_product() && $title_tag == 'h1') {
											$title_tag = 'h2';
										}

										echo '<'. esc_attr($title_tag) .' class="title">';
											if (is_product() && mfn_opts_get('shop-product-title')) {
												the_title();
											} else {
												woocommerce_page_title();
											}
										echo '</'. esc_attr($title_tag) .'>';
									}

									if ($breadcrumbs_show) {
										$home = mfn_opts_get('translate') ? mfn_opts_get('translate-home', 'Home') : __('Home', 'betheme');
										$woo_crumbs_args = apply_filters('woocommerce_breadcrumb_defaults', array(
											'delimiter' => false,
											'wrap_before' => '<ul class="breadcrumbs woocommerce-breadcrumb">',
											'wrap_after' => '</ul>',
											'before' => '<li>',
											'after' => '<span><i class="icon-right-open"></i></span></li>',
											'home' => esc_html($home),
										));

										woocommerce_breadcrumb($woo_crumbs_args);
									}

								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
			?>

		</div>

        <div class="headerSocial">
												  
			<?php
				if (has_nav_menu('social-menu-bottom')) {
					mfn_wp_social_menu_bottom();
						} else {
							get_template_part('includes/include', 'social');
						}
			?>
			
		</div>


		<?php do_action('mfn_hook_content_before');
