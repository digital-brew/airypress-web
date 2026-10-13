import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { IconUpload } from "../../components/IconUpload";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { MediaField, useMediaUrl } from "../../components/MediaField";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

/* Mirrors the per-card CSS variables in resources/views/blocks/features.blade.php */
const cards = [
  {
    prefix: "cardOne",
    className: "",
    style: {
      "--card-bg": "var(--c-card-one-bg, var(--color-brand))",
      "--card-title": "var(--c-card-one-title, var(--color-white))",
      "--card-label": "var(--c-card-one-label, var(--color-ice))",
    },
  },
  {
    prefix: "cardTwo",
    className: "mt-12",
    style: {
      "--card-bg": "var(--c-card-two-bg, var(--color-sky))",
      "--card-title": "var(--c-card-two-title, var(--color-ink))",
      "--card-label": "var(--c-card-two-label, var(--color-ink-soft))",
    },
  },
];

const PreviewCard = ({ card, attributes, field }) => {
  const image = useMediaUrl(attributes[`${card.prefix}MediaId`]);

  return (
    <div
      className={`relative flex aspect-[3/4] flex-col justify-end overflow-hidden rounded-[32px] bg-(--card-bg) p-5 ${card.className}`}
      style={card.style}
    >
      {image && (
        <>
          <img src={image} alt="" className="absolute inset-0 size-full object-cover" />
          <span className="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-ink/70 to-transparent" />
        </>
      )}
      <Text
        plain
        tagName="span"
        className="relative font-display text-[26px] leading-none font-extrabold text-(--card-title)"
        placeholder={__("Card title", "radicle")}
        {...field(`${card.prefix}Title`)}
      />
      <Text
        plain
        tagName="span"
        className="relative text-sm text-(--card-label)"
        placeholder={__("Label", "radicle")}
        {...field(`${card.prefix}Label`)}
      />
    </div>
  );
};

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 py-28",
    style: colorVariables(attributes.colors),
  });
  const { items } = attributes;
  const actions = useItems(items, (items) => setAttributes({ items }));
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
      <InspectorControls>
        <PanelBody title={__("Preview card images", "radicle")}>
          <MediaField label={__("First card", "radicle")} {...field("cardOneMediaId")} />
          <MediaField label={__("Second card", "radicle")} {...field("cardTwoMediaId")} />
        </PanelBody>
      </InspectorControls>
      <Anchor {...field("anchor")} />

      <section {...props}>
        <div className="shell flex flex-wrap items-center gap-14">
          <div className="grid min-w-0 flex-[1_1_440px] grid-cols-2 gap-4">
            {cards.map((card) => (
              <PreviewCard key={card.prefix} card={card} attributes={attributes} field={field} />
            ))}
          </div>

          <div className="flex min-w-0 flex-[1_1_520px] flex-col gap-8">
            <Text
              tagName="h2"
              className="section-title text-[var(--c-heading,var(--color-ink))]"
              placeholder={__("Heading", "radicle")}
              {...field("heading")}
            />
            <div className="grid grid-cols-[repeat(auto-fit,minmax(min(240px,100%),1fr))] gap-7">
              {items.map((item, index) => (
                <div key={index} className="relative flex flex-col gap-2.5">
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
                    className="icon-tile size-[76px] rounded-3xl bg-[var(--c-tile-bg,var(--color-sun))]"
                    size={48}
                  />
                  <Text
                    tagName="h3"
                    className="m-0 text-[19px] font-bold text-[var(--c-title,var(--color-ink))]"
                    placeholder={__("Feature", "radicle")}
                    value={item.title}
                    onChange={(title) => actions.update(index, { title })}
                  />
                  <Text
                    tagName="p"
                    className="m-0 text-base text-[var(--c-text,var(--color-ink-soft))]"
                    placeholder={__("Description", "radicle")}
                    value={item.text}
                    onChange={(text) => actions.update(index, { text })}
                  />
                </div>
              ))}
              <AddItem
                show={isSelected || !items.length}
                onClick={() => actions.add({ iconId: 0, title: "", text: "" })}
                label={__("Add feature", "radicle")}
              />
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
