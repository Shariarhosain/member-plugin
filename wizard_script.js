let currentStep = 1; 

var houseSize=0;
var Dinners=0;

const selectedValues = {
    zipcode: '',
    household: 0,
    dinners: '',
    bundles: [],
    totalPrice: 0,
    grandTotal: 0
};




function goToNextStep() {
    const currentStepElement = document.getElementById(`step-${currentStep}`);
    if (currentStepElement) {
        currentStepElement.classList.add('hidden');
    }

    currentStep++;
    const nextStepElement = document.getElementById(`step-${currentStep}`);
    if (nextStepElement) {
        nextStepElement.classList.remove('hidden');
    }
}


function showLoading() {
    const nextButton = document.getElementById('next-step-1');
    const buttonText = document.getElementById('button-text');
    const buttonSpinner = document.getElementById('button-spinner');
    nextButton.classList.add('button-loading');
    buttonText.textContent = 'Checking...';
    buttonSpinner.classList.remove('hidden');
}

// Hide loading spinner 
function hideLoading() {
    const nextButton = document.getElementById('next-step-1');
    const buttonText = document.getElementById('button-text');
    const buttonSpinner = document.getElementById('button-spinner');
    nextButton.classList.remove('button-loading');
    buttonText.textContent = 'Check';
    buttonSpinner.classList.add('hidden');
}

