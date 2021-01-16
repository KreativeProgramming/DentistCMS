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
      class="bg-white text-base z-50 float-left list-none text-left rounded-md  shadow-lg w-72"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
    <div class="bg-blue-500 h-8 rounded-t-md  text-white text-center flex items-center"> <span class="mx-auto align-middle">Njoftimet</span></div>
      <ul class="text-base sm:text-sm">
        <li v-if="notifications.length == 0" class="text-gray-900 flex cursor-default border-b border-gray-400 shadow-sm select-none relative py-1 px-2">
           <p class="mx-auto">Nuk ka njoftime.</p>
        </li>
        <li class="text-gray-900 flex cursor-default border-b border-gray-400 shadow-sm select-none text-sm font-bold relative  pl-2" v-for="not in notifications" :key="not.id">
          <div class=" w-5/6 pr-1 py-1">
            {{ not.description }}
            <span class="text-xs text-gray-500 block opacity-50">{{not.date}}</span>
          </div>
          <div class="w-1/6 ">
            <button class=" w-full h-full inline-flex justify-center border-l focus:ring-1 focus:ring-inset focus:ring-blue-500 border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none  sm:text-sm" @click="markAsRead(not)"><i  class="fa fa-times my-auto text-blue-500"></i></button>
          </div>
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
    markAsRead (notification){
       this.$inertia.put(this.route('notification.markAsRead', notification.id))
    },
  },
};
</script>
