import App from "./components/App";
import ProductsIndex from "./components/ProductsIndex";

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
        ],
    },
]
