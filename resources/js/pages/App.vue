<script setup>
import Cart from '@/components/Cart.vue';
import Product from '@/components/Product.vue';

defineProps({
    products: Object,
    cart: Object,
});
</script>

<template>
    <div class="max-w-8xl mx-auto grid gap-8 bg-rose-50 px-4 py-16 sm:px-6 md:grid-cols-[1fr_400px] lg:px-8">
        <main>
            <h1 class="text-5xl font-bold">Desserts</h1>
            <ul class="mt-10 grid gap-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                <Product v-for="product in products" :product :cart />
            </ul>
        </main>
        <Cart :cart />
    </div>
</template>
