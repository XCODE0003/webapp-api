<script setup>
import { ref, computed, onMounted } from "vue";
import FortuneWheel from "vue-fortune-wheel";
import "../assets/css/spin.css";
import User from "../api/User/user";
import Modal from "../modal/index";
import DepositModal from "../components/Modals/DepositModal.vue";
const prizeId = ref(0);
const user = ref(User);
const balance_donat = ref(0);
const freeSpins = ref(user.value.free_spins);

onMounted(async () => {
    await User.getUser();
    freeSpins.value = user.value.free_spins;
    balance_donat.value = user.value.balance_donat;
});

const wheelEl = ref();
const canvasVerify = ref(false);
const verifyDuration = 2;
const canvasOptions = {
    btnWidth: 50,
    borderWidth: 1,
    lineHeight: 24,
    textDirection: "vertical",
    fontSize: 28,
};
const prizesCanvas = [
    {
        id: 1,
        name: "2500",
        value: "2500",
        bgColor: "#1D1F24",
        color: "#ffffff",
        probability: 25,
    },
    {
        id: 2,
        name: "10000",
        value: "10000",
        bgColor: "#22252B",
        color: "#ffffff",
        probability: 15,
    },
    {
        id: 3,
        name: "40000",
        value: "40000",
        bgColor: "#1D1F24",
        color: "#ffffff",
        probability: 8,
    },
    {
        id: 4,
        name: "160000",
        value: "160000",
        bgColor: "#22252B",
        color: "#ffffff",
        probability: 1.95,
    },
    {
        id: 5,
        name: "???",
        value: "jackpot",
        bgColor: "#1D1F24",
        color: "#ffffff",
        probability: 0.05,
    },
    {
        id: 6,
        name: "2500",
        value: "2500",
        bgColor: "#22252B",
        color: "#ffffff",
        probability: 25,
    },
    {
        id: 7,
        name: "10000",
        value: "10000",
        bgColor: "#1D1F24",
        color: "#ffffff",
        probability: 15,
    },
    {
        id: 8,
        name: "40000",
        value: "40000",
        bgColor: "#22252B",
        color: "#ffffff",
        probability: 8,
    },
    {
        id: 9,
        name: "160000",
        value: "160000",
        bgColor: "#1D1F24",
        color: "#ffffff",
        probability: 1.95,
    },
    {
        id: 10,
        name: "???",
        value: "jackpot",
        borderColor: "#ffffff",
        borderWidth: 5,
        bgColor: "#22252B",
        color: "#ffffff",
        probability: 0.05,
    },
];

function testRequest(verified, duration) {
    // verified: прошла ли верификация, duration: время задержки
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve(verified);
        }, duration);
    });
}

function onCanvasRotateStart(rotate) {
    if (user.value.free_spins <= 0 && user?.balance_donat < 300) {
        alert("У вас нет бесплатных вращений или нет денег на балансе");
        return;
    }
    if (canvasVerify.value) {
        const verified = true; // true: тест прошел верификацию, false: тест не прошел верификацию
        testRequest(verified, verifyDuration * 1000).then((verifiedRes) => {
            if (verifiedRes) {
                console.log("Верификация пройдена, начинаем вращение");
                rotate(); // Вызов обратного вызова, начало вращения
                canvasVerify.value = false; // Выключение режима верификации
            } else {
                alert("Верификация не пройдена");
            }
        });
        return;
    }
    console.log("Начало вращения в режиме canvas");
}

async function onRotateEnd(prize) {
    await User.spin(prize.name);
    await User.getUser();
    freeSpins.value = user.value.free_spins;
    balance_donat.value = user.value.balance_donat;
}

function onChangePrize(id) {
    prizeId.value = id;
}
</script>

<template>
    <div class="min-h-screen flex flex-col gap-9 mb-32">
        <main class="flex-col mx-auto container items-center w-full gap-9 justify-center flex">
            <div id="menu"
                class="h-full p-3 user-select-none w-full bg-dark cursor-pointer flex items-center justify-between rounded-lg gap-3.5">
                <div class="flexflex-col gap-1">
                    <p class="text-sm">{{ $t("other.monet") }}:</p>
                    <h2 class="text-xl text-white">
                        {{ balance_donat }}
                    </h2>
                </div>
                <RouterLink to="/shop" class="btn bg-blue open-DepositModal text-lg px-3 py-1">
                    {{ $t("buttons.deposit") }}
                </RouterLink>
            </div>
            <FortuneWheel style="width: 390px; max-width: 100%" ref="wheelEl" :verify="canvasVerify"
                :canvas="canvasOptions" :prizes="prizesCanvas" :disabled="freeSpins <= 0 && user?.balance_donat < 300"
                @rotateStart="onCanvasRotateStart" @rotateEnd="onRotateEnd" />
            <div class="flex w-full flex-col gap-4">
                <button @click="wheelEl.startRotate()" :disabled="freeSpins <= 0 && user?.balance_donat < 300"
                    class="btn bg-blue">
                    {{ $t("spin.spin") }}
                </button>
                <p class="mx-auto">
                    {{ $t("spin.description_1") }}
                    {{ freeSpins }}
                    {{ $t("spin.description_2") }}
                </p>
                <p class="mx-auto text-lg text-white">
                    {{ $t("spin.price_one_spin") }}:
                    <span class="text-blue">300</span>
                </p>
            </div>
        </main>
    </div>
    <DepositModal />
</template>

<style scoped></style>
