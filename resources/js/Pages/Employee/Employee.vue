<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
import { computed } from 'vue'
</script>

<template>
    <Head title="Employee" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">EMPLOYEES</h2>
            
        </template>
       <!--  <br> -->

        

        <AlertNotification></AlertNotification>

        <DataTable tabletitle="" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="employees.search" routename="employees" formtitle="Employees" :ismainsidebar=true :customaddbtn=true modelname="Employee">

            <template #customfilterform>

            </template>

            <template #customAddBtn>
                <Link @click="addnew()" :href="route('employeemanage', 'add')" type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <font-awesome-icon icon="fa-solid fa-plus" class="-ml-0.5 h-5 w-5"/> Add
                </Link>
            </template>

            <template #customEditBtn="slotprops">

                
                <Link :href="route('employeemanage', ['edit', slotprops.tbldata.id])" v-if="slotprops.currentmodule.enable_edit_button == 1" @click="editdata(slotprops.tbldata)" type="button" class="relative inline-flex items-center rounded-l-md bg-yellow-200 px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"><font-awesome-icon icon="fa-solid fa-pen-to-square" class="-ml-0.5 h-5 w-5"/></Link>

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
            model_name: 'Employee',
          
            
            
           
        }
    },

  
    methods: {
        addnew(){
        
           console.log('addnew')
           // this.emitter.emit('openEmployeeMain', 'hello')
        },

        editdata(data){
            
           /*  var mydata = {  
                editmode: true,
                datavalues: data
            }
           
            this.emitter.emit('openEmployeeMain', mydata) */
        },


        getData(){
            this.emitter.emit('loadingdata', true)
            axios.get(route('employees.getlist')).then(response => {
                this.data = response.data
                this.emitter.emit('loadingdata', false)
            })
        },


        getcolumns(){
            var filtercol = [];
            this.emitter.emit('loadingcolumns', true)
            axios.get(route('employees.getcolumns'), {
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
            this.getData();
        })

         //used for searching and pagination
         this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
            this.data = evt;
        })
    },

    activated() {
       
        console.log('activated')
    },
    deactivated() {
      
        console.log('deactivated')
    },


}


</script>
