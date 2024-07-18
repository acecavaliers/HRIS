<template>
    <Head title="Employees" />
     <MasterLayout>
        <template #header>
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">PERSONNEL REQUISITION</h2>
        </template>
     <!--    <Breadcrumbs :pages="breadcrumbspages"></Breadcrumbs> -->
     <Tabs :tabs="tabs"> 
        <template #tabcontent>
              <span v-if="tabselected.name">
                <DataTable tabletitle="Personnel Requisition" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="personnelrequisitions.search" routename="personnelrequisitions" formtitle="Personnel Requisition" :ismainsidebar=true :customaddbtn=false modelname="PersonnelRequisition">

                </DataTable>
              </span>

        </template>
    </Tabs>

  
    </MasterLayout>
</template>

<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import Tabs from '@/Pages/Templates/Tabs.vue';
import DataTable from '@/Pages/Templates/DataTable.vue';
</script>

<script>
export default {
    data(){
        return {
            componentname: '',
            tabs: [
                { name: 'ALL', href: '#', current: true},
             /*    { name: 'PENDING', href: '#', current: true}, */
                { name: 'FOR APPROVAL', href: '#', current: false},
                { name: 'APPROVED', href: '#', current: false},
                { name: 'CANCELLED', href: '#', current: false},
                { name: 'ON HOLD', href: '#', current: false},
                { name: 'DISAPPROVED', href: '#', current: false},
            
                  
            ],
            data: [],
            columns: [],
            defaultfilteredcolumns: [],
            model_name: 'PersonnelRequisition',
            showrecordsval: 10,
            tabselected: [],
        }
    },

    methods: {
     

        getData(){
            this.data = [];
            this.emitter.emit('loadingdata', true)
            axios.get(route('personnelrequisitions.getlist'),{
                params:{
                    showrecords: this.showrecordsval,
                    tabstatusselected: this.tabselected.name
                }
            }).then(response => {
                if(response.data == 'NOT FOUND'){
                    this.data = [];
                }else{
                    this.data = response.data
                }
               
                console.log(response.data)
                this.emitter.emit('loadingdata', false)
            })
        },
        getcolumns(){
            var filtercol = [];
            this.emitter.emit('loadingcolumns', true)
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
                this.emitter.emit('loadingcolumns', false)
           })
          },
    },

    created(){
    /*     this.getData(); */
      /*   this.getcolumns(); */

        this.emitter.on('refreshData-'+this.$page.url.replace('/',''), (evt)=>{
            this.showrecordsval = evt;
            this.getData();
        })

         //used for searching and pagination
         this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
            this.data = evt;
        })

    
        this.emitter.on('selectedTab', (evt)=>{
            this.tabselected = evt
            this.getData();
            this.getcolumns();
            console.log(this.tabselected)
        })
    }

    
}



</script>