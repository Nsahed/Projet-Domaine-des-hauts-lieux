<?php

get_header();

if ( have_posts()):
    while ( have_posts()) :
        the_post();
        

?>

 <!-- Layout : Posts -->

 <div class="posts">
<section>
<?php
        the_post_thumbnail()
        ?>
    <div class="img1">
        <div class="box box1">
            <h2>À propos</h2>
         

            <div class="text">
                Mickaël vous fait découvrir le Domaine les hauts lieux à travers des articles clairs, tranchants et toujours efficaces.Après le fruit de dix années de travail découvrez ses recherches, ses conseils, ses voyages autour de la viticulture de montagne et fortes pentes.  
            </div>
            <a href ="http://localhost/Projet/projet-domaine-des-hauts-lieux/wordpress/a-propos/"> <button class="learn">Accéder au blog</button></a>
        </div>
    </div>

</section>
    <?php endwhile;
    endif;
    ?>
<section>
    <div class="img2">
        <div class="box box2">
            <h2>Nos produits</h2>
            <div class="text">
                Vous cherchez à déguster des produits d'exceptions trouver les bons accords avec un plat ou tout simplement goûter de nouvelles choses et dénicher des pépites? Vous êtes au bon endroit! <br>
                Dans notre boutique vous trouverez nos gammes de vins et de miel pour aiguiser votre curiosité et éveiller vos papilles.
            </div>
            <a href ="http://localhost/Projet/projet-domaine-des-hauts-lieux/wordpress/boutique/"> <button class="learn">Découvrir la boutique</button></a>
        </div>
    </div>

</section>

<section>
    <div class="img3">
        <div class="box box3">
            <h2>Les évenements</h2>

            <div class="text">
                Amateurs de beaux flacons ? Par ici ! Venez découvrir nos événements directement au Domaine des hauts lieux. Tout au long de l'année, différents ateliers, visites, dégustations, vous seront proposés afin de pouvoir se rencontrer, échanger et partager ce trésor de la gastronomie française.
            </div>
            <a href ="http://localhost/Projet/projet-domaine-des-hauts-lieux/wordpress/evenements/"> <button class="learn">S'inscrire</button></a>
        </div>
    </div>
    </section>
</div>


<?php   

  
get_footer();
