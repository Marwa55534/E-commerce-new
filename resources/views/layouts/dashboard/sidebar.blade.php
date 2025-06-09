<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        
        @can('categories')
        <li class=" nav-item"><a href="index.html"><i class="la la-list"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.categories') }}
          </span><span class="badge badge badge-info badge-pill float-right mr-2">{{ $categories_count}}</span></a>
          <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('categories.index')}}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.categories') }}</a>
            </li>
            <li><a class="menu-item" href="{{route('categories.create')}}" data-i18n="nav.dash.crypto">{{ __('dashboard.create_categories') }}</a>
            </li>
            
          </ul>
        </li>
        @endcan

        @can('barands')
        <li class=" nav-item"><a href="index.html"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.brands') }}
          </span><span class="badge badge badge-info badge-pill float-right mr-2">{{ $brands_count}}</span></a>
          <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('brands.index')}}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.brands') }}</a>
            </li>
            {{-- <li>
              <a class="menu-item" href="{{route('brands.create')}}" data-i18n="nav.dash.crypto">{{ __('dashboard.create_brand') }}</a>            
            </li> --}}

            
          </ul> 
        </li>
        @endcan

      @can('roles')
        <li class=" nav-item"><a href="#"><i class="la la-unlock-alt"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.roles') }}</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{route('roles.create')}}" data-i18n="nav.templates.vert.main">{{ __('dashboard.create_role') }}</a>
              {{-- <ul class="menu-content">
                <li><a class="menu-item" href="../vertical-menu-template" data-i18n="nav.templates.vert.classic_menu">Classic Menu</a>
                </li>
                <li><a class="menu-item" href="../vertical-modern-menu-template">Modern Menu</a>
                </li>
                <li><a class="menu-item" href="../vertical-compact-menu-template" data-i18n="nav.templates.vert.compact_menu">Compact Menu</a>
                </li>
                <li><a class="menu-item" href="../vertical-content-menu-template" data-i18n="nav.templates.vert.content_menu">Content Menu</a>
                </li>
                <li><a class="menu-item" href="../vertical-overlay-menu-template" data-i18n="nav.templates.vert.overlay_menu">Overlay Menu</a>
                </li>
              </ul> --}}
            </li>
            <li><a class="menu-item" href="{{route('roles.index')}}" data-i18n="nav.templates.horz.main">{{ __('dashboard.roles') }}</a>
              {{-- <ul class="menu-content">
                <li><a class="menu-item" href="../horizontal-menu-template" data-i18n="nav.templates.horz.classic">Classic</a>
                </li>
                <li><a class="menu-item" href="../horizontal-menu-template-nav" data-i18n="nav.templates.horz.top_icon">Full Width</a>
                </li>
              </ul> --}}
            </li>
          </ul>
        </li>
      @endcan

      @can('admins')
        <li class=" nav-item"><a href="#"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.Manage_Admin') }} </span>
          <span class="badge badge badge-info badge-pill float-right mr-2">{{ $admins_count}}</span></a>
            
          <ul class="menu-content">
              <li>
                  <a class="menu-item" href="{{route('admins.create')}}" data-i18n="">{{ __('dashboard.create_admin') }}</a>
              </li>
              <li>
                  <a class="menu-item" href="{{route('admins.index')}}" data-i18n="">{{ __('dashboard.admins') }}</a>
              </li>
            </ul>
          </li>
      @endcan

      @can('users')
      <li class=" nav-item"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.users') }}</span>
        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{{ $admins_count }}</span></a> --}}
          <ul class="menu-content">
              <li>
                  <a class="menu-item" href="{{ route('users.index') }}" data-i18n="">{{ __('dashboard.users') }}</a>
              </li>
          </ul>
      </li>
      @endcan

      @can('global_shipping')
        <li class=" nav-item"><a href="#"><i class="la la-ambulance"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.Shipping_management') }}</span></a>
            <ul class="menu-content">
              <li>
                  <a class="menu-item" href="{{route('dashboard.countries.index')}}" data-i18n=""> {{ __('dashboard.Shipping_management') }}</a>
              </li>
              <li>
                  <a class="menu-item" href="#" data-i18n="">{{ __('dashboard.creat_shipping_price') }}</a>
              </li>
            </ul>
          </li>
      @endcan

      @can('coupons')
        <li class=" nav-item"><a href="#"><i class="la la-500px"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.Manage_coupons') }} </span>
          <span class="badge badge badge-info badge-pill float-right mr-2">{{ $coupons_count}}</span></a>
            
          <ul class="menu-content">
              {{-- <li>
                  <a class="menu-item" href="{{route('coupons.create')}}" data-i18n="">{{ __('dashboard.create_coupon') }}</a>
              </li> --}}
              <li>
                  <a class="menu-item" href="{{route('coupons.index')}}" data-i18n="">{{ __('dashboard.coupons') }}</a>
              </li>
            </ul>
          </li>
      @endcan

       @can('orders')
        <li class=" nav-item"><a href="#"><i class="la la-cart-arrow-down"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.orders') }} </span>
          {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{{ $orders_count}}</span></a> --}}
            
          <ul class="menu-content">
              {{-- <li>
                  <a class="menu-item" href="{{route('coupons.create')}}" data-i18n="">{{ __('dashboard.create_coupon') }}</a>
              </li> --}}
              <li>
                  <a class="menu-item" href="{{route('dashboard.orders.index')}}" data-i18n="">{{ __('dashboard.orders') }}</a>
              </li>
            </ul>
          </li>
      @endcan

        <li class=" nav-item"><a href="#"><i class="la la-cart-arrow-down"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.product') }} </span>            
          <ul class="menu-content">
            @can('attributes') 
              <li>
                  <a class="menu-item" href="{{route('attributes.index')}}" data-i18n="">{{ __('dashboard.attributes') }}</a>
              </li>
            @endcan

            @can('products') 
            <li><a class="menu-item" href="{{ route('products.index') }}" data-i18n="nav.dash.crypto">{{ __('dashboard.products') }}</a>
            </li>
              <li>
                <a class="menu-item" href="{{route('products.create')}}" data-i18n="">{{ __('dashboard.create_product') }}</a>
              </li>
            @endcan

          </ul>
        </li>

        <li class=" navigation-header">
          <span data-i18n="nav.category.layouts">{{ __('dashboard.system') }}</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Layouts"></i>
        </li>

        @can('contacts')
        <li class=" nav-item"><a href="#"><i class="la la-phone"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.contacts') }} </span>
          <span class="badge badge badge-info badge-pill float-right mr-2">{{ $contacts_count}}</span></a>
            
          <ul class="menu-content">
              <li>
                  <a class="menu-item" href="{{route('dashboard.contacts.index')}}" data-i18n="">{{ __('dashboard.contacts') }}</a>
              </li>
            </ul> 
          </li>
      @endcan

      @can('faqs')
        <li class=" nav-item"><a href="#"><i class="la la-info"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.Manage_faqs') }} </span>
          <span class="badge badge badge-info badge-pill float-right mr-2">{{ $faqs_count}}</span></a>
            
          <ul class="menu-content">
              <li>
                  <a class="menu-item" href="{{route('dashboard.faqs-question.index')}}" data-i18n="">{{ __('dashboard.faqs_question') }}</a>
              </li>
              <li>
                  <a class="menu-item" href="{{route('faqs.index')}}" data-i18n="">{{ __('dashboard.faqs') }}</a>
              </li>
            </ul>
          </li>
      @endcan

        <li class=" nav-item"><a href="index.html"><i class="la la-gears"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.settings') }}</span></a>
            <ul class="menu-content">
           @can('settings')
              <li class="active"><a class="menu-item" href="{{ route('dashboard.settings.index') }}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.settings') }}</a>
              </li>
            @endcan
            @can('sliders')
              <li class="active"><a class="menu-item" href="{{ route('dashboard.sliders.index') }}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.sliders') }}</a>
              </li>
            @endcan
            </ul>
          </li>

          @can('pages')
          <li class=" nav-item"><a href="index.html"><i class="la la-folder-open-o"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.pages') }}</span></a>
            <ul class="menu-content">
              <li class="active"><a class="menu-item" href="{{ route('pages.index') }}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.pages') }}</a>
              </li>
              <li class="active"><a class="menu-item" href="{{ route('pages.create') }}" data-i18n="nav.dash.ecommerce">{{ __('dashboard.create_page') }}</a>
              </li>
            </ul>
          </li>
          @endcan


      </ul>
    </div>
</div>