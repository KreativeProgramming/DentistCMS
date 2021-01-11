<template>
  <div>
    <a
      class="text-gray-600 block"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full"
        >
          <img
            alt="..."
            class="w-full h-full object-cover rounded-full align-middle border-none shadow-lg"
            :src="$page.props.user.profile_photo_url"
          />
        </span>
      </div>
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>

      <jet-responsive-nav-link :href="route('profile.show')">
        Profile
      </jet-responsive-nav-link>

      <!-- Authentication -->
      <form @submit.prevent="logout">
        <jet-responsive-nav-link as="button"> Logout </jet-responsive-nav-link>
      </form>
    </div>
  </div>
</template>

<script>
import { createPopper } from "@popperjs/core";

import JetResponsiveNavLink from "./../../Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetResponsiveNavLink,
  },
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
     logout() 
     {
                this.$inertia.post(route('logout'));
            },
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
