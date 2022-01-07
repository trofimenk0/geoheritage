<?php get_header(); ?>



<section id="banner" style="background-image: url('<?php the_field('bannerBG'); ?>');">
    <div class="container">
        <div class="info">
            <h1 class="title"><?php the_title(); ?></h1>
            <p class="text">
                <?php the_field("banner_text"); ?>
            </p>
        </div>

        <img src="<?php the_field('bannerImage'); ?>" alt="" class="image">
    </div>
</section>



<section id="description">
    <div class="container">

        <?php $rows = get_field("descriptionRow");
        
        if($rows) {
            foreach($rows as $row) { ?>

                <div class="row">
                    <div class="text">
                        <?php echo $row['descriptionText'] ?>
                    </div>
                    <img src="<?php echo $row["descriptionImage"] ?>" alt="" class="image">
                </div>

            <?php }
        } ?>

    </div>
</section>



<section id="mapWrapper">
    <canvas id="map" data-model="<?php the_field("3dmap_model"); ?>"></canvas>
</section>



<section id="regions">
    <div class="container">
    
        <?php $categories = get_categories( [
            'taxonomy'     => 'category',
            'type'         => 'post',
            'child_of'     => 0,
            'parent'       => '',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => 0,
            'hierarchical' => 1,
            'exclude'      => '',
            'include'      => '',
            'number'       => 0,
            'pad_counts'   => false,
        ] );

        if( $categories ){ ?>
            <div class="list">
                <?php foreach( $categories as $cat ){ 
                    
                    $emblem = get_field('regionEmblem', $cat); 

                    $size = 'category-thumb';
                    $thumb = $emblem['sizes'][ $size ]; ?>
                    
                    <a href="<?php echo get_category_link( $cat->term_id ) ?>" class="region">
                        <img src="<?php echo $thumb; ?>" alt="" class="image">
                        <div class="name">
                            <?php echo $cat->name ?>
                        </div>
                    </a>

                <?php 
                
            
                // Данные в объекте $cat

                // $cat->term_id
                // $cat->name
                // $cat->slug (rubrika-1)
                // $cat->term_group (0)
                // $cat->term_taxonomy_id (4)
                // $cat->taxonomy (category)
                // $cat->description (Текст описания)
                // $cat->parent (0)
                // $cat->count (14)
                // $cat->object_id (2743)
                // $cat->cat_ID (4)
                // $cat->category_count (14)
                // $cat->category_description (Текст описания)
                // $cat->cat_name (Рубрика 1)
                // $cat->category_nicename (rubrika-1)
                // $cat->category_parent (0)
            
            
            
                } ?>
            </div>
        <?php } ?>
    
    </div>
</section>


<?php get_footer(); ?>