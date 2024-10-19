<script setup>
import Footer from "./components/footer.vue";
import Header from "./components/Header.vue";
import User from "./api/User/user.js";
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";

const user = ref(User);
const route = useRoute();
const activeRouteLink = computed(() => route.path);

onMounted(async () => {
    await User.getUser();
});
</script>

<template>
    <Header
        v-if="activeRouteLink !== '/loading'"
        class="container m-auto pb-10"
        :user="user"
    />
    <router-view class="mb-48" v-slot="{ Component }">
        <transition name="fade">
            <component :is="Component" />
        </transition>
    </router-view>
    <Footer />
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
