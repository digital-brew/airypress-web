import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "ink" },
      { key: "caption", label: __("Caption", "radicle"), token: "frost" },
    ],
  },
  {
    title: __("Play button colors", "radicle"),
    settings: [
      { key: "buttonBg", label: __("Background", "radicle"), token: "brand" },
      { key: "buttonIcon", label: __("Icon", "radicle"), token: "white" },
    ],
  },
];
