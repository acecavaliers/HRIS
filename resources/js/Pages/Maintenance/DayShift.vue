<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="Day Shifts" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Day Shift </h2>
        </template>

        <AlertNotification></AlertNotification>

        <DataTable tabletitle="Day Shifts" tabledescription="List of all dayshifts" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="dayshifts.search" routename="dayshifts" formtitle="DayShifts" :ismainsidebar=true :customaddbtn=false modelname="DayShift">

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
            model_name: 'DayShift',
            showrecordsval: 10,
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('dayshifts.getlist'),{
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
            axios.get(route('dayshifts.getcolumns'), {
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
