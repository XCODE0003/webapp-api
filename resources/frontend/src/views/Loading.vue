<script setup>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import { updateAuthToken } from "../api/Clients/apiAuthClient.js";

const route = useRoute();
const router = useRouter();
const loading = ref(0);
let token = route.query.token;

function startLoading() {
    let interval = setInterval(() => {
        loading.value += 1;
        if (loading.value >= 100) {
            clearInterval(interval);
            router.push({ name: "index" });
        }
    }, 50);
}
startLoading();
if (token) {
    localStorage.setItem("token", token);

    let url = new URL(route.fullPath, window.location.origin);
    let params = new URLSearchParams(url.search);

    params.delete("token");

    let newRoute = url.pathname + "?" + params.toString();

    router.replace(newRoute);
    updateAuthToken(token);
}
</script>

<template>
    <div
        class="flex w-full loading min-h-screen flex-col m-auto container items-center justify-center gap-24"
    >
        <div class="w-full flex items-start justify-center">
            <img src="/assets/img/logo_big.svg" />
        </div>
        <div class="w-full px-5 justify-center items-end">
            <div class="flex justify-center items-center flex-col gap-5">
                Loading {{ loading }}%
                <div class="progress-container w-full">
                    <div
                        :style="{ width: loading + '%' }"
                        class="progress-bar"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
