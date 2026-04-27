<script setup>
import { computed } from 'vue';
import { formatPrice } from '@/helpers';
import IconDelete from '@/components/icons/Delete.vue';
import IconTree from '@/components/icons/Tree.vue';
import { Form } from '@inertiajs/vue3';
import { removeAll } from '@/routes/cart';
import CartConfirmation from '@/components/CartConfirmation.vue';

const props = defineProps({
    cart: Object,
});

const totalPricePerItem = (item) => item.quantity * item.product.price_cents;

const totalCart = computed(() => {
    if (!props.cart.items) return 0;

    const subtotals = props.cart.items.map((item) => item.quantity * item.product.price_cents);

    return subtotals.reduce((a, c) => a + c, 0);
});
</script>

<template>
    <div class="flex flex-col gap-8">
        <ul class="mt-2">
            <li
                v-for="item in cart.items"
                class="flex items-center justify-between gap-4 border-b border-rose-100 py-4"
            >
                <div>
                    <h2 class="font-medium">{{ item.product.name }}</h2>
                    <div class="mt-1 flex gap-2">
                        <span class="text-red mr-2 font-medium">{{ item.quantity }}x</span>
                        <span class="text-rose-500">{{ formatPrice(item.product.price_cents) }}</span>
                        <span class="font-medium text-rose-500">{{ formatPrice(totalPricePerItem(item)) }}</span>
                    </div>
                </div>
                <Form v-bind="removeAll.form(item.id)" :options="{ preserveScroll: true }">
                    <button class="rounded-full border border-rose-400 p-0.75" type="submit">
                        <IconDelete class="size-3 rounded-full text-rose-400" />
                    </button>
                </Form>
            </li>
        </ul>

        <div class="flex items-center justify-between gap-4">
            <p>Order Total</p>
            <p class="text-2xl font-bold">{{ formatPrice(totalCart) }}</p>
        </div>

        <div class="flex items-center justify-center gap-2 rounded-lg bg-rose-50 p-4">
            <IconTree class="text-green size-6" />
            <p>This is a <span class="font-bold">carbon-neutral</span> delivery</p>
        </div>

        <button
            popovertarget="order-confirmation"
            class="bg-red hover:bg-red-dark rounded-full px-6 py-4 font-medium text-white transition"
        >
            Confirm Order
        </button>

        <CartConfirmation :cart />
    </div>
</template>
