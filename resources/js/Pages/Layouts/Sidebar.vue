<template>
    <aside class=" d-md-block" id="sidebar">
        <div class="logo_wraper">
            <img
                id="logo_img"
                src="https://bppshop.com.bd/static/media/bpp%20shop%20logo%20fainal.2844a9aed39093f55a55.png"
                alt/>

            <i id="collaps" @click="getMixinValue.collapsMenu()" class="fa-solid   fa-arrow-left me-3"></i>
            <i id="collaps" @click="getMixinValue.closeMenu()"
               class="fa-solid d-block d-md-none fa-arrow-left me-3"></i>
            <i style="display: none;" id="expand" @click="getMixinValue.expandMenu()"
               class="fa-solid mx-auto fa-arrow-right-long"></i>
        </div>
        <ul id="aside_link_wraper" class="link_wraper">
            <li>
                <a href="dashboard.html">
                    <p class="menu_link">
                        <i class="fa-solid fa-house"></i>
                        <span class="aside_link">Dashboard</span>
                    </p>
                </a>
            </li>

            <h5 class="link_group_title">order management</h5>
            <li>
                <p class="menu_link" @click="toggleDropdown('order')">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="aside_link">Orders</span>
                    <i class="fa-solid ms-auto fa-sort-down rt_icon"></i>
                </p>
                <ul :class="isOrderDropdownOpen == true ? 'show' : 'hide'">
                    <li>
                        <InertiaLink :href="route('order.index','all')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">All
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','pending')" method="get">

                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Pending
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','confirmed')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Confirmed
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','processing')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Packaging
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','out_for_delivery')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Out For
                      Delivery
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','delivered')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Delivered
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','returned')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Returned
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','failed')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Failed To
                      Deliver
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                    <li>
                        <InertiaLink :href="route('order.index','canceled')" method="get">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Canceled
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </InertiaLink>
                    </li>
                </ul>
            </li>
            <!-- for mobile device orders  -->
            <li class="hoverable_link">
                <p class="menu_link"><i class="fa-solid fa-cart-shopping"></i><i class="fa-solid fa-circle sm_dot"></i>
                </p>
                <ul class="hover_sub_menu">
                    <li>
                        <a href="allorders.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">All
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersPending.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Pending
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersConfirmed.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Confirmed
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersPackaging.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Packaging
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersOutOfDelivery.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Out For
                      Delivery
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersDelivered.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Delivered
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersReturned.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Returned
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersFailedToDeliver.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Failed To
                      Deliver
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="ordersCanceled.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Canceled
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- mobile device orders end -->
            <li>
                <a href="allProductsWithOrders.html">
                    <p class="menu_link">
                        <i class="fa-solid fa-image"></i>
                        <span class="aside_link">All Products With Orders</span>
                    </p>
                    <!-- <p class="menu_link">
                      <i class="fa-solid fa-image"></i>
                      <span class="aside_link">All Products With Orders</span>
                    </p> -->
                </a>
            </li>
            <li>
                <p class="active menu_link" @click="toggleDropdown('refund')">
                    <i class="fa-solid fa-receipt"></i><span class="aside_link">Refund
                Request List</span>
                    <i class="fa-solid ms-auto fa-sort-down rt_icon"></i>
                </p>
                <ul :class="isRefundDropdownOpen == true ? 'show' : 'hide'">
                    <li>
                        <a href="refund_request_list_pending.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Pending
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_approved.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Approved
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_refunded.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Refunded
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_rejected.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Rejected
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--  mobile device sub menu  -->
            <li class="hoverable_link">
                <p class="active menu_link">
                    <i class="fa-solid fa-receipt"></i>
                    <i class="fa-solid fa-circle sm_dot"></i>
                </p>
                <ul class="hover_sub_menu">
                    <li>
                        <a href="refund_request_list_pending.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Pending
                      <small class="order_qty rounded-pill text_warn">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_approved.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Approved
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_refunded.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Refunded
                      <small class="order_qty rounded-pill">110</small></span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="refund_request_list_rejected.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Rejected
                      <small class="order_qty rounded-pill text_danger">110</small></span>
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- mobile device sub menu end -->
            <h5 class="link_group_title">Product management</h5>
            <li>
                <p class="menu_link">
                    <i class="fa-solid fa-diamond"></i><span class="aside_link">Products</span>

                    <i class="fa-solid ms-auto fa-sort-down rt_icon"></i>
                </p>
                <ul class="hide">
                    <li>
                        <a href="products_products.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Products
                    </span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <p>
                            <i class="fa-solid fa-circle sm_dot"></i>
                            <span class="d-flex justify-content-between w-100">Bulk Import
                  </span>
                        </p>
                    </li>
                </ul>
            </li>
            <!-- mobile device sub menu  -->
            <li class="hoverable_link">
                <p class="menu_link">
                    <i class="fa-solid fa-diamond"></i>
                    <i class="fa-solid fa-circle sm_dot"></i>

                </p>
                <ul class="hide hover_sub_menu">
                    <li>
                        <a href="products_products.html">
                            <p>
                                <i class="fa-solid fa-circle sm_dot"></i>
                                <span class="d-flex justify-content-between w-100">Products
                    </span>
                            </p>
                        </a>
                    </li>
                    <li>
                        <p>
                            <i class="fa-solid fa-circle sm_dot"></i>
                            <span class="d-flex justify-content-between w-100">Bulk Import
                  </span>
                        </p>
                    </li>
                </ul>
            </li>
            <!-- mobile device sub menu end -->
            <li>
                <a href="productReviews.html">
                    <p>
                        <i class="fa-solid fa-star"></i><span class="aside_link">Product
                  Reviews</span>
                    </p>
                </a>
            </li>
            <h5 class="link_group_title">Help & support section</h5>
            <li>
                <a href="messages.html">
                    <p>
                        <i class="fa-solid fa-message"></i><span class="aside_link">Messages</span>
                    </p>
                </a>
            </li>
            <h5 class="link_group_title">Business section</h5>
            <li>
                <a href="withdraw.html">
                    <p>
                        <i class="fa-solid fa-wallet"></i><span class="aside_link">Withdraws</span>
                    </p>
                </a>
            </li>
            <li>
                <a href="mybankinfo.html">
                    <p>
                        <i class="fa-solid fa-shop"></i><span class="aside_link">My Bank
                  Info</span>
                    </p>
                </a>
            </li>
            <li>
                <a href="myshop.html">
                    <p>
                        <i class="fa-solid fa-house"></i><span class="aside_link">My
                  Shop</span>
                    </p>
                </a>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import helper from '../../helper'
import {ref} from "vue";

const getMixinValue = helper();
let isOrderDropdownOpen = ref(false)
let isRefundDropdownOpen = ref(false)

const toggleDropdown =(value)=>{
    if(value == 'order'){
        isOrderDropdownOpen.value = !isOrderDropdownOpen.value;
    }if(value == 'refund'){
        isRefundDropdownOpen.value = !isRefundDropdownOpen.value;
    }
}
</script>

<style scoped>

</style>
