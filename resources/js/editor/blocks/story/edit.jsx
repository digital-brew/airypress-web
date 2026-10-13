import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

/* Rows cycle through three color sets, mirroring resources/views/blocks/story.blade.php */
const tones = [
  {
    "--row-bg": "var(--c-row-one-bg, var(--color-ink))",
    "--row-title": "var(--c-row-one-title, var(--color-white))",
    "--row-text": "var(--c-row-one-text, var(--color-ice))",
  },
  {
    "--row-bg": "var(--c-row-two-bg, var(--color-brand))",
    "--row-title": "var(--c-row-two-title, var(--color-white))",
    "--row-text": "var(--c-row-two-text, var(--color-ice))",
  },
  {
    "--row-bg": "var(--c-row-three-bg, var(--color-white))",
    "--row-title": "var(--c-row-three-title, var(--color-ink))",
    "--row-text": "var(--c-row-three-text, var(--color-ink-soft))",
  },
];

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "gutter bg-[var(--c-bg,var(--color-sun))] py-[clamp(56px,7vw,104px)]",
    style: colorVariables(attributes.colors),
  });
  const { rows } = attributes;
  const actions = useItems(rows, (rows) => setAttributes({ rows }));

  return (
    <>
      <InspectorControls group="styles">
        <ColorPanels
          colors={attributes.colors}
          onChange={(colors) => setAttributes({ colors })}
          groups={colorGroups}
        />
      </InspectorControls>
      <Anchor value={attributes.anchor} onChange={(anchor) => setAttributes({ anchor })} />
      <section {...props}>
        <div className="shell flex flex-col gap-12">
          <div className="flex flex-wrap items-end justify-between gap-6">
            <Text
              tagName="h2"
              className="headline flex-[1_1_560px] text-[clamp(48px,7vw,96px)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-ink))]"
              placeholder={__("Heading", "radicle")}
              value={attributes.heading}
              onChange={(heading) => setAttributes({ heading })}
            />
            <Text
              tagName="p"
              className="m-0 flex-[0_1_380px] text-lg text-[var(--c-text,var(--color-ink))]"
              placeholder={__("Supporting text", "radicle")}
              value={attributes.text}
              onChange={(text) => setAttributes({ text })}
            />
          </div>

          <div className="flex flex-col gap-3">
            {rows.map((row, index) => {
              const tone = tones[index % tones.length];

              return (
                <div
                  key={index}
                  className={`relative flex flex-wrap items-center justify-between gap-x-8 gap-y-3 rounded-[32px] bg-(--row-bg) px-8 py-6 md:rounded-full`}
                  style={tone}
                >
                  <ItemControls
                    index={index}
                    count={rows.length}
                    actions={actions}
                    show={isSelected}
                  />
                  <Text
                    plain
                    tagName="h3"
                    className="headline text-[clamp(32px,4vw,52px)] text-(--row-title)"
                    placeholder={__("Short statement.", "radicle")}
                    value={row.title}
                    onChange={(title) => actions.update(index, { title })}
                  />
                  <Text
                    tagName="p"
                    className="m-0 flex-[0_1_420px] text-[17px] text-(--row-text)"
                    placeholder={__("Supporting line", "radicle")}
                    value={row.text}
                    onChange={(text) => actions.update(index, { text })}
                  />
                </div>
              );
            })}
            <AddItem
              show={isSelected || !rows.length}
              onClick={() => actions.add({ title: "", text: "" })}
              label={__("Add row", "radicle")}
            />
          </div>
        </div>
      </section>
    </>
  );
}
