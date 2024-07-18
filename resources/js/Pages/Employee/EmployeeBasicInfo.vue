<template>
<AlertNotification></AlertNotification>
<FormsV2 title="PERSONAL INFORMATION" routename="employees" modelname="Employee" :ismainsidebar="false" :datavalues="datavalues" :editmode="editmode" pageurl="/employees">
</FormsV2>



</template>

<script setup>
import AlertNotification from '@/Pages/Templates/AlertNotification.vue';
import FormsV2 from '@/Pages/Templates/FormsV2.vue';

</script>


<script>

export default {
    name: 'EmployeeBasicInfo',
    props: ['editmode', 'datavalues'],
    

    data(){
        return {
                 
        }
    },


    methods: {

       
       
      
      
    },

    created(){
  
    },

    activated() {

        console.log('activated')
        
    },
    deactivated() {
    
        console.log('deactivated')
    },
}

</script>
