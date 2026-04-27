<script setup>
import { computed } from 'vue';
import AddToCart from '@/components/icons/AddToCart.vue';
import { Form } from '@inertiajs/vue3';
import { addOne, removeOne } from '@/routes/cart';
import { formatPrice } from '@/helpers';

const props = defineProps({
    product: Object,
    cart: Object,
});

const quantity = computed(() => {
    if (!props.cart) return 0;

    if (!props.cart.items) return 0;

    const filtered = props.cart.items.filter((item) => item.product_id === props.product.id);

    return filtered.length > 0 ? filtered[0].quantity : 0;
});

const getImageUrl = (name) => new URL(`/resources/images/${name}`, import.meta.url).href;
</script>

<template>
    <li>
        <article>
            <img
                class="aspect-square rounded-xl object-cover"
                :class="{ 'border-red border-2': quantity > 0 }"
                :src="getImageUrl(product.image)"
                :alt="`Photo of ${product.name}`"
            />

            <div
                v-if="quantity"
                class="bg-red mx-auto flex w-48 -translate-y-1/2 items-center justify-center gap-4 rounded-full px-3 py-3 text-white"
            >
                <!-- route('cart.removeOne', product) -->
                <Form v-bind="removeOne.form(product.id)" :options="{ preserveScroll: true }">
                    <button class="group rounded-full border-2 border-white p-1 hover:bg-white" type="submit">
                        <svg
                            class="group-hover:text-red size-2.5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 2"
                        >
                            <path fill="currentColor" d="M0 .375h10v1.25H0V.375Z" />
                        </svg>
                    </button>
                </Form>
                <span class="flex-1 text-center">{{ quantity }}</span>
                <!-- route('cart.addOne', product) -->
                <Form v-bind="addOne.form(product.id)" :options="{ preserveScroll: true }">
                    <button class="group rounded-full border-2 border-white p-1 hover:bg-white" type="submit">
                        <svg
                            class="group-hover:text-red size-2.5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 10"
                        >
                            <path
                                fill="currentColor"
                                d="M10 4.375H5.625V0h-1.25v4.375H0v1.25h4.375V10h1.25V5.625H10v-1.25Z"
                            />
                        </svg>
                    </button>
                </Form>
            </div>
            <!-- route('cart.addOne', product) -->
            <Form
                v-bind="addOne.form(product.id)"
                :options="{ preserveScroll: true }"
                v-else
                class="flex -translate-y-1/2 justify-center"
            >
                <button
                    class="hover:border-red hover:text-red flex items-center gap-2 rounded-full border border-rose-500 bg-white px-8 py-3 font-medium"
                    type="submit"
                >
                    <AddToCart />
                    <span>Add to Cart</span>
                </button>
            </Form>
            <p class="mt-4 text-rose-500">{{ product.category }}</p>
            <h2 class="text-lg font-medium">{{ product.name }}</h2>
            <p class="text-red font-medium">{{ formatPrice(product.price_cents) }}</p>
        </article>
    </li>
</template>
