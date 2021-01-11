<template>
    <app-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <h3 class="font-semibold text-lg text-gray-800 inline">Krijo Përdorues</h3>
                    </div>
                    <div class="block w-full px-10 py-5">
                        <form class="w-full">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                        Emri Mbiemri
                                    </label>
                                            <input
                                            :class="[
                                                $v.form.name.$invalid === true
                                                ? 'border-red-500'
                                                : 'border-grey-200',
                                            ]"
                                            class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-name"
                                            type="text"
                                            placeholder="Emri dhe Mbiemri"
                                            name="name"
                                            v-model="form.name"
                                            />
                                            <div v-if="errors.name">{{ errors.name }}</div>
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
                                            {{ $v.form.name.$params.minLength.min }}
                                            shkronja.
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
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3"
                                            id="grid-email"
                                            type="email"
                                            name="email"
                                            v-model="form.email"
                                            placeholder="E-mail"
                                            />
                                            <div v-if="errors.email">{{ errors.email }}</div>
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
                                        <div
                                        class="flex flex-wrap -mx-3 mb-6"
                                        >
                                        <div
                                            class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                        >
                                            <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password"
                                            >
                                            Password
                                            </label>
                                            <input
                                            :class="[
                                                $v.form.password.$invalid === true ||
                                                $v.form.password_confirmation
                                                .$invalid === true
                                                ? 'border-red-500'
                                                : 'border-grey-200',
                                            ]"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-password"
                                            type="password"
                                            placeholder="******************"
                                            name="password"
                                            v-model="form.password"
                                            />
                                              <div v-if="errors.password">{{ errors.password }}</div>
                                            <p
                                            v-if="!$v.form.password.required"
                                            class="text-red-500 text-xs italic"
                                            >
                                            Fusha është e zbrazët.
                                            </p>
                                            <p
                                            v-if="!$v.form.password.minLength"
                                            class="text-red-500 text-xs italic"
                                            >
                                            Fusha duhet të ketë së paku
                                            {{
                                                $v.form.password.$params.minLength.min
                                            }}
                                            karaktere.
                                            </p>
                                        </div>
                                        <div
                                            class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                        >
                                            <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password-confirm"
                                            >
                                            Password Konfirmo
                                            </label>
                                            <input
                                            :class="[
                                                $v.form.password.$invalid === true ||
                                                $v.form.password_confirmation
                                                .$invalid === true
                                                ? 'border-red-500'
                                                : 'border-grey-200',
                                            ]"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-password-confirm"
                                            type="password"
                                            placeholder="******************"
                                            name="password_confirmation"
                                            v-model="form.password_confirmation"
                                            />
                                            
                                            <p
                                            v-if="
                                                !$v.form.password_confirmation
                                                .sameAsPassword
                                            "
                                            class="text-red-500 text-xs italic"
                                            >
                                            Passwordet nuk jane te njejta
                                            </p>
                                        </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                        <div
                                            class="w-full md:w-1/2 px-3 mb-6 md:mb-0"
                                        >
                                            <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-color"
                                            >
                                            Ngjyra
                                            </label>
                                            <div class="relative">
                                            <select
                                                :class="[
                                                $v.form.color.$invalid === true
                                                    ? 'border-red-500'
                                                    : 'border-grey-200',
                                                ]"
                                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-color"
                                                name="color"
                                                v-model="form.color"
                                            >
                                                <option value="#4e73df">Kaltër</option>
                                                <option value="#00008b">
                                                Kaltër e errët
                                                </option>
                                                <option value="#6f42c1">Vjollce</option>
                                                <option value="#e83e8c">Rozë</option>
                                                <option value="#e74a3b">Kuqe</option>
                                                <option value="#fd7e14">
                                                Portokalli
                                                </option>
                                                <option value="#f6c23e">Verdhë</option>
                                                <option value="#1cc88a">
                                                Gjelbërt
                                                </option>
                                                <option value="#36b9cc">
                                                Gjelbërt e lehte
                                                </option>
                                                <option value="#3a3b45">Hiri</option>
                                                <option value="#000000">Zezë</option>
                                            </select>
                                              <div v-if="errors.color">{{ errors.color }}</div>
                                            <p
                                                v-if="!$v.form.color.required"
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
                                            for="grid-role"
                                            >
                                            Roli
                                            </label>
                                            <div class="relative">
                                            <select
                                                :class="[
                                                $v.form.role_id.$invalid === true
                                                    ? 'border-red-500'
                                                    : 'border-grey-200',
                                                ]"
                                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-role"
                                                name="role_id"
                                                v-model="form.role_id"
                                            >
                                                <option
                                                v-for="role in roles"
                                                :key="role.id"
                                                :value="role.id"
                                                >
                                                {{ role.name }}
                                                </option>
                                            </select>
                                              <div v-if="errors.role_id">{{ errors.role_id }}</div>
                                            
                                            <p
                                                v-if="!$v.form.role_id.required"
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
                        <div class="flex w-full rounded-md shadow-sm flex-row-reverse float-right"  >
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


<script>
import AppLayout from "./../../Layouts/AppLayout";
import { required, sameAs, minLength, email } from "vuelidate/lib/validators";
export default {
    props: {
        roles: Array,
        errors: Object, 
    },
    metaInfo: { title: 'Krijo Përdorues' },
    components: {
        AppLayout,
    },
    data() {
        return {
            form: {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                color: this.color,
                role_id: this.role_id,
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
            password: {
                required,
                minLength: minLength(6),
            },
            password_confirmation: {
                sameAsPassword: sameAs("password"),
            },
            color: {
                required,
            },
            role_id: {
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
            this.$inertia.post("/user", data);
        }
    },
  },

}
</script>
