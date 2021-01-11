<template>
  <div
    class="text-white px-6 py-4 mt-3 mr-3 ml-3 border-0 rounded relative mb-4 bg-green-500"
  >
    <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-check"></i>
    </span>
    <span class="inline-block align-middle mr-8">
      <b class="capitalize">Success!</b> <slot></slot>
    </span>
  </div>
</template>

<script>
export default {
  name: "green-alert",
};
</script>

