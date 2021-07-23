<template>
    <v-container class="mt-2">
        <v-card>
            <v-card-title>Products</v-card-title>
            <v-data-table
                :headers="headers"
                :items="items"
                :loading="isLoading"
                :options.sync="options"
                :server-items-length="totalItemsCount"
                :footer-props="{
                    itemsPerPageOptions: [5, 10, 15, 25],
                    prevIcon: 'mdi-arrow-left',
                    nextIcon: 'mdi-arrow-right',
                 }"
                fixed-header
            >
                <template v-slot:item.actions="{item}">
                    <v-btn
                        color="primary"
                        @click="goToCheckout(item)"
                        outlined
                        dense
                    >
                        BUY
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: "ProductsIndex",
        data() {
            return {
                isLoading: false,
                items: [],
                options: {
                    page: 1,
                    itemsPerPage: 10,
                },
                totalItemsCount: 0,
                headers: [
                    {
                        text: 'Brand name',
                        sortable: false,
                        value: 'brand.name',
                    },
                    {
                        text: 'Name',
                        sortable: false,
                        value: 'name',
                    },
                    {
                        text: 'Price',
                        sortable: false,
                        value: 'price',
                    },
                    {
                        text: 'Actions',
                        sortable: false,
                        value: 'actions',
                    }
                ],
            }
        },
        mounted() {
            this.loadProducts();
        },
        methods: {
            async loadProducts() {
                try {
                    this.isLoading = true;
                    const params = {
                        page: this.options.page,
                        per_page: this.options.itemsPerPage,
                    };
                    const {data} = await this.$axios.get('products', {params});
                    this.items = data.data;
                    this.totalItemsCount = data.meta.total;
                    this.options.page = data.meta.current_page;
                    this.options.itemsPerPage = data.meta.per_page;
                } finally {
                    this.isLoading = false;
                }
            },
            goToCheckout(item) {
                const productId = item.id;
                this.$router.push({name: 'checkout', params: {productId}});
            }
        },
        watch: {
            options: {
                handler(opts, oldOpts) {
                    if (Object.keys(opts).length !== Object.keys(oldOpts).length) {
                        return
                    }
                    this.loadProducts();
                },
                deep: true,
            },
        }
    }
</script>
