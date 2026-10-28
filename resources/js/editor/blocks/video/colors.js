import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "ink" },
      { key: "eyebrowBg", label: __("Eyebrow background", "radicle"), token: "" },
      { key: "eyebrow", label: __("Eyebrow", "radicle"), token: "sun" },
      { key: "heading", label: __("Heading", "radicle"), token: "white" },
      { key: "text", label: __("Intro text", "radicle"), token: "frost" },
    ],
  },
  {
    title: __("Video colors", "radicle"),
    settings: [
      { key: "frame", label: __("Frame", "radicle"), token: "" },
      { key: "overlay", label: __("Video overlay", "radicle"), token: "ink" },
      { key: "buttonBg", label: __("Play button", "radicle"), token: "sun" },
      { key: "buttonIcon", label: __("Play icon", "radicle"), token: "ink" },
      { key: "labelBg", label: __("Label background", "radicle"), token: "ink" },
      { key: "label", label: __("Label text", "radicle"), token: "white" },
    ],
  },
  {
    title: __("Chapter colors", "radicle"),
    settings: [
      { key: "chapterBg", label: __("Background", "radicle"), token: "" },
      { key: "chapter", label: __("Text", "radicle"), token: "white" },
      { key: "numberBg", label: __("Number background", "radicle"), token: "brand" },
      { key: "number", label: __("Number", "radicle"), token: "white" },
    ],
  },
];
