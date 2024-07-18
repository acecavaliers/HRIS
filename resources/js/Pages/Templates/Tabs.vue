<template>
    <div>
      <div class="sm:hidden">
        <label for="myAccountTabs" class="sr-only">Select a tab</label>
        <select id="myAccountTabs" name="myAccountTabs" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" v-model="selectedTab" @change="handleChange">
          <option v-for="(tab, index) in tabs" :key="index" :value="index">{{ tab.name }}</option>
        </select>
      </div>
      <div class="hidden sm:block">
        <div class="border-b border-gray-200 overflow-x-auto px-4">
          <nav class="flex space-x-8 width sm:max-w-7xl" aria-label="My Account Tabs">
            <!-- Adjust the width as needed -->
            <a @click="handleTabClick(tab)" v-for="(tab, index) in tabs" :key="index" :href="tab.href" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined" style="display: inline-block;">{{ tab.name }}</a>
          </nav>
        </div>
      </div>
    </div>

    <slot name="tabcontent"></slot>
  
   
   
  

</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>

<script>
  export default {
    props: ['tabs'],
    data() {
      return {

        selectedTab: 0,
        
      };
    },
    methods: {
      handleChange() {

      /*  this.tabs.map(t => {
        t.name === this.selectedTab.name ? t.current = true : t.current = false
      }); */
        this.tabs.forEach((tab, index) => {
          tab.current = tab === this.selectedTab;
         
        });
      },
      handleTabClick(tab) {
        this.selectedTab = tab;
      
      
        this.handleChange();
        this.emitter.emit('selectedTab', this.selectedTab)
        
      },
    },

    computed: {
      
    }


  };
</script>
