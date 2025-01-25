const ShippingManager = {
    init() {
        this.addressForm = document.getElementById('address-form');
        this.shippingOptionsContainer = document.getElementById('shipping-options');
   
        if (this.addressForm) {
            this.addressForm.addEventListener('submit', this.handleAddressSubmit.bind(this));
        }
    },

    async handleAddressSubmit(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const address = {
            city: formData.get('city'),
        };
        
        await this.fetchShippingOptions(address);
    },

    async fetchShippingOptions(address) {
        try {
            const requestData = {
                weight: "3",  // Default weight
                originCity: "Riyadh",  // Origin city
                destinationCity: address.city,
                height: 30,
                width: 30,
                length: 30
            };
            
            console.log('Sending request with data:', requestData);
            
            const response = await fetch('/shipping-options', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(requestData)
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            const data = await response.json();
            console.log('Response data:', data);
    
            if (data.success) {
                this.renderShippingOptions(data.data.deliveryOptions);
            } else {
                throw new Error(data.message || 'Failed to get shipping options');
            }
        } catch (error) {
            console.error('Error details:', error);
            this.showError('Failed to fetch shipping options: ' + error.message);
        }
    },

    renderShippingOptions(options) {
        if (!options || options.length === 0) {
            this.shippingOptionsContainer.innerHTML = '<p class="alert alert-info">No shipping options available for this location.</p>';
            return;
        }
    
        this.shippingOptionsContainer.innerHTML = options.map(option => `
            <div class="shipping-option card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        ${option.logo ? `<img src="${option.logo}" alt="${option.deliveryCompanyName}" height="40" class="me-2">` : ''}
                        <h5 class="card-title mb-0">${option.deliveryOptionName}</h5>
                    </div>
                    <p class="card-text">
                        <strong>Price:</strong> ${option.price} ${option.currency}<br>
                        <strong>Delivery Time:</strong> ${option.avgDeliveryTime}<br>
                        ${option.maxFreeWeight ? `<strong>Max Free Weight:</strong> ${option.maxFreeWeight}kg<br>` : ''}
                        ${option.codCharge ? `<strong>COD Charge:</strong> ${option.codCharge} ${option.currency}<br>` : ''}
                    </p>
                    <button 
                        class="btn btn-primary select-shipping" 
                        data-option-id="${option.deliveryOptionId}"
                        onclick="ShippingManager.selectShippingOption(${option.deliveryOptionId})"
                    >
                        Select
                    </button>
                </div>
            </div>
        `).join('');
    },

    selectShippingOption(deliveryOptionId) {
        // Remove previous selection
        const previousSelected = document.querySelector('.shipping-option.selected');
        if (previousSelected) {
            previousSelected.classList.remove('selected');
        }

        // Add selection to current option
        const currentOption = document.querySelector(`[data-option-id="${deliveryOptionId}"]`)
            .closest('.shipping-option');
        currentOption.classList.add('selected');

        // Store selection
        localStorage.setItem('selectedShippingOption', deliveryOptionId);

        // Enable proceed to payment button
        const proceedButton = document.getElementById('proceed-to-payment');
        if (proceedButton) {
            proceedButton.disabled = false;
        }
    },

    showError(message) {
        alert(message);
    }
};

// Initialize the shipping manager when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    ShippingManager.init();
});