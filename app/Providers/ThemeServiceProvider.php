<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use App\Blocks\ExampleBlock;

class ThemeServiceProvider extends SageServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		parent::register();
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		/*--- CUSTOM POST TYPES ---*/

		// CUSTOM POST TYPE OFERTA
		add_action('init', function () {
			register_post_type('offer', [
				'label' => 'Oferta',
				'public' => true,
				'has_archive' => false,
				'rewrite' => ['slug' => 'oferta'],
				'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_rest' => true,
				'taxonomies' => ['category'],
				'menu_icon' => 'dashicons-list-view',
			]);
		});

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page([
				'page_title'  => 'Kafelki oferty',
				'menu_title'  => 'Kafelki oferty',
				'parent_slug' => 'edit.php?post_type=offer',
				'menu_slug'   => 'offer-cards',
				'capability'  => 'edit_posts',
			]);
		};

		// CUSTOM POST TYPE CASES
		add_action('init', function () {
			register_post_type('cases', [
				'label' => 'Realizacje',
				'public' => true,
				'has_archive' => false,
				'rewrite' => ['slug' => 'realizacje'],
				'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_rest' => true,
				'menu_icon' => 'dashicons-format-image',
			]);
		});

		/*--- OPTIONS PAGES ---*/

		add_action('acf/init', function () {
			if (function_exists('acf_add_options_page')) {
				acf_add_options_page([
					'page_title' => 'Ustawienia motywu',
					'menu_title' => 'Ustawienia motywu',
					'menu_slug'  => 'theme-settings',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				acf_add_options_page([
					'page_title' => 'Wezwanie do działania',
					'menu_title' => 'Wezwanie do działania',
					'menu_slug'  => 'bottom',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				acf_add_options_page([
					'page_title' => 'Partnerzy',
					'menu_title' => 'Partnerzy',
					'menu_slug'  => 'partners',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				/* 	acf_add_options_page([
					'page_title' => 'Oferta',
					'menu_title' => 'Oferta',
					'menu_slug'  => 'offer',
					'capability' => 'edit_posts',
					'parent_slug' => '',
					'redirect'   => false,
				]); */
			}
		});
	}
}
