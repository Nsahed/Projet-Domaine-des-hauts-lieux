

<?php

get_header();

if ( have_posts()):
    while ( have_posts()) :
        the_post();
        

?>
<section class="allposts">

<div class="containerblog">
<div><h2 class="blogtitle"> <?php the_title() ?> </h2></div>
<div class="imgblog"><?php the_post_thumbnail() ?></div>
<div class="blogcontent"><p><?php the_content() ?></p></div>

    </div>
</section>
<?php endwhile;
    endif;
    ?>

  
<?php

get_footer();

?>

