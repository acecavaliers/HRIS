<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
/* import ComponentStore from '@/ComponentStore.js' */
import SystemTable from '@/Pages/SystemAdministration/SystemTable.vue'
import SystemTableMigrated from '@/Pages/SystemAdministration/SystemTableMigrated.vue'

</script>

<template>
    <Head title="System Tables" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">System Tables</h2>
        </template>

        <div class="py-12">
            <div class="grid grid-flow-row-dense grid-cols-5 gap-4">
                <div class="bg-gray">
                  
                    <nav class="flex flex-1 flex-col" aria-label="Sidebar">
                        <ul role="list" class="-mx-2 space-y-1">
                        <li v-for="item in tabs" :key="item.id">
                         
                            <button @click="TabClicked(item)" :class="[item.component_name === componentname? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold']">{{ item.tab_name }}</button>
                        </li>
                        </ul>
                    </nav>

                </div>
                <!-- ... -->
                
                <div class="col-span-4">
        
              
               
                <component :is="systemtablecomponent"></component>
          
                   
           
                </div>

            </div>
          
            
                
                
        
           
           
        </div>

       

    </MasterLayout>
</template>


<script>


export default {
   
    data(){
        return{
            currentSidebar: [],
            selectedTab: [],
            tabs: [],
            tabClicked: [],
            componentname: 'SystemTable',
            
            
           
          
    
        }
    },

    methods: {
        getNavSidebar(){
            axios.get('/getCurrentNavSidebar').then(response => {
              
               this.tabs = response.data[0]
               console.log(response.data)
             
            })
        },
    

        TabClicked(tabitem){
           // console.log(tabid)
            this.componentname = tabitem.component_name
            axios.patch(route('updateCurrentNavTab'), {
                id: tabitem.id
            }).then(response => {   
                
               
                

            })
        },

    
      

     
    },

    created(){
        this.getNavSidebar();
     
    
    },

    computed: {
        systemtablecomponent() {
        if (this.componentname == 'SystemTable') return SystemTable;
        else if (this.componentname == 'SystemTableMigrated')  return SystemTableMigrated;
       
        else return SystemTable;
      
        }
    }

  




}
</script>