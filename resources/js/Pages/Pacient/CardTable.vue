<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
            <h3 class="font-semibold text-lg text-gray-800 ">Pacientët</h3><br>
        <div class="relative w-full px-4 max-w-full flex-grow flex-1 float-left">
          
          <button
            @click="openModal()"
            class="float-right ml-auto inline bg-green-500 text-white active:bg-green-700 hover:bg-green-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-green-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          >
            <i class="fa fas fa-plus"></i>
          </button>
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
              Pacienti
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Adresa
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Kontakti  
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pacient in pacients.data" :key="pacient.id">
            <td

              class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
            <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                      <svg :class="[
                                        pacient.deleted_at === null
                                         ? 'border-gray-700'
                                          : 'border-red-500',
                                      ]"  v-if="pacient.gender == 'F'" class="h-12 w-12 bg-white rounded-full border-2 object-cover  p-1 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                        <path style="fill: #374151; stroke-width: 0.683348" d="M128 0c35.346 0 64 28.654 64 64s-28.654 64-64 64c-35.346 0-64-28.654-64-64S92.654 0 128 0m119.283 354.179l-48-192A24 24 0 0 0 176 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H80a24 24 0 0 0-23.283 18.179l-48 192C4.935 369.305 16.383 384 32 384h56v104c0 13.255 10.745 24 24 24h32c13.255 0 24-10.745 24-24V384h56c15.591 0 27.071-14.671 23.283-29.821z"/></svg>
                     <svg :class="[
                                        pacient.deleted_at === null
                                          ? 'border-gray-700'
                                          : 'border-red-500',
                                      ]" v-else class="h-12 w-12 bg-white rounded-full border-2 object-cover  p-1  "  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                      <path style="fill: #374151; stroke-width: 0.683348" d="M96 0c35.346 0 64 28.654 64 64s-28.654 64-64 64-64-28.654-64-64S60.654 0 96 0m48 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H48c-26.51 0-48 21.49-48 48v136c0 13.255 10.745 24 24 24h16v136c0 13.255 10.745 24 24 24h64c13.255 0 24-10.745 24-24V352h16c13.255 0 24-10.745 24-24V192c0-26.51-21.49-48-48-48z"/></svg>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-bold text-gray-700">
                       {{ pacient.name}} <i v-if="pacient.deleted_at !== null" class="fa fa-trash text-red-500"></i>
                    </div>
                    <div class="text-sm text-gray-500">
                     {{pacient.personal_number}}
                    </div>
                     <div class="text-xs text-gray-500">
                     {{pacient.date_of_birth }}
                    </div>
                  </div>
                </div>
            </td>
              <td class=" py-4 whitespace-nowrap">
                <div class="text-sm font-bold text-gray-700">{{ pacient.address }}</div>
                <div class="text-sm text-gray-500">{{pacient.residence}},{{pacient.city}}</div>
              </td>
             <td class=" py-4 whitespace-nowrap">
                <div class="text-sm  font-bold text-gray-700">{{ pacient.phone }}</div>
                <div class="text-sm text-gray-500">{{pacient.email}}</div>
              </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-right"
            >

              <button
                v-show="pacient.deleted_at == null"
                class="bg-blue-500 text-white active:bg-blue-700 hover:bg-blue-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="edit(pacient)"
              >
                <i class="fa fas fa-pen"></i>
              </button>

              <button v-if="pacient.deleted_at != null"
                   class="bg-green-500 text-white active:bg-green-700 hover:bg-green-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    type="button"
                    v-on:click="restore(pacient)"> <i class="fa fas fa-trash-restore"></i> </button>
              <button v-else
                @click="deletePacient(pacient)"
                class="bg-red-500 text-white active:bg-red-700 hover:bg-red-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
              >
                <i class="fa fas fa-trash"></i>
              </button>
                <button
                v-show="pacient.deleted_at != null"
                class="bg-red-500 text-white active:bg-red-700 hover:bg-red-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="deletePermn(pacient)"
              >
                <i class="fa fas fa-ban"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <large-modal  v-if="modalShow">
               <template #header >  
                <h1 v-if="editMode" class="block uppercase tracking-wide text-gray-700 text-xl text-center font-bold mb-4">Ndrysho Pacient</h1> 
                 <h1 v-else class="block uppercase tracking-wide text-gray-700 text-xl text-center font-bold mb-4">Shto Pacient</h1> 
               </template>
                 <template #footer > 
                 <span
                            class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                          >
                            <button
                              v-show="editMode"
                              @click="update(form)"
                              type="button"
                              :disabled="$v.form.$invalid"
                              :class="[
                                $v.form.$invalid == false
                                  ? 'bg-green-600 focus:border-green-700 hover:bg-green-500'
                                  : 'bg-green-500 opacity-50 cursor-not-allowed',
                              ]"
                              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                            >
                              Ndrysho
                            </button>
                            <button
                              v-show="!editMode"
                              @click="save(form)"
                              type="button"
                              :disabled="$v.form.$invalid"
                              :class="[
                                $v.form.$invalid == false
                                  ? 'bg-blue-600 focus:border-blue-700 hover:bg-blue-500'
                                  : 'bg-blue-500 opacity-50 cursor-not-allowed',
                              ]"
                              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium text-white shadow-sm focus:outline-none focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                            >
                              Ruaj
                            </button>
                          </span>
                          <span
                            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                          >
                            <button
                              type="button"
                              class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                              v-on:click="closeModal()"
                            >
                              Anulo
                            </button>
                          </span>
                         
                         </template>
                        <form class="max-w-6xl w-full">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div
                                    class="w-full sm:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-name"
                                    >
                                      Emri
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.name.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-name"
                                      type="text"
                                      placeholder="Emri"
                                      name="name"
                                      v-model="form.name"
                                    />
                                    <p
                                      v-if="!$v.form.name.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.name.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.name.$params.minLength.min
                                      }}
                                      shkronja.
                                    </p>
                                  </div>
                                  <div class="w-full md:w-1/2 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-personal-number"
                                    >
                                      Numri Personal
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.personal_number.$invalid ===
                                        true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-personal-number"
                                      type="text"
                                      placeholder="Numri Personal"
                                      name="personal_number"
                                      v-model="form.personal_number"
                                    />
                                    <p
                                      v-if="!$v.form.personal_number.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="
                                        !$v.form.personal_number.minLength ||
                                        !$v.form.personal_number.maxLength
                                      "
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë 10 numra.
                                    </p>
                                    <p
                                      v-if="!$v.form.personal_number.numeric"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë vetëm numra.
                                    </p>
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div class="w-1/3 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-date-of-birth"
                                    >
                                      Data e lindjes
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.date_of_birth.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-date-of-birth"
                                      type="date"
                                      placeholder="Data e lindjes"
                                      name="date_of_birth"
                                      v-model="form.date_of_birth"
                                    />
                                    <p
                                      v-if="!$v.form.date_of_birth.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                  </div>
                                  <div class="w-1/3 mr-auto ml-auto px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-gender"
                                    >
                                      Gjinia
                                    </label>
                                    <div class="mb-3">
                                      <input
                                        type="radio"
                                        id="male"
                                        value="M"
                                        name="gender"
                                        v-model="form.gender"
                                      />
                                      <label for="male">Mashkull</label>
                                      <br />
                                      <input
                                        type="radio"
                                        id="female"
                                        value="F"
                                        name="gender"
                                        v-model="form.gender"
                                      />
                                      <label for="female">Femer</label>
                                    </div>
                                    <p
                                      v-if="!$v.form.gender.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                  </div>
                                  <div class="w-1/3 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-address"
                                    >
                                      Adresa
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.address.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-address"
                                      type="text"
                                      placeholder="Adresa"
                                      name="address"
                                      v-model="form.address"
                                    />
                                    <p
                                      v-if="!$v.form.address.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.address.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.address.$params.minLength.min
                                      }}
                                      shkronja.
                                    </p>
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div
                                    class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-residence"
                                    >
                                      Vendbanimi
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.residence.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-residence"
                                      type="text"
                                      placeholder="Vendbanimi"
                                      name="residence"
                                      v-model="form.residence"
                                    />
                                    <p
                                      v-if="!$v.form.residence.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.residence.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.residence.$params.minLength.min
                                      }}
                                      shkronja.
                                    </p>
                                  </div>
                                  <div class="w-full md:w-1/2 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-city"
                                    >
                                      Qyteti
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.city.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-city"
                                      type="text"
                                      placeholder="Qyteti"
                                      name="city"
                                      v-model="form.city"
                                    />
                                    <p
                                      v-if="!$v.form.city.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.city.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{ $v.form.city.$params.minLength.min }}
                                      shkronja.
                                    </p>
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div
                                    class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-phone"
                                    >
                                      Nr Telefonit
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.phone.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-phone"
                                      type="text"
                                      placeholder="Nr Telefonit"
                                      name="phone"
                                      v-model="form.phone"
                                    />
                                    <p
                                      v-if="!$v.form.phone.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.phone.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{ $v.form.phone.$params.minLength.min }}
                                      numra.
                                    </p>
                                    <p
                                      v-if="!$v.form.phone.numeric"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë vetëm numra.
                                    </p>
                                  </div>
                                  <div class="w-full md:w-1/2 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-email"
                                    >
                                      E-mail
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.email.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-400',
                                      ]"
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-email"
                                      type="email"
                                      placeholder="E-mail"
                                      name="email"
                                      v-model="form.email"
                                    />
                                    <p
                                      v-if="!$v.form.email.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.email.email"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të jete email.
                                    </p>
                                  </div>
                                </div>
                              </form>
          </large-modal>
      <pagination :links="pacients.links" />
    </div>
  </div>
