<script setup>
import { onMounted, ref, watch } from "vue";
import User from "../api/User/user.js";
import Header from "../components/Header.vue";
import BoostComponent from "../components/BoostComponent.vue";

const selectedTab = ref("lvlTap");
const user = ref(User);
const boostsLvl = ref(null);
const boosts = ref(null);
const lvlTap = ref(user.value.click_level);
const lvlAutobot = ref(user.value.autobot_level);
const lvlRecharging = ref(user.value.recharging_level);

watch(selectedTab, async (newVal) => {
    selectedTab.value = newVal;
    await updateBoosts();
});
watch(user, async (newVal) => {
    await updateBoosts();
});
onMounted(async () => {
    boostsLvl.value = await User.getLvl();
    boosts.value = boostsLvl.value[selectedTab.value];
    console.log(boosts.value.length - 1);
});
function getSelectedTab() {
    console.log(selectedTab.value);
    return selectedTab.value;
}

function changeTab(tab) {
    selectedTab.value = tab;
}

async function updateUser(user) {
    await User.getUser();
}
async function updateBoosts() {
    boostsLvl.value = {};
    boostsLvl.value = await User.getLvl();
    boosts.value = {};
    boosts.value = boostsLvl.value[selectedTab.value];
}
async function buyBoost(boost) {
    const response = await User.buyBoost(boost);
    if (response.success) {
        await updateUser(response.user);
        await updateBoosts();
    } else {
        alert(response.error);
    }
}
</script>

