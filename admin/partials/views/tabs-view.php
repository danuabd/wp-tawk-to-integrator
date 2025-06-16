<?php

/**
 * The view for the "Tabs" section on admin settings page.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/admin/views/partials
 */
if (! defined('WPINC')) {
    die;
}

$options = get_option('wp-tawk-to-integrator_options');
$active_tab = $options['active-tab'] || null;
?>

<div class="flex space-x-1 border-b border-gray-200">
    <button
        data-relation="integration-section"
        id="integration-btn"
        type="button"
        class="<?php if (!isset($options['active-tab']) || ($active_tab && str_contains($active_tab, 'Integration'))) {
                    echo 'tab-active';
                } else {
                    echo 'tab-inactive';
                }
                ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
        Integration
    </button>
    <button
        data-relation="appearance-section"
        id="appearance-btn"
        type="button"
        class="<?php ($active_tab && str_contains($active_tab, 'Appearance')) ? 'tab-active' : 'tab-inactive' ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
        Appearance
    </button>
    <button
        data-relation="behavior-section"
        id="behavior-btn"
        type="button"
        class="<?php ($active_tab && str_contains($active_tab, 'Behavior')) ? 'tab-active' : 'tab-inactive' ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
        Behavior
    </button>
    <button
        data-relation="events-section"
        id="events-btn"
        type="button"
        class="<?php ($active_tab && str_contains($active_tab, 'Events')) ? 'tab-active' : 'tab-inactive' ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
        Events
    </button>
    <button
        data-relation="pro-section"
        id="pro-btn"
        type="button"
        class="tab-inactive tab-btn relative rounded-t-md px-6 py-3 text-sm font-medium">
        Pro
        <span
            class="material-icons-outlined text-mint-2 absolute top-1 right-1 text-sm"
            style="font-size: 16px">diamond</span>
    </button>
</div>