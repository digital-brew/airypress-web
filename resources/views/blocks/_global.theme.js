// Global block styles
export default {
  blocks: {
    "core/list": {
      css: "list-style-type: disc;",
    },
  },
  // Element defaults (headings, p, lists) and their spacing live in resources/css/common/base.css instead:
  // theme.json styles are unlayered CSS and would override Tailwind utilities (a paragraph margin here beat `m-0`).
};
