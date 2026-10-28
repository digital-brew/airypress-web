import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl, ToggleControl } from "@wordpress/components";
import { __, sprintf } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import { UrlField } from "../../components/UrlField";
import colorGroups from "./colors";

const toggle = "pill min-h-11 px-5 text-[15px]";

/* Fallback wording, matching resources/views/blocks/pricing.blade.php */
const wording = {
  yearlyPeriod: __("/ year", "radicle"),
  lifetimePeriod: __("once", "radicle"),
  yearlyNote: __("or {lifetime} lifetime", "radicle"),
  lifetimeNote: __("One-time payment · or {yearly} / year", "radicle"),
};

/* Plan card colors as CSS variables, mirroring the Blade template */
const planStyle = {
  "--card-bg": "var(--c-card-bg, var(--color-sky))",
  "--card-text": "var(--c-card-text, var(--color-ink))",
  "--card-muted": "var(--c-card-muted, var(--color-ink-soft))",
  "--btn-bg": "var(--c-button-bg, var(--color-ink))",
  "--btn-text": "var(--c-button-text, var(--color-white))",
};
const featuredStyle = {
  "--card-bg": "var(--c-featured-bg, var(--color-brand))",
  "--card-text": "var(--c-featured-text, var(--color-white))",
  "--card-muted": "var(--c-featured-muted, var(--color-ice))",
  "--btn-bg": "var(--c-featured-button-bg, var(--color-white))",
  "--btn-text": "var(--c-featured-button-text, var(--color-ink))",
};

/* Licence options of the Freemius Pro plan; "" keeps the Button URL */
const licenseOptions = [
  { label: __("None (use the Button URL)", "radicle"), value: "" },
  { label: __("1 site", "radicle"), value: "1" },
  { label: __("5 sites", "radicle"), value: "5" },
  { label: __("Unlimited sites", "radicle"), value: "unlimited" },
];

