<template>
    <TransitionRoot as="template" :show="openmodal">
    <Dialog as="div" class="relative z-10" @close="openmodal=[() => null]">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>


    <form class="space-y-8 divide-y divide-gray-200">
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-full sm:p-6">
             
              <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="openmodal = false">
                  <span class="sr-only">Close</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </button>
              </div>
             
              <div>
                <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                  <h3 class="text-base font-semibold leading-6 text-gray-900">Update Columns</h3>
                </div>
               <!-- BODY -->
                <slot />


            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <slot name="submitbutton"/>
            
              <button @click="cancelmodal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm" ref="cancelButtonRef">Cancel</button>
            </div>

            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
      </form>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>

import { Head,Link } from '@inertiajs/vue3';
import { Switch, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'
import { computed, ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import { Combobox,ComboboxButton,ComboboxInput,ComboboxLabel,ComboboxOption,ComboboxOptions,} from '@headlessui/vue'
import { ExclamationTriangleIcon, XMarkIcon } from '@heroicons/vue/24/outline'
</script>

<script>
export default {


    props: ['modalTitle', 'modalDescription'],

    data(){
        return{
            openmodal: false
        }
    },

    methods:{
      updateform(){

      },

      cancelmodal(){
        this.openmodal = false;
      }
    },    

    created(){
        this.emitter.on('openCustomModalwithBody', (evt) => {
            this.openmodal = evt
        })
    }


}

</script>