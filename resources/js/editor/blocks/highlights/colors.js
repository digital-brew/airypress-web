import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [{ key: "bg", label: __("Background", "radicle"), token: "white" }],
  },
  {
    title: __("Card colors", "radicle"),
    settings: [
      { key: "cardBg", label: __("Card background", "radicle"), token: "sky" },
      { key: "tileBg", label: __("Icon tile", "radicle"), token: "white" },
      { key: "title", label: __("Title", "radicle"), token: "ink" },
      { key: "text", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
];
