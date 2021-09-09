<?php
namespace App\Classes\Theme;

use App\Classes\Theme\Metronic;

class Init
{
    public static function run(): void
    {
        self::initPageLoader();
        self::initLayout();
        self::initHeader();
        self::initSubheader();
        self::initContent();
        self::initAside();
        self::initFooter();
    }

    private static function initLayout(): void
    {
        Metronic::addAttr('body', 'id', 'kt_body');
        Metronic::addAttr('html', 'dir', config('layout.self.rtl') ? 'rtl' : 'ltr');
        Metronic::addAttr('html', 'direction', config('layout.self.rtl') ? 'rtl' : 'ltr');
        Metronic::addAttr('html', 'style', "direction: " . (config('layout.self.rtl') ? 'rtl' : 'ltr'));

        // Offcanvas directions
        Metronic::addClass('body', 'quick-panel-right');
        Metronic::addClass('body', 'demo-panel-right');
        Metronic::addClass('body', 'offcanvas-right');
    }

    private static function initPageLoader(): void
    {
        if (!empty(config('layout.page-loader.type'))) {
            Metronic::addClass('body', 'page-loading-enabled');
            Metronic::addClass('body', 'page-loading');
        }
    }

    private static function initHeader(): void
    {
        if (config('layout.header.self.fixed.desktop')) {
            Metronic::addClass('body', 'header-fixed');
            Metronic::addClass('header', 'header-fixed');
        } else {
            Metronic::addClass('body', 'header-static');
        }

        if (config('layout.header.self.fixed.mobile')) {
            Metronic::addClass('body', 'header-mobile-fixed');
            Metronic::addClass('header-mobile', 'header-mobile-fixed');
        }

        // Menu
        if (config('layout.header.menu.self.display')) {
            Metronic::addClass('header_menu', 'header-menu-layout-' . config('layout.header.menu.self.layout'));

            if (config('layout.header.menu.self.root-arrow')) {
                Metronic::addClass('header_menu', 'header-menu-root-arrow');
            }
        }

        if (config('layout.header.self.width') === 'fluid') {
            Metronic::addClass('header-container', 'container-fluid');
        } else {
            Metronic::addClass('header-container', 'container');
        }
    }

    private static function initSubheader(): void
    {
        if (config('layout.subheader.display')) {
            Metronic::addClass('body', 'subheader-enabled');
        } else {
            return;
        }

        $subheader_style = config('layout.subheader.style');
        $subheader_fixed = config('layout.subheader.fixed');

        // Fixed content head
        if (config('layout.subheader.fixed') && config('layout.header.self.fixed.desktop')) {
            Metronic::addClass('body', 'subheader-fixed');
            $subheader_style = 'solid';
        } else {
            $subheader_fixed = false;
        }

        if ($subheader_style) {
            Metronic::addClass('subheader', 'subheader-'.$subheader_style);
        }

        if (config('layout.subheader.width') === 'fluid') {
            Metronic::addClass('subheader-container', 'container-fluid');
        } else {
            Metronic::addClass('subheader-container', 'container');
        }

        if (config('layout.subheader.clear')) {
            Metronic::addClass('subheader', 'subheader-clear');
        }
    }

    private static function initContent(): void
    {
        if (config('layout.content.fit-top')) {
            Metronic::addClass('content', 'pt-0');
        }

        if (config('layout.content.fit-bottom')) {
            Metronic::addClass('content', 'pt-0');
        }

        if (config('layout.content.width') == 'fluid') {
            Metronic::addClass('content-container', 'container-fluid');
        } else {
            Metronic::addClass('content-container', 'container');
        }
    }

    private static function initAside(): void
    {
        if ((bool)config('layout.aside.self.display') !== true) {
            return;
        }

        // Enable Aside
        Metronic::addClass('body', 'aside-enabled');

        // Fixed Aside
        if (config('layout.aside.self.fixed')) {
            Metronic::addClass('body', 'aside-fixed');
            Metronic::addClass('aside', 'aside-fixed');
        } else {
            Metronic::addClass('body', 'aside-static');
        }

        // Default fixed
        if (config('layout.aside.self.minimize.default')) {
            Metronic::addClass('body', 'aside-minimize');
        }

        // Menu
        // Dropdown Submenu
        if (config('layout.aside.menu.dropdown') == true) {
            Metronic::addClass('aside_menu', 'aside-menu-dropdown');
            Metronic::addAttr('aside_menu', 'data-menu-dropdown', '1');
        }

        // Scrollable Menu
        if (config('layout.aside.menu.dropdown') != true) {
            Metronic::addAttr('aside_menu', 'data-menu-scroll', "1");
        } else {
            Metronic::addAttr('aside_menu', 'data-menu-scroll', "0");
        }

        if (config('layout.aside.menu.submenu.dropdown.hover-timeout')) {
            Metronic::addAttr('aside_menu', 'data-menu-dropdown-timeout', config('layout.aside.menu.submenu.dropdown.hover-timeout'));
        }
    }

    private static function initFooter(): void
    {
        // Fixed header
        if (config('layout.footer.fixed') == true) {
            Metronic::addClass('body', 'footer-fixed');
        }

        if (config('layout.footer.width') == 'fluid') {
            Metronic::addClass('footer-container', 'container-fluid');
        } else {
            Metronic::addClass('footer-container', 'container');
        }
    }

}
