<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
      <div class="flex flex-1 justify-between sm:hidden">
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing
            {{ ' ' }}
            <span class="font-medium">{{from}}</span>
            {{ ' ' }}
            to
            {{ ' ' }}
            <span class="font-medium">{{to}}</span>
            {{ ' ' }}
            of
            {{ ' ' }}
            <span class="font-medium">{{total}}</span>
            {{ ' ' }}
            results
          </p>
        </div>
        <div>

          <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
              <span v-for="(link,index) in links" :key="link.label">
            <button v-if="link.label.includes('Previous')" @click="getpagedata(link.url)" :class="[!link.url ? 'disabled-link':'', 'relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20']">
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </button>


            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
            <span v-if="index != 0 && index != links.length - 1">
            <button v-if="link.active" @click="getpagedata(link.url)" aria-current="page" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">{{ link.label }}</button>
            <button v-else @click="getpagedata(link.url)" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{link.label}}</button>
            </span>

           <!--  <a href="#" class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">3</a>
            <span class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
            <a href="#" class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">8</a>
            <a href="#" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">9</a>
            <a href="#" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">10</a> -->
            <button v-if="link.label.includes('Next')" @click="getpagedata(link.url)" :class="[!link.url ? 'disabled-link' : '' , 'relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20']">
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </button>
      </span>
          </nav>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'
import { Head, Link, useForm } from '@inertiajs/vue3';
import getDatawithShowRecords from '@/Hooks/getDatawithShowRecords.js';
</script>

<script>
export default {

props: ['from', 'to', 'total', 'links'],

data(){
    return{
    paramValue: [],
    showrecordsvalue: 10,
    data: [],
    }
},
methods:{
    async getpagedata(url){
     
        if(this.paramValue.length > 0){
        axios.get(url, {
            params: {
            paramVal: this.paramValue,
            showrecords: this.showrecordsvalue
            }
        }).then(response => {
          console.log(this.showrecordsvalue)
            this.emitter.emit('refreshDatawithPagination-'+this.$page.url.replace('/',''), response.data)
        })
        }else{
    
            this.emitter.emit('refreshDatawithPagination-'+this.$page.url.replace('/',''), (await getDatawithShowRecords(url, this.showrecordsvalue)).responseData) 
          
        }

    }
},

created(){
this.emitter.on('getParamValues', (evt) =>{
    this.paramValue = evt
})

this.emitter.on('getSelectedShowRecordsVal', (evt) => {
   this.showrecordsvalue = evt
})
}


}

</script>

  <style>
  .disabled-link {
    pointer-events: none;
  }
  </style>
