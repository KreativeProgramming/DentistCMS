<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
  >
    <div
      v-if="$page.errors.date_of_appointment"
      class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
      role="alert"
    >
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline"
        >{{ $page.errors.date_of_appointment[0] }}.</span
      >
    </div>

    <div
      v-if="$page.errors.time_of_appointment"
      class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
      role="alert"
    >
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline"
        >{{ $page.errors.time_of_appointment[0] }}.</span
      >
    </div>
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-lg text-gray-800 inline">
            Appointments
          </h3>
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
              Pacienti
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Mjeku
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Data
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Ora
            </th>
            <th
              class="px-6 bg-gray-100 text-gray-600 border-gray-200 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
            >
              Menaxhimi
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="appointment in appointments" :key="appointment.id">
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ appointment.pacient.first_name }}
              {{ appointment.pacient.last_name }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left flex items-center"
            >
              <img
                :src="appointment.user.profile_photo_url"
                class="h-12 w-12 bg-white rounded-full border-2 object-cover"
                :style="{ borderColor: appointment.user.color }"
                alt="..."
              />
              <span class="ml-3 font-bold text-gray-700">
                {{ appointment.user.name }}
              </span>
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ appointment.date_of_appointment }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
            >
              {{ appointment.time_of_appointment }}
            </td>
            <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-right"
            >
              <button
                class="bg-blue-500 text-white active:bg-blue-700 hover:bg-blue-600 hover:text-gray-200 justify-center rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none focus:border-blue-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                type="button"
                v-on:click="edit(appointment)"
              >
                <i class="fa fas fa-pen"></i>
              </button>
              <button
                @click="deleteAppointment(appointment)"
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
                          <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center w-full sm:text-left">
                              <h1
                                class="block uppercase tracking-wide text-gray-700 text-xl text-center font-bold mb-2"
                              >
                                Shto Termin
                              </h1>
                              <form class="w-full max-w-2xl">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div class="w-full px-3 mb-6">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-pacient_id"
                                    >
                                      Pacienti
                                    </label>
                                    <div class="relative">
                                      <select
                                        :class="[
                                          $v.form.pacient_id.$invalid === true
                                            ? 'border-red-500'
                                            : 'border-grey-200',
                                        ]"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-pacient_id"
                                        name="pacient_id"
                                        v-model="form.pacient_id"
                                      >
                                        <option
                                          v-for="pacient in pacients"
                                          :key="pacient.id"
                                          :value="pacient.id"
                                        >
                                          {{ pacient.first_name }}
                                          {{ pacient.last_name }}
                                        </option>
                                      </select>
                                      <p
                                        v-if="!$v.form.pacient_id.required"
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
                                  <div class="w-full px-3 mb-6">
                                    <label
                                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                      for="grid-user_id"
                                    >
                                      Dentisti
                                    </label>
                                    <div class="relative">
                                      <select
                                        :class="[
                                          $v.form.user_id.$invalid === true
                                            ? 'border-red-500'
                                            : 'border-grey-200',
                                        ]"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-user_id"
                                        name="user_id"
                                        v-model="form.user_id"
                                      >
                                        <option
                                          v-for="user in users"
                                          :key="user.id"
                                          :value="user.id"
                                        >
                                          {{ user.name }}
                                        </option>
                                      </select>
                                      <p
                                        v-if="!$v.form.user_id.required"
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
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-time_of_appointment"
                                        name="time_of_appointment"
                                        v-model="form.time_of_appointment"
                                      >
                                        <option>08:00</option>
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
import { required } from "vuelidate/lib/validators";

export default {
  props: ["users", "pacients", "appointments"],
  data() {
    return {
      modalShow: false,
      editMode: false,
      form: this.$inertia.form(
        {
          pacient_id: this.pacient_id,
          user_id: this.user_id,
          date_of_appointment: this.date_of_appointment,
          time_of_appointment: this.time_of_appointment,
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
      pacient_id: {
        required,
      },
      user_id: {
        required,
      },
      date_of_appointment: {
        required,
      },
      time_of_appointment: {
        required,
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
        pacient_id: null,
        user_id: null,
        date_of_appointment: null,
        time_of_appointment: null,
      };
    },
    submitForm() {},
    save: function (data) {
      if (this.$v.form.$invalid) {
        alert("Form is not valid");
      } else {
        this.$inertia.post("/appointment", data).then(() => {
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
      this.$inertia.post("/appointment/" + data.id, data);
      this.reset();
      this.closeModal();
    },
    deleteAppointment: function (data) {
      if (!confirm("Sure")) return;
      data._method = "DELETE";
      this.$inertia.post("/appointment/" + data.id, data);
      this.closeModal();
    },
  },
};
</script>
