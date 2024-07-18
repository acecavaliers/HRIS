<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <div class="fixed inset-0" />

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">

                  <div class="px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                      <DialogTitle class="text-lg font-medium text-gray-900">Search {{ searchformtitle }}</DialogTitle>
                      <div class="ml-3 flex h-7 items-center">
                        <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="open = false">
                          <span class="sr-only">Close panel</span>
                          <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    <!-- Replace with your content -->

                        <form class="space-y-8 divide-y divide-gray-200">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div class="space-y-6 sm:space-y-5">
    <!--     <div>
          <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
        </div> -->

        <div class="space-y-6 sm:space-y-5">
      
 
          <span v-for="column in columns" :key="column.id">

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-text'">
                <label :for="column.column_label" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }}</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                        <input type="text" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :autocomplete="column.column_name" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>
            </div>

             <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-number'">
                <label :for="column.column_label" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }}</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                        <input type="number" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :autocomplete="column.column_name" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>
            </div>

             <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'input-date'">
                  <label :for="column.column_label" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }}</label>

                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg rounded-md shadow-sm">
                        <input type="date" v-model="form[column.column_name]" :name="column.column_name" :id="column.column_name" :autocomplete="column.column_name" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>
            </div>

             <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5" v-if="column.formtypes.slug == 'switch'">
                 <label :for="column.column_label" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">{{ column.column_label }}</label>
                 <Switch v-model="form[column.column_name]" :class="[form[column.column_name] ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']">
                    <span class="sr-only">Use setting</span>
                    <span aria-hidden="true" :class="[form[column.column_name] ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                 </Switch>
                   <span v-if="column.column_name == 'is_active'">
                     <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                        <input v-model="is_active_all" id="is_active_all" aria-describedby="'is_active_all-description'" name="is_active_all" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    </div>
                    <div class="ml-3 text-sm">
                        <label :for="form[column.column_name]" class="font-medium text-gray-700">All</label>
                        <span :id="form[column.column_name]+'-description'" class="text-gray-500"><span class="sr-only">All</span></span>
                    </div>
                    </div>
                </span>
            </div>

           
            <!-- COMBOBOX (FOR DROPDOWNS) -->

         </span>

        


        </div>
      </div>



    </div>

  <!--   <div class="pt-5">
      <div class="flex justify-end">
        <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
        <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
      </div>
    </div> -->
                      </form>

                    <!-- /End replace -->
                  </div>
                   <div class="flex flex-shrink-0 justify-end px-4 py-4">
                    <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="open = false">Cancel</button>
                    <button @click="searchData()" type="submit" class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Search</button>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { computed, ref } from 'vue'
import { Switch, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

</script>



<script>
export default {
    props: ['routename', 'searchformtitle'],
   /*  props: ['columns'], */
    data(){
        return {
            open: false,
            form: {},
            is_active_all: false,
            columns: [],
            pageurl: '',
            model_name: '',
            ismainsidebar: false,
            selectedData: [],
            
        }
    },

    methods: {
      searchform(){
       
          axios.get(route('searchformcolumns'), {
            params: {
              pageurl: this.pageurl,
              model_name: this.model_name,
              ismainsidebar: this.ismainsidebar
             
            }
          }).then(response => {
              this.columns = response.data;
              console.log(response.data)
          
              this.addDatatoForm();
              this.getdatafromforeignkey();

          })
      },

        addDatatoForm(){
         this.columns.forEach((val, key)=>{
            if(val.column_type == 'boolean' || val.column_type=='smallint'){
                this.form[val.column_name] = false;
            }else{
                this.form[val.column_name] = '';
            }
          })
          
        },


        searchData(){
             
            axios.get(route(this.routename), {
                params: {
                    searchdata: this.form,
                    is_active_all: this.is_active_all
                }
            }).then(response => {
              console.log(response.data)
                this.emitter.emit('searchDataFilter', response.data);
             
            })

        }
    },
    mounted(){
    
    },

    created(){

         this.emitter.on('openSearch', (evt) => {
            this.pageurl = evt.pageurl
            this.model_name = evt.model_name
          this.ismainsidebar = evt.ismainsidebar
            this.searchform();
          
            this.open = true;

            console.log('OPEN SEARCH: ' + evt.pageurl)
        })
    }
}
</script>

