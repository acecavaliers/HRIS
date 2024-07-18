<template>
    <Head title="Employees" />
     <MasterLayout>
        <template #header>
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">CAREERS</h2>
        </template>
        <Breadcrumbs :pages="breadcrumbspages"></Breadcrumbs>

        <!-- CONTENT -->
        <div class="grid grid-cols-12 gap-x-4 text-center">
                <div class="p-4 col-span-2 h-screen overflow-y-auto bg-gray-100">
                    <nav class="flex flex-1 flex-col" aria-label="Sidebar">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            </div>
                            <input @keyup="searchCategory()" v-model="searchcategory" type="text" name="mobile-search-candidate" id="mobile-search-candidate" class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:hidden" placeholder="Search" />
                            <input @keyup="searchCategory()" v-model="searchcategory" type="text" name="desktop-search-candidate" id="desktop-search-candidate" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search Category" />
                        </div>
                        
                        <ul role="list" class="-mx-2 space-y-1">
                        <li v-for="(item, index) in jobtitlecategoriesfilter" :key="item.id">
                            <button @click="selectedItem(item, index)" :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'w-full group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold']">{{ item.name }}</button>
                            <hr>
                        </li>
                       
                        </ul>
                    </nav>
                </div>
                <div class="p-4 col-span-10">

                    <div class="pb-3 border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">{{ selectedjobtitlecategory }} JOB TITLES</h3>
                        <div class="mt-3 sm:ml-4 sm:mt-0">
                        <label for="mobile-search-candidate" class="sr-only">Search</label>
                        <label for="desktop-search-candidate" class="sr-only">Search</label>
                        <div class="flex rounded-md shadow-sm">
                            <div class="relative flex-grow focus-within:z-10">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            </div>
                            <input type="text" name="mobile-search-candidate" id="mobile-search-candidate" class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:hidden" placeholder="Search" />
                            <input type="text" name="desktop-search-candidate" id="desktop-search-candidate" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search candidates" />
                            </div>
                            <button type="button" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <BarsArrowUpIcon class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                            Sort
                            <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </button>
                        </div>
                        </div>
                    </div>

                    <ul role="list" class="divide-y divide-gray-100 h-full overflow-y-auto">
                        <li  @click="clickeMethod" v-for="project in projects" :key="project.id" class="relative flex justify-between gap-x-6 py-5">
                        
                            <div class="min-w-0">
                            <div class="flex flex-auto items-start gap-x-3">
                            <a href="" class="text-sm font-semibold leading-6 text-gray-900">{{ project.name }}</a>
                       
                            </div>
                            <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p>{{ project.category }}</p>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <p class="whitespace-nowrap">
                                Due on <time :datetime="project.dueDateTime">{{ project.dueDate }}</time>
                            </p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-4">
                         <!--    <p>asdfasdf</p>
                            <a :href="project.href" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block"
                            >View candidates<span class="sr-only">, {{ project.name }}</span></a
                            > -->

                            <div class="md:flex md:flex-col md:items-end hidden sm:flex sm:flex-col sm:items-end ">
                                <p class="text-sm leading-6 text-gray-900">HHIMD / Systems and Development</p>
                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                 Candidates: 10
                                </p>
                          
                            </div>

                          <!--   <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" /> -->
                            <a :href="project.href" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block"
                            >View candidates<span class="sr-only">, {{ project.name }}</span></a>
                        
                        </div>
                  
                        </li>
                    </ul>


                </div>

        </div>
      
        
    </MasterLayout>
</template>

<script setup>

import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Pages/Templates/Breadcrumbs.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { EllipsisVerticalIcon } from '@heroicons/vue/20/solid'
import { BarsArrowUpIcon, ChevronDownIcon, MagnifyingGlassIcon, ChevronRightIcon} from '@heroicons/vue/20/solid'
const statuses = {
  'INFORMATION TECHNOLOGY': 'text-green-700 bg-green-50 ring-green-600/20',
  'FINANCE': 'text-gray-600 bg-gray-50 ring-gray-500/10',
  'HUMAN RESOURCE': 'text-blue-600 bg-blue-50 ring-blue-500/20',
}
const projects = [
  {
    id: 1,
    name: 'PROGRAMMER',
    href: '#',
    status: 'INFORMATION TECHNOLOGY',
    category: 'INFORMATION TECHNOLOGY',
    dueDate: 'March 17, 2023',
    dueDateTime: '2023-03-17T00:00Z',
  },
  {
    id: 2,
    name: 'SENIOR PROGRAMMER',
    href: '#',
    status: 'INFORMATION TECHNOLOGY',
    category: 'INFORMATION TECHNOLOGY',
    dueDate: 'May 5, 2023',
    dueDateTime: '2023-05-05T00:00Z',
  },
  {
    id: 3,
    name: 'HR MANAGER',
    href: '#',
    status: 'HUMAN RESOURCE',
    category: 'HUMAN RESOURCE',
    dueDate: 'May 25, 2023',
    dueDateTime: '2023-05-25T00:00Z',
  },
  {
    id: 4,
    name: 'TRAINING AND DEVELOPMENT OFFICER',
    href: '#',
    status: 'HUMAN RESOURCE',
    category: 'HUMAN RESOURCE',
    dueDate: 'June 7, 2023',
    dueDateTime: '2023-06-07T00:00Z',
  },
  {
    id: 5,
    name: 'FINANCE MANAGER',
    href: '#',
    status: 'FINANCE',
    category: 'FINANCE',
    dueDate: 'June 10, 2023',
    dueDateTime: '2023-06-10T00:00Z',
  },
]
</script>

<script>
export default {
    name: 'Careers',

    data(){
        return{
            breadcrumbspages: [
                { name: 'EMPLOYEES', href: route('employees.index'), current: false },
                
            ],
            jobtitlecategories: [],
            selectedjobtitlecategory: '',
            selectedItemDescription: '',
            searchcategory: '',
        }
    },

    methods: {
        getjobtitlesfrompersonnelrequisitions(){
            /* axios.get(route('')) */
        },

        selectedItem(item, index){
            console.log(item)
            this.selectedjobtitlecategory = item.name
            this.selectedItemDescription = item.description
        },

        getJobTitleCategories(){
            axios.get(route('jobtitlecategories.getlist')).then(response => {
                this.jobtitlecategories = response.data.data;
            })
        }

       
    },

    created(){
        this.getJobTitleCategories();
        this.getjobtitlesfrompersonnelrequisitions();
    },

    computed: {
        jobtitlecategoriesfilter(){
            if(!this.searchcategory){
                return this.jobtitlecategories
            }
            return this.jobtitlecategories.filter(item=> item.name.toLowerCase().includes(this.searchcategory.toLowerCase()))
        }
    }
}



</script>