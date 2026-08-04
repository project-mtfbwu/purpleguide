


<script>
(function () {
    if (window.__purplePremiumOfferHydrated) return;
    window.__purplePremiumOfferHydrated = true;

    var endpoint = '<?= base_url('Purplepremium_offer/data') ?>';
    var sections = Array.prototype.slice.call(document.querySelectorAll('.js-purplepremium-offer-section'));

    if (!sections.length) {
        sections = Array.prototype.slice.call(document.querySelectorAll('section.pt-20')).filter(function (section) {
            return /Start Your USMLE journey/i.test(section.textContent || '') && /#purplePremium/i.test(section.textContent || '');
        });
    }

    if (!sections.length || typeof fetch !== 'function') return;

    function clean(value) {
        return (value == null ? '' : String(value)).trim();
    }

    function money(value) {
        value = clean(value);
        if (!value) return '';
        return /^(\u20B9|rs\.?|inr|\$|\u20AC|\u00A3)/i.test(value) ? value : '\u20B9 ' + value;
    }

    function originalPrice(value) {
        value = clean(value);
        if (!value) return '';
        return /^was\s/i.test(value) ? value : 'was ' + money(value);
    }

    function setText(node, value) {
        if (node) {
            node.textContent = clean(value);
        }
    }

    function setCta(node, text, url) {
        if (!node) return;
        text = clean(text) || 'Enroll Now';
        url = clean(url);

        if (url) {
            var link = node.tagName && node.tagName.toLowerCase() === 'a' ? node : document.createElement('a');
            link.className = node.className;
            link.href = url;
            link.textContent = text;
            if (/^https?:\/\//i.test(url)) {
                link.target = '_blank';
                link.rel = 'noopener';
            }
            if (link !== node) node.parentNode.replaceChild(link, node);
            return;
        }

        if (node.tagName && node.tagName.toLowerCase() === 'a') {
            var button = document.createElement('button');
            button.type = 'button';
            button.className = node.className;
            button.textContent = text;
            node.parentNode.replaceChild(button, node);
            return;
        }

        node.textContent = text;
    }

    fetch(endpoint, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(function (response) { return response.ok ? response.json() : null; })
        .then(function (data) {
            if (!data) return;

            sections.forEach(function (section) {
                if (data.visible === false) {
                    section.style.display = 'none';
                    return;
                }

                var topBox = section.querySelector('.card-box-border.bg-white');
                var priceBox = section.querySelector('.card-box-border.bg-black');

                setText(topBox && topBox.querySelector('h1'), clean(data.heading));
                setText(topBox && topBox.querySelector('p'), clean(data.description));
                setText(priceBox && priceBox.querySelector('h6 > span.mobile-d-block'), clean(data.label));
                setText(priceBox && priceBox.querySelector('.bg-yellow'), clean(data.discount));
                setText(priceBox && priceBox.querySelector('del'), originalPrice(data.original_price));
                setText(priceBox && priceBox.querySelector('h2'), money(data.price));
                setCta(priceBox && priceBox.querySelector('.btn-purple2'), data.cta_text, data.cta_url);
            });
        })
        .catch(function () {});
}());
</script>
