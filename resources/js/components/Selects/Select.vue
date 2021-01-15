<template>
  <div>
  <div class="relative">
    <slot ref="btnDropdownRef"  name="inputs"></slot>
    <div 
      ref="popoverDropdownRef"
      v-bind:class="{
        hidden: !dropdown,
        block: dropdown,
      }"
      class="bg-white border-0 mr-3 block z-50 font-normal leading-normal text-sm w-full text-left no-underline break-words rounded-lg">
        <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
          <slot name="lists"></slot>
      </ul>
    </div>
  </div>      
  </div>
</template>

<script>
import { createPopper } from "@popperjs/core";

export default {
  props:["dropdown"],
  
  methods: {
    toggleDropdown: function (event) {
      event.preventDefault();
      if (dropdown) {
        dropdown = false;
      } else {
        dropdown = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
};
</script>
