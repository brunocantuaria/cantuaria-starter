<?php
/*
 * Coleção de correções gerais
 */


//Yoast SEO - Corrige timezone no source code
add_filter( 'wpseo_schema_article', 'yoast_modify_schema_graph_pieces' );
add_filter( 'wpseo_schema_webpage', 'yoast_modify_schema_graph_pieces' );
function yoast_modify_schema_graph_pieces( $data ) { 

    $time = strtotime($data['datePublished']) - 10800;
    $data['datePublished'] = date('Y-m-d\TH:i:s', $time) . '-03:00';

    $time = strtotime($data['dateModified']) - 10800;
    $data['dateModified'] = date('Y-m-d\TH:i:s', $time) . '-03:00';

	return $data;
}

add_filter('crop_thumbnails_activat_on_adminpages', function($oldValue) {
	return true;
});


add_filter( 'wpseo_schema_organization', 'add_custom_schema_piece', 10000, 1 );
function add_custom_schema_piece( $data ) {
    $data['@type'] = 'NewsMediaOrganization';
    return $data;
}



//RSS - Adiciona thumbnail
function rss_post_thumbnail($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
        $content = '<div>' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');



/*
 * ACF - Clear cache after ACF options page is saved
 */
add_action('acf/save_post', function(){
    if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
    do_action( 'litespeed_purge_url', 'https://diariodoestadogo.com.br' );
}, 20);
  


/*
 * Fix the query for acf relationship module
 */
add_filter( 'acf/fields/relationship/query', function($args) {

    $args['posts_per_page'] = 40;
    $args['orderby'] = 'post_date';
    $args['order'] = 'DESC';
    return $args;

});


/*
 * Check when fonts loaded and add
 * the class to the body
 */
add_action('wp_footer', function(){
    ?>
    <script>
    ;(function () {
        if (!('fonts' in document)) {
            document.documentElement.className += ' fonts-loaded';
        }
        document.fonts.load('1em Libre Baskerville').then(function () {
            document.documentElement.className += ' fonts-loaded';
        });
    })();
    </script>
    <?php
});


add_action('wp_head', function(){
    ?>
    <style>
    h1,.h1, h2, .h2 {font-family: 'Arial'; line-height: 1.5;}
    .display-4{line-height: 1.5;}
    .fonts-loaded h1,.fonts-loaded .h1, .fonts-loaded h2, .fonts-loaded .h2 {font-family: 'Libre Baskerville', serif;}
    .fonts-loaded .display-4{line-height: 1.2;}
    </style>
    <?php
});



/*
 * Add content after second paragraph of text
 */
add_filter('the_content', function($content){

    if (!is_admin() && is_singular()) {

        $append = PHP_EOL . PHP_EOL . '<a href="https://api.whatsapp.com/send?text='. get_permalink() .'" target="_blank" class="entry-share-inside" rel="nofollow">&#8226; Compartilhe essa notícia no Whatsapp</a><a href="https://telegram.me/share/url?url='. get_permalink() .'&text=" target="_blank" class="entry-share-inside" rel="nofollow">&#8226; Compartilhe essa notícia no Telegram</a>';

        $parts = explode(PHP_EOL, $content);
        
        if (isset($parts[3]))
            $parts[2] .= $append;
        else
            $parts[0] .= $append;

        $content = implode(PHP_EOL, $parts);

    }

    return $content;

}, 1, 1);



/*
 * Activates WordPress Builtin Lazyload
 */
add_filter( 'the_content', 'add_image_data_src' );
add_filter( 'widget_text', 'add_image_data_src' );

// Replace the image attributes in Post/Page Content
function add_image_data_src( $content ) {
    $content = preg_replace( '/(<img.+)(src)/Ui', '$1data-$2', $content );
    $content = preg_replace( '/(<img.+)(srcset)/Ui', '$1data-$2', $content );
    return $content;
}


add_filter( 'wp_get_attachment_image_attributes', function($atts){
    $atts['data-src'] = $atts['src'];
    unset( $atts['src'] );
    
    if( isset( $atts['srcset'] ) ) {
      $atts['data-srcset'] = $atts['srcset'];
      unset( $atts['srcset'] );
    }
  
    return $atts;
}, 10, 1 );


add_action('wp_footer', function(){
?>
<script>
( function() { 'use strict';
    let images = document.querySelectorAll('img[data-src]'),
        bgImages = document.querySelectorAll('[data-bgimg-src]');
              
    document.addEventListener('DOMContentLoaded', onReady);
    function onReady() {
        // Show above-the-fold images first
        showImagesOnView();

        // scroll listener
        window.addEventListener( 'scroll', showImagesOnView, false );
    }
    
    // Show the image if reached on viewport
    function showImagesOnView( e ) {
        
        for( let i of images ) {
            if( i.getAttribute('src') ) { continue; } // SKIP if already displayed
            
            // Compare the position of image and scroll
            let bounding = i.getBoundingClientRect();
            let isOnView = bounding.top >= 0 &&
            bounding.left >= 0 &&
            bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            bounding.right <= (window.innerWidth || document.documentElement.clientWidth);
            
            if( isOnView ) {
                i.setAttribute( 'src', i.dataset.src );
                if( i.getAttribute('data-srcset') ) {
                i.setAttribute( 'srcset', i.dataset.srcset );
                }
            }
        }
        
        for( let i of bgImages ) {
            if( !i.getAttribute('data-bgimg-src') ) { continue; } // SKIP if already displayed
            
            // Compare the position of image and scroll
            let bounding = i.getBoundingClientRect();
            let isOnView = bounding.top >= 0 &&
            bounding.left >= 0 &&
            bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            bounding.right <= (window.innerWidth || document.documentElement.clientWidth);
            
            if( isOnView ) {
                i.style.backgroundImage = "url("+ i.getAttribute('data-bgimg-src') +")";
                i.removeAttribute('data-bgimg-src');
            }
        }
    }
              
})();
</script>
<style>
img[data-src] {
  opacity: 0;
  transition: opacity .25s ease-in-out;
  will-change: opacity;
}

/* appear animation */
img[data-src][src] {
  opacity: 1;
}
</style>
<?php
});
