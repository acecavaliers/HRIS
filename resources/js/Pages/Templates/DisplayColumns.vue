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
                        <DialogTitle class="text-lg font-medium text-gray-900">Columns</DialogTitle>
                        <div class="ml-3 flex h-7 items-center">
                          <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="open = false">
                            <span class="sr-only">Close panel</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">

                     <fieldset class="space-y-5">
                          <legend class="sr-only">Columns</legend>

                          <div class="relative flex items-start" v-for="column in columnfilterhidden" :key="column.id">
                          <!--   <span v-if="column.hide_column == 0"> -->
                              <div class="flex h-5 items-center">
                                <input v-model="filteredcolumns" :value="column" :id="column.column_name" :aria-describedby="column.column_name+'-description'" :name="column.column_name" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                              </div>
                              <div class="ml-3 text-sm">
                                  <label for="comments" class="font-medium text-gray-700">{{column.column_label}}</label>
                              <!--   <p id="comments-description" class="text-gray-500">Get notified when someones posts a comment on a posting.</p> -->
                              </div>
                         <!--    </span> -->
                          </div>



                      </fieldset>

                    </div>
                    <div class="flex flex-shrink-0 justify-end px-4 py-4">
                      <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="open = false">Cancel</button>
                      <button @click="columnfiltersubmit()" type="submit" class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Filter Column</button>
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
  import { ref } from 'vue'
  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
  import { XMarkIcon } from '@heroicons/vue/24/outline'
  import axios from 'axios';

</script>
<script>
  export default {
      props: ['columns'],

       data(){
          return {
              open: false,
              filteredcolumns: [],


          }
      },

      methods: {
        updateEnableDisplayColumnForDefault(){
            axios.patch('/updateEnableDisplayColumnForDefault').then(response => {});
        },
        updateEnableDisplayColumn(filteredcolumns){

            axios.patch('/updateEnableDisplayColumn', { filtereddatacolumns: filteredcolumns }).then(response => {


            })
        },



          columnfiltersubmit(){

                this.updateEnableDisplayColumn(this.filteredcolumns)
                this.emitter.emit('filtercolumn', this.filteredcolumns)

                this.open =false;

               /*  this.filteredcolumns = this.columns.filter(column => column.enable_display_column == 1)
                this.emitter.emit('filtercolumn', this.filteredcolumns)
            } */
        }
      },

      created(){

        this.updateEnableDisplayColumnForDefault();

           this.emitter.on('openColumns', (evt) => {
           
              this.filteredcolumns = evt;
              console.log(this.filteredcolumns)
              this.open = true;


          })
      },

      beforeDestroy() {

      },

      computed: {
          columnfilterhidden() {
           
            let tempColumns = this.columns
    
            tempColumns = tempColumns.filter((item) => {
              return (item.hide_column == 0)
            })
            
            return tempColumns;
          }
      }
  }
</script>
