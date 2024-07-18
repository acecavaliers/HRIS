<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import Modal from '@/Pages/Templates/Modal.vue';
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverOverlay,
  PopoverPanel,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  AcademicCapIcon,
  BanknotesIcon,
  Bars3Icon,
  BellIcon,
  CheckBadgeIcon,
  ClockIcon,
  ReceiptRefundIcon,
  UsersIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'

const user = {
  name: 'Chelsea Hagon',
  email: 'chelsea.hagon@example.com',
  role: 'Human Resources Manager',
  imageUrl:
    'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}
const navigation = [
  { name: 'Home', href: '#', current: true },
  { name: 'Profile', href: '#', current: false },
  { name: 'Resources', href: '#', current: false },
  { name: 'Company Directory', href: '#', current: false },
  { name: 'Openings', href: '#', current: false },
]
const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: '#' },
  { name: 'Sign out', href: '#' },
]
const stats = [
  { label: 'Vacation days left', value: 12 },
  { label: 'Sick days left', value: 4 },
  { label: 'Personal days left', value: 2 },
]
const actions = [
  {
    icon: ClockIcon,
    name: 'Request time off',
    href: '#',
    iconForeground: 'text-teal-700',
    iconBackground: 'bg-teal-50',
  },
  {
    icon: CheckBadgeIcon,
    name: 'Benefits',
    href: '#',
    iconForeground: 'text-purple-700',
    iconBackground: 'bg-purple-50',
  },
  {
    icon: UsersIcon,
    name: 'Schedule a one-on-one',
    href: '#',
    iconForeground: 'text-sky-700',
    iconBackground: 'bg-sky-50',
  },
  {
    icon: BanknotesIcon,
    name: 'Payroll',
    href: '#',
    iconForeground: 'text-yellow-700',
    iconBackground: 'bg-yellow-50',
  },
  {
    icon: ReceiptRefundIcon,
    name: 'Submit an expense',
    href: '#',
    iconForeground: 'text-rose-700',
    iconBackground: 'bg-rose-50',
  },
  {
    icon: AcademicCapIcon,
    name: 'Training',
    href: '#',
    iconForeground: 'text-indigo-700',
    iconBackground: 'bg-indigo-50',
  },
]
const recentHires = [
  {
    name: 'Leonard Krasner',
    handle: 'leonardkrasner',
    imageUrl:
      'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    href: '#',
  },
  {
    name: 'Floyd Miles',
    handle: 'floydmiles',
    imageUrl:
      'https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    href: '#',
  },
  {
    name: 'Emily Selman',
    handle: 'emilyselman',
    imageUrl:
      'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    href: '#',
  },
  {
    name: 'Kristin Watson',
    handle: 'kristinwatson',
    imageUrl:
      'https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    href: '#',
  },
]
const announcements = [
  {
    id: 1,
    title: 'Office closed on July 2nd',
    href: '#',
    preview:
      'Cum qui rem deleniti. Suscipit in dolor veritatis sequi aut. Vero ut earum quis deleniti. Ut a sunt eum cum ut repudiandae possimus. Nihil ex tempora neque cum consectetur dolores.',
  },
  {
    id: 2,
    title: 'New password policy',
    href: '#',
    preview:
      'Alias inventore ut autem optio voluptas et repellendus. Facere totam quaerat quam quo laudantium cumque eaque excepturi vel. Accusamus maxime ipsam reprehenderit rerum id repellendus rerum. Culpa cum vel natus. Est sit autem mollitia.',
  },
  {
    id: 3,
    title: 'Office closed on July 2nd',
    href: '#',
    preview:
      'Tenetur libero voluptatem rerum occaecati qui est molestiae exercitationem. Voluptate quisquam iure assumenda consequatur ex et recusandae. Alias consectetur voluptatibus. Accusamus a ab dicta et. Consequatur quis dignissimos voluptatem nisi.',
  },
]
</script>


<script>
export default {
  data(){
    return{

    }
  },
  methods: {
    viewProfile(){
      this.emitter.emit('openModal');
    }
  }



}


</script>

