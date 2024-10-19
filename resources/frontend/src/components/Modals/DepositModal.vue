<script setup>
import { ref, onMounted, watch, defineProps } from "vue";
import User from "../../api/User/user";

const user = ref(null);
const currentPrice = ref(0);
const settings = ref(null);
const props = defineProps({
    price: {
        type: Number,
        required: true,
    },
});
watch(
    () => props.price,
    (newPrice) => {
        currentPrice.value = newPrice;
    }
);

onMounted(async () => {
    await User.getUser();
    User.transactionCheck();
    user.value = User;
    settings.value = await User.getSettings();
    currentPrice.value = props.price;
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
}
</script>

<template>
    <div id="DepositModal" class="modal">
        <div class="flex flex-col relative gap-6">
            <div class="flex flex-col gap-2">
                <h1 class="text-xl text-white">
                    {{ $t("deposit.title") }}
                </h1>
                <p class="text-sm text-white/50">
                    {{ $t("deposit.description") }}
                </p>
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-base text-white" for="deposit-address">
                    {{ $t("deposit.address") }}
                </label>
                <div class="flex gap-2 w-full items-center">
                    <div
                        class="border btn px-3 py-1 flex-1 text-sm border-white/10 text-white/50"
                    >
                        <input
                            type="text"
                            class="w-full"
                            readonly
                            :value="settings?.address_ton"
                        />
                    </div>
                    <button
                        class="border btn px-3 py-3 active:bg-green-300 border-white/10 text-white/50"
                        @click="copyToClipboard(settings?.address_ton)"
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
                                ></path>
                                <path
                                    d="M5.5 15H4.5C3.96957 15 3.46086 14.7893 3.08579 14.4142C2.71071 14.0391 2.5 13.5304 2.5 13V4C2.5 3.46957 2.71071 2.96086 3.08579 2.58579C3.46086 2.21071 3.96957 2 4.5 2H13.5C14.0304 2 14.5391 2.21071 14.9142 2.58579C15.2893 2.96086 15.5 3.46957 15.5 4V5"
                                    stroke="white"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-base text-white" for="deposit-comment">
                    {{ $t("deposit.comment") }}
                </label>
                <div class="flex gap-2 w-full items-center">
                    <div
                        class="border btn px-3 py-1 flex-1 text-sm border-white/10 text-white/50"
                    >
                        <input
                            type="text"
                            class="w-full"
                            readonly
                            :value="user?.id"
                        />
                    </div>
                    <button
                        class="border btn px-3 py-3 active:bg-green-300 border-white/10 text-white/50"
                        @click="copyToClipboard(user?.id)"
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
                                ></path>
                                <path
                                    d="M5.5 15H4.5C3.96957 15 3.46086 14.7893 3.08579 14.4142C2.71071 14.0391 2.5 13.5304 2.5 13V4C2.5 3.46957 2.71071 2.96086 3.08579 2.58579C3.46086 2.21071 3.96957 2 4.5 2H13.5C14.0304 2 14.5391 2.21071 14.9142 2.58579C15.2893 2.96086 15.5 3.46957 15.5 4V5"
                                    stroke="white"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-base text-white" for="deposit-amount">
                    {{ $t("deposit.amount") }}
                </label>
                <div class="flex gap-2 w-full items-center">
                    <div
                        class="border btn px-3 py-1 flex-1 text-sm border-white/10 text-white/50"
                    >
                        <input
                            type="text"
                            class="w-full"
                            readonly
                            :value="currentPrice"
                        />
                    </div>
                    <button
                        class="border btn px-3 py-3 active:bg-green-300 border-white/10 text-white/50"
                        @click="copyToClipboard(currentPrice)"
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
                                ></path>
                                <path
                                    d="M5.5 15H4.5C3.96957 15 3.46086 14.7893 3.08579 14.4142C2.71071 14.0391 2.5 13.5304 2.5 13V4C2.5 3.46957 2.71071 2.96086 3.08579 2.58579C3.46086 2.21071 3.96957 2 4.5 2H13.5C14.0304 2 14.5391 2.21071 14.9142 2.58579C15.2893 2.96086 15.5 3.46957 15.5 4V5"
                                    stroke="white"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <button
                class="btn bg-blue w-full close-DepositModal text-sm text-white"
            >
                {{ $t("buttons.close") }}
            </button>
        </div>
    </div>
</template>

<style scoped></style>
