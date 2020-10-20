<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-lg text-gray-800 inline">Pacient</h3>
          <button
            @click="openModal()"
            class="float-right ml-auto inline bg-green-500 text-white active:bg-green-700 hover:bg-green-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-green-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          >
            <i class="fa fas fa-plus"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="block w-full overflow-x-auto">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs bg-gray-100 text-gray-600 border-gray-200 uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Emri (Emri i Prindit) Mbiemri
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Numri Personal
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Data e lindjes
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Adresa
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Qyteti
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Telefoni
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pacient in pacients" :key="pacient.id">
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              <i
                v-show="pacient.gender == 'M' || pacient.gender == 'm'"
                class="fa fa-mars"
              ></i>
              <i
                v-show="pacient.gender == 'F' || pacient.gender == 'f'"
                class="fa fa-venus"
              ></i>
              {{ pacient.first_name }} {{ pacient.fathers_name }}
              {{ pacient.last_name }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ pacient.personal_number }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ pacient.date_of_birth }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ pacient.address }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ pacient.city }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ pacient.phone }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-right"
            >
              <button
                class="bg-blue-500 text-white active:bg-blue-700 hover:bg-blue-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="edit(pacient)"
              >
                <i class="fa fas fa-pen"></i>
              </button>
              <button
                @click="deletePacient(pacient)"
                class="bg-red-500 text-white active:bg-red-700 hover:bg-red-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
              >
                <i class="fa fas fa-trash"></i>
              </button>
              <div
                class="fixed z-10 inset-0 overflow-y-auto"
                :class="{
                  hidden: !modalShow,

                  block: modalShow,
                }"
              >
                <transition
                  enter-active-class="ease-out duration-300"
                  enter-class="opacity-0"
                  enter-to-class="opacity-100"
                  leave-active-class="ease-in duration-200"
                  leave-class="opacity-100"
                  leave-to-class="opacity-0"
                >
                  <div
                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                  >
                    <div class="fixed inset-0 transition-opacity">
                      <div
                        class="absolute inset-0 bg-gray-500 opacity-75"
                      ></div>
                    </div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span
                      class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    ></span
                    >&#8203;

                    <transition
                      enter-active-class="ease-out duration-300"
                      enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                      enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                      leave-active-class="ease-in duration-200 "
                      leave-class="opacity-100 translate-y-0 sm:scale-100"
                      leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                      <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-2xl"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="modal-headline"
                      >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                          <div class="sm:flex sm:items-center">
                            <div class="w-full mt-3 text-center sm:text-left">
                              <h1
                                class="block uppercase tracking-wide text-gray-700 text-xl text-center font-bold mb-4"
                              >
                                Shto Pacient
                              </h1>
                              <form class="w-full">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div
                                    class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                  >
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-first-name"
                                    >
                                      Emri
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.first_name.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                      id="grid-first-name"
                                      type="text"
                                      placeholder="Emri"
                                      name="first_name"
                                      v-model="form.first_name"
                                    />
                                    <p
                                      v-if="!$v.form.first_name.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.first_name.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.first_name.$params.minLength.min
                                      }}
                                      shkronja.
                                    </p>
                                  </div>
                                  <div class="w-full md:w-1/2 px-3">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-last-name"
                                    >
                                      Mbiemri
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.last_name.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                      id="grid-last-name"
                                      type="text"
                                      placeholder="Mbiemri"
                                      name="last_name"
                                      v-model="form.last_name"
                                    />
                                    <p
                                      v-if="!$v.form.last_name.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.last_name.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.last_name.$params.minLength.min
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
                                      for="grid-fathers-name"
                                    >
                                      Emri i prindit
                                    </label>
                                    <input
                                      :class="[
                                        $v.form.fathers_name.$invalid === true
                                          ? 'border-red-500'
                                          : 'border-grey-200',
                                      ]"
                                      class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                      id="grid-fathers-name"
                                      type="text"
                                      placeholder="Emri i prindi"
                                      name="fathers_name"
                                      v-model="form.fathers_name"
                                    />
                                    <p
                                      v-if="!$v.form.fathers_name.required"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha është e zbrazët.
                                    </p>
                                    <p
                                      v-if="!$v.form.fathers_name.minLength"
                                      class="text-red-500 text-xs italic"
                                    >
                                      Fusha duhet të ketë së paku
                                      {{
                                        $v.form.fathers_name.$params.minLength
                                          .min
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
                        </div>

                        <div
                          class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                        >
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
                              Cancel
                            </button>
                          </span>
                        </div>
                      </div>
                    </transition>
                  </div>
                </transition>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
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

export default {
  props: ["sessions", "pacients"],
  data() {
    return {
      modalShow: false,
      editMode: false,
      form: this.$inertia.form(
        {
          first_name: this.first_name,
          fathers_name: this.fathers_name,
          last_name: this.last_name,
          personal_number: this.personal_number,
          gender: this.gender,
          date_of_birth: this.date_of_birth,
          address: this.address,
          residence: this.residence,
          city: this.city,
          phone: this.phone,
          email: this.email,
        },
        {
          bag: "updateProfileInformation",
          resetOnSuccess: true,
        }
      ),
      formValidated: false,
    };
  },
  validations: {
    form: {
      first_name: {
        required,
        minLength: minLength(3),
      },
      fathers_name: {
        required,
        minLength: minLength(3),
      },
      last_name: {
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
    reset: function () {
      this.form = {
        first_name: null,
        fathers_name: null,
        last_name: null,
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
    save: function (data) {
      if (this.$v.form.$invalid) {
        alert("Form is not valid");
      } else {
        this.$inertia.post("/pacient", data).then(() => {
          this.reset();
          this.closeModal();
        });
      }
    },
    edit: function (data) {
      this.form = Object.assign({}, data);
      this.editMode = true;
      this.openModal();
    },
    update: function (data) {
      if (!confirm("Sure")) return;
      data._method = "PUT";
      this.$inertia.post("/pacient/" + data.id, data);
      this.reset();
      this.closeModal();
    },
    deletePacient: function (data) {
      if (!confirm("Sure")) return;
      data._method = "DELETE";
      this.$inertia.post("/pacient/" + data.id, data);
      this.closeModal();
    },
  },
};
</script>
