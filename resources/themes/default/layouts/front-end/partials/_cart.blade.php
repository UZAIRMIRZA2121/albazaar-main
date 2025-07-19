           <div class="header-mobile-cart-wrap base-header-cart relative">
               <span class="header-cart-empty-check header-cart-is-empty-true"></span>
               <div class="relative">
                   @if ($web_config['guest_checkout_status'] || auth('customer')->check())
                       <a href="{{ route('shop-cart') }}" aria-label="Shopping Cart"
                           class="drawer-toggle header-cart-button relative block"
                           data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="false"
                           data-set-focus=".cart-toggle-close">

                           <!-- SVG Cart Icon -->
                           <span class="base-svg-iconsets">
                               <svg class="thebase-svg-icon thebase-shopping-cart-svg w-6 h-6 text-black"
                                   xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 762.47 673.5">
                                   <path
                                       d="M600.86,489.86a91.82,91.82,0,1,0,91.82,91.82A91.81,91.81,0,0,0,600.86,489.86Zm0,142.93a51.12,51.12,0,1,1,51.11-51.11A51.12,51.12,0,0,1,600.82,632.79Z">
                                   </path>
                                   <path
                                       d="M458.62,561.33H393.3a91.82,91.82,0,1,0-.05,40.92h65.37a20.46,20.46,0,0,0,0-40.92ZM303.7,632.79a51.12,51.12,0,1,1,51.12-51.11A51.11,51.11,0,0,1,303.7,632.79Z">
                                   </path>
                                   <path
                                       d="M762.47,129.41a17.26,17.26,0,0,0-17.26-17.26H260.87a17.18,17.18,0,0,0-13.26,6.23,20.47,20.47,0,0,0-7.22,19.22l31.16,208a20.46,20.46,0,0,0,40.34-6.86L284.18,153.79H718.89l-37,256.4H221.59L166.75,15.06A17.26,17.26,0,0,0,147.42.14L123.7.12l0,.13H20.26a20.26,20.26,0,0,0,0,40.52H129.34l52.32,376.91,1,8.87c.1.85.15,1.71.19,2.57a23,23,0,0,0,1.35,6.76l.05.39a17.25,17.25,0,0,0,19.33,14.89l23.74.25,0-.27H698.19a24.33,24.33,0,0,0,3.44-.25,17.25,17.25,0,0,0,18.43-14.66l.18-1.27A22.94,22.94,0,0,0,721.3,428l.8-6.5,40.06-288.46a16.23,16.23,0,0,0,.16-2.59Z">
                                   </path>
                               </svg>
                           </span>

                           <!-- Cart Badge -->
                           <span
                               class="rounded-full absolute flex justify-center items-center bg-[#FC4D03] text-white w-4 h-4 -top-1 -right-2">
                               {{ $cart->count() }}</span>
                           <div class="header-cart-content"></div>
                       </a>
                   @else
                       <a href="{{ route('customer.auth.login') }}" aria-label="Shopping Cart"
                           class="drawer-toggle header-cart-button relative block"
                           data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="false"
                           data-set-focus=".cart-toggle-close">

                           <!-- SVG Cart Icon -->
                           <span class="base-svg-iconsets">
                               <svg class="thebase-svg-icon thebase-shopping-cart-svg w-6 h-6 text-black"
                                   xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 762.47 673.5">
                                   <path
                                       d="M600.86,489.86a91.82,91.82,0,1,0,91.82,91.82A91.81,91.81,0,0,0,600.86,489.86Zm0,142.93a51.12,51.12,0,1,1,51.11-51.11A51.12,51.12,0,0,1,600.82,632.79Z">
                                   </path>
                                   <path
                                       d="M458.62,561.33H393.3a91.82,91.82,0,1,0-.05,40.92h65.37a20.46,20.46,0,0,0,0-40.92ZM303.7,632.79a51.12,51.12,0,1,1,51.12-51.11A51.11,51.11,0,0,1,303.7,632.79Z">
                                   </path>
                                   <path
                                       d="M762.47,129.41a17.26,17.26,0,0,0-17.26-17.26H260.87a17.18,17.18,0,0,0-13.26,6.23,20.47,20.47,0,0,0-7.22,19.22l31.16,208a20.46,20.46,0,0,0,40.34-6.86L284.18,153.79H718.89l-37,256.4H221.59L166.75,15.06A17.26,17.26,0,0,0,147.42.14L123.7.12l0,.13H20.26a20.26,20.26,0,0,0,0,40.52H129.34l52.32,376.91,1,8.87c.1.85.15,1.71.19,2.57a23,23,0,0,0,1.35,6.76l.05.39a17.25,17.25,0,0,0,19.33,14.89l23.74.25,0-.27H698.19a24.33,24.33,0,0,0,3.44-.25,17.25,17.25,0,0,0,18.43-14.66l.18-1.27A22.94,22.94,0,0,0,721.3,428l.8-6.5,40.06-288.46a16.23,16.23,0,0,0,.16-2.59Z">
                                   </path>
                               </svg>
                           </span>

                           <!-- Cart Badge -->
                           <span
                               class="rounded-full absolute flex justify-center items-center bg-[#FC4D03] text-white w-4 h-4 -top-1 -right-2">0</span>
                           <div class="header-cart-content"></div>
                       </a>
                   @endif


               </div>
           </div>
