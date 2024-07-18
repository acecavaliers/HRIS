<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="Employee Type" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employee Type</h2>
        </template>

        <AlertNotification></AlertNotification>
            <DataTable tabletitle="EmployeeType" tabledescription="List of all Emmployee Types" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="employeetypes.search" routename="employeetypes" formtitle="EmployeeTypes" :ismainsidebar=true :customaddbtn=false modelname="EmployeeType">

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
            model_name: 'EmployeeType',
            showrecordsval: 10,
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('employeetypes.getlist'),{
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
            axios.get(route('employeetypes.getcolumns'), {
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
