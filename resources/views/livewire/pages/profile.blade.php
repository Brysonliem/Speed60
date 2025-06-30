<div class="flex flex-col gap-4 min-h-screen p-4 md:p-8">
    <div 
        x-data="{
            activeTab: '{{ request()->query('tab', 'dashboard') }}',
            switchTab(tab) {
                this.activeTab = tab;
                const url = new URL(window.location.href);
                url.searchParams.set('tab', tab);
                history.replaceState(null, '', url.toString());

                Livewire.dispatch('tab-switched', { tab });
            }
        }"
        class="flex flex-col md:grid md:grid-cols-7 gap-4"
    >
        <!-- Tabs for Mobile (horizontal inline tabs) -->
        <div class="block md:hidden mb-4 border-b border-gray-200">
            <nav class="flex space-x-4" aria-label="Tabs">
                <template x-for="tab in ['dashboard', 'my-orders','my-vouchers', 'my-account']" :key="tab">
                    <button
                        @click="switchTab(tab)"
                        class="px-3 py-2 text-sm font-medium rounded-t-md"
                        :class="activeTab === tab 
                            ? 'text-red-600 border-b-2 border-red-600' 
                            : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 border-transparent'"
                        x-text="tab.replace('-', ' ').toUpperCase()"
                    ></button>
                </template>
            </nav>
        </div>


        <!-- Sidebar Tab (desktop only) -->
        <div class="hidden md:block md:col-span-2">
            <ul class="flex flex-col text-sm font-medium shadow-md">
                <li>
                    <button 
                        :class="activeTab === 'dashboard' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full rounded-t-md gap-2 font-medium"
                        @click="switchTab('dashboard')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                        </svg>
                        Dashboard
                    </button>
                </li>
                <li>
                    <button 
                        :class="activeTab === 'my-orders' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full gap-2 font-medium"
                        @click="switchTab('my-orders')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                        My Orders
                    </button>
                </li>
                <li>
                    <button 
                        :class="activeTab === 'my-vouchers' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full gap-2 font-medium"
                        @click="switchTab('my-vouchers')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>


                        My Vouchers
                    </button>
                </li>
                <li>
                    <button 
                        :class="activeTab === 'my-account' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full rounded-b-md gap-2 font-medium"
                        @click="switchTab('my-account')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                        My Account
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="md:col-span-5 space-y-4" x-data="{ visitedTabs: { 'dashboard': true } }">
            <!-- Tab Dashboard -->
            <div x-show="activeTab === 'dashboard'" x-cloak>
                <template x-if="visitedTabs['dashboard']">
                    <livewire:pages.tabs.dashboard />
                </template>
            </div>

            <!-- Tab My Orders -->
            <div 
                x-show="activeTab === 'my-orders'" 
                x-init="$watch('activeTab', val => { if (val === 'my-orders') visitedTabs['my-orders'] = true })" 
                x-cloak
            >
                <template x-if="visitedTabs['my-orders']">
                    <livewire:pages.tabs.my-orders />
                </template>
            </div>

            <!-- Tab My Vouchers -->
            <div 
                x-show="activeTab === 'my-vouchers'" 
                x-init="$watch('activeTab', val => { if (val === 'my-vouchers') visitedTabs['my-vouchers'] = true })" 
                x-cloak
            >
                <template x-if="visitedTabs['my-vouchers']">
                    <livewire:pages.tabs.my-vouchers />
                </template>
            </div>

            <!-- Tab My Account -->
            <div 
                x-show="activeTab === 'my-account'" 
                x-init="$watch('activeTab', val => { if (val === 'my-account') visitedTabs['my-account'] = true })" 
                x-cloak
            >
                <template x-if="visitedTabs['my-account']">
                    <livewire:pages.tabs.my-account />
                </template>
            </div>
        </div>
    </div>
</div>
