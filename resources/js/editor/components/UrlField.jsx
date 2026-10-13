import { TextControl } from "@wordpress/components";

export const UrlField = ({ label, value, onChange }) => (
  <TextControl
    __next40pxDefaultSize
    __nextHasNoMarginBottom
    type="url"
    label={label}
    value={value}
    onChange={onChange}
    placeholder="https://"
  />
);
