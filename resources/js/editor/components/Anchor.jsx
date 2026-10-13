import { InspectorAdvancedControls } from "@wordpress/block-editor";
import { TextControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

/**
 * "HTML anchor" field in the Advanced panel, used for in-page links like /#pricing.
 */
export const Anchor = ({ value, onChange }) => (
  <InspectorAdvancedControls>
    <TextControl
      __next40pxDefaultSize
      __nextHasNoMarginBottom
      label={__("HTML anchor", "radicle")}
      help={__("Lets menu links jump to this section, e.g. /#pricing.", "radicle")}
      value={value}
      onChange={(anchor) => onChange(anchor.toLowerCase().replace(/[^a-z0-9-_]+/g, "-"))}
    />
  </InspectorAdvancedControls>
);
