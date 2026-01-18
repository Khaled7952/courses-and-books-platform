<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can('admins')
                <li class=" nav-item"><a href="{{ route('dashboard.roles.index') }}">
                        <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">الصلاحيات</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.roles.index') }}"
                                data-i18n="nav.dash.ecommerce">الصلاحيات</a>
                        </li>
                        <li><a class="menu-item" href="{{ route('dashboard.managers.index') }}"
                                data-i18n="nav.dash.crypto">المسؤلين</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('settings')
                <li class=" nav-item"><a href="{{ route('dashboard.settings') }}"><i class="la la-television"></i><span
                            class="menu-title" data-i18n="nav.templates.main">الإعدادات</span></a>
                </li>
            @endcan

            @can('book')
                <li class=" nav-item"><a href="{{ route('dashboard.book.index') }}"><i class="la la-book"></i><span
                            class="menu-title" data-i18n="nav.templates.main">إدارة الكتاب </span></a>
                </li>
            @endcan

            @can('courses')
                <li class="nav-item">
                    <a href="{{ route('dashboard.courses.index') }}">
                        <i class="la la-graduation-cap"></i>
                        <span class="menu-title">إدارة الدورات</span>
                    </a>
                </li>
            @endcan

            @can('orders')
                <li class="nav-item">
                    <a href="{{ route('dashboard.orders.index') }}">
                        <i class="la la-shopping-cart"></i>
                        <span class="menu-title">إدارة الطلبات</span>
                    </a>
                </li>
            @endcan


            @can('blog')
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-file-text"></i>
                        <span class="menu-title" data-i18n="nav.blog.main">
                            {{ __('dashboard.blog') }}
                        </span>
                    </a>

                    <ul class="menu-content">

                        {{-- الأقسام --}}
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.category.index') }}"
                                data-i18n="nav.blog.categories">
                                {{ __('dashboard.categories') }}
                            </a>
                        </li>

                        {{-- Tags --}}
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.tag.index') }}" data-i18n="nav.blog.tags">
                                {{ __('dashboard.tags') }}
                            </a>
                        </li>

                        {{-- المقالات --}}
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.blog.index') }}" data-i18n="nav.blog.posts">
                                {{ __('dashboard.blog_posts') }}
                            </a>
                        </li>



                    </ul>
                </li>
            @endcan


            @can('manage_customers')
                <li class="nav-item"><a href="{{ route('dashboard.messages.index') }}"><i class="la la-envelope"></i><span
                            class="menu-title"
                            data-i18n="nav.form_wizard.main">{{ __('dashboard.customer_orders') }}</span></a>
                </li>
            @endcan

            @can('seo')
                <li class=" nav-item"><a href="">
                        <i class="la la-bar-chart"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.seo') }}</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.seo.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.seo') }}</a>
                        </li>
                        <li><a class="menu-item" href="{{ route('dashboard.code-snippet') }}"
                                data-i18n="nav.dash.crypto">{{ __('dashboard.snippet_code') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan

        </ul>
    </div>
</div>
