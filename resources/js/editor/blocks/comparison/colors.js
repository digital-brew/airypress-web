import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "sky" },
      { key: "heading", label: __("Heading", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Table colors", "radicle"),
    settings: [
      { key: "tableBg", label: __("Background", "radicle"), token: "white" },
      { key: "highlightBg", label: __("Highlighted column", "radicle"), token: "brand" },
      { key: "highlightText", label: __("Highlighted text", "radicle"), token: "white" },
      { key: "labelText", label: __("Row labels", "radicle"), token: "ink" },
      { key: "cellText", label: __("Other cells", "radicle"), token: "ink-soft" },
      { key: "line", label: __("Lines", "radicle"), token: "line" },
    ],
  },
  {
    title: __("Chip colors", "radicle"),
    settings: [
      { key: "chipBg", label: __("Background", "radicle"), token: "white" },
      { key: "chipText", label: __("Text", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Tested with colors", "radicle"),
    settings: [
      { key: "testedLabel", label: __("Label", "radicle"), token: "ink" },
      { key: "testedText", label: __("Plugin names", "radicle"), token: "ink-soft" },
    ],
  },
];
