<template>
  <nav
    class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
  >
    <div
      class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
    >
      <!-- Toggler -->
      <button
        class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
        type="button"
        v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Brand -->
      <inertia-link
        :href="route('dashboard')"
        class="md:block text-left md:pb-1 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold px-0"
      >
        <jet-application-mark />
      </inertia-link>
      <!-- User -->
      <ul class="md:hidden items-center flex flex-wrap list-none">
        <li class="inline-block relative mr-1">
          <notification-dropdown :notifications="$page.props.notifications" />
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
      <!-- Collapse -->
      <div
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
        v-bind:class="collapseShow"
      >
        <!-- Collapse header -->
        <div
          class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300"
        >
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <a
                class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
                to="/"
              >
                {{ $page.props.app.name }}
              </a>
            </div>
            <div class="w-6/12 flex justify-end">
              <button
                type="button"
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                v-on:click="toggleCollapseShow('hidden')"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-6 mb-4 md:hidden">
          <div class="mb-3 pt-0">
            <input
              type="text"
              placeholder="Search"
              class="px-3 py-2 h-12 border border-solid border-gray-600 placeholder-gray-400 text-gray-700 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
            />
          </div>
        </form>

        <!-- Divider -->
        <hr class="mt-1 mb-2 md:min-w-full" />
        <!-- Heading -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <li class="items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              <i class="fas fa-tachometer-alt mr-2 text-sm"></i>
              Kryefaqja
            </jet-nav-link>
          </li>

          <li class="items-center">
            <jet-nav-link
              :href="route('user.index')"
              :active="route().current('user.index') || route().current('user.create') || route().current('user.edit')"
            >
              <i class="fas fa-user-md mr-2 text-sm"></i>
              Përdoruesit
            </jet-nav-link>
          </li>

          <li class="items-center">
            <jet-nav-link
              :href="route('pacient.index')"
              :active="route().current('pacient.index')"
            >
              <i class="fas fa-user mr-2 text-sm"></i>
              Pacientët
            </jet-nav-link>
          </li>

          <li class="items-center">
            <jet-nav-link
              :href="route('appointment.index')"
              :active="route().current('appointment.index')"
            >
              <i class="fas fa-calendar mr-2 text-sm"></i>
              Terminet
            </jet-nav-link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6
          class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
        >
          Auth Layout Pages
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
          <li class="items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-nav-link>
          </li>

          <li class="items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-nav-link>
          </li>
        </ul>

        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6
          class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
        >
          No Layout Pages
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
          <li class="items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-nav-link>
          </li>

          <li class="items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-nav-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
); }

<script>
import NotificationDropdown from "./../Dropdowns/NotificationDropdown.vue";
import UserDropdown from "./../Dropdowns/UserDropdown.vue";
import JetNavLink from "./../../Jetstream/NavLink";
import JetApplicationMark from "./../../Jetstream/ApplicationMark";
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'

export default {
  props: ["notifications"],
  data() {
    return {
      collapseShow: "hidden",
    };
  },
  methods: {
    toggleCollapseShow: function (classes) {
      this.collapseShow = classes;
    },
  },
  components: {
    NotificationDropdown,
    UserDropdown,
    JetNavLink,
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
  },
};
</script>
