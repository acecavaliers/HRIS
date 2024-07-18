<script setup>
import EmployeeMain from '@/Pages/Employee/View/EmployeeMain.vue';
</script>

<template>
    <div v-if="pageurl == '/employees'">
        <EmployeeMain :datacontent="datacontent"></EmployeeMain>

    </div>
    
</template>

<script>
export default {
    props: ['pageurl', 'datacontent'],
    data(){
        return {
          

        }
    },

    created(){

    }
}


</script>
