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

if (mobileMenuOpenButton) {
  mobileMenuOpenButton.addEventListener('click', () => {
    mobileMenu.showModal();
    document.body.classList.add('dialog-visible');
  });
}

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

/*********************/
/* DIALOGS */
/*********************/
function openDialog(element) {
  const dialog = document.getElementById(element);
  if (dialog) {
    dialog.showModal(); // or dialog.show() for non-modal
    document.body.classList.add('no-scroll');
  }

  // Close when clicking the backdrop
  dialog.addEventListener('click', (event) => {
    if (event.target === dialog) {
      dialog.close();
      document.body.classList.remove('no-scroll');
    }
  });
}

function closeDialog(element) {
  const dialog = document.getElementById(element);
  if (dialog) {
    dialog.close();
    document.body.classList.remove('no-scroll');
  }
}

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

// Toggle currency
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

function setCookie(name, value, days) {
  let expires = '';
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = '; expires=' + date.toUTCString();
  }
  document.cookie = name + '=' + value + '; path=/' + expires;
}

function toggleCurrency() {
  const currentCurrency = getCookie('wmc_current_currency');
  const newCurrency = currentCurrency === 'GBP' ? 'USD' : 'GBP';
  setCookie('wmc_current_currency', newCurrency, 7);

  location.reload();
}

function waitForCookie(cookieName, timeout = 5000, interval = 100) {
  return new Promise((resolve, reject) => {
    const startTime = Date.now();

    const checkCookie = () => {
      const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
        const [name, value] = cookie.split('=');
        acc[name] = value;
        return acc;
      }, {});

      if (cookies[cookieName]) {
        resolve(cookies[cookieName]);
        return;
      }

      if (Date.now() - startTime >= timeout) {
        reject(
          new Error(
            `Timeout: Cookie "${cookieName}" not found within ${timeout}ms`
          )
        );
        return;
      }

      setTimeout(checkCookie, interval);
    };

    checkCookie();
  });
}

waitForCookie('wmc_current_currency', 5000)
  .then((value) => {
    document
      .querySelectorAll('.toggle-currency')
      .forEach((toggleCurrencyButton) => {
        toggleCurrencyButton.addEventListener('click', toggleCurrency);
        toggleCurrencyButton.classList.add(value);
      });
  })
  .catch((error) => console.error(error.message));

// product page select list to go to other propducts with the same design
const productsSelect = document.querySelector('#products-select');

productsSelect?.addEventListener('change', function () {
  const url = this.value;
  if (url) {
    window.location.href = url;
  }
});
