<template>
  

  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 sm:px-0 mt-5">
      <h3 class="text-base font-semibold leading-7 text-gray-900">General Settings</h3>
      <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Company Name</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">DADIANGAS MEDICAL CENTER</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Short Company Name</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">DMC</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">System Name</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">HUMAN RESOURCE INFORMATION SYSTEM</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Short System Name</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">HRIS</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">dhpidmc@dadiangasmed.com</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Company Address</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">Allado Compound, Leon Llido Street, City Heights, General Santos City 9500 Philippines</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Company Contact #</dt>
          <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">(083) 554 - 7881)</span>
            <span class="ml-4 flex-shrink-0">
              <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
            </span>
          </dd>
        </div>
    
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Company Logo</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
              <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                <div class="flex w-0 flex-1 items-center">
                  <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  <div class="ml-4 flex min-w-0 flex-1 gap-2">
                    <span class="truncate font-medium">resume_back_end_developer.pdf</span>
                    <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                  </div>
                </div>
                <div class="ml-4 flex flex-shrink-0 space-x-4">
                  <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
                  <span class="text-gray-200" aria-hidden="true">|</span>
                  <button type="button" class="rounded-md bg-white font-medium text-gray-900 hover:text-gray-800">Remove</button>
                </div>
              </li>
         
            </ul>
          </dd>
        </div>
      </dl>
    </div>
  </div>



 

  </template>
  
  <script setup>
  import { PaperClipIcon } from '@heroicons/vue/20/solid'
  </script>