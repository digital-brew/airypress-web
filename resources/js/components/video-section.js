/**
 * Video section: a muted background loop that plays only while the section is on screen (and not
 * at all for reduced motion), and a <dialog> that plays the demo in 1080p or 4K, from the start or
 * from a chapter.
 */
const reducedMotion = () => window.matchMedia("(prefers-reduced-motion: reduce)").matches;

export default ({ hd = "", uhd = "" } = {}) => ({
  sources: { hd, uhd },
  quality: hd ? "hd" : "uhd",
  visible: false,

  init() {
    this.background = this.$root.querySelector("video[data-background]");

    if (!this.background) {
      return;
    }

    new IntersectionObserver(([entry]) => {
      this.visible = entry.isIntersecting;
      this.loop();
    }).observe(this.$root);
  },

  /** Plays the background loop while it's useful: on screen and no modal open. */
  loop() {
    if (!this.background) {
      return;
    }

    if (this.visible && !this.$refs.dialog?.open && !reducedMotion()) {
      this.background.play().catch(() => {});
    } else {
      this.background.pause();
    }
  },

  /** Opens the modal, from the start or from a chapter (seconds). */
  open(at = null) {
    const video = this.$refs.video;

    if (!video.getAttribute("src")) {
      video.src = this.sources[this.quality];
    }

    if (at !== null) {
      this.seek(video, at);
    }

    this.$refs.dialog.showModal();
    this.loop();
    video.play().catch(() => {});
  },

  /** Seeks now, or once the duration is known if the video hasn't loaded yet. */
  seek(video, at) {
    if (video.readyState >= HTMLMediaElement.HAVE_METADATA) {
      video.currentTime = at;
    } else {
      video.addEventListener("loadedmetadata", () => (video.currentTime = at), { once: true });
    }
  },

  /** The dialog closed (button, Esc or a click on the backdrop). */
  closed() {
    this.$refs.video.pause();
    this.loop();
  },

  /** Switches quality, carrying on from the same moment. */
  use(quality) {
    const video = this.$refs.video;

    if (quality === this.quality || !this.sources[quality]) {
      return;
    }

    const time = video.currentTime;
    const playing = !video.paused;
    this.quality = quality;
    video.src = this.sources[quality];
    video.addEventListener(
      "loadedmetadata",
      () => {
        video.currentTime = time;

        if (playing) {
          video.play().catch(() => {});
        }
      },
      { once: true },
    );
    video.load(); // preload="none" won't fetch the new source on its own
  },
});
