<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(product,i) in products">
            <th scope="row">1</th>
            <td>{{product.phone}}</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props:{
        products: Object
    }
}

</script>

<style scoped>

</style>
