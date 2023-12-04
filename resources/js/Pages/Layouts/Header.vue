<template>
    <header>
        <nav>
            <!-- <button  class="btn btn-sm  btn-primary ">B</button> -->
            <i id="openSidebar" onclick="openSideBar()" style="cursor: pointer;" class="fa-solid  d-md-none me-auto ms-5 fa-arrow-right "></i>
            <div class="d-flex align-items-center gap-3">
                <img
                    src="https://backend.bppshop.com.bd/assets/front-end/img/flags/en.png"
                    alt />
                <div id="custom_dropdown">
                    <p id="selected_item" class="mb-0"></p>
                    <div id="dropdown_item">
                        <p class="drop_item active">English</p>
                    </div>
                </div>
            </div>
            <div><i class="fa-solid fa-globe"></i></div>
            <div><i class="fa-solid fa-message"></i></div>
            <div><i class="fa-solid fa-cart-shopping"></i></div>
            <div class="profile_dropdown d-none d-md-block">
                <div class="btn-group">
                <span
                    style="font-size: 12px; font-weight: 600"
                    type="button"
                    class="dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                  BPP SHOP MANGO
                </span>
                    <ul
                        style="width: 300px"
                        class="dropdown-menu dropdown-menu-end p-4">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div>
                                <img
                                    class="avatar_img"
                                    src="https://backend.bppshop.com.bd/assets/back-end/img/160x160/img1.jpg"
                                    alt="Image Description" />
                            </div>
                            <div class="media_body">
                                <span class="profile_title">BPP SHOP</span>

                                <span class="profile_email">sohag@bppshop.com.bd</span>
                            </div>
                        </div>
                        <div class="media_body_menu">
                            <span class="profile_email">Setting</span>
                        </div>
                        <div class="media_body_menu">
                            <span class="profile_email">Sign Out</span>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="avatar_profile_dropdown">
                <div class="btn-group">
                <span
                    style="font-size: 12px; font-weight: 600"
                    type="button"
                    class="dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                  <img
                      class="avatar_img"
                      src="https://backend.bppshop.com.bd/assets/back-end/img/160x160/img1.jpg"
                      alt="Image Description" />
                </span>
                    <ul
                        style="width: 300px"
                        class="dropdown-menu dropdown-menu-end p-4">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div>
                                <img
                                    class="avatar_img"
                                    src="https://backend.bppshop.com.bd/assets/back-end/img/160x160/img1.jpg"
                                    alt="Image Description" />
                            </div>
                            <div class="media_body">
                                <span class="profile_title">BPP SHOP</span>

                                <span class="profile_email">sohag@bppshop.com.bd</span>
                            </div>
                        </div>
                        <div class="media_body_menu">
                            <span class="profile_email">Setting</span>
                        </div>
                        <div class="media_body_menu">
                            <InertiaLink :href="route('logout')" method="post">
                                <span class="profile_email">Sign Out</span>
                            </InertiaLink>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>

</style>
