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
    title: __("First card colors", "radicle"),
    settings: [
      { key: "cardOneBg", label: __("Background", "radicle"), token: "brand" },
      { key: "cardOneTitle", label: __("Title", "radicle"), token: "white" },
      { key: "cardOneLabel", label: __("Label", "radicle"), token: "ice" },
    ],
  },
  {
    title: __("Second card colors", "radicle"),
    settings: [
      { key: "cardTwoBg", label: __("Background", "radicle"), token: "sky" },
      { key: "cardTwoTitle", label: __("Title", "radicle"), token: "ink" },
      { key: "cardTwoLabel", label: __("Label", "radicle"), token: "ink-soft" },
    ],
  },
  {
    title: __("Feature colors", "radicle"),
    settings: [
      { key: "tileBg", label: __("Icon tile", "radicle"), token: "sun" },
      { key: "title", label: __("Title", "radicle"), token: "ink" },
      { key: "text", label: __("Text", "radicle"), token: "ink-soft" },
    ],
  },
];
