<template>
    <div class="cm_box px-5 py-2 pt-5">
        <h1 class="box_title mb-5">Select Date Range </h1>
        <div class="row row-cols-lg-4 gy-5 mb-5">
            <div class="common_input " v-if="tab =='all'">
                <select name id>
                    <option value>All</option>
                    <option value>1</option>
                    <option value>1</option>
                    <option value>1</option>
                </select>
            </div>
            <div class="common_input ">
                <div class="inputWraper">
                    <label for>Start Date</label>
                    <input type="date" v-model="from">
                </div>
            </div>
            <div class="common_input ">
                <div class="inputWraper">
                    <label for>End Date</label>
                    <input type="date" v-model="to">
                </div>
            </div>

            <div class="common_input ">
                <InertiaLink :href="route('order.index',tab)" :data="{from,to}" method="get">
                    <button >Show Data</button>
                </InertiaLink>
            </div>

        </div>
    </div>
    <div class=" row row-cols-2 row-cols-md-4 gy-3 p-5" v-if="tab =='all'">
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/pending.png"
                        alt>
                    Pending
                </p>
                <span class="order_stats__title">{{orders.pending_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/confirmed.png"
                        alt>
                    Confirmed
                </p>
                <span class="order_stats__title">{{orders.confirmed_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/packaging.png"
                        alt>
                    Packaging
                </p>
                <span class="order_stats__title">{{orders.processing_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/out-of-delivery.png"
                        alt>
                    Out for delivery
                </p>
                <span class="order_stats__title">{{orders.out_for_delivery_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/delivered.png"
                        alt>
                    Delivered
                </p>
                <span class="order_stats__title">{{orders.delivered_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/canceled.png"
                        alt>
                    Canceled
                </p>
                <span class="order_stats__title">{{orders.canceled_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/returned.png"
                        alt>
                    Returned
                </p>
                <span class="order_stats__title">{{orders.returned_count}}</span>
            </div>
        </div>
        <div class="px-2">
            <div
                class="sm_card d-flex justify-content-between ">
                <p>
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/failed-to-deliver.png"
                        alt>
                    Failed to deliver
                </p>
                <span class="order_stats__title">{{orders.failed_count}}</span>
            </div>
        </div>

    </div>
    <div class="row row-cols-lg-3 gy-3 my-5 p-5 pb-0 pt-0" v-if="tab =='all'">
        <div class="common_input">
            <div class="input-group position-relative ">

                <i
                    class="fa-solid fa-magnifying-glass input_search_icon"></i>

                <input type="text"
                       class="form-control px-5 active"
                       placeholder="Search orders"
                       aria-label
                       aria-describedby="basic-addon1">
                <div style="border: 1px solid #0177cd ;"
                     class="input-group-append">
                    <button
                        class="btn btn-outline-secondary border-0 rounded-0"
                        type="button">Search
                    </button>
                </div>
            </div>
        </div>
        <div
            class="ms-auto d-flex justify-content-end gap-3">
            <div class="common_input">
                <input class="active nn_input"
                       placeholder="Barcode" type="text">
            </div>
            <div class>
                <div class="btn-group  common_input">
                    <button
                        style="font-size: 12px;font-weight: 600;"
                        type="button"
                        class=" dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Export
                    </button>
                    <ul
                        class="dropdown-menu mt-2 py-5 drop_down_wraper">
                        <div class="excel_file">
                            <img
                                src="https://backend.bppshop.com.bd/assets/back-end/img/excel.png"
                                alt>
                            Excel
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            to:this.filters.to,
            from:this.filters.from,
            tab:this.filters.tab,
        }
    },
    props:['filters','orders'],

}

</script>

<style scoped>

</style>
