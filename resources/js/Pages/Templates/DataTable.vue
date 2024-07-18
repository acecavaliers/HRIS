<template>
  <!--  <div class="px-4 sm:px-6 lg:px-8"> -->
       <div class="px-4 sm:px-6 lg:px-8">

     <div class="sm:flex sm:items-center">
       <div class="sm:flex-auto">
         <h1 class="text-base font-semibold leading-6 text-gray-900">{{ tabletitle }}</h1>
         <p class="mt-2 text-sm text-gray-700">{{ tabledescription }}</p>

         <!-- CUSTOM FORM / FILTER -->
         <slot name="customfilterform"/>

       </div>
       <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
         <button v-if="loaded == true" @click="openSearch()" ref="searchbtn" type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
           <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="-ml-0.5 h-5 w-5"/>&nbsp;Search
         </button>
         &nbsp;
         <button @click="openColumns()" type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
           <font-awesome-icon icon="fa-solid fa-table-columns" class="-ml-0.5 h-5 w-5"/>
           Columns
         </button>
          &nbsp;
          <span v-if="customaddbtn==false">
            <button @click="addnew()" type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
             <font-awesome-icon icon="fa-solid fa-plus" class="-ml-0.5 h-5 w-5"/> Add
          </button>
          </span>
          <span v-else>
            <!-- custom add -->

            <slot name="customAddBtn"></slot>
          </span>

        <!--  <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Export</button> -->
       </div>
     </div>
     <div class="mt-8 flow-root">
       <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
         <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

        <ShowRecords></ShowRecords>


        <PulseLoader :loading="loadingcolumns"></PulseLoader>
           <table class="min-w-full divide-y divide-gray-300" v-if="loadingcolumns == false">
             <thead>
               <tr><!--whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900 bg-emerald-200  -->
                <!-- py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0 -->
                 <th v-for="column in filteredcolumns" :key="column[columnkey]" scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-bold uppercase tracking-wide text-gray-500 sm:pl-0">
                   <span v-if="column.enable_sort == 1">
                     <button @click="sortList(column.column_name)" class="group inline-flex">
                     {{ column.column_label}}
                     <span class="ml-2 flex-none rounded bg-gray-100 text-gray-900 group-hover:bg-gray-200" v-if="column.enable_sort == 1">
                       <!-- <ChevronDownIcon class="h-5 w-5" aria-hidden="true" /> -->
                       <span v-if="firstload == true">
                         <font-awesome-icon icon="fa-solid fa-sort" class="h-5 w-5"  size="2xs"/>
                       </span>
                       <span v-else>
                         <font-awesome-icon v-if="sortedbyASC == true" icon="fa-solid fa-sort-up" class="h-5 w-5"  size="2xs"/>
                         <font-awesome-icon v-else-if="sortedbyASC == false" icon="fa-solid fa-sort-down" class="h-5 w-5"  size="2xs"/>
                       </span>



                     </span>
                   </button>
                   </span>
                   <span v-else>
                     {{ column.column_label}}
                   </span>

                 </th>

                 <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-0">
                   <span class="sr-only">Edit</span>
                 </th>
               </tr>
             </thead>
             <tbody class="divide-y divide-gray-200 bg-white">


               <tr v-if="datarowcount==0">
                 <td :colspan="filteredcolumns.length" class="text-sm text-center">No Data</td>
               </tr>

                <tr v-else>
                 <td colspan="6">

                  <PulseLoader :loading="loading"></PulseLoader>
                </td>
                </tr>



               <tr v-for="(tbldata, index) in mutableData.data" :key="tbldata[tablekeyname]">

                   <!-- <td v-if="!mutableData.data.length" :colspan="filteredcolumns.length">No Data</td> -->

                   <td v-for="column in filteredcolumns" :key="column[columnkey]" class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">



                   <span v-if="column.column_name == 'created_at' || column.column_name == 'updated_at' || column.column_name == 'deleted_at'">

                     {{ moment(tbldata[column.column_name]).format('L LT') }}
                   </span>

                   <span v-else-if="column.column_name == 'is_active'">
                         <span v-if="tbldata[column.column_name] == 1" class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
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

                     <span v-else-if="column.column_type == 'boolean' || column.column_type == 'smallint'">
                       <span v-if="tbldata[column.column_name] == 1" class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                             <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">
                             <circle cx="3" cy="3" r="3" />
                             </svg>
                             Yes
                         </span>
                         <span v-else class="inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                             <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                             <circle cx="3" cy="3" r="3" />
                             </svg>
                             No
                         </span>
                     </span>

                     <span v-else-if="column.column_name == 'flag'">
                       <div class="h-8 w-8" v-html="tbldata[column.column_name]"></div>
                     </span>

                     <span v-else-if="column.formtypes.slug== 'color-picker'">
                      <div :class="column.column_name" class="w-full h-7 border txt-xs text-center uppercase">{{ tbldata[column.column_name] }}</div>
                     </span>

                     <span v-else-if="column.formtypes.slug == 'file-photo'">
                        <span v-if="tbldata[column.column_name]">
                          <span v-if="column.is_avatar_photo == 1">]
                            <span class="inline-block h-14 w-14 overflow-hidden rounded-full bg-gray-100">
                              <img :src="tbldata[column.column_name]">
                            </span>
                          </span>
                          <span v-else>
                            <img :src="tbldata[column.column_name]" width="80" height="80">
                          </span>
                        </span>
                        <span v-else>
                          NO IMAGE

                        </span>
                     </span>

                     <span v-else-if="column.formtypes.slug == 'signature'">
                      <img :src="tbldata[column.column_name]"  class="inline-block h-14 w-14 rounded-md">

                     </span>

                     <span v-else-if="column.formtypes.slug == 'price'">
                      <span>{{ priceFormat(tbldata[column.column_name])}}</span>

                     </span>

                     <span v-else-if="column.formtypes.slug == 'textarea'">
                      <div v-html="tbldata[column.column_name].substring(0,50)+'...'"></div>
                     </span>

                     <span v-else-if="column.reference_table_column">

                          <span v-if="tbldata[Pluralize(column.reference_table.toLowerCase())]">
                            <span v-if="column.reference_table_column.split('.').length > 1">

                              {{ tbldata[Pluralize(column.reference_table.toLowerCase())][column.reference_table_column.split('.')[0]][column.reference_table_column.split('.')[1]]}}

                            </span>
                            <span v-else>

                              <span v-html="tbldata[Pluralize(column.reference_table.toLowerCase())][column.reference_table_column]"></span>


                            </span>

                           <!--    {{ tbldata[Pluralize(column.reference_table.toLowerCase())][column.reference_table_column]}} -->
                          <!--  {{ tbldata[Pluralize(column.reference_table.toLowerCase())][column.reference_table_column.split(".")[0]][column.reference_table_column.split(".")[1]] }} -->
                          </span>

                          <span v-else>

                            {{ tbldata[column.column_name]}}
                          </span>
                     </span>


                     <span v-else>
                       {{ tbldata[column.column_name]}}
                     </span>


                 </td>

                 <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">

                   <span class="isolate inline-flex rounded-md shadow-sm">
                    <button v-if="currentmodule.enable_view_button == 1" @click="viewdata(tbldata)" type="button" class="relative inline-flex items-center rounded-l-md bg-yellow-200 px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"><font-awesome-icon icon="fa-solid fa-eye" class="-ml-0.5 h-5 w-5"/></button>

                    <span v-if="customaddbtn==false">
                      <button v-if="currentmodule.enable_edit_button == 1" @click="editdata(tbldata)" type="button" class="relative inline-flex items-center rounded-l-md bg-yellow-200 px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"><font-awesome-icon icon="fa-solid fa-pen-to-square" class="-ml-0.5 h-5 w-5"/></button>
                    </span>
                    <span v-else>
                      <slot name="customEditBtn" :currentmodule="currentmodule" :tbldata="tbldata"></slot>
                    </span>


                     <button v-if="currentmodule.enable_delete_button == 1" @click="deletedata(tbldata)" type="button" class="relative -ml-px inline-flex items-center bg-red-200 px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"><font-awesome-icon icon="fa-solid fa-trash" class="-ml-0.5 h-5 w-5"/></button>
                   </span>

               <!-- <button v-if="currentmodule.enable_edit_button == 1" @click="editdata(tbldata)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                   <button v-if="currentmodule.enable_delete_button == 1" @click="deletedata(tbldata)" class="text-indigo-600 hover:text-indigo-900">Delete</button> -->
                 </td>



                  <slot name="action_column" :tabledata="tbldata" :tabledataindex="index"/>
               </tr>
             </tbody>
           </table>



           </div>



       </div>

     </div>
      <!-- PAGINATION -->
     <Pagination :from="mutableData.from" :to="mutableData.to" :total="mutableData.total" :links="mutableData.links"></Pagination>
   </div>
 <!--   <Forms :routename="routename" :title="formtitle">
        <template #additionalforms>
                <slot name="additionalformcontent"></slot>
        </template>
    </Forms> -->

 <FormModal :routename="routename" :title="formtitle" :modelname="modelname" :ismainsidebar="ismainsidebar" :datavalues="data" :editmode="editmode" :pageurl="$page.url" :datavaluesreferencedother="datavaluesreferencedother"></FormModal>
   <DisplayColumns :columns="columns" :filteredcolumns="filteredcolumns"></DisplayColumns>
   <SearchForm :routename="searchroutename" :searchformtitle="tabletitle"></SearchForm>
   <ViewFormModal :routename="routename" :title="formtitle">

   </ViewFormModal>
   <CustomModal modalTitle="Warning" modalDescription="There is no forms has been setup. Please go to forms settings." buttonText="Go To Form Settings">
       <template #icon>
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                 <ExclamationTriangleIcon class="h-6 w-6 text-yellow-600" aria-hidden="true" />
            </div>
       </template>
   </CustomModal>
   <DeleteConfirmationModal :routename="routename" :ismainsidebar="ismainsidebar" :modelname="modelname" ></DeleteConfirmationModal>
