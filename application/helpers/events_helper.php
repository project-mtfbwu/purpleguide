<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base URL for admin-uploaded images (events, facilitators). Same host as frontend.
 */
// if (!function_exists('_events_admin_image_base')) {
//     function _events_admin_image_base() {
//         $ci = &get_instance();
//         $base = rtrim($ci->config->base_url(), '/');
//         return $base . '/admin/assets/images/';
//     }
// }


if (!function_exists('_events_admin_image_base')) {
    function _events_admin_image_base() {
        $ci = &get_instance();
        $prefix = trim((string) ($ci->config->item('admin_assets_images_base_url') ?? ''));
        if ($prefix !== '') {
            return rtrim($prefix, '/') . '/';
        }
        $base = rtrim((string) $ci->config->item('admin_base_url'), '/');
        return $base . '/assets/images/';
    }
}

/**
 * Event image URL (from event_tbl image1/image2, admin uploads). Dynamic on whole site.
 */
if (!function_exists('event_image_url')) {
    function event_image_url($image1, $placeholder = '', $image2 = null) {
        $ci = &get_instance();
        $base = rtrim($ci->config->base_url(), '/');
        $default_placeholder = $base . '/assets/img/tab-img.jpg';
        $fallback = $placeholder !== '' ? $placeholder : $default_placeholder;
        $try = [$image1, $image2];
        foreach ($try as $img) {
            if (empty($img) || !is_string($img)) continue;
            $img = trim($img);
            $img = ltrim($img, '/');
            // Allow website-side preview uploads (unsaved draft) to render directly.
            if (strpos($img, 'assets/tmp/') === 0) {
                return $base . '/' . $img;
            }
            $img = preg_replace('#^(assets/images/|images/|admin/assets/images/)#', '', $img);
            $img = basename($img);
            if ($img !== '') {
                return _events_admin_image_base() . $img;
            }
        }
        return $fallback;
    }
}

/**
 * Facilitator/author image URL (from event_facilitators.image, admin uploads). Dynamic on whole site.
 */
if (!function_exists('facilitator_image_url')) {
    function facilitator_image_url($image, $placeholder = '') {
        $ci = &get_instance();
        $base = rtrim($ci->config->base_url(), '/');
        $default_placeholder = $base . '/assets/img/founder.png';
        $fallback = $placeholder !== '' ? $placeholder : $default_placeholder;
        if (empty($image) || !is_string($image)) return $fallback;
        $image = trim($image);
        $image = ltrim($image, '/');
        // Allow website-side preview uploads (unsaved draft) to render directly.
        if (strpos($image, 'assets/tmp/') === 0) {
            return $base . '/' . $image;
        }
        $image = preg_replace('#^(assets/images/|images/|admin/assets/images/)#', '', $image);
        $image = basename($image);
        if ($image === '') return $fallback;
        return _events_admin_image_base() . $image;
    }
}

/**
 * Format event date for display (day, month, time).
 */
if (!function_exists('format_event_date')) {
    function format_event_date($datetime) {
        if (empty($datetime)) return ['day' => '', 'month' => '', 'time' => ''];
        $ts = strtotime($datetime);
        if ($ts === false) return ['day' => '', 'month' => '', 'time' => ''];
        return [
            'day'   => date('d', $ts),
            'month' => date('M y', $ts),
            'time'  => date('g:i a', $ts)
        ];
    }
}
