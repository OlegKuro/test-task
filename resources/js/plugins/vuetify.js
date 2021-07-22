import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

const iconfont = 'mdi'; // material design icons (available @ https://materialdesignicons.com/)
Vue.use(Vuetify);

const opts = {
    iconfont,
};

export default new Vuetify(opts);
