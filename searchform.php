<?php
/**
 * Display Search Form 
 *
 * @package wp-indigo
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label class="search-label">
        <span class="screen-reader-text"><?php echo esc_html_e( 'Search for:', 'wp-indigo' ) ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search…', 'wp-indigo' ) ?>" value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr__( 'Search for:', 'wp-indigo' ) ?>" />
    </label>

    <button aria-label="<?php esc_attr_e('Search', 'wp-indigo'); ?>" type="submit" class="c-search-form__submit search-submit c-btn--sm">
    </button>
</form>