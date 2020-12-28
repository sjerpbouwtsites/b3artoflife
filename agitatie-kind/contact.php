<?php

/*template name: contact */

get_header();
set_query_var('klassen_bij_primary', "contact");
get_template_part('/sja/open-main');

echo "<article class='bericht'>";

ag_uitgelichte_afbeelding_ctrl();

while ( have_posts() ) : the_post();
	echo "<div class='verpakking verpakking-klein marginveld'>";

		do_action('ag_pagina_titel');

		do_action('ag_pagina_voor_tekst');

		echo "<div class='bericht-tekst'>";
			the_content();

			if ($socials = get_field('socials', $post->ID)) {

				echo "<span class='socials-list'>";

				foreach ($socials as $s) {
					echo "<a href='".$s['link']."' target=_blank'>".ag_mdi($s['social'], false)."</a>";
				}

				echo "</span>";
			}


			if ($cf = get_field('contactformulier', $post->ID)) {
				echo do_shortcode('[contact-form-7 id="'.$cf.'" title="Gratis intake"]');
			}
		echo "</div>";

	echo "</div>";
endwhile; // End of the loop.


echo "</article>";




do_action('ag_singular_na_artikel');

get_template_part('/sja/sluit-main');
get_footer();
