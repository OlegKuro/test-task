import {cloneDeep} from 'lodash';

export default class {
    constructor() {
        this.address = '';
        this.name = '';
        this.shipping = {
            price: 0,
            label: 'free standard',
        };
        this.cardHolder = '';
        this.cardNumber = '';
        this.month = '12';
        this.year = '2021';
        this.securityCode = '999';
    }

    preparedForApi() {
        const ret = cloneDeep(this);
        ret.cardNumber = ret.cardNumber.replace(/\s/g, '');
        ret.shippingPrice = this.shipping.price;

        delete ret.shipping;

        return ret;
    }
}
