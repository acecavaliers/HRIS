<template>
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
        <div class="space-y-6 sm:space-y-5">
            <!-- Multi Select -->
            <div v-if="title === 'WorkShift'">


                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Show multi select here for Divisionsssssss
                        <span  class="text-red-600">*</span>
                    </label>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <div ref="modalContainer" class="max-w-lg relative ">
                                <button
                                @click="modalOpen('division','')"
                                type="button"
                                    class="text-xs inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <span class="bg-red-200 px-1 rounded">Select</span>
                                    <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                                </button>
                                <div v-if="isModalVisible" class="rounded-md mt-1 bg-gray-300 absolute left-0 z-10 w-104 overflow-auto origin-top-right max-h-96 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="cursor-pointer">
                                        <div v-for="(item, index) in divisions" :key="item.id">
                                            <label class="flex justify-start cursor-pointer w-full space-x-3 px-3 py-2 text-xs border-b hover:bg-gray-100">
                                                <input id="cbx-restDay" type="checkbox" v-model="item.checked"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                                <span>{{ item.name }}</span>
                                            </label>
                                        </div>
                                        <div class="mt-10">

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Show multi select here for Divisionssssss
                        <span  class="text-red-600">*</span>
                    </label>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <div class="flex max-w-lg rounded-md shadow-sm">
                            <select class="w-full rounded-r-md border-gray-300" name="" id="">
                                <option selected disabled>Select</option>
                                <option v-for="divs in divisions" :key="divs.id" :value=divs.id >{{ divs.name }}</option>
                            </select>
                        </div>
                    <!-- <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p> -->
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Show multi select here for Departmentsssss
                        <span  class="text-red-600">*</span>
                    </label>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <div class="flex max-w-lg rounded-md shadow-sm">
                            <select class="w-full rounded-r-md border-gray-300" id="">
                                <option selected disabled>Select</option>
                                <option v-for="dep in departments" :key="dep.id">{{ dep.id }}. {{ dep.name }}</option>
                            </select>
                        </div>
                    <!-- <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p> -->
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Show multi select here for Sub-Departmentssss
                        <span  class="text-red-600">*</span>
                    </label>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <div class="flex max-w-lg rounded-md shadow-sm">
                            <select class="w-full rounded-r-md border-gray-300" id="">
                                <option selected disabled>Select</option>
                                <option v-for="dep in departments" :key="dep.id">{{ dep.id }}. {{ dep.name }}</option>
                            </select>
                        </div>
                    <!-- <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p> -->
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                        Show multi select here for Sub-Department Units
                        <span  class="text-red-600">*</span>
                    </label>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <div class="flex max-w-lg rounded-md shadow-sm">
                            <select class="w-full rounded-r-md border-gray-300" id="">
                                <option selected disabled>Select</option>
                                <option v-for="dep in departments" :key="dep.id">{{ dep.id }}. {{ dep.name }}</option>
                            </select>
                        </div>
                    <!-- <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p> -->
                    </div>
                </div>

            </div>
        </div> <!-- /space-y-8 divide-y divide-gray-200 sm:space-y-5 -->
    </div>
</template>

<script setup>

import { Head,Link } from '@inertiajs/vue3';
import { Switch} from '@headlessui/vue'
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'
import { computed, ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { Combobox,ComboboxButton,ComboboxInput,ComboboxLabel,ComboboxOption,ComboboxOptions, TransitionRoot,} from '@headlessui/vue'

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from 'axios';
import { faLessThan } from '@fortawesome/free-solid-svg-icons';
import FormsNotYetMigrated from '@/Pages/Templates/FormsNotYetMigrated.vue'
import defaultavatar from '@/images/default_avatar_profile_icon.jpg';


</script>
<script>
export default {
  props: { divisions: Object},

  data(){
      return{
        //   divisions: [],
          departments: [],
          isModalVisible: false,
          isModalDept: false,
      }
  },


  methods:{
    modalOpen(name, id){
            if(name === 'division'){
                this.isModalVisible = !this.isModalVisible;
                this.isModalDept = false;
            }
            if(name === 'department'){
                this.isModalDept = ! this.isModalDept;
            }

        },
    async getDepartments() {
            try {
                const response = await axios.get(route('employeeworkschedule.getDept'));
                this.departments = response.data.map((val) => ({
                id: val.id,
                checked: false,
                name: val.name,
                division_id: Number(val.division_id),
                }));
            } catch (error) {
                console.error('Error fetching departments:', error);
            }

            try {
                const response = await axios.get(route('employeeworkschedule.getDivisions'));
                this.divisions = response.data.map((val) => {
                const depts = this.departments.filter(dept => dept.division_id === val.id);
                return {
                    id: val.id,
                    name: val.name,
                    depts: depts,
                };
                });
            } catch (error) {
                console.error('Error fetching divisions:', error);
            }
        },

  },

  created(){
    this.getDepartments();
  },
}
</script>
