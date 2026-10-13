import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

export default function Edit({ attributes, setAttributes }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 pt-28 pb-16",
    style: colorVariables(attributes.colors),
  });
  const field = (key) => ({
    value: attributes[key],
    onChange: (value) => setAttributes({ [key]: value }),
  });

  return (
    <>
      <InspectorControls group="styles">
        <ColorPanels
          colors={attributes.colors}
          onChange={(colors) => setAttributes({ colors })}
          groups={colorGroups}
        />
      </InspectorControls>
      <Anchor {...field("anchor")} />
      <section {...props}>
        <div className="mx-auto flex max-w-[980px] flex-col items-center gap-[22px] text-center">
          <Text
            plain
            tagName="span"
            className="text-[17px] font-bold text-[var(--c-eyebrow,var(--color-brand))]"
            placeholder={__("Eyebrow", "radicle")}
            {...field("eyebrow")}
          />
          <Text
            tagName="h2"
            className="headline text-[clamp(38px,5vw,64px)] leading-[1.02] text-[var(--c-heading,var(--color-ink))]"
            placeholder={__("Statement heading", "radicle")}
            {...field("heading")}
          />
          <Text
            tagName="p"
            className="m-0 max-w-[640px] text-[19px] text-[var(--c-text,var(--color-ink-soft))]"
            placeholder={__("Supporting text", "radicle")}
            {...field("text")}
          />
        </div>
      </section>
    </>
  );
}
