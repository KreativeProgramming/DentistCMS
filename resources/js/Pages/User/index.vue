<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table :users="users" :roles="roles" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import CardTable from "./CardTable.vue";

export default {
  props: ["sessions", "users", "roles"],

  components: {
    AppLayout,
    CardTable,
  },
};
</script>

