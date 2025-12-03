/////////////////////////
/////////////////////////
/*--- REGISTRATION ---*/
/////////////////////////
/////////////////////////

document.addEventListener('DOMContentLoaded', () => {
  if (typeof productOptions === 'undefined' || !document.body.classList.contains('single-product')) {
    return;
  }

  const form = document.querySelector('form.cart');
  if (!form) {
    return;
  }

  const priceContainer = document.querySelector('p.price span.woocommerce-Price-amount.amount');
  if (!priceContainer) {
    return;
  }

  const basePriceText = priceContainer.innerText.replace(/[^0-9,.-]/g, '').replace(',', '.');
  const basePrice = parseFloat(basePriceText);

  if (isNaN(basePrice)) {
    return;
  }

  const updatePrice = () => {
    const selectedOption = document.querySelector('input[name="registration_option"]:checked');
    if (!selectedOption) {
      return;
    }
    
    const optionPrice = parseFloat(selectedOption.dataset.price) || 0;
    const newPrice = basePrice + optionPrice;

    const newPriceHtml = `<bdi>${newPrice.toLocaleString('pl-PL', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    })}&nbsp;<span class="woocommerce-Price-currencySymbol">${productOptions.currencySymbol}</span></bdi>`;

    priceContainer.innerHTML = newPriceHtml;
  };

  form.addEventListener('change', (event) => {
    if (event.target.name === 'registration_option') {
      updatePrice();
    }
  });

  updatePrice();
});