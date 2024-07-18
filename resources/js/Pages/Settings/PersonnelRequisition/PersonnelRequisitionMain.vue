<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { shallowRef,  ref, computed, markRaw } from 'vue'
import Tabs from '@/Pages/Templates/Tabs.vue';
import {defineAsyncComponent} from "vue";

import GeneralSettings from '@/Pages/Settings/PersonnelRequisition/PersonnelRequisitionGeneralSettings.vue'
import ReasonForRequisition from '@/Pages/Settings/PersonnelRequisition/ReasonForRequisition.vue'
import ApproverSettings from '@/Pages/Settings/PersonnelRequisition/PersonnelRequisitionApproverSettings.vue'
</script>

<template>
    <Head title="Personnel Requisition Settings" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Personnel Requisition Settings</h2>
        </template>

        <Tabs :tabs="tabs">
        
        <template #tabcontent>
                <component :is="systemtablecomponent"/>
        </template>
        
        </Tabs>
       

    </MasterLayout>

</template>

<script>
export default {
    
    data(){
        return {
            
            componentname: '',
     
            tabs: [
                { name: 'General Settings', href: '#', current: true, component_name: GeneralSettings},
                { name: 'Reason for Requisition', href: '#', current: false, component_name: ReasonForRequisition},
                { name: 'Approver Settings', href: '#', current: false, component_name: ApproverSettings},
             /*    { name: 'Approvers', href: '#', current: false, component_name: this.generalsettingsmodule}, */
                
               
              
            ],
        }
    },

    methods: {
        
    },

    computed: {
        systemtablecomponent() {
        if (this.componentname == 'General Settings') return GeneralSettings;
        else if (this.componentname == 'Reason for Requisition')  return ReasonForRequisition;
        else if (this.componentname == 'Approver Settings')  return ApproverSettings;
        else return GeneralSettings;

        }
    },

    created(){
        this.emitter.on('selectedTab', (evt)=>{
            this.componentname = evt.name
        })
    },

    activated() {
       
       console.log('activated')
   },
   deactivated() {
     
       console.log('deactivated')
   },
}


</script>