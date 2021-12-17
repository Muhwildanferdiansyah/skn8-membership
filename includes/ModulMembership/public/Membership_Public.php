<?php

namespace Yukdiorder\Membership\ModulMembership;

class Membership_Public
{
    public function __construct()
    {
        // add_filter('the_content', [$this, 'filter_the_content_in_the_main_loop'], 3);
    }
    public function filter_the_content_in_the_main_loop($content)
    {

        // Check if we're inside the main loop in a single Post.
        if (is_singular() && in_the_loop() && is_main_query()) {
            return $content . esc_html__('IM FILTERING', 'wporg');
        }

        return $content;
    }
}
