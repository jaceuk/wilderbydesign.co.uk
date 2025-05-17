/*********************/
/* VARIATION BUTTONS */
/*********************/
// hook variations buttons up to the original select lists
const colorVariationName = 'color';
const colorAttributeName = 'attribute_pa_color';
const sizeVariationName = 'size';
const sizeAttributeName = 'attribute_pa_size';

const variationButtons = document.querySelectorAll('.variation-button');

function updateLabels() {
  const colorsLabel = document.querySelector(
    `.label[data-variation="${colorVariationName}"]`
  );
  const selectedColorButton = document.querySelector(
    `.variation-button.selected[data-name="${colorAttributeName}"]`
  );
  const selectedColor = selectedColorButton.dataset.value;
  const colorSpan = document.createElement('span');
  colorSpan.classList.add('selected-colour');

  if (selectedColorButton) {
    colorSpan.innerText = selectedColor;
  }

  const sizesLabel = document.querySelector(
    `.label[data-variation="${sizeVariationName}"]`
  );
  const selectedSizeButton = document.querySelector(
    `.variation-button.selected[data-name="${sizeAttributeName}"]`
  );
  const sizeSpan = document.createElement('span');
  sizeSpan.classList.add('selected-size');

  if (selectedSizeButton) {
    sizeSpan.innerText = selectedSizeButton.dataset.value;
  }

  let selectedSize;
  if (selectedSizeButton) selectedSize = selectedSizeButton.dataset.value;

  if (colorsLabel) {
    colorsLabel.innerText = 'Color: ';
    colorsLabel.appendChild(colorSpan);

    sizesLabel.innerText = 'Size: ';
    sizesLabel.appendChild(sizeSpan);
  }
}

variationButtons.forEach((variationButton) => {
  const variationName = variationButton.dataset.name;
  const variationValue = variationButton.dataset.value;
  const select = document.querySelector(
    'select[name = "' + variationName + '"]'
  );

  // select the button if the variation is preselected on load
  if (variationValue === select.value) {
    variationButton.classList.add('selected');
    updateLabels();
  }

  variationButton.addEventListener('click', function () {
    // stop button from submitting the form
    event.preventDefault();

    // clear selected class from all variation buttons
    variationButtons.forEach((variationButton) => {
      const name = variationButton.dataset.name;

      if (name === variationName) {
        variationButton.classList.remove('selected');
      }
    });

    // add selected class to selected variation
    variationButton.classList.add('selected');

    // chage the select list to match the selected variation
    select.value = variationValue;
    // trigger the change event on the select list to update the ui
    jQuery(select).trigger('change');

    // update label with selected variation
    const variationLabels = document.querySelectorAll('.label');
    variationLabels.forEach((variationLabel) => {
      const variationLabelText = variationLabel.innerText.toLowerCase();
      const trimmedVariationName = variationName.replace('attribute_pa_', '');
      let trimmedVariationValue = variationValue.replace(/-/g, ' ');

      if (trimmedVariationName === 'size')
        trimmedVariationValue = trimmedVariationValue.toUpperCase();

      if (variationLabelText.includes(trimmedVariationName)) {
        variationLabel.innerText =
          trimmedVariationName + ': ' + trimmedVariationValue;
        variationLabel.classList.add('selected');
      }
    });

    updateLabels();
  });
});
