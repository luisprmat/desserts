<script setup>
import IconConfirmation from '@/components/icons/Confirmation.vue';
import { formatPrice } from '../helpers';
import { computed } from 'vue';
import { Form } from '@inertiajs/vue3';
import { emptyCart } from '@/routes/cart';

const props = defineProps({
    cart: Object,
});

const totalPricePerItem = (item) => item.quantity * item.product.price_cents;

const totalCart = computed(() => {
    if (!props.cart.items) return 0;

    const subtotals = props.cart.items.map((item) => item.quantity * item.product.price_cents);

    return subtotals.reduce((a, c) => a + c, 0);
});

const getImageUrl = (name) => new URL(`/resources/images/${name}`, import.meta.url).href;
</script>

<template>
    <div
        class="m-auto max-h-[calc(100dvh-2rem)] w-120 max-w-full translate-y-1 rounded-lg bg-white p-8 opacity-0 transition-discrete duration-200 backdrop:bg-black/50 backdrop:opacity-0 backdrop:backdrop-blur-sm backdrop:transition-[opacity,display] open:flex open:translate-y-0 open:flex-col open:gap-6 open:opacity-100 open:backdrop:opacity-100 starting:scale-95 starting:open:opacity-0 starting:open:backdrop:opacity-0"
        popover
        id="order-confirmation"
    >
        <IconConfirmation class="text-green size-12 shrink-0" />
        <div>
            <h2 class="text-4xl font-bold">Order Confirmed!</h2>
            <p class="text-rose-500">We hope you enjoy your food!</p>
        </div>
        <div class="rounded-lg bg-rose-50 px-4">
            <ul>
                <li
                    v-for="item in cart.items"
                    class="flex items-center justify-between gap-4 border-b border-rose-100 py-4"
                >
                    <div class="flex items-center gap-2">
                        <img
                            :src="getImageUrl(item.product.image)"
                            :alt="`Photo of ${item.product.name}`"
                            class="size-12 rounded-md object-cover"
                        />
                        <div>
                            <h2 class="font-medium">{{ item.product.name }}</h2>
                            <div class="mt-1 flex gap-2">
                                <span class="text-red mr-2 font-medium">{{ item.quantity }}x</span>
                                <span class="text-rose-500">{{ formatPrice(item.product.price_cents) }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="text-lg font-medium text-rose-500">{{
                            formatPrice(totalPricePerItem(item))
                        }}</span>
                    </div>
                </li>
            </ul>

            <div class="flex items-center justify-between gap-4 py-6">
                <p>Order Total</p>
                <p class="text-2xl font-bold">{{ formatPrice(totalCart) }}</p>
            </div>
        </div>

        <Form v-bind="emptyCart.form()">
            <button
                class="bg-red hover:bg-red-dark w-full rounded-full px-6 py-4 font-medium text-white transition"
                type="submit"
            >
                Start New Order
            </button>
        </Form>
    </div>
</template>
