<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class CategoryFeatured extends Composer
{
    protected static $views = ['category'];

    public function with(): array
    {
        $term = get_queried_object();

        return [
            'term'          => $term,
            'featured_post' => $this->featuredPost($term),
        ];
    }

    protected function featuredPost($term)
    {
        if (!$term || !is_category()) {
            return null;
        }

        // 1) sticky w tej kategorii
        $sticky = get_option('sticky_posts', []);
        if (!empty($sticky)) {
            $q = new WP_Query([
                'post_type'              => 'post',
                'post__in'               => $sticky,
                'posts_per_page'         => 1,
                'ignore_sticky_posts'    => 1,
                'orderby'                => 'date',
                'order'                  => 'DESC',
                'tax_query'              => [[
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ]],
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]);
            if ($q->have_posts()) {
                return $q->posts[0];
            }
        }

        // 2) najnowszy z tej kategorii
        $q = new WP_Query([
            'post_type'              => 'post',
            'posts_per_page'         => 1,
            'ignore_sticky_posts'    => 1,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'tax_query'              => [[
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $term->term_id,
            ]],
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ]);

        return $q->have_posts() ? $q->posts[0] : null;
    }
}
