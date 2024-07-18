<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import GeneralSettings from '@/Pages/Settings/SystemSettings/GeneralSettings.vue';
import ThemeSettings from '@/Pages/Settings/SystemSettings/ThemeSettings.vue';
</script>

<template>
    <Head title="System Settings" />

    <MasterLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">System Settings</h2>
        </template>
        <br>
        <div>
          
            <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
            </select>
            </div>
            <div class="hidden sm:block">
                <nav class="flex space-x-4" aria-label="Tabs">
                    <a @click="selectTab(tab)" v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:text-gray-700', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</a>
                    
                </nav>

                <div>
                   
                    <component :is="systemtablecomponent"></component>
                </div>
            </div>
        </div>

      
     


    </MasterLayout>

</template>

<script>
export default {
    data() {
        return { 
            tabs: [
                { name: 'General', href: '#general-settings', current: true, componentname: 'GeneralSettings' },
                { name: 'Theme', href: '#theme-settings', current: false, componentname: 'ThemeSettings' },
            ],
            componentname: 'GeneralSettings',
        };
    },
   
    methods: {
        selectTab(selectedTab) {
            console.log(selectedTab)
            this.componentname = selectedTab.componentname
            this.tabs.forEach(tab => {
                tab.current = (tab.href == selectedTab.href);
            });
        }
    },

    computed: {
        systemtablecomponent() {
        if (this.componentname == 'GeneralSettings') return GeneralSettings;
        else if (this.componentname == 'ThemeSettings')  return ThemeSettings;
       
        else return GeneralSettings;
      
        }
    }
}


</script>





