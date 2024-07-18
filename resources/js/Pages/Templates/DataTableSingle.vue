<template>
    <!--  <div class="px-4 sm:px-6 lg:px-8"> -->
         <div class="max-w-full">

       <div class="sm:flex sm:items-center">
         <div class="sm:flex-auto">
           <h1 class="text-base font-semibold leading-6 text-gray-900">{{ tabletitle }}</h1>
           <p class="mt-2 text-sm text-gray-700">{{ tabledescription }}</p>
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
                 <tr v-if="!tabledata.length">
                    <td :colspan="columns.length" class="text-sm text-center">No Data Yet</td>
                 </tr>
                 <tr v-for="(tbldata, index) in tabledata" :key="tbldata">
                     <td v-for="column in columns" :key="column" class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ tbldata }}</td>

                  <!--  <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                     <a href="#" class="text-indigo-600 hover:text-indigo-900"
                       >Edit<span class="sr-only">, {{ transaction.id }}</span></a
                     >
                   </td> -->

                    <slot name="action_column" :tabledata="tbldata" :tabledataindex="index"/>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
</template>

<script setup>


</script>

 <script>
 export default {
     props: ['columns', 'tabledata', 'tabletitle', 'tabledescription'],

 }

 </script>
