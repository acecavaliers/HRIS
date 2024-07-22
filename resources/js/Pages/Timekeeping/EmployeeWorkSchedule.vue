<template>
    <Head title="Employees" />
     <MasterLayout>
        <template #header>
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">EMPLOYEE WORKSHIFT</h2>
        </template>
        <Breadcrumbs :pages="breadcrumbspages"></Breadcrumbs>

        <!-- CONTENT -->
        <div class="grid grid-cols-4">
            <!-- Divisions -->
            <div class="p-4 text-sm w-full">
                <div class="w-full">
                    <p class="  pr-2 f-14 text-gray-800 font-medium px-1 d-flex">Division:</p>
                    <div class="w-full relative inline-block">
                        <Menu as="div" class="relative">
                            <MenuButton
                                type="button"
                                class="flex items-center justify-between text-left text-xs gap-x-1.5 w-full rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                            >
                                {{ selected.selectedDivision }}
                                <ChevronDownIcon
                                    class="-mr-1 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-3 w-full max-h-80 origin-top-right overflow-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div v-for="(div, index) in divisions" :key="div.id" class="py-1">
                                        <MenuItem v-slot="{ active }" v-if="div.depts.length> 0" >
                                            <a  @click="showDept('division', div.name,div.depts,div.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ div.name }}
                                            </a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }" v-else >
                                            <a  @click="modalClose('division', div.name, div.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ div.name }}
                                            </a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>

                </div>
            </div>
            <!-- Departments -->
            <div class="p-4 text-sm">
                <div  class="w-full ">
                    <p class="pr-2 f-14 text-gray-800 font-medium px-1 d-flex">Department:</p>
                    <div class="w-full relative inline-block">
                        <Menu as="div" class="relative">
                            <MenuButton
                                type="button"
                                class="flex items-center justify-between text-left text-xs gap-x-1.5 w-full rounded-md px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"  :disabled="selected.selectedDivision === 'Select Division'" :class="{'bg-gray-100 text-gray-500': selected.selectedDivision === 'Select Division','bg-white text-gray-900 hover:bg-gray-50': selected.selectedDivision !== 'Select Division' }"  >
                                {{ selected.selectedDept }}
                                <ChevronDownIcon
                                    class="-mr-1 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-3 w-full max-h-80 origin-top-right overflow-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div v-for="(deps, index) in departments" :key="deps.id" class="py-1">
                                        <MenuItem v-slot="{ active }" v-if="deps.subdept.length> 0" >
                                            <a  @click="showDept('department', deps.name,deps.subdept,deps.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ deps.name }}
                                            </a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }" v-else >
                                            <a  @click="modalClose('department', deps.name, deps.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ deps.name }}
                                            </a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <!-- Sub Departments -->
            <div class="p-4 text-sm">
                <div  class="w-full ">
                    <p class="pr-2 f-14 text-gray-800 font-medium px-1 d-flex">Sub-Department:</p>
                    <div class="w-full relative inline-block">
                        <Menu as="div" class="relative">
                            <MenuButton
                                type="button"
                                class="flex items-center justify-between text-left text-xs gap-x-1.5 w-full rounded-md px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" :disabled="selected.selectedDept === 'Select Department'" :class="{'bg-gray-100 text-gray-500': selected.selectedDept === 'Select Department','bg-white text-gray-900 hover:bg-gray-50': selected.selectedDept !== 'Select Department' }">
                                {{ selected.selectedSubDept }}
                                <ChevronDownIcon
                                    class="-mr-1 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-3 w-full max-h-80 origin-top-right overflow-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div v-for="(subdeps, index) in subDepartments" :key="subdeps.id" class="py-1">
                                        <MenuItem v-slot="{ active }" v-if="subdeps.subdeptunit.length> 0" >
                                            <a  @click="showDept('subdepartment', subdeps.name,subdeps.subdeptunit,subdeps.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ subdeps.name }}
                                            </a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }" v-else >
                                            <a  @click="modalClose('subdepartment', subdeps.name, subdeps.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ subdeps.name }}
                                            </a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <!-- Sub Departments Units-->
            <div class="p-4 text-sm">
                <div  class="w-full">
                    <p class="pr-2 f-14 text-gray-800 font-medium px-1 d-flex">Sub-Department Units:</p>
                    <div class="w-full relative inline-block">
                        <Menu as="div" class="relative">
                            <MenuButton
                                type="button"
                                class="flex items-center justify-between text-left text-xs gap-x-1.5 w-full rounded-md px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" :disabled="selected.selectedSubDept === 'Select Sub-Department'" :class="{'bg-gray-100 text-gray-500': selected.selectedSubDept === 'Select Sub-Department','bg-white text-gray-900 hover:bg-gray-50': selected.selectedSubDept !== 'Select Sub-Department' }">
                                {{ selected.selectedSubDeptUnit }}
                                <ChevronDownIcon
                                    class="-mr-1 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </MenuButton>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-3 w-full max-h-80 origin-top-right overflow-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div v-for="(item, index) in subDepartmentUnits" :key="item.id" class="py-1">
                                        <MenuItem v-slot="{ active }" >
                                            <a  @click="modalClose('subdepartmentunit', item.name, item.id)"
                                                class="cursor-pointer"
                                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm',]"
                                            >
                                                {{ item.name }}
                                            </a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="p-4">
            <div class="flex justify-end">
                <!-- <div >
                    <button v-if="employees.length>0" type="button" @click="setToAll('emp','')" class="p-2 bg-blue-600 text-white text-sm rounded-md">Assign to All</button>
                </div> -->
                <div class="flex justify-end">
                    <Menu as="div" class="relative">
                        <MenuButton
                            type="button"
                            class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        >
                            {{ set.view }}
                            <ChevronDownIcon
                                class="-mr-1 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                        </MenuButton>

                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="viewAs('week')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >Weekly</a
                                        >
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a
                                            @click="viewAs('payrolperiod')"
                                            :class="[
                                                active
                                                    ? 'bg-gray-100 text-gray-900'
                                                    : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                            ]"
                                            >10/25</a
                                        >
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <!-- <button type="button" @click="previousPayrollPeriod" class="p-2 bg-blue-600 text-white text-sm rounded-md mx-1">Previos Payroll</button>
                    <button type="button" @click="nextPayrollPeriod" class="p-2 bg-blue-600 text-white text-sm rounded-md mx-1">Next Payroll</button> -->
                </div>
            </div>

            <div class="flex items-center justify-between bg-gray-200 mt-2 border-t border-x rounded-t-md px-2 py-2">
                <h1 class="text-gray-800 text-sm font-medium">
                    Workshift Period: <b>{{dateToWords( ews.period_from) }} </b> - <b>{{ dateToWords(ews.period_to) }},  {{ ews.period_to.substring(0,4) }}</b>
                </h1>
                <span class="text-gray-800 text-xs font-bold ">
                    <span class="border-gray-300 bg-yellow-200 px-2 py-1.5 rounded-l-md">On-Call</span>
                    <span class="border-gray-300 bg-red-300 px-2 py-1.5 ">Day Off</span>
                    <span class="border-gray-300 bg-green-200 px-2 py-1.5 rounded-r-md">On-duty</span>
                </span>
            </div>

            <table class="table-auto w-full border-collapse border-r border-slate-300 ">
                    <thead>
                        <tr class="bg-gray-50 border pb-1 pt-1">
                            <th class="w-2 border-r">
                                <div class="text-right text-sm px-2 text-gray-600 ">No.</div>
                            </th>
                            <th class="w-80">
                                <div class="text-left xl:block lg:block md:block sm:block hidden">
                                    <div class="text-sm px-2 text-gray-600 ">Employee</div>
                                </div>
                                <div class="text-left xl:hidden lg:hidden md:hidden sm:hidden block">
                                    <div class="text-xs px-2">Employee Name</div>
                                </div>
                            </th>
                            <th v-for="ds in days" class="w-16 border">

                                <div class="w-16">
                                    <div class="text-left xl:block lg:block md:block sm:block hidden">
                                         <div class="flex jsutify-start">
                                            <h1 class="text-3xl text-blue-500 font-bold" :class="{'text-red-500' : ds.dayofweek === 'Sunday'}">
                                                {{ dateToWords(ds.date).substring(4,6) }}
                                            </h1>
                                            <div class="mt-1 ml-0.5">
                                                <p class="uppercase text-xs text-gray-600 font-normal p-0" :class="{'text-red-500' : ds.dayofweek === 'Sunday'}">{{ dateToWords(ds.date).substring(0,3) }}</p>
                                                <p v-if="cal !=='payrolperiod'" class="text-xs text-gray-600 font-bold p-0 -mt-1" :class="{'text-red-500' : ds.dayofweek === 'Sunday'}">{{ ds.dayofweek }}</p>
                                                <p v-else class="text-xs text-gray-600 font-bold p-0 -mt-1" :class="{'text-red-500' : ds.dayofweek === 'Sunday'}">{{ ds.dayofweek.substring(0,3) }}</p>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="text-center xl:hidden lg:hidden md:hidden sm:hidden block">
                                        <h1 class="text-xs text-gray-600 font-normal mt-1 -mb-1.5">{{ dateToWords(ds.date).substring(0,3) }}</h1>
                                        <h1 class="uppercase text-sm text-blue-500 font-bold -mb-1.5">{{ dateToWords(ds.date).substring(4,6) }}</h1>
                                        <h1 class="text-xs text-gray-600 font-normal mb-1">{{ ds.dayofweek.substring(0,3) }}</h1>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- {{ sortedEmployees }} -->
                    <tbody>
                        <tr v-for="(employee, index) in sortedEmployees" :key="employee.id" class="bg-white border-b transition duration-100 ease-in-out hover:bg-blue-50">
                            <td class="text-right border-x border-slate-200 text-sm px-1.5 w-2">
                                <h1>{{ index+1 }}</h1>
                            </td>
                            <td class="border border-slate-200 px-2 w-80">

                                <div class="flex justify-between">
                                    <h1 class="text-md font-medium py-1">{{ employee.last_name }},  {{ employee.first_name }}</h1>
                                </div>
                                <div class="text-sm text-gray-600">
                                    E-{{padEmployeeId(employee.id) }} | Departament
                                </div>


                            </td>

                            <td v-for="(ds, index) in employee.selectedShift" :key="index" class="w-16 px-0.5 py-2 " >
                                <div  v-if="ds.schedule_day !== 'n/a'"  @click="setEmpSched('edit', employee, ds.schedule_date, index)" class="relative text-xs cursor-pointer w-full h-14 rounded border border-gray-300 hover:border-blue-500 hover:shadow-lg hover:border-2"
                                :class="{'font-bold bg-red-200':ds.day_off == 1,'bg-yellow-100':ds.oc == 1,'bg-green-100':ds.oc != 1 && ds.day_off != 1 }">
                                    <div class=" flex items-center justify-center text-xs w-full h-full">

                                        <h1 v-if="ds.day_off == 1">
                                            OFF
                                            <span v-if="ds.oc==1" class="font-bold text-red-500"><br>OC</span>
                                        </h1>
                                        <h1 v-else>
                                            <span>{{ ds.time_from }}</span>
                                            <span><br>{{ ds.time_to }}</span>
                                            <span v-if="ds.oc==1" class="font-bold text-red-500"><br>OC</span>
                                        </h1>
                                    </div>
                                </div>
                                <div v-else @click="setEmpSched('shifts', employee, ds.schedule_date, index)" class="relative text-gray-400 text-xs cursor-pointer w-full h-14 rounded border border-gray-300 bg-white hover:text-blue-500 hover:border-blue-500 hover:shadow-lg hover:border-2">
                                    <div class="flex items-center justify-center w-full h-full">
                                        <PlusCircleIcon class=" w-5 h-5"/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
            </table>

            <div class="bg-gray-50 border-b border-x rounded-b-md px-2 py-2">
                <p class="text-gray-800 text-sm">
                    <b>Reminders:</b> Please ensure that all personnel schedules are set by the deadline in order to minimise needless disruption. Regards
                </p>
            </div>
        </div>

        <div  ref="modalContainerShifts">
            <form @submit.prevent="saveworkshift">
                <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
                        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ setType }} Employee Workshift
                            </h3>
                            <button @click="modalClose('shifts','','')" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="6" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="px-4 mt-2">
                            <h1>Name: <b>{{ emp_Sched.full_name }}</b></h1>
                            <p v-if="employeeIds.length>0" class="text-xs">and {{ employeeIds.length -1  }} other employees</p>

                                <!-- mid -->
                                 <div v-if="setType !== 'Edit'" v-for="dates in emp_Shift" :key="dates.schedule_date">
                                    <!--   v-if="dates.schedule_date ===  emp_Sched.day"   -->
                                    <div v-if="dates.schedule_date ===  emp_Sched.day" class="pt-2">
                                        <h1 class="w-1/2 text-sm uppercase font-medium bg-gray-600 border-gray-600 border text-white px-1 py-1.5 rounded-t-md">{{ fullDateToWords(dates.schedule_date)}} - ({{ dates.schedule_day.substring(0,3) }})</h1>
                                        <div class="bg-white px-2 py-2 rounded-tr-md border-t border-x">
                                            <div class="w-full py-2 space-y-1">
                                                <Menu as="div" class="relative -mt-0.5">
                                                    <MenuButton
                                                        type="button"
                                                        class="flex items-center justify-between gap-x-1.5 w-full rounded-md px-3 py-2 text-sm font-semibold" :disabled="workShifts.length<1" :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white text-gray-600  ring-1 ring-inset ring-gray-200 hover:bg-gray-50' :workShifts.length>0,}"
                                                    >
                                                        {{ set.shifts }}
                                                        <ChevronDownIcon
                                                            class="-mr-1 h-5 w-5 text-gray-400"
                                                            aria-hidden="true"
                                                        />
                                                    </MenuButton>

                                                    <transition
                                                        enter-active-class="transition ease-out duration-100"
                                                        enter-from-class="transform opacity-0 scale-95"
                                                        enter-to-class="transform opacity-100 scale-100"
                                                        leave-active-class="transition ease-in duration-75"
                                                        leave-from-class="transform opacity-100 scale-100"
                                                        leave-to-class="transform opacity-0 scale-95"
                                                    >
                                                        <MenuItems
                                                            class="absolute right-0 z-10 mt-2 w-full origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        >
                                                            <div v-for="(shifts, index) in workShifts" :key="index" class="py-1" >
                                                                <MenuItem v-slot="{ active }">
                                                                    <a
                                                                        @click="selectedShift(shifts)"
                                                                        :class="[
                                                                            active
                                                                                ? 'bg-gray-100 text-gray-900'
                                                                                : 'text-gray-700',
                                                                            'block px-4 py-2 text-sm',
                                                                        ]"
                                                                        >{{ shifts.shift_name }} ({{ shifts.time_from }}-{{ shifts.time_to }})</a
                                                                    >
                                                                </MenuItem>
                                                            </div>
                                                        </MenuItems>
                                                    </transition>
                                                </Menu>

                                                <div class="w-full flex items-center justify-between space-x-1.5">
                                                    <label :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white border border-gray-200 text-gray-900 hover:bg-blue-400' :workShifts.length>0,}" class="flex justify-start cursor-pointer rounded-md w-full space-x-1 px-2 py-2 text-sm">
                                                        <input @change="toggleRestDay($event,setType, dates, 0)"   :disabled="workShifts.length<1" id="cbx-restDay" type="checkbox" class="mt-0.5 mr-1.5 w-4 h-4 bg-gray-100 border-gray-300 rounded-lg text-red-500 focus:ring-red-500">
                                                        <span>Day-Off</span>
                                                    </label>

                                                    <label :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white border border-gray-200 text-gray-900 hover:bg-blue-400' :workShifts.length>0,}" class="flex justify-start cursor-pointer rounded-md w-full space-x-1 px-2 py-2 text-sm">
                                                        <input @change="toggleRestDay($event,setType, dates, 1)"   :disabled="workShifts.length<1" id="cbx-oncall" type="checkbox" class="mt-0.5 mr-1.5 w-4 h-4 bg-gray-100 border-gray-300 rounded-lg text-yellow-300  focus:ring-yellow-300">
                                                        <span>On-Call</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <h1 class="w-1/2 text-sm uppercase font-medium bg-gray-600 border-gray-600 border text-white px-1 py-1.5 rounded-t-md">{{ fullDateToWords(ewsUpdate.schedule_date)}} - ({{ ewsUpdate.schedule_day.substring(0,3) }})</h1>
                                    <div class="bg-white px-2 py-2 rounded-tr-md border-t border-x">
                                            <div class="w-full py-2 space-y-1">
                                                <Menu as="div" class="relative -mt-0.5">
                                                    <MenuButton
                                                        type="button"
                                                        class="flex items-center justify-between gap-x-1.5 w-full rounded-md px-3 py-2 text-sm font-semibold" :disabled="workShifts.length<1" :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white text-gray-600  ring-1 ring-inset ring-gray-200 hover:bg-gray-50' :workShifts.length>0,}"
                                                    >
                                                        {{ set.shifts }}
                                                        <ChevronDownIcon
                                                            class="-mr-1 h-5 w-5 text-gray-400"
                                                            aria-hidden="true"
                                                        />
                                                    </MenuButton>

                                                    <transition
                                                        enter-active-class="transition ease-out duration-100"
                                                        enter-from-class="transform opacity-0 scale-95"
                                                        enter-to-class="transform opacity-100 scale-100"
                                                        leave-active-class="transition ease-in duration-75"
                                                        leave-from-class="transform opacity-100 scale-100"
                                                        leave-to-class="transform opacity-0 scale-95"
                                                    >
                                                        <MenuItems
                                                            class="absolute right-0 z-10 mt-2 w-full origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        >
                                                            <div v-for="(shifts, index) in workShifts" :key="index" class="py-1" >
                                                                <MenuItem v-slot="{ active }">
                                                                    <a
                                                                        @click="selectedShift(shifts)"
                                                                        :class="[
                                                                            active
                                                                                ? 'bg-gray-100 text-gray-900'
                                                                                : 'text-gray-700',
                                                                            'block px-4 py-2 text-sm',
                                                                        ]"
                                                                        >{{ shifts.shift_name }} ({{ shifts.time_from }}-{{ shifts.time_to }})</a
                                                                    >
                                                                </MenuItem>
                                                            </div>
                                                        </MenuItems>
                                                    </transition>
                                                </Menu>

                                                <div class="w-full flex items-center justify-between space-x-1.5">
                                                    <label :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white border border-gray-200 text-gray-900 hover:bg-blue-400' :workShifts.length>0,}" class="flex justify-start cursor-pointer rounded-md w-full space-x-1 px-2 py-2 text-sm">
                                                        <input v-model="ewsUpdate.day_off"  :disabled="workShifts.length<1" id="cbx-restDay" type="checkbox" class="mt-0.5 mr-1.5 w-4 h-4 bg-gray-100 border-gray-300 rounded-lg text-red-500 focus:ring-red-500">
                                                        <span>Day-Off</span>
                                                    </label>

                                                    <label :class="{'bg-gray-100 text-gray-400' :workShifts.length<1,'bg-white border border-gray-200 text-gray-900 hover:bg-blue-400' :workShifts.length>0,}" class="flex justify-start cursor-pointer rounded-md w-full space-x-1 px-2 py-2 text-sm">
                                                        <input v-model="ewsUpdate.oc"  :disabled="workShifts.length<1" id="cbx-oncall" type="checkbox" class="mt-0.5 mr-1.5 w-4 h-4 bg-gray-100 border-gray-300 rounded-lg text-yellow-300  focus:ring-yellow-300">
                                                        <span>On-Call</span>
                                                    </label>



                                                </div>
                                            </div>
                                        </div>
                                </div>

                            <div class="border rounded-b-lg divide-y">
                                <label class="w-full inline-flex items-center cursor-pointer pt-2 pl-2">
                                    <input
                                    v-model="ews.is_active"
                                    type="checkbox"
                                    class="sr-only peer"
                                    :checked="setType === 'Edit'"

                                    />
                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-700">Active</span>
                                </label>
                                <label v-if="setType !== 'Edit'" class="w-full inline-flex items-center cursor-pointer pt-2 pl-2 border-t">
                                    <input

                                    type="checkbox" @change="setToAll('shift',$event)"
                                    class="sr-only peer"
                                    :checked="setType === 'Edit'"

                                    />
                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-700">Set for the remaining unassigned days in the period</span>
                                </label>
                                <label v-if="setType !== 'Edit'" class="w-full inline-flex items-center cursor-pointer pt-2 pl-2 border-t">
                                    <input

                                    type="checkbox" @change="setToAll('emp',$event)"
                                    class="sr-only peer"
                                    :checked="setType === 'Edit'"

                                    />
                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-700">Assign to all Employee</span>
                                </label>
                            </div>
                            <!-- <div  v-if="setType !== 'Edit'" >
                                    <label class="flex justify-start cursor-pointer w-full space-x-1 p-2 text-sm border rounded-t-md hover:bg-gray-100">
                                        <input id="cbx-restDay" type="checkbox" @change="setToAll('emp','')" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-lg">
                                        <span>Assign to all Employee</span>
                                    </label>

                                    <label class="flex justify-start cursor-pointer w-full space-x-1 p-2 text-sm border rounded-b-md hover:bg-gray-100">
                                        <input id="cbx-restDay" type="checkbox" @change="setToAll('shift',$event)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-lg">
                                        <span>Set for the rest of days period</span>
                                    </label>

                                 </div> -->
                        </div>


                        <div class="px-4 space-x-2 py-2 mt-3 border-t border-gray-200 bg-gray-50 sm:px-6 flex justify-end">
                            <button @click="modalClose('shifts','','')" class="text-gray-400 px-4 py-1.5 rounded-md hover:bg-gray-900">
                                <span class="">Close</span>
                            </button>
                            <button @click="closeModal" type="submit" class=" px-4 py-1.5 rounded-md "
                            :class="{'bg-gray-300 text-white': set.shifts === 'Select Shift','bg-blue-500 text-white hover:bg-blue-600': set.shifts !== 'Select Shift'}"   :disabled="set.shifts === 'Select Shift' ">
                                <span v-if="setType === 'Set'">Save</span>
                                <span v-else>Update</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>




    </MasterLayout>
