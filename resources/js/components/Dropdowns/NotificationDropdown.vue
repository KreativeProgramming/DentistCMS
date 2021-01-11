<template>
  <div>
    <a
      :class="classes"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <i class="fas fa-bell"></i>

      <span
        id="not-number"
        class="bg-red-700 absolute top-0 right-0 text-white rounded px-1 pt-0 pb-0 text-xs"
        >{{ notifications.length }}</span
      >
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <ul class="list-disc">
        <li v-for="not in notifications" :key="not.id">
          {{ not.description }}
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { createPopper } from "@popperjs/core";

export default {
  props: ["color", "notifications"],

  computed: {
    classes() {
      if (this.color) return "text-white block py-1 px-3";
      else return "text-gray-800 block py-1 px-3";
    },
  },
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
    toggleDropdown: function (event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
};
</script>
