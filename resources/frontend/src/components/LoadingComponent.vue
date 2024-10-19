<script setup>
const props = defineProps({
    value: {
        required: true,
    },
});
</script>

<template>
    <div v-if="value || value === 0">
        {{ value }}
    </div>
    <div v-else>
        <div class="loader"></div>
    </div>
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
