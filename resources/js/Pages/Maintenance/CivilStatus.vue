<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="Civil Status" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Civil Status</h2>
        </template>

        <AlertNotification></AlertNotification>

        <DataTable tabletitle="Civil Status" tabledescription="List of all civilstatuses" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="civilstatuses.search" routename="civilstatuses" formtitle="CivilStatus" :ismainsidebar=true :customaddbtn=false modelname="CivilStatus">

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
            model_name: 'CivilStatus',
            showrecordsval: 10,
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('civilstatuses.getlist'),{
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
            axios.get(route('civilstatuses.getcolumns'), {
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

        this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
            this.data = evt;
        })
    }


}


</script>
