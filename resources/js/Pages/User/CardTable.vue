<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >

    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <h3 class="font-semibold text-lg text-gray-800 inline">Users</h3>
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
      
          <nav-link :href="route('user.create')">
          <button
            class=" float-right w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
            type="button"
          >
            Krijo
          </button>
          </nav-link>
          
        </div>
      </div>
        <search-filter v-model="searchForm.search" class=" max-w-sm mr-auto inline">
                <select v-model="searchForm.trashed"    class="px-3 py-1 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full mr-1">
                <option :value="null" >Filtro</option>
                <option value="with">Edhe të fshirë</option>
                <option value="only">Vetëm të fshirë &nbsp;</option>
                </select>
            </search-filter>
    </div>
    <div class="block w-full overflow-x-auto">
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
              <button
                v-show="user.deleted_at == null"
                class="bg-blue-500 text-white active:bg-blue-700 hover:bg-blue-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="edit(user)"
              >
                <i class="fa fas fa-pen"></i>
              </button>

              <button v-if="user.deleted_at != null"
                   class="bg-green-500 text-white active:bg-green-700 hover:bg-green-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    type="button"
                    v-on:click="restore(user)"> <i class="fa fas fa-trash-restore"></i> </button>
              <button v-else
                @click="deleteUser(user)"
                class="bg-red-500 text-white active:bg-red-700 hover:bg-red-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
              >
                <i class="fa fas fa-trash"></i>
              </button>
                <button
                v-show="user.deleted_at != null"
                class="bg-red-500 text-white active:bg-red-700 hover:bg-red-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="deletePermn(user)"
              >
                <i class="fa fas fa-ban"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
       
      <pagination :links="users.links" />
    </div>
  </div>
</template>
<script>
import Pagination from "./../../components/Pagination/Pagination.vue";
import SearchFilter from "./../../components/Search/SearchFilter.vue";
import NavLink from "@/Jetstream/NavLink.vue";
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

export default {
  components: {
    SearchFilter,
    Pagination,
    NavLink,
  },
   props: {
    users: Object,
    roles: Array,
    filters: Object,
  },
  data() {
    return {
      modalShow: false,
      editMode: false,
      form: {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        color: this.color,
        role_id: this.role_id,
      },
      formValidated: false,
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
  methods: {
    openModal() {
      this.modalShow = true;
    },
    closeModal() {
      this.modalShow = false;
      this.editMode = false;
      this.reset();
    },
    reset: function () {
      this.form = {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        color: null,
        role_id: null,
      };
    },
    submitForm() {},
    save: function (data) {
      if (this.$v.form.$invalid) {
        alert("Form is not valid");
      } else {
        this.$inertia.post("/user", data).then(() => {
          this.reset();
          this.closeModal();
        });
      }
    },
     edit (data) {
      this.form = Object.assign({}, data);
      this.editMode = true;
      this.openModal();
    },
    update (data) {
      if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni përdoruesin?")) return;
       this.$inertia.put(this.route('user.update', data.id), this.form, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
      this.reset();
      this.closeModal();
    },
    deleteUser(data) {
      if (!confirm("A jeni i sigurtë që dëshironi të fshini përdoruesin?")) return;
      this.$inertia.delete(this.route('user.destroy', data.id))
    },
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
  },
};
</script>
