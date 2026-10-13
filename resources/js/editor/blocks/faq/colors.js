import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "white" },
      { key: "heading", label: __("Heading", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Question colors", "radicle"),
    settings: [
      { key: "itemBg", label: __("Background", "radicle"), token: "sky" },
      { key: "question", label: __("Question", "radicle"), token: "ink" },
      { key: "answer", label: __("Answer", "radicle"), token: "ink-soft" },
      { key: "icon", label: __("Arrow", "radicle"), token: "brand" },
    ],
  },
];
