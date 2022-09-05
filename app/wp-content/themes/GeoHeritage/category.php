<?php get_header(); 

$region = get_queried_object();
$emblem = get_field("regionEmblem", $region);
$size   = 'medium';
$thumb  = $emblem['sizes'][ $size ]; ?>

<section id="banner">
    <div class="container">
        <img src="<?php echo $thumb ?>" alt="" class="image">

        <div class="info">
            <h1 class="title"><?php echo $region->name; ?></h1>
            <!-- <p class="text">
                <?php echo $region->description; ?>
            </p> -->
        </div>
    </div>
</section>

<section id="description">
    <div class="container">
        <div class="info">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe earum quasi debitis fugiat assumenda deleniti voluptate inventore ipsam nesciunt nulla sunt aperiam excepturi impedit natus, quod maxime accusantium nobis est omnis cupiditate repudiandae. Eaque vero saepe consequuntur nulla! Deleniti magni dolorem in inventore, odit suscipit cum nobis quam ducimus, expedita esse veniam mollitia distinctio ab eos. Blanditiis non libero illo. Assumenda vitae repudiandae tenetur officia beatae aspernatur deserunt. Nulla, expedita. Aspernatur impedit suscipit natus, consequuntur veniam vero exercitationem accusamus hic nemo sit eveniet cum voluptates optio minima nisi! Officiis vero tenetur temporibus rerum perferendis quibusdam nisi enim! Repudiandae aut architecto quas doloribus, repellat quisquam explicabo provident unde libero odio ducimus molestiae tempore? Aliquid suscipit animi in repudiandae impedit, iure corrupti unde labore sint, pariatur quisquam laudantium. Quod quo, dicta repudiandae rem, magnam maiores impedit voluptates commodi modi, corporis mollitia recusandae temporibus pariatur officiis dolores obcaecati consequatur saepe eveniet eos! Quisquam, aut illum corrupti quam a dolorum quaerat, sapiente totam quod ex quibusdam dolore velit, beatae iure! Corporis corrupti minus, id atque tempore obcaecati consequuntur rem adipisci? Optio illum perferendis quam sit ullam, autem modi sunt natus provident a dicta facere hic. Sunt maxime maiores porro earum quibusdam ullam rerum temporibus, cupiditate a cumque cum dolore delectus, perspiciatis, quo quisquam. Quod repellat unde dolor asperiores animi quidem facilis pariatur ipsa voluptatum eligendi quia, velit corrupti dolore obcaecati repellendus? Reiciendis error explicabo nihil eius praesentium provident officiis! Odio illo impedit animi nulla rerum adipisci inventore doloribus ab, consequatur quo laudantium nemo exercitationem, placeat ipsam fugit maxime eius expedita. Esse earum quia porro tenetur quasi dolores optio ut excepturi commodi! Eaque ab nisi esse eligendi facere ratione necessitatibus nemo enim velit cumque? Tempore consectetur nobis nemo animi, ratione accusantium expedita voluptatibus veritatis aliquid quaerat dolorum distinctio dolore mollitia inventore quas saepe quis beatae!
        </div>
    </div>
</section>

<section id="mapWrapper">
    <canvas id="map" data-model="<?php the_field("3dmap_model", $region); ?>"></canvas>
</section>

<section id="monuments">
    <div class="container">
        <div class="list">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="monument" data-depth="0.2">
                    <?php echo get_the_post_thumbnail( $id, 'medium', array('class' => 'image') ); ?>
                    <div class="name">
                        <?php the_title() ?>

                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H9V0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H9V8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 6H14V4H6V6ZM15 0H11V1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11V10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="white"/>
                        </svg>
                    </div>
                </a>
            <?php endwhile; else : ?>
                <p>Геопам'ятки в процесі створення.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>