/**
 * Sticky site header. Publishes two heights for CSS:
 * `--nav-height` (the floating islands row, offset by `#main` and a leading hero)
 * and `--header-height` (announcement bar + islands, used by `scroll-padding-top`).
 * Also flags `scrolled` and runs the mobile menu: `open` is the requested state (icon,
 * aria-expanded, item animation), `panelVisible` keeps the panel displayed until the
 * items have animated out (see `.menu-stagger` in app.css).
 */
export default () => ({
  scrolled: false,
  open: false,
  panelVisible: false,
  closeTimer: null,

  init() {
    const root = document.documentElement;
    const measure = () => {
      const nav = this.$refs.nav.offsetHeight;
      root.style.setProperty("--nav-height", `${nav}px`);
      root.style.setProperty("--header-height", `${this.$el.offsetHeight + nav}px`);
    };
    const onScroll = () => (this.scrolled = window.scrollY > 8);

    new ResizeObserver(measure).observe(this.$el);
    new ResizeObserver(measure).observe(this.$refs.nav);
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  },

  openMenu() {
    clearTimeout(this.closeTimer);
    this.panelVisible = true;
    // Let the panel render hidden first, so the items transition in.
    requestAnimationFrame(() => requestAnimationFrame(() => (this.open = true)));
  },

  closeMenu() {
    if (!this.open) {
      return;
    }

    this.open = false;
    clearTimeout(this.closeTimer);
    this.closeTimer = setTimeout(() => (this.panelVisible = false), this.menuDuration());
  },

  toggleMenu() {
    if (this.open) {
      this.closeMenu();
    } else {
      this.openMenu();
    }
  },

  /* How long the closing animation runs: the reverse stagger plus one item's transition. */
  menuDuration() {
    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
      return 0;
    }

    const count = this.$refs.menu?.children.length ?? 0;

    return count * 40 + 250;
  },
});
