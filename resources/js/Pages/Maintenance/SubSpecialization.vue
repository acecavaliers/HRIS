<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="SubSpecialization" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sub Specialization</h2>
        </template>

        <AlertNotification></AlertNotification>

        <DataTable tabletitle="SubSpecialization" tabledescription="List of all subspecializations" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="subspecializations.search" routename="subspecializations" formtitle="subspecializations" :ismainsidebar=true :customaddbtn=false modelname="SubSpecialization">

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
            model_name: 'SubSpecialization',
            showrecordsval: 10,
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('subspecializations.getlist'),{
                params:{
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
            axios.get(route('subspecializations.getcolumns'), {
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

    },

    created(){
        this.getData();
        this.getcolumns();

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.showrecordsval = evt;
            this.getData();
        })

         //used for searching and pagination
         this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
            this.data = evt;
        })
    }


}


</script>
