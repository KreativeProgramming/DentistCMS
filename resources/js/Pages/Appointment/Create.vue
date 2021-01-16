<template>
    <app-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <h3 class="font-semibold text-lg text-gray-800 inline">Krijo Termin</h3>
                    </div>
                    <div class="block w-full px-10 py-5">
                       <form class="w-full"  @submit.prevent="submitForm">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  
                                  <div class="w-full px-3 mb-6">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-pacient_id"
                                    >
                                      Pacienti
                                    </label>
                                     <select-form :dropdown="dropdownPacientShow" >
                                        <template #inputs>
                                          <input hidden type="text" name="pacient_id" v-model="form.pacient_id"/>
                                          <input
                                            autocomplete="off"                                       
                                            @click="togglePacientDropdown()"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-pacient-id"
                                            type="text"
                                            placeholder="Pacienti"
                                            name="pacienti"
                                            v-model="selectedPacient"
                                            @input="onsearchPacient"/>
                                        </template>
                                        <template #lists>
                                          <li @click="selectPacient(item)" v-for="item in pacientFinded" :key="item.id" id="listbox-item-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                                            <div class="flex items-center">
                                              <svg  v-if="item.gender == 'F'" class="flex-shrink-0 h-6 w-6 bg-white rounded-full object-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                                <path style="fill: #374151; stroke-width: 0.683348" d="M128 0c35.346 0 64 28.654 64 64s-28.654 64-64 64c-35.346 0-64-28.654-64-64S92.654 0 128 0m119.283 354.179l-48-192A24 24 0 0 0 176 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H80a24 24 0 0 0-23.283 18.179l-48 192C4.935 369.305 16.383 384 32 384h56v104c0 13.255 10.745 24 24 24h32c13.255 0 24-10.745 24-24V384h56c15.591 0 27.071-14.671 23.283-29.821z"/></svg>
                                              <svg v-else class="flex-shrink-0 h-6 w-6 bg-white rounded-full object-cover"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                                                <path style="fill: #374151; stroke-width: 0.683348" d="M96 0c35.346 0 64 28.654 64 64s-28.654 64-64 64-64-28.654-64-64S60.654 0 96 0m48 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H48c-26.51 0-48 21.49-48 48v136c0 13.255 10.745 24 24 24h16v136c0 13.255 10.745 24 24 24h64c13.255 0 24-10.745 24-24V352h16c13.255 0 24-10.745 24-24V192c0-26.51-21.49-48-48-48z"/></svg> 
                                              <span class="ml-3 block font-normal truncate">
                                                {{item.name}} ({{item.personal_number}})
                                              </span>
                                            </div>
                                            <span v-if="item.id == form.pacient_id" class="absolute inset-y-0 right-0 flex items-center pr-4">
                                              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                              </svg>
                                            </span>
                                          </li>
                                        </template>
                                      </select-form>

                                  <div class="relative">
                                      
                                      <div  class="text-red-500 text-xs italic" v-if="errors.pacient_id">{{ errors.pacient_id }}</div>
                                    </div>
                                  </div>
                                  <div class="w-full px-3 mb-6">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-user_id"
                                    >
                                      Dentisti
                                    </label>
                                      <select-form :dropdown="dropdownUserShow">
                                        <template #inputs>
                                          <input hidden type="text" name="user_id" v-model="form.user_id"/>
                                          <input
                                            @click="toggleUserDropdown()"
                                            autocomplete="off"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-user-id"
                                            type="text"
                                            placeholder="Dentisti"
                                            name="user"
                                            v-model="selectedUser"
                                            @input="onsearchUser"/>
                                        </template>
                                        <template #lists>
                                          <li @click="selectUser(item)" v-for="item in userFinded" :key="item.id" id="listbox-item-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                                            <div class="flex items-center">
                                               <img
                                                :src="item.profile_photo_url"
                                                class="h-12 w-12 bg-white rounded-full border-2 object-cover"
                                                :style="{ borderColor: item.color }"
                                                alt="..."
                                              />
                                              <span class="ml-3 text-sm font-bold text-gray-700">
                                                {{ item.name }}
                                              </span>
                                            </div>
                                            <span v-if="item.id == form.user_id" class="absolute inset-y-0 right-0 flex items-center pr-4">
                                              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                              </svg>
                                            </span>
                                          </li>
                                        </template>
                                      </select-form>
                                      <div  class="text-red-500 text-xs italic" v-if="errors.user_id">{{ errors.user_id }}</div>
                                  </div>
                                  <div
                                    class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-date-of-appointment"
                                    >
                                      Data
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.date_of_appointment.$invalid ===
                                        true
                                          ? 'border-red-500'
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                      id="grid-date-of-appointment"
                                      type="date"
                                      placeholder="Data e terminit"
                                      name="date_of_appointment"
                                      v-model="form.date_of_appointment"
                                    />
                                    <div  class="text-red-500 text-xs italic" v-if="errors.date_of_appointment">{{ errors.date_of_appointment }}</div>
                                    <p
                                      v-if="
                                        !$v.form.date_of_appointment.required
                                      "
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                  </div>
                                  <div
                                    class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-time_of_appointment"
                                    >
                                      Ora
                                    </label>
                                    <div class="relative">
                                      <select
                                        :class="[
                                          $v.form.time_of_appointment
                                            .$invalid === true
                                            ? 'border-red-500'
                                            : 'border-grey-200',
                                        ]"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3"
                                        id="grid-time_of_appointment"
                                        name="time_of_appointment"
                                        v-model="form.time_of_appointment"
                                      >
                                        <option selected>08:00</option>
                                        <option>08:30</option>
                                        <option>09:00</option>
                                        <option>09:30</option>
                                        <option>10:00</option>
                                        <option>10:30</option>
                                        <option>11:00</option>
                                        <option>11:30</option>
                                        <option>12:00</option>
                                        <option>12:30</option>
                                        <option>13:00</option>
                                        <option>13:30</option>
                                        <option>14:00</option>
                                        <option>14:30</option>
                                        <option>15:00</option>
                                        <option>15:30</option>
                                        <option>16:00</option>
                                        <option>16:30</option>
                                        <option>17:00</option>
                                        <option>17:30</option>
                                        <option>18:00</option>
                                        <option>18:30</option>
                                        <option>19:00</option>
                                        <option>19:30</option>
                                      </select>
                                      <div  class="text-red-500 text-xs italic" v-if="errors.time_of_appointment">{{ errors.time_of_appointment }}</div>
                                      <p
                                        v-if="
                                          !$v.form.time_of_appointment.required
                                        "
                                        class="text-red-500 text-xs italic"
                                      >
                                        Fusha është e zbrazët.
                                      </p>
                                      <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                      >
                                        <svg
                                          class="fill-current h-4 w-4"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                        >
                                          <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                            </form>
                            
                           

                        <div class="flex w-full flex-row-reverse float-right"  >
                            <button
                              @click="save(form)"
                              type="button"
                              :disabled="$v.form.$invalid"
                              :class="[
                                $v.form.$invalid == false
                                  ? 'bg-blue-600 focus:border-blue-700 hover:bg-blue-500'
                                  : 'bg-blue-500 opacity-50 cursor-not-allowed',
                              ]"
                              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                              Ruaj
                            </button>
                          </div>
            </div>
