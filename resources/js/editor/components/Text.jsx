import { RichText } from "@wordpress/block-editor";

const formats = ["core/bold", "core/italic", "core/link"];

/**
 * Inline-editable text. `plain` disables formatting for labels and short strings.
 */
export const Text = ({ plain = false, ...props }) => (
  <RichText
    allowedFormats={plain ? [] : formats}
    withoutInteractiveFormatting={plain}
    disableLineBreaks={plain}
    {...props}
  />
);