const fillNote = (template, plan) =>
  template.replaceAll("{yearly}", plan.yearly || "").replaceAll("{lifetime}", plan.lifetime || "");

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,transparent)] px-6 py-28",
    style: colorVariables(attributes.colors),
  });
  const { plans } = attributes;
  const actions = useItems(plans, (plans) => setAttributes({ plans }));
  const field = (key) => ({
    value: attributes[key],
    onChange: (value) => setAttributes({ [key]: value }),
  });
  const word = (key) => attributes[key] || wording[key];

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
        <PanelBody title={__("Price wording", "radicle")} initialOpen={false}>
          {Object.entries({
            yearlyPeriod: __("Yearly period", "radicle"),
            lifetimePeriod: __("Lifetime period", "radicle"),
            yearlyNote: __("Note under yearly price", "radicle"),
            lifetimeNote: __("Note under lifetime price", "radicle"),
          }).map(([key, label]) => (
            <TextControl
              key={key}
              __next40pxDefaultSize
              __nextHasNoMarginBottom
              label={label}
              placeholder={wording[key]}
              help={
                key.endsWith("Note")
                  ? __("{yearly} and {lifetime} insert the plan's prices.", "radicle")
                  : undefined
              }
              {...field(key)}
            />
          ))}
        </PanelBody>
        <PanelBody title={__("Freemius checkout", "radicle")} initialOpen={false}>
          <TextControl
            __next40pxDefaultSize
            __nextHasNoMarginBottom
            label={__("Plan ID", "radicle")}
            help={__("Freemius → Plans → Pro. Buttons with licences open the checkout for this plan.", "radicle")}
            {...field("checkoutPlanId")}
          />
        </PanelBody>
        {plans.map((plan, index) => (
          <PanelBody
            key={index}
            title={plan.name || sprintf(__("Plan %d", "radicle"), index + 1)}
            initialOpen={false}
          >
            <SelectControl
              __next40pxDefaultSize
              __nextHasNoMarginBottom
              label={__("Licences", "radicle")}
              help={__("The button opens the Freemius checkout with this many sites.", "radicle")}
              value={plan.licenses || ""}
              options={licenseOptions}
              onChange={(licenses) => actions.update(index, { licenses })}
            />
            {!plan.licenses && (
              <UrlField
                label={__("Button URL", "radicle")}
                value={plan.url || ""}
                onChange={(url) => actions.update(index, { url })}
              />
            )}
            <ToggleControl
              __nextHasNoMarginBottom
              label={__("Featured", "radicle")}
              checked={!!plan.featured}
              onChange={(featured) => actions.update(index, { featured })}
            />
          </PanelBody>
        ))}
      </InspectorControls>
      <Anchor {...field("anchor")} />

      <section {...props}>
        <div className="shell flex flex-col gap-10">
          <div className="flex flex-col items-center gap-4 text-center">
            <Text
              tagName="h2"
              className="section-title text-[var(--c-heading,var(--color-ink))]"
              placeholder={__("Heading", "radicle")}
              {...field("heading")}
            />
            <Text
              tagName="p"
              className="m-0 max-w-[600px] text-lg text-[var(--c-text,var(--color-ink-soft))]"
              placeholder={__("Supporting text", "radicle")}
              {...field("text")}
            />
            <div className="inline-flex gap-1 rounded-full bg-[var(--c-toggle-bg,var(--color-sky))] p-1.5">
              <Text
                plain
                tagName="span"
                className={`${toggle} bg-[var(--c-toggle-active-bg,var(--color-ink))] text-[var(--c-toggle-active-text,var(--color-white))]`}
                placeholder={__("Yearly", "radicle")}
                {...field("yearlyLabel")}
              />
              <span className={`${toggle} gap-2 text-[var(--c-toggle-text,var(--color-ink))]`}>
                <Text
                  plain
                  tagName="span"
                  placeholder={__("Lifetime", "radicle")}
                  {...field("lifetimeLabel")}
                />
                <Text
                  plain
                  tagName="span"
                  className="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-2 py-0.5 text-xs font-bold text-[var(--c-badge-text,var(--color-ink))]"
                  placeholder={__("Badge", "radicle")}
                  {...field("lifetimeBadge")}
                />
              </span>
            </div>
          </div>

          <div className="grid grid-cols-[repeat(auto-fit,minmax(min(300px,100%),1fr))] gap-4">
            {plans.map((plan, index) => {
              const featured = !!plan.featured;
              const update = (key) => (value) => actions.update(index, { [key]: value });

              return (
                <div
                  key={index}
                  className="relative flex flex-col gap-3.5 rounded-[1.25rem] bg-(--card-bg) p-9 text-(--card-text)"
                  style={featured ? featuredStyle : planStyle}
                >
                  <ItemControls
                    index={index}
                    count={plans.length}
                    actions={actions}
                    show={isSelected}
                  />
                  <div className="flex items-center justify-between gap-2">
                    <Text
                      plain
                      tagName="h3"
                      className="m-0 text-[22px] font-bold"
                      placeholder={__("Plan name", "radicle")}
                      value={plan.name}
                      onChange={update("name")}
                    />
                    {featured && (
                      <Text
                        plain
                        tagName="span"
                        className="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-3 py-1.5 text-[13px] font-bold text-[var(--c-badge-text,var(--color-ink))]"
                        placeholder={__("Featured badge", "radicle")}
                        {...field("featuredBadge")}
                      />
                    )}
                  </div>
                  <Text
                    plain
                    tagName="span"
                    className="text-(--card-muted)"
                    placeholder={__("Number of sites", "radicle")}
                    value={plan.sites}
                    onChange={update("sites")}
                  />
                  <div className="flex items-baseline gap-1.5">
                    <Text
                      plain
                      tagName="span"
                      className="font-display text-[64px] leading-none font-extrabold tracking-[-0.03em]"
                      placeholder={__("Yearly price", "radicle")}
                      value={plan.yearly}
                      onChange={update("yearly")}
                    />
                    <span className="text-(--card-muted)">{word("yearlyPeriod")}</span>
                  </div>
                  <span className="flex items-baseline gap-1 text-[15px] text-(--card-muted)">
                    {__("Lifetime price:", "radicle")}
                    <Text
                      plain
                      tagName="span"
                      className="font-bold"
                      placeholder={__("Lifetime price", "radicle")}
                      value={plan.lifetime}
                      onChange={update("lifetime")}
                    />
                  </span>
                  <span className="text-[15px] text-(--card-muted)">
                    {fillNote(word("yearlyNote"), plan)}
                  </span>
                  <span className="pill mt-2.5 min-h-[52px] bg-(--btn-bg) text-(--btn-text)">
                    <Text
                      plain
                      tagName="span"
                      placeholder={__("Get", "radicle")}
                      {...field("ctaPrefix")}
                    />
                    &nbsp;{plan.name}
                  </span>
                </div>
              );
            })}
            <AddItem
              show={isSelected || !plans.length}
              onClick={() =>
                actions.add({
                  name: "",
                  sites: "",
                  yearly: "",
                  lifetime: "",
                  featured: false,
                  licenses: "",
                  url: "",
                })
              }
              label={__("Add plan", "radicle")}
              className="min-h-60"
            />
          </div>

          <Text
            tagName="p"
            className="m-0 text-center text-[15px] text-[var(--c-text,var(--color-ink-soft))]"
            placeholder={__("Footnote", "radicle")}
            {...field("footnote")}
          />
        </div>
      </section>
    </>
  );
}
