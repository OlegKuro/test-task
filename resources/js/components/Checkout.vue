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
                :error-messages="getErrors('name')"
                @input="resetError('name')"
                label="Your name"
                hide-details="auto"
                dense
            ></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-text-field
                v-model="form.address"
                :disabled="isTryingToSubmit"
                :error-messages="getErrors('address')"
                @input="resetError('address')"
                label="Your address"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-select
                v-model="form.shipping"
                :disabled="isTryingToSubmit"
                :error-messages="getErrors('shippingPrice')"
                @input="resetError('shippingPrice')"
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
                :error-messages="getErrors('cardHolder')"
                @input="resetError('cardHolder')"
                label="Card holder"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-text-field
                v-model="form.cardNumber"
                :disabled="isTryingToSubmit"
                :error-messages="getErrors('cardNumber')"
                placeholder="0000 0000 0000 0000"
                @input="resetError('cardNumber')"
                label="Card number"
                dense
                hide-details="auto"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field
                v-model="form.month"
                :disabled="isTryingToSubmit"
                :error-messages="getErrors('month')"
                @input="resetError('month')"
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
                :error-messages="getErrors('year')"
                @input="resetError('year')"
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
                :error-messages="getErrors('securityCode')"
                @input="resetError('securityCode')"
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
    import CheckoutForm from '../forms/checkoutForm';
    import hasLaravelValidation from '../mixins/hasLaravelValidation';

    export default {
        name: "Checkout",
        mixins: [
            hasLaravelValidation,
        ],
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
                this.isTryingToSubmit = true;
                const url = `products/${this.productId}/checkout`;
                try {
                    await this.$axios.post(url, this.form.preparedForApi());
                    this.$router.replace({name: 'products'});
                } catch (e) {
                    this.errors = e.response.data.errors;
                } finally {
                    this.isTryingToSubmit = false;
                }
            },
        }
    }
</script>
