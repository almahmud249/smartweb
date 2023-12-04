<template>
    <div class="main_container">
        <Sidebar/>
        <div class="body_container">
            <Header/>
            <main>
                <!-- content goes here -->
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";

export default {
    name: "WebpageLayout",
    components:{
        Header,Sidebar
    }
}
</script>

<style scoped>

</style>
