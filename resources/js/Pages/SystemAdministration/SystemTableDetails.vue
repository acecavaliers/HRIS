<template>

   <MasterLayout>
           <template #header>
               <h2 class="font-semibold text-xl text-gray-800 leading-tight">System Tables Details</h2>
           </template>
   
       <br>
   
       <AlertNotification></AlertNotification>

       <DataTable tabletitle="System Tables Details" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="systemtabledetailssearch" routename="systemtabledetails" formtitle="System Table Details" :ismainsidebar=true :customaddbtn=false modelname="SystemTableDetail">
      
        <!--   <template #action_column="slotprops">
               <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                   <button @click="migrateColumns(slotprops.tabledata)" class="text-indigo-600 hover:text-indigo-900"
                   >Migrate Columns</button>
               </td>
          </template> -->
          <template #customfilterform>
   
            <div class="grid grid-cols-4 gap-4">
            <div>
              
          
            <Listbox as="div" v-model="selected">
   
               <div class="relative mt-2">
                  <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span class="block truncate">{{ selected.table_name }}</span>
                  <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                     <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                  </ListboxButton>
   
                  <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                  <ListboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                     <ListboxOption as="template" v-for="systemtable in systemtables" :key="systemtable.id" :value="systemtable" v-slot="{ active, selected }">
                        <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                        <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ systemtable.table_name }}</span>
   
                        <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                           <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                        </li>
                     </ListboxOption>
                  </ListboxOptions>
                  </transition>
               </div>
            </Listbox>
         </div>
   
         <div class="mt-2">
            <button @click="filterSystemTable()" type="button" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Filter</button>
         </div>
      </div>
   
   
          </template>

        
   
   
       </DataTable>
   
   
   
   
   
      </MasterLayout>
   
       </template>
   
   
   
       <script setup>
         import MasterLayout from '@/Layouts/MasterLayout.vue';
         import { Head } from '@inertiajs/vue3';
         import { Link } from '@inertiajs/vue3';
         import axios from 'axios';
         import DataTable from '@/Pages/Templates/DataTable.vue';
         import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
         import { ref } from 'vue'
         import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
         import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
      

     
   
       </script>
   
   
   
       <script>
   
       export default {
         
         
          name: 'SystemTableDetails',
    
   
          data(){
             return {
                columns: [],
                data: [],
                migratetablename: '',
                datatomigrate: [],
                model_name: 'SystemTableDetail',
                defaultfilteredcolumns: [],
                systemtables: [],
                selected: [],
                showrecordsval: ''
          
             
               
               
   
             }
          },
   
          methods:{
        

             getSystemTables(){
               axios.get('/systemtablelistalldata').then(response => {
                  this.systemtables = response.data
                  this.selected = this.systemtables[0];
          
   
               })
             },
   
             getlist(){
               console.log(this.showrecordsval)
   
                this.emitter.emit('loadingdata', true)
                axios.get(route('systemtablesdetails.getlist'), {
                  params: {
                     showrecords: this.showrecordsval
                  }
                 
                }).then(response => {
                   this.data = response.data
                   this.emitter.emit('loadingdata', false)
                  
   
                })
             },
   
             getcolumns(){
               var filtercol = [];
               this.emitter.emit('loadingcolumns', true)
               axios.get(route('systemtablesdetails.getcolumns'), {
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
                   this.emitter.emit('loadingcolumns', false)
              })
             },
   
             filterSystemTable(){
               this.emitter.emit('loadingdata', true)
               axios.get('/systemtablesdetails/getspecificlist', {
                  params:{
                     paramVal: this.selected.id
                  }
               }).then(response => {
                  this.data = response.data
                  this.emitter.emit('getParamValues', this.selected.id)
                  this.emitter.emit('loadingdata', false)
               }).catch(ex => {
                  console.log(ex)
               })
             }
   
   
   
          },
   
          created(){
  
            this.getSystemTables();
             this.getlist();
             this.getcolumns();
   
             //used for searching
             this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
                   this.data = evt;
             })
   
             this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt) => {
               this.showrecordsval = evt;
               this.getlist();
             })
   
   
          /*    this.emitter.on('deleteSubmit-'+this.$page.url.replace('/',''), (evt) => {
               this.deleteData()
             })

             
        */
      
   
   
          }
       }
   
   
   
       </script>
   