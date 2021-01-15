<template>
  <!-- Navbar -->
  <nav
    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center p-4"
  >
    <div
      class="w-full mx-autp items-center flex justify-between md:flex-no-wrap flex-wrap md:px-10 px-4"
    >
      <!-- Form -->
      <form
        class="md:flex hidden flex-row flex-wrap items-center lg:mr-auto mr-3"
      >
        <div class="relative flex w-full flex-wrap items-stretch">
          <span
            class="z-10 h-full leading-snug font-normal text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
          >
            <i class="fas fa-search"></i>
          </span>
          <input
            type="text"
            placeholder="Search here..."
            class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-10"
          />
        </div>
      </form>
      <!-- User -->
      <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
        <li class="inline-block relative mr-1">
          <notification-dropdown :color="true" :notifications="$page.props.notifications" />
        </li>
        <li class="inline-block relative">
           <jet-dropdown align="right" width="48">
              <template #trigger>
                  <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                      <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" />
                  </button>

                  <span v-else class="inline-flex rounded-md">
                      <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                          {{ $page.props.auth.user.name }}

                          <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                      </button>
                  </span>
              </template>

              <template #content>
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                      Manage Account
                  </div>

                  <jet-dropdown-link :href="route('profile.show')">
                      Profile
                  </jet-dropdown-link>

                  <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                      API Tokens
                  </jet-dropdown-link>

                  <div class="border-t border-gray-100"></div>

                  <!-- Authentication -->
                  <form @submit.prevent="logout">
                      <jet-dropdown-link as="button">
                          Logout
                      </jet-dropdown-link>
                  </form>
              </template>
            </jet-dropdown>
        </li>
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</template>

<script>
import UserDropdown from "./../Dropdowns/UserDropdown.vue";
import NotificationDropdown from "./../Dropdowns/NotificationDropdown.vue";
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'

export default {
  components: {
    UserDropdown,
    NotificationDropdown,
    JetDropdown,
    JetDropdownLink,
    
  },
};
</script>
