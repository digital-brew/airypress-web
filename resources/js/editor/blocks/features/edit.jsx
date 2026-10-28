import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { MediaField, useMediaUrl } from "../../components/MediaField";
import { Text } from "../../components/Text";
import colorGroups from "./colors";
import { Visual } from "./visuals";

/* Each card's look follows its illustration; mirrors `$looks` in resources/views/blocks/features.blade.php */
const looks = {
  menu: {
    "--card-bg": "var(--c-menu-bg, var(--color-sky))",
    "--card-title": "var(--c-menu-title, var(--color-ink))",
    "--card-text": "var(--c-menu-text, var(--color-ink-soft))",
    "--panel-bg": "var(--color-white)",
  },
  toolbar: {
    "--card-bg": "var(--c-toolbar-bg, var(--color-ink))",
    "--card-title": "var(--c-toolbar-title, var(--color-white))",
    "--card-text": "var(--c-toolbar-text, var(--color-ice))",
    "--panel-bg": "rgb(255 255 255 / 0.05)",
  },
  columns: {
    "--card-bg": "var(--c-columns-bg, var(--color-sun))",
    "--card-title": "var(--c-columns-title, var(--color-ink))",
    "--card-text": "var(--c-columns-text, var(--color-ink-soft))",
    "--panel-bg": "var(--color-white)",
  },
  handover: {
    "--card-bg": "var(--c-handover-bg, var(--color-brand))",
    "--card-title": "var(--c-handover-title, var(--color-white))",
    "--card-text": "var(--c-handover-text, var(--color-ice))",
    "--panel-bg": "rgb(255 255 255 / 0.15)",
  },
};
const visuals = Object.keys(looks);
const visualOptions = [
  { value: "menu", label: __("Menu builder", "radicle") },
  { value: "toolbar", label: __("Toolbar toggles", "radicle") },
  { value: "columns", label: __("List columns", "radicle") },
  { value: "handover", label: __("Login and handover", "radicle") },
];

/* Same fallback as the Blade template: cards without a stored visual cycle through them */
const visualFor = (item, index) =>
  visuals.includes(item.visual) ? item.visual : visuals[index % visuals.length];

const Card = ({ item, index, children }) => {
  const image = useMediaUrl(item.mediaId);
  const visual = visualFor(item, index);

  return (
    <div
      className="relative flex flex-col rounded-[1.25rem] bg-(--card-bg) p-4"
      style={looks[visual]}
    >
      <div className="flex min-h-[clamp(240px,24vw,320px)] items-center rounded-[1.25rem] bg-(--panel-bg) p-[clamp(16px,2vw,28px)]">
        {image ? (
          <img src={image} alt="" className="block h-auto w-full rounded-2xl" />
        ) : (
          <Visual visual={visual} />
        )}
      </div>
      {children}
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
        {items.map((item, index) => (
          <PanelBody
            key={index}
            title={item.title?.replace(/<[^>]+>/g, "") || __("Card", "radicle")}
            initialOpen={false}
          >
            <SelectControl
              label={__("Illustration and colors", "radicle")}
              value={visualFor(item, index)}
              options={visualOptions}
              onChange={(visual) => actions.update(index, { visual })}
              __nextHasNoMarginBottom
            />
            <MediaField
              label={__("Image instead of the illustration", "radicle")}
              value={item.mediaId}
              onChange={(mediaId) => actions.update(index, { mediaId })}
            />
          </PanelBody>
        ))}
      </InspectorControls>
      <Anchor {...field("anchor")} />

      <section {...props}>
        <div className="shell flex flex-col gap-12">
          <div className="flex flex-wrap items-center justify-between gap-x-10 gap-y-4">
            <Text
              tagName="h2"
              className="headline min-w-0 flex-[1_1_560px] text-[clamp(44px,6vw,80px)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-ink))]"
              placeholder={__("Heading", "radicle")}
              {...field("heading")}
            />
            <Text
              tagName="p"
              className="m-0 max-w-[400px] flex-[0_1_400px] text-lg text-[var(--c-text,var(--color-ink-soft))]"
              placeholder={__("Intro text", "radicle")}
              {...field("text")}
            />
          </div>

          <div className="grid gap-4 md:grid-cols-2">
            {items.map((item, index) => (
              <Card key={index} item={item} index={index}>
                <ItemControls
                  index={index}
                  count={items.length}
                  actions={actions}
                  show={isSelected}
                />
                <div className="flex flex-col gap-3 px-4 pt-7 pb-6">
                  <Text
                    tagName="h3"
                    className="m-0 font-display text-[clamp(24px,2.4vw,30px)] leading-tight font-extrabold tracking-[-0.02em] text-(--card-title)"
                    placeholder={__("Feature", "radicle")}
                    value={item.title}
                    onChange={(title) => actions.update(index, { title })}
                  />
                  <Text
                    tagName="p"
                    className="m-0 text-[17px] text-(--card-text)"
                    placeholder={__("Description", "radicle")}
                    value={item.text}
                    onChange={(text) => actions.update(index, { text })}
                  />
                </div>
              </Card>
            ))}
            <AddItem
              show={isSelected || !items.length}
              onClick={() =>
                actions.add({
                  visual: visuals[items.length % visuals.length],
                  mediaId: 0,
                  title: "",
                  text: "",
                })
              }
              label={__("Add card", "radicle")}
              className="text-ink"
            />
          </div>
        </div>
      </section>
    </>
  );
}
