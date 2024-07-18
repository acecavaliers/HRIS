<template>
    <!--  <div class="px-4 sm:px-6 lg:px-8"> -->
         <div class="max-w-full">

       <div class="sm:flex sm:items-center">
         <div class="sm:flex-auto">
           <h1 class="text-base font-semibold leading-6 text-gray-900">{{ tabletitle }}</h1>
           <p class="mt-2 text-sm text-gray-700">{{ tabledescription }}</p>

           <slot name="customfilterform"/>
         </div>
         <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
           <!-- <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Export</button> -->
         </div>
       </div>
       <div class="mt-8 flow-root">
         <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
           <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      
             <table class="min-w-full divide-y divide-gray-300">
               <thead>
                 <tr>
                    <th v-for="column in columns" :key="column" scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ column}}</th>

                   <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-0">
                     <span class="sr-only">Edit</span>
                   </th>
                 </tr>
               </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
            <!--     <Loader :active="loaderActive" message="Please wait 5 seconds" /> -->
            
               <tr v-if="datarowcount==0">
                 <td class="text-sm text-center">No Data</td>
               </tr>
             
                <tr v-for="(tbldata, index) in mutableData.data" :key="tbldata[tablekeyname]">

                  <td v-for="column in columns" :key="column" class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">

                      <span v-if="column == 'created_at'">
                    
                          {{ moment(tbldata[column]).format('L LT') }}

                      </span>
                      <span v-else-if="column == 'is_active'">
                          <span v-if="tbldata[column] == 1" class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                              <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">
                              <circle cx="3" cy="3" r="3" />
                              </svg>
                              Active
                          </span>
                          <span v-else class="inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                              <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                              <circle cx="3" cy="3" r="3" />
                              </svg>
                              Inactive
                          </span>
                      </span>
                      <span v-else-if="column == 'is_columns_migrated'">
                        <slot name="migrated" :tabledata="tbldata" :tabledataindex="index" :tabledatacount="mutableData.data.length"/>

                      </span>

                      <span v-else-if="hasCustomColumn==true">
                        <slot name="customcolumn" :column="column" :tabledata="tbldata"></slot>

                      </span>

                      <span v-else>
                        {{ tbldata[column] }}
                      </span>


                  </td>

                    <!--  <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                      >Edit<span class="sr-only">, {{ transaction.id }}</span></a
                    >
                    </td> -->

                    <slot name="action_column" :tabledata="tbldata" :tabledataindex="index"/>

                </tr>


    
               </tbody>

             </table>

             <!-- PAGINATION -->


             <Pagination :from="mutableData.from" :to="mutableData.to" :total="mutableData.total" :links="mutableData.links"></Pagination>

           </div>
         </div>
       </div>
     </div>
</template>





<script setup>
 import moment from 'moment';
 import Pagination from '@/Pages/Templates/Pagination.vue';
 import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
 import Loader from '@/Pages/Templates/Loader.vue'

</script>
<script>

 export default {
     props: ['columns', 'tabledata', 'tablekeyname', 'tabletitle', 'tabledescription', 'hasCustomColumn', 'hasGroups'],

     data(){
      return {
        loading: true,
        color: '#5dc596',
        size: '15px',
        mutableData: this.tabledata,
        currentmodule: [],
        datarowcount: 0,
 
      }
     },

     methods: {
      sortList(sortBy) {
         this.firstload =false;
         if (this.sortedbyASC) {
             this.mutableData.data.sort((x, y) => (x[sortBy] > y[sortBy] ? -1 : 1));
             this.sortedbyASC = false;
         } else {
             this.mutableData.data.sort((x, y) => (x[sortBy] < y[sortBy] ? -1 : 1));
             this.sortedbyASC = true;
         }
     },

      getCurrentModuleByPageUrl(){
       axios.get('/getCurrentModuleByPageUrl', {
         params: {
           pageurl: this.$page.url
         }
       }).then(response => {
         this.currentmodule = response.data;
         console.log(response.data);
       })
     }
     },

 
     created(){
       this.emitter.on('loadingdata', (evt) => {
           this.loading = evt;
       })

       this.emitter.on('showrecords', (evt) => {
         
         this.emitter.emit('refreshData-'+this.$page.url.replace('/',''), evt)
    
        }) 
     },

     watch:{
        tabledata: function(){
            this.mutableData = this.tabledata;

            if(this.hasGroups == true){
              this.datarowcount = this.tabledata.length;
              
            }else{
              this.datarowcount = this.tabledata.data.length;
              
            }
            

        }
    },

 }

</script>

 <style>
.v-spinner
{
margin-right: auto;
margin-left: auto;
text-align: center;
}

</style>
