<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
import getDatawithColumns from '@/Hooks/getDatawithGetColumns.js';
import getDatawithShowRecords from '@/Hooks/getDatawithShowRecords.js';
</script>

<template>
    <Head title="Regions" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Regions</h2>
        </template>

        <AlertNotification></AlertNotification>
            <DataTable tabletitle="Regions" tabledescription="List of all regions" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="regions.search" routename="regions" formtitle="Regions" :ismainsidebar=true :customaddbtn=false modelname="Region">

                <template #customfilterform>

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
            model_name: 'Region',
            showrecordsval: 10,
            
        }
    },

    methods: {
        async getData(){
         
            this.emitter.emit('loadingdata', true)
            this.data =(await getDatawithShowRecords(route('regions.getlist'), this.showrecordsval)).responseData
            this.emitter.emit('loadingdata', false)
          
        },
        async getcolumns(){
            this.emitter.emit('loadingcolumns', true)
            this.columns =(await getDatawithColumns(route('regions.getcolumns'), this.model_name)).responseData
            this.emitter.emit('filtercolumn', (await getDatawithColumns(route('regions.getcolumns'), this.model_name)).defaultfilteredcolumns)
            this.emitter.emit('loadingcolumns', false)
        },

    },

    created(){
        this.getData();
        this.getcolumns();

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (showrecordsval)=>{
            this.showrecordsval = showrecordsval;
            this.getData();
        })

        //used for searching and pagination
        this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
   
            this.data = evt;
        })

       
    }


}


</script>
