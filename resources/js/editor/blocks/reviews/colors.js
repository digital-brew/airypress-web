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
    title: __("Card colors", "radicle"),
    settings: [
      { key: "cardBg", label: __("Card background", "radicle"), token: "sky" },
      { key: "title", label: __("Title", "radicle"), token: "ink" },
      { key: "quote", label: __("Quote", "radicle"), token: "ink-soft" },
      { key: "name", label: __("Name and role", "radicle"), token: "ink" },
    ],
  },
];
