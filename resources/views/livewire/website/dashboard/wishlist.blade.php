<div>
    @if ($screen == 'wishlist')
        <div class="tab-pane fade @if($screen == 'wishlist') show active @endif">
            @livewire('website.wishlist.wishlist-table')
    {{-- <div class="wishlist">
        <div class="cart-content">
            <h5 class="cart-heading">SpaceRace</h5>
            <p>Order ID: <span class="inner-text">#4345</span></p>
        </div>
        <div class="cart-section wishlist-section">
            <table>
                <tbody>
                    <tr class="table-row table-top-row">
                        <td class="table-wrapper wrapper-product">
                            <h5 class="table-heading">PRODUCT</h5>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">PRICE</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">ACTION</h5>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="assets/images/homepage-one/product-img/product-img-1.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Classic Design Skart</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$20.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="assets/images/homepage-one/product-img/product-img-2.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Classic Black Suit</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$20.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper ">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="assets/images/homepage-one/product-img/product-img-3.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Blue Party Dress</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$20.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="assets/images/homepage-one/product-img/product-img-4.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Classic Party Dress</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$20.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="wishlist-btn">
            <a href="#" class="clean-btn">Clean Wishlist</a>
            <a href="#" class="shop-btn">View Cards</a>
        </div>
    </div> --}}
</div>
    @endif
</div>