<template>
    <div class="min-h-screen flex flex-col gap-9">
        <main
            class="flex-col mx-auto container items-center w-full gap-9 justify-center flex"
        >
            <section
                class="p-1.5 text-base justify-center rounded-md text-white bg-dark w-full flex"
            >
                <div
                    @click="changeTab('lvlTap')"
                    :class="{ 'bg-black_1': selectedTab === 'lvlTap' }"
                    class="p-2 transition-all text-center rounded-md cursor-pointer leading-none flex-1"
                >
                    {{ $t("boost.tap") }}
                </div>
                <div
                    @click="changeTab('lvlAutobot')"
                    :class="{ 'bg-black_1': selectedTab === 'lvlAutobot' }"
                    class="p-2 transition-all flex items-center justify-center rounded-md cursor-pointer text-center leading-none flex-1"
                >
                    {{ $t("boost.autobot") }}
                </div>
                <div
                    @click="changeTab('lvlRecharging')"
                    :class="{ 'bg-black_1': selectedTab === 'lvlRecharging' }"
                    class="p-2 transition-all flex items-center justify-center rounded-md cursor-pointer text-center leading-none flex-1"
                >
                    {{ $t("boost.timer") }}
                </div>
            </section>
            <section class="flex flex-col gap-2 w-full">
                <div v-for="(boost, index) in boosts" :key="index">
                    <div
                        v-if="!boost.hide && boost.cost"
                        class="task-container"
                    >
                        <div class="flex items-center gap-3.5">
                            <div
                                class="px-3 border-white/10 border rounded-md flex items-center gap-4 py-1.5"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26"
                                    height="37"
                                    viewBox="0 0 26 37"
                                    fill="none"
                                >
                                    <path
                                        d="M0 0C8.58 0 17.16 0 26 0C26 1.90235 26 3.80471 26 5.76471C22.738 5.76471 19.476 5.76471 16.1152 5.76471C16.1084 8.62874 16.1084 8.62874 16.1073 11.4928C16.1075 11.8794 16.1077 12.2661 16.1079 12.6527C16.1079 12.7254 16.1079 12.7254 16.108 12.7995C16.1083 13.5805 16.1064 14.3615 16.1038 15.1424C16.1012 15.9447 16.1009 16.7469 16.1026 17.5492C16.1036 18.0437 16.1029 18.5382 16.0999 19.0327C16.098 19.3724 16.0983 19.7121 16.1003 20.0518C16.1014 20.2475 16.1012 20.4429 16.0991 20.6386C16.0894 21.5725 16.1485 22.1657 16.7742 22.8824C16.8687 23.0172 16.9558 23.1549 17.0438 23.2941C17.2755 23.651 17.5137 24.0036 17.7535 24.3552C18.3273 25.1966 18.8981 26.0399 19.47 26.8824C19.4898 20.3794 19.5096 13.8765 19.53 7.17647C21.1511 7.17647 22.7722 7.17647 24.4424 7.17647C24.4424 17.0182 24.4424 26.86 24.4424 37C23.019 37 21.5956 37 20.129 37C19.8929 36.6909 19.749 36.4996 19.5899 36.1765C19.4879 36.0125 19.3795 35.8529 19.2711 35.693C19.2395 35.646 19.2079 35.599 19.1753 35.5506C19.0716 35.3963 18.9675 35.2423 18.8635 35.0882C18.7912 34.9809 18.719 34.8736 18.6468 34.7662C18.4972 34.5439 18.3475 34.3217 18.1978 34.0995C17.8774 33.6238 17.5579 33.1476 17.2386 32.6711C17.143 32.5285 17.0473 32.3859 16.9515 32.2433C16.8926 32.1554 16.8336 32.0675 16.7747 31.9795C16.7486 31.9407 16.7225 31.9019 16.6956 31.8619C16.5178 31.5965 16.3467 31.3284 16.1751 31.0588C16.1553 33.0194 16.1356 34.98 16.1152 37C14.0592 37 12.0031 37 9.88479 37C9.88957 36.543 9.89434 36.086 9.89926 35.6151C9.91371 34.1454 9.92186 32.6758 9.92614 31.206C9.92681 30.9769 9.92754 30.7479 9.9283 30.5188C9.92846 30.4732 9.92861 30.4276 9.92876 30.3806C9.93132 29.6466 9.93831 28.9126 9.947 28.1786C9.95585 27.4229 9.95979 26.6673 9.95937 25.9116C9.95927 25.4881 9.96132 25.0649 9.969 24.6415C10.0011 22.8064 10.0179 21.3031 8.71746 19.8771C8.49413 19.6233 8.31583 19.346 8.1353 19.062C8.07383 18.9699 8.01217 18.8779 7.95019 18.7861C7.92097 18.7425 7.89175 18.699 7.86165 18.6541C7.8013 18.5642 7.74094 18.4742 7.68058 18.3843C7.5037 18.1208 7.32706 17.8572 7.15096 17.5932C7.09617 17.5111 7.0413 17.4291 6.98636 17.3471C6.90914 17.2317 6.83229 17.1161 6.75554 17.0005C6.73253 16.9662 6.70952 16.9319 6.6858 16.8967C6.52995 16.6605 6.52995 16.6605 6.52995 16.5294C6.49041 16.5294 6.45088 16.5294 6.41014 16.5294C6.41014 23.2847 6.41014 30.04 6.41014 37C4.8088 37 3.20747 37 1.5576 37C1.5576 27.1388 1.5576 17.2776 1.5576 7.11765C3.07986 7.11765 4.60212 7.11765 6.17051 7.11765C6.70035 7.83299 6.70035 7.83299 6.90438 8.16544C7.19782 8.63551 7.50936 9.09344 7.82172 9.55147C8.26266 10.1982 8.69989 10.8472 9.13257 11.4993C9.17121 11.5575 9.20986 11.6158 9.24968 11.6758C9.28284 11.7259 9.31599 11.7759 9.35016 11.8275C9.50709 12.0623 9.66622 12.2957 9.82489 12.5294C9.84465 10.2776 9.86442 8.02588 9.88479 5.70588C6.62281 5.70588 3.36083 5.70588 0 5.70588C0 3.82294 0 1.94 0 0Z"
                                        fill="white"
                                    />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    v-if="boost.multiplier"
                                    class="leading-none text-white"
                                >
                                    {{ boost.multiplier }}
                                </p>
                                <p
                                    v-if="boost.profitPerHour"
                                    class="leading-none text-white text-base"
                                >
                                    {{ $t("boost.profit_per_hour") }}
                                    {{ boost.profitPerHour }}
                                </p>
                                <p
                                    v-else-if="boost.hours"
                                    class="leading-none text-white"
                                >
                                    {{ boost.hours }}
                                    {{ $t("boost.hours") }}
                                </p>

                                <span
                                    v-if="boost.multiplier"
                                    class="opacity-60 text-lg leading-none"
                                >
                                    Gives {{ boost.multiplier }}x energy
                                </span>
                            </div>
                        </div>
                        <div>
                            <button
                                v-if="boost.user_lvl"
                                @click="buyBoost(selectedTab)"
                                class=" price-btn"
                            >
                                {{ boost.cost }}
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<style scoped></style>
