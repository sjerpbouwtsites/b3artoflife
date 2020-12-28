<?php

/* template name: intake */

get_header('geen-logo-of-menu');
set_query_var('klassen_bij_primary', "intake");
get_template_part('/sja/open-main');

echo "<article class='bericht'>";

ag_uitgelichte_afbeelding_ctrl();

while ( have_posts() ) : the_post();
	echo "<div class='verpakking marginveld veel'>";
	echo "<div class='neg-mar flex'>";

		if ($cf = get_field('contact_formulier', $post->ID)) {
			echo do_shortcode('[contact-form-7 id="'.$cf.'" title="Gratis tntake"]');
		}

		echo "<div class='intake-rechts'>";

			do_action('ag_pagina_titel');

			do_action('ag_pagina_voor_tekst');

			echo "<div class='bericht-tekst'>";
				the_content();

				$terug = new Ag_knop(array(
					'link'		=> get_option('page_on_front'),
					'tekst'		=> 'Terug naar de voorpagina',
					'ikoon'		=> 'home',
				));

				$terug->print();

			echo "</div>";
		echo "</div>";

	echo "</div>";
	echo "</div>";
endwhile; // End of the loop.

echo "</article>";

do_action('ag_singular_na_artikel');

get_template_part('/sja/sluit-main');
get_footer('alleen-colofon');
