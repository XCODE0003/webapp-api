<script setup>
import User from "../api/User/user.js";
import { onMounted, ref, useHost, watch } from "vue";
import i18n from "../i18n";
import LoadingComponent from "../components/LoadingComponent.vue";
const user = ref(null);
const showMenu = ref(false);
const rank = ref(null);
update();
async function update() {
    await User.getUser();
    user.value = User;
    if (user.value.balance >= 1000000) {
        rank.value = "gold";
    } else if (user.value.balance >= 250000) {
        rank.value = "silver";
    } else {
        rank.value = "bronze";
    }
}

function toggleMenu() {
    showMenu.value = !showMenu.value;
}
function changeLang(lang) {
    localStorage.setItem("lang", lang);
    i18n.global.locale = lang;
}
const body = document.body;
body.addEventListener("click", (e) => {
    if (e.target.id !== "menu") {
        showMenu.value = false;
    }
});
</script>

<template>
    <section class="flex gap-2.5 w-full items-center">
        <div
            class="p-3.5 w-full flex-1 rounded-lg gap-2.5 bg-dark flex items-center"
        >
            <img
                v-if="rank"
                class="h-9"
                :src="`/assets/img/${rank}.png`"
                alt=""
                srcset=""
            />
            <div class="flex flex-col gap-1.5">
                <span class="text-gray_1 leading-none text-lg font-normal"
                    >{{ $t("header.your_league") }}:</span
                >
                <p class="text-white m-0 leading-none">
                    <LoadingComponent
                        :value="$t(rank ? `header.${rank}` : '')"
                    />
                </p>
            </div>
        </div>
        <div class="flex relative flex-col gap-2.5">
            <div
                @click="toggleMenu()"
                id="menu"
                class="h-full p-3 user-select-none bg-dark cursor-pointer flex items-center justify-center rounded-lg gap-3.5"
            >
                <img
                    v-if="user?.avatar"
                    :src="user?.avatar"
                    class="h-12 pointer-events-none user-select-none rounded-full"
                />
                <div v-else class="h-12 w-12 rounded-full bg-gray_1"></div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="14"
                    height="9"
                    viewBox="0 0 14 9"
                    fill="none"
                >
                    <path
                        opacity="0.6"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M13.7071 0.792893C14.0976 1.18342 14.0976 1.81658 13.7071 2.20711L7.70711 8.20711C7.31658 8.59763 6.68342 8.59763 6.29289 8.20711L0.292892 2.20711C-0.0976331 1.81658 -0.0976331 1.18342 0.292892 0.792893C0.683416 0.402369 1.31658 0.402369 1.70711 0.792893L7 6.08579L12.2929 0.792893C12.6834 0.402369 13.3166 0.402369 13.7071 0.792893Z"
                        fill="white"
                    />
                </svg>
            </div>
            <transition name="fade">
                <div
                    v-if="showMenu"
                    class="absolute w-full top-20 h-22 flex-col p-3 bg-dark flex items-start justify-center rounded-lg gap-3.5"
                >
                    <div class="cursor-pointer" @click="changeLang('ru')">
                        🇷🇺 RU
                    </div>
                    <div class="cursor-pointer" @click="changeLang('en')">
                        🇺🇸 EN
                    </div>
                </div>
            </transition>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.1s ease;
    scale: 1;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    scale: 0.9;
}
</style>
