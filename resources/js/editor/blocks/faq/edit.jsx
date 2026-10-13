import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 pb-28",
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
        <div className="mx-auto flex max-w-[900px] flex-col gap-8">
          <Text
            tagName="h2"
            className="section-title text-center text-[var(--c-heading,var(--color-ink))]"
            placeholder={__("Heading", "radicle")}
            value={attributes.heading}
            onChange={(heading) => setAttributes({ heading })}
          />
          {/* Answers are always visible while editing; the frontend uses <details> */}
          <div className="flex flex-col gap-2.5">
            {items.map((item, index) => (
              <div
                key={index}
                className="relative rounded-3xl bg-[var(--c-item-bg,var(--color-sky))] px-7 py-[22px]"
              >
                <ItemControls
                  index={index}
                  count={items.length}
                  actions={actions}
                  show={isSelected}
                />
                <Text
                  plain
                  tagName="p"
                  className="m-0 min-h-7 text-lg font-bold text-[var(--c-question,var(--color-ink))]"
                  placeholder={__("Question", "radicle")}
                  value={item.question}
                  onChange={(question) => actions.update(index, { question })}
                />
                <Text
                  tagName="p"
                  className="m-0 mt-2.5 text-[var(--c-answer,var(--color-ink-soft))]"
                  placeholder={__("Answer", "radicle")}
                  value={item.answer}
                  onChange={(answer) => actions.update(index, { answer })}
                />
              </div>
            ))}
            <AddItem
              show={isSelected || !items.length}
              onClick={() => actions.add({ question: "", answer: "" })}
              label={__("Add question", "radicle")}
            />
          </div>
        </div>
      </section>
    </>
  );
}
