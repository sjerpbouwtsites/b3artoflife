<?php

class Ag_review_c extends Ag_article_c{

	public function __construct ($config, $post) {
		parent::__construct($config, $post);
		$this->art = $post;
		$this->post_metadata = get_post_meta( $this->art->ID, 'grfwp', true );
	}

	public function datum() {

		if (!$this->post_metadata['review_date']) return;

		date_default_timezone_set('Europe/Berlin');
		setlocale(LC_ALL, 'nl_NL');

		$recensie_datum = DateTime::createFromFormat('d-m-Y', $this->post_metadata['review_date']);

		$repl = array(
			'january' 	=> "januari",
			'february'	=> 'februari',
			'march'		=> 'maart',
			'april'		=> 'april',
			'may'		=> 'mei',
			'june'		=> 'juni',
			'juli'		=> 'juli',
			'august'	=> 'augustus',
			'september'	=> 'september',
			'october'	=> 'oktober',
			'november'	=> 'november',
			'december'	=> 'december'
		);

		$dat_print = strtolower($recensie_datum->format('j F Y'));

		foreach ($repl as $engels => $nederlands) {
			$dat_print = str_replace($engels, $nederlands, $dat_print);
		}

		echo "<time class='post-datum tekst-zwart'>" . $dat_print . "</time>";

		if (array_key_exists('reviewer_org', $this->post_metadata) and $this->post_metadata['reviewer_org'] !== '') {

			echo "<span class='tekst-zwart'> | ".$this->post_metadata['reviewer_org']."</span>";

		}

	}

}