</div>
</div>
</div>
</app-layout>
</template>


<script>import {
  required,
} from "vuelidate/lib/validators";
import AppLayout from "./../../Layouts/AppLayout";
import SelectForm from "./../../components/Selects/Select.vue";
import { createPopper } from "@popperjs/core";

export default {
    props: {
        errors: Object, 
        pacients: Array,
        users: Array,
    },
    metaInfo: { 
        title: 'Krijo Termin' 
    },
    created() {
      this.pacientFinded = this.pacients;
      this.userFinded = this.users;
    },
    components: {
        AppLayout,
        SelectForm
    },
    data() {
        return {
        form: this.$inertia.form(
            {
            pacient_id: this.pacient_id,
            user_id: this.user_id,
            date_of_appointment: this.date_of_appointment,
            time_of_appointment: this.time_of_appointment,
            },
        ),
        formValidated: false,
        pacientFinded: [],
        userFinded: [],
        selectedPacient: '',
        selectedUser: '',
        dropdownPacientShow: false,
        dropdownUserShow: false,
        };
    },
     validations: {
    form: {
      date_of_appointment: {
        required,
      },
      time_of_appointment: {
        required,
      },
    },
  },
    methods: {
        submitForm() {},
        save: function (data) {
            if (this.$v.form.$invalid) {
                alert("Form is not valid");
            } else {
                this.$inertia.post("/appointment", data);
            }
        },
        onsearchPacient(e) {
            if (e.target.value) {
                this.pacientFinded = this.pacients.filter(el => el.name.indexOf(e.target.value) !== -1);
            } else {
                this.pacientFinded = this.pacients;
            }
        },
        onsearchUser(e) {
            if (e.target.value) {
                this.userFinded = this.users.filter(el => el.name.indexOf(e.target.value) !== -1);
            } else {
                this.userFinded = this.users;
            }
        },
        selectPacient(pacient) {
            this.form.pacient_id = pacient.id
            this.selectedPacient = pacient.name+' ('+pacient.personal_number+')'
            this.dropdownPacientShow = false
        },
        selectUser(user) {
            this.form.user_id = user.id
            this.selectedUser = user.name
            this.dropdownUserShow = false
        },
        toggleUserDropdown()
        {
          if (this.dropdownUserShow) {
            this.dropdownUserShow = false;
          } else {
            this.dropdownUserShow = true;
          }
        },
        togglePacientDropdown() {
          if (this.dropdownPacientShow) {
            this.dropdownPacientShow = false;
          } else {
            this.dropdownPacientShow = true;
          }
      },
    },
}
</script>
