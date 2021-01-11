<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table :pacients="pacients" :filters="filters" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import CardTable from "./CardTable.vue";

export default {
    metaInfo: { title: 'Pacient' },
    props: ["sessions", "pacients","filters"],
    components: {
        AppLayout,
        CardTable,
    },
};
</script>

