import { PanelColorSettings, useSettings } from "@wordpress/block-editor";

/* Brand tokens offered as swatches (slugs from the generated theme.json palette); any custom hex is allowed too */
const brandSlugs = [
  "brand",
  "brand-dark",
  "ink",
  "ink-soft",
  "sun",
  "sky",
  "mist",
  "ice",
  "frost",
  "line",
  "white",
];

const kebab = (key) => key.replace(/[A-Z]/g, (char) => `-${char.toLowerCase()}`);

/**
 * A block's `colors` attribute as the CSS variables its Blade template reads (`--c-bg`, …),
 * mirroring App\Blocks\Section::colorVariables().
 */
export const colorVariables = (colors = {}) =>
  Object.fromEntries(
    Object.entries(colors)
      .filter(([, color]) => color)
      .map(([key, color]) => [`--c-${kebab(key)}`, color]),
  );

/**
 * Color panels for a `colors` object attribute. Each setting names the design
 * `token` it falls back to (a palette slug, matching `var(--color-{token})` in Blade).
 * The token's color is shown as the current value, and choosing it or clearing
 * the color stores nothing, so the block keeps following the design.
 */
export const ColorPanels = ({ colors = {}, onChange, groups }) => {
  const [palette = []] = useSettings("color.palette");
  const brand = brandSlugs
    .map((slug) => palette.find((color) => color.slug === slug))
    .filter(Boolean);

  const tokenColor = (token) => palette.find((color) => color.slug === token)?.color || "";

  const set = (key, fallback) => (value) => {
    const next = { ...colors };
    if (!value || value.toLowerCase() === fallback.toLowerCase()) {
      delete next[key];
    } else {
      next[key] = value;
    }
    onChange(next);
  };

  return groups.map(({ title, settings }) => (
    <PanelColorSettings
      key={title}
      title={title}
      initialOpen={false}
      disableCustomColors={false}
      colors={brand}
      colorSettings={settings.map(({ key, label, token }) => ({
        label,
        value: colors[key] || tokenColor(token),
        onChange: set(key, tokenColor(token)),
        clearable: true,
      }))}
    />
  ));
};
