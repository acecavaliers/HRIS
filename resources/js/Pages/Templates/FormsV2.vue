<template>
<div>
<form class="space-y-8 divide-y divide-gray-200">
<div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div class="space-y-6 sm:space-y-5">
        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{title}}</h3>
        <!--   <p class="mt-1 max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p> -->
        </div>

        <div class="space-y-6 sm:space-y-5" v-if="columns.length==0">
          <FormsNotYetMigrated></FormsNotYetMigrated>
        </div>

        <div class="space-y-6 sm:space-y-5" v-else>


        <span v-for="(column, index) in columns" :key="column.id">

          <!-- INPUT TEXT -->

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-text' && column.is_form_hidden == 0">
            <label :for="column.column_name" :class="column.is_form_hidden == 1? 'hidden':''" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <div :class="column.is_form_hidden==1? 'hidden': '', 'flex max-w-lg rounded-md shadow-sm'">
                  <!-- FILE SIZE -->
                <input v-model="file_size" v-if="column.column_name == 'file_size'"  disabled type="text" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>

                <!-- FILE TYPE -->
                <input v-model="file_type" v-else-if="column.column_name == 'file_type'" disabled type="text" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>


                <input v-model="form[column.column_name]" v-else type="text" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
              </div>

                <!-- CUSTOM FORM -->
            <!--    <slot name="customform" :formcolumn="column.column_name"></slot> -->
                <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>
          </div>


          <!-- INPUT TEXT WITH NOT APPLICABLE FIELD  -->
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-text-with-na' && column.is_form_hidden == 0">
            <label :for="column.column_name" :class="column.is_form_hidden == 1? 'hidden':''" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <div class="flex max-w-lg rounded-md shadow-sm">
                <input v-model="form[column.column_name]" :type="column.is_form_hidden==1?'hidden':'text'" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>

              </div>
              <div class="relative flex items-start">

                  <div class="flex h-6 items-center">
                  <input @change="notapplicableclick(column.column_name, notapplicablecheckbox[column.column_name])" id="not-applicable" aria-describedby="not-applicable-description" name="notapplicable" v-model="notapplicablecheckbox[column.column_name]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                  </div>
                  <div class="ml-3 text-sm leading-6">
                  <label for="not-applicable" class="font-medium text-gray-900">NOT APPLICABLE</label>
                  <!-- <p id="not-applicable-description" class="text-gray-500"></p> -->
                  </div>
              </div>
                <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>
          </div>




           <!-- INPUT PASSWORD -->
           <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'password'">
            <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <div class="flex max-w-lg rounded-md shadow-sm">
                <input v-model="form[column.column_name]" type="password" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
              </div>
                <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
            </div>
          </div>

            <!-- INPUT EMAIL -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'email'">
            <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label}} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <div class="flex max-w-lg rounded-md shadow-sm">
                <input v-model="form[column.column_name]" type="email" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :autocomplete="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
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
                      <input type="date" v-model="form[column.column_name]" :max="maxValue" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="column.is_disabled ==1? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6' : 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" />
                  </div>
                  <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
              </div>
          </div>


        <!-- INPUT DATE (MONTH AND YEAR) -->
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-date-month'">
              <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <div class="flex max-w-lg rounded-md shadow-sm">
                      <input type="month" v-model="form[column.column_name]" :max="maxValue" :name="column.column_name" :id="column.column_name" :disabled="column.is_disabled==1" :autocomplete="column.column_name" :class="column.is_disabled ==1? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6' : 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" />
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
                    <Combobox as="div" v-model="form[column.column_name]" class="sm:col-span-2 sm:mt-0">
                      <div class="relative mt-2 flex-auto w-96">
                        <ComboboxInput :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200': '','w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']" @change="query = $event.target.value" :display-value="(cbdata) => cbdata"/>

                        <ComboboxButton :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'', 'absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none']">
                          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                        <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                          <ComboboxOption v-for="cbdata in filteredData" :key="cbdata.id" :value="cbdata" as="template" v-slot="{ active, selected }">
                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                              <div class="flex">
                                <span :class="['', selected && 'font-semibold']">
                                <!--  {{ cbdata[column.reference_table_column] }}  --><!-- data from foreignkey -->
                                  {{ cbdata }}
                                </span>
                                <span :class="['ml-2 text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
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

                     <!-- ELSE IF WITH FOREIGN KEY -->
                 <span v-else-if="column.is_foreignkey == 1 || (column.reference_table !== null || column.reference_table !== '')">

                  <Combobox  :by="column.reference_table_column" nullable as="div" v-model="selectedData[column['reference_table']]" class="sm:col-span-2 sm:mt-0">


                      <div class="relative mt-2 flex-auto w-96">


                        <ComboboxInput @keyup.enter="getDataFromForeignKey()" @focus="onFocuschange(column.reference_table, column.reference_table_column)" :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200': '','w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']" @change="onChangeQuery($event.target.value, column.reference_table, column.reference_table_column, column.column_name)" :display-value="(cbdata) =>cbdata?.[column.reference_table_column]"/>

                        <ComboboxButton :disabled="column.is_disabled==1" :class="[column.is_disabled==1? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' :'', 'absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none']">
                          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                      <!--   filteredData[column['reference_table']] -->

                            <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">

                            <!--   <div
                                v-if="filterComboBoxSearch(query[column.reference_table], column.reference_table, column.reference_table_column).length == 0 && query[column.reference_table] !== ''"
                                class="relative cursor-default select-none px-4 py-2 text-gray-700"
                              >
                                Nothing found.
                              </div> -->


                            <!--   <div
                                v-else-if="filterComboBoxSearch(query[column.reference_table], column.reference_table, column.reference_table_column).length > 0 && query[column.reference_table] === ''"
                                class="relative cursor-default select-none px-4 py-2 text-gray-700"
                              >
                               Select One
                              </div>
 -->

                            <!-- v-if="filterComboBoxSearch(query[column.reference_table], column.reference_table, column.reference_table_column).length > 0" -->
                              <ComboboxOption @click="getDataFromForeignKey()" v-for="cbdata in filterComboBoxSearch(query[column.reference_table], column.reference_table, column.reference_table_column)" :key="cbdata.id" :value="cbdata" as="template" v-slot="{ active, selected }">

                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                  <div class="flex">

                                    <span :class="['', selected && 'font-semibold']">

                                    <!--   {{ cbdata }} -->
                                    {{ cbdata[column.reference_table_column]  }}

                                    <!--  {{ column.reference_table_column.split(".").length > 0 ? cbdata[column.reference_table_column.split(".")[0]][column.reference_table_column.split(".")[1]].replace(/<[^>]*>?/gm, ''): cbdata[column.reference_table_column.split(".")[0]]}}  -->
                        <!--   {{ cbdata[column.reference_table_column.split(".")[0]][column.reference_table_column.split(".")[1]] }} -->
                                    </span>

                                    <!-- SECOND DISPLAY DATA -->
                                    <span :class="['ml-2 text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">

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

                  <!-- ELSE NORMAL DROPDOWN WITH DATA -->
                  <span v-else>

                    <slot name="normal_dropdown" :column="column" :form="form"></slot>



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

              <!-- FILE PHOTO -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'file-photo'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">

                  <span v-if="column.is_avatar_photo == 1" class="inline-block h-80 w-80 overflow-hidden rounded-full bg-gray-100">
                    <img :src="imagedata[column.column_name]"/>
                  </span>
                  <span v-else>
                    <img :src="imagedata[column.column_name]" width=300 height=300/>
                  </span>


                    <div class="flex max-w-lg rounded-md shadow-sm">
                      <input @change="onFileChange($event, column.column_name)" type="file" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>

              <!-- FILE DOCUMENT -->
              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'file-document'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">

                    <div class="flex max-w-lg rounded-md shadow-sm">
                      <input @change="onFileDocumentChange($event, column.column_name)" type="file" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                    </div>
                    <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>

            <!-- COLOR PICKER -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'color-picker'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" v-model="form[column.column_name]">
                  <input type="color" v-model="form[column.column_name]">

                  <p v-if="errors['formdata.'+column.column_name]" class="mt-2 text-sm text-red-600" :id="column.column_name+'-error'">{{errors['formdata.'+column.column_name][0].replace('formdata.', '')}}</p>
                </div>
            </div>




            <!-- FOR SIGNATURES -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'signature'">
                <label :for="column.column_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }} <span v-if="column.is_required == 1" class="text-red-600">*</span></label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <div>
                      <label class="text-base font-semibold text-gray-900">E-Signature Method</label>
                      <p class="text-sm text-gray-500">How do you prefer to saving e-signature?</p>
                      <fieldset class="mt-4">
                        <legend class="sr-only">E-Signature Method</legend>
                        <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                          <div v-for="esignaturemethod in esignaturemethods" :key="esignaturemethod.id" class="flex items-center">
                            <input v-model="selectedsignaturemethod" :value="esignaturemethod.id" :id="esignaturemethod.id" name="esignature-method" type="radio" :checked="esignaturemethod.id === 'file-browse'" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                            <label :for="esignaturemethod.id" class="ml-3 block text-sm font-medium leading-6 text-gray-900">{{ esignaturemethod.title }}</label>
                          </div>
                        </div>


                      </fieldset>
                      <div class="flex max-w-lg rounded-md shadow-sm" v-if="selectedsignaturemethod == 'signaturepad'">
                        <button @click="openSignaturePad(column.column_name)" type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Signature Pad</button>
                        <Vue3Signature></Vue3Signature>
                      </div>
                        <div class="flex max-w-lg rounded-md shadow-sm" v-else="">
                          <input @change="onFileChange($event, column.column_name)" type="file" :name="column.column_name" :disabled="column.is_disabled==1" :id="column.column_name" :class="errors['formdata.'+column.column_name]? 'block w-full rounded-md border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm': column.is_disabled ==1 ? 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6':'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'" :aria-invalid="errors[column.column_name]? 'true':'false'" :aria-describedby="errors[column.column_name]? column.column_name+'-error' : ''"/>
                        </div>
                        <img :src="imagedata[column.column_name]" width=300 height=200/>

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

        <!-- Multi Select -->
        <div v-if="title === 'WorkShift'" class="">

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-2 pb-2">
                <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Show multi select here for Divisions
                    <span  class="text-red-600">*</span>
                </label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div ref="modalContainer" class="max-w-lg relative ">
                        <Menu as="div" class="relative">
                            <MenuButton type="button" class="flex items-center justify-between w-full gap-x-1.5 rounded-r-md bg-white px-3 py-2 text-sm  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" >
                                <div>
                                    <span v-if="selectedDivisions.length>0">
                                        <span class="text-xs ml-0.5 bg-green-200 px-1.5 py-1 rounded-lg" v-for="selected in selectedDivisions.slice(0, 5)" :key="selected.id">
                                            {{ selected.shortname }}
                                        </span>
                                        <span class="text-xs ml-0.5 px-1.5 py-1 rounded-lg" v-if="selectedDivisions.length >5" >
                                           + {{ selectedDivisions.length - 5 }} more
                                        </span>
                                    </span>
                                    <span v-else>Select Division</span>
                                </div>

                                <ChevronUpDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems class="absolute right-0 z-10 mb-0 w-3/4 origin-bottom-right max-h-80 overflow-auto rounded-lg bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" style="bottom: 100%; margin-bottom: 8px;">
                                    <div v-for="(item, index) in divisions" :key="item.id" class="w-full divide-y">
                                        <label class="flex justify-start cursor-pointer w-full space-x-3 p-3 text-xs border-b hover:bg-gray-100">
                                            <input id="cbx-restDay" type="checkbox" v-model="item.checked" @change="updateSelected('division', item)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <span>{{ index +1 }}. {{ item.name }}</span>
                                        </label>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-2 pb-2">
                <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Show multi select here for Departments
                    <span  class="text-red-600">*</span>
                </label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div ref="modalContainer" class="max-w-lg relative ">
                        <Menu as="div" class="relative">
                            <MenuButton type="button" class="flex items-center justify-between w-full gap-x-1.5 rounded-r-md px-3 py-2 text-sm  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300" :disabled="selectedDivisions.length<1" :class="{'bg-gray-200': selectedDivisions.length < 1,'bg-white hover:bg-gray-50': selectedDivisions.length > 0, }" >
                                <div>
                                    <span v-if="selectedDepartments.length > 0">
                                        <span class="text-xs ml-0.5 bg-green-200 px-1.5 py-1 rounded-lg" v-for="selected in selectedDepartments.slice(0, 5)" :key="selected.id">
                                            {{ selected.shortname }}
                                        </span>
                                        <span class="text-xs ml-0.5 px-1.5 py-1 rounded-lg" v-if="selectedDepartments.length >5" >
                                           + {{ selectedDepartments.length - 5 }} more
                                        </span>
                                    </span>
                                    <span v-else>Select Departments</span>
                                </div>
                                <ChevronUpDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-10 mb-0 w-3/4 origin-bottom-right max-h-80 overflow-auto rounded-lg bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" style="bottom: 100%; margin-bottom: 8px;">
                                    <div v-for="(item, index) in filteredDepartments" :key="item.id" class="w-full"  >
                                        <label class="flex justify-start cursor-pointer w-full space-x-3 p-3 text-xs border-b hover:bg-gray-100">
                                            <input id="cbx-restDay" type="checkbox" v-model="item.checked" @change="updateSelected('department', item)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <span>{{ index +1 }}. {{ item.name }}</span>
                                        </label>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-2 pb-2">
                <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Show multi select here for Sub-Departments
                    <span  class="text-red-600">*</span>
                </label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div ref="modalContainer" class="max-w-lg relative ">
                        <Menu as="div" class="relative">
                            <MenuButton type="button" class="flex items-center justify-between w-full gap-x-1.5 rounded-r-md px-3 py-2 text-sm  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300"  :disabled="selectedDepartments.length<1" :class="{'bg-gray-200': selectedDepartments.length < 1,'bg-white hover:bg-gray-50': selectedDepartments.length > 0, }" >
                                <div>
                                    <span v-if="selectedSubDepartments.length > 0">
                                        <span class="text-xs ml-0.5 bg-green-200 px-1.5 py-1 rounded-lg" v-for="selected in selectedSubDepartments.slice(0, 5)" :key="selected.id">
                                            {{ selected.shortname }}
                                        </span>
                                        <span class="text-xs ml-0.5 px-1.5 py-1 rounded-lg" v-if="selectedSubDepartments.length >5" >
                                           + {{ selectedSubDepartments.length - 5 }} more
                                        </span>
                                    </span>
                                    <span v-else>Select Sub-Departments</span>
                                </div>
                                <ChevronUpDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-10 mb-0 w-3/4 origin-bottom-right max-h-80 overflow-auto rounded-lg bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" style="bottom: 100%; margin-bottom: 8px;">
                                    <div v-for="(item, index) in filteredSubDepartments" :key="item.id" class="w-full"  >
                                        <label class="flex justify-start cursor-pointer w-full space-x-3 p-3 text-xs border-b hover:bg-gray-100">
                                            <input id="cbx-restDay" type="checkbox" v-model="item.checked" @change="updateSelected('subdepartment', item)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <span>{{ index +1 }}. {{ item.name }}</span>
                                        </label>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-y sm:border-gray-200 sm:pt-2">
                <label :for="divisions" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Show multi select here for Sub-Departments Unit
                    <span  class="text-red-600">*</span>
                </label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div ref="modalContainer" class="max-w-lg relative ">
                        <Menu as="div" class="relative">
                            <MenuButton type="button" class="flex items-center justify-between w-full gap-x-1.5 rounded-r-md px-3 py-2 text-sm  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300"  :disabled="selectedSubDepartments.length<1" :class="{'bg-gray-200': selectedSubDepartments.length < 1,'bg-white hover:bg-gray-50': selectedSubDepartments.length > 0, }" >
                                <div>
                                    <span v-if="selectedSubDepartmentUnits.length > 0">
                                        <span class="text-xs ml-0.5 bg-green-200 px-1.5 py-1 rounded-lg" v-for="selected in selectedSubDepartmentUnits.slice(0, 5)" :key="selected.id">
                                            {{ selected.shortname }}
                                        </span>
                                        <span class="text-xs ml-0.5 px-1.5 py-1 rounded-lg" v-if="selectedSubDepartmentUnits.length >5" >
                                           + {{ selectedSubDepartmentUnits.length - 5 }} more
                                        </span>
                                    </span>
                                    <span v-else>Select Sub-Department Unit</span>
                                </div>
                                <ChevronUpDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-10 mb-0 w-3/4 origin-bottom-right max-h-80 overflow-auto rounded-lg bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" style="bottom: 100%; margin-bottom: 8px;">
                                    <div v-for="(item, index) in filteredSubDepartmentUnit" :key="item.id" class="w-full"  >
                                        <label class="flex justify-start cursor-pointer w-full space-x-3 p-3 text-xs border-b hover:bg-gray-100">
                                            <input id="cbx-restDay" type="checkbox" v-model="item.checked" @change="updateSelected('subdepartmentunit', item)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <span>{{ index +1 }}. {{ item.name }}</span>
                                        </label>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

        </div>





    </div> <!-- /space-y-8 divide-y divide-gray-200 sm:space-y-5 -->
            </div> <!-- END FORMS -->
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <button @click.prevent="editmode == true ? updateform() : submitform()" type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Save</button>
              <button @click="cancelmodal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm" ref="cancelButtonRef">Cancel</button>
            </div>