</template>
<script>
import {
  required,
  numeric,
  minLength,
  maxLength,
  email,
} from "vuelidate/lib/validators";
import Pagination from "./../../components/Pagination/Pagination.vue";
import SearchFilter from "./../../components/Search/SearchFilter.vue";
import LargeModal from "./../../components/Modals/LargeModal.vue";
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

export default {
    components: {
        Pagination,
        SearchFilter,
        LargeModal,
  },
  props: {
    pacients: Object,
    filters: Object,
  },
  data() {
    return {
      modalShow: false,
      editMode: false,
      sending: false,
      searchForm:{
            search: this.filters.search,
            trashed: this.filters.trashed,
      },
      form: 
      {
        name: this.name,
        personal_number: this.personal_number,
        gender: this.gender,
        date_of_birth: this.date_of_birth,
        address: this.address,
        residence: this.residence,
        city: this.city,
        phone: this.phone,
        email: this.email,
      },
      formValidated: false,
    };
  },
   watch: {
    searchForm: {
      handler: throttle(function() {
        let query = pickBy(this.searchForm)
        this.$inertia.replace(this.route('pacient.index', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(3),
      },
      email: {
        required,
        email,
      },
      personal_number: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(10),
        numeric,
      },
      gender: {
        required,
      },
      date_of_birth: {
        required,
      },
      address: {
        required,
        minLength: minLength(3),
      },
      residence: {
        required,
        minLength: minLength(3),
      },
      city: {
        required,
        minLength: minLength(3),
      },
      phone: {
        required,
        numeric,
        minLength: minLength(9),
      },
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
    reset() {
      this.form = {
        name: null,
        personal_number: null,
        gender: null,
        date_of_birth: null,
        address: null,
        residence: null,
        city: null,
        phone: null,
        email: null,
      };
    },
    submitForm() {},
    save(data) {
      if (this.$v.form.$invalid) {
        alert("Form is not valid");
      } else {
        this.$inertia.post(this.route('pacient.store'), this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
        })
        this.reset();
        this.closeModal();
      }
    },
    edit (data) {
      this.form = Object.assign({}, data);
      this.editMode = true;
      this.openModal();
    },
    update (data) {
      if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni pacientin?")) return;
       this.$inertia.put(this.route('pacient.update', data.id), this.form, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
      this.reset();
      this.closeModal();
    },
    deletePacient(data) {
      if (!confirm("A jeni i sigurtë që dëshironi të fshini pacientin?")) return;
      this.$inertia.delete(this.route('pacient.destroy', data.id))
    },
    restore(data) {
      if (confirm('A jeni i sigurtë që dëshironi të riktheni pacientin?')) {
        this.$inertia.put(this.route('pacient.restore', data.id))
      }
    },
    deletePermn(data) {
      if (confirm('A jeni i sigurtë që dëshironi të fshini pacientin përgjithmonë?')) {
        this.$inertia.put(this.route('pacient.delete', data.id))
      }
    },
  },
};
</script>
