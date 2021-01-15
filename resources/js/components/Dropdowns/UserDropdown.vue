<template>
  <div>
   <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
      <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
   </button>
   <span v-else class="inline-flex rounded-md">
      <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
          {{ $page.props.user.name }}
          <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
      </button>
   </span>
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