// Validate ZIP code
function validateZipCode() {
    const zipcodeInput = document.getElementById('zipcode');
    const zipcode = zipcodeInput.value.trim();
    const errorMessage = document.querySelector('.zipcode-error-message') || document.createElement('p');
    errorMessage.className = 'text-red-500 mt-2 zipcode-error-message';

    if (zipcodeInput.parentNode.contains(errorMessage)) {
        errorMessage.remove();
    }


    if (!/^\d{5}$/.test(zipcode)) {
        errorMessage.textContent = 'Please enter a valid 5-digit ZIP code.';
        zipcodeInput.parentNode.appendChild(errorMessage);
        return false;
    }

 
    showLoading();

    // Call API to validate the ZIP code
    fetch(`http://api.zippopotam.us/us/${zipcode}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Invalid ZIP code. Please try again.');
            }
            if (response.status === 404) {
                throw new Error('ZIP code not found. Please try again.');
            }
            return response.json();
        })
        .then(data => {

         
        
            selectedValues.zipcode = zipcode; 
            goToNextStep();
        })
        .catch(error => {
         
            errorMessage.textContent = error.message;
            zipcodeInput.parentNode.appendChild(errorMessage);
        })
        .finally(() => {
           
            hideLoading();
        });

    return true;
}

document.addEventListener('DOMContentLoaded', function () {
    const nextButton = document.getElementById('next-step-1');
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            validateZipCode(); 
        });
    }
});

// Step 2: Household option selection

    function selectHouseholdOption(option) {
   
        const options = document.querySelectorAll(".option");
        options.forEach(opt => {
            opt.classList.remove("bg-gray-200", "text-gray-800", "border-gray-400");
            opt.removeAttribute("style");
        });
        option.style.transition = "all 0.3s ease";
       option.style.backgroundColor = "orange";
        option.style.border = "transparent 2px solid black";
        option.style.color = "black";
        option.style.fontWeight = "bold";
        option.style.fontSize = "1.2rem";
   
      
        const nextButton = document.getElementById("next-step-2");
        nextButton.removeAttribute("disabled");
        nextButton.classList.remove('cursor-not-allowed', 'hidden'); 

  
        const selectedHousehold = option.getAttribute("data-household");
        selectedValues.household = selectedHousehold; 

      
        const householdInput = document.getElementById("selected-household");
        if (householdInput) {
            householdInput.value = selectedHousehold;
        } else {
         
            window.selectedHousehold = selectedHousehold;
        }

       
    }


    document.querySelectorAll(".option").forEach(item => {
        item.addEventListener("click", function () {
            selectHouseholdOption(this);
        });
    });


    const nextButton2 = document.getElementById("next-step-2");
    nextButton2.addEventListener("click", function () {
        console.log("Next Step! Selected Household Size:", selectedValues.household);
        houseSize=selectedValues.household;
        const householdSpan = document.getElementById("household-size");
householdSpan.textContent = houseSize; 

        goToNextStep();
    });


// Step 3: Dinner option selection
 
    function selectDinnerOption(option) {
      
        const options2 = Array.from(document.getElementsByClassName("option2"));
        options2.forEach(opt => {
            opt.classList.remove("bg-gray-200", "text-gray-800", "border-gray-400");
            opt.removeAttribute("style");
        });
 
        option.style.transition = "all 0.3s ease";
        option.style.backgroundColor = "orange";
        option.style.border = "transparent 2px solid black";
        option.style.color = "black";
        option.style.fontWeight = "bold";

     

 
        const selectedDinners = option.getAttribute("data-dinners");
        selectedValues.dinners = selectedDinners; 
if (selectedDinners) {
     
       const nextButton = document.getElementById("next-step-3");
       nextButton.removeAttribute("disabled");
       nextButton.classList.remove('cursor-not-allowed');  
       nextButton.classList.remove('hidden'); 
       
     
}
        
        updateDiscounts(selectedDinners);


        const discountField = document.getElementById('selected-dinners');
        discountField.value = selectedDinners;
    }

    function updateDiscounts(selectedDinners) {
        const discountMessages = document.querySelectorAll('.discount-message');
        discountMessages.forEach(message => {
            message.style.display = 'none';
        });


        let discountText = '';
        if (selectedDinners === "6") {
            document.getElementById('discount-6').innerHTML = '';
            document.getElementById('discount-5').innerHTML = '';
            document.getElementById('discount-4').innerHTML = '';
            document.getElementById('discount-3').innerHTML = '';
        } else if (selectedDinners === "5") {
            document.getElementById('discount-6').innerHTML = 'SAVE 10% PER MEAL';
            document.getElementById('discount-4').innerHTML = '';
            document.getElementById('discount-5').innerHTML = '';
            document.getElementById('discount-3').innerHTML = '';
        } else if (selectedDinners === "4") {
            document.getElementById('discount-6').innerHTML = 'SAVE 22% PER MEAL';
            document.getElementById('discount-5').innerHTML = 'SAVE 13% PER MEAL';
            document.getElementById('discount-4').innerHTML = '';
            document.getElementById('discount-3').innerHTML = '';

        } else if (selectedDinners === "3") {
            document.getElementById('discount-6').innerHTML = 'SAVE 33% PER MEAL';
            document.getElementById('discount-5').innerHTML = 'SAVE 26% PER MEAL';
            document.getElementById('discount-4').innerHTML = 'SAVE 15% PER MEAL';
            document.getElementById('discount-3').innerHTML = '';
        }


        const discountField = document.getElementById('selected-dinners');
        if (selectedDinners === "6") {
            discountText = ''; 
        } else if (selectedDinners === "5") {
            discountText = 'SAVE 10% PER MEAL';
        } else if (selectedDinners === "4") {
            discountText = 'SAVE 22% PER MEAL';
        } else if (selectedDinners === "3") {
            discountText = 'SAVE 33% PER MEAL';
        }

        discountField.value = discountText;
    }

    document.querySelectorAll(".option").forEach(item => {
        item.addEventListener("click", function () {
            selectDinnerOption(this); 
        });
    });


    const nextButton3 = document.getElementById("next-step-3");
    nextButton3.addEventListener("click", function () {
        console.log("Next Step! Selected Dinners:", selectedValues.dinners);
        Dinners=selectedValues.dinners;
const dinnersSpan = document.getElementById("Dinners-size");
dinnersSpan.innerHTML = selectedValues.dinners;

        goToNextStep();
    });



// Step 4: Bundle option selection

    const bundleCheckboxes = document.querySelectorAll(".bundle-checkbox");
    const totalPriceDisplay = document.getElementById("total-price-display");
    const grandp = document.getElementById("grand-total-display");

    bundleCheckboxes.forEach(checkbox => {
        checkbox.style.transition = "all 0.3s ease";
        checkbox.style.backgroundColor = "orange";
        checkbox.style.border = "transparent 2px solid black";
        checkbox.style.color = "black";

    });



    bundleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
  
            const price = parseFloat(this.getAttribute("data-price"));

            if (this.checked) {
    const nextButton = document.getElementById("next-step-4");
    nextButton.removeAttribute("disabled");
    nextButton.classList.remove('cursor-not-allowed');  
    nextButton.classList.remove('hidden'); 
                selectedValues.bundles.push(this.value);
                selectedValues.totalPrice += price;
 

            } else {
              
                selectedValues.bundles = selectedValues.bundles.filter(bundle => bundle !== this.value);
                selectedValues.totalPrice -= price;
            }
            selectedValues.grandTotal = selectedValues.totalPrice * houseSize;

      
            totalPriceDisplay.textContent = `Total Price: $${selectedValues.totalPrice.toFixed(2)}`;
            grandp.textContent = `Grand Total: $${selectedValues.grandTotal.toFixed(2)}`;

            if (selectedValues.bundles.length > 0) {
                nextButton.removeAttribute("disabled");
            } else {
                nextButton.setAttribute("disabled", "true");
            }
        });
    });


const nextButton = document.getElementById("next-step-4");
nextButton.addEventListener("click", function () {

    const bundlesSpan = document.getElementById("bundles-selected");
    bundlesSpan.innerHTML = selectedValues.bundles.join(", ");

    const totalPriceSpan = document.getElementById("total-price");
    totalPriceSpan.textContent = selectedValues.grandTotal.toFixed(2); 

    goToNextStep();
});

            


function populateHiddenFields() {
    document.getElementById('input-household').value = houseSize;
    document.getElementById('input-dinners').value = Dinners;

    const bundlePrices = {
        'breakfast': 20,
        'lunch': 30,
        'kids': 20,
        'pressed_juice': 24
    };
    if (!Array.isArray(selectedValues.bundles)) {
        selectedValues.bundles = [];
    }

    const selectedBundles = selectedValues.bundles.map(bundle => {
        if (bundlePrices[bundle]) {
            return {
                name: bundle,
                price: bundlePrices[bundle]
            };
        }
        return null;
    }).filter(bundle => bundle !== null); 

    const formattedBundles = selectedBundles.map(bundle => `\n${bundle.name} : $${bundle.price}`).join(', ');

    document.getElementById('input-bundles').value = formattedBundles;

    document.getElementById('input-totalPrice').value = selectedValues.grandTotal.toFixed(2);


      //send data to  post 
}



// Function to go back to the previous step
function backToPreviousStep() {
    // Hide the current step
    const currentStepElement = document.getElementById(`step-${currentStep}`);
    if (currentStepElement) {
        currentStepElement.classList.add('hidden');
    }
    
    // Decrement the current step index
    currentStep--;
    
    // Show the previous step
    const previousStepElement = document.getElementById(`step-${currentStep}`);
    if (previousStepElement) {
        previousStepElement.classList.remove('hidden');
    }
}

// Optionally, call a function on page load to show the correct step
window.onload = function() {
    const currentStepElement = document.getElementById(`step-${currentStep}`);
    if (currentStepElement) {
        currentStepElement.classList.remove('hidden');
    }
};

