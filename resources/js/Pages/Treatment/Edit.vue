<template>
    <app-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <h3 class="font-semibold text-lg text-gray-800 inline">Ndrysho Termin</h3>
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
                                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-starting-date"
                                    >
                                        Data e fillimit
                                    </label>
                                    <input
                                        :class="[
                                            $v.form.starting_date.$invalid ===
                                            true
                                                ? 'border-red-500'
                                                : 'border-grey-200'
                                        ]"
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="grid-starting-date"
                                        type="date"
                                        placeholder="Data e terminit"
                                        name="starting_date"
                                        v-model="form.starting_date"
                                    />
                                    <div
                                        class="text-red-500 text-xs italic"
                                        v-if="errors.starting_date"
                                    >
                                        {{ errors.starting_date }}
                                    </div>
                                    <p
                                        v-if="!$v.form.starting_date.required"
                                        class="text-red-500 text-xs italic"
                                    >
                                        Fusha është e zbrazët.
                                    </p>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6">
                                    <label
                                        class="select-none   block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-name"
                                    >
                                        Zgjatja
                                    </label>
                                    <input
                                        :class="[
                                            $v.form.duration.$invalid === true
                                                ? 'border-red-500'
                                                : 'border-grey-200'
                                        ]"
                                        class=" select-text appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="grid-duration"
                                        type="text"
                                        placeholder="Zgjatja"
                                        name="duration"
                                        v-model="form.duration"
                                    />
                                    <div v-if="errors.duration">
                                        {{ errors.duration }}
                                    </div>
                                    <p
                                        v-if="!$v.form.duration.required"
                                        class="text-red-500 text-xs italic"
                                    >
                                        Fusha është e zbrazët.
                                    </p>
                                </div>
                                  <div
                                    class="w-full px-3 mb-6"
                                  >
                                    <label
                                        class="inline uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-pacient_id"
                                    >
                                        Sherbimet
                                    </label>
                                    <button  @click="toggleServicesDropdown()" class=" inline bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded-full">
                                                <i class="fas fa-plus"/>
                                              </button>
                                    <select-form
                                        class="mt-2"
                                        :dropdown="dropdownServicesShow"
                                    >
                                        <template #inputs>
                                            <input
                                                hidden
                                                type="text"
                                                name="services"
                                                v-model="form.services"
                                            />
                                            <select 
                                              id="grid-services"
                                              class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                              multiple
                                              placeholder="Sherbimet"
                                              name="selectedServices"
                                            >
                                              <option  
                                                v-for="(item, index) in selectedServices"
                                                :key="`${index}-selected`"
                                                @dblclick="removeService(item)"
                                              >
                                                {{item.name}} ({{ item.price }}€)
                                              </option>
                                            </select>
                                        </template>
                                        <template #lists>
                                            <li
                                                v-for="item in services"
                                                @click="selectService(item)"
                                                :key="item.id"
                                                id="listbox-item-0"
                                                role="option"
                                                class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9"
                                            >
                                                <div class="flex items-center">
                                                    <span
                                                        class="ml-3 block font-normal truncate"
                                                    >
                                                        {{ item.name }} - {{ item.price }}€
                                                    </span>
                                                </div>
                                                <span
                                                    v-if="
                                                        form.services.includes(item.id)
                                                    "
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4"
                                                >
                                                    <svg
                                                        class="h-5 w-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </span>
                                            </li>
                                        </template>
                                    </select-form>
                                  </div>
                                </div>
                              </form> 
                        <div class="flex w-full flex-row-reverse float-right"  >
                            <button
                            @click="update()"
                            type="button"
                            :disabled="$v.form.$invalid"
                            :class="[
                                $v.form.$invalid == false
                                ? 'bg-blue-600 focus:border-blue-700 hover:bg-blue-500'
                                : 'bg-blue-500 opacity-50 cursor-not-allowed',
                            ]"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                            Ndrysho
                            </button>
                            <button
                            @click="deleteTreatment()"
                            type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                            Fshij
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

export default {
    props: {
        pacients: Array,
        services: Array,
        treatment: Object,
        errors: Object, 
    },
    metaInfo: { 
        title: 'Ndrysho Trajtim' 
    },
    components: {
        AppLayout,
        SelectForm
    },
    created() {
      this.pacientFinded = this.pacients;
      this.treatment.service.forEach((item) => {
          const temp = this.services.find(service => service.id === item.id);
          this.selectedServices.push(temp);
          this.form.services.push(temp.id);
      });
    },
    data() {
        return {
        form: this.$inertia.form(
            {
                pacient_id: this.treatment.pacient_id,
                starting_date: this.treatment.starting_date,
                duration: this.treatment.duration,
                services: [],
                file: this.file
            },
        ),
        formValidated: false,
        pacientFinded: [],
        selectedPacient: this.treatment.pacient.name+' ('+this.treatment.pacient.personal_number+')',
        selectedServices: [],
        dropdownPacientShow: false,
        dropdownServicesShow: false,
        };
    },
    validations: {
        form: {
        starting_date: {
            required,
        },
        duration: {
            required,
        },
        },
    },
    methods: {
        submitForm() {},
        onsearchPacient(e) {
            if (e.target.value) {
                this.pacientFinded = this.pacients.filter(el => el.name.indexOf(e.target.value) !== -1);
            } else {
                this.pacientFinded = this.pacients;
            }
        },
        selectPacient(pacient) {
            this.form.pacient_id = pacient.id
            this.selectedPacient = pacient.name+' ('+pacient.personal_number+')'
            this.dropdownPacientShow = false
        },
        selectService(service) {
            this.form.services.push(service.id);
            this.selectedServices.push(service);
            this.dropdownServicesShow = false;
        },
        removeService(service) {
            this.form.services.pop(service.id);
            this.selectedServices.pop(service);
        },
        toggleServicesDropdown() {
            if (this.dropdownServicesShow) {
                this.dropdownServicesShow = false;
            } else {
                this.dropdownServicesShow = true;
            }
        },
        togglePacientDropdown() {
          if (this.dropdownPacientShow) {
            this.dropdownPacientShow = false;
          } else {
            this.dropdownPacientShow = true;
          }
      },
        update () {
            if (this.$v.form.$invalid) {
                alert("Form is not valid");
            } 
            else {
                if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni trajtimin?")) return;
                this.$inertia.put(this.route('treatment.update', this.treatment),this.form)
            }
        },
        deleteTreatment() {
        if (!confirm("A jeni i sigurtë që dëshironi të fshini trajtimin?")) return;
        this.$inertia.delete(this.route('treatment.destroy', this.treatment))
        },
    },
}
</script>
