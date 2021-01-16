<template>
    <app-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <h3 class="font-semibold text-lg text-gray-800 inline">Ndrysho Pacient</h3>
                    </div>
                    <div class="block w-full px-10 py-5">
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-name"
                                      type="text"
                                      placeholder="Emri"
                                      name="name"
                                      v-model="form.name"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.name">{{ errors.name }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-personal-number"
                                      type="text"
                                      placeholder="Numri Personal"
                                      name="personal_number"
                                      v-model="form.personal_number"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.personal_number">{{ errors.personal_number }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-date-of-birth"
                                      type="date"
                                      placeholder="Data e lindjes"
                                      name="date_of_birth"
                                      v-model="form.date_of_birth"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.date_of_birth">{{ errors.date_of_birth }}</div>
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
                                       <div  class="text-red-500 text-xs italic" v-if="errors.gender">{{ errors.gender }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-address"
                                      type="text"
                                      placeholder="Adresa"
                                      name="address"
                                      v-model="form.address"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.address">{{ errors.address }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-residence"
                                      type="text"
                                      placeholder="Vendbanimi"
                                      name="residence"
                                      v-model="form.residence"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.residence">{{ errors.residence }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-city"
                                      type="text"
                                      placeholder="Qyteti"
                                      name="city"
                                      v-model="form.city"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.city">{{ errors.city }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-phone"
                                      type="text"
                                      placeholder="Nr Telefonit"
                                      name="phone"
                                      v-model="form.phone"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.phone">{{ errors.phone }}</div>
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
                                      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative  bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full"
                                      id="grid-email"
                                      type="email"
                                      placeholder="E-mail"
                                      name="email"
                                      v-model="form.email"
                                    />
                                     <div  class="text-red-500 text-xs italic" v-if="errors.email">{{ errors.email }}</div>
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
                            @click="deletePacient()"
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
  numeric,
  minLength,
  maxLength,
  email,
} from "vuelidate/lib/validators";
import AppLayout from "./../../Layouts/AppLayout";

export default {
    props: {
        pacient: Object,
        errors: Object, 
    },
    metaInfo: { 
        title: 'Ndrysho Pacient' 
    },
    components: {
        AppLayout,
    },
    data() {
        return {
            form: 
            {
                name: this.pacient.name,
                personal_number: this.pacient.personal_number,
                gender: this.pacient.gender,
                date_of_birth: this.pacient.date_of_birth,
                address: this.pacient.address,
                residence: this.pacient.residence,
                city: this.pacient.city,
                phone: this.pacient.phone,
                email: this.pacient.email,
            },
            formValidated: false,
        };
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
        submitForm() {},
        update () {
            if (this.$v.form.$invalid) {
                alert("Form is not valid");
            } 
            else {
                if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni pacientin?")) return;
                this.$inertia.put(this.route('pacient.update', this.pacient),this.form)
            }
        },
        deletePacient() {
        if (!confirm("A jeni i sigurtë që dëshironi të fshini pacientin?")) return;
        this.$inertia.delete(this.route('pacient.destroy', this.pacient))
        },
    },
}
</script>
