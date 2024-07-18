

<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Tabs from '@/Pages/Templates/Tabs.vue';
import EmployeePersonalInfo from '@/Pages/Employee/EmployeePersonalInfo.vue';
import EmployeeDependent from '@/Pages/Employee/EmployeeDependent.vue';
import EmployeeFamilyBackground from '@/Pages/Employee/EmployeeFamilyBackground.vue';
import EmployeeEducation from '@/Pages/Employee/EmployeeEducation.vue';
import EmployeeEmploymentDetail from '@/Pages/Employee/EmployeeEmploymentDetail.vue';
import EmployeeWorkAssignment from '@/Pages/Employee/EmployeeWorkAssignment.vue';
import EmployeeEmploymentHistory from '@/Pages/Employee/EmployeeEmploymentHistory.vue';
import EmployeeIdentification from '@/Pages/Employee/EmployeeIdentification.vue';
import EmployeeDisciplinaryAction from '@/Pages/Employee/EmployeeDisciplinaryAction.vue';

import ViewFormModal from '@/Pages/Templates/ViewFormModal.vue';


</script>

<template>

        <Tabs :tabs="tabs">
            <template #tabcontent>
                <span v-for="(tab, index) in tabs" :key="index" v-show="tab.current">
                    <div v-if="tab.name === 'Employee Personal Info'">
                        <EmployeePersonalInfo :datacontent="datacontent"></EmployeePersonalInfo>
                    </div>
                    <div v-else-if="tab.name === 'Employee Dependent'">
                        <EmployeeDependent></EmployeeDependent>
                    </div>
                    <div v-else-if="tab.name === 'Employee Family Background'">
                        <EmployeeFamilyBackground></EmployeeFamilyBackground>
                    </div>
                    <div v-else-if="tab.name === 'Employee Education'">
                     <EmployeeEducation></EmployeeEducation>
                    </div>
                    <div v-else-if="tab.name === 'Employee Employment Detail'">
                     <EmployeeEmploymentDetail></EmployeeEmploymentDetail>
                    </div>
                    <div v-else-if="tab.name === 'Employee Work Assignment'">
                     <EmployeeWorkAssignment></EmployeeWorkAssignment>
                    </div>
                    <div v-else-if="tab.name === 'Employee Employment History'">
                     <EmployeeEmploymentHistory></EmployeeEmploymentHistory>
                    </div>
                    <div v-else-if="tab.name === 'Employee Identification'">
                     <EmployeeIdentification></EmployeeIdentification>
                    </div>
                    <div v-else-if="tab.name === 'Employee Disciplinary Action'">
                     <EmployeeDisciplinaryAction></EmployeeDisciplinaryAction>
                    </div>
                </span>
            </template>
        </Tabs>


</template>

<script>
export default {
    name: 'EmployeeMain',
    props: ['datacontent'],
    data(){
        return {
            tabs: [
                { name: 'Employee Personal Info', href: '#', current: true },
                { name: 'Employee Dependent', href: '#', current: false },
                { name: 'Employee Family Background', href: '#', current: false },
                { name: 'Employee Education', href: '#', current: false },
                { name: 'Employee Employment Detail', href: '#', current: false },
                { name: 'Employee Work Assignment', href: '#', current: false },
                { name: 'Employee Employment History', href: '#', current: false },
                { name: 'Employee Identification', href: '#', current: false },
                { name: 'Employee Disciplinary Action', href: '#', current: false },
            ],

        }
    },

    created(){

    }
}


</script>
