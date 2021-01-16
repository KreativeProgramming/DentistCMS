<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
       <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >

    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <h3 class="font-semibold text-lg text-gray-800 inline mr-auto">Rolet</h3>
       <inertia-link :href="route('role.create')" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
              Krijo
         </inertia-link>
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
              Emri
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Akseset
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Përdoruesit
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="role in roles.data" :key="role.id">
            <th
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left"
            >
               <div  :class="[role.deleted_at === null
                                ? 'text-gray-700'
                                : 'text-red-500',
                            ]" class="text-sm font-bold ">{{ role.name }}</div>
            </th>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
            <div class="text-sm font-bold text-gray-700">
               <span class="border border-gray-400 rounded p-1">
               <i class="fa fa-eye"></i>
               <i v-if="role.viewAccess == 0" class="fa fa-minus-square text-yellow-500"> </i>
               <i v-else-if="role.viewAccess == 1" class="fa fa-check-square  text-green-500"> </i>
               <i v-else class="fa fa-square text-red-500"> </i>
              </span>
                 <span class="border border-gray-400 rounded p-1">
               <i class="fa fa-plus"></i>
               <i v-if="role.createAccess == 0" class="fa fa-minus-square text-yellow-500"> </i>
               <i v-else-if="role.createAccess == 1" class="fa fa-check-square text-green-500"> </i>
               <i v-else class="fa fa-square text-red-500"> </i>
                 </span>
                    <span class="border border-gray-400 rounded p-1">
               <i class="fa fa-pen"></i>
               <i v-if="role.editAccess == 0" class="fa fa-minus-square text-yellow-500"> </i>
               <i v-else-if="role.editAccess == 1" class="fa fa-check-square text-green-500"> </i>
               <i v-else class="fa fa-square text-red-500"> </i>
                    </span>
                       <span class="border border-gray-400 rounded p-1">
               <i class="fa fa-trash"></i>
               <i v-if="role.deleteAccess == 0" class="fa fa-minus-square text-yellow-500"> </i>
               <i v-else-if="role.deleteAccess == 1" class="fa fa-check-square text-green-500"> </i>
               <i v-else class="fa fa-square text-red-500"> </i>
               </span>
              </div>
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
             <div class="text-sm font-bold text-gray-700">{{ role.userNr }}</div>
          
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 "
            >
            <inertia-link v-if="role.deleted_at === null" :href="route('role.edit',role.id)" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Ndrysho
              </inertia-link>
              <div v-else>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-1 sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="restore(role)"
              >
                Rikthe
              </button>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500  sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="deletePermn(role)"
              >
                Fshij
              </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
       
      <pagination :links="roles.links" />
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

export default {
   metaInfo: { title: 'Rolet' },
  components: {
    SearchFilter,
    Pagination,
    NavLink,
    AppLayout,
  },
   props: {
    roles: Object,
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
        this.$inertia.replace(this.route('role.index', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods:{ 
    restore(data) {
      if (confirm('A jeni i sigurtë që dëshironi të riktheni rolin?')) {
        this.$inertia.put(this.route('role.restore', data.id))
      }
    },
      deletePermn(data) {
      if (confirm('A jeni i sigurtë që dëshironi të fshini rolin përgjithmonë?')) {
        this.$inertia.put(this.route('role.delete', data.id))
      }
    },
  }
};
</script>

