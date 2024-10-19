<script setup>
import { onMounted, ref, watch } from "vue";
import User from "../api/User/user.js";
import Modal from "../modal/index.js";
import Header from "../components/Header.vue";
import LoadingComponent from "../components/LoadingComponent.vue";

const user = ref(User);
const img_path = import.meta.env.VITE_IMAGE_URL;
const news = ref(null);
const activeNew = ref(null);
const levels = ref(null);
const userCoins = ref(0);
const userCoinsShow = ref(0);
const charging = ref(0);
const chargingShow = ref(0);
const activeStorage = ref(0);
let interval = null;
let newsModal = null;
function openNews(news) {
    activeNew.value = news;
    newsModal.openModal();
}

function handleTouchStart(event) {
    if (event.touches.length > 1) {
        event.preventDefault();
    }
}

function handleTouchMove(event) {
    event.preventDefault();
}

watch(charging, () => {
    if (charging.value >= 100) {
        charging.value = 100;
    }
    chargingShow.value = parseFloat(charging.value).toFixed(0);
});
watch(userCoins, () => {
    userCoinsShow.value = parseFloat(userCoins.value).toFixed(2);
});
async function tap() {
    const tapResponse = await User.tap();
    interval && clearInterval(interval);
    user.value = tapResponse.user;
    activeStorage.value = tapResponse.storage;
}
watch(activeStorage, () => {
    charging.value =
        (activeStorage.value.energy / activeStorage.value.energy_max) * 100;
    interval = setInterval(() => {
        if (charging.value < 100) {
            activeStorage.value.energy +=
                5 * levels.value.lvlTap[user.value.click_level].multiplier;
            charging.value =
                (activeStorage.value.energy / activeStorage.value.energy_max) *
                100;
        }
    }, 1000);
    console.log(charging.value);
});

async function claimBonus() {
    const claimBonusResponse = await User.claimBonus();
    if (claimBonusResponse.success === true) {
        activeStorage.value = claimBonusResponse.storage;
        userCoins.value = claimBonusResponse.user.balance;
    }
}

onMounted(async () => {
    await User.getUser();
    newsModal = new Modal("NewsModal");
    newsModal.init();
    levels.value = await User.getLvl();
    userCoins.value = parseFloat(User.balance);
    news.value = await User.getNews();
    activeStorage.value = await User.getStorage();
});
</script>

<template>
    <div class="mb-48 min-h-screen flex flex-col gap-9">
        <main
            class="flex-col m-auto container items-center w-full gap-9 justify-center flex"
        >
            <section class="flex items-center flex-col gap-2.5">
                <div
                    class="flex text-5xl text-white font-bold items-center gap-2.5"
                >
                    <img
                        class="h-11"
                        src="/assets/img/coin.png"
                        alt=""
                        srcset=""
                    />
                    <LoadingComponent :value="userCoinsShow" />
                </div>
                <p class="text-gray font-normal">
                    {{ $t("home.all_balance") }}
                </p>
            </section>
            <section class="w-full">
                <div class="progress-container big w-full">
                    <div
                        v-if="charging !== 0"
                        :style="{ width: charging + '%' }"
                        class="progress-bar big"
                    >
                        {{ charging > 20 ? chargingShow + "%" : "" }}
                    </div>
                    <div
                        v-else
                        class="w-full flex justify-center h-full items-center"
                    >
                        Start earning!
                    </div>
                </div>
            </section>
            <section
                @click="tap()"
                @touchstart.prevent="handleTouchStart"
                @touchmove.prevent="handleTouchMove"
                class="border border-white/10 rounded-3xl p-6"
            >
                <img
                    class="active:scale-95 transition-all"
                    src="/assets/img/click.png"
                    alt=""
                    srcset=""
                />
            </section>
            <section class="flex w-full text-center flex-col gap-6">
                <RouterLink to="/roulette" class="btn casino w-full">
                    {{ $t("home.casino") }}
                </RouterLink>
                <button
                    @click="claimBonus()"
                    :disabled="charging < 100 || charging != 100"
                    class="btn bg-blue"
                >
                    {{ $t("home.claim_bonus") }}
                </button>
            </section>

            <section class="flex flex-col gap-6 w-full items-center">
                <div
                    @click="openNews(News)"
                    v-for="News in news"
                    class="news-container cursor-pointer"
                >
                    <img class="rounded-xl" :src="img_path + News.image" />
                    <div class="flex flex-col gap-1">
                        <p>{{ News.title }}</p>
                        <span> {{ News.content.substr(0, 50) }}... </span>
                    </div>
                </div>
            </section>
            <div id="NewsModal" class="modal">
                <div class="flex flex-col relative gap-6">
                    <div class="flex flex-col gap-5">
                        <h1 class="text-white text-2xl">
                            {{ activeNew?.title }}
                        </h1>
                        <p class="">
                            {{ activeNew?.content }}
                        </p>
                    </div>
                    <button
                        class="btn bg-gray_2 close-modal text-sm text-white"
                    >
                        Закрыть
                    </button>
                </div>
            </div>
        </main>
    </div>
    <!-- <transition v-if="!isLoading" name="fade">
        <component :is="Loading" />
    </transition> -->
</template>

<style scoped></style>
