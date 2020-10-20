<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table
          :appointments="appointments"
          :users="users"
          :pacients="pacients"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import CardTable from "./CardTable.vue";

export default {
  props: ["sessions", "users", "pacients", "appointments"],

  components: {
    AppLayout,
    CardTable,
  },
};
</script>

