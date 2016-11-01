
<?php
/**
 * Template Name: workshop Page 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header();

$args = array(
	'post_type' => 'product',
	'product_cat' => 'workshops',
	'posts_per_page' => -1                
);
$products = new WP_Query($args);

$args = array(
	'post_type' => 'workshops',
	'posts_per_page' => -1
);
$workshops = new WP_Query($args);

$loop = $products;
$loop->posts = array_merge($products->posts, $workshops->posts);
$loop->post_count = $products->post_count + $workshops->post_count;

?>
<div class="workshop-wrapper">
	<div class="workshop-intro">
		<p>I run various screen printing courses in my fully equipped studio at Kendal’s vibrant creative hub The Factory. Click on the images below for more information and to book. If you’re already an experienced screen printer, my studio is occasionally available to hire.</p>
	

	    <div class="dropdown">
			<select name="workshops" id="workshop-menu">
				<?php
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
						
						<option value="workshop-<?php echo $post->ID; ?>"> <?php the_title();?></option>
					 
						<?php	
						endwhile;
					}
					wp_reset_postdata();
				?>
			</select>    
	    </div>

    </div>
    
    <ul class="products">
    
        <?php
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <li id="workshop-<?php echo $post->ID; ?>" class="workshop-item">            
                    <?php 
                    if($post->post_type == 'product') {
                        wc_get_template_part( 'content', 'productworkshop' );
                    } else {
						/*$meta = get_post_meta($post->ID);
						foreach($meta as $key=>$value) {
							echo '['.$key.'] '.$value.'<br />';
						}*/
						$imgid = get_post_meta($post->ID, 'thumbnail_image');
						$img = wp_get_attachment_image_src($imgid[0]);
                    ?>
                        <div class="workshop-thumb"><?php if($img[0]) echo '<img src="'.$img[0].'" />'; ?></div>
                        <div class="workshop-content">
                            <p><strong><?php the_title(); ?></strong></p>
                            <?php the_content(); ?>
                            <div class="workshop-button">
                                <a href="/contact/" class="button">Contact Ben</a>
                            </div>
                        </div>
                    <?php					
                    }
                    ?> 			
                </li>
                <?php	
                endwhile;
            } else {
                echo __( 'No products found' );
            }
            wp_reset_postdata();
        ?>
    </ul><!--/.products-->
</div>

<div id="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2326.786053507719!2d-2.745807084124419!3d54.32541358019584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487c8ddd5c5f3813%3A0x127e7a20a494a3f0!2sCastle+Mills%2C+Aynam+Rd%2C+Kendal%2C+Cumbria+LA9+7DE!5e0!3m2!1sen!2suk!4v1463502497857" width="100%" height="210" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<?php get_footer(); ?>
