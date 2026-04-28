<script setup lang="ts">
import { App } from '@/types';
import { computed } from 'vue';
import CartActive from './CartActive.vue';
import CartEmpty from './CartEmpty.vue';

const props = defineProps<{ cart: App.Models.Cart }>();

const totalItemsCount = computed<number>(() => {
    if (!props.cart) return 0;
    if (!props.cart.items) return 0;
    const items = props.cart.items;
    return items.length > 0 ? items.map((item) => item.quantity).reduce((a, c) => a + c, 0) : 0;
});
</script>

<template>
    <aside>
        <div class="sticky top-2 rounded-xl bg-white p-6">
            <h2 class="text-red text-2xl font-bold">Your Cart ({{ totalItemsCount }})</h2>
            <CartActive :cart v-if="totalItemsCount > 0" />
            <CartEmpty v-else />
        </div>
    </aside>
</template>
