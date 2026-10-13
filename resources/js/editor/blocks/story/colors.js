import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "sun" },
      { key: "heading", label: __("Heading", "radicle"), token: "ink" },
      { key: "text", label: __("Text", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("First row colors (repeats every 3 rows)", "radicle"),
    settings: [
      { key: "rowOneBg", label: __("Background", "radicle"), token: "ink" },
      { key: "rowOneTitle", label: __("Title", "radicle"), token: "white" },
      { key: "rowOneText", label: __("Text", "radicle"), token: "ice" },
    ],
  },
  {
    title: __("Second row colors", "radicle"),
    settings: [
      { key: "rowTwoBg", label: __("Background", "radicle"), token: "brand" },
      { key: "rowTwoTitle", label: __("Title", "radicle"), token: "white" },
      { key: "rowTwoText", label: __("Text", "radicle"), token: "ice" },
    ],
  },
  {
    title: __("Third row colors", "radicle"),
    settings: [
      { key: "rowThreeBg", label: __("Background", "radicle"), token: "white" },
      { key: "rowThreeTitle", label: __("Title", "radicle"), token: "ink" },
      { key: "rowThreeText", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
];
