<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
/* import DataTableWithCustomColumn from '@/Pages/Templates/DataTableWithCustomColumn.vue'; */
import DataTablewithGroup from '@/Pages/Templates/DataTablewithGroup.vue';
import getDatawithParams from '@/Hooks/getDatawithParam.js';
import moment from 'moment';
</script>

<template>
    <Head title="Clock Entries" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clock Entries</h2>
        </template>

       
        <DataTablewithGroup tabletitle="" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="CHECKTIME" :hasCustomColumn="true">
           
            <template #customfilterform>

                <div class="flex flex-row gap-4">
                    <div class="w-auto">
                        <label for="datefrom" class="block text-sm font-medium text-gray-700">From</label>
                    </div>
                    <div class="w-1/4">
                        <input type="date" :max="maxDate" v-model="selectedDate[0]" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">     
                    </div>
                    <div class="w-auto">
                        <label for="dateto" class="block text-sm font-medium text-gray-700">To</label>
                    </div>
                    <div class="w-1/4">
                        <input type="date" :max="maxDate" v-model="selectedDate[1]" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>

                    <div class="w-auto">
                        <button @click="filterDate()" type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Filter</button>
                    </div>

                </div>

             <!--    <label for="datefrom" class="block text-sm font-medium text-gray-700">From</label>
                <input @change="changeSelectedDateFrom()" type="date" :max="maxDate" v-model="selectedDateFrom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <label for="dateto" class="block text-sm font-medium text-gray-700">To</label>
                <input @change="changeSelectedDateTo()" type="date" :max="maxDate" v-model="selectedDateTo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> -->
            </template>


            <template #groupdata="slotprops">
             <!--    <span v-for="(tbldata, index) in slotprops.groupdata" :key="tbldata['id']"> -->
                   
                <th  scope="colgroup" class="bg-gray-50 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">{{ slotprops.groupdata['date'] }}</th>
               <!--  </span> -->
            </template>

            <template #customcolumn="slotprops">
          
                <span v-if="slotprops.tabledata[slotprops.column] == 'I'">
                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">CHECK-IN</span>
                </span>
                <span v-else-if="slotprops.tabledata[slotprops.column] == 'O'">
                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">CHECK-OUT</span>
                </span>
                <span v-else-if="slotprops.tabledata[slotprops.column] == '0'">
                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">BREAK-OUT</span>
                </span>
                <span v-else-if="slotprops.tabledata[slotprops.column] == '1'">
                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">BREAK-IN</span>
                </span>
                <span v-else>
                   
                </span>
            </template>

          
    
        </DataTablewithGroup>


    </MasterLayout>

</template>

<script>

export default {
    data(){
        return {
            data: [],
            columns: [ 'CHECKINDATE','CHECKTIME', 'CHECKTYPE'],
            defaultfilteredcolumns: [],
            showrecordsval: 10,
            selectedDate: [new Date().toISOString().split('T')[0],new Date().toISOString().split('T')[0]],
          
            maxDate: new Date().toISOString().split('T')[0],
           
       
          
        }
    },

    methods: {
        async getData(){
            this.emitter.emit('loadingdata', true)
            
            this.data =(await getDatawithParams(route('clockentries.getClockEntriesByUserID'), this.showrecordsval, this.selectedDate)).responseData
           console.log(this.data);

          
            this.emitter.emit('loadingdata', false)

         
        },

        filterDate(){
            this.getData();
        }
    
    },

    created(){
        this.getData();
      /*   this.getcolumns(); */

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.getData();
        })

         //used for searching and pagination
         this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
            this.data = evt;
        })
    }


}


</script>
