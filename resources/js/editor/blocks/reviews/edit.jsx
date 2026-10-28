import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 py-28",
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
        <div className="shell flex flex-col gap-10">
          <Text
            tagName="h2"
            className="section-title text-center text-[var(--c-heading,var(--color-ink))]"
            placeholder={__("Heading", "radicle")}
            value={attributes.heading}
            onChange={(heading) => setAttributes({ heading })}
          />
          <div className="grid grid-cols-[repeat(auto-fit,minmax(min(320px,100%),1fr))] gap-4">
            {items.map((item, index) => {
              const update = (key) => (value) => actions.update(index, { [key]: value });

              return (
                <figure
                  key={index}
                  className="relative m-0 flex flex-col gap-4 rounded-[1.25rem] bg-[var(--c-card-bg,var(--color-sky))] p-8"
                >
                  <ItemControls
                    index={index}
                    count={items.length}
                    actions={actions}
                    show={isSelected}
                  />
                  <Text
                    plain
                    tagName="h3"
                    className="m-0 text-xl font-bold text-[var(--c-title,var(--color-ink))]"
                    placeholder={__("Review title", "radicle")}
                    value={item.title}
                    onChange={update("title")}
                  />
                  <Text
                    tagName="blockquote"
                    className="m-0 text-[17px] text-[var(--c-quote,var(--color-ink-soft))]"
                    placeholder={__("“Quote”", "radicle")}
                    value={item.quote}
                    onChange={update("quote")}
                  />
                  <figcaption className="mt-auto flex flex-wrap gap-1 text-sm text-[var(--c-name,var(--color-ink))]">
                    <Text
                      plain
                      tagName="strong"
                      placeholder={__("Name", "radicle")}
                      value={item.name}
                      onChange={update("name")}
                    />
                    ·
                    <Text
                      plain
                      tagName="span"
                      placeholder={__("Role", "radicle")}
                      value={item.role}
                      onChange={update("role")}
                    />
                  </figcaption>
                </figure>
              );
            })}
            <AddItem
              show={isSelected || !items.length}
              onClick={() => actions.add({ title: "", quote: "", name: "", role: "" })}
              label={__("Add review", "radicle")}
              className="min-h-48"
            />
          </div>
        </div>
      </section>
    </>
  );
}
