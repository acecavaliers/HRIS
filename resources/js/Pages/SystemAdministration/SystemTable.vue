<script setup>
/* import SystemTableMain from '@/Pages/SystemAdministration/SystemTablesMain.vue'; */
/* import { Head } from '@inertiajs/vue3'; */
import DataTableSingle from '@/Pages/Templates/DataTableSingle.vue';
import ModalConfirmation from '@/Pages/Templates/ModalConfirmation.vue';
import Pagination from '@/Pages/Templates/Pagination.vue';
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
</script>

<template>
   <!--  <Head title="System Tables" />
 -->
 
        <AlertNotification></AlertNotification>

        <br>

        <DataTableSingle tabletitle="System Tables" tabledescription="" :tabledata="tablenames" :columns="columns" >
       
       
            <template #action_column="slotprops">
        <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
            <button @click="migrateTables(slotprops.tabledata)" class="text-indigo-600 hover:text-indigo-900"
            >Migrate</button>
        </td>
        </template>

       

        </DataTableSingle>

        
        <ModalConfirmation dialog-title="Migrate Table" dialog-confirmation-message="Are you sure you want to migrate this table?" confirmation-btn-text="Migrate">
            <template #default>
                <ul>
                    <li class="font-bold">{{ tablename }}</li>
                </ul>
            </template>
        </ModalConfirmation>

      



      


</template>


<script>
export default {
    name: 'SystemTable',
    data() {
        return {
           
            columns: ['Table Name'],
            tablenames: [],
            systemtablesdata: [],
            tablename: '',
            showalert: false
        }
    },

    methods: {
        getsystemtablesdata(){
            axios.get('/systemtablelistalldata').then(response => {
                this.systemtablesdata = response.data;
                console.log(response.data)
            })
        },

        


        gettablenames(){
            var tablenamearr = [];
            var arr = [];
            var x = this;
            var filteredResult = []
          
            axios.get('/gettablenames').then(response => {

               const mp = new Map();
                 this.systemtablesdata.forEach( i => mp.set(i.table_name, true))
                 filteredResult = response.data.filter(i => !mp.has(i.replace("hris_","")));
                 
             
                this.tablenames = filteredResult
              console.log(filteredResult)
                
          /*       this.tablenames = response.data */
          /*     console.log(response.data); */
            })
        },

        migrateTables(tablename){
         
           this.emitter.emit('openModalConfirmation', true);
           this.tablename = tablename

        },

        confirmMigrateTable(tablename){
          axios.post('/systemtables', {table_name: tablename}).then(response => {
        
           this.emitter.emit('openModalConfirmation', false)
           this.emitter.emit('refreshDataSystemTable')
           this.emitter.emit('alertType', 'success')
           this.emitter.emit('alertText', 'Successfully migrated')
           this.emitter.emit('showAlert', true)

          })  
            
        }

  

    },

    created(){
        this.getsystemtablesdata();
        this.gettablenames();
        this.emitter.on('callModalConfirmationSystemTable', (evt) => {
            if(evt == true){
                this.confirmMigrateTable(this.tablename);

            }
        })
        this.emitter.on('refreshDataSystemTable', (evt) =>{
            this.getsystemtablesdata();
            this.gettablenames();
        });
     
    }


}
</script>