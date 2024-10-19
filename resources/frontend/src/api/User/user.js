import apiAuthClient from "../../api/Clients/apiAuthClient.js";
import { ref } from "vue";

class User {
    constructor() {
        this.id = null;
        this.avatar = null;
        this.firstName = null;
        this.balance = null;
        this.balance_donat = null;
        this.last_login = null;
        this.last_bonus = null;
        this.recharging_level = null;
        this.autobot_level = null;
        this.free_spins = null;
        this.click_level = null;

        this._isAuth = ref(false);
    }
    async spin(win) {
        return apiAuthClient.post('/user/casino/spin', { win: win })
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async getUser() {
        return apiAuthClient.get('/user/get')
            .then((response) => {
                this.id = response.data.user.id;
                this.avatar = response.data.user.avatar;
                this.firstName = response.data.user.firstName;
                this.balance = response.data.user.balance;
                this.recharging_level = response.data.user.recharging_level;
                this.last_login = response.data.user.last_login;
                this.last_bonus = response.data.user.last_bonus;
                this.balance_donat = response.data.user.balance_donat;
                this.autobot_level = response.data.user.autobot_level;
                this.click_level = response.data.user.click_level;
                this.free_spins = response.data.user.free_spins;
                this.isAuth = true;
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });

    }
    async transactionCheck() {
        return apiAuthClient.get('/user/transactions/check')
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async getSettings() {
        return apiAuthClient.get('/user/settings/get')
            .then((response) => {
                return response.data.settings;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async getStorage() {
        return apiAuthClient.get('/user/storage/active')
            .then((response) => {
                return response.data.storage;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async startStorage() {
        return apiAuthClient.post('/user/manning/start')
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async claimBonus() {
        return apiAuthClient.post('/user/bonus/claim')
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });

    }
    async tap() {
        return apiAuthClient.post('/user/tap')
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });

    }
    async getShop() {
        return apiAuthClient.get('/user/shop/get')
            .then((response) => {
                return response.data.shop;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async getNews() {
        return apiAuthClient.get('/news')
            .then((response) => {
                return response.data.news;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async buyBoost(boost) {
        return apiAuthClient.post('/user/boost/buy', { type_boost: boost })
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });
    }
    async getLvl() {
        return apiAuthClient.get('/lvl')
            .then((response) => {
                return response.data;
            }).catch((error) => {
                console.error(error);
                return null;
            });


    }
    async getReferrals() {
        return apiAuthClient.get('/user/referrals')
            .then((response) => {
                return response.data.referrals;
            }).catch((error) => {
                console.error(error);
                return null;
            });

    }
    get isAuth() {
        return this._isAuth.value;
    }

    set isAuth(value) {
        this._isAuth.value = value;
    }

}

export default new User();
