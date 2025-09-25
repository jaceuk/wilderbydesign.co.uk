// /js/atc-loading-vanilla.js
(() => {
  const BTN_SEL =
    '.add_to_cart_button, .single_add_to_cart_button, .wp-block-button__link.add_to_cart, button[data-add-to-cart]';

  function setLoading(btn, { disable = false } = {}) {
    if (!btn || btn.classList.contains('is-loading')) return;
    if (!btn.dataset.originalHtml) btn.dataset.originalHtml = btn.innerHTML;
    const label = btn.getAttribute('data-loading-text') || '';
    btn.classList.add('is-loading');
    btn.setAttribute('aria-busy', 'true');

    // IMPORTANT: do NOT disable real submit buttons inside form.cart
    const isFormSubmit =
      btn.closest('form.cart') &&
      (btn.matches('button[type="submit"]') ||
        btn.matches('.single_add_to_cart_button'));
    if (disable && !isFormSubmit) btn.setAttribute('aria-disabled', 'true');

    btn.innerHTML = `<span class="btn-text">${label}</span><span class="spinner" aria-hidden="true"></span>`;

    // Clear when Woo adds its "added" class
    const mo = new MutationObserver(() => {
      if (btn.classList.contains('added')) clearLoading(btn);
    });
    mo.observe(btn, { attributes: true, attributeFilter: ['class'] });
    btn._atcMo = mo;

    // Failsafe clear
    btn._atcTimer = setTimeout(() => clearLoading(btn), 10000);
  }

  function clearLoading(btn) {
    if (!btn) return;
    btn.classList.remove('is-loading');
    btn.removeAttribute('aria-busy');
    btn.removeAttribute('aria-disabled');
    if (btn.dataset.originalHtml) btn.innerHTML = btn.dataset.originalHtml;
    if (btn._atcMo) {
      btn._atcMo.disconnect();
      delete btn._atcMo;
    }
    if (btn._atcTimer) {
      clearTimeout(btn._atcTimer);
      delete btn._atcTimer;
    }
  }

  // Clicks in loops/blocks/etc. (don’t disable; just show visuals)
  document.addEventListener(
    'click',
    (e) => {
      const btn = e.target && e.target.closest(BTN_SEL);
      if (!btn) return;
      setLoading(btn, { disable: false });
    },
    true
  );

  // Single product form submit (non-AJAX page submit)
  document.addEventListener(
    'submit',
    (e) => {
      if (!e.target || !e.target.matches('form.cart')) return;
      const btn = e.target.querySelector(
        '.single_add_to_cart_button, button[type="submit"]'
      );
      setLoading(btn, { disable: false }); // keep enabled so the form can submit
    },
    true
  );

  // Woo Blocks success event (modern Store API flows)
  document.addEventListener('wc-blocks_added_to_cart', () => {
    document.querySelectorAll('.is-loading').forEach(clearLoading);
  });
})();
