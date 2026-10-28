import { __ } from "@wordpress/i18n";

/* Color settings; `token` is the design color used when a color is not set */
export default [
  {
    title: __("Section colors", "radicle"),
    settings: [
      { key: "bg", label: __("Background", "radicle"), token: "brand" },
      { key: "heading", label: __("Heading", "radicle"), token: "white" },
      { key: "text", label: __("Text", "radicle"), token: "ice" },
    ],
  },
  {
    title: __("Badge colors", "radicle"),
    settings: [
      { key: "badgeBg", label: __("Background", "radicle"), token: "sun" },
      { key: "badgeText", label: __("Text", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Button colors", "radicle"),
    settings: [
      { key: "primaryBg", label: __("Primary background", "radicle"), token: "ink" },
      { key: "primaryText", label: __("Primary text", "radicle"), token: "white" },
      { key: "secondaryBg", label: __("Secondary background", "radicle"), token: "white" },
      { key: "secondaryText", label: __("Secondary text", "radicle"), token: "ink" },
    ],
  },
  {
    title: __("Sticker colors", "radicle"),
    settings: [
      {
        key: "stickerOneBg",
        label: __("First sticker background", "radicle"),
        token: "sun",
      },
      { key: "stickerOneText", label: __("First sticker text", "radicle"), token: "ink" },
      {
        key: "stickerTwoBg",
        label: __("Second sticker background", "radicle"),
        token: "ink",
      },
      { key: "stickerTwoText", label: __("Second sticker text", "radicle"), token: "white" },
      {
        key: "stickerThreeBg",
        label: __("Third sticker background", "radicle"),
        token: "white",
      },
      { key: "stickerThreeText", label: __("Third sticker text", "radicle"), token: "ink" },
      { key: "stickerThreeDot", label: __("Third sticker dot", "radicle"), token: "brand" },
    ],
  },
];
