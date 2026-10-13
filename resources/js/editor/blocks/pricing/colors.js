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
    title: __("Billing toggle colors", "radicle"),
    settings: [
      { key: "toggleBg", label: __("Background", "radicle"), token: "sky" },
      { key: "toggleText", label: __("Text", "radicle"), token: "ink" },
      { key: "toggleActiveBg", label: __("Active background", "radicle"), token: "ink" },
      { key: "toggleActiveText", label: __("Active text", "radicle"), token: "white" },
    ],
  },
  {
    title: __("Plan colors", "radicle"),
    settings: [
      { key: "cardBg", label: __("Background", "radicle"), token: "sky" },
      { key: "cardText", label: __("Text", "radicle"), token: "ink" },
      { key: "cardMuted", label: __("Secondary text", "radicle"), token: "ink-soft" },
      { key: "buttonBg", label: __("Button background", "radicle"), token: "ink" },
      { key: "buttonText", label: __("Button text", "radicle"), token: "white" },
    ],
  },
  {
    title: __("Featured plan colors", "radicle"),
    settings: [
      { key: "featuredBg", label: __("Background", "radicle"), token: "brand" },
      { key: "featuredText", label: __("Text", "radicle"), token: "white" },
      { key: "featuredMuted", label: __("Secondary text", "radicle"), token: "ice" },
      { key: "featuredButtonBg", label: __("Button background", "radicle"), token: "white" },
      { key: "featuredButtonText", label: __("Button text", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Badge colors", "radicle"),
    settings: [
      { key: "badgeBg", label: __("Background", "radicle"), token: "sun" },
      { key: "badgeText", label: __("Text", "radicle"), token: "ink" },
    ],
  },
];
