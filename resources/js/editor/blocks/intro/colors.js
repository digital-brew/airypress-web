import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "white" },
      { key: "eyebrow", label: __("Eyebrow", "radicle"), token: "brand" },
      { key: "heading", label: __("Heading", "radicle"), token: "ink" },
      { key: "text", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
];
