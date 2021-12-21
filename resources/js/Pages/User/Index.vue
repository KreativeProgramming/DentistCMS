<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
       <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >

    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <h3 class="font-semibold text-lg text-gray-800 inline mr-auto">Përdoruesit</h3>
        <Link :href="route('user.create')" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
              Krijo
         </Link>
      </div>
        <search-filter v-model="searchForm.search" class=" max-w-sm mr-auto inline">
                <select v-model="searchForm.trashed"    class="px-3 py-1 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full mr-1">
                <option :value="null" >Filtro</option>
                <option value="with">Edhe të fshirë</option>
                <option value="only">Vetëm të fshirë &nbsp;</option>
                </select>
            </search-filter>
    </div>
    <div class="block w-full pb-3">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs bg-gray-100 text-gray-600 border-gray-200 uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Emri Mbiemri
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              E-mail
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Pozita
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users.data" :key="user.id">
            <th
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left flex items-center"
            >
              <img
                :src="user.profile_photo_url"
                class="h-12 w-12 bg-white rounded-full border-2 object-cover"
                :style="{ borderColor: user.color }"
                alt="..."
              />
              <span class="ml-3 text-sm font-bold text-gray-700">
                {{ user.name }} <i v-if="user.deleted_at !== null" class="fa fa-trash text-red-500"></i>
              </span>
            </th>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
             <div class="text-sm font-bold text-gray-700">{{ user.email }}</div>
              
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
             <div class="text-sm font-bold text-gray-700">{{ user.role.name }}</div>
          
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-right"
            >
            <Link v-if="user.deleted_at === null" :href="route('user.edit',user.id)" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Ndrysho
              </Link>
              <div v-else>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-1 sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="restore(user)"
              >
                Rikthe
              </button>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500  sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="deletePermn(user)"
              >
                Fshij
              </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
       
      <pagination :links="users.links" />
    </div>
  </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import Pagination from "./../../components/Pagination/Pagination.vue";
import SearchFilter from "./../../components/Search/SearchFilter.vue";
import NavLink from "@/Jetstream/NavLink.vue";
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import { Link } from '@inertiajs/inertia-vue';

export default {
   metaInfo: { title: 'Përdoruesit' },
  components: {
    SearchFilter,
    Pagination,
    NavLink,
    AppLayout,
    Link,
  },
   props: {
    users: Object,
    roles: Array,
    filters: Object,
  },
  data() {
    return {
      searchForm:{
            search: this.filters.search,
            trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    searchForm: {
      handler: throttle(function() {
        let query = pickBy(this.searchForm)
        this.$inertia.replace(this.route('user.index', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods:{ 
    restore(data) {
      if (confirm('A jeni i sigurtë që dëshironi të riktheni përdoruesin?')) {
        this.$inertia.put(this.route('user.restore', data.id))
      }
    },
      deletePermn(data) {
      if (confirm('A jeni i sigurtë që dëshironi të fshini përdoruesin përgjithmonë?')) {
        this.$inertia.put(this.route('user.delete', data.id))
      }
    },
  }
};
</script>

