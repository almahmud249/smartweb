<template>
    <div class="main_container">
        <div class="body_container">
            <div style="height: 100vh;" class="body_wraper p-md-5 p-3 ">
                <div class="login_container">
                    <img class="z-index-2 mb-5" height="40"
                         src="https://backend.bppshop.com.bd/storage/company/bppshop.png">
                    <div class="login_box cm_box">
                        <h1 class="text-center">Sign In</h1>
                        <p class="login_sub_title pb-5">Welcome back to
                            seller login</p>
                        <form @submit.prevent="submit">
                            <div class="common_input mb-5">
                                <label for>Mobile</label>
                                <input class="nn_input" v-model="form.phone"
                                       placeholder="Enter mobile number"
                                       type="text">
                                <span>{{form.errors.phone}}</span>
                            </div>
                            <div class="common_input mb-5">
                                <label for>Password</label>
                                <input class="nn_input" type="password" v-model="form.password">
                                <span>{{form.errors.password}}</span>
                            </div>
                            <div
                                class="form-group d-flex flex-wrap justify-content-between mb-5">

                                <div class="form-group">
                                    <input type="checkbox" class="mr-1"
                                           name="remember" id="remember">

                                    <label class for="remember">Remember me</label>
                                </div>
                                <a style="text-decoration: none;cursor: pointer;" class="font-size-sm">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="common_input mb-5">
                                <button type="submit" class="py-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    phone: "",
    password: "",
});
const submit = () => {
    form.post(route('login'));
}

</script>

<style scoped>

</style>
