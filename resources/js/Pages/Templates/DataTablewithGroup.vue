<template>
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">

        
          <h1 class="text-base font-semibold leading-6 text-gray-900">{{ tabletitle }}</h1>
          <p class="mt-2 text-sm text-gray-700">{{ tabledescription }}</p>

          <slot name="customfilterform"/>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
         <!--  <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button> -->
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full">
              <thead class="bg-white">
                <tr>
                  <th v-for="column in columns" :key="column" scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">{{ column}}</th>
                
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                <template v-for="tbldata in mutableData" :key="tbldata.groupname">
                  <tr class="border-t border-gray-200">
                    <th :colspan="columns.length" scope="colgroup" class="bg-gray-50 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">{{ tbldata.groupname }}</th>
                  </tr>
                  <tr v-for="(childdata, index) in tbldata.children.data" :key="childdata[tablekeyname]" :class="[index === 0 ? 'border-gray-300' : 'border-gray-200', 'border-t']">
                    
                    
                    <td v-for="column in columns" :key="column" class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">

                        <span v-if="column == 'created_at' || column == 'CHECKTIME'">
                        <span v-if="column == 'CHECKTIME'">
                            {{ moment(childdata[column]).format('LT') }}
                        </span>
                        <span v-else>
                            {{ moment(childdata[column]).format('L LT') }}
                        </span>
                        

                        </span>
                        <span v-else-if="column == 'is_active'">
                            <span v-if="childdata[column] == 1" class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
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
                        <slot name="migrated" :tabledata="childdata" :tabledataindex="index" :tabledatacount="mutableData.data.length"/>

                        </span>

                        <span v-else-if="hasCustomColumn==true">

                        <slot name="customcolumn" :column="column" :tabledata="childdata"></slot>

                        </span>



                        <span v-else-if="column == 'CHECKTYPE'">



                        </span>


                        <span v-else>
                        {{ childdata[column] }}

                        </span>


                        </td>

                         <slot name="action_column" :tabledata="childdata" :tabledataindex="index"/>
                    
                  
                  </tr>

                 

                </template>
              </tbody>
            </table>

            
           <!--  <Pagination :from="tbldata.children.from" :to="tbldata.children.to" :total="tbldata.children.total" :links="tbldata.children.links"></Pagination> -->

              
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
   import moment from 'moment';
   import Pagination from '@/Pages/Templates/Pagination.vue';

  </script>


<script>
export default {
     props: ['columns', 'tabledata', 'tablekeyname', 'tabletitle', 'tabledescription', 'hasCustomColumn'],

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
        /*  this.firstload =false;
         if (this.sortedbyASC) {
             this.mutableData.data.sort((x, y) => (x[sortBy] > y[sortBy] ? -1 : 1));
             this.sortedbyASC = false;
         } else {
             this.mutableData.data.sort((x, y) => (x[sortBy] < y[sortBy] ? -1 : 1));
             this.sortedbyASC = true;
         } */
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
        console.log(this.mutableData)
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
            this.datarowcount = this.tabledata.length;
          
        
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
