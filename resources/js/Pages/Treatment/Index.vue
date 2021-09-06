<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"  >
       <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
            <h3 class="font-semibold text-lg text-gray-800 mr-auto ">Trajtimet</h3><br>
       <inertia-link :href="route('treatment.create')" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
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
    <div class="block w-full">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs bg-gray-100 text-gray-600 border-gray-200 uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Pacienti
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Data e Fillimit
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Zgjatja
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="treatment in treatments.data" :key="treatment.id">
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              <div class="flex items-center">
                      <svg :class="[
                                        treatment.pacient.deleted_at === null
                                         ? 'border-gray-700'
                                          : 'border-red-500',
                                      ]"  v-if="treatment.pacient.gender == 'F'" class="h-12 w-12 bg-white rounded-full border-2 object-cover " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                        <path style="fill: #374151; stroke-width: 0.683348" d="M128 0c35.346 0 64 28.654 64 64s-28.654 64-64 64c-35.346 0-64-28.654-64-64S92.654 0 128 0m119.283 354.179l-48-192A24 24 0 0 0 176 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H80a24 24 0 0 0-23.283 18.179l-48 192C4.935 369.305 16.383 384 32 384h56v104c0 13.255 10.745 24 24 24h32c13.255 0 24-10.745 24-24V384h56c15.591 0 27.071-14.671 23.283-29.821z"/></svg>
                     <svg :class="[
                                        treatment.pacient.deleted_at === null
                                          ? 'border-gray-700'
                                          : 'border-red-500',
                                      ]" v-else class="h-12 w-12 bg-white rounded-full border-2 object-cover "  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                      <path style="fill: #374151; stroke-width: 0.683348" d="M96 0c35.346 0 64 28.654 64 64s-28.654 64-64 64-64-28.654-64-64S60.654 0 96 0m48 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H48c-26.51 0-48 21.49-48 48v136c0 13.255 10.745 24 24 24h16v136c0 13.255 10.745 24 24 24h64c13.255 0 24-10.745 24-24V352h16c13.255 0 24-10.745 24-24V192c0-26.51-21.49-48-48-48z"/></svg>
                  <div class="ml-4">
                    <div class="text-sm font-bold text-gray-700">
                       {{ treatment.pacient.name}} <i v-if="treatment.pacient.deleted_at !== null" class="fa fa-trash text-red-500"></i>
                    </div>
                    <div class="text-sm text-gray-500">
                     {{treatment.pacient.personal_number}}
                    </div>
                     <div class="text-xs text-gray-500">
                     {{treatment.pacient.date_of_birth }}
                    </div>
                  </div>
                </div>
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              <div class="text-sm font-bold text-gray-700" v-html="dateFormat(treatment.starting_date)"></div>
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              <div class="text-sm font-bold text-gray-700" v-html="treatment.duration"></div>
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-right"
            >
              <inertia-link v-if="treatment.deleted_at === null" :href="route('treatment.edit',treatment.id)" as="button" class="float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Ndrysho
              </inertia-link>
              <div v-else>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-1 sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="restore(treatment)"
              >
                Rikthe
              </button>
              <button 
                class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500  sm:w-auto sm:text-sm"
                type="button"
                  v-on:click="deletePermn(treatment)"
              >
                Fshij
              </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
        <pagination :links="treatments.links" />
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
  props: {
    treatments: Object,
    filters: Object,
  },
     metaInfo: { 
        title: 'Trajtimet' 
    },

  components: {
    AppLayout,
    Pagination,
    SearchFilter,
    NavLink,
  },
  data(){
    return {
      searchForm:{
        search: this.filters.search,
        trashed: this.filters.trashed,
      }
    };
  },
  watch: {
    searchForm: {
      handler: throttle(function() {
        let query = pickBy(this.searchForm)
        this.$inertia.replace(this.route('treatment.index', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods:{ 
    dateFormat(value) {
      const date = new Date(Date.parse(value));
      return `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`
    },
     restore(data) {
      if (confirm('A jeni i sigurtë që dëshironi të riktheni trajtimin?')) {
        this.$inertia.put(this.route('treatment.restore', data.id))
      }
    },
    deletePermn(data) {
      if (confirm('A jeni i sigurtë që dëshironi të fshini trajtimin përgjithmonë?')) {
        this.$inertia.put(this.route('treatment.delete', data.id))
      }
    },
  }
};
</script>

