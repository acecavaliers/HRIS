<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
    <Head title="Recruitment Dashboard" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recruitment Dashboard</h2>
        </template>

       <!--  <AlertNotification></AlertNotification>
            <DataTable tabletitle="PersonnelRequisition" tabledescription="List of all personnelrequisitions" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="personnelrequisitions.search" routename="personnelrequisitions" formtitle="personnelrequisitions">

                <template #customfilterform>

                </template>

            </DataTable>
 -->

    </MasterLayout>

</template>

<script>

export default {
    data(){
        return {
          /*   data: [],
            columns: [],
            defaultfilteredcolumns: [],
            model_name: 'PersonnelRequisition', */
        }
    },

    methods: {
    /*     getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('personnelrequisitions.getlist')).then(response => {
                this.data = response.data
                this.emitter.emit('loadingdata', false)
            })
        },
        getcolumns(){
            var filtercol = [];
            axios.get(route('personnelrequisitions.getcolumns'), {
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
          }, */

    },

    created(){
     /*    this.getData();
        this.getcolumns();

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.getData();
        }) */
    }


}


</script>
