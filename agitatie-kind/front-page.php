<?php

get_header();
set_query_var('klassen_bij_primary', "singular");
get_template_part('/sja/open-main');

echo "<article class='bericht'>";

ag_uitgelichte_afbeelding_ctrl();

while ( have_posts() ) : the_post();
	echo "<div class='verpakking verpakking-klein marginveld'>";

		do_action('ag_pagina_titel');

		do_action('ag_pagina_voor_tekst');

		echo "<div class='bericht-tekst'>";
			the_content();
		echo "</div>";

	echo "</div>";
endwhile; // End of the loop.

echo "</article>";

do_action('ag_singular_na_artikel');

$reviews_3 = get_posts(array(
	'post_type' => 'grfwp-review',
	'posts_per_page' => 3,
));

if ($reviews_3) {

	echo "<section class='verpakking marginveld veel'>";
		echo "<div class='art-lijst'>";

		if ($rtet = get_field('review_titel_en_tekst')) {
			echo "<div class='blok-in-art-lijst'>";
				echo apply_filters('the_content', $rtet);
			echo "</div>";
		}


		foreach ($reviews_3 as $r) :

			$recensie_art = new Ag_review_c( array(
				'class'			=> 'in-lijst',
				'taxonomieen' 	=> false,
				'exc_lim'		=> 450
			), $r);

			$recensie_art->print();

		endforeach;

		echo "</div>"; //art-lijst

		echo "<footer class='archief-footer'>";

		$terug = new Ag_knop(array(
			'class' 	=> 'in-wit ikoon-links',
			'link' 		=> get_post_type_archive_link('grfwp-review'),
			'tekst'		=> 'Bekijk alle reviews',
			'ikoon'		=> 'arrow-left-thick'
		));

		$terug->print();

		echo "<footer>";

	echo "</section>"; //verpakking

}

/////////////////////////////////////////////////


echo "<section class='verpakking marginveld veel'>
<h2>Nieuws</h2>";

$vp_posts = new WP_Query(array(
	'posts_per_page' => 6
));

echo "<div class='art-lijst'>";

if (count($vp_posts->posts)) : foreach ($vp_posts->posts as $vp_post) :

	if (!isset($a)) {
		$a = new Ag_article_c(array(
			'class' 		=> 'in-lijst',
			'htype'			=> 3,
			'geen_tekst'	=> false,
			'geen_afb'		=> true
		), $vp_post);
	} else {
		$a->art = $vp_post;
	}

	$a->gecontroleerd = false;
	$a->print();

endforeach; endif;

echo "</div>"; //art lijst

echo "<footer>";

$k = new Ag_knop(array(
	'link' 		=> get_post_type_archive_link('post'),
	'tekst' 	=> 'alle berichten',
	'class'		=> 'in-wit'
));
$k->print();

echo "</footer>";

echo "</section>";

//////////////////////////////////////////////////////

echo "<section class='verpakking marginveld veel'>
<h2>Kunstwerken</h2>";

$vp_posts = new WP_Query(array(
	'posts_per_page' => 6,
	'post_type'		 => 'kunstwerken'
));

echo "<div class='art-lijst'>";

if (count($vp_posts->posts)) : foreach ($vp_posts->posts as $vp_post) :

	unset($a);

	if (!isset($a)) {
		$a = new Ag_article_c(array(
			'class' 		=> 'in-lijst',
			'htype'			=> 3,
			'geen_tekst'	=> true,
			'geen_afb'		=> false,
			'geen_datum'	=> true

		), $vp_post);
	} else {
		$a->art = $vp_post;
	}

	$a->gecontroleerd = false;
	$a->print();

endforeach; endif;

echo "</div>"; //art lijst

echo "<footer>";

$k = new Ag_knop(array(
	'link' 		=> get_post_type_archive_link('post'),
	'tekst' 	=> 'alle berichten',
	'class'		=> 'in-wit'
));
$k->print();

echo "</footer>";

echo "</section>";



get_template_part('/sja/sluit-main');
get_footer();
