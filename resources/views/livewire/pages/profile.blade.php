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
                <template x-for="tab in ['dashboard', 'my-orders', 'my-account']" :key="tab">
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
                        class="inline-flex items-center px-4 py-3 w-full rounded-t-md"
                        @click="switchTab('dashboard')"
                    >
                        Dashboard
                    </button>
                </li>
                <li>
                    <button 
                        :class="activeTab === 'my-orders' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full"
                        @click="switchTab('my-orders')"
                    >
                        My Orders
                    </button>
                </li>
                <li>
                    <button 
                        :class="activeTab === 'my-account' ? 'text-white bg-red-600' : 'bg-gray-50 hover:bg-gray-100 text-gray-600'" 
                        class="inline-flex items-center px-4 py-3 w-full rounded-b-md"
                        @click="switchTab('my-account')"
                    >
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
