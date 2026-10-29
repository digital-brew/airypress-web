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
        <div className="shell grid grid-cols-2 gap-3 md:grid-cols-[repeat(auto-fit,minmax(min(16.25rem,100%),1fr))] md:gap-4">
          {items.map((item, index) => (
            <div
              key={index}
              className="relative flex flex-col gap-2.5 rounded-2xl bg-[var(--c-card-bg,var(--color-sky))] p-4 md:gap-3.5 md:rounded-[1.25rem] md:p-7 max-md:items-center max-md:text-center"
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
                className="icon-tile size-14 rounded-2xl bg-[var(--c-tile-bg,var(--color-white))] md:size-21 md:rounded-[1.625rem]"
                size={56}
              />
              <Text
                tagName="h3"
                className="m-0 text-base font-bold text-[var(--c-title,var(--color-ink))] md:text-lg"
                placeholder={__("Title", "radicle")}
                value={item.title}
                onChange={(title) => actions.update(index, { title })}
              />
              <Text
                tagName="p"
                className="m-0 text-[0.9375rem] text-[var(--c-text,var(--color-ink-soft))] max-md:text-sm"
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
