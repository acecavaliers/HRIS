<template>


   <AlertNotification></AlertNotification>
   <br>

   <DataTableWithCustomColumn tabletitle="System Tables Migrated" tabledescription="" :tabledata="data" :columns="columns" tablekeyname="id">
   
      <template #migrated="slotprops">
        
         <span v-if="slotprops.tabledata['is_columns_migrated'] == 1">
   
               <span v-if="columncount[slotprops.tabledataindex] == systemtabledetailscount[slotprops.tabledataindex]" class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                  <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">
                  <circle cx="3" cy="3" r="3" />
                  </svg>
                  Migrated
               </span>
   
               <span v-else class="inline-flex items-center gap-x-1.5 rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700">
                  <svg class="h-1.5 w-1.5 fill-yellow-500" viewBox="0 0 6 6" aria-hidden="true">
                  <circle cx="3" cy="3" r="3" />
                  </svg>
                  Partially Migrated
               </span>
         </span>
   
         <span v-else>
            <span class="inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
               <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
               <circle cx="3" cy="3" r="3" />
               </svg>
               Not Yet Migrated
            </span>
         </span>
   
      </template>
   
      <template #action_column="slotprops">
           <td  class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
               <button  v-if="slotprops.tabledata['is_columns_migrated'] == 0 || columncount[slotprops.tabledataindex] != systemtabledetailscount[slotprops.tabledataindex]" @click="migrateColumns(slotprops.tabledata)" class="text-indigo-600 hover:text-indigo-900"
               >Migrate Columns</button>
           </td>
      </template>
   
   </DataTableWithCustomColumn>
   
   <ModalConfirmation dialog-title="Migrate Table Columns" dialog-confirmation-message="Are you sure you want to migrate this table columns?" confirmation-btn-text="Migrate Table Columns">
      <template #default>
            <ul>
               <li class="font-bold">{{migratetablename}}</li>
            </ul>
   
      </template>
   </ModalConfirmation>
   
   <CustomModalwithBody modalTitle="Update Columns" modelDescription="">
      <template #default>
   
            <div class="px-4 sm:px-6 lg:px-8">
       <div class="sm:flex sm:items-center">
         <div class="sm:flex-auto">
           <h1 class="text-base font-semibold leading-6 text-gray-900">Update Columns</h1>
           <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
           <AlertNotification></AlertNotification>
         </div>
   
       </div>
       <div class="mt-8 flow-root">
         <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
           <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
           
          
             <table class="min-w-full divide-y divide-gray-300">
               <thead>
                 <tr>
                  <!-- COLUMN HEADING -->
               
                  <th v-for="(editcolumn, index) in editcolumns" :key="editcolumn.name" scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">{{ editcolumn.name }}</th>
               
                  </tr>
               </thead>
               <tbody class="divide-y divide-gray-200">
                 <tr v-for="(data, index) in geteditcolumns" :key="data.id">
   
                   <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ data.column_name }}</td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="text" v-model="form[index]['column_label']"  class="block w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>

                   

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {{ data.column_type }}
                     </td>

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Switch v-model="form[index]['enable_search']" :class="[form[index]['enable_search'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                           <span class="sr-only">Use setting</span>
                           <span aria-hidden="true" :class="[form[index]['enable_search'] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </td>

                    

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                     <Switch v-model="form[index]['enable_display_column']" :class="[form[index]['enable_display_column'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['enable_display_column'] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                     </Switch>
   
                     </td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                     <Switch v-model="form[index]['default_display_column']" :class="[form[index]['default_display_column']? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['default_display_column'] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                     </Switch>
   
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                     <Switch v-model="form[index]['enable_sort']" :class="[form[index]['enable_sort'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['enable_sort'] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                     </Switch>
   
                     </td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                       <!-- check if created_by, updated_by, deleted_by field then remove switch --> 
                        <span v-if="data.column_name  == 'created_by' || data.column_name  == 'updated_by' || data.column_name  == 'deleted_by' || data.column_name  == 'created_at' || data.column_name  == 'updated_at' || data.column_name  == 'deleted_at'">
                           <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">x</span>
                        </span>
                        <span v-else>
                           <Switch v-model="form[index]['enable_addform']" :class="[form[index]['enable_addform'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                              <span class="sr-only">Use setting</span>
                              <span aria-hidden="true" :class="[form[index]['enable_addform']? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                           </Switch>
                        </span>
   
                     </td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                   

                     <span v-if="data.column_name  == 'created_by' || data.column_name  == 'updated_by' || data.column_name  == 'deleted_by' || data.column_name  == 'created_at' || data.column_name  == 'updated_at' || data.column_name  == 'deleted_at'">
                           <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">x</span>
                        </span>
                        <span v-else>
                           <Switch v-model="form[index]['enable_editform']" :class="[form[index]['enable_editform']? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['enable_editform']? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                     </Switch>

                        </span>
   
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                     <Switch v-model="form[index]['is_active']" :class="[form[index]['is_active']? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['is_active'] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                     </Switch>
   
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="number" v-model="form[index]['column_order']"  class="block w-20 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="number" v-model="form[index]['search_order']" class="block w-20 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Switch v-model="form[index]['is_required']" :class="[form[index]['is_required'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['is_required']==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </td>
   
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="text" v-model="form[index]['required_text']"  class="block w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Switch v-model="form[index]['is_unique']" :class="[form[index]['is_unique'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['is_unique']==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </td>

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Switch v-model="form[index]['is_disabled']" :class="[form[index]['is_disabled'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['is_disabled']==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </td>

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                      <span v-if="data.column_type=='string'">
                        <Switch v-model="form[index]['is_autogenerate']" :class="[form[index]['is_autogenerate']==1 ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                           <span class="sr-only">Use setting</span>
                           <span aria-hidden="true" :class="[form[index]['is_autogenerate']==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </span>
                     <span v-else>
                        
                     </span>


                      
                          <!--  <Switch as="button" :disabled="data.column_type!=='string'" v-model="form[index]['is_autogenerate']" :class="[form[index]['is_autogenerate']==0 && data.column_type!=='string'? 'bg-red-600' : form[index]['is_autogenerate']==1 && data.column_type=='string'? 'bg-indigo-600':'bg-gray-300', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                           <span class="sr-only">Use setting</span>
                       
                        <span :class="[form[index]['is_autogenerate']==1? 'translate-x-5' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']">
                           <span :class="[form[index]['is_autogenerate']==1 ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                           <svg class="h-3 w-3 text-red-400" fill="none" viewBox="0 0 12 12">
                              <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           </span>
                           <span :class="[form[index]['is_autogenerate']==1 ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
                           <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                              <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                           </svg>
                           </span>
                        </span>
                        </Switch> -->
                     </td>

                     <td v-if="form[index]['is_autogenerate'] ==true" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="text" v-model="form[index]['prefix']"  class="block w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>

                     <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                       
                     </td>
                   
                     <td v-if="form[index]['is_autogenerate'] ==true" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="number"  v-model="form[index]['no_of_digits']" :class="[errors['formdata.'+index+'.no_of_digits'] ? 'text-red-900 ring-red-300 placeholder:text-red-400' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400', 'block w-32 rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']"/>
                        <!-- <input type="number" v-model="form[index]['no_of_digits']"  class="block w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" /> -->
                        <span class="text-red-300" v-if="errors['formdata.'+index+'.no_of_digits']">{{ errors['formdata.'+index+'.no_of_digits'][0].replace('formdata.'+index+'.', '') }}</span>
                     </td>
                     <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                       
                     </td>

                     <td v-if="form[index]['is_autogenerate'] ==true" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="number" v-model="form[index]['no_start_from']"  :class="[errors['formdata.'+index+'.no_start_from'] ? 'text-red-900 ring-red-300 placeholder:text-red-400' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400', 'block w-32 rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']"/>
                        <span class="text-red-300" v-if="errors['formdata.'+index+'.no_start_from']">{{ errors['formdata.'+index+'.no_start_from'][0].replace('formdata.'+index+'.', '') }}</span>
                     </td>
                     <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                       
                     </td>
                   
                     <td v-if="form[index]['is_autogenerate'] ==true" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <input type="number" v-model="form[index]['no_end_from']"  class="block w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                     </td>
                     <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                       
                     </td>

                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Switch v-model="form[index]['use_texteditor']" :class="[form[index]['use_texteditor'] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                        <span class="sr-only">Use setting</span>
                        <span aria-hidden="true" :class="[form[index]['use_texteditor']==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                        </Switch>
                     </td>
                    
                     <td v-if="form[index]['formtype'].slug=='dropdown' && data.is_foreignkey==0" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                     <!-- Combobox for When choosing DROPDOWN as formtype (Get all models) -->
                     <Combobox as="div" name="referencetable" :nullable="true" v-model="form[index]['reference_table']" >
   
                        <div class="relative">
                           <ComboboxInput :class="errors['reference_table'] ? 'ring-red-300 focus:ring-red-600': 'ring-gray-300 focus:ring-indigo-600'" class="w-32 rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" @change="onChangeQuery($event.target.value, 'referencetable')" :display-value="(referencetable) => referencetable" />
                           <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                           <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                           </ComboboxButton>

                           <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                           <ComboboxOption v-for="modelname in modelnames" :key="modelname" :value="modelname" as="template" v-slot="{ active, selected }">
                              <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                 <span :class="['block', selected && 'font-semibold']">
                                 {{ modelname }}
                                 </span>

                                 <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                 <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                 </span>
                              </li>
                           </ComboboxOption>
                           </ComboboxOptions>
                        </div>
                     </Combobox>
                     <!-- END combobox -->
                  
                     </td>
                     <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                     
                       {{ data.reference_table }}
                     </td>
                     
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
   
                        <Combobox v-if="data.is_foreignkey==1" as="div" name="referencetable" :nullable="true" v-model="form[index]['reference_table_column']" >
   
                              <div class="relative">
                                 <ComboboxInput @focus="onFocuschange('referencetablecolumn')" :class="errors['reference_table_column'] ? 'ring-red-300 focus:ring-red-600': 'ring-gray-300 focus:ring-indigo-600'" class="w-32 rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" @change="onChangeQuery($event.target.value, 'referencetablecolumn')" :display-value="(referencetablecolumn) => referencetablecolumn" />
                                 <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                 <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                 </ComboboxButton>
   
                                 <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                 <ComboboxOption v-for="referencetablecolumn in filteredreferencetablecolumns[data.reference_table]" :key="referencetablecolumn" :value="referencetablecolumn" as="template" v-slot="{ active, selected }">
                                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                       <span :class="['block', selected && 'font-semibold']">
                                       {{ referencetablecolumn }}
                                       </span>
   
                                       <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                       <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                       </span>
                                    </li>
                                 </ComboboxOption>
                                 </ComboboxOptions>
                              </div>
                        </Combobox>
                     </td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Combobox v-if="data.is_foreignkey==1" as="div" name="wherecolumn" :nullable="true" v-model="form[index]['where_column']" ><!-- selectedWhereColumn[data.reference_table] -->
   
                      <div class="relative">
                         <ComboboxInput @focus="onFocuschange('wherecolumn')" class="w-32 rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="onChangeQuery($event.target.value, 'wherecolumn')" :display-value="(wherecolumn) => wherecolumn" />
                         <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                         <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                         </ComboboxButton>
   
                         <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                         <ComboboxOption v-for="wherecolumn in filteredwherecolumn[data.reference_table]" :key="wherecolumn" :value="wherecolumn" as="template" v-slot="{ active, selected }">
                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                               <span :class="['block', selected && 'font-semibold']">
                               {{ wherecolumn }}
                               </span>
   
                               <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                               <CheckIcon class="h-5 w-5" aria-hidden="true" />
                               </span>
                            </li>
                         </ComboboxOption>
                         </ComboboxOptions>
                      </div>
                </Combobox>
                     </td>
                     <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <Combobox as="div" :nullable="true" v-model="form[index]['formtype']" ><!-- selectedWhereColumn[data.reference_table] -->
   
                      <div class="relative">
                         <ComboboxInput @focus="onFocuschange('formtype')" class="w-32 rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" @change="onChangeQuery($event.target.value, 'formtype')" :display-value="(formtype) => formtype?.form_type_name" />
                         <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                         <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                         </ComboboxButton>
   
                         <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                         <ComboboxOption v-for="formtype in filteredFormTypes[data.column_type]" :key="formtype" :value="formtype" as="template" v-slot="{ active, selected }">
                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                               <span :class="['block', selected && 'font-semibold']">
                               {{ formtype.form_type_name }}
                               </span>
   
                               <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                               <CheckIcon class="h-5 w-5" aria-hidden="true" />
                               </span>
                            </li>
                         </ComboboxOption>
                         </ComboboxOptions>
                      </div>
                </Combobox>
   
                     </td>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
      </template>
   
      <template #submitbutton>
         <button @click="updateSystemTableDetails() " type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Save</button>
   
      </template>
   
   </CustomModalwithBody>


   </template>
   
   
   
   <script setup>
   
   import DataTableWithCustomColumn from '@/Pages/Templates/DataTableWithCustomColumn.vue';
   import ModalConfirmation from '@/Pages/Templates/ModalConfirmation.vue';
   import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
   import CustomModalwithBody from '@/Pages/Templates/CustomModalwithBody.vue';
   import Forms from '@/Pages/Templates/Forms.vue';
   import { computed, ref } from 'vue'
   import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
   import {
     Combobox,
     ComboboxButton,
     ComboboxInput,
     ComboboxLabel,
     ComboboxOption,
     ComboboxOptions,
   } from '@headlessui/vue'
   
   import { Switch } from '@headlessui/vue'
   </script>
   
   
   
   <script>
   
   export default {
   
      name: 'SystemTableMigrated',
   
      data(){
         return {
            columns: ['table_name', 'model_name', 'is_active', 'is_columns_migrated', 'created_at'],
            editcolumns: [{name: 'Column Name', display: true},
               {name: 'Column Label', display: true},
               {name: 'Column Type', display: true},
               {name: 'Enable Search', display: true},
               {name: 'Enable Display Column', display: true},
               {name: 'Default Display Column', display: true},
               {name: 'Enable Sort', display: true},
               {name: 'Enable Add Form', display: true},
               {name: 'Enable Edit Form', display: true},
               {name: 'Is Active', display: true},
               {name: 'Column Order', display: true},
               {name: 'Search Order', display: true},
               {name: 'Is Required', display: true},
               {name: 'Required Text', display: true},
               {name: 'Is Unique', display: true},
               {name: 'Is Disabled', display: true},
               {name: 'Is Autogenerate', display: true},
               {name: 'Prefix', display: false},
               {name: 'No of Digits', display: false},
               {name: 'Start Digit', display: false},
               {name: 'End Digit', display: false},
               {name: 'Use TextEditor', display: true},
               {name: 'Reference Table', display: true},
               {name: 'Reference Table Column', display: true},
               {name: 'Where Column', display: true},
               {name: 'Form Type', display: true},
               {name: 'Is Required If', display: true},
               {name: 'required_if_field', display: true},
               {name: 'required_if_another_field', display: true},
               {name: 'required_if_value', display: true},
               {name: 'is_form_hidden', display: true},
               {name: 'is_fk_getreferenced', display: true},
               {name: 'hide_column', display: true},
               {name: 'is_avatar_photo', display: true},
               {name: 'is_nullable_combobox', display: true},
               {name: 'text_editor_id', display: true},
            ],
               
         
            data: [],
            migratetablename: '',
            datatomigrate: [],
            migratedtext:[],
            isloaded:false,
            columncount: [],
            systemtabledetailscount: [],
   
            geteditcolumns: [],
   
            referencetablecolumns: [],
            selectedReferenceTableColumn: [],
            form: [],
            errors: [],
            selectedWhereColumn: [],
            queryreferencecolumntable: '',
            querywherecolumn: '',
            migratemodelname: '',
            queryformtype: '',
            formtypes: {},
            isautogenerate: 0,
            modelnames: [],
   
   
   
         }
      },
   
      methods:{

   
         updateenabledisplaycolumn(evt){
           console.log(evt)
         },
   
   
         onFocuschange(category){
            if(category == 'referencetablecolumn'){
               this.queryreferencecolumntable = '';
            }else if(category == 'wherecolumn'){
               this.querywherecolumn = '';
            }else{
               this.queryformtype = '';
            }
   
   
         },
   
         onChangeQuery(val, category){
            if(category == 'referencetablecolumn'){
               this.queryreferencecolumntable = val;
            }else if(category == 'wherecolumn'){
               this.querywherecolumn = val
            }else{
               this.queryformtype = val
            }
   
         },
   
         getreferencetablecolumns(referenceTable){
            axios.get(route('getTableColumnsFinal'), {
               params: {
                  modelname: referenceTable
               }
            }).then(response => {
               this.referencetablecolumns[referenceTable] = response.data
   
            })
         },
   
          getlist(){
            this.emitter.emit('showloader')
            axios.get(route('systemtablesmigrated.getlist')).then(response => {
   
              /*  console.log(response.data); */
               response.data.data.forEach((val) => {
   
                  this.getnotyetmigratedcolumns(val)
   
               })
               this.data = response.data
               this.emitter.emit('hideloader')
   
          
   
            })
         },
   
         geteditcolumnsfunc(model_name){
            axios.get(route('systemtablesdetails.getcolumns'), {
               params:{
                  modelName: model_name
               }
            }).then(response => {
               this.geteditcolumns = response.data;
               console.log(this.geteditcolumns)
               this.geteditcolumns.forEach((val, index)=>{

                console.log(val.reference_table)
   
                  if(val.is_foreignkey == 1){
                     this.getreferencetablecolumns(val.reference_table)
   
   
                  }
   
                  this.getformtypebydatatypesByID(val.form_type_id)
                  
   
                  this.form.push({
                     id: val.id,
                     column_label : val.column_label,
                     enable_search: val.enable_search == 1 ? true : false,
                     enable_display_column: val.enable_display_column == 1 ? true : false,
                     default_display_column: val.default_display_column == 1 ? true : false,
                     enable_sort: val.enable_sort == 1 ? true : false,
                     enable_addform: val.enable_addform == 1 ? true : false,
                     enable_editform: val.enable_editform == 1 ? true : false,
                     is_active: val.is_active == 1 ? true : false,
                     column_order: val.column_order,
                     search_order: val.search_order,
                     is_required: val.is_required == 1 ? true : false,
                     is_foreignkey: val.is_foreignkey,
                     is_unique: val.is_unique == 1 ? true : false,
                     is_disabled: val.is_disabled == 1 ? true : false,
                     is_autogenerate: val.is_autogenerate == 1 ? true : false,
                     prefix: val.autogeneratecodes.length>0?val.autogeneratecodes[0]['prefix']:'',
                     no_of_digits: val.autogeneratecodes.length>0?val.autogeneratecodes[0]['no_of_digits']:'',
                     no_start_from: val.autogeneratecodes.length>0?val.autogeneratecodes[0]['no_start_from']:'',
                     no_end_from: val.autogeneratecodes.length>0?val.autogeneratecodes[0]['no_end_from']:'',
                     use_texteditor: val.use_texteditor == 1 ? true : false,
                     required_text: val.required_text,
                     reference_table: val.reference_table==''||val.reference_table==null?'':val.reference_table,
                     reference_table_column: val.reference_table_column,
                     where_column: val.where_column,
                     formtype: val.is_foreignkey==1? this.formtypes['bigint-fk'][0] : this.formtypes[val.column_type][0]
   
   
                  });

                
   
   
   
               })
   
   
            })
         },
   
         migrateColumns(data){
            this.migratetablename = data.table_name;
            this.migratemodelname = data.model_name;
            this.datatomigrate= data;
            
   
            this.emitter.emit('openModalConfirmation', true);
   
   
   
         },
   
          getformtypebydatatypesByID(formtypeid){
            axios.get(route('formtype.getFormTypebyDataTypeByID'), {
                  params: {
                  form_type_id: formtypeid
               }}).then(response => {
                  response.data.forEach((val)=>{
                        this.formtypes[val.name] = val.formtypes;
                     })
                 

               
   
               })
   
           /*  try{
               let response =  await axios.get(route('formtype.getFormTypebyDataTypeByID'), {
                  params: {
                  form_type_id: formtypeid
               }});
   
               this.selectedformtype = response.data
            }catch(error){
   
            }
            return this.selectedformtype */
         },
   
         getformtypesbydatatypes(){
            var arrcolumntype = [];
            var arrformtypesval = [];
            axios.get(route('formtype.getformtypebydatatype')).then(response => {
               response.data.forEach((val)=>{
                 /* console.log(val.formtypes) */
                 this.formtypes[val.name] = val.formtypes;
   
   
               })
   
               console.log(this.formtypes)
              /*  this.formtypes.push(arr); */
            })
         },
   
         confirmMigrateColumns(data){
         
               axios.post('/getTableColumns', {
                     modelname: data.model_name,
                     systemTableID: data.id
                  }
               ).then(response => {
                  if(response.data == 'success'){
                        this.getnotyetmigratedcolumns(data);
                        this.emitter.emit('openModalConfirmation', false)
                        this.emitter.emit('refreshDataSystemTableMigrated')
                        this.emitter.emit('alertType', 'success')
                        this.emitter.emit('alertText', 'Successfully migrated')
                        this.emitter.emit('showAlert', true)
      
                        //open edit columns for reference tables (for foreign key) and edit column label if necessary
                        this.geteditcolumnsfunc(this.migratemodelname)
                        this.emitter.emit('openCustomModalwithBody', true)
      
      
                  }
      
               }).catch(ex => {
               
                     this.emitter.emit('alertText', ex.response.data.message)
                     this.emitter.emit('alertType', 'danger')
            
                     this.emitter.emit('showAlert', true)
      
               })
            
         },
   
           getnotyetmigratedcolumns(data){
   
             axios.get('/getCountNotYetMigrated', {
               params: {
                  modelname: data.model_name,
                  systemTableID: data.id
               }
            }).then(response => {
               this.columncount.push(response.data['columncount']);
               this.systemtabledetailscount.push(response.data['systemtabledetailscount']);
   
   
   
            })
   
   
         },
   
         updateSystemTableDetails(){
           
   
    
           axios.put(route('systemtabledetails.updateByBulk'), {
            formdata: this.form
           }).then(response => {
               console.log(response.data)
               this.emitter.emit('openCustomModalwithBody', false)
   
           }).catch(ex => {
               this.errors = ex.response.data.errors
               this.emitter.emit('alertText', ex.response.data.message + '. Please see highlighted in red.');
               this.emitter.emit('alertType', 'danger')
               this.emitter.emit('showAlert', true)
            })
         },

         getmodelnames(){
            axios.get('/getmodelnames').then(response => {
               this.modelnames = response.data;
            })
         }
      
   
   
      },
   
      created(){
         this.getlist();
         this.getformtypesbydatatypes();
         this.getmodelnames();
         this.emitter.on('refreshDatawithPagination-'+this.$page.url.replace('/',''), (evt) => {
               this.data = evt;
         })
   
         this.emitter.on('refreshDataSystemTableMigrated', (evt) => {
               this.getlist();
         })
   
         this.emitter.on('callModalConfirmationSystemTableMigrated', (evt) => {
               if(evt == true){
                   this.confirmMigrateColumns(this.datatomigrate);
   
               }
           })
      },
   
      computed: {
         filteredreferencetablecolumns(){
   
            var filteredData = {};
           var reftablecolumns = this.referencetablecolumns;
           var querytext = this.queryreferencecolumntable
   
   
            Object.keys(this.referencetablecolumns).forEach(function(key) {
               if(querytext === ''){
                  filteredData[key] = reftablecolumns[key];
               }else{
   
                  
                  filteredData[key] = reftablecolumns[key].filter(function(el) {
                   return el.toLowerCase().includes(querytext.toLowerCase());
                  });
               }
   
   
           });
           return filteredData;
   
         },
   
         filteredwherecolumn(){
           var filteredData = {};
           var reftablecolumns = this.referencetablecolumns;
           var querytext = this.querywherecolumn;
   
   
            Object.keys(this.referencetablecolumns).forEach(function(key) {
               if(querytext === ''){
                  filteredData[key] = reftablecolumns[key];
               }else{
                  filteredData[key] = reftablecolumns[key].filter(function(el) {
                   return el.toLowerCase().includes(querytext.toLowerCase());
                  });
               }
   
   
           });
           return filteredData;
         },
   
         filteredFormTypes(){
   
            var filteredData = {};
            var querytext = this.queryformtype;
            var formtypesdata = this.formtypes;
   
            Object.keys(this.formtypes).forEach(function(key) {
               if(querytext === ''){
                  filteredData[key] = formtypesdata[key];
               }else{
                  filteredData[key] = formtypesdata[key].filter(function(el) {
   
                   return el.form_type_name.toLowerCase().includes(querytext.toLowerCase());
                  });
               }
            })
   
          /*   this.formtypes['columntype'].forEach((val, index)=>{
   
               if(querytext === ''){
                  filteredData[val.columntype] = formtypesdata['formtypes']
   
               }else{
                  filteredData[val.name] = this.formtypes[formtypes].filter(function(el) {
                     return el.form_type_name.toLowerCase().includes(querytext.toLowerCase());
                  }
               }
            })  */
   
   
           /*  this.geteditcolumns.forEach((val, index)=>{
               if(querytext === ''){
                  filteredData[val.column_type] = this.getformtypesbydatatypes(val.column_type)
               }else{
                  filteredData[index] = this.formtypes.filter(function(el) {
                  if(el.datatypes.name == val.column_type)
                     return el.form_type_name.toLowerCase().includes(querytext.toLowerCase());
                  })
               }
   
            }) */
   
            return filteredData;
   
   
         /*    return columntype => this.formtypes.filter(function(el) {
   
               if(el.datatypes.name === `${columntype}`){
                  return el.form_type_name.toLowerCase().includes(querytext.toLowerCase());
               }
            })  */
   
   
   
           /*  filteredData = this.formtypes.filter(function(el) {
               if(el.datatypes.name === filteredData){
                  return el.form_type_name.toLowerCase().includes(querytext.toLowerCase());
               }
            }) */
   
            //return filteredData;
   
   
         },
      
      }
   
   
   }
   
   
   
   </script>
   