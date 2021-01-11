<template>
  <div
    class="text-white px-6 py-4 mt-3 mr-3 ml-3 border-0 rounded relative mb-4 bg-red-500"
  >
    <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-times"></i>
    </span>
    <span class="inline-block align-middle mr-8">
      <b class="capitalize">Error!</b> <slot></slot>
    </span>
  </div>
</template>

<script>
export default {
  name: "red-alert",
};
</script>

