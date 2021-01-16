<template>
    <app-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <h3 class="font-semibold text-lg text-gray-800 inline">Krijo Rolin</h3>
                    </div>
                    <div class="block w-full px-10 py-5">
                        <form class="w-full select-none" @submit.prevent="submitForm">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                    <label class="select-none   block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                        Emri
                                    </label>
                                            <input
                                            :class="[
                                                $v.form.name.$invalid === true
                                                ? 'border-red-500'
                                                : 'border-grey-200',
                                            ]"
                                            class=" select-text appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-name"
                                            type="text"
                                            placeholder="Emri"
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
                                        <div class="flex flex-wrap -mx-3 mb-6 items-center select-none">
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class=" select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                    Pacienti
                                                </label>
                                                <input value="1" id="view-pacient" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="view-pacient" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="2" id="create-pacient" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="create-pacient" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="3" id="edit-pacient" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-pacient" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="4" id="delete-pacient" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-pacient" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Termini
                                                </label>
                                                <input value="5" id="view-appointment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-appointment" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="6" id="create-appointment" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-appointment" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="7" id="edit-appointment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-appointment" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="8" id="delete-appointment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-appointment" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Vizita
                                                </label>
                                                <input value="9" id="view-visit" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-visit" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="10" id="create-visit" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-visit" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="11" id="edit-visit" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-visit" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="12" id="delete-visit" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-visit" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6 items-center select-none">
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class=" select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                    Tretmani
                                                </label>
                                                <input value="13" id="view-treatment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="view-treatment" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="14" id="create-treatment" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="create-treatment" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="15" id="edit-treatment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-treatment" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="16" id="delete-treatment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-treatment" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Raport
                                                </label>
                                                <input value="17" id="view-report" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-report" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="18" id="create-report" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-report" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="19" id="edit-report" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-report" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="20" id="delete-report" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-report" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Shërbimet
                                                </label>
                                                <input value="21" id="view-services" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-services" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="22" id="create-services" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-services" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="23" id="edit-services" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-services" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="24" id="delete-services" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-services" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6 items-center select-none">
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class=" select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                    Përdoruesit
                                                </label>
                                                <input value="25" id="view-user" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="view-user" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="26" id="create-user" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="create-user" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="27" id="edit-user" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-user" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="28" id="delete-user" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-user" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Rolet
                                                </label>
                                                <input value="29" id="view-role" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-role" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="30" id="create-role" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-role" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="31" id="edit-role" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-role" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="32" id="delete-role" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-role" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Borgjet
                                                </label>
                                                <input value="33" id="view-debt" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-debt" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="34" id="create-debt" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-debt" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="35" id="edit-debt" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-debt" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="36" id="delete-debt" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-debt" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6 items-center select-none">
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class=" select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                    Faturat
                                                </label>
                                                <input value="37" id="view-bill" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="view-bill" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="38" id="create-bill" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="create-bill" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="39" id="edit-bill" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-bill" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="40" id="delete-bill" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-bill" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
                                            </div>
                                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="select-none  block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
                                                    Pagesat
                                                </label>
                                                <input value="41" id="view-payment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="view-payment" class="select-none font-medium text-gray-700 mr-1">Shiko</label>
                                                <input value="42" id="create-payment" v-model="form.permissions"  type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="create-payment" class="select-none font-medium text-gray-700 mr-1">Krijo</label>
                                                <input value="43" id="edit-payment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded ">
                                                <label for="edit-payment" class="select-none font-medium text-gray-700 mr-1">Ndrysho</label>
                                                <input value="44" id="delete-payment" v-model="form.permissions" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                                <label for="delete-payment" class="select-none font-medium text-gray-700 mr-1">Fshij</label>
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


<script>
import AppLayout from "./../../Layouts/AppLayout";
import { required,minLength } from "vuelidate/lib/validators";
export default {
    props: {
        roles: Array,
        errors: Object, 
    },
    metaInfo: { title: 'Krijo Rolin' },
    components: {
        AppLayout,
    },
    data() {
        return {
            form: {
                name: this.name,
                permissions: [],
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
            permissions: {
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
            this.$inertia.post("/role", data);
        }
    },
  },

}
</script>
