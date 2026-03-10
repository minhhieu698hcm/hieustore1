var userSettings = {
  Layout: document.documentElement.getAttribute('data-layout'),
  SidebarType: "full",
  BoxedLayout: document.documentElement.getAttribute('data-boxed-layout') === 'boxed',
  Direction: "ltr",
  Theme: document.documentElement.getAttribute('data-bs-theme'),
  ColorTheme: document.documentElement.getAttribute('data-color-theme'),
  cardBorder: document.documentElement.getAttribute('data-card'),
};