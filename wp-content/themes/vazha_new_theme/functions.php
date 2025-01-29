<?php
if (!function_exists('vazha_new_setup')) {
    function vazha_new_setup()
    {
        // add custom logo
        add_theme_support('custom-logo', [
            'height' => 55,
            'width' => 143,
            'flex-width' => true,
            'flex-height' => true,
            'header-text' => '',
        ]);
        // add dynamic tag title
        add_theme_support('title-tag');
        //  switch on miniatures for posts and pages
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(457, 484, true);
    }
    add_action('after_setup_theme', 'vazha_new_setup');
}
// Подключение стилей и скриптов
add_action('wp_enqueue_scripts', 'vazha_enqueue_assets');
function vazha_enqueue_assets()
{
    // Шрифты
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,600,700|Rubik:400,600,700', false);

    // Стили
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css');
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css');
    wp_enqueue_style('all-icons', get_template_directory_uri() . '/assets/css/all.css');
    wp_enqueue_style('icofont', get_template_directory_uri() . '/assets/css/icofont.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css');
    wp_enqueue_style('vazhiko-style', get_template_directory_uri() . '/assets/css/style.css', array(), null);
    wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css');


    // Скрипты  (deregister and register again) jquery
//<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri(), '/assets/js/jquery.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true);

    // contact form
    wp_enqueue_script('contact-form', get_template_directory_uri() . '/assets/js/contact.js', array('jquery'), '1.0.0', true);

    // counter
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('counter', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('easing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', array('jquery'), '1.0.0', true);

    // wow animation
    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '1.0.0', true);

    // custom
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);


}



// Register navigation menus uses wp_nav_menu in five places.
function vazha_new_theme_menu()
{
    // gathering some zones of menus
    $locations = array(
        'header' => __('Header Menu', 'vazha_new_theme'),
        'footer' => __('Footer Menu', 'vazha_new_theme'),

    );
    // register menu's zones , which are in the variable locations
    register_nav_menus($locations);
}
// hook-event
add_action('init', 'vazha_new_theme_menu');

// // adding class nav-item to all menu items
// // 1 arg - type of changing, 2 on what we changing (name of custom function), 
// // 3 priority ,  4 quantity of args.
// add_filter('nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);
// // get list of all classes from menu items
// function custom_nav_menu_css_class($classes)
// {
//     // add class nav-item to list with all classes
//     $classes[] = 'nav-item';

//     return $classes;
// }

// add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10);
// function custom_nav_menu_link_attributes($attributes)
// {
//     $attributes['class'] = 'nav-link';
//     return $attributes;
// }




