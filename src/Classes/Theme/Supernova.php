<?php

namespace Mohamadtsn\Supernova\Classes\Theme;

class Supernova
{
    public static array $attrs;
    public static array $classes;

    public static function addAttr($scope, $name, $value): void
    {
        self::$attrs[$scope][$name] = $value;
    }

    public static function addClass($scope, $class): void
    {
        self::$classes[$scope][] = $class;
    }

    public static function printAttrs($scope): void
    {
        $attrs = [];

        if (!empty(self::$attrs[$scope])) {
            foreach (self::$attrs[$scope] as $name => $value) {
                $attrs[] = $name . '="' . $value . '"';
            }
            echo ' ' . implode(' ', $attrs) . ' ';
        }
        echo '';
    }

    public static function printClasses($scope, $full = true): void
    {
        if ($scope === 'body') {
            self::$classes[$scope][] = 'page-loading';
        }

        if (!empty(self::$classes[$scope])) {
            $classes = implode(' ', self::$classes[$scope]);
            if ($full) {
                echo ' class="' . $classes . '" ';
            } else {
                echo ' ' . $classes . ' ';
            }
        } else {
            echo '';
        }
    }

    /**
     * Prints Google Fonts
     */
    public static function getGoogleFontsInclude(): void
    {
        if (config('supernova.layout.resources.fonts.google.families')) {
            $fonts = config('supernova.layout.resources.fonts.google.families');
            echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' . implode('|', $fonts) . '">';
        }
        echo '';
    }

    /**
     * Walk recursive array with callback
     */
    public static function arrayWalkCallback(array &$array, callable $callback): array
    {
        foreach ($array as $k => &$v) {
            if (is_array($v)) {
                $callback($k, $v, $array);
                self::arrayWalkCallback($v, $callback);
            }
        }

        return $array;
    }

    /**
     * Convert css file path to RTL file
     * @param $css_path
     * @return array|string|string[]
     */
    public static function rtlCssPath($css_path)
    {
        return substr_replace($css_path, '.rtl.css', -4);
    }

    /**
     * Initialize theme CSS files
     */
    public static function initThemes(): array
    {
        $themes = [];

        $themes[] = 'panel/css/themes/layout/header/base/' . config('supernova.layout.header.self.theme') . '.css';
        $themes[] = 'panel/css/themes/layout/header/menu/' . config('supernova.layout.header.menu.desktop.submenu.theme') . '.css';
        $themes[] = 'panel/css/themes/layout/aside/' . config('supernova.layout.aside.self.theme') . '.css';

        if (config('supernova.layout.aside.self.display')) {
            $themes[] = 'panel/css/themes/layout/brand/' . config('supernova.layout.brand.self.theme') . '.css';
        } else {
            $themes[] = 'panel/css/themes/layout/brand/' . config('supernova.layout.header.self.theme') . '.css';
        }

        return $themes;
    }

    /**
     * Get SVG content
     * @param string $filepath
     * @param string $class
     * @return string|void
     */
    public static function getSVG(string $filepath, string $class = '')
    {
        if (!file_exists($filepath)) {
            return '';
        }

        $svg_content = file_get_contents($filepath);

        $dom = new \DOMDocument();
        $dom->loadXML($svg_content);

        // remove unwanted comments
        $xpath = new \DOMXPath($dom);
        foreach ($xpath->query('//comment()') as $comment) {
            $comment->parentNode->removeChild($comment);
        }

        // remove unwanted tags
        $title = $dom->getElementsByTagName('title');
        if ($title['length']) {
            $dom->documentElement->removeChild($title[0]);
        }
        $desc = $dom->getElementsByTagName('desc');
        if ($desc['length']) {
            $dom->documentElement->removeChild($desc[0]);
        }
        $defs = $dom->getElementsByTagName('defs');
        if ($defs['length']) {
            $dom->documentElement->removeChild($defs[0]);
        }

        // remove unwanted id attribute in g tag
        $g = $dom->getElementsByTagName('g');
        foreach ($g as $el) {
            $el->removeAttribute('id');
        }
        $mask = $dom->getElementsByTagName('mask');
        foreach ($mask as $el) {
            $el->removeAttribute('id');
        }
        $rect = $dom->getElementsByTagName('rect');
        foreach ($rect as $el) {
            $el->removeAttribute('id');
        }
        $path = $dom->getElementsByTagName('path');
        foreach ($path as $el) {
            $el->removeAttribute('id');
        }
        $circle = $dom->getElementsByTagName('circle');
        foreach ($circle as $el) {
            $el->removeAttribute('id');
        }
        $use = $dom->getElementsByTagName('use');
        foreach ($use as $el) {
            $el->removeAttribute('id');
        }
        $polygon = $dom->getElementsByTagName('polygon');
        foreach ($polygon as $el) {
            $el->removeAttribute('id');
        }
        $ellipse = $dom->getElementsByTagName('ellipse');
        foreach ($ellipse as $el) {
            $el->removeAttribute('id');
        }

        $string = $dom->saveXML($dom->documentElement);

        // remove empty lines
        $string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

        $cls = ['svg-icon'];
        if (!empty($class)) {
            $cls = array_merge($cls, explode(' ', $class));
        }

        echo '<span class="' . implode(' ', $cls) . '"><!--begin::Svg Icon | path:' . $filepath . '-->' . $string . '<!--end::Svg Icon--></span>';;
    }

    /**
     * Check if $path provided is SVG
     */
    public static function isSVG($path): bool
    {
        if (is_string($path)) {
            return substr(strrchr($path, '.'), 1) === 'svg';
        }

        return false;
    }

}
