<template>
    <div class="body_wraper p-md-5 p-3">
        <div class="cm_box mb-5 p-0">
            <div class="modal fade" :class="showmodel == true ? 'show' : ''" tabindex="-1"
                 style="background: #80808050; transition: opacity 2s" @click="modalValue"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <CityDetails @modalValue="modalValue" :details="details"></CityDetails>
            </div>
            <div class="table_responsive">
                <table>
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>City Name</th>
                        <th>State Name</th>
                        <th>Country Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(list,i) in cities">
                        <td>{{ i + 1 }}</td>
                        <td>{{ list.city }}</td>
                        <td>{{ list.state_name }}</td>
                        <td>{{ list.county_name }}</td>
                        <td>
                            <a @click="cityDetails(list.id)"><i class="fa-solid fa-eye action_icon"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import {router} from "@inertiajs/vue3";
import CityDetails from "./CityDetails.vue";

export default {
    name: "Index",
    props: ['cities'],
    data() {
        return {
            showmodel: false,
            form: {
                county_name: null,
                state_name: null,
            },
            details: null
        }
    },
    methods: {
        modalValue() {
            this.showmodel = false
        },
        cityDetails(id) {
            axios.get(route('city.details', id))
                .then((res) => {
                    this.details = res.data.city
                    this.showmodel = true
                })
        }
    },
    components: {
        CityDetails
    }
}
</script>

<style scoped>

</style>
