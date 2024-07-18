<template>
  <FormsV2 title="USER ACCOUNT" routename="users" modelname="User" :ismainsidebar="false" :datavalues="datavalues" :editmode="editmode" pageurl="/users"></FormsV2>


</template>


<script setup>
import FormsV2 from '@/Pages/Templates/FormsV2.vue';

</script>

<script>
export default {
    name: 'EmployeeUserAccount',
    props: ['editmode', 'datavalues'],
}


</script>