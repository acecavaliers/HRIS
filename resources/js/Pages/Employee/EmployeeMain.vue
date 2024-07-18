<template>
   <Head title="Employees" />
    <MasterLayout>
       <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ managevalue.toUpperCase() }} EMPLOYEE</h2>

          </template>

            <Breadcrumbs :pages="breadcrumbspages"></Breadcrumbs>
                        <div class="grid grid-cols-[20%_75%] grid-flow-col gap-4">
                            <div class="bg-gray-200 p-2 h-full">

                                <nav class="flex flex-1 flex-col" aria-label="Sidebar">
                                  <ul role="list" class="-mx-2 space-y-1">
                                  <li v-for="(item, index) in navigation" :key="item.name">
                                      <button :disabled="item.disablemodule" @click="buttonClicked(item, index)" :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', item.disablemodule==true? 'text-slate-400':'', 'w-full group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold']">{{ item.name }}</button>
                                  </li>
                                  </ul>
                                </nav>
                            </div>

                            <div class="p-4">

                              <KeepAlive :exclude="['EmployeeDependent','EmployeeEducation','EmployeeEmploymentHistory','EmployeeEmploymentDetail','EmployeeFamilyBackground','EmployeeDisciplinaryAction','EmployeeWorkAssignment','EmployeeIdentification','EmployeeMedicalRecords','EmployeeUserAccount']">
                                <component :is="navigation[indexedclick].component_name" :editmode="editmode" :datavalues="empdata[0]"/>
                              </KeepAlive>
                             
                            </div>
                        </div>


</MasterLayout>
</template>

<script setup>

import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import { Switch, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import EmployeeBasicInfo from '@/Pages/Employee/EmployeeBasicInfo.vue'
import EmployeeEducation from '@/Pages/Employee/EmployeeEducation.vue'
import EmployeeEmploymentDetail from '@/Pages/Employee/EmployeeEmploymentDetail.vue'
import EmployeeEmploymentHistory from '@/Pages/Employee/EmployeeEmploymentHistory.vue'
import EmployeeFamilyBackground from '@/Pages/Employee/EmployeeFamilyBackground.vue'
import EmployeeDisciplinaryAction from '@/Pages/Employee/EmployeeDisciplinaryAction.vue'
import EmployeeWorkAssignment from '@/Pages/Employee/EmployeeWorkAssignment.vue'
import EmployeeIdentification from '@/Pages/Employee/EmployeeIdentification.vue'
import EmployeeDependent from '@/Pages/Employee/EmployeeDependent.vue'
import EmployeeMedicalRecords from '@/Pages/Employee/EmployeeMedicalRecords.vue'
import EmployeeUserAccount from '@/Pages/Employee/EmployeeUserAccount.vue'
import Breadcrumbs from '@/Pages/Templates/Breadcrumbs.vue';


</script>

<script>
export default {
    props: ['managevalue', 'empdata'],
    data(){
        return {
           
            open: false,
            addoredittitle: '',
            componentname: 'EmployeeBasicInfo',
            indexedclick: 0,
            editmode: false,
            navigation: [{ name: 'PERSONAL INFORMATION', href: '/employees', current: true, component_name: EmployeeBasicInfo, model_name: 'Employee', disablemodule: false},
                    { name: 'DEPENDENTS', href: '/employeedependent', current: false, component_name: EmployeeDependent, model_name: 'EmployeeDependent', disablemodule: true},
                    { name: 'EDUCATIONAL BACKGROUND', href: '/employeeeducation', current: false, component_name: EmployeeEducation, model_name: 'EmployeeEducation', disablemodule: true},
                    { name: 'EMPLOYMENT HISTORY', href: '/employeehistory', current: false, component_name: EmployeeEmploymentHistory, model_name: 'EmployeeEmploymentHistory', disablemodule: true},
                    { name: 'EMPLOYMENT DETAILS', href: '/employeedetail', current: false, component_name: EmployeeEmploymentDetail, model_name: 'EmployeeEmploymentDetail', disablemodule: true},
                    { name: 'FAMILY BACKGROUND', href: '/employeebackground', current: false, component_name: EmployeeFamilyBackground, model_name: 'EmployeeFamilyBackground', disablemodule: true},
                    { name: 'DISCIPLINARY ACTIONS', href: '/employeedisciplinaryaction', current: false, component_name: EmployeeDisciplinaryAction, model_name: 'EmployeeDisciplinaryAction', disablemodule: true},
                    { name: 'WORK ASSIGNMENTS', href: '/employeeworkassignment', current: false, component_name: EmployeeWorkAssignment, model_name: 'EmployeeWorkAssignment', disablemodule: true},
                    { name: 'IDENTIFICATIONS', href: '/employeeidentification', current: false, component_name: EmployeeIdentification, model_name: 'EmployeeIdentification', disablemodule: true},
                    { name: 'MEDICAL RECORDS', href: '/employeemedicalrecords', current: false, component_name: EmployeeMedicalRecords, model_name: 'MedicalRecords', disablemodule: true},
                    { name: 'USER ACCOUNT', href: '/employeeuseraccount', current: false, component_name: EmployeeUserAccount, model_name: 'User', disablemodule: true},
                    ],
            breadcrumbspages: [
                { name: 'EMPLOYEES', href: route('employees.index'), current: false },
                
            ],


        }
    },

    methods: {
      onload(){
        this.breadcrumbspages.push({ 
            name: 'PERSONAL INFORMATION',
            href: '',
            current: true   
          })
        if(this.managevalue == 'edit'){
          this.editmode = true;
          this.navigation.forEach((val) => {
          val.disablemodule= false


        })
        }else{
          this.editmode = false;
        }
      },

       buttonClicked(item, index){
       // this.selectedtab = item.name
        //console.log(this.navigation[index].current)
        this.navigation.forEach((val) => {
          val.current= false

        })
        this.navigation[index].current = true

        this.componentname = item.component_name
        this.indexedclick = index;

        if(this.breadcrumbspages.length == 1){
          this.breadcrumbspages.push({ 
            name: item.name,
            href: '',
            current: true   
          })
        }else{
          this.breadcrumbspages.pop();
          this.breadcrumbspages.push({ 
            name: item.name,
            href: '',
            current: true   
          })
        }
         

        this.emitter.emit('pageurlnotmainsidebar', item)
       /*  this.getData(); */
       },

      /*  getData(){
        var mydata;
        if(this.managevalue == 'add'){
           mydata = {
            editmode: false,
            datavalues: []
          }
        }else{
           mydata = {
            editmode: true,
            datavalues: this.empdata[0]
          }
        }

        this.emitter.emit('employeeeditmode', mydata)
       } */
    },
    created(){
      this.onload();
     // this.getData();
     this.emitter.on('disablemodule', (evt) => {
      this.navigation.forEach((val) => {
          val.disablemodule= evt

        })
     })

    },

    computed: {
      /*   systemtablecomponent() {
        if (this.componentname == 'EmployeeBasicInfo') return EmployeeBasicInfo;
        else if (this.componentname == 'EmployeeEducation')  return EmployeeEducation;
        else if (this.componentname == 'EmployeeEducation')  return EmployeeEducation;
        else if (this.componentname == 'EmployeeEducation')  return EmployeeEducation;

        else return EmployeeBasicInfo;

        } */
    }

}



</script>
