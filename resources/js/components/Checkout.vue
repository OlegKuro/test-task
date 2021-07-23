<template>
    <v-row class="mt-2 mx-3">
        <v-col cols="12" class="text-sm-center">
            <h3>Checkout</h3>
        </v-col>
        <v-progress-linear
            v-if="isTryingToSubmit"
            indeterminate
        ></v-progress-linear>
        <v-col cols="6">
            <v-text-field
                v-model="form.name"
                :disabled="isTryingToSubmit"
                label="Your name"
                hide-details="auto"
                dense
            ></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-text-field
                v-model="form.address"
                :disabled="isTryingToSubmit"
                label="Your address"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-select
                v-model="form.shipping"
                :disabled="isTryingToSubmit"
                :hint="`${form.shipping.label}, ${form.shipping.price} EUR`"
                :items="shippingOptions"
                item-text="label"
                item-value="price"
                label="Shipping"
                hide-details="auto"
                persistent-hint
                return-object
                single-line
            ></v-select>
        </v-col>
        <v-col cols="12" class="my-n2">
            <v-divider></v-divider>
        </v-col>
        <v-col cols="6">
            <v-text-field
                v-model="form.cardHolder"
                :disabled="isTryingToSubmit"
                label="Card holder"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-text-field
                v-model="form.cardNumber"
                :disabled="isTryingToSubmit"
                label="Card number"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field
                v-model="form.month"
                :disabled="isTryingToSubmit"
                label="Month"
                type="number"
                min="1"
                max="12"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field
                v-model="form.year"
                :disabled="isTryingToSubmit"
                label="Year"
                type="number"
                min="1950"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field
                v-model="form.securityCode"
                :disabled="isTryingToSubmit"
                label="Security code"
                type="number"
                min="100"
                max="999"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="12" class="mt-3 justify-space-between d-flex">
            <v-btn
                :disabled="isTryingToSubmit"
                @click="submit"
                color="success"
                dense
                outlined
            >
                Submit
            </v-btn>
            <v-btn
                @click="resetFields"
                :disabled="isTryingToSubmit"
                dense
                color="default"
                outlined
            >
                Reset fields
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
    import CheckoutForm from "../forms/checkoutForm";

    export default {
        name: "Checkout",
        data() {
            return {
                isTryingToSubmit: false,
                productId: null,
                shippingOptions: [
                    {
                        price: 0,
                        label: 'free standard',
                    },
                    {
                        price: 10.00,
                        label: 'express',
                    }
                ],
                form: new CheckoutForm(),
            }
        },
        mounted() {
            this.setProductId();
        },
        methods: {
            setProductId() {
                if (!this.$route.params.productId) {
                    this.$router.replace({name: 'products'});
                }
                this.productId = this.$route.params.productId;
            },
            resetFields() {
                this.form = new CheckoutForm();
            },
            async submit() {
                console.log(this.form);
                this.isTryingToSubmit = true;
                setTimeout(() => {
                    this.isTryingToSubmit = false;
                }, 3000);
            }
        }
    }
</script>
