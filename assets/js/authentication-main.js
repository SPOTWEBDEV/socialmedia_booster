(function() {
  'use strict';

  const styleEl = document.querySelector('#style');

  if (localStorage.getItem("udondarktheme")) {
    document.documentElement.setAttribute("data-theme-mode", "dark");
    document.documentElement.setAttribute("data-menu-styles", "dark");
    document.documentElement.setAttribute("data-header-styles", "dark");
  }

  if (localStorage.udonrtl) {
    document.documentElement.setAttribute("dir", "rtl");
    styleEl?.setAttribute("href", "../assets/libs/bootstrap/css/bootstrap.rtl.min.css");
    // rtlFn();
  }

  if (localStorage.getItem("udonlayout") == "horizontal") {
    document.documentElement.setAttribute("data-nav-layout", "horizontal");
  }

  function localStorageBackup() {
    // primary color
    if (localStorage.primaryRGB) {
      const primaryPicker = document.querySelector('.theme-container-primary');
      if (primaryPicker) primaryPicker.value = localStorage.primaryRGB;
      document.documentElement.style.setProperty('--primary-rgb', localStorage.primaryRGB);
    }

    // body/background colors (and set dark theme)
    if (localStorage.bodyBgRGB && localStorage.bodylightRGB) {
      const bgPicker = document.querySelector('.theme-container-background');
      if (bgPicker) bgPicker.value = localStorage.bodyBgRGB;

      const html = document.documentElement;
      html.style.setProperty('--body-bg-rgb', localStorage.bodyBgRGB);
      html.style.setProperty('--body-bg-rgb2', localStorage.bodylightRGB);
      html.style.setProperty('--light-rgb', localStorage.bodylightRGB);
      html.style.setProperty('--form-control-bg', `rgb(${localStorage.bodylightRGB})`);
      html.style.setProperty('--input-border', "rgba(255,255,255,0.1)");

      html.setAttribute('data-theme-mode', 'dark');
      html.setAttribute('data-menu-styles', 'dark');
      html.setAttribute('data-header-styles', 'dark');
    }

    // dark theme flag (again)
    if (localStorage.udondarktheme) {
      document.documentElement.setAttribute('data-theme-mode', 'dark');
    }

    // rtl flag (again)
    if (localStorage.udonrtl) {
      const html = document.documentElement;
      html.setAttribute('dir', 'rtl');
      styleEl?.setAttribute("href", "../assets/libs/bootstrap/css/bootstrap.rtl.min.css");
      setTimeout(() => {
        if (typeof rtlFn === 'function') rtlFn();
      }, 10);
    }
  }

  localStorageBackup();

})();


function ltrFn() {
  const html = document.documentElement;
  const styleEl = document.querySelector('#style');

  if (styleEl) {
    // safe check: ensure href doesn't already include rtl file
    const href = styleEl.getAttribute('href') || '';
    if (!href.includes('bootstrap.min.css')) {
      styleEl.setAttribute("href", "../assets/libs/bootstrap/css/bootstrap.min.css");
    }
  }

  html.setAttribute("dir", "ltr");
}

function rtlFn() {
  const html = document.documentElement;
  const styleEl = document.querySelector('#style');

  html.setAttribute("dir", "rtl");
  styleEl?.setAttribute("href", "../assets/libs/bootstrap/css/bootstrap.rtl.min.css");
}
