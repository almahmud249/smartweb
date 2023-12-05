<template>
    <div class="main_container">

        <div class="body_container">

            <!-- navbar end  -->
            <div style="height: 500px" class="body_wraper p-md-5 p-3 ">
                <div class="login_container">
                    <img class="z-index-2 mb-5" height="40" src="https://www.smartwebsource.com/wp-content/uploads/2016/02/smartwebsource-text-logo-1.png" >
                    <div class="login_box cm_box">
                        <p class="login_sub_title pb-5">Search city</p>
                        <form action>
                            <div class="common_input mb-5">
                                <label for>Enter name</label>
                                <input class="nn_input" v-model="key"
                                       placeholder="Search by city or state or county name"
                                       type="text">
                            </div>
                            <div class="common_input mb-5">
                                <InertiaLink :href="route('city', {key : key})" method="get">
                                    <button class="py-4">Search</button>
                                </InertiaLink>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- navbar end -->
    </div>
</template>

<script>
export default {
    name: "Home",
    data(){
        return {
            key: null,
        }
    }
}
</script>

<style scoped>

</style>