</template>

<script setup>

 import moment from 'moment';
 import Pagination from '@/Pages/Templates/Pagination.vue';
 import PulseLoader from '@/Pages/Templates/PulseLoader.vue';
  import Loader from '@/Pages/Templates/Loader.vue'
 import DisplayColumns from '@/Pages/Templates/DisplayColumns.vue';
 import SearchForm from '@/Pages/Templates/SearchForm.vue';
 import DeleteConfirmationModal from '@/Pages/Templates/DeleteConfirmation.vue';
 import CustomModal from '@/Pages/Templates/CustomModal.vue';
 import Forms from '@/Pages/Templates/Forms.vue';
 import SlideOver from '@/Pages/Templates/SlideOver.vue';
 import { ExclamationTriangleIcon,CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
 import Pluralize from 'pluralize';
 import ShowRecords from '@/Pages/Templates/ShowRecords.vue';
 import ViewFormModal from '@/Pages/Templates/ViewFormModal.vue';
 import FormModal from '@/Pages/Templates/FormModal.vue';

/*   const pluralize = (val, word, plural = word + 's') => {
 const _pluralize = (num, word, plural = word + 's') =>
   [1, -1].includes(Number(num)) ? word : plural;
 if (typeof val === 'object') return (num, word) => _pluralize(num, word, val[word]);
 return _pluralize(val, word, plural);
}; */


</script>

<script>
export default {
   props: ['columns', 'columnkey', 'tabledata', 'tablekeyname', 'tabletitle', 'tabledescription', 'searchroutename', 'routename', 'formtitle', 'customaddbtn', 'ismainsidebar', 'modelname', 'datavaluesreferencedother'],

   data(){
     return {
       loading: true,
       filteredcolumns: [],
       sortedbyASC: true,
       firstload: true,
       loaded: false,
       datarowcount: 0,
       currentmodule: [],
       mutableData: this.tabledata,
       customaddopen: false,

      model_name: '',
      data: [],
      editmode: false,
      loadingcolumns: true,



     }
   },




   methods: {



   addnew(){
     this.editmode = false

     this.emitter.emit('openFormModal', true)



   },

   viewdata(data){
    var mydata = {
    /*     pageurl: this.$page.url, */
        datatoview: data,

    }

    this.emitter.emit('openviewForm', mydata);
   },

   editdata(data){
    this.editmode = true
   /*   var mydata = {
       pageurl: this.$page.url,
       model_name: this.modelname,
        ismainsidebar: this.ismainsidebar,
       datatoedit: data,
       editmode: true
     } */
/*
     var mydata = {
        editmode: true,
        data: data,
        openmodal: true
       }
     */
    this.data = data;
    this.emitter.emit('openFormModal', true)
    //console.log(this.data)
    // this.emitter.emit('getdataforedit', data);

   },

 /*   updatedata(data){
     axios.patch(route(this.editroutename),{
       id: data.id

     })
   },*/

   deletedata(data){
     this.emitter.emit('deleteconfirmationmodal', data)

   },


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

     openColumns(){

       this.emitter.emit('openColumns', this.filteredcolumns);

     },

     openSearch(){


      // this.$page.url
       var mydata = {
        pageurl: this.$page.url,
        model_name: this.modelname,
        ismainsidebar: this.ismainsidebar
       }


       this.emitter.emit('openSearch', mydata);


     },

     getCurrentModuleByPageUrl(){
       axios.get('/getCurrentModuleByPageUrl', {
         params: {
           pageurl: this.$page.url,
           model_name: this.modelname,
           ismainsidebar: this.ismainsidebar
         }
       }).then(response => {
         this.currentmodule = response.data;

       })
     },

     isHTML(str) {
        var a = document.createElement('div');
        a.innerHTML = str;

        for (var c = a.childNodes, i = c.length; i--; ) {
          if (c[i].nodeType == 1) return true;
        }

        return false;
      },

      priceFormat(price){
        return new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'PHP',
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
          useGrouping: true // Enable thousand separators
      }).format(price);
      }


   },

   watch:{
       tabledata: function(){
           this.mutableData = this.tabledata;
           this.datarowcount = this.tabledata.data.length;

       }
   },

   mounted(){
      this.loaded = true
      console.log('mounted:'+this.modelname )

   },


   unmounted(){
    console.log('unmounted:'+this.modelname )
   },

   activated(){
    console.log('activated: ' + this.modelname)
   },

   deactivated(){
    console.log('deactivated: ' + this.modelname)
   },

   created(){

     this.getCurrentModuleByPageUrl();
      this.emitter.on('searchDataFilter', (evt) => {
           this.mutableData = evt;

       })

       this.emitter.on('loadingdata', (evt) => {
           this.loading = evt
       })

       this.emitter.on('loadingcolumns', (evt) => {
           this.loadingcolumns = evt
       })

       this.emitter.on('filtercolumn', (evt) => {
           this.filteredcolumns = evt;
           this.filteredcolumns.sort((a, b) => {
               return a.column_order - b.column_order;
           });
       })

       this.emitter.on('showrecords', (evt) => {

         this.emitter.emit('refreshData-'+this.$page.url.replace('/',''), evt)

        })

        this.emitter.on('ismainsidebar', (evt) => {
          this.ismainsidebar = evt
        })

        this.emitter.on('pageurlnotmainsidebar', (evt) => {
          console.log(evt.model_name)
          this.$page.url = evt.href;
          this.model_name = evt.model_name

        })







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

