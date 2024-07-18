<template>

    <div>
      <div class="px-4 sm:px-0">
        <h3 class="mt-6 text-base font-semibold leading-7 text-gray-900">Employee Information</h3>
      </div>
      <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div  class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">First Name</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.first_name }}</dd>
          <!--   <div v-if="index !== events.length - 1" class="border-t border-gray-200 mt-4 w-full"></div> -->
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Middle name</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.middle_name }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Last name</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.last_name }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Suffix</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.suffix }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.gender }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Civil status</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.civil_status }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Birth date</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.birth_date }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Nationality</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.nationality }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Religion</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.religion }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Contant landline #</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.contactinfo_landlineno }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Contant #</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.contactinfo_mobileno }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present street</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_street }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present subdivision</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_bldgsubd }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present region</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_region }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present province</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_province }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present city</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_city }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present baranggay</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_barangay }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present zipcode</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_zipcode}}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Present country</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.present_country }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent street</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_street }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent subdivision</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_bldgsubd }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent region</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_region }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent province</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_province }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent city</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_city }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent baranggay</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_barangay }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent zipcode</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_zipcode }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Permanent country</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.permanent_country }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.email_address }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Blood type</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ employees.blood_type }}</dd>
          </div>
        </dl>
      </div>
    </div>

</template>


  <script setup>
    import axios from 'axios';

  </script>

  <script>
        export default {
            props: ['datacontent'],
            data(){
                return {
                    employees: {},


                }
            },
            methods: {
                getData(){


                    axios.get(route('employees.show',this.datacontent.id)).then(response=>{
                            this.employees = response.data
                         });
                }
            },
            created(){


                this.getData();



            }
        }
  </script>
