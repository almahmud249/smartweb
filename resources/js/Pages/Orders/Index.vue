<template>
    <div style="overflow-x: hidden;" class="body_wraper p-md-5 p-3">
        <div class=" mb-4">
            <!-- page title start -->
            <div>
                <h1 class="page-header-title">
                    <img
                        src="https://backend.bppshop.com.bd/assets/back-end/img/all-orders.png"
                        alt>
                    {{ tab.toUpperCase() }} ORDERS
                    <span class="rounded-pill">{{ orders.pending_count+orders.confirmed_count+orders.processing_count+orders.out_for_delivery_count+orders.delivered_count+orders.canceled_count+orders.returned_count+orders.failed_count }}</span>
                </h1>
            </div>
            <!-- page title end -->
        </div>


        <div class="cm_box mb-5 p-0">
            <StatusCount :filters="filters" :orders="orders"/>
            <div class="table_responsive p-5">
                <table>
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Customer Info</th>
                        <th>Total Amount</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(order,i) in orders.orders.data">
                        <td>{{ i + 1 }}</td>
                        <td>{{ order.id }}</td>
                        <td>
                            <span class="d-block">{{ moment(order.created_at).format("MMMM D, YYYY") }}</span>
                            <span class="d-block"><span class="d-block">{{
                                    moment(order.created_at).format("h:mm A")
                                }}</span>
</span>
                        </td>
                        <td>{{ order.customer_name }}</td>
                        <td>
                            <span class="d-block">{{ order.total_amount }} ৳</span>
                            <span
                                class="d-block" :class="order.payment_status == 'paid' ? 'confirmed' :'unpaid_status'">{{ order.payment_status }}</span>
                        </td>
                        <td><span
                            class="d-block"
                            :class="order.order_status == 'processing' ? 'processing' :
                            (order.order_status == 'out_for_delivery' ? 'processing' :
                             (order.order_status == 'confirmed' ? 'pending' :
                             (order.order_status == 'delivered' ? 'confirmed' :
                               (order.order_status == 'pending' ? 'pending' :'unpaid_status'
                             ))))
                                ">{{ order.order_status }}</span></td>
                        <td class="no_wrap">
                            <i
                                class="fa-solid fa-eye action_icon"></i>
                            <i
                                class="fa-solid fa-download circle_download"></i>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination p-5">
                <InertiaLink v-for="(link, i) in orders.orders.links" :href="link.url">
                    <span v-if="i != 0 && i != (orders.orders.links.length - 1)" v-html="link.label"
                          :class="{ 'active': link.active }"></span>
                </InertiaLink>
            </div>
        </div>
    </div>
</template>

<script>
import webpageLayout from "../Layouts/WebpageLayout.vue";
import StatusCount from "./StatusCount.vue";
import moment from "moment";

export default {
    name: "Index",
    data() {
        return {
            name: this.total_pending,
            tab:this.filters.tab,
            moment: moment,

        }
    },
    layout: webpageLayout,
    props: {
        orders: Object,
        total_pending: Object,
        filters: Object
    },
    components: {
        StatusCount
    }
}
</script>

<style scoped>

</style>
