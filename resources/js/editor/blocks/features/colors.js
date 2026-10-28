import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "white" },
      { key: "heading", label: __("Heading", "radicle"), token: "ink" },
      { key: "text", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
  {
    title: __("Menu builder card colors", "radicle"),
    settings: [
      { key: "menuBg", label: __("Background", "radicle"), token: "sky" },
      { key: "menuTitle", label: __("Title", "radicle"), token: "ink" },
      { key: "menuText", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
  {
    title: __("Toolbar card colors", "radicle"),
    settings: [
      { key: "toolbarBg", label: __("Background", "radicle"), token: "ink" },
      { key: "toolbarTitle", label: __("Title", "radicle"), token: "white" },
      { key: "toolbarText", label: __("Text", "radicle"), token: "ice" },
    ],
  },
  {
    title: __("Columns card colors", "radicle"),
    settings: [
      { key: "columnsBg", label: __("Background", "radicle"), token: "sun" },
      { key: "columnsTitle", label: __("Title", "radicle"), token: "ink" },
      { key: "columnsText", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
  {
    title: __("Handover card colors", "radicle"),
    settings: [
      { key: "handoverBg", label: __("Background", "radicle"), token: "brand" },
      { key: "handoverTitle", label: __("Title", "radicle"), token: "white" },
      { key: "handoverText", label: __("Text", "radicle"), token: "ice" },
    ],
  },
];
