// Global block styles
export default {
  blocks: {
    "core/paragraph": {
      spacing: {
        margin: {
          bottom: "1rem",
        },
      },
    },
    "core/list": {
      spacing: {
        margin: {
          bottom: "1rem",
        },
        padding: {
          left: "1.5rem",
        },
      },
      css: "list-style-type: disc;",
    },
  },
  // Element defaults (headings, p, lists) live in resources/css/common/base.css instead:
  // theme.json element styles are unlayered CSS and would override Tailwind utilities.
};
