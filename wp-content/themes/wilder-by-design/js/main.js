/********************/
/* NEWSLETTER DIALOG */
/********************/
function closeNewsletterDialog() {
  newsletterDialog.close();
  document.body.classList.remove('dialog-visible');

  // add cookie when newsletter popup has been dismissed
  const daysTilCookieExpires = 14;
  const today = new Date();
  let expire = new Date();
  expire.setTime(today.getTime() + 3600000 * 24 * daysTilCookieExpires);
  document.cookie =
    'newsletter_dismissed=true; expires="' + expire.toGMTString();
  +'";';

  console.log(expire.toGMTString());
}

const newsletterDialog = document.querySelector('#newsletter-dialog');
const newsletterCloseButton = document.querySelector(
  '#newsletter-dialog .newsletter-dialog-close-button'
);

// get newsletterDismissed cookie
const hasNewsletterBeenDismissed = document.cookie
  .split('; ')
  .find((row) => row.startsWith('newsletter_dismissed='))
  ?.split('=')[1];

// open the dialog if it hasn't been dismissed within the past daysTilCookieExpires days
// the newsletter_dismissed cookie should exist
if (!hasNewsletterBeenDismissed) {
  setTimeout(() => {
    newsletterDialog.showModal();
    document.body.classList.add('dialog-visible');
  }, 10000);
}

// "Close" button closes the dialog
newsletterCloseButton.addEventListener('click', () => {
  closeNewsletterDialog();
});

// Check for click in backdrop
// https://utilitybend.com/blog/a-lot-of-power-with-little-javascript-the-html-dialog-element-is-here/
newsletterDialog.addEventListener('click', (e) => {
  if (e.target.classList.contains('newsletter-dialog')) {
    closeNewsletterDialog();
  }
});

/*****************/
/* COOKIE BANNER */
/*****************/
let cookieConsent = localStorage.getItem('cookieConsent') || false;
const cookieNotice = document.querySelector('#cookie-notice');
const acceptButton = document.querySelector('#cookie-button');

acceptButton?.addEventListener('click', acceptCookies);

function acceptCookies() {
  localStorage.setItem('cookieConsent', 'true');
  cookieNotice.remove();
}

if (cookieConsent) {
  cookieNotice.remove();
} else {
  cookieNotice.classList.remove('hidden');
}

/********************/
/* MOBILE MENU */
/********************/
const mobileMenuOpenButton = document.querySelector('#mobile-menu-open-button');
const mobileMenu = document.querySelector('#mobile-menu');
const mobileMenuCloseButton = document.querySelector(
  '#mobile-menu-close-button'
);

mobileMenuOpenButton.addEventListener('click', () => {
  mobileMenu.showModal();
  document.body.classList.add('dialog-visible');
});

mobileMenuCloseButton.addEventListener('click', () => {
  mobileMenu.close();
  document.body.classList.remove('dialog-visible');
});

/**************************/
/* DESKTOP MENU DROPDOWNS */
/**************************/
const dropDownTrigers = document.querySelectorAll('.drop-down-trigger');
const dropDownMenus = document.querySelectorAll('.drop-down');

dropDownTrigers.forEach((el) =>
  el.addEventListener('click', (el) => {
    event.preventDefault();

    if (el.target.nextElementSibling.classList.contains('hidden')) {
      dropDownTrigers.forEach((el) => {
        el.nextElementSibling.classList.add('hidden');
      });

      el.target.nextElementSibling.classList.toggle('hidden');
    } else {
      el.target.nextElementSibling.classList.add('hidden');
    }
  })
);

document.onclick = function (e) {
  if (
    !e.target.classList.contains('drop-down') &&
    !e.target.classList.contains('drop-down-trigger')
  ) {
    dropDownMenus.forEach((el) => {
      el.classList.add('hidden');
    });
  }
};

// personalisation dialog
// const personalisationOpenButtons = document.querySelectorAll(
//   '.personalisation-dialog-open-button'
// );
// const personalisationDialog = document.querySelector('#personalisation-dialog');
// const personalisationCloseButton = document.querySelector(
//   '#personalisation-dialog-close-button'
// );

// personalisationOpenButtons.forEach((personalisationOpenButton) => {
//   personalisationOpenButton.addEventListener('click', () => {
//     personalisationDialog.showModal();
//     document.body.classList.add('dialog-visible');
//   });
// });

// personalisationCloseButton.addEventListener('click', () => {
//   personalisationDialog.close();
//   document.body.classList.remove('dialog-visible');
// });

/*********************/
/* VARIATION BUTTONS */
/*********************/
// hook variations buttons up to the original select lists
const variationButtons = document.querySelectorAll('.variation-button');

function updateLabels() {
  const colorsLabel = document.querySelector('.label[data-variation="colors"]');
  const selectedColorButton = document.querySelector(
    '.variation-button.selected[data-name="attribute_colors"]'
  );
  const selectedColor = selectedColorButton.dataset.value;
  const colorSpan = document.createElement('span');
  colorSpan.classList.add('selected-colour');

  if (selectedColorButton) {
    colorSpan.innerText = selectedColor;
  }

  const sizesLabel = document.querySelector('.label[data-variation="sizes"]');
  const selectedSizeButton = document.querySelector(
    '.variation-button.selected[data-name="attribute_sizes"]'
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

/***************************/
/* PRODUCT META ACCORDIONS */
/***************************/
const accordionButtons = document.querySelectorAll('.accordion');

accordionButtons.forEach((accordionButton) => {
  accordionButton.addEventListener('click', function () {
    this.classList.toggle('active');

    const panel = this.nextElementSibling;
    panel.classList.toggle('active');
  });
});

// // close mailpoet popup by clicking on the background
// function waitForElm(selector) {
//   return new Promise((resolve) => {
//     if (document.querySelector(selector)) {
//       return resolve(document.querySelector(selector));
//     }

//     const observer = new MutationObserver((mutations) => {
//       if (document.querySelector(selector)) {
//         observer.disconnect();
//         resolve(document.querySelector(selector));
//       }
//     });

//     // If you get "parameter 1 is not of type 'Node'" error, see https://stackoverflow.com/a/77855838/492336
//     observer.observe(document.body, {
//       childList: true,
//       subtree: true,
//     });
//   });
// }

// waitForElm(
//   '.mailpoet_form_popup_overlay.mailpoet_form_overlay_animation_slideup.mailpoet_form_overlay_animation.active'
// ).then((elm) => {
//   console.log('test');

//   elm.addEventListener('click', function () {
//     const mailPoetFormPopup = document.querySelector('#mp_form_popup2');
//     const mailPoetForm = document.querySelector('#mp_form_popup2 form');
//     const dataCookieExpirationTime = mailPoetForm.dataset.cookieExpirationTime;

//     elm.classList.remove('active');
//     mailPoetFormPopup.classList.remove('active');

//     const today = new Date();
//     let expire = new Date();
//     expire.setTime(today.getTime() + 3600000 * 24 * dataCookieExpirationTime);
//     document.cookie =
//       'popup_form_dismissed_2=1; expires="' + expire.toGMTString();
//     +'";';
//   });
// });
