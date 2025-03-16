<?php
/*
Plugin Name: Membership Plugin
Description: A simple Membership Plugin to manage user memberships
Version:     2.0
Author:      Sanny
*/

function wizard_enqueue_scripts() {
    wp_enqueue_style('tailwindcss', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css');
    wp_enqueue_style('my-custom-plugin-style', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('my-custom-plugin-script', plugin_dir_url(__FILE__) . 'wizard_script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'wizard_enqueue_scripts');



function wizard_shortcode() {

    ob_start();
    ?>
    <div class=" bg-gray-100 min-h-screen flex flex-col justify-center items-center">
        <div class="m-6">
            <h1 class="text-4xl font-semibold text-center text-gray-800">Build Your Personalized Plan</h1>
        </div>

        <!-- Step 1: ZIP Code -->
        <div id="step-1" class="step active max-w-lg w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-center">Enter ZIP Code</h2>
            <div class="m-6">
                <input type="text" id="zipcode" name="zipcode" placeholder="Enter ZIP Code" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="m-2">
                <!-- Error message container -->
                <p class="zipcode-error-message text-red-500 mt-2 hidden"></p>
            </div>
            <button type="button" id="next-step-1" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                <span id="button-text">Check</span> 
                <div id="button-spinner" class="spinner hidden"></div> <!-- Loading spinner inside the button -->
            </button>
            <p class="text-center text-gray-500 mt-4">Let's confirm that we can deliver to your area</p>
        </div>

    <!-- Step 2: Household Options -->
<div id="step-2" class="step hidden">
    <div class="bg-white shadow-lg rounded-lg mx-auto mt-20 p-8">
        <div class="text-center">
            <p class="text-gray-600 mt-2">Great news! We deliver to your area!</p>
        </div>

        <div class="mt-10 text-center">
            <h2 class="text-2xl font-semibold text-gray-800">How big is your household?</h2>
        </div>

    <!-- Household Options -->
    <div class="flex justify-center space-x-8 mt-6">
        <!-- Singles Option -->
        <div class="option flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-household="1" onclick="selectHouseholdOption(this)">
            <div class="bg-gray-100 p-4 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 64 32" class="h-6 sm:h-5" role="presentation"><path fill="#2C2C2C" d="M38.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.025.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM29.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.829-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16z"></path></svg>
            </div>
            <p class="text-2xl font-bold text-gray-800">SINGLES</p>
<div class="text-center"> <p class="text-base   text-gray-800 mt-1">Dinners <br> prepared for 1</p></div>

        </div>

        <!-- Couples Option -->
        <div class="option flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-household="2" onclick="selectHouseholdOption(this)">
            <div class="bg-gray-100 p-4 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 64 32" class="h-6 sm:h-5" role="presentation"><path fill="#2C2C2C" d="M46.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.026.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM37.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.829-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16zM30.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.025.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM21.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.828-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16z"></path></svg>
            </div>
            <p class="text-2xl font-bold text-gray-800"> COUPLE</p>
            <div class="text-center"> <p class="text-base  text-gray-800 mt-1">Dinners <br> prepared for 2</p> </div>    

        </div>

        <!-- Family Option -->
        <div class="option flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-household="4" onclick="selectHouseholdOption(this)">
            <div class="bg-gray-100 p-4 rounded-full mb-4">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 64 32" class="h-6 sm:h-5" role="presentation"><path fill="#2C2C2C" d="M50.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.026.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM41.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.829-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16zM34.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.025.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM25.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.828-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16zM18.342 20.94a7 7 0 0 0-.157-.695c-.034-.123-.067-.245-.112-.367a6 6 0 0 0-.46-.973 5 5 0 0 0-.297-.45.7.7 0 0 0-.079-.095 6 6 0 0 0-.628-.712 6.3 6.3 0 0 0-.846-.684 6 6 0 0 0-.668-.383 6.7 6.7 0 0 0-1.934-.645 7 7 0 0 0-1.155-.1c-2.187 0-4.15 1.028-5.31 2.624a5.66 5.66 0 0 0-1.027 2.485l-.65 4.22q-.025.183-.017.356c.04.584.404 1.09.92 1.329.207.094.437.15.684.15h10.783c.291 0 .555-.083.785-.211.067-.04.129-.073.19-.117.18-.134.331-.306.438-.506.163-.295.235-.645.18-1.006l-.651-4.22zM9.746 13.328a4.04 4.04 0 0 0 2.26.684 4.1 4.1 0 0 0 2.573-.912c.191-.156.36-.328.516-.511a3.784 3.784 0 0 0 .634-1.018c.202-.478.32-1.006.32-1.562s-.113-1.079-.32-1.563c-.101-.239-.23-.467-.37-.678a4.46 4.46 0 0 0-.78-.85 4 4 0 0 0-.745-.479 4 4 0 0 0-1.828-.433 4.04 4.04 0 0 0-2.86 1.173 3.988 3.988 0 0 0 .6 6.16zM57 17v2h-2v-2h-2v-2h2v-2h2v2h2v2z"></path></svg>
            </div>
            <p class="text-2xl font-bold text-gray-800">FAMILY</p>
            <div class="text-center"> <p class="text-base text-gray-800  mt-1">Dinners <br> prepared for 4</p> </div>   

        </div>
    </div>

        <div class="mt-8 text-center">
            <!-- "Next" Button for Step 2 -->
  
<button type="button" id="next-step-2" class=" bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 hidden cursor-not-allowed" disabled>
    <span id="button-text-2">Next</span>
    <div id="button-spinner-2" class="spinner hidden"></div> <!-- Loading spinner inside the button -->
</button>

        </div>

        <!-- Back Link to ZIP Code Entry -->
<div class="mt-8 text-center">
    <h2>
        <button class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 ease-in-out" onclick="backToPreviousStep()">
            Back to ZIP Code Entry
        </button>
    </h2>
</div>
    </div>
</div>
<!-- Dinners Selection Section -->
<div id="step-3" class="step hidden">
    <div class="bg-white shadow-lg rounded-lg mx-auto mt-20 p-8">
        <div class="text-center">
            <p class="text-gray-600 mt-2">Choose the number of dinners per week.</p>
        </div>

        <div class="mt-10 text-center">
            <h2 class="text-2xl font-semibold text-gray-800">How many dinners per week?</h2>
        </div>

        <!-- Dinner Options -->
        <div class="flex justify-center space-x-6 mt-8">
            <!-- 6 Dinners Option -->
            <div class="option2 flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-dinners="6" onclick="selectDinnerOption(this)">
                <p class="text-6xl font-bold text-gray-800">6</p>
                <p class="text-sm text-gray-600 ">Dinners per week</p>
                <p id="discount-6" class="text-sm text-green-600 mt-2"></p>
            </div>

            <!-- 5 Dinners Option -->
            <div class="option2 flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-dinners="5" onclick="selectDinnerOption(this)">
                <p class="text-6xl font-bold text-gray-800">5</p>
                <p class="text-sm text-gray-600 ">Dinners per week</p>
                <p id="discount-5" class="text-sm text-green-600 mt-2"></p>
            </div>

            <!-- 4 Dinners Option -->
            <div class="option2 flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-dinners="4" onclick="selectDinnerOption(this)">
                <p class="text-6xl font-bold text-gray-800">4</p>
                <p class="text-sm text-gray-600 ">Dinners per week</p>
                <p id="discount-4" class="text-sm text-green-600 mt-2"></p>
            </div>

            <!-- 3 Dinners Option -->
            <div class="option2 flex flex-col items-center bg-white p-8 rounded-lg shadow-xl cursor-pointer hover:bg-gray-50 border border-transparent transition-transform transform hover:scale-105" data-dinners="3" onclick="selectDinnerOption(this)">
                <p class="text-6xl font-bold text-gray-800">3</p>
                <p class="text-sm text-gray-600 ">Dinners per week</p>
                <p id="discount-3" class="text-sm text-green-600 mt-2"></p>
            </div>
        </div>

        <!-- Hidden input field to store selected dinners -->
        <input type="hidden" id="selected-dinners">

        <!-- Next Button -->
        <div class="mt-8 text-center">
            <button type="button" id="next-step-3" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 hidden cursor-not-allowed" disabled>
                <span id="button-text-3">Next</span>
                <div id="button-spinner-3" class="spinner hidden"></div>
            </button>
        </div>

        <!-- Navigation -->
        <div class="mt-8 text-center">
    <h2>
        <button class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 ease-in-out" onclick="backToPreviousStep()">
            Back to Household Selection
        </button>
    </h2>
</div>
    </div>
</div>

<!-- Bundle Selection Section -->
<div id="step-4" class="step hidden">
    <div class="bg-white shadow-lg rounded-lg mx-auto mt-20 p-8">
        <div class="text-center">
            <p class="text-gray-600 mt-2">Choose the bundles you'd like to include in your plan.</p>
        </div>

        <div class="mt-10 text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Select Bundles</h2>
        </div>
        

        <div class="flex flex-wrap justify-center space-x-8 mt-6 w-full max-w-4xl">
            <!-- Breakfast -->
            <div class="bundle-option mt-8 w-sm flex flex-col items-center bg-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 border border-transparent transition duration-300 ease-in-out transform hover:scale-105">
                <input type="checkbox" name="bundles[]" value="breakfast" class="bundle-checkbox mb-2 w-6 h-6" data-price="20"/>
                <p class="text-xl font-semibold text-gray-800">BREAKFAST</p>
                <p class="text-sm text-gray-500">3 ITEMS</p>
                <p class="text-sm text-gray-500">$20</p>
            </div>

            <!-- Lunch -->
            <div class="bundle-option w-sm  mt-8 flex flex-col items-center bg-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 border border-transparent transition duration-300 ease-in-out transform hover:scale-105">
                <input type="checkbox" name="bundles[]" value="lunch" class="bundle-checkbox mb-2 w-6 h-6" data-price="30"/>
                <p class="text-xl font-semibold text-gray-800">LUNCH</p>
                <p class="text-sm text-gray-500">3 ITEMS</p>
                <p class="text-sm text-gray-500">$30</p>
            </div>

            <!-- Kids -->
            <div class="bundle-option w-sm  mt-8 flex flex-col items-center bg-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 border border-transparent transition duration-300 ease-in-out transform hover:scale-105">
                <input type="checkbox" name="bundles[]" value="kids" class="bundle-checkbox mb-2 w-6 h-6" data-price="20"/>
                <p class="text-xl font-semibold text-gray-800">KIDS</p>
                <p class="text-sm text-gray-500">3 ITEMS</p>
                <p class="text-sm text-gray-500">$20</p>
            </div>

            <!-- Pressed Juice -->
            <div class="bundle-option w-sm mt-8  flex flex-col items-center bg-white p-6 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 border border-transparent transition duration-300 ease-in-out transform hover:scale-105">
                <input type="checkbox" name="bundles[]" value="pressed_juice" class="bundle-checkbox mb-2 w-6 h-6" data-price="24"/>
                <p class="text-xl font-semibold text-gray-800">PRESSED JUICE</p>
                <p class="text-sm text-gray-500">3 ITEMS</p>
                <p class="text-sm text-gray-500">$24</p>
            </div>
        </div>

      <!-- Total Price Display -->
<div class="mt-8 text-center">
    <p class="text-xl font-semibold text-gray-800" id="total-price-display">Total Price: $0</p>
</div>

<!-- Grand Total Price Display -->
<div class="mt-8 text-center">
    <p class="text-xl font-semibold text-gray-800" id="grand-total-display">Grand Total Price: $0</p>
</div>

        <!-- Submit Button -->
        <div class="mt-8 text-center">
            <button type="button" id="next-step-4" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 hidden cursor-not-allowed" disabled>
                <span id="button-text-4">Next</span>
                <div id="button-spinner-4" class="spinner hidden"></div>
            </button>
        </div>
        <!-- Navigation -->
        <div class="mt-8 text-center">
    <h2>
        <button class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 ease-in-out" onclick="backToPreviousStep()">
            Back to Dinners Selection
        </button>
    </h2>
</div>
    </div>
</div>



<!-- Summary Section -->

<div id="step-5" class="step hidden">
<div class="bg-white shadow-lg rounded-lg mx-auto mt-20 p-8 max-w-xl">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Summary</h2>
            <p class="text-gray-600 mt-2">Review your selections before placing your order.</p>
        </div>

        <div class="mt-8">
            <div class="text-lg font-semibold text-gray-800 mb-2">Household</div>
            <div class="bg-gray-50 border rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600">Household Size: <span id="household-size" class="font-medium text-gray-800"></span></p>
            </div>
            <div class="text-lg font-semibold text-gray-800 mb-2">Dinners Per Week</div>
            <div class="bg-gray-50 border rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600">Meals Delivered: <span id="Dinners-size" class="font-medium text-gray-800"></span></p>
            </div>

            <div class="text-lg font-semibold text-gray-800 mb-2">Selected Bundles</div>
            <div class="bg-gray-50 border rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600">Bundles: <span id="bundles-selected" class="font-medium text-gray-800"></span></p>
            </div>

            <div class="text-lg font-semibold text-gray-800 mb-2">Total Price</div>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 mb-6">
                <p class="text-xl font-semibold text-gray-800">Total: $<span id="total-price" class="text-2xl font-bold text-yellow-600"></span></p>
            </div>
        </div>

      <div class="text-center">
        <h2 class="text-2xl font-semibold text-gray-800">Ready to place your order?</h2>
        <p class="text-gray-600 mt-2">Click the button below to proceed to checkout.</p>
       
      <form method="POST">
            <!-- Hidden inputs to send values from corresponding spans -->
            <input type="hidden" name="household" id="input-household" >
            <input type="hidden" name="dinners" id="input-dinners" >
            <input type="hidden" name="bundles" id="input-bundles" >
            <input type="hidden" name="totalPrice" id="input-totalPrice">

            <button type="submit" id="add-to-cart" name="save_membership" onclick="populateHiddenFields()" class=" text-center bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 mt-8 text-center">
                Add to cart 
            </button>
        </form>
        </div>

        <!-- Navigation -->
    
        <div class="mt-8 text-center">
    <h2>
        <button class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 ease-in-out" onclick="backToPreviousStep()">
            Back to Bundle Selection
        </button>
        
    </h2>
</div>

       
    </div> 

</div>


    </div>
    <?php
if (isset($_POST['save_membership'])) {

    ob_start(); // Start output buffering

    $unique_id = time();
    $product = new WC_Product_Simple();
   
    // Set product details
    $product->set_name('Member Plan - Household Size: ' . $_POST['household'] . ' Dinners per Week: ' . $_POST['dinners'] . ' Bundles: ' . $_POST['bundles']);
    $product->set_regular_price($_POST['totalPrice']);
    $product->set_sku('member-plan-' . $_POST['household'] . '-' . $_POST['dinners'] . '-' . $unique_id);
    $product->set_catalog_visibility('hidden');

    // Set product description
    $description = "Household Size: " . $_POST['household'] . "\n";
    $description .= "Dinners per Week: " . $_POST['dinners'] . "\n";
    $description .= "Selected Bundles: " . $_POST['bundles'] . "\n";
    $description .= "Total Price: $" . $_POST['totalPrice'];
    $product->set_description($description);

    // Save product
    $product->save();

    // Add the product to the WooCommerce cart
    if ( WC()->cart ) {
        WC()->cart->add_to_cart( $product->get_id() );
    }
    unset($_POST['save_membership']);
  
    $checkout_url = wc_get_checkout_url();

    $checkout_link = '<a href="' . $checkout_url . '" class="button wc-forward">Proceed to Checkout</a>';

    echo '<div class="woocommerce-message">';
    echo 'Product has been added to cart. ' . ' ' . $checkout_link;
    echo '</div>';

    
}




  
    return ob_get_clean();
}
add_shortcode('member_sanny', 'wizard_shortcode');

?>