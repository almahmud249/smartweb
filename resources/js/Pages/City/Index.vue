<template>
    <div class="body_wraper p-md-5 p-3">
        <div class="cm_box mb-5 p-0">
            <div class="cm_box px-5 py-2 pt-5">
                <div class="row row-cols-4 mb-4">
                    <div class="common_input ">

                    </div>
                    <div class="common_input ">
                        <label for="">Select Country</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                v-model="form.county_name"
                                @change="submit">
                            <option v-for="(country, i) in countries" :value="country.county_name">
                                {{ country.county_name }}
                            </option>
                        </select>
                    </div>
                    <div class="common_input ">
                        <label for="">Select State</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                v-model="form.state_name"
                                @change="submit">
                            <option v-for="(state, i) in states" :value="state.state_name">{{ state.state_name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
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
                    <tr v-for="(list,i) in cities.data">
                        <td>{{ i + 1 }}</td>
                        <td>{{ list.city_name }}</td>
                        <td>{{ list.state_name }}</td>
                        <td>{{ list.county_name }}</td>
                        <td>
                            <a @click="cityDetails(list.id)"><i class="fa-solid fa-eye action_icon"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination p-5">
                <InertiaLink v-for="(link, i) in cities.links" :href="link.url">
                    <span v-if="i != 0 && i != (cities.links.length - 1)" v-html="link.label"
                          :class="{ 'active': link.active }"></span>
                </InertiaLink>
            </div>
        </div>
    </div>
</template>
<script>
import WebpageLayout from "../Layouts/WebpageLayout.vue";
import {router} from "@inertiajs/vue3";
import CityDetails from "./CityDetails.vue";

export default {
    name: "Index",
    layout: WebpageLayout,
    props: ['cities', 'countries', 'states', 'filter_data'],
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
    mounted() {
        this.form.county_name = this.filter_data.county_name
        this.form.state_name = this.filter_data.state_name
    },
    methods: {
        modalValue() {
            this.showmodel = false
        },
        submit() {
            router.get(route('city.index', this.form));
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
