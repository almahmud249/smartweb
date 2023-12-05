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
                <InertiaLink :href="route('dashboard')" method="get">
                    <p class="menu_link">
                        <i class="fa-solid fa-house"></i>
                        <span class="aside_link">Dashboard</span>
                    </p>
                </InertiaLink>
            </li>
            <li>
                <InertiaLink :href="route('city.index')" method="get">
                    <p class="menu_link">
                        <i class="fa-solid fa-house"></i>
                        <span class="aside_link">City List</span>
                    </p>
                </InertiaLink>
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
