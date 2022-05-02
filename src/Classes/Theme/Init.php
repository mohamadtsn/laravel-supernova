<?php
namespace Mohamadtsn\Supernova\Classes\Theme;

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
        Supernova::addAttr('body', 'id', 'kt_body');

        Supernova::addAttr('html', 'dir', config('supernova.layout.self.rtl') ? 'rtl' : 'ltr');
        Supernova::addAttr('html', 'direction', config('supernova.layout.self.rtl') ? 'rtl' : 'ltr');
        Supernova::addAttr('html', 'style', 'direction: ' . (config('supernova.layout.self.rtl') ? 'rtl' : 'ltr'));

        // Offcanvas directions
        Supernova::addClass('body', 'quick-panel-right');
        Supernova::addClass('body', 'demo-panel-right');
        Supernova::addClass('body', 'offcanvas-right');
    }

    private static function initPageLoader(): void
    {
        if (!empty(config('supernova.layout.page-loader.type'))) {
            Supernova::addClass('body', 'page-loading-enabled');
            Supernova::addClass('body', 'page-loading');
        }
    }

    private static function initHeader(): void
    {
        if (config('supernova.layout.header.self.fixed.desktop')) {
            Supernova::addClass('body', 'header-fixed');
            Supernova::addClass('header', 'header-fixed');
        } else {
            Supernova::addClass('body', 'header-static');
        }

        if (config('supernova.layout.header.self.fixed.mobile')) {
            Supernova::addClass('body', 'header-mobile-fixed');
            Supernova::addClass('header-mobile', 'header-mobile-fixed');
        }

        // Menu
        if (config('supernova.layout.header.menu.self.display')) {
            Supernova::addClass('header_menu', 'header-menu-layout-' . config('supernova.layout.header.menu.self.layout'));

            if (config('supernova.layout.header.menu.self.root-arrow')) {
                Supernova::addClass('header_menu', 'header-menu-root-arrow');
            }
        }

        if (config('supernova.layout.header.self.width') === 'fluid') {
            Supernova::addClass('header-container', 'container-fluid');
        } else {
            Supernova::addClass('header-container', 'container');
        }
    }

    private static function initSubheader(): void
    {
        if (config('supernova.layout.subheader.display')) {
            Supernova::addClass('body', 'subheader-enabled');
        } else {
            return;
        }

        $subheader_style = config('supernova.layout.subheader.style');
        $subheader_fixed = config('supernova.layout.subheader.fixed');

        // Fixed content head
        if (config('supernova.layout.subheader.fixed') && config('supernova.layout.header.self.fixed.desktop')) {
            Supernova::addClass('body', 'subheader-fixed');
            $subheader_style = 'solid';
        } else {
            $subheader_fixed = false;
        }

        if ($subheader_style) {
            Supernova::addClass('subheader', 'subheader-' . $subheader_style);
        }

        if (config('supernova.layout.subheader.width') === 'fluid') {
            Supernova::addClass('subheader-container', 'container-fluid');
        } else {
            Supernova::addClass('subheader-container', 'container');
        }

        if (config('supernova.layout.subheader.clear')) {
            Supernova::addClass('subheader', 'subheader-clear');
        }
    }

    private static function initContent(): void
    {
        if (config('supernova.layout.content.fit-top')) {
            Supernova::addClass('content', 'pt-0');
        }

        if (config('supernova.layout.content.fit-bottom')) {
            Supernova::addClass('content', 'pt-0');
        }

        if (config('supernova.layout.content.width') == 'fluid') {
            Supernova::addClass('content-container', 'container-fluid');
        } else {
            Supernova::addClass('content-container', 'container');
        }
    }

    private static function initAside(): void
    {
        if ((bool)config('supernova.layout.aside.self.display') !== true) {
            return;
        }

        // Enable Aside
        Supernova::addClass('body', 'aside-enabled');

        // Fixed Aside
        if (config('supernova.layout.aside.self.fixed')) {
            Supernova::addClass('body', 'aside-fixed');
            Supernova::addClass('aside', 'aside-fixed');
        } else {
            Supernova::addClass('body', 'aside-static');
        }

        // Default fixed
        if (config('supernova.layout.aside.self.minimize.default')) {
            Supernova::addClass('body', 'aside-minimize');
        }

        // Menu
        // Dropdown Submenu
        if (config('supernova.layout.aside.menu.dropdown') == true) {
            Supernova::addClass('aside_menu', 'aside-menu-dropdown');
            Supernova::addAttr('aside_menu', 'data-menu-dropdown', '1');
        }

        // Scrollable Menu
        if (config('supernova.layout.aside.menu.dropdown') != true) {
            Supernova::addAttr('aside_menu', 'data-menu-scroll', '1');
        } else {
            Supernova::addAttr('aside_menu', 'data-menu-scroll', '0');
        }

        if (config('supernova.layout.aside.menu.submenu.dropdown.hover-timeout')) {
            Supernova::addAttr('aside_menu', 'data-menu-dropdown-timeout', config('supernova.layout.aside.menu.submenu.dropdown.hover-timeout'));
        }
    }

    private static function initFooter(): void
    {
        // Fixed header
        if (config('supernova.layout.footer.fixed') == true) {
            Supernova::addClass('body', 'footer-fixed');
        }

        if (config('supernova.layout.footer.width') == 'fluid') {
            Supernova::addClass('footer-container', 'container-fluid');
        } else {
            Supernova::addClass('footer-container', 'container');
        }
    }

}
