import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { IconUpload } from "../../components/IconUpload";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 pb-24",
    style: colorVariables(attributes.colors),
  });
  const { items } = attributes;
  const actions = useItems(items, (items) => setAttributes({ items }));

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
        <div className="shell grid grid-cols-[repeat(auto-fit,minmax(min(260px,100%),1fr))] gap-4">
          {items.map((item, index) => (
            <div
              key={index}
              className="relative flex flex-col gap-3.5 rounded-[1.25rem] bg-[var(--c-card-bg,var(--color-sky))] p-7"
            >
              <ItemControls
                index={index}
                count={items.length}
                actions={actions}
                show={isSelected}
              />
              <IconUpload
                value={item.iconId}
                onChange={(iconId) => actions.update(index, { iconId })}
                fallback={item.icon}
                className="icon-tile size-[84px] rounded-[26px] bg-[var(--c-tile-bg,var(--color-white))]"
                size={56}
              />
              <Text
                tagName="h3"
                className="m-0 text-lg font-bold text-[var(--c-title,var(--color-ink))]"
                placeholder={__("Title", "radicle")}
                value={item.title}
                onChange={(title) => actions.update(index, { title })}
              />
              <Text
                tagName="p"
                className="m-0 text-[15px] text-[var(--c-text,var(--color-ink-soft))]"
                placeholder={__("Short description", "radicle")}
                value={item.text}
                onChange={(text) => actions.update(index, { text })}
              />
            </div>
          ))}
          <AddItem
            show={isSelected || !items.length}
            onClick={() => actions.add({ iconId: 0, title: "", text: "" })}
            label={__("Add highlight", "radicle")}
            className="min-h-40"
          />
        </div>
      </section>
    </>
  );
}
