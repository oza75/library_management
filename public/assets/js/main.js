const selectAll = function (selector, parent) {
    parent = parent || document;
    return [].slice.call(parent.querySelectorAll(selector))
};

const animateWhenVisible = function () {
    const elements = selectAll('.animate-when-visible');
    const threshold = .2;
    const options = {
        root: null,
        rootMargin: '0px',
        threshold
    };
    const observe = function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.intersectionRatio > threshold) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        })
    };
    let observer = new IntersectionObserver(observe, options);
    elements.forEach(function (element) {
        observer.observe(element);
    })
};
const mainTopbar = function () {
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: .1
    };
    const topbar = document.querySelector(".main-topbar");
    const heroSection = document.querySelector('.home-hero,.hero-container');
    const observe = function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.intersectionRatio > .1) {
                topbar.classList.add('home')
            } else {
                topbar.classList.remove('home')
            }
        })
    };

    if (heroSection) {
        const observer = new IntersectionObserver(observe, options);
        observer.observe(heroSection);
    }
};
const searchPageFormBehavior = function () {
    let container = document.querySelector('.search-page');
    if (!container) return;
    let form = container.querySelector('form#search-form');
    let select = container.querySelector('select#category_id');
    let input = container.querySelector('input#search');

    select.addEventListener('change', function (e) {
        form.submit();
    });
    input.addEventListener('keyup', function (e) {
        console.log(e);
        if (e.key == 'Enter') form.submit();
    })
};
const flash = window.flash = function (type, value) {
    let container = document.querySelector('#flash-container .wrapper');
    let flash = document.createElement('div');
    flash.classList.add('flash', 'flash-' + type);
    flash.innerHTML = value;
    container.appendChild(flash);
    flash.classList.add('visible');
    let timer = null;
    flash.addEventListener('dblclick', function () {
        flash.parentNode.removeChild(flash);
        clearTimeout(timer);
    });
    timer = setTimeout(function () {
        flash.parentNode.removeChild(flash);
    }, 10 * 1000)
};
const heroSectionImage = function () {
    let figures = selectAll('.hero-figure-container figure');
    if (!figures.length) return;
    let index = 1;
    setInterval(function () {
        let figure = figures[index];
        if (figure) {
            figures.forEach(fig => fig.style.opacity = 0);
            figure.style.opacity = 1;
        }
        index = index + 1 > figures.length - 1 ? 0 : index + 1
    }, 5000)
};
document.addEventListener('DOMContentLoaded', function () {
    animateWhenVisible();
    mainTopbar();
    searchPageFormBehavior();
    heroSectionImage();
});