</form>
</div>
</template>

<script setup>

import { Head,Link } from '@inertiajs/vue3';
import { Switch} from '@headlessui/vue'
import { ChevronUpIcon, ExclamationCircleIcon } from '@heroicons/vue/20/solid'
import { computed, ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon,ChevronDownIcon } from '@heroicons/vue/20/solid'
import { Combobox,ComboboxButton,ComboboxInput,ComboboxLabel,ComboboxOption,ComboboxOptions, TransitionRoot,} from '@headlessui/vue'
import Pluralize from 'pluralize';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from 'axios';
import { faLessThan } from '@fortawesome/free-solid-svg-icons';
import FormsNotYetMigrated from '@/Pages/Templates/FormsNotYetMigrated.vue'
import defaultavatar from '@/images/default_avatar_profile_icon.jpg';
import Vue3Signature from '@/Pages/Templates/Vue3Signature.vue'
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import Forms from './Forms.vue';

const esignaturemethods = [
  { id: 'file-browse', title: 'Browse File' },
  { id: 'signaturepad', title: 'Signature Pad' },
]
</script>
<script>
export default {
  props: ['title', 'routename', 'modelname', 'ismainsidebar', 'datavalues', 'editmode', 'pageurl', 'datavaluesreferencedother'],

  data(){
      return{

         /*  editmode: false, */
          form: {},
          formid: '',
          columns: [],
          errors: [],
          selectedData: [],
          filteredData: [],
          model_name: [],
          selectedsignaturemethod: '',
          isdataloaded: false,
          editmodalopen: false,
          data: [],
          nextnum:null,
          continuesubmit: false,
          loading: true,
          referencetablecolumns: [],
          selectedDataReferenceTableCol: [],
          datatoedit: [],
          imagedata: [],
          file: [],
          maxValue: new Date().toISOString().split("T")[0],
          notapplicablecheckbox: [],
          signaturepadcolumnname: '',
          query: [],
          file_size: '',
          file_type: '',
          referencetablecolumnforcombobox: {},
          divisions: [],
          departments: [],
          subDepartments: [],
          subDepartmentUnits: [],
          selectedDivisions:[],
          selectedDepartments:[],
          selectedSubDepartments:[],
          selectedSubDepartmentUnits:[],

      }
  },


  methods:{
    updateSelected(type, item) {
        if (type === 'division'){
            if (item.checked) {
                if (!this.selectedDivisions.find(div => div.id === item.id)) {
                this.selectedDivisions.push({ division_id: item.id, shortname: item.shortname });
                }
            } else {
                this.selectedDivisions = this.selectedDivisions.filter(div => div.division_id !== item.id);
            }
            this.filteredDepartments.forEach(dept => {
                dept.checked = false;
            });
            this.filteredSubDepartments.forEach(subDept => {
                subDept.checked = false;
            });
            this.filteredSubDepartmentUnit.forEach(subDeptUnit => {
                subDeptUnit.checked = false;
            });
            this.selectedSubDepartmentUnits = [];
            this.selectedSubDepartments = [];
            this.selectedDepartments = [];

        }

        if (type === 'department'){
            if (item.checked) {
                if (!this.selectedDepartments.find(dept => dept.id === item.id)) {
                this.selectedDepartments.push({ department_id: item.id, shortname: item.shortname });
                }
            } else {
                this.selectedDepartments = this.selectedDepartments.filter(dept => dept.department_id !== item.id);
            }

            this.filteredSubDepartments.forEach(subDept => {
                subDept.checked = false;
            });
            this.filteredSubDepartmentUnit.forEach(subDeptUnit => {
                subDeptUnit.checked = false;
            });
            this.selectedSubDepartmentUnits = [];
            this.selectedSubDepartments = [];
        }

        if (type === 'subdepartment'){
            if (item.checked) {
                if (!this.selectedSubDepartments.find(subDept => subDept.id === item.id)) {
                this.selectedSubDepartments.push({ sub_department_id: item.id, shortname: item.shortname });
                }
            } else {
                this.selectedSubDepartments = this.selectedSubDepartments.filter(subDept => subDept.sub_department_id !== item.id);
            }

            this.filteredSubDepartmentUnit.forEach(subDeptUnit => {
                subDeptUnit.checked = false;
            });
            this.selectedSubDepartmentUnits = [];
        }

        if (type === 'subdepartmentunit'){
            if (item.checked) {
                if (!this.selectedSubDepartmentUnits.find(subDeptUnit => subDeptUnit.id === item.id)) {
                this.selectedSubDepartmentUnits.push({ sub_department_unit_id: item.id, shortname: item.shortname });
                }
            } else {
                this.selectedSubDepartmentUnits = this.selectedSubDepartmentUnits.filter(subDeptUnit => subDeptUnit.sub_department_unit_id !== item.id);
            }
        }

        console.log('DIDIDIDID', this.selectedDivisions);


    },
    getDivsAndDepts() {
        axios.get(route('employeeworkschedule.getSubDeptUnit'))
            .then(response => {
                this.subDepartmentUnits = response.data.map(val => ({
                    id: val.id,
                    checked: false,
                    name: val.name,
                    shortname: val.short_name,
                    sub_department_id: Number(val.sub_department_id),
                }));
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
            });

        axios.get(route('employeeworkschedule.getSubDept'))
            .then(response => {
                this.subDepartments = response.data.map(val => ({
                    id: val.id,
                    checked: false,
                    name: val.name,
                    shortname: val.short_name,
                    department_id: Number(val.department_id),
                }));
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
            });

        axios.get(route('employeeworkschedule.getDept'))
            .then(response => {
                this.departments = response.data.map(val => ({
                    id: val.id,
                    checked: false,
                    name: val.name,
                    shortname: val.short_name,
                    division_id: Number(val.division_id),
                }));
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
            });

        axios.get(route('employeeworkschedule.getDivisions'))
            .then(response => {
                this.divisions = response.data.map(val => ({
                    id: val.id,
                    name: val.name,
                    checked: false,
                    shortname: val.short_name,
                }));
            })
            .catch(error => {
                console.error('Error fetching divisions:', error);
            });


    },


    cancelmodal(){
      this.emitter.emit('openFormModal', false)
    },

    onFocuschange(referencetable, referencetablecolumn){

      this.query[referencetable] = '';
    /*   if(!this.query[referencetable]){


      } */




    },

    onChangeQuery(val, referencetable, referencetablecolumn, columnname){
      this.referencetablecolumnforcombobox[referencetable] = referencetablecolumn;
      this.query[referencetable] =val
      if(!this.query[referencetable]){
        this.selectedData[referencetable] = '';
        this.form[columnname] = ''

      }





     /*  console.log(this.query)
      console.log(this.filteredData)
      console.log(this.referencetablecolumnforcombobox) */

    },

    getData(){
      console.log(this.editmode)
      if(this.editmode == false){
        this.addform();
      }else{
        this.editform();
        console.log('edit')
      }
    },

    addform(){

      this.errors = [];

      axios.get(route('addformcolumns'), {
          params: {
            pageurl: this.pageurl,
            model_name: this.modelname,
            ismainsidebar: this.ismainsidebar
          }
        }).then(response => {
          this.columns = response.data;
           if(this.columns.length == 0){

          }else{
            this.addDatatoForm();
            this.getDataFromForeignKey();



          }

      })
      },

      editform(){
        this.errors = [];

          axios.get(route('editformcolumns'),{
            params: {
              pageurl: this.pageurl,
              model_name: this.modelname,
              ismainsidebar: this.ismainsidebar
            }
          }).then(response => {
              this.columns = response.data;
              if(this.columns.length == 0){

              }else{

                this.addDatatoEditForm();
                this.getDataFromForeignKey();

              }


          })

      },


      getDataFromForeignKey(){

          this.columns.forEach((val) => {
              if(val.is_foreignkey == 1){

                   if(this.selectedData[val.reference_table]){
                      this.form[val.column_name] = this.selectedData[val.reference_table]
                   }

                   if (val.is_fk_getreferenced == 1){
                      this.form[val.column_name] = this.datavaluesreferencedother[val.reference_table_column]
                   /*    console.log(val.column_name)
                      console.log(this.datavaluesreferencedother[val.reference_table_column]) */

                    }


                   if(val.where_column){
                   //if where column is not empty
                   if(val.formtypes.slug == 'dropdown'){
                      axios.get('/getDataFromForeignKey', {
                            params: {
                                modelname: val.reference_table,
                                wherecolumn: val.where_column,
                                formvalue:  val.where_column ? val.where_column.split('.').length > 1 ? this.form[val.where_column.split('.')[1]].id:this.form[val.where_column.split('.')[0]].id : '',
                                formtype: val.formtypes.slug
                              }
                        }).then(response => {
                            this.filteredData[val.reference_table] = response.data

                        })
                   }else if(val.formtypes.slug == 'input-text'){
                    axios.get('/getDataFromForeignKey', {
                            params: {
                                modelname: val.reference_table,
                                wherecolumn: val.where_column,
                                formvalue:  val.where_column_value,
                                formtype: val.formtypes.slug
                        }}).then(response => {

                            this.form[val.column_name] = response.data[val.reference_table_column]

                        })
                   }else{

                   }


                   }else{

                    axios.get(route('getDataFromReferenceTable'), {
                          params: {
                              modelname: val.reference_table,
                              referencetablecolumn: val.reference_table_column,
                              wherecolumn: val.where_column,
                              category: 'getdatadropdown'
                          }
                      }).then(response => {

                          this.filteredData[val.reference_table] = response.data

                      })

                   }





              }else if(val.is_foreignkey == 0 && val.reference_table){

                    if(this.selectedData[val.reference_table]){
                      this.form[val.column_name] = this.selectedData[val.reference_table]
                    }

                    var formvalues;
                    if(this.form[val.where_column_reference]){
                      formvalues = this.form[val.where_column_reference].id
                    }else{
                      formvalues = '';
                    }

                    axios.get(route('getDataFromReferenceTableWhereColumn'), {
                          params: {
                              modelname: val.reference_table,
                              wherecolumn: val.where_column,
                              formvalue: formvalues
                          }
                      }).then(response => {

                          this.filteredData[val.reference_table] = response.data

                          if(val.display_data_column){
                              if(this.form[val.column_name]){
                                this.form[val.display_data_column] = this.form[val.column_name][val.display_data_column];
                              }
                           }

                      })
                }else if (val.is_autogenerate == 1){

                      //get data from autogeneratecode that has been setup
                      if(this.editmode== false){
                        axios.get(route('autogeneratecodes.getAutoGenCodeBySystemTableDetails'), {
                        params: {
                          systemtabledetailid: val.id,


                        }
                      }).then(response => {

                        const regex = /[^{}]+(?=\s*(?:\{|$))/g;
                        const notmatch = response.data.match(regex);
                        const matches = response.data.match(/\{(.*?)\}/g)

                        if(matches){
                            const stringsInsideBraces = matches.map(match => match.slice(1, -1));

                            if(stringsInsideBraces.length > 0){
                              let concatenatedString = "";
                              stringsInsideBraces.forEach((val1, index) => {
                                  concatenatedString += this.form[val1.split('.')[0]][val1.split('.')[1]]
                              })

                              if(stringsInsideBraces.length > 0){
                                  if (concatenatedString =='') {
                                    this.form[val.column_name] = notmatch
                                  }else{
                                    this.form[val.column_name] =  concatenatedString + notmatch
                                  }
                              }else{
                                this.form[val.column_name] = response.data
                              }
                            }
                        }else{
                          this.form[val.column_name] = response.data
                        }


                        //this.form[val.column_name] = concatenatedString+notmatch
                      })
                      }



              }else{

                      if(val.column_name == 'reference_table_column' && this.datavalues['reference_table'] !== ''){
                          axios.get(route('getTableColumnsFinal'), {
                            params: {
                                modelname: this.datavalues['reference_table']
                            }
                          }).then(response => {
                          this.filteredData = response.data
                          })
                      }else{
                        this.filteredData = [];
                      }

              }


          })/* endforeach */

      },

      onFileDocumentChange(e) {
    const file = e.target.files[0];
    this.uploadFile(file);
},

      uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);
    var arr = [];

    axios.post('/file-upload', formData)
        .then(response => {
        //  this.form.file_path = response.data.file_path;
            this.file = response.data
            this.file_size = this.file['file_size'],
            this.file_type = this.file['file_type']

            // response.data.forEach((val) => {
            //     arr.push({
            //         file_path: val.file_path,
            //         file_size: val.file_size,
            //         file_type: val.file_type,
            //     });
            // });
            // this.file = arr;

            console.log(this.file_size)

        })
        .catch(error => {
            console.error('Error uploading file:', error);
        });
},


      onFileChange(e, columnname) {

        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;

       // this.form[columnname] = files[0];


        this.createImage(files[0], columnname);
      },

      createImage(file, columnname) {
        var image = new Image();
        var reader = new FileReader();
        var vm = this;

        reader.onload = (e) => {
          vm.image = e.target.result;
          this.imagedata[columnname] = e.target.result;
          this.form[columnname] = e.target.result;


        };


        reader.readAsDataURL(file);


      },

      notapplicableclick(fieldname){
            var formdata;

            if(this.notapplicablecheckbox[fieldname] === true){
                formdata = {
                    fieldname: fieldname,
                    value: 'N/A',
                    isdisabled: true
                }
            }else{

              if(this.editmode == true){
                formdata = {
                    fieldname: fieldname,
                    value: this.datavalues[fieldname],
                    isdisabled: false
                }
              }else{
                formdata = {
                    fieldname: fieldname,
                    value: '',
                    isdisabled: false
                }
              }

            }



            this.emitter.emit('getformdata', formdata)
        },


      addDatatoForm(){
        if(this.editmode == false){
       this.columns.forEach((val, key)=>{


          if(val.column_type == 'boolean' || val.column_type == 'smallint'){
              this.form[val.column_name] = false;
          }/* else if (val.is_foreignkey == 1 && val.is_fk_getreferenced == 1){
             this.form[val.column_name] = this.$page.url.split('/')[3]
            // get data from foreignkey linking to saved data from other table. e.g. employees

          } */else if (val.is_autogenerate == 1){

            //get data from autogeneratecode that has been setup
            axios.get(route('autogeneratecodes.getAutoGenCodeBySystemTableDetails'), {
              params: {
                systemtabledetailid: val.id,


              }
            }).then(response => {
                  const regex = /[^{}]+(?=\s*(?:\{|$))/g;
                  const notmatch = response.data.match(regex);
                  const matches = response.data.match(/\{(.*?)\}/g)
                  if(matches){
                      const stringsInsideBraces = matches.map(match => match.slice(1, -1));

                      if(stringsInsideBraces.length > 0){
                        let concatenatedString = "";
                        stringsInsideBraces.forEach((val1, index) => {
                            concatenatedString += this.form[val1.split('.')[0]][val1.split('.')[1]]
                        })

                        if(stringsInsideBraces.length > 0){
                            if (concatenatedString == '') {
                              this.form[val.column_name] = notmatch
                            }else{
                              this.form[val.column_name] =  concatenatedString + notmatch
                            }
                        }else{
                          this.form[val.column_name] = response.data
                        }
                      }
                  }

                  this.form[val.column_name] = response.data

            })


          }else{

              this.form[val.column_name] = '';
          }
        })
      }

      },




      addDatatoEditForm(){

 if(this.editmode == true){


   this.filteredData = [];

       this.formid = this.datavalues.id;



      // console.log(this.columns)
       this.columns.forEach((val, key)=>{
         this.selectedData[val.reference_table] = '';
         //boolean = for mysql | smallint = for mssql
           if(val.column_type == 'boolean' || val.column_type == 'smallint'){
            console.log('boolean')
               if(this.datavalues[val.column_name] == 0){
                     this.form[val.column_name] =false;
               }else{
                     this.form[val.column_name] = true;
               }

           }

           else if(val.is_foreignkey == 1){


            console.log('foreignkey')
               var pluralizereferencecolumn = Pluralize(val.reference_table.toLowerCase())

               this.selectedData[val.reference_table] = this.datavalues[pluralizereferencecolumn]



           }else if(val.reference_table){
             //this is for getting the data not a foreign key but referenced to other table.
             //show data in edit
             console.log('referencetable')
              axios.get(route('getDataFromReferenceTable'), {
               params:{
                 modelname: val.reference_table,
                 referencetablecolumn: val.reference_table_column,
                 datavalue: this.datavalues[val.column_name],
                 category:'getdataforedit'

               }
              }).then(response => {

               this.selectedData[val.reference_table] = response.data

               this.form[val.column_name] = this.selectedData[val.reference_table]

               var formvalues;
                 if(this.form[val.where_column_reference]){
                   formvalues = this.form[val.where_column_reference].id
                 }else{
                   formvalues = '';
                 }

                 axios.get(route('getDataFromReferenceTableWhereColumn'), {
                           params: {
                               modelname: val.reference_table,
                               wherecolumn: val.where_column,
                               formvalue: formvalues
                           }
                       }).then(response => {

                           this.filteredData[val.reference_table] = response.data


                       })

              })





           }else if(val.formtypes.slug == 'file-photo') {
             this.imagedata[val.column_name] =this.datavalues[val.column_name]
           }else if(val.formtypes.slug == 'signature') {
             this.imagedata[val.column_name] =this.datavalues[val.column_name]


           }else if(val.formtypes.slug == 'input-text-with-na') {
            if(this.datavalues[val.column_name] == 'N/A'){
              this.notapplicablecheckbox[val.column_name] == true
            }else{
              this.form[val.column_name] = this.datavalues[val.column_name]
              this.notapplicablecheckbox[val.column_name] == false
            }


           }else{

            console.log('else')
             if(this.datavalues['reference_table'] !== '' && val.column_name == 'reference_table_column'){

               this.form[val.column_name] = this.datavalues['reference_table_column'];


             }


             this.form[val.column_name] = this.datavalues[val.column_name];
           }



         })
 }



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
      },

      presubmitform(){
        let self = this;

            this.columns.forEach((val) => {

              if(val.is_foreignkey == 1 && val.is_form_hidden==0){

                if(this.selectedData[val.reference_table]){
                  this.form[val.column_name] = this.selectedData[val.reference_table]
                }



              }else if((val.reference_table !== '' && val.reference_table !== null) && val.is_foreignkey == 0){
                console.log(val.reference_table)
                if(this.selectedData[val.reference_table]){
                  this.form[val.column_name] = this.selectedData[val.reference_table][val.reference_table_column]
                }
              }

              else if(val.formtypes.slug == 'price'){
                if( this.form[val.column_name]){
                  this.form[val.column_name] = this.form[val.column_name].replaceAll(',','');
                }


              }


            });
      },

      submitform(){

          this.presubmitform();
          this.submitpost();


       },

      submitpost(){


          axios.post(route(this.routename+'.store'), {

            formdata: this.form,
            fileInfo: this.file,
            Divisions: this.selectedDivisions,
            Departments: this.selectedDepartments,
            SubDepartments: this.selectedSubDepartments,
            SubDepartmentUnits: this.selectedSubDepartmentUnits,
            }).then(response => {
              console.log(this.form);
              console.log(response.data)
                if(response.data == 'success'){


                      if(this.ismainsidebar == false){
                        this.emitter.emit('alertType', 'success')
                        this.emitter.emit('alertText', 'Successfully saved')
                        this.emitter.emit('showAlert', true)
                        this.emitter.emit('disablemodule', false)
                        this.emitter.emit('openFormModal', false)
                        this.emitter.emit('refreshData-'+this.modelname)
                      }else{
                        this.emitter.emit('openFormModal', false)
                        this.emitter.emit('opennotification', true)
                        this.emitter.emit('refreshData-'+this.$page.url.replace('/',''))
                      }

                }
            }).catch(err => {
              console.log(err.response.data.errors)
              if(err.response.status == 422){
                   this.errors = err.response.data.errors

              }

            });
        },

        openSignaturePad(columnname){
          this.signaturepadcolumnname = columnname;
          this.emitter.emit('openSignaturePad', true)

        },

        updateform(){

          this.presubmitform();


              axios.patch(route(this.routename+'.update', this.formid), {formdata: this.form}).then(response => {
                console.log(response.data)
                if(response.data == 'success'){
                if(this.ismainsidebar == false){
                        this.emitter.emit('alertType', 'success')
                        this.emitter.emit('alertText', 'Successfully updated')
                        this.emitter.emit('showAlert', true)
                        this.emitter.emit('disablemodule', false)
                        this.emitter.emit('openFormModal', false)
                        this.emitter.emit('refreshData-'+this.modelname)

                }else{
                  this.emitter.emit('openFormModal', false)
                  this.emitter.emit('opennotification', true)
                  this.emitter.emit('refreshData-'+this.$page.url.replace('/',''))
                }
              }

              });
          },

  },

  created(){
    this.getData();
    this.emitter.on('getformdata', (formdata)=>{

        this.form[formdata.fieldname] = formdata.value

      for(var i = 0; i < this.columns.length; i++) {
          if (this.columns[i].column_name == formdata.fieldname) {
             this.columns[i].is_disabled= formdata.isdisabled
              break;
          }
      }


    });
    this.getDivsAndDepts();

    this.emitter.on('getSignature', (evt) => {
          console.log(this.signaturepadcolumnname)
          this.imagedata[this.signaturepadcolumnname] = evt;
          this.form[this.signaturepadcolumnname] = evt;

    })
  },

  computed: {
    // selectedDivisionIds() {
    //     return this.selectedDivisions.map(div => div.division_id);
    // },

    // selectedDepartmentIds() {
    //     return this.selectedDepartments.map(div => div.id);
    // },

    // selectedSubDepartmentIds() {
    //     return this.selectedSubDepartments.map(div => div.id);
    // },

    // selectedSubDepartmentUnitIds() {
    //     return this.selectedSubDepartmentUnits.map(div => div.id);
    // },

    filteredDepartments() {
      return this.departments.filter(dept => this.selectedDivisions.some(div => div.division_id === dept.division_id));
    },

    filteredSubDepartments() {
      return this.subDepartments.filter(subDept => this.selectedDepartments.some(dept => dept.department_id === subDept.department_id));
    },

    filteredSubDepartmentUnit() {
      return this.subDepartmentUnits.filter(subDeptUnit => this.selectedSubDepartments.some(subDept => subDept.sub_department_id === subDeptUnit.sub_department_id));
    },


     filterComboBoxSearch(){
      return (searchQuery, referencetable, referencetablecolumn, columnname) => {
        if (!searchQuery) {

          return this.filteredData[referencetable]; // If no search query, return all items
         // return this.filteredData[referencetable].filter(item => item[referencetablecolumn].toLowerCase().includes(query));
        }

        const query = searchQuery.toLowerCase();


        return this.filteredData[referencetable].filter(item => item[referencetablecolumn].toLowerCase().includes(query));
      };




   }
  }
}
</script>


