<template>
    <TransitionRoot as="template" :show="openFormModal">
    <Dialog as="div" class="relative z-10" @close="openFormModal = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

        <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6">
          
            <FormsV2 :title="title" :routename="routename" :modelname="modelname" :ismainsidebar="ismainsidebar" :datavalues="datavalues" :editmode="editmode" :pageurl="pageurl" :datavaluesreferencedother="datavaluesreferencedother"></FormsV2>
          
          </DialogPanel>
        </TransitionChild>
        </div>
      </div>
    </Dialog>
</TransitionRoot>
</template>


<script setup>
import FormsV2 from '@/Pages/Templates/FormsV2.vue';
import { Head,Link } from '@inertiajs/vue3';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

</script>

<script>
export default {

  props: ['title', 'routename', 'modelname', 'ismainsidebar', 'datavalues', 'editmode', 'pageurl', 'datavaluesreferencedother'],

  data(){
      return{
       
      openFormModal: false
      
        
      }
  },


  methods:{

    
  },


  created(){
    this.emitter.on('openFormModal', (evt) => {
      this.openFormModal = evt
    })
  }
}
</script>
