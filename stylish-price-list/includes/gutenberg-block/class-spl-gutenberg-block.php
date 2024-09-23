<?php

namespace DF_SCC\StylishPriceList\Includes;

class Gutenberg_Block {

    /**
     * Indicate if current integration is allowed to load.
     *
     * @since 1.4.8
     *
     * @return bool
     */
    public function allow_load() {
        return function_exists( 'register_block_type' );
    }

    /**
     * Load an integration.
     */
    public function load() {
        $this->hooks();
    }

    /**
     * Integration hooks.
     *
     * @since 1.4.8
     */
    protected function hooks() {
        add_action( 'init', [ $this, 'register_block' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
    }

    /**
     * Register the block.
     *
     * @since 1.4.8
     */
    public function register_block() {
        // Register the block.
        register_block_type(
            'stylish-price-list/list-picker',
            [
                'attributes'      => [
                    'listId' => [
                        'type' => 'number',
                    ],
                ],
                'render_callback' => [ $this, 'render_block' ],
            ]
        );
    }

    public function render_block( $attr ) {
        $list_id = $attr['listId'];

        return do_shortcode( "[pricelist id=$list_id]" );
    }

    public function enqueue_block_editor_assets() {
        wp_enqueue_script(
            'stylish-price-list-gutenberg-block',
            SPL_ASSETS_URL . '/js/gutenberg-block.es5.js',
            [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
            STYLISH_PRICE_LIST_BETA ? filemtime( SPL_ASSETS_DIR . '/js/gutenberg-block.es5.js' ) : STYLISH_PRICE_LIST_VERSION,
            true
        );
        wp_enqueue_style(
            'stylish-price-list-gutenberg-block',
            SPL_ASSETS_URL . '/css/gutenberg-block.css',
            [ 'wp-edit-blocks' ],
            STYLISH_PRICE_LIST_BETA ? filemtime( SPL_ASSETS_DIR . '/css/gutenberg-block.css' ) : STYLISH_PRICE_LIST_VERSION
        );
        wp_localize_script(
            'stylish-price-list-gutenberg-block',
            'stylish_price_list_data',
            $this->get_lists_data()
        );
    }
    private function get_lists_data() {
        $price_lists_raw = df_spl_get_all_tabs(array('offset' => 0, 'number' => 10000));
        $price_lists = array();
        foreach ($price_lists_raw as $list) {
            $price_lists[] = array(
                'value' => $list->id,
                'label' => $list->list_name,
            );
        }


        return [
            'lists' => $price_lists,
            'logo' => SPL_URL . '/assets/images/SPL-Logo-gutenberg.png'
        ];
    }
}