if (class_exists('\Walker_Nav_Menu')) {
    if (!class_exists('WP_Bootstrap_Navwalker')) {
        /**
         * WP_Bootstrap_Navwalker class.
         *
         * @extends Walker_Nav_Menu
         */
        class wp_bootstrap4_navwalker extends \Walker_Nav_Menu
        {

            /**
             * Starts the list before the elements are added.
             *
             * @since WP 3.0.0
             *
             * @see Walker_Nav_Menu::start_lvl()
             *
             * @param string   $output Used to append additional content (passed by reference).
             * @param int      $depth  Depth of menu item. Used for padding.
             * @param stdClass $args   An object of wp_nav_menu() arguments.
             */
            public function start_lvl(&$output, $depth = 0, $args = array())
            {
                if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = str_repeat($t, $depth);
                // Default class to add to the file.
                $classes = array('dropdown-menu');
                /**
                 * Filters the CSS class(es) applied to a menu list element.
                 *
                 * @since WP 4.8.0
                 *
                 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
                 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
                 * @param int      $depth   Depth of menu item. Used for padding.
                 */
                $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
                $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                /*
                 * The `.dropdown-menu` container needs to have a labelledby
                 * attribute which points to it's trigger link.
                 *
                 * Form a string for the labelledby attribute from the the latest
                 * link with an id that was added to the $output.
                 */
                $labelledby = '';
                // Find all links with an id in the output.
                preg_match_all('/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches);
                // With pointer at end of array check if we got an ID match.
                if (end($matches[2])) {
                    // Build a string to use as aria-labelledby.
                    $labelledby = 'aria-labelledby="' . esc_attr(end($matches[2])) . '"';
                }
                $output .= "{$n}{$indent}<ul$class_names $labelledby role=\"menu\">{$n}";
            }

            /**
             * Starts the element output.
             *
             * @since WP 3.0.0
             * @since WP 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
             *
             * @see Walker_Nav_Menu::start_el()
             *
             * @param string   $output Used to append additional content (passed by reference).
             * @param WP_Post  $item   Menu item data object.
             * @param int      $depth  Depth of menu item. Used for padding.
             * @param stdClass $args   An object of wp_nav_menu() arguments.
             * @param int      $id     Current item ID.
             */
            public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
            {
                if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = ($depth) ? str_repeat($t, $depth) : '';

                $classes = empty($item->classes) ? array() : (array) $item->classes;

                /*
                 * Initialize some holder variables to store specially handled item
                 * wrappers and icons.
                 */
                $linkmod_classes = array();
                $icon_classes = array();

                /*
                 * Get an updated $classes array without linkmod or icon classes.
                 *
                 * NOTE: linkmod and icon class arrays are passed by reference and
                 * are maybe modified before being used later in this function.
                 */
                $classes = self::separate_linkmods_and_icons_from_classes($classes, $linkmod_classes, $icon_classes, $depth);

                // Join any icon classes plucked from $classes into a string.
                $icon_class_string = join(' ', $icon_classes);

                /**
                 * Filters the arguments for a single nav menu item.
                 *
                 *  WP 4.4.0
                 *
                 * @param stdClass $args  An object of wp_nav_menu() arguments.
                 * @param WP_Post  $item  Menu item data object.
                 * @param int      $depth Depth of menu item. Used for padding.
                 */
                $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

                // Add .dropdown or .active classes where they are needed.
                if (isset($args->has_children) && $args->has_children) {
                    $classes[] = 'dropdown';
                }
                if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
                    $classes[] = 'active';
                }

                // Add some additional default classes to the item.
                $classes[] = 'menu-item-' . $item->ID;
                $classes[] = 'nav-item';

                // Allow filtering the classes.
                $classes = apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth);

                // Form a string of classes in format: class="class_names".
                $class_names = join(' ', $classes);
                $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                /**
                 * Filters the ID applied to a menu item's list item element.
                 *
                 * @since WP 3.0.1
                 * @since WP 4.1.0 The `$depth` parameter was added.
                 *
                 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
                 * @param WP_Post  $item    The current menu item.
                 * @param stdClass $args    An object of wp_nav_menu() arguments.
                 * @param int      $depth   Depth of menu item. Used for padding.
                 */
                $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
                $id = $id ? ' id="' . esc_attr($id) . '"' : '';

                $output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';

                // Initialize array for holding the $atts for the link item.
                $atts = array();

                $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
                $atts['target'] = !empty($item->target) ? $item->target : '';
                $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
                // If the item has children, add atts to the <a>.
                if (isset($args->has_children) && $args->has_children && 0 === $depth && $args->depth > 1) {
                    $atts['href'] = '#';
                    $atts['data-href'] = $item->url;
                    $atts['data-toggle'] = 'dropdown';
                    $atts['aria-haspopup'] = 'true';
                    $atts['aria-expanded'] = 'false';
                    $atts['class'] = 'dropdown-toggle nav-link';
                    $atts['id'] = 'menu-item-dropdown-' . $item->ID;
                } else {
                    $atts['href'] = !empty($item->url) ? $item->url : '#';
                    // For items in dropdowns use .dropdown-item instead of .nav-link.
                    if ($depth > 0) {
                        $atts['class'] = 'dropdown-item';
                        $atts['role'] = 'menuitem';
                    } else {
                        $atts['class'] = 'nav-link';
                    }
                }

                $atts['aria-current'] = $item->current ? 'page' : '';

                // Update atts of this item based on any custom linkmod classes.
                $atts = self::update_atts_for_linkmod_type($atts, $linkmod_classes);
                // Allow filtering of the $atts array before using it.
                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

                // Build a string of html containing all the atts for the item.
                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                // Set a typeflag to easily test if this is a linkmod or not.
                $linkmod_type = self::get_linkmod_type($linkmod_classes);

                // START appending the internal item contents to the output.
                $item_output = isset($args->before) ? $args->before : '';

                /*
                 * This is the start of the internal nav item. Depending on what
                 * kind of linkmod we have we may need different wrapper elements.
                 */
                if ('' !== $linkmod_type) {
                    // Is linkmod, output the required element opener.
                    $item_output .= self::linkmod_element_open($linkmod_type, $attributes);
                } else {
                    // With no link mod type set this must be a standard <a> tag.
                    $item_output .= '<a' . $attributes . '>';
                }

                /*
                 * Initiate empty icon var, then if we have a string containing any
                 * icon classes form the icon markup with an <i> element. This is
                 * output inside of the item before the $title (the link text).
                 */
                $icon_html = '';
                if (!empty($icon_class_string)) {
                    // Append an <i> with the icon classes to what is output before links.
                    $icon_html = '<i class="' . esc_attr($icon_class_string) . '" aria-hidden="true"></i> ';
                }

                /** This filter is documented in wp-includes/post-template.php */
                $title = apply_filters('the_title', $item->title, $item->ID);

                /**
                 * Filters a menu item's title.
                 *
                 * @since WP 4.4.0
                 *
                 * @param string   $title The menu item's title.
                 * @param WP_Post  $item  The current menu item.
                 * @param stdClass $args  An object of wp_nav_menu() arguments.
                 * @param int      $depth Depth of menu item. Used for padding.
                 */
                $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

                // If the .sr-only class was set apply to the nav items text only.
                if (in_array('sr-only', $linkmod_classes, true)) {
                    $title = self::wrap_for_screen_reader($title);
                    $keys_to_unset = array_keys($linkmod_classes, 'sr-only', true);
                    foreach ($keys_to_unset as $k) {
                        unset($linkmod_classes[$k]);
                    }
                }

                // Put the item contents into $output.
                $item_output .= isset($args->link_before) ? $args->link_before . $icon_html . $title . $args->link_after : '';

                /*
                 * This is the end of the internal nav item. We need to close the
                 * correct element depending on the type of link or link mod.
                 */
                if ('' !== $linkmod_type) {
                    // Is linkmod, output the required closing element.
                    $item_output .= self::linkmod_element_close($linkmod_type);
                } else {
                    // With no link mod type set this must be a standard <a> tag.
                    $item_output .= '</a>';
                }

                $item_output .= isset($args->after) ? $args->after : '';

                // END appending the internal item contents to the output.
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }

            /**
             * Traverse elements to create list from elements.
             *
             * Display one element if the element doesn't have any children otherwise,
             * display the element and its children. Will only traverse up to the max
             * depth and no ignore elements under that depth. It is possible to set the
             * max depth to include all depths, see walk() method.
             *
             * This method should not be called directly, use the walk() method instead.
             *
             * @since WP 2.5.0
             *
             * @see Walker::start_lvl()
             *
             * @param object $element           Data object.
             * @param array  $children_elements List of elements to continue traversing (passed by reference).
             * @param int    $max_depth         Max depth to traverse.
             * @param int    $depth             Depth of current element.
             * @param array  $args              An array of arguments.
             * @param string $output            Used to append additional content (passed by reference).
             */
            public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
            {
                if (!$element) {
                    return;
                }
                $id_field = $this->db_fields['id'];
                // Display this element.
                if (is_object($args[0])) {
                    $args[0]->has_children = !empty($children_elements[$element->$id_field]);
                }
                parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
            }

            /**
             * Menu Fallback.
             *
             * If this function is assigned to the wp_nav_menu's fallback_cb variable
             * and a menu has not been assigned to the theme location in the WordPress
             * menu manager the function with display nothing to a non-logged in user,
             * and will add a link to the WordPress menu manager if logged in as an admin.
             *
             * @param array $args passed from the wp_nav_menu function.
             */
            public static function fallback($args)
            {
                if (current_user_can('edit_theme_options')) {

                    // Get Arguments.
                    $container = $args['container'];
                    $container_id = $args['container_id'];
                    $container_class = $args['container_class'];
                    $menu_class = $args['menu_class'];
                    $menu_id = $args['menu_id'];

                    // Initialize var to store fallback html.
                    $fallback_output = '';

                    if ($container) {
                        $fallback_output .= '<' . esc_attr($container);
                        if ($container_id) {
                            $fallback_output .= ' id="' . esc_attr($container_id) . '"';
                        }
                        if ($container_class) {
                            $fallback_output .= ' class="' . esc_attr($container_class) . '"';
                        }
                        $fallback_output .= '>';
                    }
                    $fallback_output .= '<ul';
                    if ($menu_id) {
                        $fallback_output .= ' id="' . esc_attr($menu_id) . '"';
                    }
                    if ($menu_class) {
                        $fallback_output .= ' class="' . esc_attr($menu_class) . '"';
                    }
                    $fallback_output .= '>';
                    $fallback_output .= '<li class="nav-item"><a href="' . esc_url(admin_url('nav-menus.php')) . '" class="nav-link" title="' . esc_attr__('Add a menu', 'wp-bootstrap-navwalker') . '">' . esc_html__('Add a menu', 'wp-bootstrap-navwalker') . '</a></li>';
                    $fallback_output .= '</ul>';
                    if ($container) {
                        $fallback_output .= '</' . esc_attr($container) . '>';
                    }

                    // If $args has 'echo' key and it's true echo, otherwise return.
                    if (array_key_exists('echo', $args) && $args['echo']) {
                        echo $fallback_output; // WPCS: XSS OK.
                    } else {
                        return $fallback_output;
                    }
                }
            }

            /**
             * Find any custom linkmod or icon classes and store in their holder
             * arrays then remove them from the main classes array.
             *
             * Supported linkmods: .disabled, .dropdown-header, .dropdown-divider, .sr-only
             * Supported iconsets: Font Awesome 4/5, Glypicons
             *
             * NOTE: This accepts the linkmod and icon arrays by reference.
             *
             * @since 4.0.0
             *
             * @param array   $classes         an array of classes currently assigned to the item.
             * @param array   $linkmod_classes an array to hold linkmod classes.
             * @param array   $icon_classes    an array to hold icon classes.
             * @param integer $depth           an integer holding current depth level.
             *
             * @return array  $classes         a maybe modified array of classnames.
             */
            private function separate_linkmods_and_icons_from_classes($classes, &$linkmod_classes, &$icon_classes, $depth)
            {
                // Loop through $classes array to find linkmod or icon classes.
                foreach ($classes as $key => $class) {
                    /*
                     * If any special classes are found, store the class in it's
                     * holder array and and unset the item from $classes.
                     */
                    if (preg_match('/^disabled|^sr-only/i', $class)) {
                        // Test for .disabled or .sr-only classes.
                        $linkmod_classes[] = $class;
                        unset($classes[$key]);
                    } elseif (preg_match('/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class) && $depth > 0) {
                        /*
                         * Test for .dropdown-header or .dropdown-divider and a
                         * depth greater than 0 - IE inside a dropdown.
                         */
                        $linkmod_classes[] = $class;
                        unset($classes[$key]);
                    } elseif (preg_match('/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class)) {
                        // Font Awesome.
                        $icon_classes[] = $class;
                        unset($classes[$key]);
                    } elseif (preg_match('/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class)) {
                        // Glyphicons.
                        $icon_classes[] = $class;
                        unset($classes[$key]);
                    }
                }

                return $classes;
            }

            /**
             * Return a string containing a linkmod type and update $atts array
             * accordingly depending on the decided.
             *
             * @since 4.0.0
             *
             * @param array $linkmod_classes array of any link modifier classes.
             *
             * @return string                empty for default, a linkmod type string otherwise.
             */
            private function get_linkmod_type($linkmod_classes = array())
            {
                $linkmod_type = '';
                // Loop through array of linkmod classes to handle their $atts.
                if (!empty($linkmod_classes)) {
                    foreach ($linkmod_classes as $link_class) {
                        if (!empty($link_class)) {

                            // Check for special class types and set a flag for them.
                            if ('dropdown-header' === $link_class) {
                                $linkmod_type = 'dropdown-header';
                            } elseif ('dropdown-divider' === $link_class) {
                                $linkmod_type = 'dropdown-divider';
                            } elseif ('dropdown-item-text' === $link_class) {
                                $linkmod_type = 'dropdown-item-text';
                            }
                        }
                    }
                }
                return $linkmod_type;
            }

            /**
             * Update the attributes of a nav item depending on the limkmod classes.
             *
             * @since 4.0.0
             *
             * @param array $atts            array of atts for the current link in nav item.
             * @param array $linkmod_classes an array of classes that modify link or nav item behaviors or displays.
             *
             * @return array                 maybe updated array of attributes for item.
             */
            private function update_atts_for_linkmod_type($atts = array(), $linkmod_classes = array())
            {
                if (!empty($linkmod_classes)) {
                    foreach ($linkmod_classes as $link_class) {
                        if (!empty($link_class)) {
                            /*
                             * Update $atts with a space and the extra classname
                             * so long as it's not a sr-only class.
                             */
                            if ('sr-only' !== $link_class) {
                                $atts['class'] .= ' ' . esc_attr($link_class);
                            }
                            // Check for special class types we need additional handling for.
                            if ('disabled' === $link_class) {
                                // Convert link to '#' and unset open targets.
                                $atts['href'] = '#';
                                unset($atts['target']);
                            } elseif ('dropdown-header' === $link_class || 'dropdown-divider' === $link_class || 'dropdown-item-text' === $link_class) {
                                // Store a type flag and unset href and target.
                                unset($atts['href']);
                                unset($atts['target']);
                            }
                        }
                    }
                }
                return $atts;
            }

            /**
             * Wraps the passed text in a screen reader only class.
             *
             * @since 4.0.0
             *
             * @param string $text the string of text to be wrapped in a screen reader class.
             * @return string      the string wrapped in a span with the class.
             */
            private function wrap_for_screen_reader($text = '')
            {
                if ($text) {
                    $text = '<span class="sr-only">' . $text . '</span>';
                }
                return $text;
            }

            /**
             * Returns the correct opening element and attributes for a linkmod.
             *
             * @since 4.0.0
             *
             * @param string $linkmod_type a sting containing a linkmod type flag.
             * @param string $attributes   a string of attributes to add to the element.
             *
             * @return string              a string with the openign tag for the element with attribibutes added.
             */
            private function linkmod_element_open($linkmod_type, $attributes = '')
            {
                $output = '';
                if ('dropdown-item-text' === $linkmod_type) {
                    $output .= '<span class="dropdown-item-text"' . $attributes . '>';
                } elseif ('dropdown-header' === $linkmod_type) {
                    /*
                     * For a header use a span with the .h6 class instead of a real
                     * header tag so that it doesn't confuse screen readers.
                     */
                    $output .= '<span class="dropdown-header h6"' . $attributes . '>';
                } elseif ('dropdown-divider' === $linkmod_type) {
                    // This is a divider.
                    $output .= '<ы class="dropdown-divider"' . $attributes . '>';
                }
                return $output;
            }

            /**
             * Return the correct closing tag for the linkmod element.
             *
             * @since 4.0.0
             *
             * @param string $linkmod_type a string containing a special linkmod type.
             *
             * @return string              a string with the closing tag for this linkmod type.
             */
            private function linkmod_element_close($linkmod_type)
            {
                $output = '';
                if ('dropdown-header' === $linkmod_type || 'dropdown-item-text' === $linkmod_type) {
                    /*
                     * For a header use a span with the .h6 class instead of a real
                     * header tag so that it doesn't confuse screen readers.
                     */
                    $output .= '</span>';
                } elseif ('dropdown-divider' === $linkmod_type) {
                    // This is a divider.
                    $output .= '</div>';
                }
                return $output;
            }
        }
    }
}

function vazha_customize_register($wp_customize)
{
    // Добавляем секцию для баннера
    $wp_customize->add_section('vazha_banner_section', array(
        'title' => __('Main Banner', 'vazha'),
        'priority' => 30,
    ));

    // Добавляем настройку для изображения баннера
    $wp_customize->add_setting('vazha_banner_image', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    // Добавляем поле для загрузки изображения
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vazha_banner_image_control', array(
        'label' => __('Banner Image', 'vazha'),
        'section' => 'vazha_banner_section',
        'settings' => 'vazha_banner_image',
    )));
}