<template>
    <Head title="Dashboard" />

    <MasterLayout>
        <template #header>
          <!--   <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2> -->
        </template>

        <div class="py-5">
            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div> -->
            <main class="-mt-16 pb-8">
      <div class="xl:mx-auto max-w-full">
        <h1 class="sr-only">Profile</h1>
        <!-- Main 3 column grid -->
        <div class="grid grid-cols-1 items-start lg:grid-cols-3">
          <!-- Left column -->
          <div class="grid grid-cols-1 lg:col-span-2">
            <!-- Welcome panel -->
            <section aria-labelledby="profile-overview-title">
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                <div class="bg-white p-6">
                  <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="sm:flex sm:space-x-5">
                      <div class="flex-shrink-0">
                        <img class="mx-auto h-20 w-20 rounded-full" :src="user.imageUrl" alt="" />
                      </div>
                      <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                        <p class="text-sm font-medium text-gray-600">Welcome back,</p>
                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ user.name }}</p>
                        <p class="text-sm font-medium text-gray-600">{{ user.role }}</p>
                      </div>
                    </div>
                    <div class="mt-5 flex justify-center sm:mt-0">
                      <button @click="viewProfile()" class="flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">View profile</button>
                    </div>
                  </div>
                </div>
                <div class="grid grid-cols-1 divide-y divide-gray-200 border-t border-gray-200 bg-gray-50 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                  <div v-for="stat in stats" :key="stat.label" class="px-6 py-5 text-center text-sm font-medium">
                    <span class="text-gray-900">{{ stat.value }}</span>
                    {{ ' ' }}
                    <span class="text-gray-600">{{ stat.label }}</span>
                  </div>
                </div>
              </div>
            </section>

            <!-- Actions panel -->
            <section aria-labelledby="quick-links-title">
              <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
                <h2 class="sr-only" id="quick-links-title">Quick links</h2>
                <div v-for="(action, actionIdx) in actions" :key="action.name" :class="[actionIdx === 0 ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', actionIdx === 1 ? 'sm:rounded-tr-lg' : '', actionIdx === actions.length - 2 ? 'sm:rounded-bl-lg' : '', actionIdx === actions.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '', 'group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-cyan-500']">
                  <div>
                    <span :class="[action.iconBackground, action.iconForeground, 'inline-flex rounded-lg p-3 ring-4 ring-white']">
                      <component :is="action.icon" class="h-6 w-6" aria-hidden="true" />
                    </span>
                  </div>
                  <div class="mt-8">
                    <h3 class="text-lg font-medium">
                      <a :href="action.href" class="focus:outline-none">
                        <!-- Extend touch target to entire panel -->
                        <span class="absolute inset-0" aria-hidden="true" />
                        {{ action.name }}
                      </a>
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendus qui ut at blanditiis et quo et molestiae.</p>
                  </div>
                  <span class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                    </svg>
                  </span>
                </div>
              </div>
            </section>
          </div>

          <!-- Right column -->
          <div class="grid grid-cols-1 gap-4">
            <!-- Announcements -->
            <section aria-labelledby="announcements-title">
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="p-6">
                  <h2 class="text-base font-medium text-gray-900" id="announcements-title">Announcements</h2>
                  <div class="mt-6 flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                      <li v-for="announcement in announcements" :key="announcement.id" class="py-5">
                        <div class="relative focus-within:ring-2 focus-within:ring-cyan-500">
                          <h3 class="text-sm font-semibold text-gray-800">
                            <a :href="announcement.href" class="hover:underline focus:outline-none">
                              <!-- Extend touch target to entire panel -->
                              <span class="absolute inset-0" aria-hidden="true" />
                              {{ announcement.title }}
                            </a>
                          </h3>
                          <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ announcement.preview }}</p>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="mt-6">
                    <a href="#" class="flex w-full items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">View all</a>
                  </div>
                </div>
              </div>
            </section>

            <!-- Recent Hires -->
            <section aria-labelledby="recent-hires-title">
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="p-6">
                  <h2 class="text-base font-medium text-gray-900" id="recent-hires-title">Recent Hires</h2>
                  <div class="mt-6 flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                      <li v-for="person in recentHires" :key="person.handle" class="py-4">
                        <div class="flex items-center space-x-4">
                          <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" :src="person.imageUrl" alt="" />
                          </div>
                          <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-gray-900">{{ person.name }}</p>
                            <p class="truncate text-sm text-gray-500">{{ '@' + person.handle }}</p>
                          </div>
                          <div>
                            <a :href="person.href" class="inline-flex items-center rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">View</a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="mt-6">
                    <a href="#" class="flex w-full items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">View all</a>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
        </div>
    </MasterLayout>


    <Modal modalTitle="Profile" submitBtnText="Save"></Modal>
</template>
