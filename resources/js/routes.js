import App from "./components/App";
import ProductsIndex from "./components/ProductsIndex";
import Checkout from "./components/Checkout";

export default [
    {
        path: '/',
        name: 'root',
        component: App,
        children: [
            {
                path: '/',
                redirect: 'products',
            },
            {
                path: '/products',
                name: 'products',
                component: ProductsIndex,
            },
            {
                path: 'checkout',
                name: 'checkout',
                component: Checkout,
            }
        ],
    },
]