add_action('customize_register', 'vazha_customize_register');


// // adding bg to header
// function add_scroll_script()
// {
//     wp_enqueue_script('navbar-scroll', get_template_directory_uri() . '/assets/js/navbar-scroll.js', [], null, true);
//     echo ("КЛАС добавлен");
// }
// add_action('wp_enqueue_scripts', 'add_scroll_script');

## отключаем создание миниатюр файлов для указанных размеров
add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');

function delete_intermediate_image_sizes($sizes)
{

    // размеры которые нужно удалить
    return array_diff($sizes, [
        'medium_large',
        'large',
        '1536x1536',
        '2048x2048',
    ]);
}

function vazha_new_theme_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Сайдбар блога', "vazha_new_theme"),
        'id' => 'sidebar-blog',
        'description' => __('This is the first footer widget area.', 'vazha'),
        'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
}
add_action("widgets_init", "vazha_new_theme_widgets_init");



/**
 * Добавление нового виджета Download_Widget.
 */
class Download_Widget extends WP_Widget
{

    // Регистрация виджета используя основной класс
    function __construct()
    {
        // вызов конструктора выглядит так:
        // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
        parent::__construct(
            'download_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_widget
            'Useful files',
            array('description' => 'Attach links to useful files', 'classname' => 'download', )
        );

        // скрипты/стили виджета, только если он активен
        if (is_active_widget(false, false, $this->id_base) || is_customize_preview()) {
            add_action('wp_enqueue_scripts', array($this, 'add_download_widget_scripts'));
            add_action('wp_head', array($this, 'add_download_widget_style'));
        }
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args     аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $file_name = $instance['file_name'];
        $file = $instance['file'];

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<a href="' . $file . '"><i class="fa fa-file-pdf"></i>' . $file_name . '</a>';
        echo $args['after_widget'];
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    function form($instance)
    {
        $title = @$instance['title'] ?: 'Useful files';
        $file_name = @$instance['file_name'] ?: 'Название файла';
        $file = @$instance['file'] ?: 'URL file';



        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('file_name'); ?>"><?php _e('Название файла:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('file_name'); ?>"
                name="<?php echo $this->get_field_name('file_name'); ?>" type="text"
                value="<?php echo esc_attr($file_name); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('file'); ?>"><?php _e('Ссылка на файл:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('file'); ?>"
                name="<?php echo $this->get_field_name('file'); ?>" type="text" value="<?php echo esc_attr($file); ?>">
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance новые настройки
     * @param array $old_instance предыдущие настройки
     *
     * @return array данные которые будут сохранены
     */
    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['file_name'] = (!empty($new_instance['file_name'])) ? strip_tags($new_instance['file_name']) : '';
        $instance['file'] = (!empty($new_instance['file'])) ? strip_tags($new_instance['file']) : '';

        return $instance;
    }

    // скрипт виджета
    function add_download_widget_scripts()
    {
        // фильтр чтобы можно было отключить скрипты
        if (!apply_filters('show_download_widget_script', true, $this->id_base))
            return;

        $theme_url = get_stylesheet_directory_uri();

        wp_enqueue_script('download_widget_script', $theme_url . '/assets/js/download_widget_script.js');
    }

    // стили виджета
    function add_download_widget_style()
    {
        // фильтр чтобы можно было отключить стили
        if (!apply_filters('show_download_widget_style', true, $this->id_base))
            return;
        ?>
        <style type="text/css">
            .download_widget a {
                display: inline;
            }
        </style>
        <?php
    }

}

function register_download_widget()
{
    register_widget('Download_Widget');
}
add_action('widgets_init', 'register_download_widget');