</template>


<script setup>

import axios from 'axios';
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Pages/Templates/Breadcrumbs.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { EllipsisVerticalIcon } from '@heroicons/vue/20/solid'
import { PlusCircleIcon, ChevronDownIcon, MagnifyingGlassIcon, ChevronRightIcon} from '@heroicons/vue/20/solid'
// import DayShift from '../Maintenance/DayShift.vue';
const statuses = {
  'INFORMATION TECHNOLOGY': 'text-green-700 bg-green-50 ring-green-600/20',
  'FINANCE': 'text-gray-600 bg-gray-50 ring-gray-500/10',
  'HUMAN RESOURCE': 'text-blue-600 bg-blue-50 ring-blue-500/20',
}

</script>

<script>
export default {
    name: 'Employee Work Schedule',

    data(){
        return{
            breadcrumbspages: [
                { name: 'EMPLOYEES', href: route('employees.index'), current: false },

            ],
            ews:{},
            ewsUpdate:{},
            divisions: [],
            departments: [],
            subDepartments: [],
            subDepartmentUnits: [],
            employees: [],
            isVisible:false,
            selected:{selectedDivision:'Select Division', selectedDept:'Select Department', selectedSubDept:'Select Sub-Department', selectedSubDeptUnit:'Select Sub-Department Unit'},
            days: [],
            set:{shifts:'Select Shift',view:'Set By'},
            workShifts:[],
            currentShift:'',
            emp_Sched: {},
            emp_Shift: [],
            setType:'',
            employeeIds:[],
            updateID:'',
            search:{},
            cal:'',
            role:1,
            setPeriod:0,
            periodDates:[],
            selectedDate:'',
            saveShifts:[],
        }
    },
    computed: {
        sortedEmployees() {
            return this.employees.map(employee => {
            const sortedShifts = [...employee.selectedShift].sort((a, b) => {
                return new Date(a.schedule_date) - new Date(b.schedule_date);
            });
            return { ...employee, selectedShift: sortedShifts };
            });
        },
    },
    methods: {
        selectedShift(shift){
            this.ews.work_shift_id = shift.id;
            this.ewsUpdate.work_shift_id = shift.id;
            this.set.shifts = `${shift.time_from} - ${shift.time_to}`;
        },
        setEmpSched(type, employeeData, date, index){
            const employee = this.employees.find(emp => emp.id === employeeData.id);
            if (type !== 'shifts'){
                this.setType = 'Edit';
                this.ewsUpdate = {};
                this.emp_Shift = [];
                const matchingShift = employee.selectedShift.find(shift => shift.schedule_date === date);
                if (matchingShift) {
                    console.log('Show WWWWWWWWW:', matchingShift);

                    this.ewsUpdate.work_shift_id = matchingShift.work_shift_id;
                    this.ewsUpdate.employee_workshift_id = matchingShift.employee_workshift_id;
                    this.ewsUpdate.schedule_date = matchingShift.schedule_date;
                    this.ewsUpdate.schedule_day = matchingShift.schedule_day;
                    this.ewsUpdate.day_off = (matchingShift.day_off === '1') ? true : false ;
                    this.ewsUpdate.oc = (matchingShift.oc === '1') ? true : false ;
                    this.set.shifts = matchingShift.time_from + ' - ' + matchingShift.time_to;

                }
                console.log('Show emp_Shift:', this.emp_Shift);
                this.emp_Sched = employee;
                this.modalOpen(type, employee.id)

            }else{
                this.setType = 'Set';
                if (employee) {
                    this.emp_Shift = this.days.map(day => ({
                    schedule_date: this.formatDate(day.date),
                    schedule_day: day.dayofweek,
                    day_off:false,
                    oc:false,
                    }));
                }

                this.selectedDate = index;
                this.saveShifts = this.emp_Shift[index];
                this.emp_Sched = employee;
                this.emp_Sched.day = date;
                this.modalOpen(type, employee.id)
            }



        },
        modalOpen(name, id){

            if(name === 'shifts'){
                this.currentShift= '';
                this.isVisible=true;
                this.ews.employee_id = id;
            }
            if(name === 'edit'){
                this.isVisible=true;
                this.ews.employee_id = id;
            }
        },
        setToAll(type, event) {
            if(type === 'shift'){
                if(event.target.checked){
                    this.setPeriod = 1;
                    this.saveShifts = this.emp_Shift[this.selectedDate];
                    this.periodDates = this.emp_Shift;
                }else{
                    this.setPeriod = 0;
                    this.saveShifts = this.emp_Shift[this.selectedDate];
                    this.periodDates =[];
                }

            }else{
                if(event.target.checked){
                    const employees = this.employees; // Assuming 'employees' is defined in your data or computed properties
                    if (employees.length > 0) {
                        this.employeeIds = this.employees.map(employee => employee.id);
                        const topEmployeeId = employees[0].id;
                        this.setType = 'Set';
                    // this.modalOpen('shifts', topEmployeeId);
                    this.ews.work_shift_id == 0;
                    }
                }else{
                        this.employeeIds = [];
                    }

            }

        },
        viewAs(type){
            this.cal = type;
            this.generatePayrollDays();
            if (this.selected.selectedDivision !== 'Select Division'){
                this.getEmployee(this.search.currentType, this.search.currentID);
            }else {
                this.employees = [];
            }
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        },

        toggleRestDay(event,setType, shift, type) {

            if (setType === 'Set'){
                if (type === 0) {
                    shift.day_off = event.target.checked;
                } else {
                    shift.oc = event.target.checked;
                }
            }else{

                if (type === 0) {
                    this.ewsUpdate.day_off = event.target.checked;
                } else {
                    this.ewsUpdate.oc = event.target.checked;
                }

            }
        },

        saveworkshift() {
            console.log("this.periodDates.length",this.periodDates.length);
            console.log("this.ewsUpdate",this.ewsUpdate);
            if(this.setType === 'Edit'){
                console.log('EDITTTT', this.ewsUpdate.employee_workshift_id);
                axios.patch(route('employeeworkschedule.update', this.ewsUpdate.employee_workshift_id),
                {
                    formdata:this.ewsUpdate,
                }
                )
                .then(response => {
                console.log(response.data);
                if (response.data === 'success') {
                    this.getEmployee(this.search.currentType, this.search.currentID);
                    this.isVisible=false;
                    this.set.shifts = 'Select Shift'
                }else {
                    this.getEmployee(this.search.currentType, this.search.currentID);
                    this.isVisible=false;
                    this.set.shifts = 'Select Shift'
                }
                })
                .catch(err => {
                if (err.response && err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
                });

            }else{

                axios.post('employeeworkschedule',
                {   formdata:this.ews,
                    shift_details:this.saveShifts,
                    emp: this.employeeIds,
                    setby: this.periodDates.length,
                    shiftDates:this.periodDates,
                }
                )
                .then(response => {
                console.log(response.data);
                if (response.data === 'success') {
                    this.getEmployee(this.search.currentType, this.search.currentID);
                    this.isVisible=false;
                    this.set.shifts = 'Select Shift'
                    this.this.setPeriod=0;
                }else {
                    {
                    this.getEmployee(this.search.currentType, this.search.currentID);
                    this.isVisible=false;
                    this.set.shifts = 'Select Shift'
                    this.this.setPeriod=0;
                }
                }
                })
                .catch(err => {
                if (err.response && err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
                });
            }
            this.periodDates = [];
            this.employeeIds = [];

        },

        padEmployeeId(id) {
        return id.toString().padStart(6, '0');
        },
        onDivisionChange(type){
            if (type === 'division'){
                this.selected.selectedDept = 'Select Department'
                this.selected.selectedSubDept = 'Select Sub-Department'
                this.selected.selectedSubDeptUnit = 'Select Sub-Department Unit'
            }
            if (type === 'department'){
                this.selected.selectedSubDept = 'Select Sub-Department'
                this.selected.selectedSubDeptUnit = 'Select Sub-Department Unit'
            }
            if (type === 'subdepartment'){
                this.selected.selectedSubDeptUnit = 'Select Sub-Department Unit'
            }
        },
        showDept(type, div_name,depts,div_id) {
            if (type === 'division'){
                this.departments= depts;
                this.selected.selectedDivision = div_name;
                this.search.currentType = type;
                this.search.currentID = div_id;
                this.getWorkShifts(type, div_id);
                this.getEmployee(type, div_id);
                this.onDivisionChange(type);
            }
            if (type === 'department'){
                this.subDepartments= depts;
                this.selected.selectedDept = div_name;
                this.search.currentType = type;
                this.search.currentID = div_id;
                this.getWorkShifts(type, div_id);
                this.getEmployee(type, div_id);
                this.onDivisionChange(type);
            }
            if (type === 'subdepartment'){
                this.subDepartmentUnits= depts;
                this.selected.selectedSubDept = div_name;
                this.search.currentType = type;
                this.search.currentID = div_id;
                this.getWorkShifts(type, div_id);
                this.getEmployee(type, div_id);
            }
        },

        modalClose(type, selected, id){
            if(type === 'division'){
                this.selected.selectedDivision = selected;
                this.search.currentType = type;
                this.search.currentID = id;
                this.getEmployee(type, id);
                this.getWorkShifts(type, id);
            }
            if(type === 'department'){
                this.selected.selectedDept = selected;
                this.search.currentType = type;
                this.search.currentID = id;
                this.getWorkShifts(type, id);
                this.getEmployee(type, id);
            }
            if(type === 'subdepartment'){
                this.selected.selectedSubDept = selected;
                this.search.currentType = type;
                this.search.currentID = id;
                this.getWorkShifts(type, id);
                this.getEmployee(type, id);
            }
            if(type === 'subdepartmentunit'){
                this.selected.selectedSubDeptUnit = selected;
                this.search.currentType = type;
                this.search.currentID = id;
                this.getWorkShifts(type, id);
                this.getEmployee(type, id);
            }
            if(type === 'shifts'){
                this.isVisible=false
                this.employeeIds = [];
            }
            this.periodDates = [];
            this.set.shifts = 'Select Shift';

        },


        async getDepartments() {

            try {
                const response = await axios.get(route('employeeworkschedule.getSubDeptUnit'));
                this.subDepartmentUnits = response.data.map((val) => ({
                id: val.id,
                name: val.name,
                sub_department_id: Number(val.sub_department_id),
                }));
            } catch (error) {
                console.error('Error fetching departments:', error);
            }

            try {
                const response = await axios.get(route('employeeworkschedule.getSubDept'));
                this.subDepartments = response.data.map((val) => {
                const subdeptunit = this.subDepartmentUnits.filter(dept => dept.sub_department_id === val.id);
                return {
                    id: val.id,
                    name: val.name,
                    department_id: Number(val.department_id),
                    subdeptunit: subdeptunit,
                };
                });
            } catch (error) {
                console.error('Error fetching divisions:', error);
            }

            try {
                const response = await axios.get(route('employeeworkschedule.getDept'));
                this.departments = response.data.map((val) => {
                const subdept = this.subDepartments.filter(dept => dept.department_id === val.id);
                return {
                    id: val.id,
                    name: val.name,
                    division_id: Number(val.division_id),
                    subdept: subdept,
                };
                });
            } catch (error) {
                console.error('Error fetching divisions:', error);
            }

            try {
                const response = await axios.get(route('employeeworkschedule.getDivisions'));
                this.divisions = response.data.map((val) => {
                const depts = this.departments.filter(dept => dept.division_id === val.id);
                return {
                    id: val.id,
                    name: val.name,
                    depts: depts,
                };
                });
            } catch (error) {
                console.error('Error fetching divisions:', error);
            }
        },

        getEmployee(src_type, src_id){

            if (src_type === 'division'){
                axios.get(route('employeeworkschedule.getlist'),{
                    params:{
                        searchId: src_id,
                        searchType: src_type,
                        dateFrom: this.ews.period_from,
                        dateTo: this.ews.period_to,

                    }
                }).then(response => {
                    this.employees = response.data;
                    console.log('response.data',response.data);
                    this.populateAndSyncSelectedShifts();
                    console.log('DATES EQUAL',this.employees);
                    console.log('DATES EQUAL',this.days);
                })
            }
            if (src_type === 'department'){
                axios.get(route('employeeworkschedule.getlist'),{
                    params:{
                        searchId: src_id,
                        searchType: src_type,
                        dateFrom: this.ews.period_from,
                        dateTo: this.ews.period_to,

                    }
                }).then(response => {
                    this.employees = response.data;
                    this.populateAndSyncSelectedShifts();
                    // console.log('DATES EQUAL',this.employees);
                    // console.log('DATES EQUAL',this.days);
                })
            }
            if (src_type === 'subdepartment'){
                axios.get(route('employeeworkschedule.getlist'),{
                    params:{
                        searchId: src_id,
                        searchType: src_type,
                        dateFrom: this.ews.period_from,
                        dateTo: this.ews.period_to,

                    }
                }).then(response => {
                    this.employees = response.data;
                    this.populateAndSyncSelectedShifts();
                    // console.log('DATES EQUAL',this.employees);
                    // console.log('DATES EQUAL',this.days);
                })
            }
            if (src_type === 'subdepartmentunit'){
                axios.get(route('employeeworkschedule.getlist'),{
                    params:{
                        searchId: src_id,
                        searchType: src_type,
                        dateFrom: this.ews.period_from,
                        dateTo: this.ews.period_to,

                    }
                }).then(response => {
                    this.employees = response.data;
                    this.populateAndSyncSelectedShifts();
                    // console.log('DATES EQUAL',this.employees);
                    // console.log('DATES EQUAL',this.days);
                })
            }

        },
        populateAndSyncSelectedShifts() {
            this.employees.forEach(employee => {
            if (!employee.selectedShift) {
                employee.selectedShift = [];
            }

            const selectedDates = new Set(employee.selectedShift.map(shift => shift.schedule_date));

            this.days.forEach(day => {
                if (!selectedDates.has(day.date)) {
                employee.selectedShift.push({ schedule_date: day.date, schedule_day:'n/a' });
                }
            });
            });

            console.log('Updated employees:', this.employees);
        },
        getWorkShifts(src_type, src_id){
            // if (src_type === 'division'){
            axios.get(route('employeeworkschedule.getWorkShifts'),{
                params:{
                    searchId: src_id,
                    searchType: src_type,
                }
            }).then(response => {
                console.log('XXXXXXX',response.data)
                this.workShifts = response.data;

            console.log('WWWWW',this.workShifts)
            })
            // }
        },

        dateToWords(date) {
            const d = new Date(date);
            return d.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit',
            });
        },

        fullDateToWords(date) {
            const d = new Date(date);
            return d.toLocaleDateString('en-US', {
                year:'numeric',
                month: 'long',
                day: '2-digit',
            });
        },
        generatePayrollDays(dd) {
            this.days = [];
            let currentDate;
            dd = '2024-07-21'
            if (dd === '' || dd === null || dd === undefined) {
                currentDate = new Date();
            } else {
                currentDate = new Date(dd);
            }

            this.currentDate = currentDate;
            this.updatePayrollDays();
        },

        updatePayrollDays() {
            const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            if (this.cal === 'payrolperiod'){
                const currentDate = this.currentDate;
                const currentDay = currentDate.getDate();
                const currentMonth = currentDate.getMonth() + 1;
                const currentYear = currentDate.getFullYear();

                this.days = [];  // Reset days array

                if (currentDay >= 11 && currentDay <= 25) {
                    const lastDayOfCurrentMonth = new Date(currentYear, currentMonth, 0).getDate();
                    for (let i = 26; i <= lastDayOfCurrentMonth; i++) {
                        const date = new Date(currentYear, currentMonth - 1, i);
                        this.days.push({
                            date: this.formatDate(date),
                            dayofweek: weekdays[date.getDay()]
                        });
                    }
                    for (let i = 1; i <= 10; i++) {
                        const nextMonth = currentMonth === 12 ? 1 : currentMonth + 1;
                        const nextYear = currentMonth === 12 ? currentYear + 1 : currentYear;
                        const date = new Date(nextYear, nextMonth - 1, i);
                        this.days.push({
                            date: this.formatDate(date),
                            dayofweek: weekdays[date.getDay()]
                        });
                    }
                } else if (currentDay >= 26) {
                    const nextMonth = currentMonth === 12 ? 1 : currentMonth + 1;
                    const nextYear = currentMonth === 12 ? currentYear + 1 : currentYear;
                    for (let i = 11; i <= 25; i++) {
                        const date = new Date(nextYear, nextMonth - 1, i);
                        this.days.push({
                            date: this.formatDate(date),
                            dayofweek: weekdays[date.getDay()]
                        });
                    }
                } else {
                    for (let i = 11; i <= 25; i++) {
                        const date = new Date(currentYear, currentMonth - 1, i);
                        this.days.push({
                            date: this.formatDate(date),
                            dayofweek: weekdays[date.getDay()]
                        });
                    }
                }
            } else {
                // Generate days for the next week from current date
                const currentDate = this.currentDate;
                this.days = [];  // Reset days array

                // Calculate the start date of the next week
                const startOfNextWeek = new Date(currentDate);
                startOfNextWeek.setDate(currentDate.getDate() + (7 - currentDate.getDay()));

                // Loop through the next 7 days
                for (let i = 0; i < 7; i++) {
                    const date = new Date(startOfNextWeek);
                    date.setDate(startOfNextWeek.getDate() + i);
                    this.days.push({
                        date: this.formatDate(date),
                        dayofweek: weekdays[date.getDay()]
                    });
                }
            }

            this.ews.period_from = this.formatDate(this.days[0].date);
            this.ews.period_to = this.formatDate(this.days[this.days.length - 1].date);
        },

        nextPayrollPeriod() {
            const currentDay = this.currentDate.getDate();
            const currentMonth = this.currentDate.getMonth() + 1;
            const currentYear = this.currentDate.getFullYear();

            if (currentDay >= 11 && currentDay <= 25) {
                this.currentDate = new Date(currentYear, currentMonth, 26);
            } else if (currentDay >= 26) {
                const nextMonth = currentMonth === 12 ? 1 : currentMonth + 1;
                const nextYear = currentMonth === 12 ? currentYear + 1 : currentYear;
                this.currentDate = new Date(nextYear, nextMonth - 1, 11);
            } else {
                const nextMonth = currentMonth === 12 ? 1 : currentMonth + 1;
                const nextYear = currentMonth === 12 ? currentYear + 1 : currentYear;
                this.currentDate = new Date(nextYear, nextMonth - 1, 11);
            }

            this.updatePayrollDays();
            if (this.search.currentType !== ''){
                this.getEmployee(this.search.currentType, this.search.currentID);
            }else {
                this.employees = [];
            }
        },

        previousPayrollPeriod() {
            const currentDay = this.currentDate.getDate();
            const currentMonth = this.currentDate.getMonth() + 1;
            const currentYear = this.currentDate.getFullYear();

            if (currentDay >= 11 && currentDay <= 25) {
                this.currentDate = new Date(currentYear, currentMonth - 1, 10);
            } else if (currentDay >= 26) {
                this.currentDate = new Date(currentYear, currentMonth - 1, 25);
            } else {
                const prevMonth = currentMonth === 1 ? 12 : currentMonth - 1;
                const prevYear = currentMonth === 1 ? currentYear - 1 : currentYear;
                const lastDayOfPrevMonth = new Date(prevYear, prevMonth, 0).getDate();
                this.currentDate = new Date(prevYear, prevMonth - 1, lastDayOfPrevMonth);
            }

            this.updatePayrollDays();
            if (this.search.currentType !== ''){
                this.getEmployee(this.search.currentType, this.search.currentID);
            }else {
                this.employees = [];
            }
        },

    },

    created(){

        this.getDepartments();

        this.generatePayrollDays();

    },

    mounted() {

        document.addEventListener("click", this.handleClickOutside);
    },
    beforeDestroy() {
        // Remove the document click listener when the component is destroyed
        document.removeEventListener("click", this.handleClickOutside);
    },
}



</script>
