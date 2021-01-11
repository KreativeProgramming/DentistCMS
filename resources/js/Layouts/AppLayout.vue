<template>
  <div class="w-full h-full">
    <sidebar />
    <div class="relative md:ml-64 bg-white">
      <div class="invisible md:visible bg-blue-600 w-full h-20">
        <admin-navbar />
      </div>
      <div class="container mx-auto">
        <div
          v-show="$page.props.flash.success"
          class="bg-green-300 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 ml-3 mr-3"
          role="alert"
        >
          <strong class="font-bold">Success!</strong>
          <span class="block sm:inline">{{ $page.props.flash.success }}.</span>
        </div>
        <div
          v-show="$page.props.flash.error"
          class="bg-red-400 border border-red-600 text-red-700 px-4 py-3 rounded relative mt-3 ml-3 mr-3"
          role="alert"
        >
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline">{{ $page.props.flash.error }}.</span>
        </div>
        <slot></slot>
      </div>
      <div class="mt-auto"><footer-admin /></div>
    </div>
  </div>
</template>
<script>
import AdminNavbar from "./../components/Navbars/AdminNavbar.vue";
import Sidebar from "./../components/Sidebar/Sidebar.vue";
import HeaderStats from "./../components/Headers/HeaderStats.vue";
import FooterAdmin from "./../components/Footers/FooterAdmin.vue";
export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
    HeaderStats,
    FooterAdmin,
  },
};
</script>

