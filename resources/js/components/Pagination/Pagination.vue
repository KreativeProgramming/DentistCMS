<template>
  <div class="mt-6 -mb-1 flex flex-wrap float-right">
    <template v-for="(link, key) in links">
      <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Next' }">{{ link.label }}</div>
      <inertia-link v-else :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-blue-600 focus:text-blue-600" :class="{ 'text-blue-600 border-blue-600': link.active, 'ml-auto': link.label === 'Next' }" :href="link.url">{{ link.label }}</inertia-link>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
}
</script>
