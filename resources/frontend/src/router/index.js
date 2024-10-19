import { createWebHistory, createRouter } from 'vue-router';
import Loading from "../views/Loading.vue";
import Index from "../views/Index.vue";
import Boost from "../views/Boost.vue";
import Referral from "../views/Referral.vue";
import Shop from "../views/Shop.vue";
import Roulette from "../views/Spin.vue";
const routes = [
    { path: '/', component: Index, name: 'index' },
    { path: '/loading', component: Loading, name: 'loading' },
    { path: '/boosts', component: Boost, name: 'boost' },
    { path: '/referral', component: Referral, name: 'referral' },
    { path: '/shop', component: Shop, name: 'shop' },
    { path: '/roulette', component: Roulette, name: 'roulette' },
    // {path: '/articles/search/:search', component: Articles, name: 'search'},
    // {path: '/articles/category/:category', component: Articles, name: 'category'},
    // {path: '/article/:id', component: Article, name: 'article'},





];

const router = createRouter({
    history: createWebHistory(),
    routes,
});




export default router;
