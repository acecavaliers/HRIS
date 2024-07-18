<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="Applicant" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Applicant</h2>
        </template>

        <AlertNotification></AlertNotification>
            <DataTable tabletitle="Applicant" tabledescription="List of all applicants" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="applicants.search" routename="applicants" formtitle="applicants">

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
            model_name: 'Applicant',
        }
    },

    methods: {
        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('applicants.getlist')).then(response => {
                this.data = response.data
                this.emitter.emit('loadingdata', false)
            })
        },
        getcolumns(){
            var filtercol = [];
            axios.get(route('applicants.getcolumns'), {
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

    },

    created(){
        this.getData();
        this.getcolumns();

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.getData();
        })
    }


}


</script>
