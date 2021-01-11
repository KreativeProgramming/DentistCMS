<template>
  <app-layout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
          <form>
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
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
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import CardTable from "./CardTable.vue";
import {
  required,
  numeric,
  minLength,
  maxLength,
  email,
} from "vuelidate/lib/validators";
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
export default {
  props: ["sessions", "users", "pacients", "appointments"],

  components: {
    AppLayout,
    CardTable,
  },
  data(){
    return {
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
};
</script>

