This first will goes to page template or index

<div class="container">
<div class="row">
<div class="col-md-8">

<?php

$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => '2',
    'paged'          => 1,
];
$my_posts = new WP_Query( $args );

//var_dump($my_posts->max_num_pages);
if ( $my_posts->have_posts() ):

?>
<div class="my-posts">
<?php while ( $my_posts->have_posts() ): $my_posts->the_post()?>
			<h2><?php the_title()?></h2>
			<?php the_excerpt()?>
			<?php endwhile?>
<?php endif?>
</div>
<div class="loadmore">Load More...</div>
</div>

<h1 style="display: none;">Hello, this is a test purpose!</h1>

<div class="col-md-4">
<?php get_sidebar();?>
</div>
</div>
</div>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
var maxPage = '<?php echo $my_posts->max_num_pages ?>';
jQuery(function($) {
$('body').on('click', '.loadmore', function() {

var data = {
'action': 'load_posts_by_ajax',
'page': page,
'security': '<?php echo wp_create_nonce( "load_more_posts" ); ?>'
};

$.post(ajaxurl, data, function(response) {
$('.my-posts').append(response);
if(page>=maxPage){
$('.loadmore').hide();
}
page++;
});
});
});
</script>


And this goes to functions.php
<?php
// Load More Post by aJax
add_action( 'wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback' );
add_action( 'wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback' );

function load_posts_by_ajax_callback() {
    check_ajax_referer( 'load_more_posts', 'security' );
    $paged = $_POST['page'];
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => '2',
        'paged'          => $paged,
    ];
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ):
    ?>
<?php while ( $my_posts->have_posts() ): $my_posts->the_post()?>
			<h2><?php the_title()?></h2>
			<?php the_excerpt()?>
			<?php endwhile?>
<?php
endif;

    wp_die();
}

?>
