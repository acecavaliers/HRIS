<template>
  <TransitionRoot as="template" :show="openmodal">
  <Dialog as="div" class="relative z-10" @close="openmodal = false">
    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
    </TransitionChild>

  <form class="space-y-8 divide-y divide-gray-200">
    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6">
            <!-- BODY CONTENT -->
            <div>
          
              <!-- FORMS -->
              <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                <div class="space-y-6 sm:space-y-5">
                <div>
                  <h3 class="text-lg font-medium leading-6 text-gray-900">{{title}}</h3>
                <!--   <p class="mt-1 max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p> -->
                </div>

      
        <div class="space-y-6 sm:space-y-5">

        <span v-for="(column, index) in columns" :key="column.id">
        
          <!-- INPUT TEXT -->
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-text'">
            <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <div class="flex max-w-lg rounded-md shadow-sm">
                <input v-model="form[column.column_name]" type="text" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
              </div>
                <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>
          </div>

         <!-- INPUT NUMBER -->
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-number'">
              <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <div class="flex max-w-lg rounded-md shadow-sm">
                      <input type="number" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                  </div>
                    <p  v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
              </div>
          </div>

          <!-- INPUT DATE -->
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-date'">
              <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <div class="flex max-w-lg rounded-md shadow-sm">
                      <input type="date" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="column.is_disabled ==1? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6' : 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" />
                  </div>
                  <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
              </div>
          </div>

           <!-- INPUT TIME -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-time'">
                  <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                  <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                        <input type="time" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="column.is_disabled ==1? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6' : 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" />
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                  </div>
            </div>

            <!-- INPUT DATETIME -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-datetime'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                        <input type="datetime-local" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="column.is_disabled ==1? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6' : 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" />
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>

            <!-- COMBOBOX -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"  v-if="column.formtypes.slug == 'dropdown'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>

                  <!-- IF COLUMN NAME = REFERENCE_TABLE_COLUMN -->
                  <span v-if="column.column_name =='reference_table_column'">
                    <Combobox as="div" v-model="form[column.column_name]">
                      <div class="relative mt-2">
                        <ComboboxInput :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200': '','w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']" @change="query = $event.target.value" :display-value="(cbdata) => cbdata"/>
                        
                        <ComboboxButton :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'', 'absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none']">
                          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                        <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                          <ComboboxOption v-for="cbdata in filteredData" :key="cbdata.id" :value="cbdata" as="template" v-slot="{ active, selected }">
                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                              <div class="flex">
                                <span :class="['truncate', selected && 'font-semibold']">
                                <!--  {{ cbdata[column.reference_table_column] }}  --><!-- data from foreignkey -->
                                  {{ cbdata }}
                                </span>
                                <span :class="['ml-2 truncate text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
                                  <!-- {{ person.username }} -->
                                </span>
                              </div>

                              <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                              </span>
                            </li>
                          </ComboboxOption>
                        </ComboboxOptions>
                      </div>
                  </Combobox>

                  </span>

                  <!-- ELSE WITH FOREIGN KEY -->
                  <span v-else>
                  <Combobox as="div" v-model="selectedData[column['reference_table']]">
                    <div class="relative mt-2">
                      <ComboboxInput :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200': '','w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']" @change="query = $event.target.value" :display-value="(cbdata) => cbdata?.[column.reference_table_column]"/>
                      
                      <ComboboxButton :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'', 'absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none']">
                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                      </ComboboxButton>

                      <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                        <ComboboxOption @click="getDataFromForeignKey()" v-for="cbdata in filteredData[column['reference_table']]" :key="cbdata.id" :value="cbdata" as="template" v-slot="{ active, selected }">
                          <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                            <div class="flex">
                              <span :class="['truncate', selected && 'font-semibold']">
                                {{ cbdata[column.reference_table_column] }} <!-- data from foreignkey -->
                              </span>
                              <span :class="['ml-2 truncate text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
                                <!-- {{ person.username }} -->
                              </span>
                            </div>

                            <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                              <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                          </li>
                        </ComboboxOption>
                      </ComboboxOptions>
                    </div>
                  </Combobox>
                  </span>
                <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>

            <!-- SWITCH -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'switch'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <Switch v-model="form[column.column_name]" :disabled="column.is_disabled==1" :class="[form[column.column_name]==1 ? 'bg-indigo-600' : 'bg-gray-200', column.is_disabled==1? 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200': 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']">
                    <span class="sr-only">Use setting</span>
                    <span aria-hidden="true" :class="[form[column.column_name]==1 ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                </Switch>
                <p v-if="errors['formdata.'+column.column_name]" class="mt-5 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>

             <!-- FILE -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'file'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                      <input @change="onFileChange()" type="file" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>


            <!-- PRICE -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'price'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="relative mt-1 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">₱</span>
                </div>
                <input @keyup="formatPHP(column.column_name)" @keypress="isNumber($event)" :disabled="column.is_disabled==1" v-model="form[column.column_name]" type="text" :name="column.column_name" :id="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pl-7 pr-12 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1? 'block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200':'block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" placeholder="0.00" :aria-invalid="errors['formdata.'+column.column_name]? 'true':'false'" :aria-describedby="errors['formdata.'+column.column_name]? column.column_name+'-error' : form[column.column_name]+'-currency'" />
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <span class="text-gray-500 sm:text-sm" id="price-currency">PHP</span>
                </div>
                  <p v-if="errors['formdata.'+column.column_name]" class="text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>


            <!-- TEXTAREA -->
            <!-- IF USE TEXTEDITOR -->
            <div v-if="column.use_texteditor==1">
              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'textarea'">
                  <label :for="column.column_name" class="block text-sm font-medium text-gray-700">{{column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                  <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="max-w-lg rounded-md shadow-sm">

                      <span v-if="column.text_editor_id !== null">

                          <span v-if="column.texteditors.is_default == 1">
                            <span v-if="column.texteditors.slug == 'quill-editor'">
                              <QuillEditor v-model:content="form[column.column_name]" content-type="html"></QuillEditor>
                            </span>
                            <span v-else>
                              <textarea :disabled="column.is_disabled==1" v-model="form[column.column_name]" rows="4" cols="10" :name="column.column_name" :id="column.column_name" :class="errors['formdata.'+column.column_name] ? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm' : column.is_disabled==1? 'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'"  :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                            </span>
                          </span>
                          <span v-else>
                            <span v-if="column.texteditors.slug == 'quill-editor'">
                              <QuillEditor v-model:content="form[column.column_name]" content-type="html"></QuillEditor>
                            </span>
                          </span>

                      </span>
                      <span v-else>
                        <textarea :disabled="column.is_disabled==1" v-model="form[column.column_name]" rows="4" cols="10" :name="column.column_name" :id="column.column_name" :class="errors['formdata.'+column.column_name] ? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm' : column.is_disabled==1? 'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'"  :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                      </span>
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                  </div>
                </div>
            </div>
            <div v-else>
              <!-- ELSE USE DEFAULT TEXTAREA -->
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'textarea'">
                  <label :for="column.column_name" class="block text-sm font-medium text-gray-700">{{column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                  <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                      <textarea :disabled="column.is_disabled==1" v-model="form[column.column_name]" rows="4" cols="10" :name="column.column_name" :id="column.column_name" :class="errors['formdata.'+column.column_name] ? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm' : column.is_disabled==1? 'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'block w-full rounded-md border-gray-300 pl-7 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'"  :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                  </div>
                </div>
            </div>
        </span>
      </div><!-- /space-y-6 sm:space-y-5 -->
    </div> <!-- /space-y-8 divide-y divide-gray-200 sm:space-y-5 -->
            </div> <!-- END FORMS -->

              <br>
              <slot name="additionalforms"></slot>

            </div><!-- END BODY CONTENT -->

            <!-- SAVE AND CANCEL BUTTON -->
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <button @click.prevent="editmode == true ? updateform() : submitform()" type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Save</button>
              <button @click="cancelmodal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm" ref="cancelButtonRef">Cancel</button>
            </div>
            <!-- /SAVE AND CANCEL BUTTON -->
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </form>

  </Dialog>
</TransitionRoot>
</template>

<script setup>


import { Switch, Dialog, DialogPanel,TransitionChild, TransitionRoot } from '@headlessui/vue'

import { ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { Combobox,ComboboxButton,ComboboxInput,ComboboxOption,ComboboxOptions,} from '@headlessui/vue'
import Pluralize from 'pluralize';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from 'axios';

const query = ref('')

</script>

<script>
export default {

  props: ['title', 'routename'],

  data(){
      return{
          openmodal:false,
          editmode: false,
          form: {},
          formid: '',
          columns: [],
          errors: [],
          selectedData: [],
          filteredData: [],
          model_name: [],
          pageurl: '',
          isdataloaded: false,
          editmodalopen: false,
          data: [],
          nextnum:null,
          continuesubmit: false,
          loading: true,
          referencetablecolumns: [],
          selectedDataReferenceTableCol: [],
          modelname: '',
          ismainsidebar: false,
      

      }
  },


  methods:{

    addform(){
      this.errors = [];
     // this.openmodal = true;
     

      axios.get(route('addformcolumns'), {
          params: {
            pageurl: this.pageurl,
            model_name: this.modelname,
            ismainsidebar: this.ismainsidebar
          }
        }).then(response => {
          this.columns = response.data;
         
          if(this.columns.length == 0){
            
             this.openmodal = false;
          }else{
            this.addDatatoForm();
            this.getDataFromForeignKey();
              this.openmodal = true;
          }

      })
          
      },

      editform(){
        this.errors = [];

    

        axios.get(route('editformcolumns'),{
            params: {
              pageurl: this.pageurl
            }
          }).then(response => {
              this.columns = response.data;
             

              this.getDataFromForeignKey();

           /*    if(this.data['reference_table'] !== '' || this.data['reference_table'] !== null){
                this.getreferencetablecolumns(this.data['reference_table'])
              }  */
              
              //this.getreferencetablecolumns(this.data['reference_table'])
              
            /*   console.log('editform')
              console.log(this.data['reference_table'])
              console.log('end editform') */
              this.addDatatoEditForm()

        

          })


      },

      onFileChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
          this.form[columnname] = files[0];
        this.createImage(files[0]);
      },

      createImage(file) {
        var image = new Image();
        var reader = new FileReader();
        var vm = this;

        reader.onload = (e) => {
          vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
        console.log(this.image)
      },


      getDataFromForeignKey(){
        var x = this;
         var fdata = [];
        
     
         
          this.columns.forEach((val) => {
           
              if(val.is_foreignkey == 1 ){

                if(this.selectedData[val.reference_table] !== '' && this.selectedData[val.reference_table] !== null){

                this.form[val.column_name] = this.selectedData[val.reference_table]
              
                }

                //when there is foreign key in input dropdown then data will only display with linked to the input that is chosen
                axios.get('/getDataFromForeignKey', {
                      params: {
                          modelname: val.reference_table,
                          columntype: this.data['column_type'],
                          wherecolumn: val.where_column,
                          formvalue:  this.form[val.where_column] == null ? '':this.form[val.where_column].id
                      }
                  }).then(response => {

                      this.filteredData[val.reference_table] = response.data
                    //  console.log(response.data)
                  
                  })
                     
                 
        
                    // this.model_name.push(val.reference_table)

                     
              }else{
            
                if(val.column_name == 'reference_table_column' && this.data['reference_table'] !== ''){
                 // console.log('reference_table_column')
               //  console.log('asdf')
                  axios.get(route('getTableColumnsFinal'), {
                      params: {
                          modelname: this.data['reference_table']
                      }
                    }).then(response => {
                     this.filteredData = response.data

                          
                    })
                }else{
                  this.filteredData = [];
                }
      

              }


          })
       

      },

      addDatatoForm(){

       this.columns.forEach((val, key)=>{


          if(val.column_type == 'boolean' || val.column_type == 'smallint'){
              this.form[val.column_name] = false;
          }else if (val.is_autogenerate == 1){
            //get data from autogeneratecode that has been setup
            axios.get(route('autogeneratecodes.getAutoGenCodeBySystemTableDetails'), {
              params: {
                systemtabledetailid: val.id
              }
            }).then(response => {
              this.form[val.column_name] = response.data;
            })


          }else{

              this.form[val.column_name] = '';
          }
        })

      },


  

      addDatatoEditForm(){

      this.filteredData = [];  
      
      this.formid = this.data.id;
      
     // console.log(this.columns)
      this.columns.forEach((val, key)=>{
        this.selectedData[val.reference_table] = '';
        //boolean = for mysql | smallint = for mssql
          if(val.column_type == 'boolean' || val.column_type == 'smallint'){
         
              if(this.data[val.column_name] == 0){
                    this.form[val.column_name] =false;
              }else{
                    this.form[val.column_name] = true;
              }

          }
          
           if(val.is_foreignkey == 1){

         

              var pluralizereferencecolumn = Pluralize(val.reference_table.toLowerCase())
        
              this.selectedData[val.reference_table] = this.data[pluralizereferencecolumn]
        
      
          
          }else{
           

            if(this.data['reference_table'] !== '' && val.column_name == 'reference_table_column'){
            
              this.form[val.column_name] = this.data['reference_table_column'];

            }
              

            this.form[val.column_name] = this.data[val.column_name];
          }

         

        })


      },

      cancelmodal(){
        this.openmodal = false;
      },

      updateform(){
     
          this.columns.forEach((val) => {

            if(val.is_foreignkey == 1){
          
              if(this.selectedData[val.reference_table] !== '' && this.selectedData[val.reference_table] !== null){
               
                this.form[val.column_name] = this.selectedData[val.reference_table].id
              }else{
                this.form[val.column_name] = null
              }
          
              
            }else if(val.formtypes.slug == 'price'){
                this.form[val.column_name] = this.form[val.column_name].replaceAll(',','');
            }
          })

       
          axios.patch(route(this.routename+'.update', this.formid), {pageurl: this.$page.url, formdata: this.form}).then(response => {
              this.openmodal = false;
              this.emitter.emit('opennotification', true)
              this.emitter.emit('refreshData-'+this.$page.url.replace('/',''))
             
          });
      },

      async isautogenerate(id){
        let self = this
            const response = await axios.get(route('autogeneratecodes.getAutoGenCodeBySystemTableDetails'), {
                params: {
                  systemtabledetailid: id
                }
            })

            self.nextnum = response.data;

      },



       submitform(){
        let self = this;

           this.columns.forEach((val) => {

              if(val.is_foreignkey == 1){
                this.form[val.column_name] = this.selectedData[val.reference_table].id


              }

              else if(val.formtypes.slug == 'price'){
                  this.form[val.column_name] = this.form[val.column_name].replaceAll(',','');

              }




           });

           this.submitpost();


       },

      submitpost(){

          axios.post(route(this.routename+'.store'), {
              formdata: this.form
            }).then(response => {
                if(response.data == 'success'){

                      this.openmodal = false
                      this.emitter.emit('opennotification', true)
                      this.emitter.emit('refreshData-'+this.$page.url.replace('/',''))

                }
            }).catch(err => {
              if(err.response.status == 422){
                   this.errors = err.response.data.errors
                 
              }

            });
        },


      isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46 && charCode !== 188) {
              evt.preventDefault();;
          } else {
              return true;
          }
      },

     formatPHP(columnname) {
          this.form[columnname] = this.form[columnname].toString().replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

  },






  created(){



    this.emitter.on('openForm', (evt) => {
  
       this.pageurl = evt.pageurl
       this.modelname = evt.model_name
       this.ismainsidebar = evt.ismainsidebar
       this.editmode = false;
       this.addform();
       console.log('OPEN FORM: ' +evt)
     

      })

    this.emitter.on('openEditForm', (evt) => {
        this.columns = [];
        this.editmodalopen = true;
        this.pageurl = evt.pageurl
        this.data= evt.datatoedit
        /*  this.columns = evt.editcol; */
        this.editmode = true;
        this.editform();

        this.openmodal = true;

    })









  }
}
</script>
