<template>
  <div class="flex items-center">
    <div class="flex bg-white">
          <slot />
      <input class="px-3 py-1 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full" autocomplete="off" type="text" name="search" placeholder="Kërko…" :value="value" @input="$emit('input', $event.target.value)">
    </div>
   
  </div>
</template>

<script>
export default {
  props: {
    value: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
}
</script>
