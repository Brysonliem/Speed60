<footer class="bg-gray-900 text-white py-10 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8">

            <!-- About Us -->
            <div class="space-y-2">
                <h2 class="font-bold text-xl">About Us</h2>
                <ul class="space-y-4">
                    <li><a href="{{ route('about.our-story') }}" class="hover:underline">Our Story</a></li>
                    <li><a href="{{ route('about.wholesale') }}" class="hover:underline">Wholesale</a></li>
                    <li><a href="{{ route('about.our-store') }}" class="hover:underline">Our Store</a></li>
                    <li><a href="{{ route('about.reviews') }}" class="hover:underline">Reviews</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="space-y-2">
                <h3 class="font-bold text-xl">Contact Us</h3>
                <ul class="space-y-4">
                    <li>0821-3345-9876</li>
                    <li>JL Pangeran Tubagus Angke No 20, Ruko Angke Megah Blok B 15-16</li>
                    <li>Speed60@gmail.com</li>
                </ul>
            </div>

            <!-- Legal -->
            <div class="space-y-2">
                <h3 class="font-bold text-xl">Legal</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('policies.terms') }}" class="hover:underline">Terms and Conditions</a></li>
                    <li><a href="{{ route('policies.shipping') }}" class="hover:underline">Shipping Information</a></li>
                    <li><a href="{{ route('policies.refund') }}" class="hover:underline">Refund Policy</a></li>
                    <li><a href="{{ route('policies.privacy') }}" class="hover:underline">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Links -->
            <div class="space-y-2">
                <h3 class="font-bold text-xl">Links</h3>
                <ul class="space-y-4">
                    @if (Auth::check())
                        @php
                            $dashboardRoute = match (Auth::user()->role->level) {
                                1 => route('dashboard.superadmin'),
                                2 => route('dashboard.admin'),
                                default => route('dashboard.user'),
                            };
                        @endphp
                        <li><a href="{{ $dashboardRoute }}" class="hover:underline">Home</a></li>
                    @endif
                    <li><a href="{{ route('cart') }}" class="hover:underline">Cart</a></li>
                    <li><a href="{{ route('support') }}" class="hover:underline">Customer Service</a></li>
                    <li><a href="{{ route('track_order') }}" class="hover:underline">Orders</a></li>
                </ul>
            </div>

            <!-- Ikuti Kami -->
            <div class="lg:col-span-2 space-y-4 bg-white lg:bg-transparent rounded-lg p-4 lg:p-0">
                <h3 class="font-bold text-sm text-black lg:text-white">Follow us</h3>
                <p class="text-black sm:text-white">Sign up below to get news about our latest sales and releases!</p>
                <div class="flex items-center gap-2 my-3">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path
                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                        </div>
                        <input type="text" id="email-address-icon"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                            placeholder="youremail@gmail.com" />
                    </div>
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Join</button>
                </div>

                <ul class="grid grid-cols-3 gap-5 items-center">
                    <li>
                        <a href="https://www.tokopedia.com" target="_blank" rel="noopener noreferrer">
                            <img src="https://images.tokopedia.net/assets-tokopedia-lite/v2/zeus/production/e5b8438b.svg"
                                alt="Tokopedia" class="w-full h-auto" />
                        </a>
                    </li>
                    <li>
                        <a href="https://shopee.co.id" target="_blank" rel="noopener noreferrer">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/2560px-Shopee.svg.png"
                                alt="Shopee" class="w-full h-auto" />
                        </a>
                    </li>
                </ul>
            </div>


            



            


        </div>
    </div>
</footer>
