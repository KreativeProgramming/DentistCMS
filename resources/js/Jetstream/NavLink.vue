<template>
    <Link :href="href" :class="classes">
        <slot></slot>
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue';

    export default {
        props: ['href', 'active'],
        components: {
            Link
        },
        computed: {
            classes() {
                return this.active
                        ? "text-xs uppercase py-3 font-bold block text-blue-500 hover:text-blue-600"
                        : "text-xs uppercase py-3 font-bold block text-gray-800 hover:text-gray-600";
            }
        }
    }
</script>
