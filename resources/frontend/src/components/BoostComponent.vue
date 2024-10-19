<script setup>
import { ref, defineProps } from "vue";
import User from "../api/User/user";
const props = defineProps({
    boost: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
    getSelectedTab: {
        type: Function,
        required: true,
    },
    index: {
        required: true,
    },
    updateUser: {
        type: Function,
        required: true,
    },
    updateBoosts: {
        type: Function,
        required: true,
    },
});

let showBtn = true;
const selectedTab = ref(props.getSelectedTab());
if (selectedTab.value === "lvlTap") {
    console.log(props.index + " - " + props.boost?.user_lvl);
    showBtn = props.index == props.boost?.user_lvl;
} else if (selectedTab.value === "lvlAutobot") {
    showBtn =
        props.user.autobot_level < props.index &&
        props.index - props.user.autobot_level <= 1;
} else if (selectedTab.value === "lvlRecharging") {
    showBtn =
        props.user.recharging_level < props.index &&
        props.index - props.user.recharging_level <= 1;
}
</script>

<template></template>

<style scoped></style>
