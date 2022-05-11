<?php
return [
    'static_title_page' => 'پنل مدیریت',

    'management_url' => env('APP_MANAGEMENT_URL', 'http://management.example.test'),

    'default_guard' => 'admin',

    'recaptcha_login' => false,

    /*
     * `Aside menu` Panel Setting and menu items
     */
    'menu_aside' => [
        // menu items
        'items' => [
            // Dashboard
            [
                'title' => 'داشبورد',
                'icon' => 'panel/media/svg/icons/Design/Layers.svg',
                'page' => '/',
                'new-tab' => false
            ],

            // Custom
            [
                'section' => 'مدیریت سیستم',
            ],
            [
                'title' => 'مدیران',
                'icon' => 'panel/media/svg/icons/Communication/Group.svg',
                'bullet' => 'line',
                'page' => [
                    '/managers',
                    '/managers/create',
                    '/managers/{*}/permissions',
                ]
            ],
            [
                'title' => 'نقش ها',
                'icon' => 'panel/media/svg/icons/General/Visible.svg',
                'bullet' => 'dot',
                'page' => [
                    '/roles',
                    '/roles/{*}',
                    '/roles/create'
                ]
            ],



            /*[
                'title' => 'Applications',
                'icon' => 'panel/media/svg/icons/Layout/Layout-4-blocks.svg',
                'bullet' => 'line',
                'root' => true,
                'submenu' => [
                    [
                        'title' => 'Users',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'List - Default',
                                'page' => 'test',
                            ],
                            [
                                'title' => 'List - Datatable',
                                'page' => 'custom/apps/user/list-datatable'
                            ],
                            [
                                'title' => 'List - Columns 1',
                                'page' => 'custom/apps/user/list-columns-1'
                            ],
                            [
                                'title' => 'List - Columns 2',
                                'page' => 'custom/apps/user/list-columns-2'
                            ],
                            [
                                'title' => 'Add User',
                                'page' => 'custom/apps/user/add-user'
                            ],
                            [
                                'title' => 'Edit User',
                                'page' => 'custom/apps/user/edit-user'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Profile',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Profile 1',
                                'bullet' => 'line',
                                'submenu' => [
                                    [
                                        'title' => 'Overview',
                                        'page' => 'custom/apps/profile/profile-1/overview'
                                    ],
                                    [
                                        'title' => 'Personal Information',
                                        'page' => 'custom/apps/profile/profile-1/personal-information'
                                    ],
                                    [
                                        'title' => 'Account Information',
                                        'page' => 'custom/apps/profile/profile-1/account-information'
                                    ],
                                    [
                                        'title' => 'Change Password',
                                        'page' => 'custom/apps/profile/profile-1/change-password'
                                    ],
                                    [
                                        'title' => 'Email Settings',
                                        'page' => 'custom/apps/profile/profile-1/email-settings'
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Profile 2',
                                'page' => 'custom/apps/profile/profile-2'
                            ],
                            [
                                'title' => 'Profile 3',
                                'page' => 'custom/apps/profile/profile-3'
                            ],
                            [
                                'title' => 'Profile 4',
                                'page' => 'custom/apps/profile/profile-4'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Contacts',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'List - Columns',
                                'page' => 'custom/apps/contacts/list-columns'
                            ],
                            [
                                'title' => 'List - Datatable',
                                'page' => 'custom/apps/contacts/list-datatable'
                            ],
                            [
                                'title' => 'View Contact',
                                'page' => 'custom/apps/contacts/view-contact'
                            ],
                            [
                                'title' => 'Add Contact',
                                'page' => 'custom/apps/contacts/add-contact'
                            ],
                            [
                                'title' => 'Edit Contact',
                                'page' => 'custom/apps/contacts/edit-contact'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Projects',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'List - Columns 1',
                                'page' => 'custom/apps/projects/list-columns-1'
                            ],
                            [
                                'title' => 'List - Columns 2',
                                'page' => 'custom/apps/projects/list-columns-2'
                            ],
                            [
                                'title' => 'List - Columns 3',
                                'page' => 'custom/apps/projects/list-columns-3'
                            ],
                            [
                                'title' => 'List - Columns 4',
                                'page' => 'custom/apps/projects/list-columns-4'
                            ],
                            [
                                'title' => 'List - Datatable',
                                'page' => 'custom/apps/projects/list-datatable'
                            ],
                            [
                                'title' => 'View Project',
                                'page' => 'custom/apps/projects/view-project'
                            ],
                            [
                                'title' => 'Add Project',
                                'page' => 'custom/apps/projects/add-project'
                            ],
                            [
                                'title' => 'Edit Project',
                                'page' => 'custom/apps/projects/edit-project'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Support Center',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Home 1',
                                'page' => 'custom/apps/support-center/home-1'
                            ],
                            [
                                'title' => 'Home 2',
                                'page' => 'custom/apps/support-center/home-2'
                            ],
                            [
                                'title' => 'FAQ 1',
                                'page' => 'custom/apps/support-center/faq-1'
                            ],
                            [
                                'title' => 'FAQ 2',
                                'page' => 'custom/apps/support-center/faq-2'
                            ],
                            [
                                'title' => 'FAQ 3',
                                'page' => 'custom/apps/support-center/faq-3'
                            ],
                            [
                                'title' => 'Feedback',
                                'page' => 'custom/apps/support-center/feedback'
                            ],
                            [
                                'title' => 'License',
                                'page' => 'custom/apps/support-center/license'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Chat',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Private',
                                'page' => 'custom/apps/chat/private'
                            ],
                            [
                                'title' => 'Group',
                                'page' => 'custom/apps/chat/group'
                            ],
                            [
                                'title' => 'Popup',
                                'page' => 'custom/apps/chat/popup'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Todo',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Tasks',
                                'page' => 'custom/apps/todo/tasks'
                            ],
                            [
                                'title' => 'Docs',
                                'page' => 'custom/apps/todo/docs'
                            ],
                            [
                                'title' => 'Files',
                                'page' => 'custom/apps/todo/files'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Inbox',
                        'bullet' => 'dot',
                        'page' => 'custom/apps/inbox',
                        'label' => [
                            'type' => 'label-danger label-inline',
                            'value' => 'new'
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Pages',
                'icon' => 'panel/media/svg/icons/Shopping/Barcode-read.svg',
                'bullet' => 'dot',
                'root' => true,
                'submenu' => [
                    [
                        'title' => 'Wizard',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Wizard 1',
                                'page' => 'custom/pages/wizard/wizard-1'
                            ],
                            [
                                'title' => 'Wizard 2',
                                'page' => 'custom/pages/wizard/wizard-2'
                            ],
                            [
                                'title' => 'Wizard 3',
                                'page' => 'custom/pages/wizard/wizard-3'
                            ],
                            [
                                'title' => 'Wizard 4',
                                'page' => 'custom/pages/wizard/wizard-4'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Pricing Tables',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Pricing Tables 1',
                                'page' => 'custom/pages/pricing/pricing-1'
                            ],
                            [
                                'title' => 'Pricing Tables 2',
                                'page' => 'custom/pages/pricing/pricing-2'
                            ],
                            [
                                'title' => 'Pricing Tables 3',
                                'page' => 'custom/pages/pricing/pricing-3'
                            ],
                            [
                                'title' => 'Pricing Tables 4',
                                'page' => 'custom/pages/pricing/pricing-4'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Invoices',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Invoice 1',
                                'page' => 'custom/pages/invoices/invoice-1'
                            ],
                            [
                                'title' => 'Invoice 2',
                                'page' => 'custom/pages/invoices/invoice-2'
                            ]
                        ]
                    ],
                    [
                        'title' => 'User Pages',
                        'bullet' => 'dot',
                        'label' => [
                            'type' => 'label-rounded label-primary',
                            'value' => '2'
                        ],
                        'submenu' => [
                            [
                                'title' => 'Login 1',
                                'page' => 'custom/pages/users/login-1',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 2',
                                'page' => 'custom/pages/users/login-2',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 3',
                                'page' => 'custom/pages/users/login-3',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 4',
                                'page' => 'custom/pages/users/login-4',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 5',
                                'page' => 'custom/pages/users/login-5',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Login 6',
                                'page' => 'custom/pages/users/login-6',
                                'new-tab' => true
                            ]
                        ]
                    ],
                    [
                        'title' => 'Error Pages',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Error 1',
                                'page' => 'custom/pages/errors/error-1',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 2',
                                'page' => 'custom/pages/errors/error-2',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 3',
                                'page' => 'custom/pages/errors/error-3',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 4',
                                'page' => 'custom/pages/errors/error-4',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 5',
                                'page' => 'custom/pages/errors/error-5',
                                'new-tab' => true
                            ],
                            [
                                'title' => 'Error 6',
                                'page' => 'custom/pages/errors/error-6',
                                'new-tab' => true
                            ]
                        ]
                    ]
                ]
            ],*/

        ],
    ],

    /*
     * `Header menu` Panel Setting and menu items
     */
    'menu_header' => [
        // menu items
        'items' => [
            [],
            [
                'title' => 'داشبورد',
                'root' => true,
                'page' => '/',
                'new-tab' => false,
            ],
            [
                'title' => 'مدیران',
                'root' => true,
                'page' => '/managers',
                'new-tab' => false,
            ]
        ]
    ],

    /*
     * Layout Template Panel Setting
     */
    'layout' => [

        // Self
        'self' => [
            'layout' => 'default', // blank, default
            'rtl' => true, // true, false
        ],

        // Base Layout
        'js' => [
            'breakpoints' => [
                'sm' => 576,
                'md' => 768,
                'lg' => 992,
                'xl' => 1200,
                'xxl' => 1200
            ],
            'colors' => [
                'theme' => [
                    'base' => [
                        'white' => '#ffffff',
                        'primary' => '#6993FF',
                        'secondary' => '#E5EAEE',
                        'success' => '#1BC5BD',
                        'info' => '#8950FC',
                        'warning' => '#FFA800',
                        'danger' => '#F64E60',
                        'light' => '#F3F6F9',
                        'dark' => '#212121'
                    ],
                    'light' => [
                        'white' => '#ffffff',
                        'primary' => '#E1E9FF',
                        'secondary' => '#ECF0F3',
                        'success' => '#C9F7F5',
                        'info' => '#EEE5FF',
                        'warning' => '#FFF4DE',
                        'danger' => '#FFE2E5',
                        'light' => '#F3F6F9',
                        'dark' => '#D6D6E0'
                    ],
                    'inverse' => [
                        'white' => '#ffffff',
                        'primary' => '#ffffff',
                        'secondary' => '#212121',
                        'success' => '#ffffff',
                        'info' => '#ffffff',
                        'warning' => '#ffffff',
                        'danger' => '#ffffff',
                        'light' => '#464E5F',
                        'dark' => '#ffffff'
                    ]
                ],
                'gray' => [
                    'gray-100' => '#F3F6F9',
                    'gray-200' => '#ECF0F3',
                    'gray-300' => '#E5EAEE',
                    'gray-400' => '#D6D6E0',
                    'gray-500' => '#B5B5C3',
                    'gray-600' => '#80808F',
                    'gray-700' => '#464E5F',
                    'gray-800' => '#1B283F',
                    'gray-900' => '#212121'
                ]
            ],
            'font-family' => 'IRANSans'
        ],

        // Page loader
        'page-loader' => [
            'type' => 'spinner-logo' // default, spinner-message, spinner-logo
        ],

        // Header
        'header' => [
            'self' => [
                'display' => false,
                'width' => 'fluid', // fixed, fluid
                'theme' => 'dark', // light, dark
                'fixed' => [
                    'desktop' => true,
                    'mobile' => true
                ]
            ],

            'menu' => [
                'self' => [
                    'display' => false,
                    'layout'  => 'default', // tab, default
                    'root-arrow' => false, // true, false
                ],

                'desktop' => [
                    'arrow' => true,
                    'toggle' => 'click',
                    'submenu' => [
                        'theme' => 'dark',
                        'arrow' => true,
                    ]
                ],

                'mobile' => [
                    'submenu' => [
                        'theme' => 'dark',
                        'accordion' => true
                    ],
                ],
            ]
        ],

        // Subheader
        'subheader' => [
            'display' => true,
            'displayDesc' => true,
            'layout' => 'subheader-v1',
            'fixed' => true,
            'width' => 'fluid', // fixed, fluid
            'clear' => false,
            'layouts' => [
                'subheader-v1' => 'Subheader v1',
                'subheader-v2' => 'Subheader v2',
                'subheader-v3' => 'Subheader v3',
                'subheader-v4' => 'Subheader v4',
            ],
            'style' => 'solid' // transparent, solid. can be transparent only if 'fixed' => false
        ],

        // Content
        'content' => [
            'width' => 'fixed', // fluid, fixed
            'extended' => false, // true, false
        ],

        // Brand
        'brand' => [
            'self' => [
                'theme' => 'dark' // light, dark
            ]
        ],

        // Aside
        'aside' => [
            'self' => [
                'theme' => 'dark', // light, dark
                'display' => true,
                'fixed' => true,
                'minimize' => [
                    'toggle' => true, // allow toggle
                    'default' => false // default state
                ]
            ],

            'menu' => [
                'dropdown' => false, // ok
                'scroll' => false, // ok
                'submenu' => [
                    'accordion' => true, // true, false
                    'dropdown' => [
                        'arrow' => true,
                        'hover-timeout' => 500 // in milliseconds
                    ]
                ]
            ]
        ],

        // Footer
        'footer' => [
            'width' => 'fluid', // fluid, fixed
            'fixed' => true
        ],

        // Extras
        'extras' => [

            // Search
            'search' => [
                'display' => true,
                'layout' => 'dropdown', // offcanvas, dropdown
                'offcanvas' => [
                    'direction' => 'right'
                ],
            ],

            // Notifications
            'notifications' => [
                'display' => true,
                'layout' => 'dropdown', // offcanvas, dropdown
                'dropdown' => [
                    'style' => 'dark' // light|dark
                ],
                'offcanvas' => [
                    'direction' => 'right'
                ]
            ],

            // Quick Actions
            'quick-actions' => [
                'display' => false,
                'layout' => 'dropdown', // offcanvas, dropdown
                'dropdown' => [
                    'style' => 'dark' // light|dark
                ],
                'offcanvas' => [
                    'direction' => 'right'
                ]
            ],

            // User
            'user' => [
                'display' => true,
                'layout' => 'dropdown', // offcanvas, dropdown
                'dropdown' => [
                    'style' => 'dark' // light|dark
                ],
                'offcanvas' => [
                    'direction' => 'right'
                ]
            ],

            // Languages
            'languages' => [
                'display' => false
            ],

            // Cart
            'cart' => [
                'display' => false,
                'dropdown' => [
                    'style' => 'dark' // light|dark
                ]
            ],

            // Quick Panel
            'quick-panel' => [
                'display' => false,
                'offcanvas' => [
                    'direction' => 'right'
                ]
            ],

            // Chat
            'chat' => [
                'display' => false,
            ],

            // Page Toolbar
            'toolbar' => [
                'display' => false
            ],

            // Scrolltop
            'scrolltop' => [
                'display' => true
            ]
        ],


        'resources' => [
            'favicon' => 'media/img/logo/favicon.ico',
            'fonts' => [
                'google' => [
                    'families' => [
                        'Poppins:300,400,500,600,700'
                    ]
                ]
            ],
            'css' => [
                'panel/plugins/global/plugins.bundle.css',
                'panel/plugins/custom/prismjs/prismjs.bundle.css',
                'panel/css/style.bundle.css',
                'panel/plugins/custom/datatables/datatables.bundle.css',
            ],
            'js' => [
                'panel/plugins/global/plugins.bundle.js',
                'panel/plugins/custom/prismjs/prismjs.bundle.js',
                'panel/js/app.js',
                'panel/plugins/custom/datatables/datatables.bundle.js',
                'panel/js/config.datatable.js',
            ],
        ],

    ],

    'cache' => [
        // default => 'true' is production mode and 'false' in development mode
        // recommended => 'automatic'
        'enable' => 'automatic', // 'automatic' or 'bool'

        'key' => 'supernova.menu',

        'expiration_time' => now()->addMonth(),

        'store' => 'default',
    ]
];
