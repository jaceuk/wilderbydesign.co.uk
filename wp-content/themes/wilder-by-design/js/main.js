// cookie banner
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

// mobile menu
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

// desktop menu dropdowns
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
const personalisationOpenButtons = document.querySelectorAll(
  '.personalisation-dialog-open-button'
);
const personalisationDialog = document.querySelector('#personalisation-dialog');
const personalisationCloseButton = document.querySelector(
  '#personalisation-dialog-close-button'
);

personalisationOpenButtons.forEach((personalisationOpenButton) => {
  personalisationOpenButton.addEventListener('click', () => {
    personalisationDialog.showModal();
    document.body.classList.add('dialog-visible');
  });
});

personalisationCloseButton.addEventListener('click', () => {
  personalisationDialog.close();
  document.body.classList.remove('dialog-visible');
});
