<script setup>
import Header from "../components/Header.vue";

import { onMounted, ref } from "vue";

import User from "../api/User/user.js";

const referrals_users = ref(null);
const referral_link = ref(null);
const share_link = ref(false);
onMounted(async () => {
    const bot_username = import.meta.env.VITE_BOT_USERNAME;
    await User.getUser();
    referral_link.value = "https://t.me/" + bot_username + "?start=" + User.id;
    share_link.value = "https://t.me/share/url?url=" + referral_link.value;
    referrals_users.value = await User.getReferrals();
});

function copyLink() {
    navigator.clipboard.writeText(referral_link.value);
}
</script>

<template>
    <div class="min-h-screen flex flex-col gap-9">
        <main
            class="flex-col mx-auto container items-center w-full gap-9 justify-center flex"
        >
            <section
                class="p-1.5 text-base justify-center rounded-md text-white w-full flex"
            >
                <p class="text-lg">
                    {{ $t("referral.invited_all_description_1") }}
                    <span class="text-blue">25%</span>
                    {{ $t("referral.invited_all_description_2") }}
                </p>
            </section>
            <section class="flex gap-2 w-full items-center">
                <a
                    :href="share_link"
                    class="border btn text-center flex-1 border-white/10 text-white/50"
                >
                    {{ $t("referral.share_link") }}
                </a>
                <button
                    @click="copyLink()"
                    class="border btn px-3.5 py-3.5 active:bg-green-300 border-white/10 text-white/50"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="24"
                        viewBox="0 0 25 24"
                        fill="none"
                    >
                        <g opacity="0.5">
                            <path
                                d="M20.5 9H11.5C10.3954 9 9.5 9.89543 9.5 11V20C9.5 21.1046 10.3954 22 11.5 22H20.5C21.6046 22 22.5 21.1046 22.5 20V11C22.5 9.89543 21.6046 9 20.5 9Z"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5.5 15H4.5C3.96957 15 3.46086 14.7893 3.08579 14.4142C2.71071 14.0391 2.5 13.5304 2.5 13V4C2.5 3.46957 2.71071 2.96086 3.08579 2.58579C3.46086 2.21071 3.96957 2 4.5 2H13.5C14.0304 2 14.5391 2.21071 14.9142 2.58579C15.2893 2.96086 15.5 3.46957 15.5 4V5"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </g>
                    </svg>
                </button>
            </section>

            <section class="flex flex-col gap-6 w-full">
                <div v-for="user in referrals_users" class="task-container">
                    <div class="flex items-center gap-3.5">
                        <img
                            :src="user.avatar"
                            class="h-12 rounded-full"
                            alt=""
                            srcset=""
                        />

                        <div class="flex flex-col gap-1">
                            <p class="leading-none text-white">
                                {{ user.firstName }}
                            </p>
                            <span class="opacity-60 text-lg leading-none">{{
                                user.id
                            }}</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<style scoped></style>
