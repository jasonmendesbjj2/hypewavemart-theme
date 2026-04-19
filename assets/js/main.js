// Mobile menu
function toggleMobileNav() {
  const nav = document.getElementById('mobileNav');
  if (nav) nav.classList.toggle('open');
}

function closeMobileNav(e) {
  if (e.target.id === 'mobileNav') {
    toggleMobileNav();
  }
}

// Newsletter (versão simples)
function hwmNewsletterSubmit(e) {
  e.preventDefault();
  alert('Subscribed! (Aqui depois você integra com Mailchimp/Klaviyo)');
}

// Wishlist fake (apenas visual, depois dá pra integrar plugin)
function hwmToggleWishlist(productId, btn) {
  if (!btn) return;
  btn.classList.toggle('active');
}

// Add to cart AJAX (para WooCommerce)
function hwmAddToCart(productId, btn) {
  if (!btn || !productId || typeof jQuery === 'undefined') return;

  const $ = jQuery;
  btn.classList.add('loading');

  $.ajax({
    type: 'POST',
    url: wc_add_to_cart_params.ajax_url,
    data: {
      action: 'woocommerce_ajax_add_to_cart',
      product_id: productId,
      quantity: 1,
    },
    success: function (response) {
      btn.classList.remove('loading');
      btn.classList.add('added');
      btn.innerHTML = '<span>Added!</span>';

      // Atualizar mini contador do carrinho
      if (typeof HWM !== 'undefined') {
        $.post(HWM.ajaxUrl, { action: 'hwm_cart_count' }, function (data) {
          const el = document.getElementById('cartCount');
          if (el && data && typeof data.count !== 'undefined') {
            el.textContent = data.count;
          }
        });
      }

      // Atualizar fragmentos do WooCommerce (mini cart etc)
      if (response && response.fragments) {
        $.each(response.fragments, function (key, value) {
          $(key).replaceWith(value);
        });
      }
    },
    error: function () {
      btn.classList.remove('loading');
      alert('Error adding to cart. Please try again.');
    },
  });
}

// Expor no escopo global
window.toggleMobileNav = toggleMobileNav;
window.closeMobileNav = closeMobileNav;
window.hwmNewsletterSubmit = hwmNewsletterSubmit;
window.hwmToggleWishlist = hwmToggleWishlist;
window.hwmAddToCart = hwmAddToCart;

// Flash timer simples (6h a partir do carregamento)
(function () {
  const h = document.getElementById('timerH');
  const m = document.getElementById('timerM');
  const s = document.getElementById('timerS');
  if (!h || !m || !s) return;

  const target = Date.now() + 6 * 60 * 60 * 1000;

  function tick() {
    const diff = target - Date.now();
    if (diff <= 0) {
      h.textContent = '00';
      m.textContent = '00';
      s.textContent = '00';
      return;
    }
    const total = Math.floor(diff / 1000);
    const hh = Math.floor(total / 3600);
    const mm = Math.floor((total % 3600) / 60);
    const ss = total % 60;
    h.textContent = String(hh).padStart(2, '0');
    m.textContent = String(mm).padStart(2, '0');
    s.textContent = String(ss).padStart(2, '0');
    requestAnimationFrame(tick);
  }

  tick();
})();
