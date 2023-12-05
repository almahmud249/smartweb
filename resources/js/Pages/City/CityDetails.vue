<template>
    <div class="modal-dialog modal-dialog-centered" @click="stopPrope($event)">
        <div class="modal-content">
            <div class="modal-body" v-if="details">
                <div class="my_shop_info p-4">
                    <div class="d-flex">
                        <h4>City : </h4>
                        <h5 class="mx-1">{{ details.city }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4>State : </h4>
                        <h5 class="mx-1">{{ details.state_name }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Country :
                        </h4>
                        <h5 class="mx-1">{{ details.county_name }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Population :
                        </h4>
                        <h5 class="mx-1">{{ details.population }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Density :
                        </h4>
                        <h5 class="mx-1">{{ details.density }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Source :
                        </h4>
                        <h5 class="mx-1">{{ details.source }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Time Zone :
                        </h4>
                        <h5 class="mx-1">{{ details.timezone }}</h5>
                    </div>
                    <div class="flex-start d-flex">
                        <h4 class="no_wrap">Ranking :
                        </h4>
                        <h5 class="mx-1">{{ details.ranking }}</h5>
                    </div>
                </div>
            </div>

            <div class="modal-footer py-4">
                <button type="button" class="btn btn-secondary btn-lg py-3 px-5" data-bs-dismiss="modal"
                        @click="closeModal">Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    props: ['details'],
    data() {
        return {
            form: useForm({
                amount: null
            })
        }
    },
    methods: {
        stopPrope(event) {
            event.stopPropagation();
        },
        closeModal() {
            this.showModal = false
            this.$emit('modalValue', this.showModal)
        }
    }
};
</script>
