<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'

const enabled = ref(false)

</script>

<template>
    <Head title="Roles" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <AlertNotification></AlertNotification>
            <DataTable tabletitle="Roles" tabledescription="List of all roles" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="roles.search" routename="roles" formtitle="Roles">

                <template #customfilterform>

                </template>

                <template #additionalformcontent>
                    <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-start">
                            <span class="bg-white pr-3 text-base font-semibold leading-6 text-gray-900">Permissions</span>
                            </div>
                        </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                        <fieldset>

                            <div class="relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300" />
                                </div>
                                <div class="relative flex justify-start">
                                <Switch v-model="enabled" class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                                    <span class="sr-only">Use setting</span>
                                    <span aria-hidden="true" class="pointer-events-none absolute h-full w-full rounded-md bg-white" />
                                    <span aria-hidden="true" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out']" />
                                    <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out']" />
                                </Switch>

                                <span class="bg-white pr-3 pl-3 text-sm text-gray-500">Continue</span>
                                </div>
                            </div>


                            <div class="space-y-2" v-for="permission in permissions" :key="permission.id">
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                    <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="ml-4 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                    <label for="comments" class="font-medium text-gray-900">{{ permission.name }}</label>
                                    </div>
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>

                    <!-- sdfsdf -->
                    <div>
                        <fieldset>

                            <div class="relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300" />
                                </div>
                                <div class="relative flex justify-start">
                                <Switch v-model="enabled" class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                                    <span class="sr-only">Use setting</span>
                                    <span aria-hidden="true" class="pointer-events-none absolute h-full w-full rounded-md bg-white" />
                                    <span aria-hidden="true" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out']" />
                                    <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out']" />
                                </Switch>

                                <span class="bg-white pr-3 pl-3 text-sm text-gray-500">Continue</span>
                                </div>
                            </div>


                            <div class="space-y-2" v-for="permission in permissions" :key="permission.id">
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                    <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="ml-4 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                    <label for="comments" class="font-medium text-gray-900">{{ permission.name }}</label>
                                    </div>
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>

                     </div>
                </template>
                

            </DataTable>


    </MasterLayout>

</template>

<script>

export default {
    data(){
        return {
            data: [],
            columns: [],
            defaultfilteredcolumns: [],
            model_name: 'Role',
            permissions: [],
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('roles.getlist')).then(response => {
                this.data = response.data
                this.emitter.emit('loadingdata', false)
            })
        },
        getcolumns(){
            var filtercol = [];
            axios.get(route('roles.getcolumns'), {
            params:{
                modelName: this.model_name
            }
           }).then(response => {
                this.columns = response.data;
                response.data.forEach((val)=>{
                    if(val.enable_display_column == 1){
                        filtercol.push(val)
                    }
                })

                this.defaultfilteredcolumns = filtercol;

                this.emitter.emit('filtercolumn', this.defaultfilteredcolumns)
           })
          },
          getPermissions(){
            axios.get(route('permissions.getActiveList')).then(response => {
                this.permissions=response.data
                console.log(response.data)
            })
          }

    },

    created(){
        this.getPermissions();
        this.getData();
        this.getcolumns();
      
        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.getData();
        })
    }


}


</script>
