/**
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    var container, menu, links, i, len;

    container = document.getElementById('site-navigation');

    if (!container) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    menu.setAttribute('aria-expanded', 'false');
    menu.setAttribute('aria-label', 'mainmenu');

    if (-1 === menu.className.indexOf('navigation')) {
        menu.className += ' navigation';
    }

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-home.
        while (-1 === self.className.indexOf('navigation')) {
            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    var menuToggle = document.querySelector('.js-menu-toggle');
    var menu = document.querySelector('.list.navigation');
    menuToggle.addEventListener('click', function () {
        menu.classList.toggle('is-open');
        menuToggle.classList.toggle('is-active');
        //menu.getElementsByTagName('a')[0].focus();
    });

    var menuLinks = menu.getElementsByTagName('a');
    var menuListItems = menu.querySelectorAll('li');

    var focus, isToggleItem, isBackward;
    var lastIndex = menuListItems.length - 1;
    document.addEventListener('focusin', function () {
        focus = document.activeElement;
        if (isToggleItem && focus !== menuLinks[0]) {
            menuLinks[lastIndex].focus();
        }

        if (focus === menuToggle) {
            isToggleItem = true;
        } else {
            isToggleItem = false;
        }
    }, true);

    document.addEventListener('keydown', function (e) {
        if (e.shiftKey && e.keyCode == 9) {
            isBackward = true;
        } else {
            isBackward = false;
        }
    });

    for (el of menuLinks) {
        el.addEventListener('blur', function (e) {
            if (!isBackward) {
                if (e.target === menuLinks[lastIndex]) {
                    menuToggle.focus();
                }
            }
        });
    }
})();
