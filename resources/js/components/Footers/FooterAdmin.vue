<template>
  <footer class="block py-4">
    <div class="container mx-auto px-4">
      <hr class="mb-4 border-b-1 border-gray-300" />
      <div class="flex flex-wrap items-center text-center">
        <div class="w-full">
          <div class="text-sm text-gray-600 font-semibold py-1 text-center">
            Copyright © {{ date }} | Kreative Programming Team
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>
