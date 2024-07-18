<template>
    <div>
        <AlertNotification></AlertNotification>
        <DataTable tabletitle="EDUCATION BACKGROUND" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="id" columnkey="id" searchroutename="employeeeducation.search" routename="employeeeducation" formtitle="Education Background" :customaddbtn=false :ismainsidebar=false modelname="EmployeeEducation" :datavaluesreferencedother="datavalues">

                <template #customfilterform>

                </template>

        </DataTable>

    </div>
</template>

<script setup>
import DataTable from '@/Pages/Templates/DataTable.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<script>
     export default {
        props: ['editmode', 'datavalues'],
        name: 'EmployeeEducation',
        data(){
       
       return {
           data: [],
           columns: [],
           defaultfilteredcolumns: [],
           model_name: 'EmployeeEducation',
           showrecordsval: 10,
        
         
       }
   },
   methods: {
       getData(){
           this.emitter.emit('loadingdata', true)
           axios.get(route('employeeeducation.getlist'), {
            params: {
                employee_id: this.datavalues['id'],
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
           axios.get(route('employeeeducation.getcolumns'), {
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
    
       this.emitter.on('refreshData-'+this.model_name, (evt)=>{
        this.showrecordsval = evt;
           this.getData();
       })

        //used for searching and pagination
        this.emitter.on('refreshDatawithPagination-'+this.model_name, (evt) => {
           this.data = evt;
       })
   }
     }
</script>
